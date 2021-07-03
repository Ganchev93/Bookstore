<?php 
require_once 'header.php';
?>

<h1 style="margin-top: 100px;" class="text-center category-title">Изпратете ни Имейл като попълните полетата</h1>
<div class="form">
    
<form class="container text-center" action="mail.php" method="POST">
<p class="form-desc text-center">Име*</p> <input class="form-field" placeholder="Иван Иванов" type="text" name="name" required>
<p class="form-desc text-center">Имейл*</p> <input class="form-field" placeholder="Ivan@gmail.com" type="text" name="email" required>
<p class="form-desc text-center">Телефон</p> <input class="form-field" placeholder="XX-XXX-XXX-XXX" type="text" name="phone" >
<p class="form-desc text-center">Съобщение</br>▽</p><textarea placeholder="" class="form-field" name="message" rows="6" cols="25" required></textarea><br />
<input class="btn btn-primary form-btn" type="submit" value="Send">
</form>
</div>
