<?php 
require_once '../../../common/includes/DBconnect.php';

$user_id = $_GET['id'];

$query = "DELETE from users WHERE id=$user_id";
$result = $conn -> query($query);

if($result){
    // echo json_encode(["statusCode" => 200]);
    header('location:../../all-users.php' );
    die();
    
}else{
    echo json_encode([
        "statusCode" => 201
    ]);
}

$conn ->close();