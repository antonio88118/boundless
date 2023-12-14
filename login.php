<?PHP
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>登入頁面</title>

  <!-- Custom fonts for this template-->

  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-gradient-dark">
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block text-center pt-5">
                <img src="./user_img/login.jpg" class="w-50 h-auto">
              </div>
              <div class="col-lg-6 p-5">


                <div class="text-center">
                  <!-- -----------------logo---------------------------------- -->
                  <span class="sidebar-brand d-flex align-items-center justify-content-center text-decoration-none fs-3">
                    <div class="sidebar-brand-icon rotate-n-15">
                      <i class="fa-solid fa-music"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">Boundless</div>
                  </span>
                  <hr class="sidebar-divider">
                  <h1 class="h4 text-gray-900 mb-4">登入</h1>
                </div>
                <form class="user" action="doLogin.php" method="post">
                  <div class="form-group">
                    <input type="email" class="form-control form-control-user" id="email" placeholder="請輸入電子郵件..." name="email" />
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" id="password" placeholder="輸入密碼..." name="password" />
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                      <input type="checkbox" class="custom-control-input" id="customCheck" />
                      <!-- <label class="custom-control-label" for="customCheck">記住我</label> -->
                    </div>
                  </div>
                  <hr />

                  <div class="text-danger"><?php if (isset($_SESSION["error"]["message"])) echo $_SESSION["error"]["message"] ?> </div>

                  <div class="text-center row py-4">
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-dark">登入</button>
                      </a>
                    </div>
                    <div class="col-md-4  ">
                      <a class="btn btn-primary py-2 text-white" href="signUpRegister.php">創建帳號</a>
                    </div>
                  </div>

                  <!-- <hr />
                  <a href="index.html" class="btn btn-google btn-user btn-block">
                      <i class="fab fa-google fa-fw"></i> Login with Google
                    </a>
                    <a href="index.html" class="btn btn-facebook btn-user btn-block">
                      <i class="fab fa-facebook-f fa-fw"></i> Login with
                      Facebook
                    </a> -->
                </form>
                <!-- <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div> -->
                <!-- <div class="text-center">
                    <a class="btn btn-dark small" href="register.php">創建帳號</a>
                  </div> -->

              </div>
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