<?php
require_once 'header.php';

$customer_id = $_SESSION['login_user'];
$query = "SELECT users.* FROM users where id = $customer_id";
$result = $conn->query($query);

if(!$result) die("Fatal error");
$rows = $result->num_rows;
?>

<?php $row = $result -> fetch_assoc() ?>

<h1 style="margin-top: 80px;" class="text-center category-title">Моят профил</h1>
<div class="container">
<div class="profile">
    <div class="profile-desc"><h5>Потребителско име :</h5></div>
    <div class="profile-info"><p><?php echo htmlspecialchars($row['username']) ?></p></div>
    <div class="profile-desc"><h5>Имейл адресс :</h5></div>
    <div class="profile-info"><p><?php echo htmlspecialchars($row['email']) ?></p></div>
    <div class="profile-desc"><h5>Регистриран на: </h5></div>
    <div class="profile-info"><?php echo htmlspecialchars($row['registered']) ?></h4></div>
</div>
</div>
<?php
$customer_id2 = $_SESSION['login_user'];
$query = "SELECT orders.* FROM orders where orders.users_id = '$customer_id2'";
$result = $conn->query($query);

if(!$result) die("Fatal error");
$rows = $result->num_rows;

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){  ?>

    
<?php
    }
}
?>
