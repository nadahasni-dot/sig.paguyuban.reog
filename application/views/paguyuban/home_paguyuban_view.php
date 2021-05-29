<div class="content-wrapper">
    <div class="content">
        <div class="container-fluid pt-3">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small card -->
                            <div class="small-box bg-primary">
                                <div class="inner">
                                    <h3><?= $count_jasa ?></h3>

                                    <p>Total Jasa</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-people-arrows"></i>
                                </div>
                                <a href="<?= base_url('paguyuban/jasa'); ?>" class="small-box-footer">
                                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small card -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3><?= $count_reservasi ?></h3>

                                    <p>Total Reservasi</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <a href="<?= base_url('paguyuban/reservasi'); ?>" class="small-box-footer">
                                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small card -->
                            <div class="small-box bg-pink">
                                <div class="inner">
                                    <h3><?= $count_transaksi ?></h3>

                                    <p>Total Transaksi</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-wallet"></i>
                                </div>
                                <a href="<?= base_url('paguyuban/transaksi'); ?>" class="small-box-footer">
                                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small card -->
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3><?= $count_sum_transaksi['sum_transaksi'] == null ? '0' : number_format($count_sum_transaksi['sum_transaksi']) ?></h3>

                                    <p>Total Nilai Transaksi</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-money-bill-wave"></i>
                                </div>
                                <a href="<?= base_url('paguyuban/transaksi'); ?>" class="small-box-footer">
                                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>

                    <?php if (!$paguyuban) : ?>
                        <div class="row">
                            <div class="col">
                                <div class="alert alert-info">
                                    <h5><i class="icon fas fa-info"></i> Perhatian!</h5>
                                    Anda belum mengisi detail paguyuban anda, harap mengisi detail informasi paguyuban untuk melanjutkan
                                    <div class="row mt-2">
                                        <a href="<?= base_url('paguyuban/paguyuban') ?>" style="text-decoration: none;" class="btn btn-light text-dark p-1">Isi Informasi Data Paguyuban</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <i class="fas fa-map"></i>
                                        Peta Persebaran Paguyuban
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div id="map" style="width: 100%; height: 480px"></div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>