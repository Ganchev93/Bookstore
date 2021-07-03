<?php
require_once '../../../common/includes/DBconnect.php';

$title_category = mysql_entities_fix_string($conn, $_POST['title_category']);
$description = mysql_entities_fix_string($conn, $_POST['description']);
$show_home = mysql_entities_fix_string($conn, $_POST['show_home']);
if($show_home == "false") $show_home ="FALSE"; 
if($show_home == "true") $show_home ="TRUE";
$date_created = date('Y-m-d G:i:s');

function mysql_entities_fix_string($conn, $string) {
    return htmlentities(mysql_fix_string($conn, $string));
}

function mysql_fix_string($conn, $string) {
    if (function_exists('get_magic_quotes_gpc') && get_magic_quotes_gpc()) {
        $string = stripcslashes($string);
    }
    return $conn->real_escape_string($string);
}

$query = "INSERT INTO `categories`(title_category, description, created_at, show_home ) VALUES" . "('$title_category','$description','$date_created','$show_home')";
$result = $conn->query($query);


if($result){
    echo json_encode(["statusCode" => 200]);
} else {
    echo json_encode([
        "statusCode" => 201,
        
        ]);
}

$conn->close();