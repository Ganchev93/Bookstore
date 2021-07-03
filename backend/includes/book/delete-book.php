<?php 

require_once '../../../common/includes/DBconnect.php';

$book_id = $_GET['id'];

$query = "DELETE from books WHERE id=$book_id";
$result = $conn -> query($query);

if($result){
    // echo json_encode(["statusCode" => 200]);
    header('location:../../allBooks.php' );
    die();
    
}else{
    echo json_encode([
        "statusCode" => 201
    ]);
}

$conn ->close();