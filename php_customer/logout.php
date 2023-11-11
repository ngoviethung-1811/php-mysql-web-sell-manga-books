<?php
    session_start();
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
        header('Location: ../php_customer/login.php');
        exit();
    } else {
        header('Location: ../php_customer/login.php');
        exit();
    }
?>
