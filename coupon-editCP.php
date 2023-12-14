<?PHP

require_once("boundless_connect.php");



//避免直接打網址 沒有帶入ID 直接導向回到優惠券清單
if (!isset($_GET["id"])) {
    header("location:coupon-list.php");
}

$id = $_GET["id"];

$sql = "SELECT * FROM coupon WHERE id=$id AND valid=1";
$result = $conn->query($sql);
//避免網址輸入超過現有ID數量
$couponCount = $result->num_rows;


$row = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Boundless - Coupon-edit</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">



    <!-- Custom styles for this page -->
    <!-- <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->



    <!-- bs5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- bs icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

</head>

<body id="page-top">



    <!-- Modal  -->
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        警告
                    </h1>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">

                    </button>
                </div>

                <div class="modal-body">
                    確認刪除此優惠券?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        取消
                    </button>

                    <!-- 把原本的刪除超連結加過來 刪除type-button -->
                    <a href="coupon-doDeleteCP.php?id=<?= $row["id"] ?>" class="btn btn-danger">
                        確認
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa-solid fa-music"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Boundless</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            
            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="user-list.php">
                    <i class="fa-solid fa-user"></i>
                    <span>會員</span></a>
            </li>

            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="instrument-list.php">
                    <i class="fa-solid fa-guitar"></i>
                    <span>樂器</span>
                </a>
            </li>

            <!-- Nav Item - 折疊式選單 -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span>課程&教師</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="lesson-list.php">課程管理</a>
                        <a class="collapse-item" href="teacher-list.php">教師資訊</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item -->
            <li class="nav-item">
                <a class="nav-link" href="classroom-list.php">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span>場地空間</span></a>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa-solid fa-tags"></i>
                    <span>分類標籤</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">樂器</h6>
                        <a class="collapse-item" href="brand_list.php">品牌</a>
                        <a class="collapse-item" href="instrument_category_list.php">樂器類別</a>
                        
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">課程</h6>
                        <a class="collapse-item" href="lesson_category_list.php">課程</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#orderCollapsePages" aria-expanded="true" aria-controls="collapsePages">
                    <i class="fa-solid fa-check-to-slot"></i>
                    <span>訂單</span>
                </a>
                <div id="orderCollapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="order_list.php">
                            <span>樂器訂單</span>
                        </a>
                        <a class="collapse-item" href="lesson_order_list.php">
                            <span>課程訂單</span>
                        </a>
                        <a class="collapse-item" href="classroom_order_list.php">
                            <span>場地租借訂單</span>
                        </a>
                    </div>
                </div>
            </li>

            <!-- Nav Item -->
            <li class="nav-item active">
                <a class="nav-link" href="coupons-list.php">
                    <i class="fa-solid fa-ticket"></i>
                    <span>優惠券</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="article-list.php">
                    <i class="fa-solid fa-feather-pointed"></i>
                    <span>文章</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->




        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-dark" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>



                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Nue</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="container-top_Nue py-2 d-flex justify-content-start align-items-center">
                        <a class="btn btn-dark " href="coupons-list.php">
                            <i class="bi bi-reply-fill"></i>
                            優惠券清單
                        </a>
                    </div>





                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">優惠券編輯</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <div class="py-2">

                                    </div>

                                    <?PHP if ($couponCount == 0) : ?>
                                        <h1>優惠券不存在。</h1>
                                    <?PHP else : ?>

                                        <!-- 待更新 -->
                                        <form action="coupon-doUpdateCP.php" method="post" id="coupon_form" onsubmit="return checkRequirementValues() && checkDateTime() ">
                                            <input type="hidden" name="id" value="<?= $row["id"] ?>">

                                            <table class="table table-bordered">

                                            

                                                <tr>
                                                    <th>
                                                        優惠券名稱
                                                    </th>
                                                    <td>
                                                        <input type="text" class="form-control" name="name" value="<?= $row["name"] ?>">

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>
                                                        優惠種類
                                                    </th>
                                                    <td>
                                                        <!-- if怎麼優化 kind  -->
                                                        <select class="form-select" for="kind" id="kind" name="kind" aria-label="Default select example">

                                                            <option <?php if ($row["kind"] == 1) : echo "selected"; ?><?php endif; ?> value="1">
                                                                樂器
                                                            </option>
                                                            <option <?php if ($row["kind"] == 2) : echo "selected"; ?><?php endif; ?> value="2">
                                                                課程
                                                            </option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>
                                                        優惠券方式
                                                    </th>


                                                    <td>
                                                        <div class="form-check">
                                                            <!-- if怎麼優化 判斷誰已經被選擇  -->
                                                            <input class="form-check-input" type="radio" name="type" id="type" value="1" <?php if ($row["type"] == 1) : echo "checked"; ?><?php endif; ?>>

                                                            <label class="form-check-label" for="type">
                                                                面額
                                                            </label>
                                                        </div>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="type" id="type" value="2" <?php if ($row["type"] == 2) : echo "checked"; ?><?php endif; ?>>
                                                            <label class="form-check-label" for="type">
                                                                百分比
                                                            </label>
                                                        </div>
                                                        <!-- if優化 -->

                                                    </td>
                                                </tr>




                                                <tr>
                                                    <th>
                                                        折扣幅度
                                                    </th>
                                                    <td>
                                                        <input type="number" class="form-control" id="discount" name="discount" step="0.01" min="0" value="<?= $row["discount"] ?>" required>

                                                    </td>
                                                </tr>

                                                <!-- 為了確保資料庫的優惠券代碼不重複 故不啟用優惠代碼編輯 -->
                                                <!-- <tr>
                                                    <th>
                                                        優惠券代碼
                                                    </th>
                                                    <td>
                                                        <input type="text" class="form-control" id="coupon_code" name="coupon_code" minlength="10" maxlength="10" value="<?= $row["coupon_code"] ?>" required>
                                                    </td>
                                                </tr> -->

                                                <tr>
                                                    <th>
                                                        狀態
                                                    </th>
                                                    <td>
                                                        <!-- if怎麼優化 type  -->
                                                        <select class="form-select " for="status" id="status" name="status" aria-label="Default select example">

                                                            <option <?php if ($row["status"] == 1) : echo "selected"; ?><?php endif; ?> value="1">
                                                                上架
                                                            </option>
                                                            <option <?php if ($row["status"] == 2) : echo "selected"; ?><?php endif; ?> value="2">
                                                                停用
                                                            </option>
                                                        </select>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>
                                                        低消金額
                                                    </th>
                                                    <td>
                                                        <input type="number" class="form-control" id="requirement" name="requirement" value="<?= $row["requirement"] ?>" required>

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>
                                                        可使用次數
                                                    </th>
                                                    <td>
                                                        <input type="number" class="form-control" id="usage_counter" name="usage_counter" value="<?= $row["usage_counter"] ?>" min="1" required>

                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>
                                                        生效時間
                                                    </th>
                                                    <td>
                                                        <input type="datetime-local" class="form-control" id="onshelf_time" name="onshelf_time" value="<?= $row["onshelf_time"] ?>" required>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>
                                                        使用期限
                                                    </th>
                                                    <td>
                                                        <input type="datetime-local" class="form-control" id="limit_time" name="limit_time" value="<?= $row["limit_time"] ?>" required>

                                                    </td>
                                                </tr>

                                            </table>

                                            <div class="py-2 d-flex justify-content-between">
                                                <!-- <button class="btn btn-primary" type="submit">
                                                <i class="bi bi-highlighter"></i> 
                                                儲存
                                                </button> -->
                                                <div>
                                                    <button class="btn btn-dark" type="submit">
                                                        <i class="bi bi-highlighter"></i> 儲存
                                                    </button>

                                                    <a class="btn btn-dark " href="coupon.php?id=<?= $row["id"] ?>">
                                                        取消
                                                    </a>

                                                </div>


                                                <div>

                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#alertModal">
                                                        刪除
                                                    </button>

                                                </div>
                                            </div>

                                        </form>

                                    <?PHP endif; ?>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Boundless 2023</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-dark" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script>
        // JS判斷 與addCP頁面相同 僅移除產生代碼功能
        function checkRequirementValues() {
            var valueType = parseInt(document.querySelector('input[name="type"]:checked').value);
            var valueDiscount = parseFloat(document.getElementById('discount').value);
            var valueRequirement = parseFloat(document.getElementById('requirement').value);

            if (isNaN(valueDiscount) || isNaN(valueRequirement)) {
                alert('折扣和低消需輸入有效的數字。');
                return false;
            }

            if(valueType === 1 && (valueDiscount < 1) ){
                alert('折扣面額請大於1。');
                return false;
            } 

            if (valueType === 1 && (valueDiscount > valueRequirement)) {
                alert('低消需求必須大於或等於折扣面額。');
                return false;
            }else if (valueType === 2 && (valueDiscount < 0 || valueDiscount > 1)) {
                alert('百分比折扣應輸入介於 0 ~ 1 之間的數字。');
                return false;
            }

            return true;
        }

        
        function checkDateTime() {
            var datetime1 = new Date(document.getElementById('onshelf_time').value);
            var datetime2 = new Date(document.getElementById('limit_time').value);

            if (isNaN(datetime1.getTime()) || isNaN(datetime2.getTime())) {
                alert("請輸入有效的日期時間");
                return false;
            } else if (datetime1 >= datetime2) {
                alert("上架時間必須早於使用期限時間。");
                return false;
            } else {

                return true;
            }
        }
    </script>
</body>

</html>