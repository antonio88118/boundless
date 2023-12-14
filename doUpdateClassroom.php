<?php
require_once("boundless_connect.php");

if (!isset($_POST["name"])) {
    echo "請循正常管道進入此頁";
    exit;
}

$id = $_POST["id"];
$name = $_POST["name"];
$price = $_POST["price"];
$region = $_POST["region"];
$address = $_POST["address"];
$phone = $_POST["phone"];
$email = $_POST["email"];
echo $name, $price, $region, $address, $phone, $email;

$sql = "UPDATE classroom SET name='$name', 
price='$price',region_id='$region', address='$address',phone='$phone',email='$email' WHERE id=$id";


if ($conn->query($sql) === TRUE) {
    // echo "更新成功";
} else {
    echo "更新資料錯誤: " . $conn->error;
}

$conn->close();

header("location: classroom-detail.php?id=$id");
