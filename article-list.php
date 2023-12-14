<?php
require_once("boundless_connect.php");
mysqli_set_charset($conn, "utf8");

// 製作分頁
$countSql = "SELECT article.* FROM article WHERE valid=1";
$countResult = $conn->query($countSql);
// 資料總筆數
$countTotal = $countResult->num_rows;

$dataPerPage = 10; // 每頁顯示資料數
$pageCount = ceil($countTotal / $dataPerPage); // 計算需要的頁數
// if (isset($_GET["page"])) {
//     $pageNow = $_GET["page"];
//     $startItem = ($pageNow - 1) * $dataPerPage; // 每頁第一筆資料在陣列的key ex:(3-1)*20=40 ->key=40, id=41的資料
//     $sql = "SELECT article.*, article_category.name AS category_name FROM article 
//     JOIN article_category ON article.category_id = article_category.id
//     WHERE valid=1 
//     ORDER BY id ASC 
//     LIMIT $startItem, $dataPerPage"; //從key 0開始，抓20筆
// } else if(isset($_GET["search-article"])) {
//     $search = $_GET["search-article"];
//     // echo $search;

//     $sql = "SELECT article.*, article_category.name AS category_name FROM article 
//     JOIN article_category ON article.category_id = article_category.id
//     WHERE title LIKE '%$search%' OR content LIKE '%$search%'  AND valid=1
//     ORDER BY id ASC ";
        
// } else {
//     $pageNow = 1; // 目前所在頁面
//     $sql = "SELECT article.*, article_category.name AS category_name FROM article 
//     JOIN article_category ON article.category_id = article_category.id
//     WHERE valid=1 
//     ORDER BY id ASC 
//     LIMIT 0, $dataPerPage"; //從key 0開始，抓20筆
// }

if (isset($_GET["page"]) && isset($_GET["order"])) {
    $pageNow = $_GET["page"];
    $startItem = ($pageNow - 1) * $dataPerPage;
    $order = $_GET["order"];
    switch ($order){
        case 1:
            $orderDirection = "ASC";
            break;
        case 2:
            $orderDirection = "DESC";
            break;
        default:
            $orderDirection = "ASC"; // 預設升序
    }
    $sql = "SELECT article.*, article_category.name AS category_name FROM article 
    JOIN article_category ON article.category_id = article_category.id
    WHERE valid=1
    ORDER BY article.id $orderDirection 
    LIMIT $startItem, $dataPerPage";

}elseif (isset($_GET["search-article"])) {
    $search = $_GET["search-article"];
    $searchSql = "AND (title LIKE '%$search%' OR content LIKE '%$search%')";
    $sql = "SELECT article.*, article_category.name AS category_name FROM article 
    JOIN article_category ON article.category_id = article_category.id
    WHERE valid=1 $searchSql";

}else{
    $startItem = 0;
    $pageNow = 1;
    $order = 1;
    $sql = "SELECT article.*, article_category.name AS category_name FROM article 
    JOIN article_category ON article.category_id = article_category.id
    WHERE valid=1
    ORDER BY article.id ASC
    LIMIT $startItem, $dataPerPage";
    
}



// $searchSql = "";




// if (isset($_GET["search-active"])) {
//     $search = $_GET["search-active"];
//     // echo $search;

//     $sql = "SELECT * FROM active    
//     WHERE name LIKE '%$search%' OR discount LIKE '%$search%' OR requirement LIKE '%$search%' AND valid=1  ORDER BY id ASC";
// }else {
//     $page=1;
//     $order=1;
//     $sql = "SELECT * FROM active WHERE valid=1 ORDER BY id ASC LIMIT 0,$dataPerPage";
// }



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

    <title>文章列表</title>


    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- bs icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">

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
            <li class="nav-item active">
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Welcome, manager</span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
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

                    <div class="container-top_Nue py-2 d-flex justify-content-between align-items-center">
                        <div>
                            <!-- Page Heading -->
                            <h1 class="h3 mb-2 text-gray-800">官方音樂文章</h1>
                            <p class="mb-4">本頁面能夠新增文章，或是查看文章狀態。</p>
                        </div>
                  
                        <div class="py-1">
    <form action="">
        <div class="row g-3 align-items-center">

            <?PHP if (isset($_GET["search-article"])) : ?>
                <div class="col-auto">
                    <a class="btn btn-dark" href="article-list.php">
                        <i class="bi bi-backspace"></i>
                    </a>

                </div>
            <?PHP endif; ?>

            <div class="col-auto">
                <input type="text" class="form-control text-start " name="search-article" value="<?PHP $searchArticle = isset($_GET["search-article"]) ? $search : "";
                                                                                                echo $searchArticle; ?>" placeholder="可以搜尋文章" required>
            </div>

            <div class="col-auto">
                <button class="btn btn-dark text-white" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
    </form>
