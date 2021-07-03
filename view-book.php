<?php

require_once 'header.php';

//WHERE books.id = '$product_id'";

$product_id = $_GET['id'];

// $query = "SELECT books.*, author.name FROM books INNER JOIN author ON books.author_id = author.id WHERE books.id = '$product_id'";
$query = "SELECT books.*, author.name, publishers.title_publishers, categories.title_category FROM books INNER JOIN author ON books.author_id = author.id 
                                                                                                         INNER JOIN publishers ON books.publisher_id = publishers.id 
                                                                                                         INNER JOIN categories on books.category_id = categories.id WHERE books.id = '$product_id'";

$result = $conn->query($query);


 if($result->num_rows > 0) {
     while($row = $result->fetch_assoc()){ ?>
     <div style="margin-top:100px">
        <h1 class="text-center"><?php echo $row['title']; ?> </h1>
        <div class="container view-book">
            <div>
              <img src="<?php echo URLBASE . '/backend/uploads/' .$row['image'];?>" class="view-book-image">
            </div>
          <div class="view-book-info "> 
              <div class="grid-item"> <p class="book-info">Автор</p></div>
              <div class="grid-item"> <P class="book-desc"><?php echo $row['name']; ?></P></div>
              <div class="grid-item"> <p class="book-info">Година</p></div>
              <div class="grid-item"><P class="book-desc"><?php echo $row['year']; ?></p></div>
              <div class="grid-item"> <p class="book-info">Категория</p></div>
              <div class="grid-item"><p class="book-desc"><?php echo $row['title_category']; ?></p></div>
              <div class="grid-item"> <p class="book-info">Издател</p></div>
              <div class="grid-item"><p class="book-desc"><?php echo $row['title_publishers']; ?></p></div>
              <div class="grid-item"> <p class="book-info">Описание</p></div>
              <div class="grid-item"><p class="book-desc"><?php echo $row['description']; ?></p></div>
              <div class="grid-item"> <p class="book-info">ISBN</p></div>
              <div class="grid-item"><p class="book-desc"><?php echo $row['isbn']; ?></p></div>
              <div class="grid-item"> <p class="book-info">Език</p></div>
              <div class="grid-item"><p class="book-desc"><?php echo $row['lang']; ?></p></div>
              <div class="grid-item"> <p class="book-info">Цена</p></div>
              <div class="grid-item"><form method="POST" >
                                <span class="price"><?php echo htmlspecialchars($row['price']);  ?>лв.</span>
                                <button type="submit" name="add" class="btn-add" style="height: 35px;">
                                <p style="margin-bottom: 0;">Добавете🛒</p>
                                            </button>
                                <input type="hidden" name="product_id" value="<?php echo $row['id'];  ?>">
                            </form></div>
          </div>
       </div>

      
       <div class="home-category">
            <h3 style="margin-top:60px" class="text-center category-title">Подобни книги</h3>
            
            <?php

            $query_related = "SELECT id, title, image, price FROM books WHERE category_id=$row[category_id] ";
            $result_related = $conn ->query($query_related);
            ?>
            <div class="container related-books"> 
            <?php
           
              if($result_related->num_rows > 0) {
                while($row_related = $result_related->fetch_assoc()){ 
                  
            ?>
             
              <div class="col-lg-3 col-sm-6 col-12 container category-item text-center">
                            <a href="<?php echo URLBASE; ?>/view-book.php?id=<?php echo $row_related['id'];?>">
                                <img class="card-image-top" style="width: 140px;" src="<?php echo URLBASE . '/backend/uploads/' .$row_related['image'];?>">
                            </a>
                            <a href="<?php echo URLBASE; ?>/view-book.php?id=<?php echo $row_related['id'];?>">
                                <h4 class="book-title"><?php echo $row_related['title'] ?></h4>
                            </a>
                            <form method="POST" class="add-cart">
                                <span class="price"><?php echo htmlspecialchars($row_related['price']);  ?>лв.</span>
                                <button type="submit" name="add" class="btn-add" >
                                              <p style="margin-bottom: 0;">Добавете🛒</p>
                                            </button>
                                <input type="hidden" name="product_id" value="<?php echo $row_related['id'];  ?>">
                            </form>
                         </div>

             
             <?php
              };
            };
          
             ?>
       </div>
       </div>

       
 
     <?php  
                
          
  };
};
?> 



