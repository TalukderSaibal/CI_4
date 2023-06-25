<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="form_flex11">
    <h1>Add language</h1>

        <?php

    use Faker\Core\DateTime;

    if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <div class="language_form">
        <form action="" method="POST" enctype="multipart/form-data" id="myForm1">
            <div class="file_div">
                <div class="form-group frm">
                    <label for="exampleFormControlFile1">Choose Flag</label>
                    <input type="file" name="flag" class="form-control-file">
                    <span>Allowed Type : (png.jpg,jpeg)</span>
                    <span style="color:red !important;"><?= validation_show_error('flag') ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Name * </label>
                <input type="Text" class="form-control" id="name" name="name" value="<?php echo old('name'); ?>">
                <span style="color:red;" id="nameErr"></span>
                <span style="color:red;"><?= validation_show_error('name') ?></span>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Code : *</label>
                <select class="form-control" id="myDropdown" name="code">
                    <option value="0">Choose</option>
                    <?php
                    
                    foreach($res as $value){ ?>
                    <?php
                        $countryName = $value->country_name;
                        $countryCode = $value->country_code;
                        $fullName = $countryName . '('. $countryCode . ')';
                    ?>
                    <option value="<?= $countryCode ?>"><?= $fullName ?></option>
                   <?php }
                    
                    ?>
                    <span><?= $msg ?></span>
                </select>
            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Direction * : </label>
                <select class="form-control" name="direction">
                    <option value="LTR">LTR</option>
                    <option value="RTL">RTL</option>
                </select>
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="languageCheck" id="languageCheck">
                <label class="form-check-label">Default Language</label>
                <span style="color:red !important;"><?= validation_show_error('languageCheck') ?></span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>




<script src="<?= base_url('js/style.js') ?>"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <script>
        $(document).ready(function() {
            $('#myForm1').submit(function(e){
                e.preventDefault();

                $.ajax({
                    url: '/language_create',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response){
                        if(response.status == 'failed'){
                            alert(response.message);
                        }
                    }
                })
            });
        });

</script>


<?= $this->endSection('content') ?>

