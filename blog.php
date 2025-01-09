<?php
require 'comment_menager.php';
include "blog_maneger.php";

if (isset($_POST['blogid']) && isset($_POST['comment']) && isset($_POST['username'])) {
    $blogid = $_POST['blogid'];
    $comment = $_POST['comment'];
    $username = $_POST['username'];
    if (!empty($comment) && !empty($username)) {
        addComment($blogid, $comment, $username);
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
            background-color: #fef7e7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background: linear-gradient(90deg, #343a40, #495057);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btn-create {
            background: linear-gradient(45deg, #FFD700, #FFA500);
            color: white;
            font-weight: bold;
            border-radius: 25px;
            transition: background-color 0.3s, transform 0.2s;
            border: none;
        }

        .btn-create:hover {
            background: linear-gradient(45deg, #FFA500, #FF8C00);
            transform: scale(1.05);
        }

        .blog-card {
            border: none;
            border-radius: 16px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            margin: 20px auto;
            padding: 16px;
            width: 70%;
            position: relative;
        }   
        
        .form-container {
            width: 70%;
            /* max-width: 700px; */
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 12px;
            background-color: #ffffff;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            border-color: #ffcc00;
            box-shadow: 0 0 8px rgba(255, 204, 0, 0.5);
        }

        .btn-secondary {
            border-radius: 20px;
            transition: all 0.3s ease-in-out;
        }

        .btn-secondary:hover {
            background-color: #ffde59;
            color: black;
            transform: scale(1.05);
        }

        h4 {
            text-align: left;
            color: #4a4a4a;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .card {
            border: none;
            border-radius: 10px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            margin: 20px auto;
            padding: 16px;
            width: 70%;
            position: relative;
        }
        .commenttotal{
            margin-left: 15%;
            color: gray;
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
    $blogname = trim($blogdata[1], '"');
    $blogmessage = trim($blogdata[2], '"');
    $username = trim($blogdata[3], '"');
    $time = trim($blogdata[4], '"');

    echo '
            <div class="blog-card">
                <h5>' . htmlspecialchars($blogname) . '</h5>
                <h6 class="blog-subtitle"><i class="fas fa-user mr-1"></i>' . htmlspecialchars($username) . ' - <i class="far fa-clock mr-1"></i> ' . htmlspecialchars($time) . '</h6>
                <p>' . htmlspecialchars($blogmessage) . '</p>
            </div>
        ';

    $data = getCommentByBlogID($blogid);
    echo '<h4 class="commenttotal">Comment (' . count($data) . ' Comment):</h4>';
    

    foreach ($data as $comment) {
        $commentdata = explode("/", $comment);

        $comment_id = $commentdata[0];
        $comment_data = trim($commentdata[1], '"');
        $comment_name = trim($commentdata[2], '"');
        $comment_time = trim($commentdata[3], '"');

        echo '
                <div class="card">
                    <div class="card-header" style="background-color: #f8f9fa; border-bottom: 1px solid #ddd;">
                        ' . htmlspecialchars($comment_data) . '
                    </div>
                    <div class="card-body" style="padding: 16px;">
                        <small><i class="fas fa-user mr-1"></i>' . htmlspecialchars($comment_name) . ' | <i class="far fa-clock mr-1"></i>' . htmlspecialchars($comment_time) . '</small>
                    </div>
                </div>
            ';
    }
    ?>

    <div class="form-container">
        <form method="POST" action="blog.php?id=<?= htmlspecialchars($blogid) ?>">
            <input type="hidden" name="blogid" value="<?= $id ?>">
            <div class="form-group">
                <label for="comment">เขียน Comment:</label>
                <textarea class="form-control" rows="5" id="comment" name="comment" required></textarea>
            </div>
            <div class="form-group">
                <label for="username">ชื่อผู้เขียน:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-secondary"
                    style="background-color:rgb(211, 255, 206); color: black">
                    ยืนยัน
                </button>
                <button type="reset" class="btn btn-secondary ml-auto"
                    style="background-color:rgb(255, 206, 206); color: black">
                    ยกเลิก
                </button>
            </div>
        </form>
    </div>
</body>