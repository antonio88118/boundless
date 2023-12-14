<?php
require_once("boundless_connect.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

// 本來的
// $sql = "SELECT * FROM classroom WHERE valid=1 ORDER BY id ASC ";
// $result = $conn->query($sql);
// $rows = $result->fetch_all(MYSQLI_ASSOC);
// // var_dump($rows);

// $classroomCount = count($rows);

// $id = "id";
// $name = "name";
// $address = "address";
// $phone = "phone";
// $price = "price";


// 製作分頁
$countSql = "SELECT classroom.* FROM classroom WHERE valid=1";
$countResult = $conn->query($countSql);
// 資料總筆數
$countTotal = $countResult->num_rows;

$dataPerPage = 10; // 每頁顯示資料數
$pageCount = ceil($countTotal / $dataPerPage); // 計算需要的頁數

// if (isset($_GET["page"])) {
//     $pageNow = $_GET["page"];
//     $startItem = ($pageNow - 1) * $dataPerPage; // 每頁第一筆資料在陣列的key ex:(2-1)*20=20 ->key=20, id=21的資料
//     $sql = "SELECT * FROM classroom WHERE valid=1 ORDER BY id ASC 
//     LIMIT $startItem, $dataPerPage"; //從key $startItem 開始，抓5筆
// } else {
//     $pageNow = 1; // 如果沒有選頁數的話停在第一頁

//     //第一頁的資料
//     $sql = "SELECT * FROM classroom WHERE valid=1 ORDER BY id ASC 
//     LIMIT 0, $dataPerPage"; //從key 0開始，抓5筆
// }

// 在這裡初始化 $pageNow 和 $order 變量
$pageNow = 1;
$order = 1; // 或任何預設排序方式

//升降冪
if (isset($_GET["page"]) && isset($_GET["order"])) {
    $pageNow = $_GET["page"];
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

    $startItem = ($pageNow - 1) * $dataPerPage;
    $sql = "SELECT * FROM classroom WHERE valid=1 ORDER BY $orderSql LIMIT $startItem, $dataPerPage";

    // ------------------------------------------------------------------------------------------------------------------------------------------

    // ------------------------------------------------------------------------------------------------------------------------------------------
}
// elseif (isset($_GET["search"])) {
//     $search = $_GET["search"];
//     $sql = "SELECT * FROM classroom WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR address LIKE '%$search%'  AND valid=1";
// } 
else {
    // $pageNow = 1;
    // $order = 1;
    // if (isset($_GET["search"])) {
    //     $search = $_GET["search"];
    //     $sql = "SELECT * FROM classroom WHERE name LIKE '%$search%' OR email LIKE '%$search%' AND valid=1";
    // } else {
    //     $sql = "SELECT * FROM classroom WHERE valid=1 ORDER BY id ASC LIMIT 0, $dataPerPage";
    // }

    if (isset($_GET["search"])) {
        $search = $_GET["search"];


        // 檢查搜尋條件是不是數字（即搜尋 ID）
        if (is_numeric($search)) {
            // 直接比較 ID
            $sql = "SELECT * FROM classroom WHERE id = $search AND valid=1";
        } else {
            // 如果不是數字，則搜尋其他字段
            $sql = "SELECT * FROM classroom WHERE name LIKE '%$search%' AND valid=1";
        }
    } else {
        // 無搜尋條件的情況
        $sql = "SELECT * FROM classroom WHERE valid=1 ORDER BY id ASC LIMIT 0, $dataPerPage";
    }
}



$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
$classroomCount = count($rows);

$conn->close();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>場地租借管理測試</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <!-- <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet"> -->

    <!-- bootstrap@5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- main.css -->
    <link rel="stylesheet" href="css/main.css">


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
                                <button class="btn btn-primary" type="button">
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
                            <!-- <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div> -->
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Douglas McGee</span>
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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-secondary">練團室列表</h4>
                            <p class="mt-2 text-secondary">點選店名，查看或編輯練團室資訊。</p>
                        </div>
                        <!-- 搜尋欄 可以先拿掉-->
                        <div style="width: 20%;">
                            <div class="d-flex align-items-center">
                                <?PHP if (isset($_GET["search"])) : ?>
                                    <div class="col-auto">
                                        <a class="btn btn-dark" href="classroom-list.php">
                                            <i class="fa-solid fa-reply"></i>
                                        </a>

                                    </div>
                                <?PHP endif; ?>
                                <form action="" method="get">
                                    <div class="input-group py-3 mx-3">
                                        <input type="text" class="form-control" placeholder="搜尋練團室id..." name="search" value="<?php if (isset($_GET["search"])) {echo $_GET["search"];} ?>">
                                        <button class="btn btn-dark" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                </form>
                            </div>

                        </div>
                        <!-- 新增按鍵 -->
                        <div class="card-body ">
                            <div class="table-responsive">

                                <!-- <button class="btn btn-dark text-white">
                                    <a href="classroom-add.php">
                                        <i class="fa-solid fa-circle-plus"></i>
                                        新增
                                    </a>
                                </button> -->

                                <!-- 升降冪 -->
                                <div class=" col d-flex justify-content-between">
                                    <!-- <form class=" col py-2" action="">
                                        <div class="input-group"><input type="text" class="form-control" placeholder="搜尋..." name="search">
                                            <button class="btn btn-dark" type="submit" id=""><i class="bi bi-search"></i></button>
                                    </form> -->
                                    <div>
                                        <a class="btn btn-dark me-2" href="classroom-add.php">
                                            <i class="fa-solid fa-plus"></i>
                                            增加練團室
                                        </a>
                                        共 <?= $countTotal - 1 ?>家, 當前顯示 <?= $classroomCount ?> 家
                                    </div>
                                    <div>
                                        <a class="btn btn-dark " href="classroom-list.php?page=<?= $pageNow ?>&order=1">
                                            <i class="fa-solid fa-arrow-down-1-9">升冪</i>
                                        </a>
                                        <a class="btn btn-dark" href="classroom-list.php?page=<?= $pageNow ?>&order=2">
                                            <i class="fa-solid fa-arrow-up-1-9">降冪</i>
                                        </a>
                                    </div>
                                </div>


                            </div>

                            <!-- DataTales Example -->
                            <table class="table table-hover mt-3">
                                <thead>
                                    <tr>
                                        <th scope="col">id</th>
                                        <th scope="col">店名</th>
                                        <th scope="col">店家地址</th>
                                        <th scope="col">電話</th>
                                        <th scope="col">價錢</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($rows as $row) :
                                    ?>
                                        <tr>
                                            <th><?= $row["id"]
                                                ?></th>
                                            <td>
                                                <a href="classroom-detail.php?id=<?= $row["id"] ?>"><?= $row["name"] ?> </a>
                                            </td>

                                            <td><?= $row["address"]
                                                ?></td>
                                            <td><?= $row["phone"]
                                                ?></td>
                                            <td>＄<?= $row["price"]
                                                    ?></td>
                                            <!-- 本來要設給詳細資訊的符號 -->
                                            <!-- <td><a class="btn btn-info bg-dark text-white" href="classroom-detail.php?id=<?= $row["id"] ?>">
                                                        <i class="justify-content-end fa-solid fa-circle-info"></i></a></td> -->
                                        </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>

                            <!-- 產生分頁 -->
                            <!-- 如有search頁碼消失 -->
                            <?php if (!isset($_GET["search"])) : ?>
                                <div class="py-2">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination d-flex justify-content-center">
                                            <!-- 若在第一頁，上一頁無效 -->
                                            <li class="page-item">
                                                <?php if ($pageNow == 1) : ?>
                                                    <a class="page-link disabled" aria-label="Previous" aria-disabled="true">
                                                        <!-- renders a disabled "Previous" link or  -->
                                                    <?php else : ?>
                                                        <a class="page-link" href="classroom-list.php?page=<?= $pageNow - 1 ?>&order=<?= $order ?>" aria-label="Previous">
                                                            <!-- provides an active link pointing to the previous page -->
                                                        <?php endif; ?>
                                                        <span aria-hidden="true">&laquo;</span>
                                                        <span class="sr-only">Previous</span>
                                                        </a>
                                            </li>
                                            <!-- 數字頁碼 -->
                                            <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                                                <li class="page-item <?php if ($pageNow == $i) echo "active"; ?>">
                                                    <a class="page-link" href="classroom-list.php?page=<?= $i ?>&order=<?= $order ?>"><?= $i ?></a>
                                                </li>
                                            <?php endfor; ?>
                                            <li class="page-item">
                                                <!-- 若在最後一頁，下一頁無效 -->
                                                <?php if ($pageNow == $pageCount) : ?>
                                                    <a class="page-link disabled" aria-label="Next" aria-disabled="true">
                                                    <?php else : ?>
                                                        <a class="page-link" href="classroom-list.php?page=<?= $pageNow + 1 ?>&order=<?= $order ?>" aria-label="Next">
                                                        <?php endif; ?>
                                                        <span aria-hidden="true">&raquo;</span>
                                                        <span class="sr-only">Next</span>
                                                        </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
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

        <!-- End of Main Content -->



    </div>
    <!-- End of Page Wrapper -->
    </div>
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
                    <a class="btn btn-primary" href="login.php">Logout</a>
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
</body>

</html>