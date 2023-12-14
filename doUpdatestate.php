<?php 

require_once("boundless_connect.php");

if(!isset($_GET["id"])){
    echo "請循正常管道進入修改";
    exit;
}

$id=$_GET["id"];
$state=$_GET["state"];

$sql="UPDATE instrument_order SET transportation_state=$state WHERE orderID=$id";

if($conn->query($sql) === TRUE){
    echo "資料修改成功!";
    header("Refresh:2; url=http://localhost/boundless/order_edit.php?id=$id", true, 303);
} else {
    echo "資料更新失敗";
    $conn->error;
}

$conn->close();
?>