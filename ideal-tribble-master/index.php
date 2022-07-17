<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="./css/style.css" rel="stylesheet">
    <title>Grocery Store Management System</title>
    <style>
        .index-from {
            margin-top: 20px;
            border-style: solid;
            border-width: 1px;
            border-color: cornflowerblue;
            background-color: #fafafa;
            padding: 20px;
            border-radius: 5px;
        }
    </style>
</head>

<?php
session_start();
if (isset($_SESSION['id'])) {
    header("Location: dashboard.php");
}
?>

<body>
    <nav class="navbar navbar-light bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand navbar-title" href="index.php" style="color: cornflowerblue;">Grocery Store Management System</a>
            <a class="nav-link" href="about.php">AboutUs</a>
        </div>
    </nav>

    <div class="container col-5 text-center">
        <div style="font-weight: bold; font-size: 36px; margin-top: 100px; color: cornflowerblue;">Grocery Store Management System</div>
        <div style="font-size: 28px;">Admin</div>
    </div>

    <div class="container-lg col-3 index-from">
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="username" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div style="text-align: center">
                <button type="submit" class="btn btn-primary" style="width: 150px;">Login</button>
            </div>

            <?php if (isset($_GET['error'])) { ?>

                <div class="alert alert-danger" style="margin-top: 20px;" role="alert">
                    <?php echo $_GET['error'] ?>
                </div>

            <?php } ?>

        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>