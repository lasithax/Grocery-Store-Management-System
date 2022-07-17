<?php

function getInventory($keyword)
{
    include 'db_connection.php';

    if ($keyword == null)
        $query = "SELECT id, item, unit_price, qty FROM InventoryItem";
    else
        $query = "SELECT id, item, unit_price, qty, timestamp FROM InventoryItem WHERE id LIKE '%" . $keyword . "%' OR item LIKE '%" . $keyword . "%'";

    $result = mysqli_query($conn, $query);
    $output = "";

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

            $output = $output .
                '<tr>' .
                '<th scope="row">' . $row["id"] . '</th>' .
                '<td>' . $row["item"] . '</td>' .
                '<td>' . $row["unit_price"] . '</td>' .
                '<td>' . $row["qty"] . '</td>' .
                '</tr>';
        }
    }
    return $output;
}

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'save':
            save($_POST['data']);
            break;
        case 'update':
            update($_POST['data']);
            break;
        case 'delete':
            delete($_POST['data']);
            break;
        case 'search':
            echo getInventory($_POST['keyword']);
            break;
    }
}

function save($data)
{
    include 'db_connection.php';

    $iid;
    $query = "SELECT id FROM InventoryItem ORDER BY timestamp DESC LIMIT 1";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $iid = mysqli_fetch_row($result)[0];
        $iid = "I" . (ltrim($iid, 'I') + 1);
    } else
        $iid = "I1";

    $query = "INSERT INTO InventoryItem(id, item, unit_price, qty) VALUES('" . $iid  . "','"
        . $data['item']  .  "','"
        . $data['unit_price']  .  "','"
        . $data['qty']  .  "'"
        . ")";

    $result = mysqli_query($conn, $query);

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($iid);
}

function update($data)
{
    include 'db_connection.php';

    $query = "UPDATE InventoryItem SET item='" . $data['item'] . "',unit_price='" . $data['unit_price'] . "',qty='" . $data['qty'] . "' WHERE id='" . $data['iid'] . "'";

    $result = mysqli_query($conn, $query);
}

function delete($data)
{
    include 'db_connection.php';

    $query = "DELETE FROM InventoryItem WHERE id='" . $data['iid'] . "'";

    $result = mysqli_query($conn, $query);

    echo $result;
}
