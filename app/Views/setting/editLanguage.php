<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="form_flex11">
    <h2>Language Edit</h2>

    <form action="<?= base_url('language/update') ?>" method="post" enctype="multipart/form-data" id="myForm">
                <div class="form-group">
                    <input type="hidden" name="lang_id" value="<?= $id ?>" class="form-control-file">
                </div>
            <div class="file_div">
                <div class="form-group frm">
                    <img src="<?= base_url('uploads/' . $image) ?>" alt="no images" width="50px" height="50px">
                    <label for="exampleFormControlFile1">Choose Flag</label>
                    <input type="file" name="flag" class="form-control-file">
                    <span>Allowed Type : (png.jpg,jpeg)</span>
                    <span style="color:red !important;"><?= validation_show_error('flag') ?></span>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Name * </label>
                <input type="Text" class="form-control" id="name" name="name" value="<?= $name ?>">
                <!-- <span style="color:red;" id="nameErr"></span> -->
                <span style="color:red !important;"><?= validation_show_error('name') ?></span>
            </div>

            <!-- <div class="form-group">
                <label for="exampleFormControlSelect1">Code : *</label>
                <select class="form-control" id="myDropdown" name="code">

                </select>
            </div> -->

            <div class="form-group">
                <label for="exampleFormControlSelect1">Direction * : </label>
                <select class="form-control" name="direction">
                    <option value="LTR">LTR</option>
                    <option value="RTL">RTL</option>
                </select>
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="languageCheck" id="languageCheck" <?php if($language_status){echo 'checked';} ?>>
                <label class="form-check-label">Default Language</label>
                <span style="color:red !important;"><?= validation_show_error('languageCheck') ?></span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // $(document).ready(function(){
    //     $('#myForm').submit(function(event){
    //         event.preventDefault();

    //         var name = $('#name').val();
    //         if(name == ''){
    //             alert('Please enter a name');
    //             return;
    //         }

    //     });
    // });
</script>
<?= $this->endSection('content') ?>
