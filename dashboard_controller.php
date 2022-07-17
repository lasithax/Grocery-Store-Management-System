<?php

function getMonthlyIncome(): string
{
    include 'db_connection.php';
    $query = "SELECT SUM(amount) FROM Bill WHERE timestamp LIKE '" . date("Y-m") . "-%'";

    $result = mysqli_query($conn, $query);
    $ret = mysqli_fetch_row($result)[0];
    if ($ret === null)
        return "0";
    else
        return   $ret;
}

function getMonthlySales(): string
{
    include 'db_connection.php';
    $query = "SELECT COUNT(id) FROM Bill WHERE timestamp LIKE '" . date("Y-m") . "-%'";

    $result = mysqli_query($conn, $query);
    return mysqli_fetch_row($result)[0];
}

function getNoItems(): string
{
    include 'db_connection.php';
    $query = "SELECT COUNT(id) FROM InventoryItem";

    $result = mysqli_query($conn, $query);
    return mysqli_fetch_row($result)[0];
}

function getNoCustomers(): string
{
    include 'db_connection.php';
    $query = "SELECT COUNT(id) FROM Customer";

    $result = mysqli_query($conn, $query);
    return mysqli_fetch_row($result)[0];
}