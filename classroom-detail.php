<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_GET["id"])) {
    header("location: classroom-list.php");
}
$id = $_GET["id"];
require_once("boundless_connect.php");


$sql = "SELECT classroom.*, classroom_region.region AS region
FROM classroom
JOIN classroom_region ON classroom.region_id = classroom_region.id 
WHERE classroom.id=$id AND classroom.valid=1";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

// var_dump($row);

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>練團室詳細資訊</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="icon" href="favicon.svg">

</head>

<body id="page-top">

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
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCourses" aria-expanded="true" aria-controls="collapseCourses">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <span>課程&教師</span>
                </a>
                <div id="collapseCourses" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="lesson-list.php">課程管理</a>
                        <a class="collapse-item" href="teacher-list.php">教師資訊</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="classroom-list.php" data-toggle="collapse" data-target="#collapseRental" aria-expanded="true" aria-controls="collapseRental">
                    <i class="fa-solid fa-map-location-dot"></i>
                    <span>場地空間</span>
                </a>
                <div id="collapseRental" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">功能:</h6>
                        <a class="collapse-item" href="classroom-add.php">新增</a>

                    </div>
                </div>
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
                        <a class="collapse-item" href="lesson_list.php">課程</a>
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
            <li class="nav-item">
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
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Welcome, manager</span>
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

                <!-- Begin Page 本頁內容 -->
                <div class="container-fluid">
                    <div class="mx-3">
                        <a class="btn btn-secondary" href="classroom-list.php"><i class="fa-solid fa-reply"></i> 回練團室清單</a>
                    </div>

                    <!-- 用form包?-->
                    <div class="mx-3 py-3 row gx-5">
                        <div class="col-4">
                            <div class="bg-body border ratio ratio-1x1">
                                <img class="object-fit-contain p-2" src="./classroom_images/<?= $row["img"] ?>" alt="<?= $row["img"] ?>">
                            </div>
                        </div>
                        <div class="col-8 pe-2">
                            <table class="table table-striped-columns">
                                <tr class="row">
                                    <td class="col-2 border-start">id</td>
                                    <td class="col-10 border-end"><?= $row["id"] ?></td>
                                </tr>
                                <tr class="row">
                                    <td class="col-2 border-start">練團室</td>
                                    <td class="col-10 border-end"><?= $row["name"] ?></td>
                                </tr>
                                <tr class="row">
                                    <td class="col-2 border-start">價格</td>
                                    <td class="col-10 border-end">$<?= $row["price"] ?></td>
                                </tr>
                                <tr class="row">
                                    <td class="col-2 border-start">區域</td>
                                    <td class="col-10 border-end"><?= $row["region"] ?></td>
                                </tr>
                                <tr class="row">
                                    <td class="col-2 border-start">地址</td>
                                    <td class="col-10 border-end"><?= $row["address"] ?></td>
                                </tr>
                                <tr class="row">
                                    <td class="col-2 border-start">電話</td>
                                    <td class="col-10 border-end"><?= $row["phone"] ?></td>
                                </tr>
                                <tr class="row">
                                    <td class="col-2 border-start">其他聯絡方式</td>
                                    <td class="col-10 border-end"><?= $row["email"] ?></td>
                                </tr>
                                <tr class="row">
                                    <td class="col-2 border-start">設備資訊
                                    </td>
                                    <td class="col-10 border-end"></td>
                                </tr>
                                <!-- <tr class="row">
                                    <td class="col-2 border-start">品牌</td>
                                    <td class="col-3">></td>
                                    <td class="col-2">類別／子類別</td>
                                    <td class="col-5 border-end"></td>
                                </tr>
                                <tr class="row">
                                    <td class="col-2 border-start">庫存數量</td>
                                    <td class="col-10 border-end"></td>
                                </tr> -->
                                <!-- <tr class="row">
                                    <td class="col-2 border-start">新增時間</td>
                                    <td class="col-3"><?= $row["created_time"] ?></td>
                                    <td class="col-2">上架時間</td>
                                    <td class="col-5 border-end"><?= $row["onshelf_time"] ?>
                                        （<?php $time = strtotime(date('Y-m-d H:i:s'));
                                            if (strtotime($row["onshelf_time"]) > $time) {
                                                echo "未上架";
                                            } else {
                                                echo "已上架";
                                            }
                                            ?>）</td>
                                </tr> -->

                                <!-- <tr class="row">
                                    <td class="col-2 border-start">最後更新時間</td>
                                    <td class="col-10 border-end"></td>
                                </tr> -->
                            </table>
                            <div class="text-center">
                                <a class="btn btn-primary" href="classroom-edit.php?id=<?= $row["id"] ?>">編輯資訊</a>

                                <!-- Button trigger modal -->
                                <a class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    刪除
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">警告！</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                即將刪除資料
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                                <!-- ??????超連結包按鈕 -->
                                                <a href="doDeleteClassroom.php?id=<?= $row["id"] ?>" class="btn btn-danger">
                                                    確定刪除
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                        <span>Copyright &copy; Borderless 2023</span>
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
                    <a class="btn btn-primary" href="login.html">Logout</a>
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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <!-- 引入jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

</body>

</html>