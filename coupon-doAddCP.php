<?php
require_once("boundless_connect.php");
session_start();

if(!isset($_POST["name"])){
    echo "請遵循正常管道進入本頁面。";
    die;
}

$name=$_POST["name"];
$discount=$_POST["discount"];
$kind=$_POST["kind"];
$type=$_POST["type"];
$coupon_code=$_POST["coupon_code"];
$status=$_POST["status"];
$requirement=$_POST["requirement"];
$usage_counter=$_POST["usage_counter"];
// 時間格式想想   
$onshelf_time=$_POST["onshelf_time"];
$limit_time=$_POST["limit_time"];
$time=date('Y-m-d H:i:s');

if(!isset($name) || !isset($kind) || !isset($discount) || !isset($onshelf_time) || !isset($type) || !isset($coupon_code) || !isset($status) || !isset($requirement) || !isset($usage_counter) || !isset($limit_time)){
    echo "請輸入全部資料。";
    die;
}

//檢查代碼是否存在,存在會顯示1 不存在顯示0
$sql="SELECT * FROM coupon WHERE coupon_code='$coupon_code'";
$result=$conn->query($sql);
$rowCount=$result->num_rows;
// echo $rowCount;
if($rowCount>0){
    $message = "代碼已存在，請重新產生";
    $_SESSION["error"]["message"]=$message;
    header("location: coupon-addCP.php");
    exit;
}



// 修改了 因為輸入0會被排除 故改用上面!isset

// if(empty($name) || empty($kind) || empty($discount) || empty($onshelf_time) || empty($type) || empty($coupon_code) || empty($status) || empty($requirement) || empty($usage_counter) || empty($limit_time)){
//     echo "請輸入全部資料。";
//     die;
// }

// echo "$name,$discount,$type, $coupon_code, $status, $requirement, $usage_counter, $time, $onshelf_time, $limit_time";

$sql="INSERT INTO coupon (name, kind, discount, type, coupon_code, status, requirement, usage_counter, created_time, onshelf_time, limit_time, valid)
VALUES ('$name', '$kind', '$discount', '$type', '$coupon_code', '$status', '$requirement', '$usage_counter', '$time', '$onshelf_time', '$limit_time', 1)";
// echo $sql;
// die;

if ($conn->query($sql) === TRUE) {
    echo "新增資料完成,";
    $last_id = $conn->insert_id;    
    echo "最新一筆為序號".$last_id;
} else {
    echo "新增資料錯誤: " . $conn->error; 
}

// 關閉
$conn->close();  

// 導回頁面
header("location: coupons-list.php");

?>