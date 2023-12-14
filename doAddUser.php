<?PHP
require_once("boundless_connect.php");

if (!isset($_POST["name"])) {
    echo "請循正常管道進入本頁面。";
    die;
}

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$time = date('Y-m-d H:i:s');


if (empty($name) || empty($email) || empty($password) || empty($phone) || empty($address)) {
    echo "請輸入資料。";
    die;
}

$sql = "INSERT INTO users (name, password, phone, email, address, created_time, valid )
VALUES ('$name', '$password', '$phone', '$email', '$address', '$time', 1)";

if ($conn->query($sql) === TRUE) {
    echo "新增資料完成,";
    $last_id = $conn->insert_id;
    echo "最新一筆為序號" . $last_id;
} else {
    echo "新增資料錯誤: " . $conn->error;
}

$conn->close();


header("location: user-list.php");
