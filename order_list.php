<?php
require_once("boundless_connect.php");



$perPage = 10;
//無條件進位
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$startItem = ($page - 1) * $perPage;

$page_start = $startItem + 1;
$page_end = $startItem + $perPage;

$page_left = 2;
$page_right = 2;

$urlParams = [];
parse_str($_SERVER['QUERY_STRING'], $urlParams);
// $urlParams['search_text'] = "%".$urlParams['search_text']."%";
// print_r($urlParams);

// var_dump($_GET);

if (isset($_GET["search_text"]) && $_GET["search_type"]) {
    $page = isset($_GET["page"]) ? $_GET["page"] : 1;
    $urlParams['search_text'] = "%" . $urlParams['search_text'] . "%";
    $search = $_GET["search_text"];



    // $sql="SELECT instrument_order_items.id AS itemID,instrument_order_items.quantity, instrument_order_items.productID, instrument_order.*, users.id AS userID, users.address, users.email, users.name, users.phone, instrument.price, instrument.name AS product_name, price*quantity AS amount, transportation.id AS stateID, transportation.state FROM instrument_order
    // LEFT JOIN transportation ON instrument_order.transportation_state = transportation.id
    // JOIN users ON instrument_order.user_id = users.id
    // JOIN instrument_order_items ON instrument_order_items.id = instrument_order.orderID
    // LEFT JOIN instrument ON instrument.id = instrument_order_items.productID
    // WHERE users.name LIKE '%search%'
    // LIMIT $startItem, $perPage
    // ";

    $sql = sprintf(
        "SELECT instrument_order_items.id AS itemID,instrument_order_items.quantity, instrument_order_items.productID, instrument_order.*, users.id AS userID, users.address, users.email, users.name, users.phone, instrument.price, instrument.name AS product_name, price*quantity AS amount, transportation.id AS stateID, transportation.state FROM instrument_order
    LEFT JOIN transportation ON instrument_order.transportation_state = transportation.id
    JOIN users ON instrument_order.user_id = users.id
    JOIN instrument_order_items ON instrument_order_items.id = instrument_order.orderID
    LEFT JOIN instrument ON instrument.id = instrument_order_items.productID
    WHERE %s LIKE '%s'
    LIMIT $startItem, $perPage",
        $urlParams['search_type'],
        $urlParams['search_text']
    );

    $countResult = $conn->query($sql);
    $totalOrder = $countResult->num_rows;
} else {
    $sqlCount = "SELECT instrument_order.* FROM instrument_order";
    $countResult = $conn->query($sqlCount);
    $totalOrder = $countResult->num_rows; //顯示共幾筆資料

    $sql = "SELECT instrument_order_items.id AS itemID,instrument_order_items.quantity, instrument_order_items.productID, instrument_order.*, users.id AS userID, users.address, users.email, users.name, users.phone, instrument.price, instrument.name AS product_name, price*quantity AS amount, transportation.id AS stateID, transportation.state FROM instrument_order
    LEFT JOIN transportation ON instrument_order.transportation_state = transportation.id
    JOIN users ON instrument_order.user_id = users.id
    JOIN instrument_order_items ON instrument_order_items.id = instrument_order.orderID
    LEFT JOIN instrument ON instrument.id = instrument_order_items.productID
    LIMIT $startItem, $perPage
";
}

