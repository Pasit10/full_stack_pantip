<?php 
    require 'comment_menager.php';
    include "blog_maneger.php";

    if(isset($_POST['blogid']) && isset($_POST['comment']) && isset($_POST['username'])){
        $blogid = $_POST['blogid'];
        $comment = $_POST['comment'];
        $username = $_POST['username'];
        if (!empty($comment) && !empty($username)) {
            addComment($blogid,$comment,$username);
        }
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>WebBoard</title>
    <style>
         body {
            background-color: antiquewhite;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: linear-gradient(90deg, #343a40, #495057);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-create {
            background: linear-gradient(45deg, #FFEB3B, #FFC107);
            color: white;
            font-weight: bold;
            border-radius: 20px;
            transition: background-color 0.3s, transform 0.2s;
            border: none;
        }

        .btn-create:hover {
            background: linear-gradient(45deg, #FFC107, #FF9800);
            transform: scale(1.05);
        }
        .blog-card {
            border: none;
            border-radius: 16px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
        }

        .blog-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .blog-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .blog-subtitle {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="home.php">
                    <img src="image/pantip_icon.png" width="45px" height="45px" class="mr-2">
                    <span>Pantip</span>
                </a>
                <div class="ml-auto">
                    <a href="blog_create.php">
                        <button class="btn btn-create px-4 py-2">
                            Create Blog
                        </button>
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <?php
        $blogid = $_GET["id"];
        $blogdata = getBlogByID($blogid);

        $id = $blogdata[0];
        $blogname = trim($blogdata[1],'"');
        $blogmessage = trim($blogdata[2],'"');
        $username = trim($blogdata[3],'"');
        $time = trim($blogdata[4],'"');

        $length = sizeof($blogdata);

        echo '
            <div style="border: 1px solid #ddd; border-radius: 8px; padding: 16px; margin: 16px auto; width: 95%; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); background-color: #fff;">
                <h5 style="margin: 0 0 8px; font-size: 18px; font-weight: bold;">'. htmlspecialchars($blogname) .'</h5>
                <h6 class="blog-subtitle"><i class="fas fa-user mr-1"></i>' . htmlspecialchars($username) . ' - <i class="far fa-clock mr-1"></i> ' . htmlspecialchars($time) . '</h6>
                <p style="margin: 0; font-size: 16px; color: #333;">'. htmlspecialchars($blogmessage) .'</p>
            </div>
            <br>
        ';

        $data = getCommentByBlogID($blogid);
        echo '<h4 style="padding-left: 5%; margin-bottom: 16px; font-weight: bold; color: #333;">ความคิดเห็น ('.$length.' ความคิดเห็น):</h4>';

        foreach ($data as $comment){
            $commentdata = explode("/", $comment);

            $comment_id = $commentdata[0];
            $comment_data = trim($commentdata[1],'"');
            $comment_name = trim($commentdata[2],'"');
            $comment_time = trim($commentdata[3],'"');

            echo '
                <div class="card" style="border: 1px solid #ddd; border-radius: 8px; margin: 16px auto; width: 90%; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); background-color: #fff;">
                    <div class="card-header" style="background-color: #f8f9fa;  padding: 12px; border-bottom: 1px solid #ddd;">
                        '. htmlspecialchars($comment_data) .'
                    </div>
                    <div class="card-body" style="padding: 16px; font-size: 14px; color: #333;">
                        '. htmlspecialchars($comment_name) .' เมื่อ '. htmlspecialchars($comment_time) .'
                    </div>
                </div>
            ';
        }
    ?>

    <div class="d-flex justify-content-center align-items-center">
        <form method="POST" action="blog.php?id=<?= htmlspecialchars($blogid) ?>"  style="width: 90%; border: 1px solid #ddd; border-radius: 8px; padding: 16px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); background-color: #fff;">
            <!-- Include the blog ID as a hidden input -->
            <input type="hidden" name="blogid" value="<?= $id ?>">
            <div class="form-group">
                <label for="comment">เขียน comment:</label>
                <textarea class="form-control" rows="5" id="comment" name="comment" required></textarea>
            </div>
            <div class="form-group">
                <label for="comment">ชื่อผู้เขียน:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-secondary" style="background-color:rgb(211, 255, 206); color: black">
                    ยืนยัน
                </button>
                <button type="reset" class="btn btn-secondary ml-auto" style="background-color:rgb(255, 206, 206); color: black">
                    ยกเลิก
                </button>
            </div>
        </form>
    </div>
</body>
