<?php

if (!isset($_GET["id"])) {
    header("location: classroom-list.php");
}

$id = $_GET["id"];


require_once("boundless_connect.php");

// $conn = new mysqli($servername, $username, $password, $dbname);
// // 檢查連線


$sql = "SELECT * FROM classroom WHERE id=$id AND valid=1";

// if (!$conn->query($sql)) {
//     die("連線失敗: " .
//         $conn->error);
// } else {
//     echo "資料庫連線成功";
// }

$result = $conn->query($sql);
$classroomCount = $result->num_rows;

$row = $result->fetch_assoc();

// var_dump($row);
?>


<!doctype html>
<html lang="en">

<head>
    <title>編輯資訊</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


</head>

<body>
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">警告</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    確認刪除?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消
                    </button>
                    <a href="doDeleteClassroom.php?id=<?= $row["id"] ?>" class="btn btn-danger">
                        確認
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="py-2">
            <a class="btn btn-dark text-white" href="classroom-detail.php?id=<?= $row["id"] ?>" title="回使用者列表"><i class="bi bi-arrow-left">回練團室詳細資訊</i></a>
        </div>
        <?php if ($classroomCount == 0) : ?>
            <h1>練團室不存在</h1>
        <?php else : ?>
            <form action="doUpdateClassroom.php" method="post">
                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                <table class="table table-bordered">

                    <tr>
                        <th>練團室</th>
                        <td>
                            <input type="text" class="form-control" name="name" value="<?= $row["name"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>價格</th>
                        <td>
                            <input type="text" class="form-control" name="price" value="<?= $row["price"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>區域</th>
                        <td>
                            <input type="text" class="form-control" name="region" value="<?= $row["region_id"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>地址</th>
                        <td>
                            <input type="address" class="form-control" name="address" value="<?= $row["address"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>電話</th>
                        <td><input type="tel" class="form-control" name="phone" value="<?= $row["phone"] ?>"></td>
                    </tr>
                    <tr>
                        <th>其他聯絡方式</th>
                        <td><input type="email" class="form-control" name="email" value="<?= $row["email"] ?>"></td>
                    </tr>
                    <!-- <tr>
                        <th>設備資訊</th>
                        <td><input type="text" class="form-control" name="info" value=""></td>
                    </tr> -->

                </table>

                <div class="py-2 d-flex justify-content-end">
                    <div>
                        <button class="btn btn-dark text-white" type="submit">儲存</button>
                        <a class="btn btn-dark text-white" href="classroom-detail.php?id=<?= $row["id"] ?>">取消</a>
                    </div>
                    <!-- 
                    <div>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#alertModal" class="btn btn-danger">刪除</button>
                    </div> -->
                </div>
            </form>
        <?php endif; ?>
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