<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

    <div class="form_flex11">
        <h2>Category Create</h2>
        <div class="language_div">
            <div class="language_list">
                <form action="<?php base_url('category/save') ?>" method="POST" enctype="multipart/form-data" id="myForm">
                    <div class="form_display">
                        <div class="category_select">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Language <span style="color:red;">*</span></label>
                                <select class="form-control" name="language">
                                    <option>Choose</option>
                                    <option>English</option>
                                    <option>Bangla</option>
                                    <option>Hindi</option>
                                    <option>Arabic</option>
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