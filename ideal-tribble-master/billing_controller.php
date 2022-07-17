<?php

function getCustomers($keyword)
{
    include 'db_connection.php';

    $output = "";

    if ($keyword == null) {
        $output = "";
    } else {
        $query = "SELECT id, name FROM Customer WHERE id LIKE '%" . $keyword . "%' OR name LIKE '%" . $keyword . "%'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $output = $output .
                    '<tr>' .
                    '<th scope="row">' . $row["id"] . '</th>' .
                    '<td>' . $row["name"] . '</td>' .
                    '</tr>';
            }
        }
    }

    return $output;
}

function getInventoryItems($keyword)
{
    include 'db_connection.php';

    $output = "";

    if ($keyword == null) {
        $output = "";
    } else {
        $query = "SELECT id, item, unit_price, qty, timestamp FROM InventoryItem WHERE id LIKE '%" . $keyword . "%' OR item LIKE '%" . $keyword . "%'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {
                $output = $output .
                    '<tr>' .
                    '<th scope="row">' . $row["id"] . '</th>' .
                    '<td>' . $row["item"] . '</td>' .
                    '<td hidden>' . $row["unit_price"] . '</td>' .
                    '<td hidden>' . $row["qty"] . '</td>' .
                    '</tr>';
            }
        }
    }

    return $output;
}

function pay($customer_id, $netTotal, $payed, $items)
{
    include 'db_connection.php';

    $billID;

    $result = mysqli_query($conn, "SELECT id FROM Bill ORDER BY timestamp DESC LIMIT 1");

    if (mysqli_num_rows($result) > 0) {
        $billID = mysqli_fetch_row($result)[0];
        $billID = "B" . (ltrim($billID, 'B') + 1);
    } else
        $billID = "B1";

    mysqli_query($conn, "INSERT INTO Bill(id, customer_id, amount, paid) VALUES('" . $billID . "','" . $customer_id . "'," . $netTotal . "," . $payed . ")");

    $itemsSaveQuery = "INSERT INTO Bill_Item(bill_id, inventory_item_id, unit_price, qty, total) VALUES";

    foreach (explode("^", $items) as $item) {
        $itemsSaveQuery = $itemsSaveQuery . "('" . $billID . "','" . explode(";", $item)[0] . "'," . explode(";", $item)[1] . "," . explode(";", $item)[2] . "," . explode(";", $item)[3] . "),";
    }

    $itemsSaveQuery = substr($itemsSaveQuery, 0, -1);

    mysqli_query($conn, $itemsSaveQuery);

    foreach (explode("^", $items) as $item) {
        mysqli_query($conn, "UPDATE InventoryItem SET qty=qty-" . explode(";", $item)[2] . " WHERE id='" . explode(";", $item)[0] . "'");
    }
}

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'customerSearch':
            echo getCustomers($_POST['keyword']);
            break;
        case 'itemSearch':
            echo getInventoryItems($_POST['keyword']);
            break;
        case 'pay':
            echo pay($_POST['customer_id'], $_POST['netTotal'], $_POST['payed'], $_POST['items']);
            break;
    }
}
