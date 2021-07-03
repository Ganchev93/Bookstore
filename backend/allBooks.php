<?php


require_once 'header.php';


$query = "SELECT books.*, author.name FROM books INNER JOIN author ON books.author_id = author.id";
$result = $conn->query($query);

if(!$result) die("Fatal error");


//for($i=0; $i < $rows; $i++){
   /* $result ->data_seek($i);
    echo"isbn: " . htmlspecialchars($result->fetch_assoc()['isbn']) . '<br>';
    $result ->data_seek($i);
    echo"Title: " . htmlspecialchars($result->fetch_assoc()['title']) . '<br>';
    $result ->data_seek($i);
    echo"authour_id: " . htmlspecialchars($result->fetch_assoc()['author_id']) . '<br>';
    $result ->data_seek($i);
    echo"price: " . htmlspecialchars($result->fetch_assoc()['rice']) . '<br>';*/

    
    
//}



?>

<table class="table table-info">
  <thead>
    <tr>
      <th scope="col">ISBN</th>
      <th scope="col">Заглавие</th>
      <th scope="col">Автор</th>
      <th scope="col">Създадена на </th>
      <th scope="col">Действия</th>
    </tr>
  </thead>
  <tbody>
  <?php
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){  
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row['isbn']);?></td>
                <td><?php echo htmlspecialchars($row['title']);?></td>
                <td><?php echo htmlspecialchars($row['name']);?></td>
                <td><?php echo date('d.m.Y',strtotime($row['created_at']));?></td>
                <td >
                          
                    <a href="<?php echo URLBASE; ?>/view-book.php?id=<?php echo $row['id'];?>"style="color: rgb(19, 19, 19);
                      background-color: rgb(164, 184, 184);
                      text-decoration: none;
                      border-radius: 5px;
                      font-size: 16px;
                      padding: 1px 15px;
                      display: block;
                      margin-bot:10px;
                      text-align:center;
                      
                    ">Преглед</a>
                    <a href="<?php echo URLBASE; ?>/backend/edit-book.php?id=<?php echo $row['id'];?>"style="color: rgb(19, 19, 19);
                          background-color: rgb(137, 216, 216);
                          text-decoration: none;
                          border-radius: 5px;
                          font-size: 16px;
                          padding: 1px 12px;
                          display: block;
                          margin-top:5px;
                          text-align:center; 
                          ">Редактиране</a>
                    <a href="<?php echo URLBASE; ?>/backend/includes/book/delete-book.php?id=<?php echo $row['id'];?>" onclick="return confirm('Сигурен ли сте,че искате да изтриете книгата?')" style="color:red;
                          background-color: white;
                          text-decoration: none;
                          border-radius: 5px;
                          border:1px solid red;
                          font-size: 16px;
                          padding: 1px 12px;
                          display: block;
                          margin-top:5px;
                          text-align:center; 
                          " >изтриване</a>
                </td>
            </tr>
        <?php    
        }
    }
  ?>
    
  </tbody>
</table>

<?php
$result ->close();
$conn ->close();
