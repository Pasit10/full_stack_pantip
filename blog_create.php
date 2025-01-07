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
    <div class="d-flex justify-content-center align-items-center w-100 h-100" style="min-height: 100vh; background-color: #f9f9f9;">
        <form method="POST" action="blog_create.php" style="width: 100%; max-width: 90%; border: 1px solid #ddd; border-radius: 8px; padding: 20px; background-color: #fff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <h4 style="text-align: center; margin-bottom: 20px; color: #333; font-weight: bold;">สร้างกระทู้ใหม่</h4>
            
            <div class="form-group">
                <label for="name" style="font-weight: bold;">ระบุหัวข้อกระทู้:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="กรอกหัวข้อกระทู้..." required>
            </div>
            
            <div class="form-group">
                <label for="blogmessage" style="font-weight: bold;">เขียนรายละเอียดของกระทู้:</label>
                <textarea class="form-control" rows="15" id="blogmessage" name="blogmessage" placeholder="กรอกรายละเอียดของกระทู้..." required></textarea>
            </div>
            
            <div class="form-group">
                <label for="username" style="font-weight: bold;">ชื่อผู้เขียน:</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="กรอกชื่อของคุณ..." required>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-secondary" style="background-color: rgb(211, 255, 206); color: black; font-weight: bold;">
                    ยืนยัน
                </button>
                <a href="home.php">
                    <button type="button" class="btn btn-secondary" style="background-color: rgb(255, 206, 206); color: black; font-weight: bold;">
                        ยกเลิก
                    </button>
                </a>
            </div>
        </form>
    </div>
</body>

<?php
    require 'blog_maneger.php';

    if(isset($_POST['name']) && isset($_POST['blogmessage']) && isset($_POST['username'])){
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
    }
?>