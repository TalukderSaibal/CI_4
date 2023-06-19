<?= $this->extend('layout/base') ?>

<?= $this->section('content') ?>

    <div class="form_flex11">
        <h1>Add General</h1>

        <?php if (session('success')) : ?>
            <div class="alert alert-success"><?php echo session('success'); ?></div>
        <?php endif; ?>

        <form action="<?= base_url('general/save') ?>" method="POST">
            <div class="general">
                <h4>General</h4>
                <div class="form_flex">
                    <div class="form_flex1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Site Name: <span style="color:red;">*</span></label>
                            <input type="text" value="<?= isset($data->name) ? $data->name : 0 ?>" name="general[site][name]" class="form-control">
                        </div>
                    </div>
                    <div class="form_flex1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Site URL: <span style="color:red;">*</span></label>
                            <input type="text" value="<?= $data->url ?>" name="general[site][url]" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form_flex">
                    <div class="form_flex1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Contact Email: <span style="color:red;">*</span></label>
                            <input type="text" value="<?= $data->email ?>" name="general[site][email]" class="form-control">
                        </div>
                    </div>
                    <div class="form_flex1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Terms of Service: <span style="color:red;">*</span></label>
                            <input type="text" value="<?= $data->terms ?>" name="general[site][terms]" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form_flex">
                    <div class="form_flex1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Date Format: <span style="color:red;">*</span></label>
                            <input type="text" value="<?= $data->date ?>" name="general[site][date]" class="form-control">
                        </div>
                    </div>
                    <div class="form_flex1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">TimeZone: <span style="color:red;">*</span></label>
                            <input type="text" value="<?= $data->time ?>" name="general[site][time]" class="form-control">
                        </div>
                    </div>
                </div>

            </div>

            <div class="general">
                <h4>Colors</h4>
                <div class="form_flex">
                    <div class="form_flex1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Primary Color: <span style="color:red;">*</span></label>
                            <div class="color_div">
                                <input type="color" class="form-control colorInput" id="colorInput">
                                <input type="text" value="<?= $color->primary ?>" class="form-control hexInput" id="hexInput" name="color[site][primary]">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form_flex1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Secondary Color: <span style="color:red;">*</span></label>
                            <div class="color_div">
                                <input type="color" class="form-control colorInput" id="colorInput">
                                <input type="text" value="<?= $color->secondary ?>" class="form-control hexInput" id="hexInput" name="color[site][secondary]">
                            </div>
                        </div>
                    </div>

                    <div class="form_flex1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Thrid Color: <span style="color:red;">*</span></label>
                            <div class="color_div">
                                <input type="color" class="form-control colorInput" id="colorInput">
                                <input type="text" value="<?= $color->third ?>" class="form-control hexInput" id="hexInput" name="color[site][third]">
                            </div>
                        </div>
                    </div>

                    <div class="form_flex1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Background Color: <span style="color:red;">*</span></label>
                            <div class="color_div">
                                <input type="color" class="form-control colorInput" id="colorInput">
                                <input type="text" value="<?= $color->background ?>" class="form-control hexInput" id="hexInput" name="color[site][background]">
                            </div>
                        </div>
                    </div>

                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script>
      // Get references to the input elements
    const colorInputs = document.getElementsByClassName('colorInput');
    const hexInputs = document.getElementsByClassName('hexInput');

    // Add an event listener to the color input
    Array.from(colorInputs).forEach((colorInput, index) => {
    colorInput.addEventListener('input', function() {
        // Get the selected color value
        const selectedColor = this.value;

        // Update the hex input value
        hexInputs[index].value = selectedColor;
    });
});
</script>


<?= $this->endSection('content') ?>