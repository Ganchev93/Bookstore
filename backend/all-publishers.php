<?php
require_once 'header.php';


$query = "SELECT title_publishers,id, created_at FROM publishers";
$result = $conn->query($query);

if(!$result) die("Fatal error");
?>
<table class="table table-info">
  <thead>
    <tr>
      <th scope="col">Издател</th>
      <th scope="col">Добавена на:</th>
      <th scope="col">Действия</th>
    </tr>
  </thead>
  <tbody>
  <?php
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){  
            ?>
            <tr>
                <td><?php echo htmlspecialchars($row['title_publishers']);?></td>
            
                <td><?php echo date('d.m.Y',strtotime($row['created_at']));?></td>
                <td><a href="<?php echo URLBASE; ?>/backend/includes/book/delete-publisher.php?id=<?php echo $row['id'];?>" onclick="return confirm('Сигурен ли сте,че искате да премахнете издателя?')" style="color:red;
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