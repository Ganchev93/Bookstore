<?php
require_once 'header.php';
?>

<?php
$book_id = $_GET['id'];
$query = "SELECT books.* FROM books WHERE books.id='$book_id'";
$result = $conn->query($query);
if(!$result) die("Fatal error");

$sql_authors = "SELECT id, name FROM author";
$result_authors = $conn->query($sql_authors);

$sql_categories = "SELECT id, title_category FROM categories";
$result_categories = $conn->query($sql_categories);

$sql_publishers = "SELECT id, title_publishers FROM publishers";
$result_publishers = $conn->query($sql_publishers);

$rows = $result->num_rows;



function shorter($text, $chars_limit)
{
    
    if (strlen($text) > $chars_limit)
    {
        $new_text = substr($text, 0, $chars_limit);
        $new_text = trim($new_text);
        return $new_text . "...";
    }
    
    else
    {
    return $text;
    }
}

?>
<div class="container">
        <div class="row">
            <div class="col-12 bg-light">
                <div class="card bg-light">
                    <h2>Редактиране на книга</h2>
                <div class="card-body">
           
               
             <?php
             $row = $result -> fetch_assoc()
             ?>
                        
           
            <h1>Нови стойности</h1>
                 <form class="add-form" action="add-book.php" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="form-row">
                        <div class="col-12">
                            <label for="isbn">ISBN *</label>
                            <input type="text" class="form-control required bg-light" id="isbn" name="isbn" required value="<?php echo htmlspecialchars($row['isbn']);?>">
                        </div>
                        <div class="col-12">
                            <label for="title">Заглавие *</label>
                            <input type="text" class="form-control required bg-light" id="title" name="title" required value="<?php echo htmlspecialchars($row['title']);?>">
                        </div>
                    <div class="col-12">
                        <label for="author">Автор *</label>
                        <select id="author" class="form-control required bg-light" name="author">
                            <?php
                                if ($result_authors->num_rows > 0) {
                                    while ($row_authors = $result_authors->fetch_assoc()) {
                                        ?> 
                                        <option value="<?php echo $row_authors['id']; ?>" <?php echo ($row_authors['id']==$row['author_id']) ? 'selected' : '' ;?>><?php echo $row_authors['name']; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="category">Категория *</label>
                        <select id="category" class="form-control required bg-light" name="category">
                            <?php
                                if ($result_categories->num_rows > 0) {
                                    while ($row_category = $result_categories->fetch_assoc()) {
                                        ?> 
                                        <option value="<?php echo $row_category['id']; ?>" <?php echo ($row_category['id']==$row['category_id']) ? 'selected' : '' ;?>><?php echo $row_category['title_category']; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="year">Година</label>
                        <input type="text" id="year" name="year" class="form-control bg-light" value="<?php echo htmlspecialchars($row['year']);?>">
                    </div>
                    <div class="col-12m">
                        <label for="description">Описание</label>
                        <textarea type="text" id="description" class="form-control bg-light" name="description" value="<?php echo htmlspecialchars($row['description']);?>"></textarea>
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="cover">Добавяне на снимка</label>
                        <input type="file" id="cover" name="cover" class="form-control bg-light" accept="image/*" />
                    </div>
                    <div class="col-12">
                        <label for="lang">Език</label>
                        <input type="text" id="lang" name="lang" class="form-control bg-light" value="<?php echo htmlspecialchars($row['lang']);?>">
                    </div>
                    <div class="col-12">
                        <label for="price">Цена *</label>
                        <input type="number" id="price" name="price" class="form-control bg-light" required value="<?php echo htmlspecialchars($row['price']);?>">
                    </div>
                   
                    <div class="col-12">
                        <label for="publisher">Издател *</label>
                        <select id="publisher" class="form-control bg-light" name="publisher">
                            <?php
                                if ($result_publishers->num_rows > 0) {
                                    while ($row_publishers = $result_publishers->fetch_assoc()) {
                                        ?> 
                                        <option value="<?php echo $row_publishers['id']; ?>" <?php echo ($row_publishers['id']==$row['publisher_id']) ? 'selected' : '' ;?>><?php echo $row_publishers['title_publishers']; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <input id="bookid" name="bookid" type="hidden" value=<?php echo $book_id;?>>
                <div class="form-row mt-4">
                    <div class="col-12">
                        <input type="submit" id="btn-save" class="btn btn-primary" name="submit" value="Добавяне">
                        <p id="success" style="padding-top: 10px;color:green;"></p>
                        <p id="warning"></p>
                    </div>
                </div>
                
            </form>
                </div>
            </div>   
        </div>
    </div>
</div>

<?php

?>


<script>
    $(document).ready(function () {
        $('#btn-save').unbind().bind('click', function (e) {
            e.preventDefault();
            var book_id = '<?php echo $book_id; ?>';
            var isbn = $('#isbn').val();
            var title = $('#title').val();
            var author_id = $('#author').find(':selected').attr('value');
            var category_id = $('#category').find(':selected').attr('value')
            var year = $('#year').val();
            var description = $('#description').val();
            var cover = $('#cover').val();
            var lang = $('#lang').val();
            var price = $('#price').val();
            var publisher_id = $('#publisher').find(':selected').attr('value');

            if(isbn != "" && title != "" && category != "" && price != ""){
                $.ajax({
                    type: 'POST',
                    data: {
                        'book_id':book_id,
                        'isbn':isbn,
                        'title':title,
                        'author_id':author_id,
                        'category_id':category_id,
                        'year':year,
                        'description':description,
                        'lang':lang,
                        'price':price,
                        'publisher_id':publisher_id,
                    },
                    url: 'includes/book/edit-book1.php',
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        console.log(dataResult)
                        if(dataResult.statusCode == 200){
                            $('#warning').hide();
                            $('form').trigger('reset');
                            $('#success').html('Книгата е редактирана успешно.');

                            $('#isbn').val(isbn);
                            $('#title').val(title);
                            $('#year').val(year);
                            $('#description').val(description);
                            $('#cover').val(cover);
                            $('#lang').val(lang);
                            $('#price').val(price);
                            // How to set selected option element with jquery
                        } else if(dataResult.statusCode == 201 && dataResult.flag != ""){
                            switch (dataResult.flag){
                                case 1: 
                                    $('#warning').html('Your file extension must be .jpg, .jpeg or .png');
                                    break;
                                case 2:
                                    $('#warning').html('File too large!');
                                    break;
                                case 3:
                                    $('#warning').html('Failed to upload file.');
                                    break;
                            }
                        } else {
                            alert("Eroor");
                        }
                    }
                });
            } else {
                $('form').addClass('validate');
            }
        });
    });
</script>