<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

    <div class="form_flex11">
        <h2>Category Create</h2>
        <h4 style="color: red;"><?= $msg ?></h4>
        <div class="language_div">
            <div class="language_list">

            <?php if (session('success')) : ?>
                <div class="alert alert-success"><?php echo session('success'); ?></div>
            <?php endif; ?>

                <form action="" method="POST" enctype="multipart/form-data" id="myForm">
                    <div class="form_display">
                        <div class="category_select">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Language <span style="color:red;">*</span></label>
                                <select class="form-control" name="language">
                                    <option value="0">Choose</option>
                                    <?php
                                    
                                    foreach($languages as $key => $language){ ?>
                                        <option value="<?= $language['id'] ?>"><?= $language['language_name'] ?></option>
                                    <?php }
                                    
                                    ?>
                                    <span><?= validation_show_error('language') ?></span>
                                </select>
                            </div>
                        </div>

                        <div class="category_select">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Catgeory Name <span style="color:red;">*</span></label>
                                <input type="text" class="form-control" name="name" id="name">
                                <span><?= validation_show_error('name') ?></span>
                                <span id="categoryErr"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="slug" id="slug">
                        <span><?= validation_show_error('slug') ?></span>
                        <span id="successDiv"></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="<?= base_url('js/style.js') ?>"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $('#myForm').submit(function(e){
                e.preventDefault();

                var successDiv = $('#successDiv');
                var categoryErr = $('#categoryErr');
                var formData = $(this).serialize();

                $.ajax({
                    url: '/create_category',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response){
                        var language = response.language.message;
                        var name = response.name.message;
                        var slug = response.slug.message;
                        if(name != null){
                            categoryErr.text(name);
                        }
                        if(slug != null){
                            successDiv.text(slug);
                        }
                    }
                })
            })
        });
    </script>

<?= $this->endSection('content') ?>