<?php
require_once("boundless_connect.php");
session_start();

if (!isset($_GET["search"])) {
    header("Location: instrument-list.php");
    exit;
}
$search = $_GET["search"];

// 製作分頁
$countSql = "SELECT instrument.*, instrument_category.name AS category_name, 
instrument_subcategory.name AS subcategory_name, brand.name AS brand_name FROM instrument 
JOIN instrument_category ON instrument.category_id = instrument_category.id 
JOIN instrument_subcategory ON instrument.subcategory_id = instrument_subcategory.id
JOIN brand ON instrument.brand_id = brand.id 
WHERE instrument.name LIKE '%$search%'AND instrument.valid=1 OR 
instrument_category.name LIKE '%$search%' AND instrument.valid=1 OR 
instrument_subcategory.name LIKE '%$search%' AND instrument.valid=1 OR 
brand.name LIKE '%$search%' AND instrument.valid=1";
$countResult = $conn->query($countSql);
// 資料總筆數
if ($search == "") {
    $countTotal = 0;
} else {
    $countTotal = $countResult->num_rows;
}


$dataPerPage = 20; // 每頁顯示資料數
$pageCount = ceil($countTotal / $dataPerPage); // 計算需要的頁數

if (isset($_GET["page"]) && isset($_GET["order"])) {
    $pageNow = $_GET["page"];
    $order = $_GET["order"];
    switch ($order) {
        case 1:
            $ordersql = "instrument.id ASC";
            break;
        case 2:
            $ordersql = "instrument.id DESC";
            break;
        case 3:
            $ordersql = "instrument.price ASC";
            break;
        case 4:
            $ordersql = "instrument.price DESC";
            break;
        default:
            $ordersql = "instrument.id ASC";
    }
    $startItem = ($pageNow - 1) * $dataPerPage; // 每頁第一筆資料在陣列的key ex:(2-1)*20=20 ->key=20, id=21的資料
    $sql = "SELECT instrument.*, instrument_category.name AS category_name, 
    instrument_subcategory.name AS subcategory_name, brand.name AS brand_name FROM instrument 
    JOIN instrument_category ON instrument.category_id = instrument_category.id 
    JOIN instrument_subcategory ON instrument.subcategory_id = instrument_subcategory.id
    JOIN brand ON instrument.brand_id = brand.id
    WHERE instrument.name LIKE '%$search%'AND instrument.valid=1 OR 
    instrument_category.name LIKE '%$search%' AND instrument.valid=1 OR 
    instrument_subcategory.name LIKE '%$search%' AND instrument.valid=1 OR 
    brand.name LIKE '%$search%' AND instrument.valid=1
    ORDER BY $ordersql
    LIMIT $startItem, $dataPerPage"; //從key 0開始，抓20筆
} else {
    $pageNow = 1; // 目前所在頁面
    $order = 1;
    $sql = "SELECT instrument.*, instrument_category.name AS category_name, 
    instrument_subcategory.name AS subcategory_name, brand.name AS brand_name FROM instrument 
    JOIN instrument_category ON instrument.category_id = instrument_category.id 
    JOIN instrument_subcategory ON instrument.subcategory_id = instrument_subcategory.id
    JOIN brand ON instrument.brand_id = brand.id
    WHERE instrument.name LIKE '%$search%'AND instrument.valid=1 OR 
    instrument_category.name LIKE '%$search%' AND instrument.valid=1 OR 
    instrument_subcategory.name LIKE '%$search%' AND instrument.valid=1 OR 
    brand.name LIKE '%$search%' AND instrument.valid=1
    ORDER BY instrument.id ASC
    LIMIT 0, $dataPerPage"; //從key 0開始，抓20筆
}
$result = $conn->query($sql);
$rows = $result->fetch_all(MYSQLI_ASSOC);
$count = $result->num_rows;

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

    <title>樂器商品清單-關鍵字查詢</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="icon" href="favicon.svg">
    <style>
        .img-box {
            width: 60px;
            height: 60px;
        }

        .table-text-center {
            text-align: center;
            vertical-align: middle !important;
        }
    </style>
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
                                    登出
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div>
                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800 ms-1">樂器商品清單</h1>
                        <p class="mb-4 text-secondary ms-1">點選 <i class="fa-solid fa-circle-info"></i> 按鍵，查看或編輯商品詳情。</p>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div class="w-100 d-flex justify-content-between align-items-center py-2">
                                <!-- 搜尋欄 -->
                                <div style="width: 300px;">
                                    <form action="instrument-list-search.php" method="GET">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="搜尋關鍵字..." name="search" value="<?php if (isset($_GET["search"])) echo $_GET["search"] ?>">
                                            <button type="submit" class="btn btn-primary" href=""><i class="fa-solid fa-magnifying-glass"></i></button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="p-2">
                                <!-- 新增商品按鍵 -->
                                <div class="my-2 mb-3 d-flex align-items-center justify-content-between">
                                    <div class="mb-2">
                                        <a class="btn btn-primary fw-bold me-2" href="instrument-list.php"><i class="fa-solid fa-reply"></i> 回總清單</a>
                                        符合資料共 <?= $countTotal ?> 筆
                                    </div>
                                    <div>
                                        <?php if (isset($_GET["search"])) : ?>
                                            <div class="btn-group me-3">
                                                <a class="btn btn-primary <?php if ($order == 1) echo "active" ?>" href="instrument-list-search.php?page=<?= $pageNow ?>&search=<?= $search ?>">id <i class="fa-solid fa-arrow-up-short-wide"></i></a>
                                                <a class="btn btn-primary <?php if ($order == 2) echo "active" ?>" href="instrument-list-search.php?page=<?= $pageNow ?>&order=2&search=<?= $search ?>">id <i class="fa-solid fa-arrow-down-wide-short"></i></a>
                                                <a class="btn btn-primary <?php if ($order == 3) echo "active" ?>" href="instrument-list-search.php?page=<?= $pageNow ?>&order=3&search=<?= $search ?>"><i class="fa-solid fa-dollar-sign"></i> <i class="fa-solid fa-arrow-up-short-wide"></i></a>
                                                <a class="btn btn-primary <?php if ($order == 4) echo "active" ?>" href="instrument-list-search.php?page=<?= $pageNow ?>&order=4&search=<?= $search ?>"><i class="fa-solid fa-dollar-sign"></i> <i class="fa-solid fa-arrow-down-wide-short"></i></a>
                                            </div>
                                        <?php endif; ?>
                                        <a class="btn btn-primary fw-bold" href="instrument-add.php"><i class="fa-solid fa-circle-plus"></i> 新增商品</a>
                                    </div>
                                </div>

                                <!-- DataTales Example -->
                                <div class="mb-4">
                                    <table class="table table-bordered table-striped table-hover" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>編號</th>
                                                <th class="text-center">縮圖</th>
                                                <th>名稱</th>
                                                <th>品牌</th>
                                                <th>類別／子類別</th>
                                                <th class="text-end">售價</th>
                                                <th class="text-end">庫存數量</th>
                                                <th class="text-center">新增時間</th>
                                                <th class="text-center">上架狀態</th>
                                                <th class="text-center">功能</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- 檢查是否存在資料 -->
                                            <?php if ($search != "") : ?>
                                                <?php foreach ($rows as $row) : ?>
                                                    <tr>
                                                        <td class="align-middle"><?= $row["id"] ?></td>
                                                        <td class="table-text-center">
                                                            <img class="object-fit-contain img-box" src="./instrument_images/<?= $row["category_name"] ?>/<?= $row["subcategory_name"] ?>/<?= $row["img"] ?>" alt="商品:<?= $row["name"] ?>">
                                                        </td>
                                                        <td class="align-middle"><?= $row["name"] ?></td>
                                                        <td class="align-middle"><?= $row["brand_name"] ?></td>
                                                        <td class="align-middle"><?= $row["category_name"] ?>／<?= $row["subcategory_name"] ?></td>
                                                        <td class="text-end align-middle">$<?= number_format($row["price"]) ?></td>
                                                        <td class="text-end align-middle">
                                                            <?php
                                                            if ($row["stock"] == 0) {
                                                                echo "售罄";
                                                            } else {
                                                                echo $row["stock"];
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="table-text-center"><?= $row["created_time"] ?></td>
                                                        <td class="table-text-center">
                                                            <?php
                                                            $time = strtotime(date('Y-m-d H:i:s'));
                                                            if (strtotime($row["onshelf_time"]) > $time) {
                                                                echo "未上架";
                                                            } else {
                                                                echo "已上架";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td class="align-middle">
                                                            <div class="d-flex justify-content-evenly">
                                                                <a class="btn btn-primary" href="instrument-detail.php?id=<?= $row["id"] ?>" title="商品詳情"><i class="fa-solid fa-circle-info"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <div class="fw-bold">目前無資料</div>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>

                                    <!-- 產生分頁 -->
                                    <div class="py-2">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination d-flex justify-content-center">
                                                <!-- 最前頁 -->
                                                <li class="page-item">
                                                    <a class="page-link <?php if ($pageNow == 1) echo "disabled" ?>" href="instrument-list-search.php?page=1&order=<?= $order ?>">最前頁</a>
                                                </li>
                                                <!-- 若在第一頁，上一頁無效 -->
                                                <li class="page-item">
                                                    <?php if ($pageNow == 1) : ?>
                                                        <a class="page-link disabled" aria-label="Previous" aria-disabled="true">
                                                        <?php else : ?>
                                                            <a class="page-link" href="instrument-list-search.php?page=<?= $pageNow - 1 ?>&order=<?= $order ?>" aria-label="Previous">
                                                            <?php endif; ?>
                                                            <span aria-hidden="true">&laquo;</span>
                                                            <span class="sr-only">Previous</span>
                                                            </a>
                                                </li>
                                                <!-- 數字頁碼 -->
                                                <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                                                    <li class="page-item <?php if ($pageNow == $i) echo "active"; ?>">
                                                        <a class="page-link" href="instrument-list-search.php?page=<?= $i ?>&order=<?= $order ?>&search=<?= $search ?>"><?= $i ?></a>
                                                    </li>
                                                <?php endfor; ?>
                                                <li class="page-item">
                                                    <!-- 若在最後一頁，下一頁無效 -->
                                                    <?php if ($pageNow == $pageCount) : ?>
                                                        <a class="page-link disabled" aria-label="Next" aria-disabled="true">
                                                        <?php else : ?>
                                                            <a class="page-link" href="instrument-list-search.php?page=<?= $pageNow + 1 ?>&order=<?= $order ?>&search=<?= $search ?>" aria-label="Next">
                                                            <?php endif; ?>
                                                            <span aria-hidden="true">&raquo;</span>
                                                            <span class="sr-only">Next</span>
                                                            </a>
                                                </li>
                                                <!-- 最後頁 -->
                                                <li class="page-item">
                                                    <a class="page-link <?php if ($pageNow == $pageCount) echo "disabled" ?>" href="instrument-list-search.php?page=<?= $pageCount ?>&order=<?= $order ?>&search=<?= $search ?>">最尾頁</a>
                                                </li>
                                            </ul>
                                        </nav>
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

    <?php unset($_SESSION["error"]["message"]) ?>

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

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

    <!-- 引入jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        // 日期搜尋的結束日期必須<=開始日期
        let startTime = document.getElementById("start_time");
        let endTime = document.getElementById("end_time");

        function setMinTime(value) {
            var str = "";
            var minValue = startTime.value;
            str = minValue;
            $("#end_time").attr("min", str);

        }
        startTime.addEventListener("change", setMinTime);
    </script>
</body>
</body>

</html>