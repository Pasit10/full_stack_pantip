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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <title>WebBoard</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="d-flex align-items-center">
                <a class="navbar-brand" href="home.php">
                    <img src="image/pantip_icon.png" width="50px" height="50px" class="mr-2">
                    Pantip
                </a>
            </div>
            <div class="ml-auto">
                <a href="blog_create.php">
                    <button class="btn navbar-btn" style="background-color: #FFEB3B; color: black; border: none; white-space: nowrap;">
                        Create Blog
                    </button>
                </a>
            </div>
        </div>
    </nav>
    <?php
        $blogid = $_GET["id"];
        $blogdata = getBlogByID($blogid);

        $id = $blogdata[0];
        $blogname = $blogdata[1];
        $blogmessage = $blogdata[2];
        $username = $blogdata[3];
        $time = $blogdata[4];

        echo '
            <div style="border: 1px solid #ddd; border-radius: 8px; padding: 16px; margin: 16px auto; width: 95%; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); background-color: #fff;">
                <h5 style="margin: 0 0 8px; font-size: 18px; font-weight: bold;">'. htmlspecialchars($blogname) .'</h5>
                <h6 style="margin: 0 0 12px; font-size: 14px; color: #6c757d;">'. htmlspecialchars($username) .' เมื่อ'. htmlspecialchars($time) .'</h6>
                <p style="margin: 0; font-size: 16px; color: #333;">'. htmlspecialchars($blogmessage) .'</p>
            </div>
            <br>
            <h4 style="padding-left: 5%; margin-bottom: 16px; font-weight: bold; color: #333;">ความคิดเห็น:</h4>
        ';

        $data = getCommentByBlogID($blogid);
        foreach ($data as $comment){
            $commentdata = explode("/", $comment);

            $comment_id = $commentdata[0];
            $comment_data = $commentdata[1];
            $comment_name = $commentdata[2];
            $comment_time = $commentdata[3];

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
