<?php
require_once 'header.php';

$query = "SELECT id, title_category, description FROM categories WHERE show_home='TRUE'";
$result = $conn->query($query);

if(!$result) 
    die("Fatal error");

?>

<div style="margin-top: 50px;" class="wrapper">
<div class="fadeOut owl-carousel owl-theme">
    <div class="item item-carousel">
        <img src="common/assest/img/2-predvatlni_zaqvki_-_preoburnatati_suzvezdia_1920.jpg">
    </div>
    <div class="item item-carousel"><img src="common/assest/img/hermes_baner_pons_month_1__2_1.jpg"></div>
    <div  class="item item-carousel"><img src="common/assest/img/mn_madrostta_na_dushite_spomeni_ot_otvadnoto_1920.jpg"></div>
    
</div>

<div class="container">

<h2 class="text-center" style="color: #6D929B;">Категорий</h2>

<?php
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){  
            ?>

         <div class="home-category">
            <h3 class="category-title "><?php echo htmlspecialchars($row['title_category']);?></h3>
            <p class="text-center category-desc"><?php echo htmlspecialchars($row['description']);?></p>
            <div class="products">
                <div class="row">
                <?php
                $row_id = $row['id'];
                $query_products = "SELECT id, title, image, price FROM books WHERE category_id=$row_id LIMIT 3";
                $result_products = $conn ->query($query_products);
               
               
                if($result_products->num_rows > 0) {
                    while($row_products = $result_products->fetch_assoc()){  
               
                ?>
                   
                        
                    
                        <div class="col-lg-3 col-sm-6 col-12 container category-item text-center">
                            <a href="<?php echo URLBASE; ?>/view-book.php?id=<?php echo $row_products['id'];?>">
                                <img class="card-image-top" style="width: 140px;" src="<?php echo URLBASE . '/backend/uploads/' .$row_products['image'];?>">
                            </a>
                            <a href="<?php echo URLBASE; ?>/view-book.php?id=<?php echo $row_products['id'];?>">
                                <h4 class="book-title"><?php echo $row_products['title'] ?></h4>
                            </a>
                            
                            <form method="POST" class="add-cart">
                                <span class="price"><?php echo htmlspecialchars($row_products['price']);  ?>лв.</span>
                                <button type="submit" name="add" class="btn-add">
                                                <p style="margin-bottom: 0;">Добавете🛒</p>
                                            </button>
                                <input type="hidden" name="product_id" value="<?php echo $row_products['id'];  ?>">
                            </form>
                        </div>
                    
                <?php

                    }
                } 
                ?> 
                </div> 
            </div>
         </div>   
         
    <?php
    }
}
?>
</div>
<script>

      jQuery(document) . ready(function ($){
            $('.fadeOut') .owlCarousel({
                items: 1,
                animateOut: 'fadeOut',
                loop: true,
                margin: 10,
             });

    });

</script>