<?php
if (!isset($_GET["id"])) {
    header("location: teacher-list.php");
}

$id = $_GET["id"];

require("boundless_connect.php");
$sql = "SELECT * FROM teacher_info WHERE id=$id AND valid=1";

$result = $conn->query($sql);
$teacherCount = $result->num_rows;

$row = $result->fetch_assoc();

?>
<!doctype html>
<html lang="en">

<head>
    <title>Teacher EDIT</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
    include("main-css.php");
    ?>

</head>

<body>
    <div class="container">
        <div class="py-2">
            <a class="btn btn-dark text-white" href="lesson-list.php" title="回課程列表"><i class="fas fa-fw fa-table"></i> 課程</a>
            <a class="btn btn-dark text-white" href="teacher-list.php" title="回使用者列表"><i class="fa-solid fa-book-open-reader"></i> 教師</a>
        </div>
        <?php if ($teacherCount == 0) : ?>
            <h1>使用者不存在</h1>
        <?php else : ?>
            <form action="doUpdateTeacher.php" method="post">
                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                <table class="table table-bordered">
                    <tr>
                        <th>name</th>
                        <td>
                            <?= $row["name"] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>img</th>
                        <td>
                            <div class="ratio ratio-4x3 teacher-img">
                                <img class="object-fit-cover" src="./teacher_img/<?= $row["img"] ?>" alt="">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>info</th>
                        <td>
                            <?= $row["info"] ?>
                        </td>
                    </tr>
                    <tr>
                        <th>email</th>
                        <td>
                            <?= $row["email"] ?>
                        </td>
                    </tr>
                </table>
                <div class="py-2 d-flex justify-content-between">
                    <div>
                        <a class="btn btn-dark text-white" href="teacher-edit.php?id=<?= $row["id"] ?>">修改</a>
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