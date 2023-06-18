<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?= base_url('icon/favicon.ico') ?>" />
    <title>Document</title>

    <!-- Font Awesome CDN Link Here -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" >

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="language_header">
                <div class="lan_head">
                    <h1>English Blog Articles</h1>
                </div>

                <div class="icon_category">
                    <a href="">
                        Back
                    </a>
                    <a href="">
                        Settings
                    </a>
                    <a href="<?= base_url('article/save') ?>">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                </div>

            </div>

            <div class="language_div">
                <div class="language_list">
                    <?php
                    
                        if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; 
                    
                    ?>


                <table class="table">
                    <caption>List of language</caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Language</th>
                            <th scope="col">Article</th>
                            <th scope="col">Author</th>
                            <th scope="col">Category</th>
                            <th scope="col">Comments</th>
                            <th scope="col">Views</th>
                            <th scope="col">Published Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        foreach($articles as $value): ?>
                        
                        <?php ?>
                        <tr>
                            <th scope="row">1</th>
                            <td><?= strtoupper($value['article_language']) ?></td>
                            <td>
                                <div style="display: flex;">
                                <a href="">
                                <img style="width:40px; height:40px;" src="<?= base_url('articleImage/' . $value['article_image']) ?>" alt="no images">
                                </a>
                                <div>
                                <p style="margin-bottom: 0;"><?= $value['article_title'] ?></p>
                                <p><?= $value['article_description'] ?></p>
                                </div>
                                </div>
                            </td>
                            <td>Admin Amdin</td>
                            <td>Missing</td>
                            <td>20</td>
                            <td>0</td>
                            <td>Oct 15, 2022 03:14 PM</td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>