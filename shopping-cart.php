<?php
require_once 'header.php';

//define('URLBASE7', 'http://bookstore.local');
//session_start();
//$db = new CreateDb("mybookstore","books")
//$db = new CreateDb("Productdb","Producttb")


// echo "<pre>";
// print_r($_SESSION['cart']);
// echo "</pre>";

if (isset($_POST['remove'])) {
    if ($_GET['action'] == 'remove') {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value["product_id"] == $_GET['id']) {
                unset($_SESSION['cart'][$key]);
                //echo "<script>alert('Product has been Removed')</script>";
                //echo "<script>window.location='shopping-cart.php'</script>";
            }
        }
    }
}
?>  

<section class="shopping-cart" style="margin-top: 100px;">
    <h2 class="text-center category-title">Моята количка</h2>

    <?php
    $total = 0;
    
    if (isset($_SESSION['cart'])) {
        $product_info = $_SESSION['cart'];

        $query = "SELECT books.*, author.name FROM books INNER JOIN author ON books.author_id = author.id";
        $result = $conn->query($query);
        ?>
             <div class="wrapper">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                foreach ($product_info as $key => $product) {
                    if ($row['id'] == $product['product_id']) {
                        $total = $total + $row['price'];
                        
                        ?>
                       
                        <form class="container col-lg-3 col-sm-6 col-12 category-item text-center" action="shopping-cart.php?action=remove&id=<?php echo htmlspecialchars($row['id']); ?>" method="POST">

                            <div class="cart-list">
                                <div class="cart-list-item"> 

                                    <div class="cart-list-item-info">
                                        <img  src="<?php echo URLBASE . '/backend/uploads/' . $row['image']; ?>" alt="" class="cart-item-img">
                                        <p style="margin-bottom: 5px;" class="book-title" style="font-weight: 600;"><?php echo htmlspecialchars($row['title']); ?></p>
                                        <p style="margin-bottom: 5px;" class="category-desc"><?php echo htmlspecialchars($row['name']); ?></p>
                                        <p style="margin-bottom: 5px;" class="price">Цена: <?php echo htmlspecialchars($row['price']); ?> лв</p>
                                        <div class="shopping-cart-all-list-item-info-buttons">
                                           
                                            <button type="submit" name="remove" class="btn-remove">Премахни</button>
                                            <input type="hidden" name="product_id">
                                        </div>
                                    </div>

                                   

                                </div>
                            </div>
                        </form>
                       
                        <?php
                    }
                }
            }
        }
        ?>
             </div>
        <?php
    } else {
        echo "<h5 class='text-center'>Празна количка</h5>";
    }
    ?>


    <div class="container text-center">
        <h4 class="category-title">Детайли за поръчката</h4>
        <?php
        if (isset($_SESSION['cart'])) {
            $count = count($_SESSION['cart']);
            echo "<h6 class='category-desc'>цена за ($count продукта)</h6>";
        } else {
            echo "<h6>Няма продукти в кошницата (0 предмета)</h6>";
        }

//cqlata vena
//echo $total;
        ?>
        <div class="container  text-center">
            
            <div class="shopping-cart-all-ordered-details-total">
                <h4 style="color: #FF9900;">Обща сума<?php  echo " " .  $total . "лв" ?></h4>
                <a class="btn-chek-out" href="check_out.php">Финализиране</a>
            </div>
        </div>
    </div>
</section>

<script>
    $('.btn-qty-minus').unbind().bind('click', function (e) {
        e.preventDefault();
        var current_qty = $(this).parent().find('.current_qty').val();
        var product_id = $(this).parent().find('.product_id').val();
        var element_id = $(this).parent().find('.element_id').val();

        $.ajax({
            url: "common/includes/update-qty.php",
            type: "POST",
            data: {
                action: 'subtraction',
                current_qty: current_qty,
                product_id: product_id,
                element_id: element_id,
            },
            cache: false,
            success: function (dataResult) {
                var dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode == 200) {
                    $('#current_qty_' + element_id).val(dataResult.product_qty);
                } else if (dataResult.statusCode == 201) {
                    $('#current_qty_' + element_id).parents("form").hide();
                }
            }
        });
    });
    $('.btn-qty-plus').unbind().bind('click', function (e) {
        e.preventDefault();
        var current_qty = $(this).parent().find('.current_qty').val();
        var product_id = $(this).parent().find('.product_id').val();
        var element_id = $(this).parent().find('.element_id').val();

        $.ajax({
            url: "common/includes/update-qty.php",
            type: "POST",
            data: {
                action: 'increase',
                current_qty: current_qty,
                product_id: product_id,
                element_id: element_id,
            },
            cache: false,
            success: function (dataResult) {
                var dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode == 200) {
                    $('#current_qty_' + element_id).val(dataResult.product_qty);
                }
            }
        });
    });
</script>

<?php
//require_once 'footer.php';
?>  