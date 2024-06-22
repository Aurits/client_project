<!-- include header -->
<?php include 'header.php'; ?>


<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-02.jpg');">
	<h2 class="ltext-105 cl0 txt-center">
		Blog
	</h2>
</section>

<!-- Content page -->
<section class="bg0 p-t-62 p-b-60">
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-lg-9 p-b-80">
				<div class="p-r-45 p-r-0-lg">
					<?php
					// Fetch blogs from the database
					$sql_blogs = "SELECT b.id, b.title, b.content, b.blog_image, bc.category_name AS category, b.created_at 
                                  FROM blogs b
                                  LEFT JOIN blog_categories bc ON b.category_id = bc.id
                                  ORDER BY b.created_at DESC";
					$result_blogs = mysqli_query($conn, $sql_blogs);

					// Include Parsedown for Markdown support
					require 'Parsedown.php';
					$Parsedown = new Parsedown();

					if (mysqli_num_rows($result_blogs) > 0) {
						while ($row = mysqli_fetch_assoc($result_blogs)) {
							$date = date("d", strtotime($row['created_at']));
							$month_year = date("M Y", strtotime($row['created_at']));
							$image_path = ltrim($row['blog_image'], './'); // Trim the '../' from the image path

							echo "<div class='p-b-63'>";
							echo "<a href='blog-detail.php?id=" . $row['id'] . "' class='hov-img0 how-pos5-parent'>";
							echo "<img src='" . $image_path . "' alt='IMG-BLOG'>"; // Use the trimmed image path
							echo "<div class='flex-col-c-m size-123 bg9 how-pos5'>";
							echo "<span class='ltext-107 cl2 txt-center'>$date</span>";
							echo "<span class='stext-109 cl3 txt-center'>$month_year</span>";
							echo "</div>";
							echo "</a>";
							echo "<div class='p-t-32'>";
							echo "<h4 class='p-b-15'>";
							echo "<a href='blog-detail.php?id=" . $row['id'] . "' class='ltext-108 cl2 hov-cl1 trans-04'>" . $row['title'] . "</a>";
							echo "</h4>";
							echo "<p class='stext-117 cl6'>" . substr(strip_tags($row['content']), 0, 150) . "...</p>";
							echo "<div class='flex-w flex-sb-m p-t-18'>";
							echo "<span class='flex-w flex-m stext-111 cl2 p-r-30 m-tb-10'>";
							echo "<span><span class='cl4'>By</span> Admin<span class='cl12 m-l-4 m-r-6'>|</span></span>";
							echo "<span>" . $row['category'] . "<span class='cl12 m-l-4 m-r-6'>|</span></span>";
							echo "<span>Comments</span>";
							echo "</span>";
							echo "<a href='blog-detail.php?id=" . $row['id'] . "' class='stext-101 cl2 hov-cl1 trans-04 m-tb-10'>Continue Reading<i class='fa fa-long-arrow-right m-l-9'></i></a>";
							echo "</div>";
							echo "</div>";
							echo "</div>";
						}
					} else {
						echo "<p>No blog posts available.</p>";
					}
					?>
					<!-- Pagination (You can implement actual pagination logic here) -->
					<div class="flex-l-m flex-w w-full p-t-10 m-lr--7">
						<a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7 active-pagination1">1</a>
						<a href="#" class="flex-c-m how-pagination1 trans-04 m-all-7">2</a>
					</div>
				</div>
			</div>

			<div class="col-md-4 col-lg-3 p-b-80">
				<div class="side-menu">
					<div class="bor17 of-hidden pos-relative">
						<input class="stext-103 cl2 plh4 size-116 p-l-28 p-r-55" type="text" name="search" placeholder="Search">
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