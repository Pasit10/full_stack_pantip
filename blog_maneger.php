<?php
    // ระบุชื่อไฟล์
    $file = 'data/blog.csv';

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

    function createBlog($blogname,$blogmessage,$username):bool{
        $fs = fopen("data/blog.csv","a");
        if ($fs) {
            $lines = file("data/blog.csv");
            $lastid = 0;
            if (sizeof($lines) > 0) {
                $lastid = sizeof($lines);
            }
            $id = $lastid + 1;
            $time = date("Y-M-d H:i:s");
            $data = [$id, $blogname, $blogmessage, $username, $time];
            fputcsv($fs, $data,"/");
            fclose($fs);
        } else {
            echo "<p style='color:red;'>Error: Cannot open file for writing.</p>";
        }
        return true;
    }

    function getAllBlog(): array {
        $blog = file("data/blog.csv");
        if ($blog === false) {

            return [];
        }
        return $blog;
    }
?>