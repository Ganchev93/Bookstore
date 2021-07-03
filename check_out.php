<?php 
require_once 'header.php';

if (isset($_SESSION['cart'])) {
    $product_info = $_SESSION['cart'];

    $query = "SELECT books.*, author.name FROM books INNER JOIN author ON books.author_id = author.id";
    $result = $conn->query($query);
    ?>
        <h1 class="text-center category-title" style="margin-top: 100px;">Вашите поръчки</h1>
         <div class="container order-container" style="margin-top: 50px;">
         <table class="table">
                    <thead>
                        <tr >
                            
                            <th style="border-bottom:skyblue 1px solid" scope="col">Заглавие</th>
                            <th style="border-bottom:skyblue 1px solid" scope="col">Автор</th>
                            <th style="border-bottom:skyblue 1px solid" scope="col">Цена</th>
                        </tr>
                    </thead>
    <?php
    $total = 0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            foreach ($product_info as $key => $product) {
                if ($row['id'] == $product['product_id']) {
                    $total = $total + $row['price'];
                    
                    ?>
                   
                   
                    
                    <tbody>

                    <tr>
                       
                        <td style="border-bottom:skyblue 1px solid"><?php echo htmlspecialchars($row['title']);?></td>
                        <td style="border-bottom:skyblue 1px solid"><?php echo htmlspecialchars($row['name']);?></td>
                        <td style="border-bottom:skyblue 1px solid"><?php echo htmlspecialchars($row['price']);?></td>
               
                </td>
            </tr>
            
                <?php
                }
            }
        }
    }
}?>
                    </tbody>
         </table>
</div>
<div class="container text-center">
<h3  class="total-sum">Обща сума <?php echo $total ?>лв.</p>
</div>

<div class="container text-center"><h3 class="category-title">Вашите данни</h3></div>

<?php
$user_id = $_SESSION['login_user'];
$query = "SELECT users.* FROM users WHERE id = $user_id";
$result = $conn->query($query);

if(!$result) die("Fatal error");
$rows = $result->num_rows;
$row = $result ->fetch_assoc();?>
<div >
<form class="container form text-center purchase-form" action="check_out.php" method="POST" enctype="multipart/form-data" novalidate>
    <div>
        <div>
           <label class="form-desc text-center" for="name">Име*</label>
           <input class="form-field" type="text" name="name" id="name" required value="<?php echo htmlspecialchars($row['name']); ?>">
        </div>
        <div> 
            <label class="form-desc text-center" for="email">Имейл*</label>
            <input class="form-field" type="email" name="email" id="email" required value="<?php echo htmlspecialchars($row['email']); ?>">
        </div>
        <div> 
            <label class="form-desc text-center" for="phone">Телефон*</label>
            <input class="form-field" type="number" name="phone" id="phone" required placeholder="xxx-xxx-xxx-xxx">
        </div>
        <div> 
            <label class="form-desc text-center" for="address">Адрес*</label>
            <input class="form-field" type="text" name="address" id="address" required placeholder="гр.xxx ул.xxxx ">
        </div>
        
        <input id="total" name="total" type="hidden" value="<?php echo $total ?>">
        <input id="users_id" name="users_id" type="hidden" value="<?php echo htmlspecialchars($row['id']) ?>">
        <?php
        $product_id=array_column($_SESSION['cart'], 'product_id');
        $query = "SELECT * FROM books";
        $result = $conn->query($query);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $i = 1;

                foreach($product_id as $id){
                    if($row['id'] == $id){
                        $added = "";


                        ?>

                        <input class="book_isbn" id="book_isbn_<?php echo $i;?>" name="book_isbn" type="hidden" value="<?php echo htmlspecialchars($row['isbn']);?>">
                        <?php
                    }
                    $i++;
                }
            }
        }
    
    ?>

    <button class="contact-purchase-form btn-buy" type="submit" id="btn-sent" name="btn-sent">Поръчай<br>$</button>
    <p id="success" style="display:none; color:green"></p>
    <p id="warning" style="display:none; color:red"></p>
    </div>
</form>
</div>
<script>
$(document).ready(function() {
 $('#btn-sent').unbind().bind('click', function(e){
    e.preventDefault();
    var users_id = $('#users_id').val();
    var total = $('#total').val();
    var name = $('#name').val();
    var email = $('#email').val();
    var phone = $('#phone').val();
    var address = $('#address').val();
    var line_items = {};

    console.log(users_id);
    console.log(total);
    console.log(name);
    console.log(email);
    console.log(phone);
    console.log(address);
    console.log(line_items);
        var i = 1; 

   $('.purchase-form .book_isbn').each(function (){
        line_items['row_' + i] = {
            booksid: $('#book_isbn_' + i).val(),
        }
        i++
   });
   var form = $('form')[0];
   var formData = new FormData(form);
    
   if(name != "" && address != "" && phone !="" && email != ""){
       $.ajax({
           type: 'POST',
           data: {
               users_id: users_id,
               total: total,
               name: name,
               email: email,
               phone: phone,
               address: address,
               line_items: JSON.stringify(line_items), 
           },
           cache: false,
           url: 'backend/includes/user/user-order.php',
           success: function(dataResult){
               var dataResult = JSON.parse(dataResult);
               console.log(dataResult);
               if(dataResult.statusCode == 200){
                   console.log(dataResult);
                   $('#warning').hide();
                   $('form').trigger('reset');
                   $('#success').html('Благодарим ви ,че избрахте нас!');
                   window.location = 'index.php?remove_cart=true';
               }else{
                   alert('Error');
               }
           }
       });
   }else{
       $('form').addClass('validate');
       alert('Попълнете задължителните полета');
   }
 });
});
</script>