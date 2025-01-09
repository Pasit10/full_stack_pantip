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

        .imghome {
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transition: box-shadow 0.3s ease;
            width: 100%;
            height: 500px;
        }

        .imghome:hover {
            filter: blur(5px);
            transition: filter 0.5s ease;
        }

        .overlay-text h1 {
            font-family: 'Arial', sans-serif;
            font-size: 50px;
            font-weight: bold;
            color: #ffffff;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.6);
            text-align: center;
            letter-spacing: 3px;
            text-transform: uppercase;
            line-height: 1.4;
            transition: transform 0.3s ease-in-out;
        }

        .overlay-text h1:hover {
            transform: scale(1.1);
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

        .blog-content {
            font-size: 16px;
            color: #555;
        }

        footer {
            background: linear-gradient(45deg, #495057, #343a40);
            color: white;
            text-align: center;
            padding: 10px 0;

        }

        footer a {
            color: white;
            margin-right: 15px;
            font-size: 20px;
        }

        footer a:hover {
            color: #FFC107;
        }

        h2 {
            font-size: 20px;
            letter-spacing: 5px;
            text-transform: uppercase;
        }

        h2 span {
            border-bottom: 2px solid #000;
            padding-bottom: 2px;
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
        <img class="imghome"
            src="https://static.thairath.co.th/media/dFQROr7oWzulq5Fa5K8AHObPOkbMrR4uAhAEJ6DEzXcL04nnA3YSWl705PLAzi5ZqRr.webp">
        <div class="position-relative">
            <div class="overlay-text position-absolute w-100 h-100 d-flex justify-content-center align-items-center">
                <h1 class="display-4 font-weight-bold">Welcome to Pantip</h1>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <?php
        include "blog_maneger.php";

        $data = getAllBlog();

        echo '  <div>
                    <h2 class=" font-weight-bold mb-4">
                        <span>Content Blog</span>
                    </h2>
                </div>';

        foreach ($data as $blog) {
            $blogdata = explode("/", $blog);

            $id = $blogdata[0];
            $blogname = trim($blogdata[1],'"');
            $blogmessage = trim($blogdata[2],'"');
            $username = trim($blogdata[3],'"');
            $time = trim($blogdata[4],'"');

            if(strlen($blogmessage) > 1300) {
                $newblogname = substr($blogmessage,0,1300) . ' <span style="color:blue;">อ่านต่อ...</span>';
                $blogmessage = $newblogname;
            }


            echo '

                        <a href="blog.php?id=' . $id . '" style="text-decoration: none; color: inherit;">
                            <div class="blog-card p-4">
                                <h5 class="blog-title">
                                    ' . htmlspecialchars($blogname) . '
                                </h5>
                                <h6 class="blog-subtitle"><i class="fas fa-user mr-1"></i> ' . htmlspecialchars($username) . ' - <i class="far fa-clock mr-1"></i> ' . htmlspecialchars($time) . '</h6>
                                <p class="blog-content">' . $blogmessage . '</p>
                            </div>
                        </a>
                    ';
        }
        ?>
    </div>

    <footer>
        <p class="mb-2">Follow us on:</p>
        <a href="https://facebook.com"><i class="fab fa-facebook-f"></i></a>
        <a href="https://twitter.com"><i class="fab fa-twitter"></i></a>
        <a href="https://instagram.com"><i class="fab fa-instagram"></i></a>
    </footer>
</body>