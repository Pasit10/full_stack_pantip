<?php
    function createCommentFile($blogid) {
        $file = "data/comment_blog/".$blogid.".csv";

        // ตรวจสอบว่าไฟล์มีอยู่หรือไม่
        if (!file_exists($file)) {
            // พยายามสร้างไฟล์
            if (touch($file)) {
                // เปลี่ยนสิทธิ์ของไฟล์เป็น 0666 (ให้ผู้ใช้ทุกคนสามารถอ่านและเขียน)
                chmod($file, 777);
                echo "File created and permissions set to 0666.<br>";
            } else {
                echo "Failed to create the file. Please check directory permissions.<br>";
            }
        }
        return;
    }

    function addComment($blogid, $comment, $username):bool {
        $filepath = "data/comment_blog/$blogid.csv";
        $fs = fopen($filepath,"a");
        if($fs){
            $line = file($filepath);
            $lastid = 0;
            if (sizeof($line) > 0) {
                $lastid = sizeof($line);
            }
            $id = $lastid + 1;
            $time = date("Y-m-d H:i:s");
            $data = [$id,$comment,$username,$time];
            fputcsv($fs,$data,"/");
            fclose($fs);
        }else {
            echo "<p style='color:red;'>Error: Cannot open file for writing.</p>";
        }
        return true;
    }

    function getCommentByBlogID($blogid) {
        $filepath = "data/comment_blog/$blogid.csv";
        $comment = file($filepath);
        if ($comment === false) {
            return [];
        }
        return $comment;
    }
?>

<!-- function getAllBlog(): array {
        $blog = file("data/blog.csv");
        if ($blog === false) {
            return [];
        }
        return $blog;
    } -->