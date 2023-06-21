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

                <form action="<?php base_url('category/save') ?>" method="POST" enctype="multipart/form-data" id="myForm">
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
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug <span style="color:red;">*</span></label>
                        <input type="text" class="form-control" name="slug" id="slug">
                        <span><?= validation_show_error('slug') ?></span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

<?= $this->endSection('content') ?>