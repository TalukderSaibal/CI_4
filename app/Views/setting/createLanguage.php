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
        <form action="<?= base_url('language/create') ?>" method="post" enctype="multipart/form-data" id="myForm">
            <div class="file_div">
                <div class="form-group frm">
                    <label for="exampleFormControlFile1">Choose Flag</label>
                    <input type="file" name="flag" class="form-control-file">
                    <span>Allowed Type : (png.jpg,jpeg)</span>
                    <span style="color:red !important;"><?= validation_show_error('languageCheck') ?></span>
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

<?= $this->endSection('content') ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
        // var dropdown = $('#myDropdown');
        
        // Fetch data from the server
            // $.ajax({
            //     url: '/populate/code', // URL matches the route defined in step 2
            //     method: 'GET',
            //     dataType: 'json',
            //     success: function(response) {
            //         // Populate the dropdown with the data
            //         $.each(response, function(index, item) {
            //             dropdown.append($('<option></option>').attr('value', item.value).text(item.label));
            //         });
            //     },
            //     error: function() {
            //     console.log('Failed to fetch data');
            //     }
            // });

            $('#myForm').submit(function(event) {
                event.preventDefault();

                var name = $('#name').val();
                var languageCheck = $('#languageCheck').val();
                if(name === ''){
                    console.log(name);
                    $('#nameErr').text('Please enter a name');
                    return;
                }

                $('#myForm').unbind('submit').submit();
            })
        });

        
</script>