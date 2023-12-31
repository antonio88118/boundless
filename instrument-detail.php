<?php
if (!isset($_GET["id"])) {
    header("location: instrument-list.php");
}
$id = $_GET["id"];
require_once("boundless_connect.php");
session_start();

$sql = "SELECT instrument.*, instrument_category.name AS category_name, 
instrument_subcategory.name AS subcategory_name, brand.name AS brand_name FROM instrument
JOIN instrument_category ON instrument.category_id = instrument_category.id 
JOIN instrument_subcategory ON instrument.subcategory_id = instrument_subcategory.id
JOIN brand ON instrument.brand_id = brand.id
WHERE instrument.id=$id AND instrument.valid=1";

$result = $conn->query($sql);
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

    <title>商品資訊</title>

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
            <li class="nav-item active">
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
                        <h1 class="h3 text-gray-800 text-center">商品資訊</h1>
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-secondary fw-bold" href="instrument-list.php"><i class="fa-solid fa-reply"></i> 回商品清單</a>

                            <form action="doOnshelfInstrument.php" method="post">
                                <!-- 立即上架鍵 -->
                                <button type="submit" class="btn btn-primary px-3 fw-bold" name="id" value="<?=$row["id"]?>"
                                    <?php if($row["onshelf_time"]<=date("Y-m-d H:i:s")) echo "disabled"?>>
                                    <i class="fa-solid fa-shop"></i> 立即上架
                                </button>
                            </form>
                            
                        </div>
                        
                    </div>
                    <div class="mx-3 py-3 row gx-5">
                        <!-- 立即上架成功後顯示 -->
                        <?php if (isset($_SESSION["success"]["message"])) : ?>
                            <div class="text-center text-danger pb-1"><?= $_SESSION["success"]["message"] ?></div>
                        <?php endif; ?>
                        <!-- 圖片區域 -->
                        <div class="col-4">
                            <div class="bg-body border ratio ratio-1x1">
                                <img class="object-fit-contain p-2" src="./instrument_images/<?=$row["category_name"]?>/<?=$row["subcategory_name"]?>/<?=$row["img"]?>" alt="商品:<?= $row["name"] ?>">
                            </div>
                        </div>
                        <!-- 資料區域 -->
                        <div class="col-8 pe-2">
                            <table class="table table-striped-columns">
                                <tr class="row">
                                    <td class="col-2 border-start fw-bold">編號</td>
                                    <td class="col-10 border-end"><?= $row["id"] ?></td>
                                </tr>
                                <tr class="row">
                                    <td class="col-2 border-start fw-bold">品名</td>
                                    <td class="col-10 border-end"><?= $row["name"] ?></td>
                                </tr>
                                <tr class="row">
                                    <td class="col-2 border-start fw-bold">價格</td>
                                    <td class="col-10 border-end">$<?= number_format($row["price"]) ?></td>
                                </tr>
                                <tr class="row">
                                    <td class="col-2 border-start fw-bold">品牌</td>
                                    <td class="col-3"><?= $row["brand_name"] ?></td>
                                    <td class="col-2 fw-bold">類別／子類別</td>
                                    <td class="col-5 border-end"><?= $row["category_name"] ?>／<?= $row["subcategory_name"] ?></td>
                                </tr>
                                <tr class="row">
                                    <td class="col-2 border-start fw-bold">庫存數量</td>
                                    <td class="col-10 border-end"><?= $row["stock"] ?></td>
                                </tr>
                                <tr class="row">
                                    <td class="col-2 border-start fw-bold">新增時間</td>
                                    <td class="col-3"><?= $row["created_time"] ?></td>
                                    <td class="col-2 fw-bold">上架時間</td>
                                    <td class="col-5 border-end"><?= $row["onshelf_time"] ?>
                                        （<?php $time = strtotime(date('Y-m-d H:i:s'));
                                            if (strtotime($row["onshelf_time"]) > $time) {
                                                echo "未上架";
                                            } else {
                                                echo "已上架";
                                            }
                                        ?>）
                                    </td>
                                </tr>
                                <tr class="row">
                                    <td class="col-2 border-start fw-bold">商品說明</td>
                                    <td class="col-10 border-end"><?=nl2br($row["info"])?></td>
                                </tr>
                                <tr class="row">
                                    <td class="col-2 border-start fw-bold">最後更新時間</td>
                                    <td class="col-10 border-end"><?= $row["updated_time"] ?></td>
                                </tr>
                            </table>

                            <!-- 按鍵區域 -->
                            <div class="text-center d-flex justify-content-center">
                                <form action="instrument-edit.php" method="post">
                                    <button type="submit" class="btn btn-primary me-5 px-3 fw-bold" name="id" value="<?=$row["id"]?>"><i class="fa-solid fa-pen"></i> 編輯</button>
                                </form>


                                <!-- Button trigger modal -->
                                <button class="btn btn-danger px-3 fw-bold" data-bs-toggle="modal" data-bs-target="#deleteModal"><i class="fa-solid fa-trash"></i> 刪除</button>
                                <!-- Modal -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="deleteModalLabel">警告！</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                確認刪除資料？
                                            </div>
                                            <div class="modal-footer">
                                                <!-- 用form表單送出資料 -->
                                                <form action="doDeleteInstrument.php" method="post">
                                                    <button type="submit" class="btn btn-danger" name="id" value="<?=$row["id"]?>">刪除</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
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
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <?php unset($_SESSION["success"]["message"]); ?>

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

</body>

</html>