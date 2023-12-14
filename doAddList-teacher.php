<?php
require_once("boundless_connect.php");

if(!isset($_POST["name"])){
    echo "請循正常管道進入";
    die;
}

$name=$_POST["name"];
$img = $_POST["img"];
$info= $_POST["info"];
$email = $_POST["email"];
//echo "$name, $price, $category_id, $classroom_id, $teacher_id, $img, $info";

$sql="INSERT INTO teacher_info (name, img, info, email) VALUES ('$name', '$img', '$info','$email')";

if($conn->query($sql) === TRUE){
    echo "新增課程完成";
    header("location: teacher-list.php");
}else {
    echo "新增課程錯誤" . $conn->error;
}

$conn->close();

?>