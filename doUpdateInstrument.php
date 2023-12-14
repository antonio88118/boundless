<?php
require_once("boundless_connect.php");

if (!isset($_POST["id"])) {
    echo "請循正常管道編輯";
    exit;
}
$id = $_POST["id"];
$name = $_POST["name"];
$price = $_POST["price"];
$stock = $_POST["stock"];
$subcategory = $_POST["subcategory"];
$info = $_POST["info"];
$now = date("Y-m-d H:i:s");

// 若修改子類別，以我存圖片的方式「類別/子類別/圖片」來說，會因為子類別改變而找不到圖片檔，因此需要下面這段程式碼移動圖片到另一個資料夾。
// 取得目前商品的類別跟子類別名稱
$getAllSql = "SELECT instrument.img, instrument_category.name AS category_name, 
instrument_subcategory.id AS subcategory_id, instrument_subcategory.name AS subcategory_name FROM instrument
JOIN instrument_category ON instrument.category_id=instrument_category.id
JOIN instrument_subcategory ON instrument.subcategory_id=instrument_subcategory.id
WHERE instrument.id=$id";
$getAllResult = $conn->query($getAllSql);
$getAllRow = $getAllResult->fetch_assoc();

// 取得子類別資料，用於指定檔案目錄
$sqlGetSub = "SELECT * FROM instrument_subcategory WHERE id=$subcategory";
$getSubResult = $conn->query($sqlGetSub);
$getSubRow = $getSubResult->fetch_assoc();

$category_name = $getAllRow["category_name"]; // 母類別
$old_subcategory_name = $getAllRow["subcategory_name"]; // 舊的子類別
$img_name = $getAllRow["img"]; // 圖片檔案名稱
$new_subcategory_name = $getSubRow["name"]; // 新的子類別
// 使用rename()移動檔案
$current = "./instrument_images/" . $category_name . "/" . $old_subcategory_name . "/" . $img_name; // 原本的位置
$new = "./instrument_images/" . $category_name . "/" . $new_subcategory_name . "/" . $img_name; // 移動後的位置

// 若沒有傳圖片，並且有改變子類別，則移動檔案
if (($_FILES["image"]["error"] == 4) && ($getAllRow["subcategory_id"] != $subcategory)) {
    // 檔案存在且可寫，執行移動操作
    if (is_file($current) && is_writable($current)) {
        // 儲存編輯資料
        $sql = "UPDATE instrument SET name='$name', price=$price, stock=$stock, subcategory_id=$subcategory, info='$info', updated_time='$now' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            header("location: instrument-detail.php?id=$id");
        } else {
            echo "資料更新失敗" . $conn->error;
        }
        if (rename($current, $new) === FALSE) {
            echo "移動失敗";
            print_r(error_get_last());
            exit;
        }
    } else {
        echo "檔案不存在或不可寫";
        exit;
    }
// 若有上傳圖片
} elseif ($_FILES["image"]["error"] == 0) {
    // 判斷是否可操作檔案
    if (is_uploaded_file($_FILES['image']['tmp_name'])) {
        $targetFilePath = "./instrument_images/" . $category_name . "/" . $new_subcategory_name . "/" . $_FILES["image"]["name"];
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $image = $_FILES["image"]["name"];
            // 刪除舊圖片，先檢查檔案是否存在
            if (file_exists($current)) {
                unlink($current);
                $sql = "UPDATE instrument SET name='$name', price=$price, stock=$stock, subcategory_id=$subcategory, img='$image', info='$info', updated_time='$now' WHERE id=$id";
                if ($conn->query($sql) === TRUE) {
                    header("location: instrument-detail.php?id=$id");
                } else {
                    echo "新增商品失敗" . $conn->error;
                }
            } else {
                echo "檔案不存在";
            }
        } else {
            echo "圖片上傳失敗" . $_FILES["image"]["tmp_name"] . "<br>" . $_FILES["image"]["name"];
        }
    } else {
        echo "檔案無法操作" . $_FILES["image"]["tmp_name"];
    }
} else {
    $sql = "UPDATE instrument SET name='$name', price=$price, stock=$stock, subcategory_id=$subcategory, info='$info', updated_time='$now' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("location: instrument-detail.php?id=$id");
    } else {
        echo "資料更新失敗" . $conn->error;
    }
}



$conn->close();
?>