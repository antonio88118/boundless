<?php
if(!isset($_POST["id"])){
    echo "請循正常管道上架";
    // header("location: instrument-list.php");
    // exit;
}
require_once("boundless_connect.php");
session_start();
$id=$_POST["id"];

$now=date("Y-m-d H:i:s");
$onshelf_time=date("Y-m-d H:i:s");

// 儲存編輯資料
$sql="UPDATE instrument SET updated_time='$now', onshelf_time='$onshelf_time' WHERE id=$id";

if($conn->query($sql) === TRUE){
    $_SESSION["success"]["message"]="上架成功！";
    header("location: instrument-detail.php?id=$id");
} else {
    echo "資料更新失敗".$conn->error;
}

$conn->close();
?>