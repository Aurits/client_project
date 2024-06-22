<?php
include 'header.php';
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Blog Management</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Blogs</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- link to add a new blog -->
    <a href="add_blog.php" class="btn btn-primary">Add New Blog</a>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Blog Posts</h5>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Content</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Include the database connection file
                                include 'db_connection.php';

                                // Fetch data from the blogs table
                                $sql = "
                        SELECT blogs.id, blogs.title, blog_categories.category_name, blogs.blog_image, blogs.content 
                        FROM blogs 
                        JOIN blog_categories ON blogs.category_id = blog_categories.id";
                                $result = mysqli_query($conn, $sql);

                                // Check if any rows were returned
                                if (mysqli_num_rows($result) > 0) {
                                    // Output data of each row
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row["id"] . "</td>";
                                        echo "<td>" . $row["title"] . "</td>";
                                        echo "<td>" . $row["category_name"] . "</td>";
                                        echo "<td><img src='" . $row["blog_image"] . "' alt='Blog Image' style='width: 50px; height: auto;'></td>";
                                        echo "<td>" . substr($row["content"], 0, 50) . "...</td>";
                                        echo "<td>";

                                        echo "<a href='delete_blog.php?id=" . $row["id"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No blogs found</td></tr>";
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