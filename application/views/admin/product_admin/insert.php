<?php $this->load->view('admin/includes/header') ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <?php echo form_open_multipart('') ?>
                    <div class="form-group row">
                        <label for="" class="col-form-label col-md-3">
                            <img src="<?php echo base_url('storage/product/default.png') ?>" width="100px" alt="" class="img-preview">
                        </label>
                        <div class="col-md-9">
                            <input type="file" name="gambar" id="input-file"><br>
                            <?php echo (isset($error_gambar) ? "<span class='text-danger'>" . $error_gambar . "</span>" : "") ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-form-label col-md-3">Nama Produk</label>
                        <div class="col-md-9">
                            <input type="text" name="nama_produk" class="form-control" placeholder="Masukkan Nama Produk" value="<?php echo set_value('nama_produk') ?>">
                            <?php echo form_error('nama_produk') ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-form-label col-md-3">Harga</label>
                        <div class="col-md-9">
                            <input type="text" name="harga" class="form-control" placeholder="Masukkan Harga Produk" value="<?php echo set_value('harga') ?>">
                            <?php echo form_error('harga') ?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="" class="col-form-label col-md-3">Deskripsi</label>
                        <div class="col-md-9">
                            <input type="text" name="deskripsi" class="form-control" placeholder="deskripsi" value="<?php echo set_value('deskripsi') ?>">
                            <?php echo form_error('deskripsi') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="offset-md-3 col-md-9">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/includes/footer') ?>
<script>
    $(document).ready(function() {
        $('#input-file').change(function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.img-preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        })
    });
</script>