<?php
require_once("boundless_connect.php");
session_start();

$name=$_POST["name"];
$price=$_POST["price"];
$stock=$_POST["stock"];
$brand=$_POST["brand"];
$category=$_POST["category"];
$subcategory=$_POST["subcategory"];
$onshelf_time=$_POST["onshelf_time"];
$now=date("Y-m-d H:i:s");
$info=$_POST["info"];

// 取得母類別、子類別名稱，用於圖片資料移動
$sql="SELECT * FROM instrument_category WHERE id=$category";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$category_name=$row["name"];

$sql="SELECT * FROM instrument_subcategory WHERE id=$subcategory";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$subcategory_name=$row["name"];

if(empty($name) || empty($price) || empty($stock) || empty($onshelf_time)){
    $message="請輸入必填欄位";
    $_SESSION["error"]["message"]=$message;
    header("location: instrument-add.php");
    exit;
}
// 檢查上架時間
if(strtotime($onshelf_time) < strtotime($now)){
    $message="上架時間不得晚於目前時間";
    $_SESSION["error"]["message"]=$message;
    header("location: instrument-add.php");
    exit;
}

// 圖片上傳
if($_FILES["image"]["error"]==0){
    // 判斷是否可操作檔案
    if(is_uploaded_file($_FILES['image']['tmp_name'])){
        $targetFilePath = "./instrument_images/".$category_name."/".$subcategory_name."/".$_FILES["image"]["name"];
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
        $image = $_FILES["image"]["name"];
        
        // 儲存編輯資料
        $sql="INSERT INTO instrument (name, price, stock, brand_id, category_id, subcategory_id, onshelf_time, created_time, img, info)
        VALUES ('$name', $price, $stock, $brand, $category, $subcategory, '$onshelf_time', '$now', '$image', '$info')";

            if($conn->query($sql) === TRUE){
                $last_id=$conn->insert_id;
                header("location: instrument-detail.php?id=$last_id");
            } else {
                echo "新增商品失敗".$conn->error;
            }

        }else{
            echo "圖片上傳失敗".$_FILES["image"]["tmp_name"]."<br>".$_FILES["image"]["name"];
        }
    }else{
        echo "檔案無法操作".$_FILES["image"]["tmp_name"];
    }
}

$conn->close();
?>