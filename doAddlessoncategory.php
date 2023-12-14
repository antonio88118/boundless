<?php
require_once("boundless_connect.php");

if(!isset($_GET["name"])){
    echo "請循正常管道進入";
    die;
}

$name=$_GET["name"];

if(empty($name)){
    echo "請輸入完整資料";
    die;
}

$sql="INSERT INTO lesson_category (name, valid) VALUES ('$name', 1);";

if($conn->query($sql) === TRUE){
    echo "新增資料完成，";
    $last_id=$conn->insert_id;
    echo "最新資料序號: ".$last_id;
}else {
    echo "新增資料錯誤:".$conn->error;
}

$conn->close();

// 跳轉至add-user.php(表單)
header("location: lesson_category_list.php");
?>