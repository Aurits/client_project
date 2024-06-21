<?php
include 'header.php';

?>

<?php
include 'header.php';

?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>User Management</h1>
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
<a href='adduser.php?id=" . $row["id"] . "'>Add User</a>
        <h2>Users</h2>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                   
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php include 'read2.php'; ?>
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
  

