<?php
require_once 'header.php';
?>


<div class="container">
    <div class="row">
        <div class="col-12 bg-light">
            <div class="card bg-light">
                <h5 class="card-header text-dark">Добавяне на категория</h5>
                <div class="card-body">
                    <form action="add-category.php" method="POST" enctype="multipart/form-data" novalidate>
                        <div class="form-row">
                            <div class="col-12">
                                <label  for="isbn" class="text-dark">Категория *</label>
                                <input type="text" class="form-control required bg-light" id="title_category" name="title_category" required>
                            </div>
                            <div class="col-12">
                                <label for="title" class="text-dark">Описание *</label>
                                <input type="text" class="form-control required bg-light" id="description" name="description" required>
                            </div>
                            <div class="col-12">
                                <h5>Показване на категорията на началната страница</h5>
                                <input type="radio" id="TRUE" data-radio="false" name="show_home" value="TRUE">
                                <label for="TRUE">Да</label>

                                <input type="radio" id="FALSE" data-radio="false"  name="show_home" value="FALSE">
                                <label for="FALSE">Не<label>
                            </div>

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
    $('#btn-save').unbind().bind('click', function (e){
    e.preventDefault();
        var title_category = $('#title_category').val()
        var description = $("#description").val()
        var false_ = $('#FALSE').is(":checked");
        var true_ = $('#TRUE').is(":checked");

        var show_home = ""

        if(false_)show_home="false"
        else show_home="true"
        
        $.ajax({
                type: 'POST',
                data:{
                    'title_category': title_category,
                    'description': description,
                    'show_home': show_home,
                },
                // cache: false,
                // processData: false,
                // contentType: false,
                url: "includes/book/create-category.php",
                success: function(dataResult){
                        console.log(dataResult);
                       var  dataResult = JSON.parse(dataResult);
                       console.log(dataResult);
                        console.log(dataResult.statusCode);
                        if(dataResult.statusCode == 200){
                            $('warning').hide();
                            $('form').trigger('reset');
                            $('#success').html('Категорията е добавена успешно.');
                        
                        } else {
                            alert("Error");
                        } 
                    } 
    
        }); 
    });
}); 
</script>