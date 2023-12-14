<?php
$servername = "localhost";
$username = "admin";
$password = "12345";
$dbname = "boundless_db";
    
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// 檢查連線
// -> :存取物件本身的屬性或方法
if ($conn->connect_error) {
  	die("連線失敗: " . $conn->connect_error);
}
?>