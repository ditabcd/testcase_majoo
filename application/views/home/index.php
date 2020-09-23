<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Majoo Teknologi Indonesia</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="assets/css/heroic-features.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Majoo Teknologi Indonesia</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <!-- <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" a href=<?php echo base_url('Login');?>>Login for Admin</a>
          </li>
        </ul> -->
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
      <h1 class="display-3">Product</h1>
    </header>

    <!-- Page Features -->
    <div class="row text-center">
      <?php foreach ($users_data as $key => $value) : ?>
      <div class="col-lg-3 col-md-6 mb-4">
        <div class="card h-100">
          <img class="card-img-top" src="<?php echo base_url('storage/product/' . $value->gambar) ?>" alt="">
          <div class="card-body">
            <h4 class="card-title"><?php echo $value->nama_produk?></h4>
            <h6 class="card-text"><?php echo "Rp". $value->harga  ?></h6>
            <p class="card-text"><?php echo $value->deskripsi?></p>
          </div>
          <div class="card-footer">
            <a href="#" class="btn btn-primary">Beli</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">2019 &copy; PT Majoo Teknologi Indonesia</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="assets/assets_user/jquery/jquery.min.js"></script>
  <script src="assets/assets_user/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
