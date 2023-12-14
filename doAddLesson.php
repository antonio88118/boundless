<?php
require_once("boundless_connect.php");

if(!isset($_POST["name"])){
    echo "請循正常管道進入";
    die;
}

$name=$_POST["name"];
$price = $_POST["price"];
$category_id = $_POST["category_id"];
$classroom_id = $_POST["classroom_id"];
$teacher_id = $_POST["teacher_id"];
$info= $_POST["info"];
$now=date("Y-m-d H:i:s");
//echo "$name, $price, $category_id, $classroom_id, $teacher_id, $img, $info";

// $sql="INSERT INTO lesson (name, price, category_id, classroom_id, teacher_id, img, info, valid) VALUES ('$name', '$price', '$category_id','$classroom_id' ,'$teacher_id','$img', '$info', 1)";

// if($conn->query($sql) === TRUE){
//     header("location: lesson-list.php");
// }else {
//     echo "新增課程錯誤" . $conn->error;
// }

// 圖片上傳
if ($_FILES["img"]["error"] == 0) {
    // 判斷是否可操作檔案
    if (is_uploaded_file($_FILES['img']['tmp_name'])) {
        $targetFilePath = "./lesson_img/" . $_FILES["img"]["name"];
        if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFilePath)) {
            $image = $_FILES["img"]["name"];

            // 儲存編輯資料
            $sql = "INSERT INTO lesson (name, price, category_id, classroom_id, teacher_id, img, info, created_time, valid)
        VALUES ('$name', $price, $category_id, $classroom_id, '$teacher_id','$image', '$info', '$now', 1)";

            if ($conn->query($sql) === TRUE) {
                $last_id = $conn->insert_id;
                header("location: lesson-info.php?id=$last_id");
            } else {
                echo "新增商品失敗" . $conn->error;
            }
        } else {
            echo "圖片上傳失敗" . $_FILES["img"]["tmp_name"] . "<br>" . $_FILES["img"]["name"];
        }
    } else {
        echo "檔案無法操作" . $_FILES["img"]["tmp_name"];
    }
}



$conn->close();

?>