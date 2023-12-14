<?PHP
require_once("boundless_connect.php");
session_start();

$email = $_POST["email"];
$password = $_POST["password"];

if (!isset($_POST["email"])) {
    echo "請循正常路徑進入此頁面。";
    die;
}

// ----------------登入相關----------------------------------------------------------

if (empty($email)) {
    $message = "請填入您的e-mail。";

    $_SESSION["error"]["message"] = $message;
    header("location:login.php");
    die;
}
if (empty($password)) {
    $message = "請填入您的密碼。";

    $_SESSION["error"]["message"] = $message;
    header("location:login.php");
    die;
}

if (empty($email) && empty($password)) {
    $message = "請輸入必填欄位。";

    $_SESSION["error"]["message"] = $message;
    header("location:login.php");
    die;
}


$password = md5($password);

$sql = "SELECT id, name, email, phone FROM users WHERE email='$email' AND password = '$password' AND valid=1";

$result = $conn->query($sql);

if ($result->num_rows == 0) {

    $message = "帳號或密碼錯誤。";
    $_SESSION["error"]["message"] = $message;
    header("location:login.php");
    die;
}

// 原先登入失敗是因為帳號已經被軟刪除了!!
// echo "登入成功";

$row = $result->fetch_assoc();
$_SESSION["users"] = $row;

//清除錯誤紀錄次數
unset($_SESSION["error"]);


// var_dump($row);

$conn->close();

header("location:useLoginrSuccess.php");
