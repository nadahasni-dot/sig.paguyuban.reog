<!--================Blog Area =================-->
<section class="blog_area single-post-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post">
                    <?= validation_errors('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>') ?>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="feature-img">
                        <img class="img-fluid" style="width: 100%; max-height: 300px; object-fit: cover;" src="<?= base_url('assets/img/jasa/') . $reservasi['foto_jasa'] ?>" alt="">
                    </div>
                    <div class="blog_details">
                        <h2>Reservasi Jasa (<?= $reservasi['nama_jasa']; ?>) pada <?= date('d M Y', $reservasi['reservasi_created']); ?></h2>
                        <ul class="blog-info-link mt-3 mb-4">
                            <li><a href="#"><i class="fa fa-map-marker"></i><?= $reservasi['nama_paguyuban']; ?></a></li>
                        </ul>
                        <p class="excert"><?= $reservasi['deskripsi_reservasi']; ?></p>
                    </div>
                </div>
                <div class="navigation-top">
                    <h4 class="<?= $reservasi['status_reservasi'] == 0 ? 'text-danger' : 'text-success'; ?>">Status Reservasi: <?= $reservasi['status_reservasi'] == 0 ? 'Belum Dikonfirmasi' : 'Sudah Dikonfirmasi'; ?></h4>
                    <!-- jika ada transaksi -->
                    <?php if ($transaksi) : ?>
                        <h4 class="<?= $transaksi['status_transaksi'] == 0 ? 'text-danger' : 'text-success'; ?>">Status Transaksi: <?= $transaksi['status_transaksi'] == 0 ? 'Belum Dikonfirmasi' : 'Sudah Dikonfirmasi'; ?></h4>

                        <!-- jika transaksi belum dikonfirmasi -->
                        <?php if ($transaksi['status_transaksi'] == 0) : ?>
                            <a class="button primary-bg w-100 btn_1 boxed-btn text-white" style="color: white !important;" target="_blank" href="https://wa.me/<?= 62 . ltrim($reservasi['telepon_paguyuban'], '0') ?>?text=Saya%20telah%20melakukan%20pembayaran%20transaksi%20%20pada%20<?= $transaksi['tanggal_transaksi'] ?>"><i class="fa fa-phone mr-2"></i>Konfirmasi Pembayaran Pada <?= $reservasi['telepon_paguyuban']; ?></a>
                        <?php else : ?>
                            <a class="button primary-bg w-100 btn_1 boxed-btn text-white" style="color: white !important;" class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn mt-3 mb-3" target="_blank" href="<?= base_url('cetakbukti/') . $transaksi['id_transaksi'] ?>"><i class="fa fa-print mr-2"></i>Cetak Bukti Pembayaran</a>
                        <?php endif; ?>
                        <!-- jika belum ada transaksi -->
                    <?php else : ?>
                        <!-- saat belum ada transaksi dan reservasi belum dikonfirmasi -->
                        <?php if ($reservasi['status_reservasi'] == 0) : ?>
                            <a class="button primary-bg w-100 btn_1 boxed-btn text-white mb-3" style="color: white !important;" target="_blank" href="https://wa.me/<?= 62 . ltrim($reservasi['telepon_paguyuban'], '0') ?>?text=Saya%20telah%20melakukan%20reservasi%20untuk%20%20tanggal%20<?= $reservasi['tanggal_reservasi'] ?>"><i class="fa fa-phone mr-2"></i>Konfirmasi Reservasi Pada <?= $reservasi['telepon_paguyuban']; ?></a>
                            <!-- saat belum ada transaksi dan reservasi sudah dikonfirmasi -->
                        <?php else : ?>
                            <h4 class="text-danger">Status Transaksi: Belum Melakukan Transaksi</h4>
                            <div class="alert alert-info">Lakukan pembayaran pada NO REK. <?= $reservasi['no_rekening'] ?> A.N <?= $reservasi['pemilik_rekening']; ?></div>
                            <button data-toggle="modal" data-target="#transaksiModal" class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn mt-3 mb-3">Pembayaran Transaksi</button>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget">
                        <form action="<?= base_url('daftarpaguyuban') ?>" method="GET">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="query" placeholder='Cari Paguyuban' onfocus="this.placeholder = ''" onblur="this.placeholder = 'Cari Paguyuban'">
                                    <div class="input-group-append">
                                        <button class="btn" type="button"><i class="ti-search"></i></button>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn" type="submit">Search</button>
                        </form>
                    </aside>
                    <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Rekomendasi Lain</h3>
                        <?php if ($recomendation) : ?>
                            <?php foreach ($recomendation as $row) : ?>
                                <div class="media post_item">
                                    <img style="max-height: 100px; max-width: 100px; object-fit: cover;" src="<?= base_url('assets/img/paguyuban/') . $row['foto_paguyuban'] ?>" alt="post">
                                    <div class="media-body">
                                        <a href="<?= base_url('detailpaguyuban/') . $row['id_paguyuban'] ?>">
                                            <h3><?= $row['nama_paguyuban']; ?></h3>
                                        </a>
                                        <p><?= $row['count_jasa']; ?> Jasa</p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="text-center m-3">Tidak Ada Data Paguyuban</p>
                        <?php endif; ?>
                    </aside>
                    <?php if (!$this->session->userdata('id_user')) : ?>
                        <aside class="single_sidebar_widget newsletter_widget">
                            <h4 class="widget_title mb-3">Daftarkan Diri Anda</h4>
                            <p class="mt-0">Daftarkan diri anda untuk melakukan reservasi atau daftarkan Paguyuban Reog Anda untuk membuka reservasi</p>
                            <a style="color: white !important;" class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn mt-3" href="<?= base_url('auth/registration') ?>">Daftar</a>
                        </aside>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================ Blog Area end =================-->

<div class="modal fade" id="transaksiModal">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Transaksi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="nominal_transaksi" value="<?= $reservasi['harga_jasa'] ?>" required>
                    <div class="form-group">
                        <label for="jasa">Jasa</label>
                        <input type="text" name="jasa" id="jasa" cols="30" rows="5" class="form-control" value="<?= $reservasi['nama_jasa'] ?>" readonly required />
                    </div>
                    <div class="form-group">
                        <label for="tanggalReservasi">Tanggal Reservasi</label>
                        <input id="tanggalReservasi" type="date" class="form-control" name="tanggal_reservasi" placeholder="tanggal reservasi" value="<?= $reservasi['tanggal_reservasi'] ?>" readonly required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi Reservasi</label>
                        <textarea type="text" name="deskripsi" id="deskripsi" cols="30" rows="5" class="form-control" readonly required><?= $reservasi['deskripsi_reservasi']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="Nominal">Nominal</label>
                        <input type="text" name="Nominal" id="Nominal" cols="30" rows="5" class="form-control" value="<?= number_format($reservasi['harga_jasa']) ?>" readonly required />
                    </div>
                    <div class="form-group">
                        <label for="tanggalAdd">Tanggal Pembayaran</label>
                        <input id="tanggalAdd" type="date" class="form-control" name="tanggal_transaksi" placeholder="tanggal reservasi" required>
                    </div>
                    <div class="form-group">
                        <label for="buktiTransaksi">Bukti Transaksi</label>
                        <input type="file" class="form-control-file" id="buktiTransaksi" accept="image/x-png,image/gif,image/jpeg" name="bukti_transaksi" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="submit-type" class="btn btn-primary" value="Bayar">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
</div>