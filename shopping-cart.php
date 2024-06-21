<?php

// Include header
include 'header.php';

// Database configuration and connection
require 'db_connection.php';

$allItems = '';
$items = [];
$grand_totals = 0;

$sql = "SELECT CONCAT(product_name, '(',qty,')') AS ItemQty, total_price FROM cart";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
  $grand_totals += $row['total_price'];
  $items[] = $row['ItemQty'];
}
$allItems = implode(', ', $items);


// Fetch cart data from database
$stmt = $conn->prepare('SELECT * FROM cart');
$stmt->execute();
$result = $stmt->get_result();
$grand_total = 0;
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- Breadcrumb -->
<div class="container mt-3 mb-5">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">Home</a></li>
      <li class="breadcrumb-item active stext-109 cl4" aria-current="page">Shopping Cart</li>
    </ol>
  </nav>
</div>

<!-- Shopping Cart Section -->
<div class="container">
  <div class="row">
    <!-- Cart Items -->
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-4">Shopping Cart</h4>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Product</th>
                  <th scope="col">Price</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Total</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($row = $result->fetch_assoc()) : ?>
                  <tr>
                    <td>
                      <div class="media">
                        <img src="<?= $row['product_image'] ?>" class="mr-3" alt="Product Image" style="max-width: 100px;">
                        <div class="media-body">
                          <?= $row['product_name'] ?>
                        </div>
                      </div>
                    </td>
                    <td><i class="fas fa-shillings-sign"></i><?= number_format($row['product_price'], 2); ?>
                    </td>
                    <td>
                      <div class="input-group">
                        <input type="number" class="form-control itemQty" value="<?= $row['qty'] ?>" style="width:75px;">
                      </div>
                    </td>
                    <td><i class="fas fa-shillings-sign"></i><?= number_format($row['total_price'], 2); ?>
                    </td>
                    <td>
                      <a href="action.php?remove=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure want to remove this item?');"><i class="fas fa-trash-alt"></i> Remove</a>
                    </td>
                  </tr>
                  <?php $grand_total += $row['total_price']; ?>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Cart Summary -->
    <div class="col-lg-4">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-4">Cart Totals</h4>
          <div class="d-flex justify-content-between">
            <span>Subtotal:</span>
            <span><i class="fas fa-shillings-sign"></i><?= number_format($grand_total, 2); ?></span>
          </div>
          <div class="d-flex justify-content-between mt-2">
            <span>Shipping:</span>
            <span>No shipping options available</span>
          </div>
          <hr>
          <div class="d-flex justify-content-between">
            <span>Total:</span>
            <span><i class="fas fa-shillings-sign"></i><?= number_format($grand_total, 2); ?></span>
          </div>
          <hr>
          <div class="text-center">
            <!-- Clear Cart Button -->
            <a href="action.php?clear=all" class="btn btn-danger btn-block mt-4" onclick="return confirm('Are you sure want to clear your cart?');">Clear Cart</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Checkout Form -->
<div class="container mt-5 mb-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-4">Checkout</h4>
          <form action="" method="post" id="placeOrder">
            <input type="hidden" name="products" value="<?= $allItems; ?>">
            <input type="hidden" name="grand_total" value="<?= $grand_total; ?>">
            <div class="form-group">
              <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
            </div>
            <div class="form-group">
              <input type="email" name="emailAddress" class="form-control" placeholder="Enter E-Mail" required>
            </div>
            <div class="form-group">
              <input type="tel" name="phone" class="form-control" placeholder="Enter Phone" required>
            </div>
            <div class="form-group">
              <textarea name="address" class="form-control" rows="3" placeholder="Enter Delivery Address Here..." required></textarea>
            </div>
            <div class="form-group" style="display: none;">
              <select name="pmode" class="form-control">
                <option value="flutterwave" selected>payment</option>
              </select>
            </div>
            <div class="form-group">
              <input type="submit" name="submit" value="Place Order" class="btn btn-success btn-block">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>