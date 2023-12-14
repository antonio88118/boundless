<?php
require_once("boundless_connect.php");

if(!isset($_POST["name"])){
    echo "請循正常管道進入";
    die;
}

$id=$_POST["id"];
$name=$_POST["name"];
$price = $_POST["price"];
$category_id = $_POST["category_id"];
$classroom_id = $_POST["classroom_id"];
$teacher_id = $_POST["teacher_id"];
$img = $_POST["img"];
$info= $_POST["info"];
//echo "$name, $price, $category_id, $classroom_id, $teacher_id, $img, $info";

$sql="UPDATE lesson SET name='$name', price='$price', category_id='$category_id', classroom_id='$classroom_id', teacher_id='$teacher_id', img= '$img', info= '$info' WHERE id='$id'";
//WHERE id='$id'"確保不會儲存所有的row["id"]

if($conn->query($sql) === TRUE){
    header("location: lesson-list.php");
}else {
    echo "更新課程錯誤" . $conn->error;
}

$conn->close();

?>