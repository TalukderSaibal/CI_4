
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= base_url('icon/favicon.ico') ?>" />
    <title>Document</title>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

    <!-- Font Awesome CDN Link Here -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" >

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>

    <!-- Summer Note CDN Here -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>


    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="language_header">
                <div class="lan_head">
                    <h1>Update Article</h1>
                </div>

                <div class="icon_category">
                    <a href="">
                        Back
                    </a>
                    <a href="">
                        Settings
                    </a>
                </div>

            </div>

            <div class="language_div">
                <div class="language_list">
                    <?php
                    
                    foreach($data as $value){

                    }
                    
                    ?>
                    <form action="<?= base_url('article/update') ?>" method="POST" enctype="multipart/form-data" id="myForm">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Article Id <span style="color:red;">*</span></label>
                            <input type="hidden" value="<?= $value->id ?>" name="articleId">
                        </div>
                        <div class="full_form">
                            <div class="form_left">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Article Title <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" value="<?=  $value->article_title ?>" name="title" id="title">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Slug <span style="color:red;">*</span></label>
                                    <input type="text" class="form-control" id="slug" name="slug" value="<?= $value->slug ?>">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Article Content <span style="color:red;">*</span></label>
                                    <textarea class="form-control" id="summernote" name="summernote"><?= $value->article_content ?></textarea>
                                </div>
                            </div>
                            <div class="form_right">
                                <div class="image_block">
                                    <div class="image">
                                        <div class="form-group">
                                            <img src="<?= base_url('articleImage/' . $value->article_image) ?>" width="100px" alt="article Image">
                                            <label for="exampleFormControlFile1">Choose Image</label>
                                            <input type="file" class="form-control-file" name="image" id="image">
                                        </div>
                                        <p>
                                            Allowed (PNG, JPG, JPEG)
                                            Image will be resized into (1280x720)
                                        </p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Language <span style="color:red;">*</span></label>
                                    <select class="form-control" id="languageSelect" name="languageSelect">
                                        <option value="<?= $value->id ?>"><?= strtoupper($value->language_name) ?></option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Article Category <span style="color:red;">*</span></label>
                                    <select class="form-control" id="categorySelect" name="categorySelect">
                                        <?php
                                        
                                        foreach($data2 as $val1){ ?>
                                            <option selected value="<?= $val1->id ?>"><?= $val1->category_name  ?></option>
                                        <?php }
                                        
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Short Description <span style="color:red;">*</span></label>
                                    <textarea class="form-control" id="description" name="description" rows="3"><?= $value->article_description ?></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>

        </div>
    </div>







    <script src="<?= base_url('js/style.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#summernote').summernote({
        height: 400, // Set the height of the editor
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
        ]
        });
    });
    </script>

    <script>
        $(document).ready(function() {
            console.log(languageCategories);
            $('#languageSelect').on('change',function() {
                var languageSelect = $(this).val();
                var categorySelect = $('#categorySelect');

                categorySelect.empty();

                // Populate options based on selected language
                const categories = languageCategories[languageSelect];
                if (categories && Array.isArray(categories)) {
                    categories.forEach(function(category) {
                        categorySelect.append($('<option></option>').text(category));
                    });
                } else {
                    // Handle the case when no categories are found
                    categorySelect.append($('<option></option>').text('No categories found'));
                }
            });
        });
    </script>

</body>
</html>