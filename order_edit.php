<?php
if(!isset($_GET["id"])){
    header("location: order_list.php");
}

$id = $_GET["id"];

require("boundless_connect.php");

$sql = "SELECT * FROM instrument_order
        LEFT JOIN transportation ON instrument_order.transportation_state = transportation.id
        JOIN users ON instrument_order.user_id = users.id
        WHERE orderID=$id";

$result = $conn->query($sql);
$orderCount = $result->num_rows;

$row = $result->fetch_assoc();


?>

<!-- <pre>
    <?php
    print_r($row);
    ?>
</pre> -->

<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Order Edit</title>

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
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            確認刪除？
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary">確認</button>
        </div>
        </div>
    </div>
    </div>
    <div class="container">
        <div class="py-2">
            <a class="btn btn-dark" href="order_list.php">回訂單列表</a>
        </div>
        <?php if($orderCount ==0): ?>
            <h1>使用者不存在</h1>
        <?php else: ?>
            <form action="doUpdatestate.php" method="get">
                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                <table>
                    <tr>
                        <th>更改訂單狀態：</th>
                        <td>
                        <select name="state" class="form-select" aria-label="Default select example">
                            <option selected>請選擇訂單狀態</option>
                            <option value="1">訂單成立</option>
                            <option value="2">運送中</option>
                            <option value="3">已送達</option>
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <th></th>
                        <td></td>
                    </tr>
                </table>
            

            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">訂購者名稱</th>
                    <th scope="col">電話</th>
                    <th scope="col">地址</th>
                    <th scope="col">訂單狀態</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row"><?=$row["orderID"]?></th>
                    <td><?=$row["name"]?></td>
                    <td><?=$row["phone"]?></td>
                    <td><?=$row["address"]?></td>
                    <td><?=$row["state"]?></td>
                </tr>
                </tbody>
            </table>

            <div class="py-2">
                <button class="btn btn-dark text-white" type="submit" >儲存</button>
                <a href="order_edit.php?id=<?=$row["orderID"]?>" class="btn btn-dark text-white">取消</a>
                
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