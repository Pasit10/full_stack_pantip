
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
    <div style="padding-left: 2.5%; margin-top: 16px; font-weight: bold; color: #333;">
        <h4>หน้าแรก:</h4>
    </div>
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

            echo '
                <a href="blog.php?id='. $id . '" style="text-decoration: none; color: inherit;">
                    <div style="border: 1px solid #ddd; border-radius: 8px; padding: 16px; margin: 16px auto; width: 95%; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); background-color: #fff;">
                        <h5 style="margin: 0 0 8px; font-size: 18px; font-weight: bold;">'. htmlspecialchars($blogname) .'</h5>
                        <h6 style="margin: 0 0 12px; font-size: 14px; color: #6c757d;">'. htmlspecialchars($username) .' เมื่อ'. htmlspecialchars($time) .'</h6>
                        <p style="margin: 0; font-size: 16px; color: #333;">'.htmlspecialchars( $blogmessage) .'</p>
                    </div>
                </a>
            ';
        }
    ?>
</body>

<!-- <div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
</div> -->