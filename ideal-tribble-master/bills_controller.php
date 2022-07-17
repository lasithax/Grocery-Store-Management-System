<?php

function getBills($keyword)
{
    include 'db_connection.php';

    if ($keyword == null)
        $query = "SELECT b.id AS bid, c.id AS cid, c.name, b.amount, b.paid, (b.paid - b.amount) AS balance, b.timestamp
                FROM bill AS b
                INNER JOIN customer AS c
                ON c.id = b.customer_id
                ORDER BY b.timestamp DESC";
    else
        $query = "SELECT b.id AS bid, c.id AS cid, c.name, b.amount, b.paid, (b.paid - b.amount) AS balance, b.timestamp
                FROM bill AS b
                INNER JOIN customer AS c
                ON c.id = b.customer_id
                WHERE b.id LIKE '%" . $keyword . "%' OR c.id LIKE '%" . $keyword . "%' OR c.name LIKE '%" . $keyword . "%' 
                ORDER BY b.timestamp DESC";

    $result = mysqli_query($conn, $query);
    $output = "";

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {

            $output = $output .
                '<tr>' .
                '<th scope="row">' . $row["bid"] . '</th>' .

                '<td>' . $row["cid"] . '</td>' .
                '<td>' . $row["name"] . '</td>' .
                '<td>' . $row["amount"] . '</td>' .
                '<td>' . $row["paid"] . '</td>' .
                '<td>' . $row["balance"] . '</td>' .
                '<td>' . $row["timestamp"] . '</td>' .
                '</tr>';
        }
    }
    return $output;
}

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'search':
            echo getBills($_POST['keyword']);
            break;
    }
}
