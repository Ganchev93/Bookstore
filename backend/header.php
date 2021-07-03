<?php

require_once '../common/includes/DBconnect.php';
require_once 'includes/check.php';
define ('URLBASE' , 'https://test.local/bookstore');
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../common/assest/vendor/bootstrap/css/bootstrap.min.css">
        <!-- theme CSS -->      
        <link rel="stylesheet" href="../common/assest/libs/css/style.css">
        <!-- Bootstrap bungle js  -->
        <script src="../common/assest/vendor/bootstrap/js/bootstrap.bundle.js"></script>
         <!-- Jquery 3.6.0 -->
        <script src="../common/assest/vendor/jquery/jquery-3.6.0.min.js"></script>
    </head>
    <body>

            <div class="vertical-nav bg-light"  id="sidebar">
            <div class="py-4 px-3 mb-4 bg-light">
                <div class="media d-flex align-items-center"><img src="https://cdn.dribbble.com/users/2124546/screenshots/4470294/logo-bookstore.png" alt="..." width="100" class="mr-1 rounded-circle img-thumbnail shadow-sm">
                <div class="media-body">
                    <h4 class="m-0"><?php echo $_SESSION['username'] ?></h4>
                    <a href="#" id="btn-logout" style="color: red;">Изход</a>
                </div>
                </div>
            </div>

            <p class="text-dark font-weight-bold text-uppercase px-3 small pb-4 mb-0">Начало</p>

            <ul class="nav flex-column bg-light mb-0">
                <li class="nav-item">
                <a href="<?php echo URLBASE; ?>/backend/index.php" class="nav-link text-dark font-italic bg-light">
                            <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                            Начало
                        </a>
                </li>
                <li class="nav-item">
                <a href="<?php echo URLBASE; ?>/backend/allBooks.php" class="nav-link text-dark font-italic">
                            <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                            Всички книги
                        </a>
                </li>
                <li class="nav-item">
                <a href="<?php echo URLBASE; ?>/backend/all-authors.php" class="nav-link text-dark font-italic">
                            <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                            Всички автори
                        </a>
                </li>
                <li class="nav-item">
                <a href="<?php echo URLBASE; ?>/backend/all-categories.php" class="nav-link text-dark font-italic">
                            <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                            Всички категорий
                        </a>
                </li>
                <li class="nav-item">
                <a href="<?php echo URLBASE; ?>/backend/all-publishers.php" class="nav-link text-dark font-italic">
                            <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                            Всички издатели
                        </a>
                </li>
                <li class="nav-item">
                <a href="<?php echo URLBASE; ?>/backend/add-book.php" class="nav-link text-dark font-italic ">
                            <i class="fa fa-cubes mr-3 text-primary fa-fw"></i>
                            Добавяне на книга
                        </a>
                </li>
                <li class="nav-item">
                <a href="<?php echo URLBASE; ?>/backend/add-category.php" class="nav-link text-dark font-italic">
                            <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                            Добавяне на категория
                        </a>
                </li>
            
                <li class="nav-item">
                <a href="<?php echo URLBASE; ?>/backend/add-publishers.php" class="nav-link text-dark font-italic">
                            <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                            Добавяне на издател
                        </a>
                </li>
                <li class="nav-item">
                <a href="<?php echo URLBASE; ?>/backend/add-author.php" class="nav-link text-dark font-italic">
                            <i class="fa fa-picture-o mr-3 text-primary fa-fw"></i>
                            Добавяне на автор
                        </a>
                </li>
                
            </ul>

            </ul>


            
            <p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Charts</p>

            <ul class="nav flex-column bg-light mb-0">
                <li class="nav-item">
                <a href="all-users.php" class="nav-link text-dark font-italic">
                            <i class="fa fa-area-chart mr-3 text-primary fa-fw"></i>
                            Всички потребители
                        </a>
                </li>
               
            </ul>
            </div>

            <div class="page-content p-5" id="content">
  
<script>
    $('#btn-logout').unbind().bind('click', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            cache: false,
            url: 'includes/user/logout.php',
            success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if (dataResult.statusCode == 200){
                    window.location = "../index.php";                
                }else if (dataResult.statusCode == 201){
                    alert('Error');
                }
            }
        });
    });

</script>

