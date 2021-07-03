<?php
require_once 'header.php';

?>

<div class="container">
    <div class="row">
        <div class="col-12 bg-light">
            <div class="card bg-light">
                <h5 class="card-header text-dark">Добавяне на издател</h5>
                <div class="card-body">
                    <form action="add-publishers.php" method="POST" enctype="multipart/form-data" novalidate>
                        <div class="form-row">
                            <div class="col-12">
                                <label  for="name" class="text-dark">Добавете автор *</label>
                                <input type="text" class="form-control required bg-light" id="name" name="name" required>   
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-12">
                                <label  for="bio" class="text-dark">Добавете биография </label>
                                <input type="text" class="form-control required bg-light" id="bio" name="bio">   
                            </div>
                        </div>

                        <div class="form-row mt-4">
                            <div class="col-12">
                                <input type="submit" id="btn-save" class="btn btn-primary" name="submit" value="Добавяне">
                                <p id="warning" style="padding-top: 10px;color:red;"></p>
                                <p id="success" style="padding-top: 10px;color:green;"></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>

$(document).ready(function () {
        $('#btn-save').unbind().bind('click', function (e) {
            e.preventDefault();
            var name = $('#name').val();
            var bio = $('#bio')
            var form = $('form')[0];
            var formData = new FormData(form);

            if(name != ""){
            $.ajax({
                    type: 'POST',
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    url: 'includes/book/create-author.php',
                    success: function(dataResult){
                         console.log(dataResult);
                         var  dataResult = JSON.parse(dataResult);
                         console.log(dataResult);
                         console.log(dataResult.statusCode);
                        if(dataResult.statusCode == 200){
                            $('warning').hide();
                            $('form').trigger('reset');
                            $('#success').html('авторът е добавен успешно.');
                        } else if(dataResult.statusCode == 201){

                        }
                        else {
                            alert("Error");
                        }
                    }
            });
           

        }   else {
                $('form').addClass('validate');
            }                
    });
});    

</script>