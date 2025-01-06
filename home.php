
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

        $data = getAllBlog();
        foreach ($data as $blog) {
            $blogdata = explode("/", $blog);

            $id = $blogdata[0];
            $blogname = $blogdata[1];
            $blogmessage = $blogdata[2];
            $username = $blogdata[3];
            $time = $blogdata[4];

            // แสดงผลข้อมูลแต่ละบล็อก
            echo '
                <div class="card">
                    <div class="card-header">' . $blogname . '</div>
                    <div class="card-body">'. $blogmessage .'Content</div>
                    <div class="card-footer">'. $username  .' เมื่อ '. $time .' </div>
                </div>
                <br>
            ';
        }
    ?>
</body>

<!-- <div class="card">
  <div class="card-header">Header</div>
  <div class="card-body">Content</div>
  <div class="card-footer">Footer</div>
</div> -->
