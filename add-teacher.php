<!doctype html>
<html lang="en">

<head>
    <title>Add Teacher</title>
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
            <a class="btn btn-dark text-white" href="teacher-list.php" title="回使用者列表"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
        <form action="doAddList-teacher.php" method="post">
            <div class="row mb-3">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="img" class="col-sm-2 col-form-label">Img</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="img" name="img" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="info" class="col-sm-2 col-form-label">Info</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="info" name="info" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <button class="btn btn-dark text-white" type="submit">送出</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>