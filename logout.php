<?php
session_start();

//        session_destroy();
        unset($_SESSION['digitalmedia_sid']);
        unset($_SESSION['digitalmediauser_name']);
        unset($_SESSION['digitalmedia_user_type']);
//        session_unset();
        
        header('location:'.'login.php');

    
?>