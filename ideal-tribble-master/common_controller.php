<?php

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'logout':
            logout();
            break;
    }
}

function logout()
{
    session_start();
    $_SESSION = array();
    unset($_SESSION);
    session_destroy();
    exit();
}
