<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $paguyuban['nama_paguyuban'] ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Beranda</a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('admin/paguyuban'); ?>">Paguyuban</a></li>
                        <li class="breadcrumb-item active"><?= $paguyuban['nama_paguyuban']; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-12">
                    <!-- small card -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>0</h3>

                            <p>Total Jasa</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-people-arrows"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-12">
                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>0</h3>

                            <p>Total Reservasi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-12">
                    <!-- small card -->
                    <div class="small-box bg-pink">
                        <div class="inner">
                            <h3>0</h3>

                            <p>Total Transaksi</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                </div>
                <!-- ./col -->
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h2 class="card-title">Detail <?= $paguyuban['nama_paguyuban']; ?></h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <h3 class="d-inline-block d-sm-none"><?= $paguyuban['nama_paguyuban'] ?></h3>
                                    <div class="col-12">
                                        <img src="<?= base_url('assets/img/paguyuban/') . $paguyuban['foto_paguyuban'] ?>" class="product-image" alt="Product Image">
                                    </div>
                                    <div class="col-12 product-image-thumbs">
                                        <div class="product-image-thumb active"><img src="<?= base_url('assets/img/paguyuban/') . $paguyuban['foto_paguyuban'] ?>" alt="Paguyuban Image"></div>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-6">
                                    <h3 class="my-3"><?= $paguyuban['nama_paguyuban'] ?></h3>
                                    <p><?= $paguyuban['deskripsi_paguyuban'] ?></p>

                                    <hr>
                                    <h4>Available Colors</h4>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-default text-center active">
                                            <input type="radio" name="color_option" id="color_option_a1" autocomplete="off" checked>
                                            Green
                                            <br>
                                            <i class="fas fa-circle fa-2x text-green"></i>
                                        </label>
                                        <label class="btn btn-default text-center">
                                            <input type="radio" name="color_option" id="color_option_a2" autocomplete="off">
                                            Blue
                                            <br>
                                            <i class="fas fa-circle fa-2x text-blue"></i>
                                        </label>
                                        <label class="btn btn-default text-center">
                                            <input type="radio" name="color_option" id="color_option_a3" autocomplete="off">
                                            Purple
                                            <br>
                                            <i class="fas fa-circle fa-2x text-purple"></i>
                                        </label>
                                        <label class="btn btn-default text-center">
                                            <input type="radio" name="color_option" id="color_option_a4" autocomplete="off">
                                            Red
                                            <br>
                                            <i class="fas fa-circle fa-2x text-red"></i>
                                        </label>
                                        <label class="btn btn-default text-center">
                                            <input type="radio" name="color_option" id="color_option_a5" autocomplete="off">
                                            Orange
                                            <br>
                                            <i class="fas fa-circle fa-2x text-orange"></i>
                                        </label>
                                    </div>

                                    <h4 class="mt-3">Size <small>Please select one</small></h4>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-default text-center">
                                            <input type="radio" name="color_option" id="color_option_b1" autocomplete="off">
                                            <span class="text-xl">S</span>
                                            <br>
                                            Small
                                        </label>
                                        <label class="btn btn-default text-center">
                                            <input type="radio" name="color_option" id="color_option_b2" autocomplete="off">
                                            <span class="text-xl">M</span>
                                            <br>
                                            Medium
                                        </label>
                                        <label class="btn btn-default text-center">
                                            <input type="radio" name="color_option" id="color_option_b3" autocomplete="off">
                                            <span class="text-xl">L</span>
                                            <br>
                                            Large
                                        </label>
                                        <label class="btn btn-default text-center">
                                            <input type="radio" name="color_option" id="color_option_b4" autocomplete="off">
                                            <span class="text-xl">XL</span>
                                            <br>
                                            Xtra-Large
                                        </label>
                                    </div>

                                    <div class="bg-gray py-2 px-3 mt-4">
                                        <h2 class="mb-0">
                                            $80.00
                                        </h2>
                                        <h4 class="mt-0">
                                            <small>Ex Tax: $80.00 </small>
                                        </h4>
                                    </div>

                                    <div class="mt-4">
                                        <div class="btn btn-primary btn-lg btn-flat">
                                            <i class="fas fa-cart-plus fa-lg mr-2"></i>
                                            Add to Cart
                                        </div>

                                        <div class="btn btn-default btn-lg btn-flat">
                                            <i class="fas fa-heart fa-lg mr-2"></i>
                                            Add to Wishlist
                                        </div>
                                    </div>

                                    <div class="mt-4 product-share">
                                        <a href="#" class="text-gray">
                                            <i class="fab fa-facebook-square fa-2x"></i>
                                        </a>
                                        <a href="#" class="text-gray">
                                            <i class="fab fa-twitter-square fa-2x"></i>
                                        </a>
                                        <a href="#" class="text-gray">
                                            <i class="fas fa-envelope-square fa-2x"></i>
                                        </a>
                                        <a href="#" class="text-gray">
                                            <i class="fas fa-rss-square fa-2x"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->