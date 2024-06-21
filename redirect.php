<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include the database connection file
include 'db_connection.php';

if (isset($_GET['status'])) {
    // Check payment status
    if ($_GET['status'] == 'cancelled') {
        echo "Transaction Cancelled";
        exit();
    } elseif ($_GET['status'] == 'successful') {
        $txid = $_GET['transaction_id'];

        try {
            // Make cURL request to verify transaction
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/{$txid}/verify",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    'Authorization: Bearer FLWSECK_TEST-41c6ec69aedd56a3a7c7083cc27d2879-X',
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);

            // Parse the JSON response
            $res = json_decode($response);

            // Check if the response was successful
            if ($res->status === 'success') {
                $data = $res->data;

                // Extract required fields
                $name = $data->customer->name;
                $email = $data->customer->email;
                $phone = $data->customer->phone_number;
                $address = $data->meta->address;
                $pmode = $data->payment_type;
                $products_string = $data->meta->products;
                $products_string = str_replace('\"', ' ', $products_string);
                $amount_paid = $data->charged_amount;

                // Insert the data into the orders table
                $stmt = $conn->prepare('INSERT INTO orders (name, email, phone, address, pmode, products, amount_paid) VALUES (?, ?, ?, ?, ?, ?, ?)');
                $stmt->bind_param('sssssss', $name, $email, $phone, $address, $pmode, $products_string, $amount_paid);
                $stmt->execute();

                // Clear Cart
                $stmt = $conn->prepare('DELETE FROM cart');
                $stmt->execute();

                // Extract products from the string and create an array
                $products_array = explode(", ", $products_string);

                $products = [];

                // Loop through each product string and extract product name and quantity
                foreach ($products_array as $product_string) {
                    // Remove extra quotes from the product string
                    $product_string = trim($product_string, '"');

                    // Split the product string into name and quantity
                    $parts = explode('(', $product_string);

                    // Check if the parts array has both name and quantity
                    if (count($parts) == 2) {
                        // Extract product name and quantity
                        $product_name = trim($parts[0]);
                        $quantity = intval(trim($parts[1], ')'));

                        // Add product details to the products array
                        $products[] = [
                            'name' => $product_name,
                            'quantity' => $quantity
                        ];
                    } else {
                        // Handle the case where the product string format doesn't match
                        // You might want to log an error or handle it according to your application logic
                    }
                }

                // Check if $products is an array before using it in foreach loop
                if (is_array($products)) {
                    // Update product quantities
                    foreach ($products as $product) {
                        $product_name = $product['name'];
                        $quantity = intval($product['quantity']);

                        // Update product quantity in the products table
                        $stmt = $conn->prepare('UPDATE product SET product_qty = product_qty - ? WHERE product_name = ?');
                        $stmt->bind_param('is', $quantity, $product_name);
                        $stmt->execute();
                    }
                } else {
                    // Handle case where $products is not an array
                    echo "Products is not an array";
                }

                // Display transaction details in a styled table with Bootstrap
                echo "<link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>";
                echo "<div class='container'>";
                // Add a thank you message
                echo "<div class='alert alert-success' role='alert'>";
                echo "<h4 class='alert-heading'>Thank you for your purchase!</h4>";
                echo "<p>We appreciate your business. Below are your transaction details:</p>";
                echo "</div>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-bordered'>";
                echo "<thead class='thead-light'><tr><th>Field</th><th>Value</th></tr></thead>";
                echo "<tbody>";
                echo "<tr><td>Name</td><td>{$name}</td></tr>";
                echo "<tr><td>Email</td><td>{$email}</td></tr>";
                echo "<tr><td>Phone</td><td>{$phone}</td></tr>";
                echo "<tr><td>Address</td><td>{$address}</td></tr>"; // Display address
                echo "<tr><td>Payment Mode</td><td>{$pmode}</td></tr>";
                echo "<tr><td>Products</td><td>{$products_string}</td></tr>"; // Display products
                echo "<tr><td>Amount Paid</td><td>UGX{$amount_paid}</td></tr>";
                // Add more fields if needed
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
                echo "<a class='btn btn-primary' href='shop.php'>Go to Shop</a>";
                echo "</div>";

                exit();
            } else {
                // Display error message
                echo "Transaction Error";
                exit();
            }
        } catch (Exception $e) {
            // Handle cURL or JSON parsing errors
            echo "An error occurred: " . $e->getMessage();
        }
    }
}
