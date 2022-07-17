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
        .table-style {
            background-color: #fafafa;
            margin-top: 12px;
            /* border-radius: 5px;
            border-style: solid;
            border-width: 1px;
            border-color: cornflowerblue; */
        }

        .table-container {
            margin-top: 30px;
            position: relative;
            height: 475px;
            overflow: auto;

            border: 1px solid cornflowerblue;
            border-radius: 5px;
        }

        .selected-row {
            background-color: cornflowerblue;
            color: #FFF;
        }

        td {
            cursor: pointer;
        }
    </style>
</head>


<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
}
include 'inventory_controller.php';
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

                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                    <a class="nav-link" href="billing.php">Billing</a>
                    <a class="nav-link" href="customer.php">Customers</a>
                    <a class="nav-link active" aria-current="page" href="inventory.php">Inventory</a>
                    <a class="nav-link" href="bills.php">Bills</a>
                </div>
            </div>

            <div class="d-flex">
                <button type="submit" class="btn btn-sm btn-outline-danger button" value="logout" name="logout">Logout</button>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 30px;">
        <div class="row justify-content-end">
            <div class="col-3 text-end">
                <label for="searchTxt">Search</label>
                <input type="text" name="searchTxt" style="margin-left: 5px;" id="searchTxt"></input>
            </div>
        </div>
    </div>

    <div class="container table-container">
        <table class="table table-hover table-style table-bordered" id="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Item</th>
                    <th scope="col">Unit Price</th>
                    <th scope="col">Qty</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php echo getInventory(null); ?>
            </tbody>
        </table>
    </div>

    <div class="container-fluid" style="margin-top: 30px; padding-right: 110px;">
        <div class="d-flex flex-row-reverse">
            <div class="p-2">
                <button type="button" class="btn btn-danger btn-sm button" style="width: 80px;" value="delete-modal">Delete</button>
            </div>
            <div class="p-2">
                <button type="button" class="btn btn-primary btn-sm button" style="width: 80px;" value="update-modal">Update</button>
            </div>
            <div class="p-2">
                <button type="button" class="btn btn-primary btn-sm" style="width: 80px;" data-bs-toggle="modal" data-bs-target="#addModal">Add</button>
            </div>
        </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="addModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Item</h5>
                </div>
                <div class="modal-body">

                    <form id="addItemForm">
                        <div class="mb-3">
                            <label for="item" class="form-label">Item*</label>
                            <input type="text" class="form-control" id="item" name="item" required>
                        </div>
                        <div class="mb-3">
                            <label for="unit_price" class="form-label">Unit Price*</label>
                            <input type="text" class="form-control" id="unit_price" name="unit_price" required>
                        </div>
                        <div class="mb-3">
                            <label for="qty" class="form-label">Qty*</label>
                            <input type="text" class="form-control" id="qty" name="qty" required>
                        </div>
                        <div class="mb-3" id="addModalDangerAlert">
                            <div class="alert" role="alert" id="addModalDangerAlertMsg"></div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary button" value="add-close" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary button" value="add">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update -->
    <div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update customer</h5>
                </div>
                <div class="modal-body">

                    <form id="updateItemForm">
                        <div hidden id="update-id"></div>
                        <div class="mb-3">
                            <label for="item" class="form-label">Item*</label>
                            <input type="text" class="form-control" id="update-item" name="item" required>
                        </div>
                        <div class="mb-3">
                            <label for="unit_price" class="form-label">Unit Price*</label>
                            <input type="text" class="form-control" id="update-unit_price" name="unit_price" required>
                        </div>
                        <div class="mb-3">
                            <label for="qty" class="form-label">Qty*</label>
                            <input type="text" class="form-control" id="update-qty" name="qty" required>
                        </div>
                        <div class="mb-3" id="updateModalDangerAlert">
                            <div class="alert" role="alert" id="updateModalDangerAlertMsg"></div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary button" value="update-close" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary button" value="update">Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete Item</h5>
                </div>
                <div class="modal-body">
                    <div hidden id="delete-id"></div>
                    <p>Please confirm deletion</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary button" value="delete-close" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger button" value="delete">Delete</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $("#addModalDangerAlert").hide();
            $("#updateModalDangerAlert").hide();

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

                if (btnVal == "add") {
                    var allStr = $("#addItemForm").serialize().replace("%20", " ");
                    var item = allStr.split("&")[0].split("=")[1];
                    var unit_price = allStr.split("&")[1].split("=")[1];
                    var qty = allStr.split("&")[2].split("=")[1];

                    var errorMsg = "";
                    $("#addModalDangerAlertMsg").removeClass("alert-success");
                    $("#addModalDangerAlertMsg").removeClass("alert-danger");
                    $("#addModalDangerAlertMsg").html("");
                    $("#addModalDangerAlert").hide();

                    console.log(Number.isNaN(parseFloat(unit_price)))

                    if (item == "")
                        errorMsg += "Please enter the item name";

                    if (unit_price.length == 0) {
                        if (errorMsg != "")
                            errorMsg += "<br>Please enter unit price";
                        else
                            errorMsg += "Please enter unit price";
                    } else if (Number.isNaN(parseFloat(unit_price))) {
                        if (errorMsg != "")
                            errorMsg += "<br>Invalid unit price";
                        else
                            errorMsg += "Invalid unit price";
                    }

                    if (qty.length == 0) {
                        if (errorMsg != "")
                            errorMsg += "<br>Please enter qty";
                        else
                            errorMsg += "Please enter qty";
                    } else if (Number.isNaN(parseInt(qty))) {
                        if (errorMsg != "")
                            errorMsg += "<br>Invalid qty";
                        else
                            errorMsg += "Invalid qty";
                    }

                    if (errorMsg.length > 0) {
                        $("#addModalDangerAlertMsg").html(errorMsg);
                        $("#addModalDangerAlertMsg").addClass("alert-danger");
                        $("#addModalDangerAlert").show();
                    } else {
                        var ajaxurl = "inventory_controller.php",
                            data = {
                                action: "save",
                                data: {
                                    item: item,
                                    unit_price: unit_price,
                                    qty: qty
                                }
                            };
                        $.post(ajaxurl, data, function(response) {
                            var g = '<tr>' + '<th scope="row">' + response + '</th>' +
                                '<td>' + item + '</td>' +
                                '<td>' + unit_price + '</td>' +
                                '<td>' + qty + '</td>' +
                                '</tr>';

                            $("#tableBody").append(g);

                            $("#addItemForm").trigger("reset");

                            // $("#addModalDangerAlertMsg").addClass("alert-success");
                            // $("#addModalDangerAlertMsg").html("Successfully saved");
                            // $("#addModalDangerAlert").show();

                            $("#addModal").modal('hide');
                            // temp
                            // location.reload();
                        });
                    }
                }

                if (btnVal == "add-close") {
                    $("#addCustomerForm").trigger("reset");
                    $("#addModalDangerAlertMsg").html("");
                    $("#addModalDangerAlertMsg").removeClass("alert-success");
                    $("#addModalDangerAlertMsg").removeClass("alert-danger");
                    $("#addModalDangerAlert").hide();
                }

                if (btnVal == "update-modal") {
                    var iid = $("#table tr.selected-row th:eq(0)").html();
                    var item = $("#table tr.selected-row td:eq(0)").html();
                    var unit_price = $("#table tr.selected-row td:eq(1)").html();
                    var qty = $("#table tr.selected-row td:eq(2)").html();

                    if (iid == null) {
                        alert("Please select an item");
                        return;
                    }

                    $("#update-id").html(iid);
                    $("#update-item").attr("value", item);
                    $("#update-unit_price").attr("value", unit_price);
                    $("#update-qty").attr("value", qty);
                    $("#updateModal").modal('show');

                }

                if (btnVal == "update") {
                    var allStr = $("#updateItemForm").serialize().replace("%20", " ");
                    var iid = $("#update-id").html();

                    var item = allStr.split("&")[0].split("=")[1];
                    var unit_price = allStr.split("&")[1].split("=")[1];
                    var qty = allStr.split("&")[2].split("=")[1];

                    var errorMsg = "";
                    $("#updateModalDangerAlertMsg").removeClass("alert-success");
                    $("#updateModalDangerAlertMsg").removeClass("alert-danger");
                    $("#updateModalDangerAlertMsg").html("");
                    $("#updateModalDangerAlert").hide();

                    if (item == "")
                        errorMsg += "Please enter the item name";

                    if (unit_price.length == 0) {
                        if (errorMsg != "")
                            errorMsg += "<br>Please enter unit price";
                        else
                            errorMsg += "Please enter unit price";
                    } else
                    if (Number.isNaN(parseFloat(unit_price))) {
                        if (errorMsg != "")
                            errorMsg += "<br>Invalid unit price";
                        else
                            errorMsg += "Invalid unit price";
                    }

                    if (qty.length == 0) {
                        if (errorMsg != "")
                            errorMsg += "<br>Please enter qty";
                        else
                            errorMsg += "Please enter qty";
                    } else
                    if (Number.isNaN(parseInt(qty))) {
                        if (errorMsg != "")
                            errorMsg += "<br>Invalid qty";
                        else
                            errorMsg += "Invalid qty";
                    }

                    if (errorMsg.length > 0) {
                        $("#updateModalDangerAlertMsg").html(errorMsg);
                        $("#updateModalDangerAlertMsg").addClass("alert-danger");
                        $("#updateModalDangerAlert").show();
                    } else {
                        var ajaxurl = "inventory_controller.php",
                            data = {
                                action: "update",
                                data: {
                                    iid: iid,
                                    item: item,
                                    unit_price: unit_price,
                                    qty: qty
                                }
                            };
                        $.post(ajaxurl, data, function(response) {
                            var row_index = getTableSelectedIndex() - 1;

                            $('#tableBody tr:eq(' + row_index + ') td:eq(0)').html(item);
                            $('#tableBody tr:eq(' + row_index + ') td:eq(1)').html(unit_price);
                            $('#tableBody tr:eq(' + row_index + ') td:eq(2)').html(qty);

                            $("#updateItemForm").trigger("reset");

                            // $("#updateModalDangerAlertMsg").addClass("alert-success");
                            // $("#updateModalDangerAlertMsg").html("Successfully updated");
                            // $("#updateModalDangerAlert").show();

                            $("#updateModal").modal('hide');
                        });
                    }
                }

                if (btnVal == "update-close") {
                    $("#updateCustomerForm").trigger("reset");
                    $("#updateModalDangerAlertMsg").html("");
                    $("#updateModalDangerAlertMsg").removeClass("alert-success");
                    $("#updateModalDangerAlertMsg").removeClass("alert-danger");
                    $("#updateModalDangerAlert").hide();
                }

                if (btnVal == "delete-modal") {
                    var iid = $("#table tr.selected-row th:eq(0)").html();

                    if (iid == null) {
                        alert("Please select an item");
                        return;
                    }

                    $("#delete-id").html(iid);
                    $("#deleteModal").modal('show');
                }

                if (btnVal == "delete") {
                    var iid = $("#delete-id").html();
                    var ajaxurl = "inventory_controller.php",
                        data = {
                            action: "delete",
                            data: {
                                iid: iid,
                            }
                        };
                    $.post(ajaxurl, data, function(response) {
                        if (response != 1) {
                            alert("This item has bills associated with it!");
                            $("#deleteModal").modal('hide');
                            return;
                        }

                        var row_index = getTableSelectedIndex();

                        $('table tr:eq(' + row_index + ')').remove();

                        $("#deleteModal").modal('hide');
                    });
                }

            });

            $("#tableBody").on("click", "tr", function() {
                $(this).addClass('selected-row').siblings().removeClass('selected-row');
            });

            $('#searchTxt').on('input', function(e) {
                var ajaxurl = "inventory_controller.php",
                    data = {
                        action: 'search',
                        keyword: $("#searchTxt").val()
                    };
                $.post(ajaxurl, data, function(response) {
                    $("#tableBody").html(response)
                });
            });

        });

        function getTableSelectedIndex() {
            x = document.getElementsByTagName("tr")
            var index;
            for (var i = 0; i < x.length; i++) {
                if (x[i].classList[0] == "selected-row") {
                    index = i;
                    i = x.length;
                }
            }
            return index;
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>