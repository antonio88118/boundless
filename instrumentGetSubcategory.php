<?php
require_once("boundless_connect.php");

if(!isset($_POST["category_id"])){
    $data = [
        "status" => 0,
        "message" => "錯誤"
    ];
    echo json_encode($data);
    exit;
}

$category_id = $_POST["category_id"];

$sql= "SELECT * FROM instrument_subcategory WHERE category_id = $category_id AND valid=1";
$result=$conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

if($result->num_rows>0){
    $data = [
        "status" => 1,
        "data" => $rows
    ];
}else{
    $data = [
        "status" => 0,
        "message" => "資料抓取失敗"
    ];
    echo json_encode($data);
    exit;
}

echo json_encode($data);

$conn->close();
?>