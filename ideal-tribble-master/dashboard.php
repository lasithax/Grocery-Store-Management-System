<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./images/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Grocery Store Management System</title>

    <style>
        .dash-text {
            color: cornflowerblue;
            font-size: 26px;
            font-weight: bold;
            padding-bottom: 50px;
        }
    </style>
</head>


<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}
include 'dashboard_controller.php';
?>


<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php" style="color: cornflowerblue;">
                Grocery Store Management System</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav navbar-dark">
                    <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
                    <a class="nav-link" href="billing.php">Billing</a>
                    <a class="nav-link" href="customer.php">Customers</a>
                    <a class="nav-link" href="inventory.php">Inventory</a>
                    <a class="nav-link" href="bills.php">Bills</a>
                </div>
            </div>

            <div class="d-flex">
                <button type="submit" class="btn btn-sm btn-outline-danger button" value="logout" name="logout">Logout</button>
            </div>
        </div>
    </nav>

    <div class="d-flex flex-column" style="margin-top: 170px;">
        <div class="d-flex justify-content-center dash-text">#Monthly Income: Rs. <?php echo getMonthlyIncome(); ?></div>
        <div class="d-flex justify-content-center dash-text">#Monthly Sales: <?php echo getMonthlySales(); ?></div>
        <div class="d-flex justify-content-center dash-text">#Total Number Of Items: <?php echo getNoItems(); ?></div>
        <div class="d-flex justify-content-center dash-text">#Total Number Of Customers: <?php echo getNoCustomers(); ?></div>
    </div>

    <script>
        $(document).ready(function() {
            $(".button").click(function() {
                var btnVal = $(this).val();
                if (btnVal == "logout") {
                    var ajaxurl = "common_controller.php",
                        data = {
                            action: btnVal,
                        };
                    $.post(ajaxurl, data, function(response) {
                        window.location.replace("index.php");
                    });
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>