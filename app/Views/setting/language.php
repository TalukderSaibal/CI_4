<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="form_flex11">
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
                            <th scope="col">Action</th>
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
                            <td>
                                <a class="btn btn-sm btn-primary" href="">View</a>
                                <a class="btn btn-sm btn-success" href="">Edit</a>
                                <a class="btn btn-sm btn-warning" href="">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <!-- <div class="pagination_left">
                        <a class="btn btn-sm btn-success" href="">Previous</a>
                        <a class="btn btn-sm btn-primary" href="">1</a>
                        <a class="btn btn-sm btn-success" href="">Next</a>
                    </div>-->

                    <div class="d-flex justify-content-end">
                        <?php if ($pager) :?>
                        <?php $pagi_path='language/setting'; ?>
                        <?php $pager->setPath($pagi_path); ?>
                        <?= $pager->links() ?>
                        <?php endif ?>
                    </div>

                    <div class="pagination_right">
                        <p>Showing Page 1 of 1</p> 
                        <p>Rows per page</p>
                        <p>
                        <select name="" id="">
                            <option value="">10</option>
                            <option value="">20</option>
                            <option value="">30</option>
                        </select>
                        </p>
                    </div> 
                </div>
                </div>
            </div>
    </div>


<?= $this->endSection('content') ?>