<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blog</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        /* Additional styles for blog form */
        .blog-form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .blog-form-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .blog-form-container .form-group {
            margin-bottom: 15px;
        }

        .blog-form-container .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .blog-form-container .form-group input,
        .blog-form-container .form-group select,
        .blog-form-container .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .blog-form-container .form-group textarea {
            resize: vertical;
            height: 150px;
        }

        .blog-form-container .form-group input[type="file"] {
            padding: 3px;
        }

        .blog-form-container .form-group button {
            padding: 10px 20px;
            background: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .blog-form-container .form-group button:hover {
            background: #218838;
        }
    </style>
</head>

<body>

    <div class="blog-form-container">
        <h2>Add a New Blog</h2>
        <form action="add_blog_component.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Blog Title</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select id="category" name="category" required>
                    <option value="">Select Category</option>
                    <?php
                    // Fetch categories from the database
                    require 'db_connection.php';
                    $sql = "SELECT ID, CATEGORY_NAME FROM BLOG_CATEGORIES";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['ID'] . '">' . $row['CATEGORY_NAME'] . '</option>';
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="blog_image">Blog Image</label>
                <input type="file" id="blog_image" name="blog_image">
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Add Blog</button>
            </div>
        </form>
    </div>

</body>

</html>