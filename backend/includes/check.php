<?php
session_start();

if(!isset($_SESSION['login_user'])){
    header("bookstore/backend/login.php");
    die();
}