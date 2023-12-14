<?PHP
require_once("boundless_connect.php");

if(!isset($_GET["id"])){
    echo "請遵循正常管道進入此頁面。";
}

$id=$_GET["id"];


//此為軟刪除 ,可透過資料庫id修改復原
//可以想辦法加入軟刪除的時間
$sql="UPDATE coupon SET valid='0'  WHERE id=$id";

// 測試連結
// echo $sql;
// die;

if ($conn->query($sql) === TRUE) {
    echo "刪除成功";
} else {
    echo "刪除資料錯誤: " . $conn->error;
}

$conn->close();

header("location:coupons-list.php");
?>