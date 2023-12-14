<?php
require_once("boundless_connect.php");

$sqlTotal = "SELECT * FROM users WHERE valid=1";

$resultTotal = $conn->query($sqlTotal);
$perPage = 10;
$totalUser = $resultTotal->num_rows;
$pageCount = ceil($totalUser / $perPage);

if (isset($_GET["page"]) && isset($_GET["order"])) {
    $page = $_GET["page"];
    $order = $_GET["order"];
    switch ($order) {
        case 1:
            $orderSql = "id ASC";
            break;
        case 2:
            $orderSql = "id DESC";
            break;
        default:
            $orderSql = "id ASC";
            break;
    }

    $startItem = ($page - 1) * $perPage;

    // ------------------------------------------------------------------------------------------------------------------------------------------
    if (isset($_GET["search"])) {
        $search = $_GET["search"];
        $sql = "SELECT * FROM users WHERE name LIKE '%$search%' OR email LIKE '%$search%'  AND valid=1 ORDER BY $orderSql LIMIT $startItem, $perPage";
    } else {
        $sql = "SELECT * FROM users WHERE valid=1 ORDER BY $orderSql LIMIT $startItem, $perPage";
    }
    // ------------------------------------------------------------------------------------------------------------------------------------------
} else {
    $page = 1;
    $order = 1;
    if (isset($_GET["search"])) {
        $search = $_GET["search"];
        $sql = "SELECT * FROM users WHERE name LIKE '%$search%' OR email LIKE '%$search%' AND valid=1";
    } else {
        $sql = "SELECT * FROM users WHERE valid=1 ORDER BY id ASC LIMIT 0, $perPage";
    }
}
$result = $conn->query($sql);
?>
<!DOCTYPE ht ml>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>後台管理首頁</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

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
            <li class="nav-item active">
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

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="container py-3">
                        <?PHP
                        $userCount = $result->num_rows;
                        ?>
                        <?php
                        $rows = $result->fetch_all(MYSQLI_ASSOC);
                        ?>
                        <div class="">

                            <div class=" py-2">
                                <div class="d-flex justify-content-end">
                                    <div style="width: 50%;">
                                        <form class=" col py-2" action="">
                                            <div class="input-group"><input type="text" class="form-control" placeholder="搜尋..." name="search">
                                                <button class="btn btn-dark" type="submit" id=""><i class="bi bi-search"></i></button>
                                        </form>
                                        <a class="btn btn-dark" href="user-list.php?page=<?= $page ?>&order=1"><i class="bi bi-sort-down-alt"></i></a>
                                        <a class="btn btn-dark" href="user-list.php?page=<?= $page ?>&order=2"><i class="bi bi-sort-up"></i></a>
                                        <a class="btn btn-dark" href="add-user.php"> 增加使用者</a>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end mb-2">
                                <?php if (isset($_GET["search"])) : ?>
                                    <?PHP echo '搜尋 "'  . $_GET["search"] . '" 的結果'; ?>
                                <?php endif ?></div>
                            <div>
                                <?php if (isset($_GET["search"])) : ?>
                                    <a class="btn btn-dark float-left mb-2" href="user-list.php"><i class="bi bi-card-list"></i>查看使用者清單</a>
                                <?php endif ?>
                                <div class="text-end">使用者共 <?= $totalUser ?> 人, 當前顯示 <?= $userCount ?> 人</div>
                            </div>


                            <table class="table text-center vertical-align-middle">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th><i class=" bi bi-person-fill" title="姓名"></i></th>
                                        <th>電子郵件</th>
                                        <th><i class="bi bi-telephone-fill" title="連絡電話"></i>連絡電話</th>
                                        <th><i class="bi bi-person-lines-fill" title="個人資訊"></i>詳細資訊</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?PHP if ($userCount > 0) : ?>
                                        <?PHP foreach ($rows as $row) : ?>

                                            <tr>
                                                <td><?= $row["id"] ?></td>
                                                <td><?= $row["name"] ?></td>
                                                <td><?= $row["email"] ?></td>
                                                <td><?= $row["phone"] ?></td>
                                                <td><a class="btn btn-dark" href="user.php?id=<?= $row["id"] ?>">查看</a></td>
                                            </tr>
                                        <?PHP endforeach; ?>
                                    <?PHP else : ?>
                                        目前無使用者
                                    <?PHP endif; ?>
                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th><i class="bi bi-person-fill" title="姓名"></i></th>
                                        <th>電子郵件</th>
                                        <th><i class="bi bi-telephone-fill" title="連絡電話"></i>連絡電話</th>
                                        <th><i class="bi bi-person-lines-fill" title="個人資訊"></i>詳細資訊</th>
                                    </tr>

                                </tfoot>

                            </table>

                            <!-- <?php if (!isset($_GET["search"])) : ?> -->
                            <div class="d-flex justify-content-center">
                                <ul class="pagination">
                                    <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                                        <li class="page-item <?php if ($page == $i) echo "active"; ?>">
                                            <a class="page-link bg-secondary text-light" href="user-list.php?page=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor ?>
                                </ul>
                            </div>


                            <!-- <?php endif ?> -->
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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>