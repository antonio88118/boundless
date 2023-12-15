<?php
if (!isset($_GET["id"])) {
    header("location: lesson-list.php");
}

$id = $_GET["id"];

require("boundless_connect.php");
$sql = "SELECT * FROM lesson WHERE id=$id AND valid=1";

$result = $conn->query($sql);
$userCount = $result->num_rows;

$row = $result->fetch_assoc();

?>
<!doctype html>
<html lang="en">

<head>
    <title>delete-lesson</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
    include("main-css.php");
    ?>

    <link rel="icon" href="favicon.svg">
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                    <a href="doDeleteUser.php?id=<?= $row["id"] ?>" class="btn btn-danger">確認</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="py-2">
            <a class="btn btn-info text-white" href="lesson-list.php" title="回使用者列表"><i class="bi bi-arrow-left"></i></a>
        </div>
        <?php if ($userCount == 0) : ?>
            <h1>使用者不存在</h1>
        <?php else : ?>
            <form action="doUpdateUser.php" method="post">
                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                <table class="table table-bordered">

                    <tr>
                        <th>name</th>
                        <td>
                            <input type="text" class="form-control" name="name" value="<?= $row["name"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>email</th>
                        <td><input type="email" class="form-control" name="email" value="<?= $row["email"] ?>"></td>
                    </tr>
                    <tr>
                        <th>phone</th>
                        <td><input type="tel" class="form-control" name="phone" value="<?= $row["phone"] ?>"></td>
                    </tr>
                </table>
                <div class="py-2 d-flex justify-content-between">
                    <div>
                        <button class="btn btn-info text-white" type="submit">儲存</button>
                        <a class="btn btn-info text-white" href="user.php?id=<?= $row["id"] ?>">取消</a>
                    </div>
                    <div>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#alertModal" class="btn btn-danger">刪除</button>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>