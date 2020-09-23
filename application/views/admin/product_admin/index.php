<?php $this->load->view('admin/includes/header') ?>
  <div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Daftar Produk</h4>
        <a href="<?php echo base_url("Product_admin/insert") ?>" class="btn btn-primary">Tambah</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead class=" text-primary">
              <th>
                No
              </th>
              <th>
                Produk
              </th>
              <th>Harga</th>
              <th>
                Gambar
              </th>
              <th class="text-right">
                Action
              </th>
            </thead>
            <tbody>
              <?php foreach ($users_data as $key => $value) : ?>
                <tr>
                  <td>
                    <?php echo $value->id ?>
                  </td>
                  <td>
                    <?php echo $value->nama_produk ?>
                  </td>
                  <td>
                    <?php echo $value->harga; ?>
                  </td>
                  <td>
                    <?php echo $value->gambar ?>
                  </td>
                  <td class="text-right">
                    <a href="<?php echo base_url("Product_admin/update/".$value->id) ?>" class="btn btn-primary">Edit</a>
                    <a href="<?php echo base_url("Product_admin/delete/".$value->id) ?>" class="btn btn-danger">Hapus</a>
                </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('admin/includes/footer') ?>