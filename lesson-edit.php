<?php
if (!isset($_GET["id"])) {
    header("location: lesson-list.php");
}

$id = $_GET["id"];

require("boundless_connect.php");
$sql = "SELECT lesson.*, lesson_category.name AS category_name, teacher_info.name AS teacher_name FROM lesson 
JOIN lesson_category ON lesson.category_id = lesson_category.id
JOIN teacher_info ON lesson.teacher_id = teacher_info.id
WHERE lesson.id = $id";

$result = $conn->query($sql);
$lessonCount = $result->num_rows;

$row = $result->fetch_assoc();

$teacherSql = "SELECT teacher_info.* FROM teacher_info WHERE valid =1";

$teacherResult = $conn->query($teacherSql);
$teacherRows = $teacherResult->fetch_all(MYSQLI_ASSOC);

?>
<!doctype html>
<html lang="en">

<head>
    <title>Lesson EDIT</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
    include("main-css.php");
    ?>

    <link rel="icon" href="favicon.svg">
</head>

<body>
    <div class="container">
        <div class="py-2">
            <a class="btn btn-dark text-white" href="lesson-list.php" title="回使用者列表"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <?php if ($lessonCount == 0) : ?>
            <h1>使用者不存在</h1>
        <?php else : ?>
            <form action="doUpdateLesson.php" method="post">
                <input type="hidden" name="id" value="<?= $row["id"] ?>">
                <table class="table table-bordered">
                    <tr>
                        <th>課程名稱</th>
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
                        <th>課程種類</th>
                        <td>
                            <select class="form-select" aria-label="Default select example" id="category_id" name="category_id">
                                <option value="1">鋼琴</option>
                                <option value="2">吉他</option>
                                <option value="3">理樂</option>
                                <option value="4">鼓</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>教室名稱</th>
                        <td>
                            <input type="text" class="form-control" name="classroom_id" value="<?= $row["classroom_id"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>教師名稱</th>
                        <td>
                            <select class="form-select" aria-label="Default select example" id="teacher_id" name="teacher_id">
                                <?php foreach ($teacherRows as $teacherRow): ?>
                                <option value="<?=$teacherRow["id"]?>"><?= $teacherRow["name"] ?></option>
                                <?php endforeach;?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>圖片</th>
                        <td>
                            <input type="text" class="form-control" name="img" value="<?= $row["img"] ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>詳細資料</th>
                        <td>
                            <input type="text" class="form-control" name="info" value="<?= $row["info"] ?>">
                        </td>
                    </tr>
                </table>
                <div class="py-2 d-flex justify-content-between">
                    <div>
                        <button class="btn btn-dark text-white" type="submit">儲存</button>
                        <a class="btn btn-dark text-white" href="lesson-list.php">取消</a>
                    </div>
                    <div>
                        <a class="btn btn-danger text-white" href="doDeleteLesson.php?id=<?= $row["id"] ?>">刪除</a>
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