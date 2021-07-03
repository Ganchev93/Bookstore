<?php 
    require_once '../../../../common/includes/DBconnect.php';
    //require_once 'includes/check.php';
    define ('URLBASE' , 'https://test.local/bookstore/');
    
    $category_id = $_GET['id'];
    var_dump($category_id);

    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $query = "SELECT * FROM books";
        $result = $conn->query($query);
        echo json_encode($result);       
    }

   
?> 