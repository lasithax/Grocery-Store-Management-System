<?php

function getCustomers($keyword)
{
    include 'db_connection.php';

    if ($keyword == null)
        $query = "SELECT id, name, mobile, email FROM Customer";
    else
        $query = "SELECT id, name, mobile, email FROM Customer WHERE id LIKE '%" . $keyword . "%' OR name LIKE '%" . $keyword . "%'";

    $result = mysqli_query($conn, $query);
    $output = "";

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

            $output = $output .
                '<tr>' .
                '<th scope="row">' . $row["id"] . '</th>' .
                '<td>' . $row["name"] . '</td>' .
                '<td>' . $row["mobile"] . '</td>' .
                '<td>' . $row["email"] . '</td>' .
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
            echo getCustomers($_POST['keyword']);
            break;
    }
}

function save($data)
{
    include 'db_connection.php';

    $cid;
    $query = "SELECT id FROM Customer ORDER BY timestamp DESC LIMIT 1";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $cid = mysqli_fetch_row($result)[0];
        $cid = "C" . (ltrim($cid, 'C') + 1);
    } else
        $cid = "C1";

    $query = "INSERT INTO Customer(id, name, mobile, email) VALUES('" . $cid  . "','"
        . $data['name']  .  "','"
        . $data['mobile']  .  "','"
        . $data['email']  .  "'"
        . ")";

    $result = mysqli_query($conn, $query);

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($cid);
}

function update($data)
{
    include 'db_connection.php';

    $query = "UPDATE Customer SET name='" . $data['name'] . "',mobile='" . $data['mobile'] . "',email='" . $data['email'] . "' WHERE id='" . $data['cid'] . "'";

    $result = mysqli_query($conn, $query);
}

function delete($data)
{
    include 'db_connection.php';

    $query = "DELETE FROM Customer WHERE id='" . $data['cid'] . "'";

    $result = mysqli_query($conn, $query);

    echo $result;
}
