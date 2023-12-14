<?php
require_once("boundless_connect.php");

if (!isset($_POST["id"])) {
    echo "請循正常管道進入本頁面。";
    exit;
}

$id = $_POST["id"];

$sql = "UPDATE article SET valid='0' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
    echo header("location: article-edit.php?id=$id");
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

$conn->close();

header("location: article-list.php");

