<?php

$conn = mysqli_connect("localhost", "root", "", "gsms");

if (!$conn) {
    echo "Connection failed!";
}
