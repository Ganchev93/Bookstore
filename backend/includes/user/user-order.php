<?php
require_once '../../../common/includes/DBconnect.php';

$users_id = mysql_entities_fix_string($conn, $_POST['users_id']);
$book_isbn = $_POST['line_items'];
$total = mysql_entities_fix_string($conn, $_POST['total']);
$name = mysql_entities_fix_string($conn, $_POST['name']);
$phone = mysql_entities_fix_string($conn, $_POST['phone']);
$email = mysql_entities_fix_string($conn, $_POST['email']);
$address = mysql_entities_fix_string($conn, $_POST['address']);
$purchase_date = date('Y-m-d G:i:s');

function mysql_entities_fix_string($conn, $string){
    return htmlentities(mysql_fix_string($conn, $string));
}

function mysql_fix_string($conn, $string) {
    if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
        $string = stripcslashes($string);
    }
    return $conn->real_escape_string($string);
}

$result = "";


$query = "INSERT into orders(users_id, book_isbn, total, name, phone, email, address, purchase_date) VALUES" .
 "('$users_id', '$book_isbn', '$total','$name', '$phone', '$email', '$address', '$purchase_date')";
 
 $result = $conn->query($query);
 
 if ($result){
     echo json_encode(["statusCode" => 200]);
 } else{
     echo json_encode([
        "statusCode" => 201
     ]);
 }
 $conn -> close();