<?php
session_start();
require 'db_connection.php';
// Add products into the cart table
if (isset($_POST['pid'])) {
	$pid = $_POST['pid'];
	$pname = $_POST['pname'];
	$pprice = $_POST['pprice'];
	$pimage = $_POST['pimage'];
	$pqty = $_POST['pqty'];
	$total_price = $pprice * $pqty;
	$stmt = $conn->prepare('SELECT id FROM cart WHERE id=?');
	$stmt->bind_param('s', $pid);
	$stmt->execute();
	$res = $stmt->get_result();
	$r = $res->fetch_assoc();
	$id = $r['id'] ?? '';

	if (!$id) {

		try {
			$query = $conn->prepare('INSERT INTO cart (product_name, product_price, product_image, qty, total_price) VALUES (?, ?, ?, ?, ?)');
			$query->bind_param('sssss', $pname, $pprice, $pimage, $pqty, $total_price);
			$query->execute();
		} catch (\Throwable $th) {
			echo $th;
		}


		echo '<div class="alert alert-success alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item added to your cart!</strong>
						</div>';
	} else {
		echo '<div class="alert alert-danger alert-dismissible mt-2">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong>Item already added to your cart!</strong>
						</div>';
	}
}

// Get no.of items available in the cart table
if (isset($_GET['cartItem']) && isset($_GET['cartItem']) == 'cart_item') {
	$stmt = $conn->prepare('SELECT * FROM cart');
	$stmt->execute();
	$stmt->store_result();
	$rows = $stmt->num_rows;

	echo $rows;
}

// Remove single items from cart
if (isset($_GET['remove'])) {
	$id = $_GET['remove'];

	$stmt = $conn->prepare('DELETE FROM cart WHERE id=?');
	$stmt->bind_param('i', $id);
	$stmt->execute();

	$_SESSION['showAlert'] = 'block';
	$_SESSION['message'] = 'Item removed from the cart!';
	header('location:shopping-cart.php');
}

// Remove all items at once from cart
if (isset($_GET['clear'])) {
	$stmt = $conn->prepare('DELETE FROM cart');
	$stmt->execute();
	$_SESSION['showAlert'] = 'block';
	$_SESSION['message'] = 'All Item removed from the cart!';
	header('location:shopping-cart.php');
}

// Set total price of the product in the cart table
if (isset($_POST['qty'])) {
	$qty = $_POST['qty'];
	$pid = $_POST['pid'];
	$pprice = $_POST['pprice'];

	$tprice = $qty * $pprice;

	$stmt = $conn->prepare('UPDATE cart SET qty=?, total_price=? WHERE id=?');
	$stmt->bind_param('isi', $qty, $tprice, $pid);
	$stmt->execute();
}





// Checkout and save customer info in the orders table
if (isset($_POST['action']) && $_POST['action'] == 'order') {
	// Retrieve user input
	$name = $_POST['name'];
	$email = $_POST['emailAddress'];
	$phone = $_POST['phone'];
	$products = $_POST['products'];
	$grand_total = $_POST['grand_total'];
	$address = $_POST['address'];
	$pmode = $_POST['pmode'];




	// Validate user input
	$email = filter_var($email, FILTER_VALIDATE_EMAIL);
	$amount = filter_var($grand_total, FILTER_VALIDATE_FLOAT);

	$products_json = json_encode($products);


	if (!$email || !$amount || $amount <= 0) {
		// Invalid input, redirect back to the payment page with an error message
		header('Location: index.htm?error=invalid_input');
		exit();
	}

	// Prepare the request data
	$request = [
		'tx_ref' => strval(time()), // Convert to string
		'amount' => $amount,
		'currency' => 'UGX',
		'redirect_url' => 'https://psychedelicshop.shop/redirect.php',
		'customer' => [
			'email' => $email,
			'name' =>  $name,
			'phonenumber' => $phone
		],
		'meta' => [
			'price' => $amount,
			'products' => $products_json,
			'address' => $address
		],
		'customizations' => [
			'title' => 'Payment for items purchased on our platform',
			'description' => 'Payment for items purchased on our platform'
		]
	];

	// Send the request to Flutterwave
	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => json_encode($request),
		CURLOPT_HTTPHEADER => [
			'Authorization: Bearer FLWSECK_TEST-41c6ec69aedd56a3a7c7083cc27d2879-X',
			'Content-Type: application/json'
		],
	]);

	$response = curl_exec($curl);
	$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);

	var_dump($response);

	// Check if the request was successful  	'Authorization: Bearer FLWSECK_TEST-41c6ec69aedd56a3a7c7083cc27d2879-X', 
	if ($http_code === 200) {
		$res = json_decode($response);
		if ($res->status === 'success') {
			echo $res->data->link;
			exit();
		} else {
			// Handle Flutterwave API error
			echo 'We can not process your payment';
			// Log the error for debugging purposes
			error_log('Flutterwave API Error: ' . $res->message);
		}
	} else {
		// Handle HTTP request error
		echo 'We encountered an error processing your payment. Please try again later.';
		// Log the error for debugging purposes
		error_log('HTTP Request Error: HTTP ' . $http_code);
	}
}
