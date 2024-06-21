<?php
include 'header.php';

?>
 <main id="main" class="main">

<div class="pagetitle">
  <h1>Stock Management</h1>
  <nav>
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
      <li class="breadcrumb-item">Tables</li>
      <li class="breadcrumb-item active">Data</li>
    </ol>
  </nav>
</div><!-- End Page Title -->



<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
    /* Additional custom styles */
    body {
        padding-top: 20px;
    }
    .container {
        max-width: 800px;
    }
    form {
        margin-bottom: 30px;
    }
</style>
</head>
<body>
<div class="container">
    <h2>Add Product</h2>
    <form action="create.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" id="image" name="image" required>
        </div>
        <div class="form-group">
            <label for="price">Price (UGX):</label>
            <input type="text" class="form-control" id="price" name="price" pattern="^(?:[1-9]\d*|0)(?:\.\d{1,2})?$" placeholder="Price (UGX)" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" placeholder="Description" required></textarea>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
    
    

        <?php
include 'footer.php';

?>