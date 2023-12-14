<?PHP
require_once("boundless_connect.php");

session_start();

if (!isset($_POST["email"])) {
    echo "請循正常管道進入此頁";
    die;
}

$email = $_POST["email"];
$name = $_POST["name"];
$password = $_POST["password"];
$repassword = $_POST["repassword"];

// -------------------------------------------------------------------------------------------
if (empty($email)) {
    $message = "請填入您的e-mail。";

    $_SESSION["error"]["message"] = $message;
    header("location:signUpRegister.php");
    die;
}
if (empty($name)) {
    $message = "請填入您的姓名。";

    $_SESSION["error"]["message"] = $message;
    header("location:signUpRegister.php");
    die;
}
if (empty($password)) {
    $message = "請填入您的密碼。";

    $_SESSION["error"]["message"] = $message;
    header("location:signUpRegister.php");
    die;
}

if (empty($name) || empty($repassword)) {
    $message = "請輸入必填欄位。";

    $_SESSION["error"]["message"] = $message;
    header("location:signUpRegister.php");
    die;
}

// ----------------註冊新增----------------------------------------------------------
if ($password != $repassword) {
    $message = "前後密碼不相同。";

    $_SESSION["error"]["message"] = $message;
    header("location:signUpRegister.php");
    die;
}

// ----------------GPT說的-------------------------------------------------------------
// if ($conn->query("email") == 1) {
//     $message = "電子郵件已重複申請。";

//     $_SESSION["error"]["message"] = $message;
//     header("location:signUpRegister.php");
//     die;
// }

// ----------------ChatGPT說的-------------------------------------------------------------
$checkEmailQuery = "SELECT * FROM users WHERE email='$email'";
$resultEmailCheck = $conn->query($checkEmailQuery);

if ($resultEmailCheck->num_rows > 0) {
    // 如果已存在相同的 email，显示消息并中止操作
    $message = "電子郵件已存在。";

    $_SESSION["error"]["message"] = $message;
    header("location:signUpRegister.php");
    die;
}


$password = md5($password);


$time = date('y-m-d H:i:s');
$sql = "INSERT INTO users (name, password, email, created_time, valid)
VALUES ('$name', '$password', '$email', '$time', 1)";
// echo $sql;
// die($sql);

if ($conn->query($sql) === TRUE) {
    echo "新增資料完成,";
    $last_id = $conn->insert_id;
    echo "最新一筆為序號" . $last_id;
    header("location: login.php");
} else {
    echo "新增資料錯誤: " . $conn->error;
    header("location: signUpRegister.php");
}

$conn->close();
