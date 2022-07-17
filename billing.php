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

        .myContainer {
            font-size: 13px;
            margin-top: 30px;
        }

        .myRow {
            /* top | right | bottom | left */
            padding: 2px 0px 2px 0px;
        }

        .myTextBox {
            height: 18px;
            margin-left: 0px;
        }

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
include 'billing_controller.php';
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
                    <a class="nav-link active" aria-current="page" href="billing.php">Billing</a>
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

    <div class="container myContainer">
        <div class="row">
            <div class="col-5">
                <div class="row justify-content-between myRow">
                    <div class="col-4">
                        Search Customer
                    </div>
                    <div class="col-4">
                        <input type="text" class="myTextBox" name="customerSearchTxt" id="customerSearchTxt"></input>
                    </div>
                </div>
                <div class="row myRow">
                    <div class="col" id="lblCustomerID">
                        Customer ID:
                    </div>
                </div>
                <div class="row myRow">
                    <div class="col" id="lblCustomerName">
                        Name:
                    </div>
                </div>
                <div class="row myRow" style="margin-top: 5px;">
                    <div class="col overflow-auto" style="height: 180px; border: 1px solid cornflowerblue; border-radius: 5px;">
                        <table class="table table-hover table-style table-bordered" id="customerTable">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                </tr>
                            </thead>
                            <tbody id="customerTableBody">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row myRow">
                    <div class="col">
                        <hr>
                    </div>
                </div>
                <div class="col">
                    <div class="row justify-content-between myRow">
                        <div class="col-4">
                            Search Item
                        </div>
                        <div class="col-4">
                            <input type="text" class="myTextBox" name="itemSearchTxt" id="itemSearchTxt"></input>
                        </div>
                    </div>
                    <div class="row justify-content-between myRow" style="margin-right: -50px;">
                        <div class="col-3" id="lblItemID">
                            Item ID:
                        </div>
                        <div class="col-5">
                            <div class="row">
                                <div class="col-1">
                                    Qty
                                </div>
                                <div class="col">
                                    <input type="number" class="myTextBox" name="qtyText" id="qtyText"></input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-between myRow">
                        <div class="col-4" id="lblItem">
                            Item:
                        </div>
                        <div class="col-4">
                            <button type="button" value="addItem" style="height: 20px; width: 155px; padding:0px; font-size: 12px;" class="btn btn-primary button">Add Item</button>
                        </div>
                    </div>
                    <div class="row myRow">
                        <div class="col" id="lblItemQty">
                            Available Qty:
                        </div>
                    </div>
                    <div class="row myRow">
                        <div class="col" id="lblItemUnitPrice">
                            Unit Price:
                        </div>
                    </div>
                    <div class="row myRow" style="margin-top: 5px;">
                        <div class="col overflow-auto" style="height: 180px; border: 1px solid cornflowerblue; border-radius: 5px;">
                            <table class="table table-hover table-style table-bordered" id="itemTable">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Item</th>
                                    </tr>
                                </thead>
                                <tbody id="itemTableBody">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-1" style="border-left:2px solid #C8C9CA; height:auto; width: 1px; margin-left: 20px;">

            </div>

            <div class="col">
                <div class="row myRow">
                    <div class="col overflow-auto" style="height: 500px; border: 1px solid cornflowerblue; border-radius: 5px;">
                        <table class="table table-hover table-style table-bordered" id="billingTable">
                            <thead>
                                <tr>
                                    <th scope="col">Item ID</th>
                                    <th scope="col">Item</th>
                                    <th scope="col">Unit Price</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody id="billingTableBody">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row myRow">
                    <div class="col" style="font-weight: bold; margin-top: 2px;" id="netTotal">
                        Net Total: Rs.0
                    </div>
                </div>
                <div class="row myRow justify-content-between" style="margin-top: 6px; margin-right: -40px;">
                    <div class="col-4">
                        <label for="searchTxt">Received</label>
                        <input type="number" class="myTextBox" name="receivedTxt" style="margin-left: 5px;" id="receivedTxt"></input>
                    </div>
                    <div class="col-4">
                        <div class="row" style="padding-bottom: 2px;">
                            <div class="col">
                                <button type="button" class="btn btn-primary btn-sm button" style="width: 100px; font-size: 13px;" value="update-modal">Update Item</button>
                            </div>
                            <div class="col" style="margin-left: -25px;">
                                <button type="button" class="btn btn-primary btn-sm button" style="width: 100px; font-size: 13px;" value="removeItem">Remove Item</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row myRow justify-content-between" style="margin-right: -40px;">
                    <div class="col-4">
                        <button type="button" class="btn btn-primary btn-sm button" value="pay" style="width: 215px; font-size: 13px;">Pay</button>
                    </div>
                    <div class="col-4">
                        <button type="button" id="clearBtn" class="btn btn-primary btn-sm button" value="clear-bill" style="width: 215px; font-size: 13px;">Clear Bill</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update -->
    <div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Item</h5>
                </div>
                <div class="modal-body">

                    <form id="updateForm">
                        <div hidden id="lbl-update-id"></div>
                        <div id="lbl-update-item" style="padding-bottom: 5px;"></div>
                        <div id="lbl-update-unitPrice" style="padding-bottom: 5px;"></div>
                        <div id="lbl-update-qty" style="padding-bottom: 10px;"></div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Qty*</label>
                            <input type="number" class="form-control" id="update-qty" name="update-qty" required>
                        </div>
                        <div class="mb-3" id="updateModalDangerAlert">
                            <div class="alert" role="alert" id="updateModalDangerAlertMsg"></div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary button" value="update-close">Close</button>
                    <button type="button" class="btn btn-primary button" value="updateItem">Update</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
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

                if (btnVal == "addItem") {
                    var iid = $("#lblItemID").html().split(":")[1].trim();
                    var item = $("#lblItem").html().split(":")[1];
                    var aQty = parseInt($("#lblItemQty").html().split(":")[1]);
                    var uPrice = parseFloat($("#itemTable tr.selected-row td:eq(1)").html());
                    var qty = $("#qtyText").val();

                    if (iid == '') {
                        alert("Please select an item");
                        return;
                    }

                    if (qty == "") {
                        alert("Please enter item quantity");
                        return;
                    }

                    if (qty == 0) {
                        alert("Invalid item quantity");
                        return;
                    }

                    if (qty > (parseInt($('#lblItemQty').html().split(":")[1]))) {
                        alert("Insufficient item quantity");
                        return;
                    }

                    for (var i = 0; i < $('#billingTable tr').length; i++) {
                        let itemID = $("#billingTable tr:eq(" + i + ") th:eq(0)").html().trim();

                        if (itemID == iid) {
                            alert("This item already added");
                            return;
                        }
                    }

                    var tableData = $("#billingTableBody").html();
                    tableData += '<tr>' +
                        '<th scope="row">' + iid + '</th>' +
                        '<td>' + item + '</td>' +
                        '<td>' + uPrice + '</td>' +
                        '<td>' + qty + '</td>' +
                        '<td>' + (qty * uPrice) + '</td>' +
                        '<td hidden>' + aQty + '</td>' +
                        '</tr>';
                    $("#billingTableBody").html(tableData);

                    var netTot = parseFloat($("#netTotal").html().split(".")[1]);
                    netTot += (qty * uPrice);
                    $("#netTotal").html("Net Total: Rs." + netTot);

                    $('#lblItemID').html("Item ID:");
                    $('#lblItem').html("Item:");
                    $('#lblItemQty').html("Available Qty:");
                    $('#lblItemUnitPrice').html("Unit Price:");
                    $("#itemTableBody").html("");
                    $("#qtyText").val("");
                    $("#itemSearchTxt").val("");
                }

                if (btnVal == 'removeItem') {
                    if ($("#billingTable tr.selected-row th:eq(0)").html() == null) {
                        alert("Please select an item");
                        return;
                    }

                    let index = getTableSelectedIndex("billingTable");
                    let prevTotal = parseFloat($('#billingTable tr:eq(' + index + ') td:eq(3)').html());
                    let netTot = parseFloat($("#netTotal").html().split(".")[1]);
                    $('#billingTable tr:eq(' + index + ')').remove();
                    $("#netTotal").html("Net Total: Rs." + (netTot - prevTotal));
                }

                if (btnVal == 'update-modal') {
                    if ($("#billingTable tr.selected-row th:eq(0)").html() == null) {
                        alert("Please select an item");
                        return;
                    }

                    $("#lbl-update-id").html($("#billingTable tr.selected-row th:eq(0)").html());
                    $("#lbl-update-item").html("Item: " + $("#billingTable tr.selected-row td:eq(0)").html());
                    $("#lbl-update-unitPrice").html("Unit Price: Rs." + $("#billingTable tr.selected-row td:eq(1)").html());
                    $("#lbl-update-qty").html("Available Qty: " + $("#billingTable tr.selected-row td:eq(4)").html());
                    $("#update-qty").attr("value", $("#billingTable tr.selected-row td:eq(2)").html());
                    $("#updateModal").modal('show');
                }

                if (btnVal == 'update-close') {
                    $("#lbl-update-id").html(null);
                    $("#lbl-update-qty").html(null);
                    $("#update-qty").attr("value", 0);
                    $("#updateForm").trigger("reset");
                    $("#updateModalDangerAlert").hide();
                    $("#updateModal").modal('hide');
                }

                if (btnVal == 'updateItem') {
                    let id = $("#lbl-update-id").html();
                    let uPrice = parseFloat($("#lbl-update-unitPrice").html().split(".")[1].trim());
                    let totQty = parseInt($("#lbl-update-qty").html().split(":")[1].trim());
                    let qty = parseInt($("#update-qty").val());

                    if (qty == 0) {
                        $("#updateModalDangerAlertMsg").html("Invalid item quantity");
                        $("#updateModalDangerAlertMsg").addClass("alert-danger");
                        $("#updateModalDangerAlert").show();
                        return;
                    }

                    if (qty > totQty) {
                        $("#updateModalDangerAlertMsg").html("Insufficient item quantity");
                        $("#updateModalDangerAlertMsg").addClass("alert-danger");
                        $("#updateModalDangerAlert").show();
                        return;
                    }

                    for (var i = 0; i < $('#billingTable tr').length; i++) {
                        let itemID = $("#billingTable tr:eq(" + i + ") th:eq(0)").html().trim();

                        if (itemID != id)
                            continue;

                        let prevTotal = parseFloat($('#billingTable tr:eq(' + i + ') td:eq(3)').html());
                        let prevQty = parseInt($('#billingTable tr:eq(' + i + ') td:eq(2)').html());
                        qty = parseInt(qty);
                        let newTot = qty * uPrice;

                        $('#billingTable tr:eq(' + i + ') td:eq(2)').html(qty);
                        $('#billingTable tr:eq(' + i + ') td:eq(3)').html(newTot);

                        var netTot = parseFloat($("#netTotal").html().split(".")[1]);
                        netTot -= prevTotal;
                        netTot += newTot;
                        $("#netTotal").html("Net Total: Rs." + netTot);

                        $('#lblItemID').html("Item ID:");
                        $('#lblItem').html("Item:");
                        $('#lblItemQty').html("Available Qty:");
                        $('#lblItemUnitPrice').html("Unit Price:");
                        $("#itemTableBody").html("");
                        $("#qtyText").val("");
                        $("#itemSearchTxt").val("");
                        i = $('#billingTable tr').length;
                        $("#lbl-update-id").html(null);
                        $("#lbl-update-qty").html(null);
                        $("#update-qty").attr("value", 0);
                        $("#updateForm").trigger("reset");
                        $("#updateModal").modal('hide');
                        $("#updateModalDangerAlert").hide();
                        return;
                    }
                }

                if (btnVal == 'clear-bill') {
                    $('#lblCustomerID').html("Customer ID:");
                    $('#lblCustomerName').html("Name:");
                    $("#customerTableBody").html("");

                    $('#lblItemID').html("Item ID:");
                    $('#lblItem').html("Item:");
                    $('#lblItemQty').html("Available Qty:");
                    $('#lblItemUnitPrice').html("Unit Price:");
                    $("#itemTableBody").html("");

                    $("#billingTableBody").html("");

                    $("#qtyText").val("");
                    $("#itemSearchTxt").val("");
                    $("#customerSearchTxt").val("");
                    $("#netTotal").html("Net Total: Rs.0");
                    $("#receivedTxt").val("");
                }

                if (btnVal == 'pay') {
                    if ($('#lblCustomerID').html().split(":")[1].trim().charAt("C") != "C") {
                        alert("Please select a customer");
                        return;
                    }

                    if ($('#billingTable tr').length == 1) {
                        alert("Please add items");
                        return;
                    }

                    let receivedAmount = parseFloat($('#receivedTxt').val());
                    let totPayable = parseFloat($("#netTotal").html().split(".")[1]);

                    if ($('#receivedTxt').val() == "") {
                        alert("Please enter amount");
                        return;
                    }

                    if (totPayable > receivedAmount) {
                        alert("Insufficient amount");
                        return;
                    }

                    var tableData = $("#billingTableBody").html();
                    let items = "";

                    for (var i = 1; i < $('#billingTable tr').length; i++) {
                        let itemID = $("#billingTable tr:eq(" + i + ") th:eq(0)").html().trim();
                        let itemUnitPrice = parseFloat($('#billingTable tr:eq(' + i + ') td:eq(1)').html());
                        let itemQty = parseInt($('#billingTable tr:eq(' + i + ') td:eq(2)').html());
                        let itemTotal = parseFloat($('#billingTable tr:eq(' + i + ') td:eq(3)').html());

                        items += itemID + ";" + itemUnitPrice + ";" + itemQty + ";" + itemTotal;
                        if (($('#billingTable tr').length - 1) != i)
                            items += "^";
                    }

                    var ajaxurl = "billing_controller.php",
                        data = {
                            action: 'pay',
                            customer_id: $('#lblCustomerID').html().split(":")[1].trim(),
                            netTotal: totPayable,
                            payed: receivedAmount,
                            items: items
                        };
                    $.post(ajaxurl, data, function(response) {
                        alert("Payment Successfull");
                    });

                    $("#clearBtn").click();
                }

            });

            $("#customerTableBody").on("click", "tr", function() {
                $(this).addClass('selected-row').siblings().removeClass('selected-row');

                $('#lblCustomerID').html("Customer ID: " + $("#customerTable tr.selected-row th:eq(0)").html());
                $('#lblCustomerName').html("Name: " + $("#customerTable tr.selected-row td:eq(0)").html());
            });

            $("#itemTableBody").on("click", "tr", function() {
                $(this).addClass('selected-row').siblings().removeClass('selected-row');

                $('#lblItemID').html("Item ID: " + $("#itemTable tr.selected-row th:eq(0)").html());
                $('#lblItem').html("Item: " + $("#itemTable tr.selected-row td:eq(0)").html());
                $('#lblItemUnitPrice').html("Unit Price: Rs." + $("#itemTable tr.selected-row td:eq(1)").html());
                $('#lblItemQty').html("Available Qty: " + $("#itemTable tr.selected-row td:eq(2)").html());
            });

            $("#billingTableBody").on("click", "tr", function() {
                $(this).addClass('selected-row').siblings().removeClass('selected-row');
            });

            $('#customerSearchTxt').on('input', function(e) {
                if ($("#customerSearchTxt").val() == "") {
                    $('#lblCustomerID').html("Customer ID:");
                    $('#lblCustomerName').html("Name:");
                    $("#customerTableBody").html("");
                    return;
                }
                var ajaxurl = "billing_controller.php",
                    data = {
                        action: 'customerSearch',
                        keyword: $("#customerSearchTxt").val()
                    };
                $.post(ajaxurl, data, function(response) {
                    $("#customerTableBody").html(response)
                });
            });

            $('#itemSearchTxt').on('input', function(e) {
                if ($("#itemSearchTxt").val() == "") {
                    $('#lblItemID').html("Item ID:");
                    $('#lblItem').html("Item:");
                    $('#lblItemQty').html("Available Qty:");
                    $('#lblItemUnitPrice').html("Unit Price:");
                    $("#itemTableBody").html("");
                    return;
                }
                var ajaxurl = "billing_controller.php",
                    data = {
                        action: 'itemSearch',
                        keyword: $("#itemSearchTxt").val()
                    };
                $.post(ajaxurl, data, function(response) {
                    $("#itemTableBody").html(response)
                });
            });

        });

        function getTableSelectedIndex(className) {
            x = $('#' + className + ' tr')
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