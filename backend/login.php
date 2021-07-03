<!doctype html>
<html lang="en">
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
    
        <title>Вписване</title>
    
</head>

<body class="registration">
    <div class="row m-0 h-100">
        <div class="col p-0 text-center d-flex justify-content-center align-items-center m-display-none-img">
            <img src="../common/assest/img/login.svg" class="w-100">
        </div>
        <div class="col p-0 bg-custom d-flex justify-content-center align-items-center flex-column w-100">
            <form class="w-75" action="#">
                <div class="mb-3">
                    <label for="Username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="username" autocomplete="off"
                        required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="password" autocomplete="off"
                        required>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>
                    </div>
                </div>
               <div class="login-btns">            
                <div>
                    <button type="button" id="btn-login" class="btn btn-custom btn-lg btn-block mt-3">Вход</button>
                    <p id="success" style="display:none;color:greenyellow;"></p>
                    <p id="error" style="display: none;color:red;"></p>
                </div>
                    <div>
                        <a class="btn-reg" href="./registration.php">Регистриране</a>
                    </div>
               </div> 
            </form>

         
        </div>
    </div>
</body>

</html>

<script>
    $('#btn-login').unbind().bind('click',function(e){
        e.preventDefault();
        var username = $("#username").val();
        var password = $("#password").val();

        if(username != "" && password != ""){
            $.ajax({
                type: 'POST',
                data: {
                    "username": username,
                    "password": password,
                },
                cache: false,
                url: 'includes/user/login.php',
                success: function(dataResult){
                    console.log(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    
                    if(dataResult.statusCode == 200){
                        window.location = "../index.php";
                    } else if(dataResult.statusCode == 201){
                        $('#error').show();
                        $('#error').html('Паролата не съвпада');
                    } else if(dataResult.statusCode == 202){
                        $('#error').show();
                        $('#error').html('Няма такъв потребител');
                    }
                }
            })
        } else {
            alert('Моля въведете вашите данни');
        }
    });
</script>