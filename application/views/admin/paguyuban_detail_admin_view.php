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
                            <h3><?= $count_jasa ?></h3>

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
                            <h3><?= $count_reservasi ?></h3>

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
                            <h3><?= $count_transaksi ?></h3>

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
                                    <!-- <div class="col-12 product-image-thumbs">
                                        <div class="product-image-thumb active"><img src="<?= base_url('assets/img/paguyuban/') . $paguyuban['foto_paguyuban'] ?>" alt="Paguyuban Image"></div>
                                    </div> -->
                                </div>

                                <div class="col-12 col-sm-6">
                                    <h3 class="my-3"><?= $paguyuban['nama_paguyuban'] ?></h3>
                                    <p><?= $paguyuban['deskripsi_paguyuban'] ?></p>

                                    <hr>

                                    <dl>
                                        <dt>Alamat</dt>
                                        <dd><?= $paguyuban['alamat_paguyuban'] ?></dd>
                                        <dt>Telepon</dt>
                                        <dd><?= $paguyuban['telepon_paguyuban'] ?></dd>                                        
                                    </dl>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div id="map" style="height: 300px; width: 100%;"></div>
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