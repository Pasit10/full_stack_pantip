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

        .form-container {
            width: 75%;
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
    <div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="form-container">
            <h4 style="text-align: center; margin-bottom: 20px; color: #333; font-weight: bold;">สร้างกระทู้ใหม่</h4>
            <form method="POST" action="blog_create.php">
                <input type="hidden" name="blogid" value="">
                <div class="form-group">
                    <label for="name" style="font-weight: bold;">ระบุหัวข้อกระทู้:</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="กรอกหัวข้อกระทู้..."
                        required>
                </div>
                <div class="form-group">
                    <label for="blogmessage" style="font-weight: bold;">เขียนรายละเอียดของกระทู้:</label>
                    <textarea class="form-control" rows="15" id="blogmessage" name="blogmessage"
                        placeholder="กรอกรายละเอียดของกระทู้..." required></textarea>
                </div>
                <div class="form-group">
                    <label for="username" style="font-weight: bold;">ชื่อผู้เขียน:</label>
                    <input type="text" class="form-control" id="username" name="username"
                        placeholder="กรอกชื่อของคุณ..." required>
                </div>
                <div class="form-group d-flex">
                    <button type="submit" class="btn btn-secondary"
                        style="background-color: rgb(211, 255, 206); color: black; font-weight: bold; margin-right: 10px;">
                        ยืนยัน
                    </button>
                    <a href="home.php">
                        <button type="button" class="btn btn-secondary"
                            style="background-color: rgb(255, 206, 206); color: black; font-weight: bold;">
                            ยกเลิก
                        </button>
                    </a>
                </div>

            </form>
        </div>
    </div>

</body>

<?php
require 'blog_maneger.php';

if (isset($_POST['name']) && isset($_POST['blogmessage']) && isset($_POST['username'])) {
    $name = $_POST['name'];
    $blogmessage = $_POST['blogmessage'];
    $username = $_POST['username'];
    if (!empty($name) && !empty($blogmessage) && !empty($username)) {
        if (createBlog($name, $blogmessage, $username)) {
            echo "<script>
                    window.location.href = 'home.php';
                    alert('Blog created successfully!');
                </script>";
        }
    }
}
?>