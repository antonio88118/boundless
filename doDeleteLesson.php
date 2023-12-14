<?php
require_once("boundless_connect.php");

if (!isset($_GET["id"])) {
    echo "請循正常管道進入此頁";
    exit;
}

$id = $_GET["id"];
//user-edit需要修改為
//href="doDeleteUser.php?id=<?= $row["id"]
$sql = "UPDATE lesson SET valid='0' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header("location: lesson-list.php");
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

$conn->close();
