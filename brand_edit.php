<?php
if(!isset($_GET["id"])){
    header("location: brand_list.php");
}

$id = $_GET["id"];

require("boundless_connect.php");
$sql = "SELECT * FROM brand WHERE id=$id AND valid=1";

$result = $conn->query($sql);
$brandCount = $result->num_rows;

$row = $result->fetch_assoc();


?>

<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Brand Edit</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        .table th, .table td{
            vertical-align: middle;
        }

        .pagination > li > a
        {
            background-color: white;
            color: #5A4181;
        }

        .pagination > li > a:focus,
        .pagination > li > a:hover,
        .pagination > li > span:focus,
        .pagination > li > span:hover
        {
            color: #5a5a5a;
            background-color: #eee;
            border-color: #ddd;
        }

        .pagination > .active > a
        {
            color: white;
            background-color: #5A4181 !Important;
            border: solid 1px #5A4181 !Important;
        }

        .pagination > .active > a:hover
        {
            background-color: #5A4181 !Important;
            border: solid 1px #5A4181;
        }


    </style>

</head>

<body>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">警告</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            未儲存記錄將會清除
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
            <a type="button" class="btn btn-dark" href="brand_list.php">確認</a>
        </div>
        </div>
    </div>
    </div>
    <div class="container">
        <div class="py-2">
            <a class="btn btn-dark" href="brand_list.php" data-bs-toggle="modal" data-bs-target="#exampleModal">回樂器品牌列表</a>
        </div>
        <?php if($brandCount ==0): ?>
            <h1>使用者不存在</h1>
        <?php else: ?>
            <form action="doUpdatebrand.php" method="get">
                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                <table>
                    <tr>
                        <th>更改樂器名稱</th>
                        <td>
                            <input type="text" class="form-control" name="name" value="<?=$row["name"]?>">
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                    </tr>
                </table>
                <div class="py-2">
                    <button class="btn btn-dark text-white" type="submit">儲存</button>
                    <a href="brand_edit.php?id=<?= $row["id"] ?>" class="btn btn-dark text-white">取消</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>