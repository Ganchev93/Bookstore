<?php 
require_once 'header.php';

$user_id = $_GET['id'];
$query = "SELECT orders.* FROM orders WHERE users_id = $user_id";
$result = $conn -> query($query);


?>
<table class="table table-info">
  <thead>
    <tr>
      <th scope="col">ISBN</th>
      <th scope="col">Име</th>
      <th scope="col">Номер на поръчката</th>
      <th scope="col">Имейл</th>
      <th scope="col">Адрес</th>
      <th scope="col">Телефон</th>
      <th scope="col">Поръчана на</th>
    </tr>
  </thead>
  <tbody>
<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>

            <tr>
                <td><?php $line_items = json_decode($row['book_isbn']);
                     foreach($line_items as $item){
                      echo $item->booksid . "  ,   ";
                      }

                    ?></td>
                <td><?php echo htmlspecialchars($row['name']);?></td>
                <td><?php echo htmlspecialchars($row['id']);?></td>
                <td><?php echo htmlspecialchars($row['email']);?></td>
                <td><?php echo htmlspecialchars($row['address']);?></td>
                <td><?php echo htmlspecialchars($row['phone']);?></td>
                <td><?php echo date('d.m.Y',strtotime($row['purchase_date']));?></td>
               
   
            </tr>
  </tbody>
<?php
    }
}

?>