</div>

                        <div class="justify-content-end">
                        <?PHP if (!isset($_GET["order-article"])) : ?>
                            
                            <!-- <form action="article-list.php?page=<?= $datapageNow + 1?>&order=1>" method="GET">
    <input type="hidden" name="order" value="asc">
    <button class="btn btn-dark" type="submit" name="submitOrderAsc"><i class="bi bi-sort-down-alt"></i></button>
</form> -->

<!-- <form action="" method="GET">
    <input type="hidden" name="order" value="desc">
    <button class="btn btn-dark" type="submit" name="submitOrderDesc"><i class="bi bi-sort-up"></i></button>
</form> -->
<a class="btn btn-dark" href="article-list.php?page=<?= $pageNow ?>&order=1"><i class="bi bi-sort-down-alt"></i></a>
<a class="btn btn-dark" href="article-list.php?page=<?= $pageNow ?>&order=2"><i class="bi bi-sort-up"></i></a>

                            <a class="btn btn-dark " title="新增文章" href="add-article.php">
                                <i class="bi bi-plus-lg"></i>
                                文章
                            </a>
                            <?PHP endif; ?>
                        </div>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-dark">文章清單</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>文章標題</th>
                                            <th>內容</th>
                                            <th>圖片</th>
                                            <th>文章種類</th>
                                            <th>創建時間</th>
                                            <th>更新時間</th>
                                            <th>詳細資訊</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>文章標題</th>
                                            <th>內容</th>
                                            <th>圖片</th>
                                            <th>文章種類</th>
                                            <th>創建時間</th>
                                            <th>更新時間</th>
                                            <th>詳細資訊</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?PHP foreach ($rows as $row) : ?>

                                            <tr>
                                                <td><?= $row["id"] ?></td>
                                                <td><?= $row["title"] ?></td>
                                                <td><?= $row["content"] ?></td>
                                                <td><?= $row["img"] ?></td>
                                                <td><?= $row["category_name"] ?></td>
                                                <td><?= $row["created_time"] ?></td>
                                                <td><?= $row["updated_time"] ?></td>
                                                <td>
                                                    <form action="article.php?id=<?= $row["id"] ?>">
                                                        <button class="btn btn-dark" title="詳細資訊" name="id" value="<?= $row["id"] ?>">查看</button>
                                                    </form>

                                                </td>
                                            </tr>
                                        <?PHP endforeach; ?>

                                    </tbody>

                                </table>


                                <?PHP if (!isset($_GET["search-article"])) : ?>
                                <!-- 產生分頁 -->
                                <div class="py-2">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination d-flex justify-content-center">
                                            <!-- 若在第一頁，上一頁無效 -->
                                            <li class="page-item">
                                                <?php if ($pageNow == 1) : ?>
                                                    <a class="page-link disabled" aria-label="Previous" aria-disabled="true">
                                                    <?php else : ?>
                                                        <a class="page-link" href="article-list.php?page=<?= $pageNow - 1 ?>&order=<?=$order?>" aria-label="Previous">
                                                        <?php endif; ?>
                                                        <span aria-hidden="true">&laquo;</span>
                                                        <span class="sr-only">Previous</span>
                                                        </a>
                                            </li>
                                            <!-- 數字頁碼 -->
                                            <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                                                <li class="page-item <?php if ($pageNow == $i) echo "active"; ?>">
                                                    <a class="page-link" href="article-list.php?page=<?= $i ?>&order=<?=$order?>"><?= $i ?></a>
                                                </li>
                                            <?php endfor; ?>
                                            <li class="page-item">
                                                <!-- 若在最後一頁，下一頁無效 -->
                                                <?php if ($pageNow == $pageCount) : ?>
                                                    <a class="page-link disabled" aria-label="Next" aria-disabled="true">
                                                    <?php else : ?>
                                                        <a class="page-link" href="article-list.php?page=<?= $pageNow + 1 ?>&order=<?= $order ?>" aria-label="Next">
                                                        <?php endif; ?>
                                                        <span aria-hidden="true">&raquo;</span>
                                                        <span class="sr-only">Next</span>
                                                        </a>
                                            </li>
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

</body>

</html>