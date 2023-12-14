<?php
require_once("boundless_connect.php");

if (!isset($_GET["id"])) {
    echo "請循正常管道進入本頁面。";
    exit;
}

$id = $_GET["id"];

$sql = "UPDATE users SET valid='0' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
    echo header("location: user-edit.php?id=$id");
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

$conn->close();

header("location: deleteUserSuccess.php");
