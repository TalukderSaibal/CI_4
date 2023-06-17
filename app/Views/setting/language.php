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
                    <h1>Language</h1>
                </div>

                <div class="icon_category">
                    <a href="">
                        Back
                    </a>
                    <a href="">
                        Settings
                    </a>
                    <a href="<?= base_url('language/create') ?>">
                        <i class="fa fa-plus" aria-hidden="true"></i>
                    </a>
                </div>

            </div>

            <?php

                                use Faker\Core\DateTime;

 if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>

            <div class="language_div">
                <div class="search_language">
                    <form action="" method="post">
                        <input type="search" name="search">
                        <input type="submit" value="Search" name="submit">
                    </form>
                </div>
                <div class="language_list">
                <table class="table">
                    <caption>List of language</caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Code</th>
                            <th scope="col">Direction</th>
                            <th scope="col">Translate Status</th>
                            <th scope="col">Added Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sl = 0; ?>
                    <?php foreach ($languages as $language): $sl++; ?>
                    <?php
                    
                        $dateTime = new \DateTime($language['added_time']);
                        $formattedTime = $dateTime->format('M d, Y h:i A');
                    
                    ?>
                        <tr>
                            <th scope="row"><?= $sl ?></th>
                            <td><?= $language['language_name'] ?></td>
                            <td><?= $language['code'] ?></td>
                            <td><?= $language['direction'] ?></td>
                            <td>Missing</td>
                            <td><?= $formattedTime ?></td>
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