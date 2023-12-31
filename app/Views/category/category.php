<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

    <div class="form_flex11">
        <div class="language_header">
            <div class="lan_head">
                <h1>Category List</h1>
            </div>

            <div class="icon_category">
                <a href="">
                    Back
                </a>
                <a href="">
                    Settings
                </a>
                <a href="<?= base_url('category_save') ?>">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                </a>
            </div>
        </div>

        <div>
            
            <div class="catgeory_table">
                <div class="search_language">
                    <form action="" method="post" id="categoryForm">
                        <input type="search" name="search" id="search">
                        <input type="submit" value="Search" name="submit">
                    </form>
                </div>

                <?php if (session()->getFlashdata('delete')) : ?>
                    <div class="alert alert-success">
                        <?php echo session()->getFlashdata('delete'); ?>
                    </div>
                <?php endif; ?>


                <table class="table">
                    <caption>List of Category</caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Language</th>
                            <th scope="col">Name</th>
                            <th scope="col">Views</th>
                            <th scope="col">Published Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                    
                    if(count($categories) > 0){
                    
                    foreach($categories as $category){ 
                        foreach($res as $val){ 
                            if($val->id == $category['language_id']){?>
                            <tr>
                                <th scope="row"><?= $category['id'] ?></th>
                                <td><?= $val->language_name ?></td>
                                <td><?= $category['category_name'] ?></td>
                                <td><?= $category['category_slug'] ?></td>
                                <td>@mdo</td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="">View</a>
                                    <a class="btn btn-sm btn-success" href="<?= base_url('category/edit/'. $category['id']) ?>">Edit</a>
                                    <a class="btn btn-sm btn-warning" href="<?= base_url('delete/'. $category['id'])?>">Delete</a>
                                </td>
                            </tr>
                            <?php break; ?>
                            <?php }
                        }
                    }
                    
                    ?>
                    <?php }else {
                        echo "No categories found.";
                    }
                    
                    ?>
                    
                    </tbody>
                </table>
            </div>

            <div class="pagination">
                    <div class="d-flex justify-content-end">
                        <?php if ($pager) :?>
                        <?php $pagi_path='category/create'; ?>
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

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <script>
        $(document).ready(function(){
            $('#categoryForm').submit(function(){
                var formData = $(this).serialize();

                if(formData != null){
                    $.ajax({
                        url: '/category_search',
                        type: 'POST',
                        data: formData,
                        beforeSend: function(){
                            $('#loadingImage').show();
                        },
                        success:function(response){
                            alert(response);
                        }
                    })
                }
            })
        });
    </script>

<?= $this->endSection('content') ?>