<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
// Check if the username is set in the session
if (isset($_SESSION['username'])) {
  // Retrieve the username from the session
  $username = $_SESSION['username'];
} else {
  // If the username is not set in the session, redirect to the login page
  header("Location: index.php");
  exit();
}
include 'header.php';

?>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->

            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">

                    <div class="filter">
                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Welcome <span><?php echo $username; ?></span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?php echo $username; ?></h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                    <div class="filter">
                        <?php
            // Include the database connection file
            include 'db_connection.php';

            // SQL query to count total orders
            $sales_query = "SELECT COUNT(*) AS total_sales FROM orders";
            $sales_result = mysqli_query($conn, $sales_query);
            $total_sales = 0;
            if ($sales_result && mysqli_num_rows($sales_result) > 0) {
              $sales_row = mysqli_fetch_assoc($sales_result);
              $total_sales = $sales_row['total_sales'];
            }
            ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Sales <span><?php echo $total_sales; ?></span></h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                                <h6><?php echo $total_sales; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="filter">
                        <?php
            // SQL query to calculate total revenue
            $revenue_query = "SELECT SUM(amount_paid) AS total_revenue FROM orders";
            $revenue_result = mysqli_query($conn, $revenue_query);
            $total_revenue = 0;
            if ($revenue_result && mysqli_num_rows($revenue_result) > 0) {
              $revenue_row = mysqli_fetch_assoc($revenue_result);
              $total_revenue = $revenue_row['total_revenue'];
            }
            ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Revenue
                            <span>
                                <?php
                // Check if total_revenue is not null and is a valid number
                if (isset($total_revenue) && is_numeric($total_revenue)) {
                  echo 'UGX ' . number_format($total_revenue, 2);
                } else {
                  echo 'UGX 0.00'; // Default value if total_revenue is null or not numeric
                }
                ?>
                            </span>
                        </h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6>
                                    <?php
                  // Check if total_revenue is not null and is a valid number
                  if (isset($total_revenue) && is_numeric($total_revenue)) {
                    echo 'UGX ' . number_format($total_revenue, 2);
                  } else {
                    echo 'UGX 0.00'; // Default value if total_revenue is null or not numeric
                  }
                  ?>
                                </h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- End Revenue Card -->


            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

                <div class="card info-card customers-card">

                    <div class="filter">

                    </div>


                    <div class="card-body">
                        <h5 class="card-title">Users <span></span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="ps-3">
                                <?php
                include 'db_connection.php';
                // Assuming $conn is your database connection

                // SQL query to count the total number of users
                $sql = "SELECT COUNT(*) AS total_users FROM users";

                // Execute the query
                $result = mysqli_query($conn, $sql);

                // Check if the query was successful
                if ($result) {
                  // Fetch the total number of users from the result set
                  $row = mysqli_fetch_assoc($result);
                  $total_users = $row['total_users'];
                } else {
                  // Error handling if the query fails
                  $total_users = 0; // Default to 0 if there's an error
                  echo "Error: " . mysqli_error($conn);
                }

                // Close the database connection
                mysqli_close($conn);
                ?>

                                <h6><?php echo $total_users; ?></h6>


                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">

                    <div class="filter">



                    </div>

                    <div class="card-body">
                        <h5 class="card-title">Inventory <span></span></h5>

                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-archive"></i>
                            </div>
                            <div class="ps-3">
                                <?php
                include 'db_connection.php';
                // SQL query to calculate the total quantity of stock available
                $sql = "SELECT SUM(product_qty) AS total_quantity FROM product";

                // Execute the query
                $result = mysqli_query($conn, $sql);

                // Check if the query was successful
                if ($result) {
                  // Fetch the total quantity from the result set
                  $row = mysqli_fetch_assoc($result);
                  $total_quantity = $row['total_quantity'];
                } else {
                  // Error handling if the query fails
                  $total_quantity = 0; // Default to 0 if there's an error
                  echo "Error: " . mysqli_error($conn);
                }

                // Close the database connection
                mysqli_close($conn);
                ?>

                                <h6><?php echo $total_quantity; ?></h6>


                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->


        </div>
        </div><!-- End Revenue Card -->




        <!-- End Customers Card -->

        <!-- Reports -->
        <!-- End Reports -->

        <!-- Recent Sales -->

        <!-- Top Selling -->

        <?php
    include 'footer.php';
    ?>


        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/vendor/chart.js/chart.umd.js"></script>
        <script src="assets/vendor/echarts/echarts.min.js"></script>
        <script src="assets/vendor/quill/quill.min.js"></script>
        <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="assets/js/main.js"></script>

        </body>

        </html>