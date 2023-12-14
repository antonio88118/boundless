<?php
require_once("boundless_connect.php");

// --------------------加上種類ID 用assoc的方式-----------------------

$sqlKind = "SELECT * FROM coupon_kind";
$resultKind = $conn->query($sqlKind);
$rowsKind = $resultKind->fetch_all(MYSQLI_ASSOC);
$kinds = [];
foreach ($rowsKind as $kind) {
    $kinds[$kind["id"]] = $kind["name"];
}

// --------------------加上型態ID 用assoc的方式-----------------------

$sqlType = "SELECT * FROM coupon_type";
$resultType = $conn->query($sqlType);
$rowsType = $resultType->fetch_all(MYSQLI_ASSOC);
$types = [];
foreach ($rowsType as $type) {
    $types[$type["id"]] = $type["name"];
}


// --------------------加上種類ID 用assoc的方式-----------------------

$sqlStatus = "SELECT * FROM coupon_status";
$resultStatus = $conn->query($sqlStatus);
$rowsStatus = $resultStatus->fetch_all(MYSQLI_ASSOC);
$statuses = [];
foreach ($rowsStatus as $status) {
    $statuses[$status["id"]] = $status["name"];
}

// --------------------------------分頁功能--------------------------------


$sqlTotal = "SELECT * FROM coupon WHERE valid=1";
$resultTotal=$conn->query($sqlTotal);
$totalCoupon=$resultTotal->num_rows;

$perPage=10;

// 算頁數 沒辦法整除就無條件進位 增加頁數
$pageCount=ceil($totalCoupon/$perPage);

//  ----------------------------搜尋功能-----------------------------

if (isset($_GET["search-coupon"])) {
    $search = $_GET["search-coupon"];
    // echo $search;

    $sql = "SELECT * FROM coupon    
    WHERE name LIKE '%$search%' OR discount LIKE '%$search%' OR requirement LIKE '%$search%' AND valid=1  ORDER BY id ASC";

    // $sql = "SELECT * FROM coupon    
    // WHERE name LIKE '%$search%' OR kind LIKE '%$search%' OR type LIKE '%$search%' OR discount LIKE '%$search%' OR status LIKE '%$search%' OR requirement LIKE '%$search%' OR onshelf_time LIKE '%$search%' OR limit_time LIKE '%$search%' OR AND valid=1  ORDER BY id ASC";


    // $sql = "SELECT * FROM coupon    
    // WHERE name=$search OR kind=$search OR type=$search OR discount=$search OR status=$search OR requirement=$search OR onshelf_time=$search OR limit_time=$search AND valid=1  ORDER BY id ASC";


    // echo $sql;

} 
elseif(isset($_GET["page"]) && isset($_GET["order"])){
    
        // 當前頁數-1 * $perPage
        $page=$_GET["page"];
        $order=$_GET["order"];
        switch($order){
            case 1:
                $oederSql="id ASC";
                break;
            case 2:
                $oederSql="id DESC";
                break;
            case 3:
                $oederSql="discount ASC";
                break;
            case 4:
                $oederSql="discount DESC";
                break;
            default:
                $oederSql="id ASC";
                break;
            }
    
        $startItem=($page-1)*$perPage;
        $sql = "SELECT * FROM coupon WHERE valid=1 ORDER BY $oederSql LIMIT $startItem,$perPage";
} 
// 麵包蟹分頁
elseif (isset($_GET["kind"])) {
    $page=1;
    $order=1;
    $kind = $_GET["kind"];


    $sql = "SELECT * FROM coupon     
    WHERE kind = $kind 
    ORDER BY id ASC";
} elseif (isset($_GET["type"])) {
    $page=1;
    $order=1;

    $type = $_GET["type"];

    $sql = "SELECT * FROM coupon 
    WHERE type = $type
    ORDER BY id ASC";
} else {
    $page=1;
    $order=1;
    $sql = "SELECT * FROM coupon WHERE valid=1 ORDER BY id ASC LIMIT 0,$perPage";
}


