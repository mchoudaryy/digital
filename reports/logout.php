<?php
session_start();
        unset($_SESSION['sid_smartahead_report']);
        unset($_SESSION['sid_smartahead_user_name']);
        unset($_SESSION['smartahead_user_type']);
header('location:'.'login.php');
?>