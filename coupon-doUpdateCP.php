<?php
require_once("boundless_connect.php");

if(!isset($_POST["name"])){
    echo "請循正常管道進入此頁";
    exit;
}


$id=$_POST["id"];
$name=$_POST["name"];
$kind=$_POST["kind"];
$discount=$_POST["discount"];
$type=$_POST["type"];
// $coupon_code=$_POST["coupon_code"];
$status=$_POST["status"];
$requirement=$_POST["requirement"];
$usage_counter=$_POST["usage_counter"];
// 時間格式想想   
$onshelf_time=$_POST["onshelf_time"];
$limit_time=$_POST["limit_time"];
$time=date('Y-m-d H:i:s');



if(!isset($name) || !isset($kind) || !isset($discount) || !isset($onshelf_time) || !isset($type) || !isset($status) || !isset($requirement) || !isset($usage_counter) || !isset($limit_time)){
    echo "請輸入全部資料。";
    die;
}

// if(empty($name) || empty($discount) || empty($kind) || empty($onshelf_time) || empty($type) || empty($status) || empty($requirement) || empty($usage_counter) || empty($limit_time)){
//     echo "請輸入全部資料。";
//     die;
// }

// echo "$name,$discount, $kind ,$type, $coupon_code, $status, $requirement, $usage_counter, $time, $onshelf_time, $limit_time";

$sql="UPDATE coupon SET name='$name', kind='$kind', discount='$discount', type='$type', status='$status', requirement='$requirement', usage_counter='$usage_counter', onshelf_time='$onshelf_time',limit_time='$limit_time'  WHERE id=$id";

// echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "更新成功";
    // echo header("location: coupon-edit.php?id=$id");
} else {
    echo "更新資料錯誤: " . $conn->error;
}

$conn->close();

header("location: coupon.php?id=$id");
?>

