<?php 

require_once '../../../common/includes/DBconnect.php';

$category_id = $_GET['id'];

$query = "DELETE from categories WHERE id=$category_id";
$result = $conn -> query($query);

if($result){
    // echo json_encode(["statusCode" => 200]);
    header('location:../../all-categories.php' );
    die();
    
}else{
    echo json_encode([
        "statusCode" => 201
    ]);
}

$conn ->close();