$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Boundless - Coupons-List</title>

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

    <!-- font awesome icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body id="page-top">

    <!-- <pre>
<?PHP var_dump($types); ?>
    <?PHP print_r($types); ?>
    </pre> -->

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
                    <!-- <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-dark" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->

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

                    <div class="container-top_Nue  d-flex justify-content-between align-items-center">
                        <div>
                            <!-- Page Heading -->
                            <h1 class="h2 mb-2 text-gray-800">優惠券</h1>
                            <p class="mb-4">本頁面能夠新增、刪除優惠券，或是變更優惠券狀態。</p>
                        </div>

                        <div class="justify-content-end">
                            <a class="btn btn-dark " title="新增優惠券" href="coupon-addCP.php">
                                <i class="bi bi-plus-lg"></i>
                                優惠券
                            </a>
                        </div>
                    </div>

                    <div class="py-1">
                        <form action="">
                            <div class="row g-3 align-items-center">

                                <?PHP if (isset($_GET["search-coupon"])) : ?>
                                    <div class="col-auto">
                                        <a class="btn btn-dark" href="coupons-list.php">
                                            <i class="bi bi-backspace"></i>
                                        </a>

                                    </div>
                                <?PHP endif; ?>

                                <div class="col-auto">
                                    <input type="text" class="form-control text-start " name="search-coupon" value="<?PHP $searchCoupon = isset($_GET["search-coupon"]) ? $search : "";
                                                                                                                    echo $searchCoupon; ?>" placeholder="可以搜尋名稱、折扣金額" required>
                                </div>

                                <div class="col-auto">
                                    <button class="btn btn-dark text-white" type="submit">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>









                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-dark">優惠券清單</h4>
                        </div>
                        <div class="card-body">

                            <!-- 刪除了table-responsive避免出現左右滾動條 -->
                            <div class="">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                                <div class="row">
                                        <!-- ------------------------- 麵包蟹分頁--爆版哭哭-------------------------- -->
                                        <div class="py-2 col-6">
                                            <ul class="nav nav-tabs" >
                                                <li class="nav-item">


                                                    <a class="text-dark nav-link <?PHP if (!isset($_GET["kind"]) && !isset($_GET["type"])) echo "active"; ?>" aria-current="page" href="coupons-list.php">
                                                        全部
                                                    </a>

                                                </li>

                                                <?PHP foreach ($rowsKind as $kind) : ?>
                                                    <li class="nav-item">
                                                        <a class="text-dark nav-link <?PHP if (isset($_GET["kind"]) && $_GET["kind"] == $kind["id"]) echo "active"; ?>" href="coupons-list.php?kind=<?= $kind["id"] ?>">
                                                            <?= $kind["name"] ?>
                                                        </a>
                                                    </li>
                                                <?PHP endforeach; ?>

                                                <?PHP foreach ($rowsType as $type) : ?>
                                                    <li class="nav-item">
                                                        <a class="text-dark nav-link <?PHP if (isset($_GET["type"]) && $_GET["type"] == $type["id"]) echo "active"; ?>" href="coupons-list.php?type=<?= $type["id"] ?>">
                                                            <?= $type["name"] ?>
                                                        </a>
                                                    </li>
                                                <?PHP endforeach; ?>
                                            </ul>

                                        </div>
                                        <!-- ------------------------- 麵包蟹分頁---------------------------- -->


                                        <!------------------------ 升、降序按鈕 -------------------------->
                                        <?PHP if (!isset($_GET["search-coupon"]) && !isset($_GET["kind"]) && !isset($_GET["type"]) ) : ?>

                                            <div class="py-3 col-6 d-flex justify-content-end">
                                                <div class="btn-group ">

                                                    <!-- 注意導引的 是$page不是$i -->
                                                    <a href="coupons-list.php?page=<?= $page ?>&order=1" class="btn btn-dark <?PHP if ($order == 1) echo "active" ?>">
                                                        ID<i class="fa-solid fa-down-long"></i>
                                                    </a>

                                                    <a href="coupons-list.php?page=<?= $page ?>&order=2" class="btn btn-dark <?PHP if ($order == 2) echo "active" ?>">
                                                        ID<i class="fa-solid fa-up-long"></i>
                                                    </a>

                                                    <a href="coupons-list.php?page=<?= $page ?>&order=3" class="btn btn-dark <?PHP if ($order == 3) echo "active" ?>">
                                                    折扣<i class="fa-solid fa-down-long"></i>
                                                    </a>

                                                    <a href="coupons-list.php?page=<?= $page ?>&order=4" class="btn btn-dark <?PHP if ($order == 4) echo "active" ?>">
                                                        折扣<i class="fa-solid fa-up-long"></i>
                                                    </a>

                                                </div>
                                            </div>

                                        <?PHP endif; ?>
                                        <!------------------------ 升、降序按鈕 -------------------------->
                                    </div>

                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>名稱</th>
                                            <th>種類</th>
                                            <th>折扣類型</th>
                                            <th>折扣幅度</th>
                                            <th>狀態</th>
                                            <th>低消需求</th>
                                            <th>生效時間</th>
                                            <th>使用期限</th>
                                            <th>詳細資料</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>名稱</th>
                                            <th>種類</th>
                                            <th>折扣方式</th>
                                            <th>折扣幅度</th>
                                            <th>狀態</th>
                                            <th>低消需求</th>
                                            <th>生效時間</th>
                                            <th>使用期限</th>
                                            <th>詳細資料</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?PHP foreach ($rows as $row) : ?>

                                            <tr>
                                                <td><?= $row["id"] ?></td>
                                                <td><?= $row["name"] ?></td>
                                                <td><?= $kinds[$row["kind"]] ?></td>
                                                <td><?= $types[$row["type"]] ?></td>
                                                <td><?= $row["discount"] ?></td>
                                                <td><?= $statuses[$row["status"]] ?></td>
                                                <td><?= $row["requirement"] ?></td>
                                                <td><?= $row["onshelf_time"] ?></td>
                                                <td><?= $row["limit_time"] ?></td>
                                                <td class="">
                                                    <a class=" btn btn-dark " title="編輯優惠券" href="coupon.php?id=<?= $row["id"] ?>">

                                                        詳細資料
                                                    </a>
                                                </td>
                                            </tr>

                                        <?PHP endforeach; ?>

                                    </tbody>
                                </table>


                                <!-- 讓搜尋時不要出現分頁 -->
                                <?PHP if (!isset($_GET["search-coupon"]) && !isset($_GET["kind"]) && !isset($_GET["type"])) : ?>

                                    <div class="py-2">

                                        <!-- bs5裡面的  pagination 分頁控制 -->
                                        <nav aria-label="Page navigation example ">

                                            <ul class="pagination ">

                                                <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li> -->
                                                <?PHP for ($i = 1; $i <= $pageCount; $i++) : ?>
                                                    
                                                    <!-- 透過php加入 當前頁數顯示 active -->
                                                    <li class="page-item <?php if ($page == $i) echo  "active"; ?>">
                                                        <a class="text-dark page-link" href="coupons-list.php?page=<?= $i ?>&order=<?= $order ?>">

                                                            <?= $i ?>

                                                        </a>
                                                    </li>

                                                <?PHP endfor; ?>

                                                <!-- <li class="page-item"><a class="page-link" href="#">Next</a></li> -->

                                            </ul>
                                        </nav>
                                    </div>


                                <?PHP endif; ?>
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
    <!-- <script src="js/demo/datatables-demo.js"></script> -->

    <!-- <script>
        
    var table = new DataTable('#dataTable', {
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/zh-HANT.json',
    },
    });
        
    </script> -->

</body>

</html>