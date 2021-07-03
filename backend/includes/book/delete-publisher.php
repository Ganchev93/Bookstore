<?php 

require_once '../../../common/includes/DBconnect.php';

$publisher_id = $_GET['id'];

$query = "DELETE from publishers WHERE id=$publisher_id";
$result = $conn -> query($query);

if($result){
    // echo json_encode(["statusCode" => 200]);
    header('location:../../all-publishers.php' );
    die();
    
}else{
    echo json_encode([
        "statusCode" => 201
    ]);
}

$conn ->close();