$pageCount = ceil($totalOrder / $perPage);
if ($page_end > $totalOrder) {
    $page_end = $totalOrder;
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

    <title>Order Management</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .table th,
        .table td {
            vertical-align: middle;
        }

        .pagination>li>a {
            background-color: white;
            color: #5A4181;
        }

        .pagination>li>a:focus,
        .pagination>li>a:hover,
        .pagination>li>span:focus,
        .pagination>li>span:hover {
            color: #5a5a5a;
            background-color: #eee;
            border-color: #ddd;
        }

        .pagination>.active>a {
            color: white;
            background-color: #5A4181 !Important;
            border: solid 1px #5A4181 !Important;
        }

        .pagination>.active>a:hover {
            background-color: #5A4181 !Important;
            border: solid 1px #5A4181;
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
            <li class="nav-item active">
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
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

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

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="d-flex justify-content-between">
                            <h1 class="h3 mb-2 text-gray-800">樂器訂單管理</h1>
                            <div>
                                <?php if (isset($_GET["search_text"])) : ?>
                                    <a class="btn btn-dark mb-2" href="order_list.php"><i class="bi bi-caret-left-fill" title="回訂單列表"></i></a><br>
                                    <?php echo "(關鍵字：" . $_GET["search_text"] . ")"; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                    </div>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex" style="background-color: #ACACAC;">
                            <!-- Search -->
                            <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" action="order_list.php" method="get">
                                <div class="input-group" style="width: 400px;">
                                    <select class="form-select" name="search_type" aria-label="Default select example" style="width: 25%;">
                                        <option selected disabled>搜尋項目...</option>
                                        <option value="instrument_order_items.id">訂單編號</option>
                                        <option value="users.name">訂購者</option>
                                        <option value="instrument.name">訂購商品</option>
                                    </select>
                                    <input style="width: 50%;" type="text" name="search_text" id="searchText" class="form-control bg-light small" placeholder="搜尋..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-dark" name="search_submit" value="search_btn" type="submit">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <h6 class="m-0 font-weight-bold text-dark my-auto">顯示<?= $page_start ?> 到 <?= $page_end ?>筆 共<?= $totalOrder ?>筆 目前在第<?= $page ?>頁 共<?= $pageCount ?>頁</h6>
                        </div>
                        <div class="card-body">
                            <?php if ($totalOrder > 0) : ?>
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered" id="datTable" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>訂單號碼</th>
                                                <th>訂購者</th>
                                                <th>下訂時間</th>
                                                <th>總價</th>
                                                <th>運輸狀態</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>訂單號碼</th>
                                                <th>訂購者</th>
                                                <th>下訂時間</th>
                                                <th>總價</th>
                                                <th>運輸狀態</th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php foreach ($rows as $row) : ?>
                                                <tr>
                                                    <th class="align-middle" scope="row"><?= $row["orderID"] ?></th>
                                                    <td><?= $row["name"] ?></td>
                                                    <td><?= $row["date"] ?></td>
                                                    <td><?= $row["amount"] ?></td>
                                                    <td><?= $row["state"] ?></td>
                                                    <td class="text-end">
                                                        <button class="btn btn-primary" id="coll<?= $row["orderID"] ?>" type="button" data-toggle="collapse" data-target="#details<?= $row["orderID"] ?>" aria-expanded="false" aria-controls="details<?= $row["orderID"] ?>">
                                                            <i class="bi bi-info-circle-fill pe-2"></i>詳細資料
                                                        </button>
                                                        <a href="order_edit.php?id=<?= $row["orderID"] ?>" type="button" class="btn btn-secondary text-white"><i class="bi bi-pen-fill pe-2"></i>修改訂單狀態</a>
                                                    </td>
                                                </tr>
                                                <tr class="collapse" id="details<?= $row["orderID"] ?>">
                                                    <td colspan="6">
                                                        <ul class="list-unstyled">
                                                            <li>電話:<?= $row["phone"] ?></li>
                                                            <li>地址:<?= $row["address"] ?></li>
                                                            <li>訂購商品：<?= $row["product_name"] ?></li>
                                                            <li>數量：<?= $row["quantity"] ?></li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php if ($pageCount > 1) : ?>
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination d-flex justify-content-center">
                                                <li class="page-item">
                                                    <a class="page-link" href="order_list.php?page=1" aria-label="Previous">
                                                        <span aria-hidden="true">回到第一頁</span>
                                                    </a>
                                                </li>
                                                <li class="page-item">
                                                    <?php if ($page == 1) : ?>
                                                        <a class="page-link disabled" aria-label="Previous" aria-disabled="true">
                                                        <?php else : ?>
                                                            <a class="page-link" href="order_list.php?page=<?= $page - 1 ?>" aria-label="Previous">
                                                            <?php endif; ?>
                                                            <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                </li>
                                                <?php if ($page > $page_left + 1) : ?>
                                                    <?php for ($i = $page - $page_left; $i < $page; $i++) : ?>
                                                        <li class="page-item <?php if ($page == $i) echo "active" ?>">
                                                            <a class="page-link" href="order_list.php?page=<?= $i ?>"><?= $i ?></a>
                                                        </li>
                                                    <?php endfor; ?>
                                                <?php else : ?>
                                                    <?php for ($i = 1; $i < $page; $i++) : ?>
                                                        <li class="page-item <?php if ($page == $i) echo "active" ?>">
                                                            <a class="page-link" href="order_list.php?page=<?= $i ?>"><?= $i ?></a>
                                                        </li>
                                                    <?php endfor; ?>
                                                <?php endif; ?>
                                                <?php if ($page <= $pageCount - $page_right) : ?>
                                                    <?php for ($i = $page; $i <= $page + $page_right; $i++) : ?>
                                                        <li class="page-item <?php if ($page == $i) echo "active" ?>">
                                                            <a class="page-link" href="order_list.php?page=<?= $i ?>"><?= $i ?></a>
                                                        </li>
                                                    <?php endfor; ?>
                                                <?php else : ?>
                                                    <?php for ($i = $page; $i <= $pageCount; $i++) : ?>
                                                        <li class="page-item <?php if ($page == $i) echo "active" ?>">
                                                            <a class="page-link" href="order_list.php?page=<?= $i ?>"><?= $i ?></a>
                                                        </li>
                                                    <?php endfor; ?>
                                                <?php endif; ?>
                                                <li class="page-item">
                                                    <?php if ($page == $pageCount) : ?>
                                                        <a class="page-link disabled" aria-label="Next" aria-disabled="true">
                                                        <?php else : ?>
                                                            <a class="page-link" href="order_list.php?page=<?= $page + 1 ?>" aria-label="Next">
                                                            <?php endif; ?>
                                                            <span aria-hidden="true">&raquo;</span>
                                                            </a>
                                                </li>
                                                <li class="page-item">
                                                    <a class="page-link" href="order_list.php?page=<?= $pageCount ?>" aria-label="Previous">
                                                        <span aria-hidden="true">到最後一頁</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </nav>
                                    <?php endif; ?>
                                </div>
                            <?php else : ?>
                                <h1>查無訂單資料</h1>
                            <?php endif; ?>
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
                        <span>Copyright &copy; Your Website 2020</span>
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
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <!-- auto collapse -->

    <script>
        <?php foreach ($rows as $row) : ?>
            $("button").click(function() {
                $('#coll<?= $row["orderID"] ?>').addClass("collapsed");
                $('#coll<?= $row["orderID"] ?>').attr("aria-expanded", false);
                $("#details<?= $row["orderID"] ?>").removeClass("show");
                $("#details<?= $row["orderID"] ?>").attr("aria-expanded", false);
            });
        <?php endforeach; ?>
    </script>

    <!-- <script>
            $("button").click(function(){
                alert("The paragraph was clicked.");
        });
        </script> -->

</body>

</html>