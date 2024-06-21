<?php
include 'header.php';

?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Order Management</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Data</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <!-- Table with stripped rows -->
  <table class="table datatable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        <th>Payment Mode</th>
        <th>Products</th>
        <th>Amount Paid</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Include the database connection file
      include 'db_connection.php';

      // Fetch data from the orders table
      $sql = "SELECT * FROM orders";
      $result = mysqli_query($conn, $sql);

      // Check if any rows were returned
      if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row["id"] . "</td>";
          echo "<td>" . $row["name"] . "</td>";
          echo "<td>" . $row["email"] . "</td>";
          echo "<td>" . $row["phone"] . "</td>";
          echo "<td>" . $row["address"] . "</td>";
          echo "<td>" . $row["pmode"] . "</td>";
          echo "<td>" . $row["products"] . "</td>";
          echo "<td>" . $row["amount_paid"] . "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='8'>No orders found</td></tr>";
      }

      // Close the database connection
      mysqli_close($conn);
      ?>
    </tbody>
  </table>
  <!-- End Table with stripped rows -->

  </div>
  </div>

  </div>
  </div>
  </section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php
include 'footer.php';
?>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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