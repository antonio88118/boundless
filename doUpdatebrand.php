<?php 
require_once("boundless_connect.php");

if(!isset($_GET["name"])){
    echo "請循正常管道進入修改";
    exit;
}

$id=$_GET["id"];
$name=$_GET["name"];

$sql="UPDATE brand SET name='$name' WHERE id=$id";

if($conn->query($sql) === TRUE){
    echo "資料修改成功!";
    header("Refresh:2; url=http://localhost/boundless/brand_edit.php?=$id", true, 303);
} else {
    echo "資料更新失敗";
    $conn->error;
}

$conn->close();
?>
