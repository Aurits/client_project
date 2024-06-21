<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eco-friendly E-commerce</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #4CAF50;
      color: white;
      padding: 20px;
      text-align: left;
    }

    .product {
  margin-bottom: 20px;
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 10px;
  margin-top: 40px; /* Add margin to the top */
}

    .product img {
      width: 100%;
      border-radius: 5px;
    }

    .product h3,
    .product .price {
      margin-top: 10px;
      text-align: center;
    }
    
  </style>
</head>
<body>

<header>
  <div class="container">
    <h1>GreenShop</h1>
  </div>
</header>

<div class="container">
  <div class="row">
    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "demo";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to select all products from the database
    $sql = "SELECT * FROM stock";
    $result = $conn->query($sql);

    // Check if there are any products in the database
    if ($result->num_rows > 0) {
        // Fetching and outputting each product
        while($row = $result->fetch_assoc()) {
            echo '<div class="col-lg-4 col-md-6">';
            echo '<div class="product">';
            echo '<img src="uploads/' . $row['image'] . '" alt="' . $row['name'] . '">';
            echo '<h3>' . $row['name'] . '</h3>';
            echo '<p class="price">Ugx' . $row['price'] . '</p>';
            echo '<button class="btn btn-success view-details" data-toggle="modal" data-target="#productModal" data-name="' . $row['name'] . '" data-image="' . $row['image'] . '" data-price="' . $row['price'] . '" data-description="' . $row['description'] . '">Product Details</button>';
            echo '<button class="btn btn-primary ml-2">Add to Cart</button>'; // Add margin-left for space
            
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "No products found in the database.";
    }

    // Close database connection
    $conn->close();
    ?>
  </div>
</div>

<!-- Product Details Modal -->
<div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="productModalLabel">Product Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="productDetails">
          <!-- Product details will be dynamically added here -->
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- JavaScript for displaying product details -->
<script>
  $(document).ready(function() {
    $('.view-details').click(function() {
      var name = $(this).data('name');
      var image = $(this).data('image');
      var price = $(this).data('price');
      var description = $(this).data('description');
      
      var html = '<img src="uploads/' + image + '" alt="' + name + '" class="img-fluid mb-3">' +
                 '<h4>' + name + '</h4>' +
                 '<p class="text-muted">$' + price + '</p>' +
                 '<p>' + description + '</p>' +
                 '<button class="btn btn-primary">Add to Cart</button>';

      $('#productDetails').html(html);
    });
  });
</script>

</body>
</html>
