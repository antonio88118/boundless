<?php
require_once("boundless_connect.php");

if(!isset($_POST["id"])){
    echo "請循正常管道刪除";
    exit;
}

$id=$_POST["id"];
$sql="UPDATE instrument SET valid=0 WHERE id=$id";

if($conn->query($sql) === TRUE){
    header("location: deleteInstrumentSuccess.html");
} else {
    echo "資料刪除失敗";
    $conn->error;
}

$conn->close();
?>