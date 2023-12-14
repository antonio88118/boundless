<?php
require_once("boundless_connect.php");

if(!isset($_GET["id"])){
    echo "請循正常管道刪除";
    exit;
}

$id=$_GET["id"];

$sql="UPDATE instrument_category SET valid=0 WHERE id=$id";

if($conn->query($sql) === TRUE){
    echo "刪除成功";
    header("Refresh: 2; url=instrument_category_list.php", true, 303);
}else{
    echo "刪除失敗";
    $conn->error;
}

$conn->close();
?>