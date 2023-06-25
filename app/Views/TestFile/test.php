<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="form_flex11">
    <h3>New Form Page</h3>

    <form action="" method="post" enctype="multipart/form-data" id="myForm">
        <input type="text" name="name" id="name"> <br>
        <input type="text" name="slug" id="slug"> <br>
        <input type="file" name="image" id="image"> <br>
        <input type="submit" value="Submit">
    </form>
</div>



<?= $this->endSection('content') ?>