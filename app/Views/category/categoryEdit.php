<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>


    <div class="form_flex11">
        <?php
        
        foreach($data as $value){

        }
        
        ?>
        <form action="<?= base_url('category/update') ?>" method="POST" enctype="multipart/form-data" id="myForm">
            <div class="form-group">
                <label for="exampleInputEmail1">Catgeory Id <span style="color:red;">*</span></label>
                <input type="text" class="form-control" name="categoryId" value="<?= $value->id ?>">
            </div>
            <div class="form_display">
                <div class="category_select">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Language <span style="color:red;">*</span></label>
                        <select class="form-control" name="language">
                            <option><?= $value->language_name ?></option>
                            <?php
                            foreach($languages as $lang){ ?>
                                <option value="<?= $lang['id'] ?>"><?= $lang['language_name'] ?></option>
                            <?php }
                            
                            ?>

                            <span><?= validation_show_error('language') ?></span>
                        </select>
                    </div>
                </div>

                <div class="category_select">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Catgeory Name <span style="color:red;">*</span></label>
                        
                        <select name="" id="" class="form-control">
                        <option value=""><?= $value->category_name ?></option>
                            <?php
                            foreach($category as $cat){ ?>
                                <option value=""><?= $cat->category_name ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Slug <span style="color:red;">*</span></label>
                <input type="text" class="form-control" name="slug" id="slug" value="<?= $value->category_slug ?>">
                <span><?= validation_show_error('slug') ?></span>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>



<?= $this->endSection('content') ?>