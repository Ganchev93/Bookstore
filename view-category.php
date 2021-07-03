<?php 
require_once 'header.php';

$product_id = $_GET['id'];
$product_id = (string)$product_id;

$query_products = "SELECT id, title, image, price FROM books WHERE category_id=$product_id";
$result_products = $conn ->query($query_products);
?>

<h1 class='text-center view-categories-title'>Книги от този жанр</h1>

<div class="container view-categories">
<?php
if($result_products->num_rows > 0) {
    while($row = $result_products->fetch_assoc()){ ?>

        
  
        
                        <div class="col-lg-3 col-sm-6 col-12 container category-item text-center">
                            <a href="<?php echo URLBASE; ?>/view-book.php?id=<?php echo $row['id'];?>">
                                <img class="card-image-top" style="width: 140px;" src="<?php echo URLBASE . '/backend/uploads/' .$row['image'];?>">
                            </a>
                            <a href="<?php echo URLBASE; ?>/view-book.php?id=<?php echo $row['id'];?>">
                                <h4 class="book-title"><?php echo $row['title'] ?></h4>
                            </a>
                            <form method="POST" class="add-cart">
                                <span class="price"><?php echo htmlspecialchars($row['price']);  ?>лв.</span>
                                <button type="submit" name="add" class="btn-add" >
                                            <p style="margin-bottom: 0;">Добавете🛒</p>
                                            </button>
                                <input type="hidden" name="product_id" value="<?php echo $row['id'];  ?>">
                            </form>
                        </div>
        

<?php
    };
};
?>
</div>















