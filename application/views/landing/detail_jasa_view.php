<!--================Blog Area =================-->
<section class="blog_area single-post-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post">
                    <?= validation_errors('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>') ?>
                    <?= $this->session->flashdata('message'); ?>
                    <div class="feature-img">
                        <img class="img-fluid" style="width: 100%; max-height: 300px; object-fit: cover;" src="<?= base_url('assets/img/jasa/') . $jasa['foto_jasa'] ?>" alt="">
                    </div>
                    <div class="blog_details">
                        <h2><?= $jasa['nama_jasa']; ?></h2>
                        <ul class="blog-info-link mt-3 mb-4">
                            <li><a href="#"><i class="fa fa-map-marker"></i><?= $jasa['nama_paguyuban']; ?></a></li>
                        </ul>
                        <p class="excert"><?= $jasa['deskripsi_jasa']; ?></p>
                    </div>
                </div>
                <div class="navigation-top">
                    <h3>Harga: Rp. <?= number_format($jasa['harga_jasa']) ?></h3>
                    <?php if ($this->session->userdata('role') == 3) : ?>
                        <button data-toggle="modal" data-target="#reservasiModal" class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn mt-3 mb-3">Pesan</button>
                    <?php else : ?>
                        <a style="color: white !important;" class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn mt-3" href="<?= base_url('login') ?>">Login Untuk Memesan</a>
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

<div class="modal fade" id="reservasiModal">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Reservasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tanggalAdd">Tanggal</label>
                        <input id="tanggalAdd" type="date" class="form-control" name="tanggal_reservasi" placeholder="tanggal reservasi" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsiAdd">Deskripsi</label>
                        <textarea name="deskripsi_reservasi" id="deskripsiAdd" cols="30" rows="5" class="form-control" placeholder="Deskripsi reservasi" required></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="submit-type" class="btn btn-primary" value="Pesan Jasa">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
</div>