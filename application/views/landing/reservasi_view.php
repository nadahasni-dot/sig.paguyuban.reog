<!--================Blog Area =================-->
<section class="blog_area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="blog_left_sidebar">
                    <h2 class="mb-4">Reservasi Saya</h2>
                    <?php if (!$reservasi) : ?>
                        <p class="text-center m-5">Tidak Ada Reservasi</p>
                    <?php endif; ?>

                    <?php foreach ($reservasi as $row) : ?>
                        <article class="blog_item">
                            <div class="blog_item_img">
                                <img style="max-height: 200px; object-fit: cover;" class="card-img rounded-0" src="<?= base_url('assets/img/jasa/') . $row['foto_jasa'] ?>" alt="">
                            </div>

                            <div class="blog_details pt-3">
                                <a class="d-inline-block" href="<?= base_url('detailreservasi/') . $row['id_reservasi'] ?>">
                                    <h2>Reservasi Jasa (<?= $row['nama_jasa']; ?>) pada <?= date('d M Y', $row['reservasi_created']); ?></h2>
                                </a>
                                <p><?= strlen($row['deskripsi_reservasi']) > 200 ? substr($row['deskripsi_reservasi'], 0, 200) . " ..." : $row['deskripsi_reservasi']; ?></p>
                                <ul class="blog-info-link">
                                    <?php if ($row['status_reservasi'] == 0) : ?>
                                        <li class="text-danger"><i class="fa fa-times-circle"></i>Reservasi Belum DIkonfirmasi</li>
                                    <?php else : ?>
                                        <li class="text-success"><i class="fa fa-check"></i>Reservasi Telah DIkonfirmasi</li>
                                        <?php
                                        $transaksi = $this->db->get_where('tb_transaksi', ['id_reservasi' => $row['id_reservasi']])->row_array();
                                        if ($transaksi) : ?>
                                            <li class="<?= $transaksi['status_transaksi'] == 0 ? 'text-danger' : 'text-success'; ?>"><i class="fa fa-dollar"></i><?= $transaksi['status_transaksi'] == 0 ? 'Transaksi Belum Dikonfirmasi' : 'Transaksi Telah Dikonfirmasi'; ?></li>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </ul>
                            </div>

                        </article>

                    <?php endforeach; ?>
                    <!-- <nav class="blog-pagination justify-content-center d-flex">
                        <ul class="pagination">
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Previous">
                                    <i class="ti-angle-left"></i>
                                </a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link">1</a>
                            </li>
                            <li class="page-item active">
                                <a href="#" class="page-link">2</a>
                            </li>
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Next">
                                    <i class="ti-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav> -->
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