<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="form_flex11">
    <?php
    
    foreach($results as $res){
        echo $res['language_name'];
    }
    
    
    ?>
</div>

<?= $this->endSection('content') ?>