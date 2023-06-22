<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

<div class="form_flex11">
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

                <!-- For insert data message -->
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-success">
                        <?php echo session()->getFlashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <!-- For delete data msg -->
                <?php if (session()->getFlashdata('delete_success')) : ?>
                    <div class="alert alert-success">
                        <?php echo session()->getFlashdata('delete_success'); ?>
                    </div>
                <?php endif; ?>

                <!-- For update data msg -->
                <?php if (session()->getFlashdata('update')) : ?>
                    <div class="alert alert-success">
                        <?php echo session()->getFlashdata('update'); ?>
                    </div>
                <?php endif; ?>


                <table class="table">
                    <caption>List of Article</caption>
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
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php


                        
                        foreach($articles as $value){
                            foreach($res as $val){
                                if($val->id == $value['article_language']){ ?>
                                    <tr>
                                        <th scope="row"><?= $value['id'] ?></th>
                                        <td><?= strtoupper($val->language_name) ?></td>
                                        <td>
                                            <div style="display: flex;">
                                                <a href="<?= base_url('article/edit/' . $value['id']) ?>">
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
                                        <td>
                                            <a class="btn btn-sm btn-primary" href="">View</a>
                                            <a class="btn btn-sm btn-warning" href="<?= base_url('article/delete/'. $value['id']) ?>">Delete</a>
                                        </td>
                                    </tr>
                               <?php break; }
                            }
                        }
                        
                        ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <div class="d-flex justify-content-end">
                        <?php if ($pager) :?>
                        <?php $pagi_path='article/create'; ?>
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

