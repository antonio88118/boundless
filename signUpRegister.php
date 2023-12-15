<?PHP
require_once("boundless_connect.php");

session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>註冊帳號</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="icon" href="favicon.svg">
</head>

<body class="bg-gradient-dark">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block text-center">
                        <img src="./user_img/user.jpg" class=" w-70 h-auto">
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <!-- -----------------logo---------------------------------- -->
                                <span class="sidebar-brand d-flex align-items-center justify-content-center text-decoration-none fs-3">
                                    <div class="sidebar-brand-icon rotate-n-15">
                                        <i class="fa-solid fa-music"></i>
                                    </div>
                                    <div class="sidebar-brand-text mx-3">Boundless</div>
                                </span>
                                <hr class="sidebar-divider">
                                <h1 class="h4 text-gray-900 mb-4">註冊帳號</h1>
                            </div>
                            <form action="doSignUp.php" method="post">
                                <div class=" form-group">
                                    <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="電子郵件">
                                </div>
                                <div class="form-group row">
                                    <!-- <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="姓氏">
                                    </div> -->
                                    <div class="col">
                                        <input type="name" class="form-control form-control-user" id="name" name="name" placeholder="姓名">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 ">
                                        <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="密碼">
                                    </div>
                                    <div class="col-sm-12 mb-3">
                                        <input type="password" class="form-control form-control-user" id="repassword" name="repassword" placeholder="確認密碼">
                                    </div>
                                </div>

                                <div class="text-center row py-2">

                                    <div class="text-danger"><?php if (isset($_SESSION["error"]["message"])) echo $_SESSION["error"]["message"] ?> </div>

                                    <hr />
                                    <div class="col-md-4 py-4">
                                        <a class="btn btn-primary btn-block  text-center" href="login.php">請由此登入</a>
                                    </div>
                                    <div class="col-2"></div>
                                    <div class="col-md-6  py-4">
                                        <button type="submit" class="btn btn-dark btn-block">
                                            註 冊
                                        </button>
                                    </div>
                                </div>


                                <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                    <i class="fab fa-google fa-fw"></i> Register with Google
                                </a>
                                <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                    <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                                </a> -->
                            </form>
                            <div class="text-center">
                                <!-- <a class="small text-decoration-none" href="user-list.php">
                                    已擁有帳號?查看使用者清單?
                                </a>
                                <hr> -->
                                <!-- <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.html">Already have an account? Login!</a>
                            </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?php unset($_SESSION["error"]["message"]) ?>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

</body>

</html>