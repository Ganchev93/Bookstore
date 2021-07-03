<?php


require_once 'header.php';


$query = "SELECT * FROM users";
$result = $conn->query($query);

if(!$result) die("Fatal error");
?>
<table class="table table-info">
  <thead>
    <tr>
      <th scope="col">Потребилтеско име</th>
      <th scope="col">Имейл</th>
      <th scope="col">Име</th>
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
                <td><?php echo htmlspecialchars($row['username']);?></td>
                <td><?php echo htmlspecialchars($row['email']);?></td>
                <td><?php echo htmlspecialchars($row['name']);?></td>
                <td><?php echo date('d.m.Y',strtotime($row['registered']));?></td>
                <td >
                          
                    <a    style="color: red;
                          background-color: white;
                          text-decoration: none;
                          border: red 1px solid;
                          border-radius: 5px;
                          font-size: 16px;
                          padding: 1px 12px;
                          display: block;
                          margin-top:5px;
                          text-align:center; " href="<?php echo URLBASE; ?>/backend/includes/user/delete-user.php?id=<?php echo $row['id'];?>" onclick="return confirm('сигурен ли сте,че искате да изтриете потребителя?')">изтриване</a>
                      
                      <a href="<?php echo URLBASE; ?>/backend/view-orders.php?id=<?php echo $row['id'];?>"style="color: blue;
                          background-color: white;
                          text-decoration: none;
                          border-radius: 5px;
                          border:solid 1px blue;
                          font-size: 16px;
                         
                          display: block;
                          margin-top:5px;
                          text-align:center; 
                          ">Преглед на поръчките</a>
                    
                  
                </td>
            </tr>
        <?php    
        }
    }
  ?>
    
  </tbody>
</table>
<?php ?>