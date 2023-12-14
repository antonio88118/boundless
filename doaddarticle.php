<?php

require_once("boundless_connect.php");

mysqli_query($conn, "SET NAMES 'utf8'");
if(!isset($_POST["title"])){
    echo "請循正常管道進入";
    die;
}

$title=$_POST["title"];
$content=$_POST["content"];
// $img=$_POST["filename"];
// $category_id=$_FILES["file"];
$category_id=$_POST["category_id"];
$time=date('Y-m-d H:i:s');

// 圖片上傳
if($_FILES["image"]["error"]==0){
    // 判斷是否可操作檔案
    if(is_uploaded_file($_FILES['image']['tmp_name'])){
        $targetFilePath = "./article_images/".$category_id."/".$_FILES["image"]["name"];
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
        $image = $_FILES["image"]["name"];
        
        // 儲存編輯資料
        $sql="INSERT INTO article (title, content, img, category_id, created_time, author_id, valid)
        VALUES ('$title', '$content', '$image', '$category_id', '$time', 1, 1)";

// if($_FILES["file"]["error"]==0)
//     if(move_uploaded_file($_FILES["file"]["tmp_name"], "borderless/article_images/$category_id/".$_FILES["file"]["name"])){
//         // echo "上傳成功";

//         $filename=$_FILES["file"]["name"];
//         // $imageData = file_get_contents("borderless/article_images/$category_id/" . $_FILES["file"]["name"]); // 讀取圖片二進位資料
//     }
   
// $sql="INSERT INTO article (title, content, img, category_id, created_time, author_id, valid) VALUES ('$title', '$content', '$filename', '$category', '$time', 1, 1)";

// echo $sql;
if ($conn->query($sql) === TRUE) {
        echo "新增資料完成, ";
        $last_id = $conn->insert_id;
        echo "最新一筆為序號".$last_id;
    } else {
        echo "新增資料錯誤: " . $conn->error;
    }
}else{
    echo "圖片上傳失敗".$_FILES["image"]["tmp_name"]."<br>".$_FILES["image"]["name"];
}
}else{
echo "檔案無法操作".$_FILES["image"]["tmp_name"];
}
}  
    $conn->close();

    header("location: article-list.php");



// if(empty($title) || empty($content)){
//     echo "請輸入資料";
//     die;
// }

// $sql="INSERT INTO article (title, content, img, created_time, author_id, valid) VALUES ('$title', '$content', '$filename', '$time', 1, 1)";
// // echo $sql;
// // exit;

// if ($conn->query($sql) === TRUE) {
//     echo "新增資料完成, ";
//     $last_id = $conn->insert_id;
//     echo "最新一筆為序號".$last_id;
// } else {
//     echo "新增資料錯誤: " . $conn->error;
// }

// $conn->close();

// header("location: article-list.php");
