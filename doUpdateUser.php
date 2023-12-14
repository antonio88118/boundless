<?php
require_once("boundless_connect.php");

if (!isset($_POST["id"])) {
    echo "請循正常管道進入此頁";
    exit;
}

$id = $_POST["id"];
$name = $_POST["name"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$time = date('Y-m-d H:i:s');

$password = md5($password);
$sql = "UPDATE users SET name='$name', phone='$phone', address='$address',updated_time='$time'  WHERE id=$id";

if ($conn->query($sql) === TRUE) {

    echo header("location: user-edit.php?id=$id");
} else {
    echo "更新資料錯誤: " . $conn->error;
}

$conn->close();

header("location: user.php?id=$id");
