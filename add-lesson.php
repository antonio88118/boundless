<?php
require_once("boundless_connect.php");
include("main-css.php");

// 取得類別資料，用於產生類別的下拉式清單
$categorySql = "SELECT * FROM instrument_category WHERE valid=1";
$categoryResult = $conn->query($categorySql);
$categoryRows = $categoryResult->fetch_all(MYSQLI_ASSOC);

$teacherSql = "SELECT teacher_info.* FROM teacher_info WHERE valid =1";
$teacherResult = $conn->query($teacherSql);
$teacherRows = $teacherResult->fetch_all(MYSQLI_ASSOC);

$classroomSql = "SELECT classroom.* FROM classroom WHERE valid =1";
$classroomResult = $conn->query($classroomSql);
$classroomRows = $classroomResult->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>新增商品</title>

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

    <!-- 從這裡改 -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fa-solid fa-music"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Borderless</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - 首頁 -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fa-solid fa-house"></i>
                    <span>首頁</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - 折疊式選單 -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fa-solid fa-house-medical"></i>
                    <span>課程總攬</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="lesson-list.php"><i class="ms-2 fas fa-fw fa-table"></i>課程管理</a>
                        <a class="collapse-item" href="teacher-list.php"><i class="ms-2 fa-solid fa-book-open-reader"></i> 教師資訊</a>
                    </div>
                </div>
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
                        <h1 class="h3 text-gray-800 text-center">新增商品</h1>
                        <a class="btn btn-secondary" href="lesson-list.php"><i class="fa-solid fa-reply"></i> 回商品清單</a>
                    </div>

                    <div class="mx-3 py-3 row gx-5">

                        <!-- 圖片顯示 -->
                        <div class="col-4">
                            <div class="bg-body border ratio ratio-1x1">

                                <img class="object-fit-contain p-2 d-none" src="#" alt="預覽圖片" id="preview_image">
                            </div>
                            <!-- Start of Form -->
                            <form action="doAddLesson.php" method="post" enctype="multipart/form-data">
                                <!-- 上傳檔案 -->
                                <div class="my-2 text-center fw-bold">上傳圖片</div>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="img" id="preview_image_input">
                                </div>
                        </div>

                        <div class="col-8 pe-2">
                            <table class="table table-striped-columns">
                                <tr class="row">
                                    <td class="col-2 border-start fw-bold">課程名稱</td>
                                    <td class="col-10 border-end p-1">
                                        <input type="text" class="form-control" style="width: 50%;" name="name">
                                    </td>
                                </tr>

                                <tr class="row">
                                    <td class="col-2 border-start fw-bold">價格</td>
                                    <td class="col-10 border-end p-1">
                                        <input type="number" class="form-control" style="width: 20%;" oninput="if(value.length>7)value=value.slice(0,7)" name="price">
                                    </td>
                                </tr>
                                <tr class="row">
                                    <td class="col-2 border-start fw-bold">課程種類</td>
                                    <td class="col-10 border-end p-1">
                                        <div class="col-sm-10">
                                            <select class="form-select" aria-label="Default select example" id="category_id" name="category_id">
                                                <option value="1">鋼琴</option>
                                                <option value="2">吉他</option>
                                                <option value="3">理樂</option>
                                                <option value="4">鼓</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="row">
                                    <td class="col-2 border-start fw-bold">教室名稱</td>
                                    <td class="col-10 border-end p-1">
                                        <div class="col-sm-10">
                                            <select class="form-select" aria-label="Default select example" id="classroom_id" name="classroom_id">
                                                <option value="1001">線上</option>
                                                <?php foreach ($classroomRows as $classroomRow) : ?>
                                                    <option value="<?= $classroomRow["id"] ?>"><?= $classroomRow["name"] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="row">
                                    <td class="col-2 border-start fw-bold">教師名稱</td>
                                    <td class="col-10 border-end p-1">
                                        <select class="form-select" aria-label="Default select example" id="teacher_id" name="teacher_id">
                                            <?php foreach ($teacherRows as $teacherRow) : ?>
                                                <option value="<?= $teacherRow["id"] ?>"><?= $teacherRow["name"] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="row">
                                    <td class="col-2 border-start fw-bold">*上架時間</td>
                                    <td class="col-10 border-end">
                                        <input type="datetime-local" class="form-control" style="width: 40%;" name="onshelf_time" min="<?= date("Y-m-d H:i") ?>">
                                    </td>
                                </tr>

                                <tr class="row">
                                    <td class="col-2 border-start fw-bold">詳細資料</td>
                                    <td class="col-10 border-end p-1">
                                        <textarea class="form-control" placeholder="輸入內容..." name="info" style="resize:none;" rows="10"></textarea>
                                    </td>
                                </tr>
                            </table>


                            <div class="text-center d-flex justify-content-center">

                                <!-- 取消鍵 -->
                                <a class="btn btn-secondary me-5 px-3" href="instrument-detail.php?id=<?= $row["id"] ?>">取消</a>

                                <!-- 儲存鍵 -->
                                <a class="btn btn-primary px-3" data-bs-toggle="modal" data-bs-target="#saveModal"><i class="fa-solid fa-floppy-disk"></i> 儲存</a>
                                <!-- Modal -->
                                <div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">系統提示</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-start">
                                                確定儲存內容？
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                                <!-- 提交按鍵 -->
                                                <button type="submit" class="btn btn-primary" name="id" value="<?= $row["id"] ?>">確定</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            </form>
                            <!-- End of Form -->
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

    <!-- 圖片預覽 -->
    <script>
        // 當圖片input有變化時，執行readURL()
        $(document).ready(function(){
            $("#preview_image_input").change(function() {
                readURL(this); // this代表<input id="preview_image_input">
            });
        });
        

        function readURL(input) {
            if (input.files && input.files[0]) {
                // FileReader(): JavaScript預設的Object，用來讀取檔案的標準API
                // 如果要FileReader去讀檔案，必須給他一個檔案Object，拿到檔案Object後會驅動onload事件
                var reader = new FileReader();

                reader.onload = function(e) {
                    // 使用attr()改變DOM物件內容，attr(屬性值, 改變內容)
                    // 改變<img id="preview_image">的屬性值
                    $("#preview_image").attr("src", e.target.result).show();
                    $("#preview_image").attr("class", "object-fit-contain p-2");
                };
                // 讀取圖片檔案
                reader.readAsDataURL(input.files[0]);
            }
        };
    </script>

</body>

</html>