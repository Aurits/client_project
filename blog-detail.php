<!-- include header -->
<?php include 'header.php'; ?>

<?php
// Assuming $conn is your database connection established earlier

// Check if blog ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
  $blog_id = $_GET['id'];

  // Fetch blog details from the database based on ID
  $sql_blog = "SELECT b.id, b.title, b.content, b.blog_image, bc.category_name AS category, b.created_at 
                 FROM blogs b
                 LEFT JOIN blog_categories bc ON b.category_id = bc.id
                 WHERE b.id = $blog_id";
  $result_blog = mysqli_query($conn, $sql_blog);

  if (mysqli_num_rows($result_blog) > 0) {
    $row = mysqli_fetch_assoc($result_blog);

    // Extract necessary data
    $title = $row['title'];
    $content = $row['content'];
    $category = $row['category'];
    $created_at = $row['created_at'];
    $image_path = ltrim($row['blog_image'], './'); // Trim the '../' from the image path
?>
    <!-- breadcrumb -->
    <div class="container">
      <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
          Home
          <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <a href="blog.php" class="stext-109 cl8 hov-cl1 trans-04">
          Blog
          <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>

        <span class="stext-109 cl4">
          <?php echo $title; ?>
        </span>
      </div>
    </div>

    <!-- Content page -->
    <section class="bg0 p-t-52 p-b-20">
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-lg-9 p-b-80">
            <div class="p-r-45 p-r-0-lg">
              <!-- Blog Post Details -->
              <div class="wrap-pic-w how-pos5-parent">
                <img src="<?php echo $image_path; ?>" alt="IMG-BLOG" />

                <div class="flex-col-c-m size-123 bg9 how-pos5">
                  <span class="ltext-107 cl2 txt-center"><?php echo date("d", strtotime($created_at)); ?></span>
                  <span class="stext-109 cl3 txt-center"><?php echo date("M Y", strtotime($created_at)); ?></span>
                </div>
              </div>

              <div class="p-t-32">
                <span class="flex-w flex-m stext-111 cl2 p-b-19">
                  <span>
                    <span class="cl4">By</span> Admin
                    <span class="cl12 m-l-4 m-r-6">|</span>
                  </span>

                  <span>
                    <?php echo date("d M, Y", strtotime($created_at)); ?>
                    <span class="cl12 m-l-4 m-r-6">|</span>
                  </span>

                  <span>
                    <?php echo $category; ?>
                    <span class="cl12 m-l-4 m-r-6">|</span>
                  </span>

                  <span>8 Comments</span>
                </span>

                <h4 class="ltext-109 cl2 p-b-28">
                  <?php echo $title; ?>
                </h4>

                <p class="stext-117 cl6 p-b-26">
                  <?php echo $content; ?>
                </p>
              </div>

              <div class="flex-w flex-t p-t-16">
                <span class="size-216 stext-116 cl8 p-t-4">Tags</span>

                <div class="flex-w size-217">
                  <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                    Streetstyle
                  </a>

                  <a href="#" class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                    Crafts
                  </a>
                </div>
              </div>

              <!-- Comment Section -->
              <div class="p-t-40">
                <h5 class="mtext-113 cl2 p-b-12">Leave a Comment</h5>

                <p class="stext-107 cl6 p-b-40">
                  Your email address will not be published. Required fields are marked *
                </p>

                <form>
                  <div class="bor19 m-b-20">
                    <textarea class="stext-111 cl2 plh3 size-124 p-lr-18 p-tb-15" name="cmt" placeholder="Comment..."></textarea>
                  </div>

                  <div class="bor19 size-218 m-b-20">
                    <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="name" placeholder="Name *" />
                  </div>

                  <div class="bor19 size-218 m-b-20">
                    <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="email" placeholder="Email *" />
                  </div>

                  <div class="bor19 size-218 m-b-30">
                    <input class="stext-111 cl2 plh3 size-116 p-lr-18" type="text" name="web" placeholder="Website" />
                  </div>

                  <button class="flex-c-m stext-101 cl0 size-125 bg3 bor2 hov-btn3 p-lr-15 trans-04">
                    Post Comment
                  </button>
                </form>
              </div>
            </div>
          </div>

          <!-- Sidebar -->
          <div class="col-md-4 col-lg-3 p-b-80">
            <div class="side-menu">
              <div class="bor17 of-hidden pos-relative">
                <input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="search" placeholder="Search" />

                <button class="flex-c-m size-122 ab-t-r fs-18 cl4 hov-cl1 trans-04">
                  <i class="zmdi zmdi-search"></i>
                </button>
              </div>

              <div class="p-t-55">
                <h4 class="mtext-112 cl2 p-b-33">Categories</h4>
                <ul>
                  <?php
                  // Fetch categories from the database
                  $sql_categories = "SELECT id, category_name FROM blog_categories";
                  $result_categories = mysqli_query($conn, $sql_categories);

                  if (mysqli_num_rows($result_categories) > 0) {
                    while ($row = mysqli_fetch_assoc($result_categories)) {
                      echo "<li class='bor18'>";
                      echo "<a href='category.php?id=" . $row['id'] . "' class='dis-block stext-115 cl6 hov-cl1 trans-04 p-tb-8 p-lr-4'>" . $row['category_name'] . "</a>";
                      echo "</li>";
                    }
                  }
                  ?>
                </ul>
              </div>

              <div class="p-t-65">
                <h4 class="mtext-112 cl2 p-b-33">Featured Products</h4>
                <ul>
                  <?php
                  // Fetch 3 random products from the database
                  $sql_products = "SELECT id, product_name, product_price, product_image 
                                             FROM product 
                                             ORDER BY RAND() 
                                             LIMIT 3";
                  $result_products = mysqli_query($conn, $sql_products);


                  if (mysqli_num_rows($result_products) > 0) {
                    while ($row = mysqli_fetch_assoc($result_products)) {
                      $image_src = "./site_images/" . $row['product_image'];
                      // Define the desired width and height for the image
                      $image_width = 100; // Example width in pixels
                      $image_height = 100; // Example height in pixels
                      echo "<li class='flex-w flex-t p-b-30'>";
                      echo "<a href='product-detail.php?id=" . $row['id'] . "' class='wrao-pic-w size-214 hov-ovelay1 m-r-20'>";
                      echo "<img src='" . $image_src . "' alt='PRODUCT' style='width: {$image_width}px; height: {$image_height}px;'>";
                      echo "</a>";
                      echo "<div class='size-215 flex-col-t p-t-8'>";
                      echo "<a href='product-detail.php?id=" . $row['id'] . "' class='stext-116 cl8 hov-cl1 trans-04'>" . $row['product_name'] . "</a>";
                      echo "<span class='stext-116 cl6 p-t-20'>$" . $row['product_price'] . "</span>";
                      echo "</div>";
                      echo "</li>";
                    }
                  }
                  ?>
                </ul>
              </div>

              <div class="p-t-50">
                <h4 class="mtext-112 cl2 p-b-27">Tags</h4>
                <div class="flex-w m-r--5">
                  <!-- Static Tags -->
                  <a href='tag.php?name=Decor' class='flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5'>Decor</a>
                  <a href='tag.php?name=Tips' class='flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5'>Tips</a>
                  <a href='tag.php?name=Trends' class='flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5'>Trends</a>
                  <a href='tag.php?name=Design' class='flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5'>Design</a>
                  <a href='tag.php?name=Highlights' class='flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5'>Highlights</a>
                  <a href='tag.php?name=Stories' class='flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5'>Stories</a>
                  <a href='tag.php?name=Top' class='flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5'>Top</a>
                  <a href='tag.php?name=Gadgets' class='flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5'>Gadgets</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- include footer -->
    <?php include 'footer.php'; ?>
<?php
  } else {
    // Handle case where no blog post with given ID is found
    echo "Blog post not found.";
  }
} else {
  // Handle case where no ID is provided in the URL
  echo "Invalid blog post ID.";
}

// Close the database connection if needed
mysqli_close($conn);
?>