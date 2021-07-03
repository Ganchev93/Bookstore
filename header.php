<?php

require_once 'common/includes/DBconnect.php';

//require_once 'includes/check.php';
define ('URLBASE' , 'https://test.local/bookstore');

$query = "SELECT title_category,id FROM categories";
$result = $conn->query($query);
session_start();
if (isset($_POST['add'])) {
  //print_r($_POST['product_id']);
  if (isset($_SESSION['cart'])) {

      $item_array_id = array_column($_SESSION['cart'], "product_id");
      //print_r($item_array_id);
      //print_r($_SESSION['cart']);
      if (in_array($_POST['product_id'], $item_array_id)) {
          echo "<script> alert('Product is already added in the cart!')</script>";
          echo "<script> window.location='index.php'</script>";
      } else {
          $count = count($_SESSION['cart']);
          $item_array = array(
              'product_id' => $_POST['product_id'],
              'product_qty' => 1
          );
          $_SESSION['cart'][$count] = $item_array;
          //print_r($_SESSION['cart']);
      }
  } else {
      $item_array = array(
          'product_id' => $_POST['product_id'],
          'product_qty' => 1
      );
      $_SESSION['cart'][0] = $item_array;
      print_r($_SESSION['cart']);
  }
}

if(isset($_GET['remove_cart'])){
  unset($_SESSION['cart']);
}

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="common/assest/vendor/bootstrap/css/bootstrap.min.css">
          
         <!-- fontawesome -->
         <link rel="stylesheet" href="common/assest/vendor/font-awesome/css/font-awesome.min.css">    
         <!-- theme CSS -->
        <link rel="stylesheet" href="common/assest/libs/css/style.css">
         <!-- carousel -->
         <link rel="stylesheet" href="common/assest/vendor/OwlCarousel2/assets/owl.carousel.min.css">
         <link rel="stylesheet" href="common/assest/vendor/OwlCarousel2/assets/owl.theme.default.min.css">
        <!-- Bootstrap bungle js  -->
        <script src="common/assest/vendor/bootstrap/js/bootstrap.bundle.js"></script>
         <!-- Jquery 3.6.0 -->
        <script src="common/assest/vendor/jquery/jquery-3.6.0.min.js"></script>   
        <!-- js carousel-->    
        <script src="common/assest/vendor/OwlCarousel2/owl.carousel.js"></script>    
    </head>
    <body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-info bg-info">
  <div class="container container-fluid">
    <a class="navbar-brand " href="index.php">Bookstore</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon">☰</span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="justify-content: space-between;">
      
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item">
                <a class="nav-link active " aria-current="page" href="index.php">Начало</a>
            </li>
        
          <li class="nav-item dropdown bg-info">
            <a class="nav-link " id="navbarDropdown" role="button">Книги▽ </a>
         
            <ul class="dropdown-menu " id="dinamic_el" aria-labelledby="navbarDropdown">
              
              

            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="form.php">Контакти</a>
          </li>

          <?php if (isset($_SESSION['username'])){ 
            if($_SESSION['role'] == "admin"){
            ?>

            <li class="nav-item">
              <a class="nav-link" href="backend/index.php">Админ панел</a>
            </li>

        <?php }} ?>
        </ul>

        <a href="shopping-cart.php" class="nav-link nav-icon">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        <?php
                                            if (isset($_SESSION['cart'])) {
                                                $count = count($_SESSION['cart']);
                                                echo"<span>$count</span>";
                                            } else {
                                                echo"<span>0</span>";
                                            }
                                            ?>
      </a>
            
        
        <?php if (isset($_SESSION['username'])){ ?>
          <a  href="profile.php" class="nav-link nav-icon user-profile">
            <i  class="fa fa-user" aria-hidden="true"></i>
          </a>
          <p style="margin-bottom: 0;margin-right:5px;color:azure">Здравейте</p>
          <a href="profile.php"> <h4 class="m-0 user-name"><?php echo $_SESSION['username'] ?></h4> </a>

          <a  class="user-exit-button"href="index.php" id="main-log-out" style="color: rgb(248, 183, 3);margin-left:6px;font-size:10px;">Изход</a>
        <?php }else{?>

          <a  href="#" class="nav-link nav-icon login-user">
            <i  class="fa fa-user" aria-hidden="true"></i>
          </a>

          

        <?php } ?>

        

      
    </div>
  </div>
</nav>


<script>
$(document).on('click', '#navbarDropdown', function(){
  
  $('.dropdown-menu').html(" ")
  $.ajax({
    method: 'GET',
    url: 'backend/includes/book/API/get-all-category.php',
    success: function(dataResult){
     
      var cl = $('#dinamic_el').attr('class').split(" ")
      var ar = cl
      
      if(ar[1] == undefined)
        $('#dinamic_el').attr('class',  cl + ' show bg-primary')
      else 
        $('#dinamic_el').attr('class', ar[0])

        final_data_result = dataResult.split('|')

        var array_category_id = []
        var array_category_name = []

        for(var i = 0; i < final_data_result.length-1;i++){
          var temp_data_result = final_data_result[i]
          var temp_arr = temp_data_result.split(" ")
          array_category_id[i] = temp_arr[0].replace(/(\r\n|\n|\r)/gm, "");
          array_category_name[i] = temp_arr[1].replace(/(\r\n|\n|\r)/gm, "");
        }
        

        for(var i = 0; i < array_category_id.length ;i++){
          $('#dinamic_el').append(
            `
            <li><a data-id=`+array_category_id[i]+` class="dropdown-item bg-primary text-light " href="<?php echo URLBASE; ?>/view-category.php?id=`+ array_category_id[i]+`">`+array_category_name[i]+`</a></li>
            `
          )
        }
    }
  });

})


</script>
<script>
    $(document).on('click', '#main-log-out', function(e){
      e.preventDefault()
      $.ajax({
            type: 'POST',
            cache: false,
            url: 'backend/includes/user/logout.php',
            success: function(dataResult){

                console.log(dataResult)
                var dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode == 200){
                  location.reload();
                }else if (dataResult.statusCode == 201){
                    alert('Error');
                }
            }
        });
    })

    $(document).on('click','.login-user', function(){
      window.location = 'backend/login.php'
    })
  </script>
    
</body>