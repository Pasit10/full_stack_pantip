<?php
    require 'comment_menager.php';
    $blogid = $_POST['blogid'];
    $comment = $_POST['comment'];
    $username = $_POST['username'];
    if (!empty($comment) && !empty($username)) {
        addComment($blogid,$comment,$username);
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
        include "blog_maneger.php";

        $blogid = $_GET["id"];
        $blogdata = getBlogByID($blogid);

        $id = $blogdata[0];
        $blogname = $blogdata[1];
        $blogmessage = $blogdata[2];
        $username = $blogdata[3];
        $time = $blogdata[4];

        echo '
            <div class="card">
                <div class="card-header">' . $blogname . '</div>
                <div class="card-body">'. $blogmessage .'</div>
                <div class="card-footer">'. $username  .' เมื่อ '. $time .' </div>
            </div>
            <br>
            <h4 style="margin-left: 10px;">ความคิดเห็น:</h4>
        ';

        $data = getCommentByBlogID($blogid);
        foreach ($data as $comment){
            $commentdata = explode("/", $comment);

            $comment_id = $commentdata[0];
            $comment_data = $commentdata[1];
            $comment_name = $commentdata[2];
            $comment_time = $commentdata[3];

            echo '
                <div class="card">
                    <div class="card-header">' . $comment_data . '</div>
                    <div class="card-body">'. $comment_name .' เมื่อ '. $comment_time  .' </div>
                </div>
                <br>
            ';
        }
    ?>
    <div class="d-flex justify-content-center align-items-center">
        <form method="POST" action="blog.php?id=<?= htmlspecialchars($blogid) ?>" style="width: 100%; max-width: 600px;">
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
