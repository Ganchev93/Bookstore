<?php 

require_once '../../../common/includes/DBconnect.php';

$author_id = $_GET['id'];

$query = "DELETE from author WHERE id=$author_id";
$result = $conn -> query($query);

if($result){
    // echo json_encode(["statusCode" => 200]);
    header('location:../../all-authors.php' );
    die();
    
}else{
    echo json_encode([
        "statusCode" => 201
    ]);
}

$conn ->close();