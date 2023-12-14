<?php
require_once("boundless_connect.php");

if(!isset($_POST["name"])){
    echo "請循正常管道進入";
    die;
}

$id=$_POST["id"];
$name=$_POST["name"];
$img = $_POST["img"];
$info = $_POST["info"];
$email = $_POST["email"];
//echo "$name, $price, $category_id, $classroom_id, $teacher_id, $img, $info";

$sql="UPDATE teacher_info SET name='$name', img='$img', info='$info', email='$email' WHERE id='$id'";
//WHERE id='$id'"確保不會儲存所有的row["id"]

if($conn->query($sql) === TRUE){
    header("location: teacher-list.php");
}else {
    echo "更新課程錯誤" . $conn->error;
}

$conn->close();

?>