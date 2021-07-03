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
    
        <title>Регистрация</title>
    
</head>

<body class="registration">
    <div class="row m-0 h-100">
        <div class="col p-0 text-center d-flex justify-content-center align-items-center m-display-none-img">
            <img src="../common/assest/img/login.svg" class="w-100">
        </div>
        <div class="col p-0 bg-custom d-flex justify-content-center align-items-center flex-column w-100">
            <form class="w-75" action="#">
                <div class="mb-3">
                    <label for="Username" class="form-label">Потребителско име</label>
                    <input type="text" class="form-control" id="username" placeholder="username" autocomplete="off"
                        required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Име</label>
                    <input type="text" class="form-control" id="name" placeholder="name" autocomplete="off"
                        required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Имейл</label>
                    <input type="email" class="form-control" id="email" placeholder="email" autocomplete="off"
                        required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Парола</label>
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
                <button type="button" id="btn-register" class="btn btn-custom btn-lg btn-block mt-3">Регистриране</button>
                <p id="success" style="display:none;color:greenyellow;"></p>
                <p id="error" style="display: none;color:red;"></p>
            </form>
        </div>
        
    </div>
</body>

</html>

<script>
    $('#btn-register').unbind().bind('click', function(e){
        e.preventDefault();
        var username = $('#username').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var name = $('#name').val();
        
        if (username != "" && email != "" && password != "") {
            $.ajax({
                url: "includes/user/create.php",
                type: "POST",
                data: {
                    username: username,
                    email: email,
                    password: password,
                    name: name,
                },
                cache: false,
                success: function(dataResult){
                    var dataResult = JSON.parse(dataResult);


                    if(dataResult.statusCode == 200){
                        $('#success').show();
                        $('#success').html('Успешна регистрация!');
                        var url = "../index.php"
                        window.location.href = url;
                    } else if (dataResult.statusCode == 201){
                        $('#error').show();
                        $('#error').html('Имейлът или името, което ползвате вече съществува');
                    }
                }
            });
        } else {
            alert('Попълнете задължителните полета!')
        }
    });
</script>