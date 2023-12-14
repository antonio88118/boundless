<?php
require_once("boundless_connect.php");

$sql="SELECT id, created_time, onshelf_time FROM lesson";
$result=$conn->query($sql);
$rows=$result->fetch_all(MYSQLI_ASSOC);

foreach($rows as $row){
    $id = $row["id"];
    $created_time=strtotime($row["created_time"]);
    $onshelf_time=strtotime($row["onshelf_time"]);
    if($created_time>$onshelf_time){
        
        // 我的時間範圍設定created_time是 2023-11-30 00:00:00 ~ 2023-12-8 23:59:59，日期相差9天
        // 因為+9天之後必然會超過原本的時間範圍（變成12-09 ~ 12-17），所以新設的onshelf_time必然比created_time大
        $newTime=date("Y-m-d H:i:s", strtotime("+9 day", $onshelf_time));

        // 更改資料前先echo一次，確定時間如自己想的變動，可用id確認是哪一筆資料
        // echo $row["id"].":".$newTime."<br>";
        $sql="UPDATE lesson SET onshelf_time = '$newTime' WHERE id = $id";
        
        if($conn->query($sql) === FALSE){
            // 畫面空白表示成功
            echo "更新失敗:".$conn->error;
        }
    }
}

$conn->close();
?>

<!-- 先檢查第一次提取資料（第一個$sql）是否成功 -->
<!-- <pre>
    <?php print_r($rows); ?>
</pre> -->