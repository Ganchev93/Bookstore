<?php 
    require_once '../../../../common/includes/DBconnect.php';
    //require_once 'includes/check.php';
    define ('URLBASE' , 'https://test.local/bookstore');
    
   
        $query = "SELECT id, title_category FROM categories";

        $result = $conn->query($query);

        $final_array=array();

        while($row = mysqli_fetch_array($result)){
            
            echo $row['id'];
            echo " ";
            echo $row['title_category'];
            echo "|";
            
            
            array_push($final_array);
        }

        $final_array = array_pop($final_array);
      

        

        echo $final_array;
    
?>