<?php
require_once 'header.php';

$sql_author = "SELECT id, name FROM author";
$result_author = $conn->query($sql_author);

$sql_categories = "SELECT id, title_category FROM categories";
$result_categories = $conn->query($sql_categories);

$sql_publishers = "SELECT id, title_publishers FROM publishers";
$result_publishers = $conn->query($sql_publishers);

$conn->close();
?>

<div class="container">
    <div class="row">
        <div class="col-12 bg-light">
            <div class="card bg-light">
                <h5 class="card-header text-dark">Добавяне на нова книга</h5>
                <div class="card-body">
                    <form action="add-book.php" method="POST" enctype="multipart/form-data" novalidate>
                        <div class="form-row">
                            <div class="col-12">
                                <label  for="isbn" class="text-dark">ISBN *</label>
                                <input type="text" class="form-control required bg-light" id="isbn" name="isbn" required>
                            </div>
                            <div class="col-12">
                                <label for="title" class="text-dark">Заглавие *</label>
                                <input type="text" class="form-control required bg-light" id="title" name="title" required>
                            </div>
                            <div class="col-12">
                                <label for="author" class="text-dark">Автор *</label>
                                <select class="form-control required bg-light" id="author" name="author">
                                    <?php
                                    if ($result_author->num_rows > 0) {
                                        while ($row = $result_author->fetch_assoc()) {
                                            ?> 
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="category" class="text-dark">Категория *</label>
                                <select class="form-control required bg-light" id="category" name="category">
                                    <?php
                                    if ($result_categories->num_rows > 0) {
                                        while ($row = $result_categories->fetch_assoc()) {
                                            ?> 
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['title_category']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="year" class="text-dark">Година</label>
                                <input type="text" class="form-control bg-light" id="year" name="year">
                            </div>
                            <div class="col-12">
                                <label for="description" class="text-dark">Описание</label>
                                <textarea type="text" class="form-control bg-light" id="description" name="description"></textarea>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-dark" for="cover">Добавяне на снимка</label>
                                <input type="file" class="form-control bg-light" id="cover" name="cover" accept="image/*" />
                            </div>
                            <div class="col-12">
                                <label for="lang" class="text-dark">Език</label>
                                <input type="text" class="form-control bg-light" id="lang" name="lang">
                            </div>
                            <div class="col-12">
                                <label for="price" class="text-dark">Цена *</label>
                                <input type="number" class="form-control required bg-light" id="price" name="price" required>
                            </div>
                            <div class="col-12">
                                <label for="publisher" class="text-dark">Издател *</label>
                                <select class="form-control required bg-light" id="publisher" name="publisher">
                                    <?php
                                    if ($result_publishers->num_rows > 0) {
                                        while ($row = $result_publishers->fetch_assoc()) {
                                            ?> 
                                            <option value="<?php echo $row['id']; ?>"><?php echo $row['title_publishers']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
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
            var isbn = $('#isbn').val();
            var title = $('#title').val();
            var author = $('#author').val();
            var category = $('#category').val();
            var year = $('#year').val();
            var description = $('#description').val();
            var cover = $('#cover').val();
            var lang = $('#lang').val();
            var price = $('#price').val();
            var publisher = $('#publisher').val();

            var form = $('form')[0];
            var formData = new FormData(form);
            formData.append('cover', $('input[type=file]')[0].files[0]);
            
            if(isbn != "" && title != "" && category != "" && price != ""){
                $.ajax({
                    type: 'POST',
                    data: formData,
                    // data: {
                    //     isbn: isbn,
                    //     title: title,
                    //     author: author,
                    //     category: category,
                    //     year: year,
                    //     description: description,
                    //     cover: cover,
                    //     lang: lang,
                    //     price: price,
                    //     publisher: publisher,
                    // },
                    cache: false,
                    processData: false,
                    contentType: false,
                    url: 'includes/book/create.php',
                    success: function(dataResult){
                        console.log(dataResult);
                       var  dataResult = JSON.parse(dataResult);
                       console.log(dataResult);
                        console.log(dataResult.statusCode);
                        if(dataResult.statusCode == 200){
                            $('warning').hide();
                            $('form').trigger('reset');
                            $('#success').html('Книгата е добавена успешно.');
                        } else if(dataResult.statusCode == 201 && dataResult.flag != "") {
                            switch (dataResult.flag){
                                case 1: 
                                    $('#warning').html('You file extension must be .jpg, .jpeg or .png');
                                    break;

                                case 2:
                                    $('#warning').html('File too large');   
                                    break;
                            
                                case 3:
                                    $('#warning').html('Failed to upload file');
                                    break;    
                            }   
                        } else {
                            alert("Error");
                        }
                    }
                });
            } else {
                $('form').addClass('validate');
            }
        });
    });
</script>