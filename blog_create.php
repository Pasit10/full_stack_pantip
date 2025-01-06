<?php
    require 'blog_maneger.php';

    $name = $_POST['name'];
    $blogmessage = $_POST['blogmessage'];
    $username = $_POST['username'];
    if (!empty($name) && !empty($blogmessage) && !empty($username)) {
        if(createBlog($name,$blogmessage,$username)){
            echo "<script>
                window.location.href = 'home.php';
                alert('Blog created successfully!');
            </script>";
        }
    }
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS -->
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
    <div class="d-flex justify-content-center align-items-center w-100 h-100">
        <form method="POST" action="blog_create.php" style="width: 100%; max-width: 600px;">
            <div class="form-group">
                <label for="usr">ระบุหัวข้อกระทู้:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="comment">เขียนรายละเอียดของกระทู้:</label>
                <textarea class="form-control" rows="5" id="blogmessage" name="blogmessage" required></textarea>
            </div>
            <div class="form-group">
                <label for="comment">ชื่อผู้เขียน:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-secondary" style="background-color:rgb(211, 255, 206); color: black">
                    ยืนยัน
                </button>
                <a href="home.php">
                    <button type="button" class="btn btn-secondary ml-auto" style="background-color:rgb(255, 206, 206); color: black">
                        ยกเลิก
                    </button>
                </a>
            </div>
        </form>
    </div>
</body>