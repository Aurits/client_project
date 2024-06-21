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

    <h2>Products</h2>
    <a href='stockmgt.php?id=" . $row["id"] . "'>Add Stock.</a>
    <table class="table table-bordered">
      <thead class="thead-dark">
        <tr>
          <th>Code</th>
          <th>Name</th>
          <th>Image</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php include 'read.php'; ?>
      </tbody>
    </table>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>

  </html>

  <?php
  include 'footer.php';
  ?>