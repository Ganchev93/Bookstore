<?php
require_once 'header.php';

$customer_id = $_SESSION['login_user'];
$query = "SELECT users.* FROM users where id = $customer_id";
$result = $conn->query($query);

if(!$result) die("Fatal error");
$rows = $result->num_rows;
$row = $result -> fetch_assoc() ?>

<h1 style="margin-top: 80px;" class="text-center category-title">Моят профил</h1>

<div class="col-md-8 container">
              <div class="card mb-3">
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Потребилтеско име:</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo htmlspecialchars($row['username']) ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Имейл:</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo htmlspecialchars($row['email']) ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Регистриран на:</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo htmlspecialchars($row['registered']) ?>
                    </div> 
                  </div>  
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Име:</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo htmlspecialchars($row['name']) ?>
                    </div> 
                  </div>  
                </div>
              </div>
</div>

<h2 class="text-center category-title">Моите поръчки</h2>

<?php

$customer_id2 = $_SESSION['login_user'];
$query = "SELECT orders.* FROM orders WHERE users_id = $customer_id2";
$result = $conn->query($query);

if(!$result) die("Fatal error");
$rows = $result->num_rows;
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) { ?>



<div class="col-md-8 container">
              <div class="card mb-3">
                <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Номер на поръчка</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo htmlspecialchars($row['id']) ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Номер на книги:</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php $line_items = json_decode($row['book_isbn']);
                     foreach($line_items as $item){
                      echo $item->booksid . "  ,   ";
                      }

                    ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">поръчана на:</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo htmlspecialchars($row['purchase_date']) ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Адрес:</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo htmlspecialchars($row['address']) ?>
                    </div> 
                  </div>  
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">обща сума</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo htmlspecialchars($row['total']) ?>лв.
                    </div> 
                  </div>  
                </div>
              </div>
</div>
<?php
  }
}
?>