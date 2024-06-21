<!-- include header -->
<?php include 'header.php'; ?>




<?php
// Include the database connection file
include 'db_connection.php';

// SQL query to fetch product data
$sql = "SELECT id, product_name, product_price, product_image FROM product";
$result = mysqli_query($conn, $sql);

// Define the path to the images directory
$image_path = './site_images/';

// HTML and PHP integration for displaying products
?>

<!-- Product Section -->
<div class="container mt-5">
    <div class="row">
        <?php
        if (mysqli_num_rows($result) > 0) {
            // Output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                // Ensure the price has the correct format (adding currency)
                $price = (strpos($row['product_price'], 'UGX') === false) ? 'UGX ' . number_format($row['product_price'], 2) : $row['product_price'];

                // Construct the full image path
                $full_image_path = $image_path . htmlspecialchars($row['product_image']);
                ?>
                <div class="col-md-3 mb-5">
                    <div class="card" style="width: 100%;">
                        <img src="<?php echo $full_image_path; ?>" class="card-img-top" alt="Product Image">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($row['product_name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($price); ?></p>
                            <a href="product-detail.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Buy Now</a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>No products found.</p>";
        }
        ?>
    </div>
</div>

<!-- include footer -->
 <?php include 'footer.php'; ?>