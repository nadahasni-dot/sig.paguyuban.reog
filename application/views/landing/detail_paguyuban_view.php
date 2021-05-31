<!--================Blog Area =================-->
<section class="blog_area single-post-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 posts-list">
                <div class="single-post">
                    <div class="feature-img">
                        <img class="img-fluid" style="width: 100%; max-height: 300px; object-fit: cover;" src="<?= base_url('assets/img/paguyuban/') . $paguyuban['foto_paguyuban'] ?>" alt="">
                    </div>
                    <div class="blog_details">
                        <h2><?= $paguyuban['nama_paguyuban']; ?></h2>
                        <ul class="blog-info-link mt-3 mb-4">
                            <li><a href="#"><i class="fa fa-map-marker"></i><?= $paguyuban['alamat_paguyuban']; ?></a></li>
                        </ul>
                        <p class="excert"><?= $paguyuban['deskripsi_paguyuban']; ?></p>
                        <div id="map" style="width: 100%; height: 300px" class="mt-3 mb-3"></div>
                    </div>
                </div>
                <div class="navigation-top">
                    <h3>Jasa Yang Ditawarkan</h3>
                    <?php if (!$jasa) : ?>
                        <p class="text-center m-5">Tidak Ada Jasa Tersedia</p>
                    <?php endif; ?>
                </div>
                <div class="popular_places_area bg-white m-0 p-0">
                    <div class="row">
                        <?php if ($jasa) : ?>
                            <?php foreach ($jasa as $row) : ?>
                                <div class="col-lg-6 col-md-6 d-flex align-items-stretch">
                                    <div class="single_place" style="box-shadow: 0px 0px 10px 0px #ccc !important;">
                                        <div class="thumb">
                                            <img style="max-height: 200px; object-fit: cover;" src="<?= base_url('assets/img/jasa/') . $row['foto_jasa'] ?>" alt="">
                                        </div>
                                        <div class="place_info">
                                            <a href="<?= base_url('detailjasa/') . $row['id_jasa'] ?>">
                                                <h3><?= $row['nama_jasa'] ?></h3>
                                            </a>                                            
                                            <p>Rp. <?= number_format($row['harga_jasa']) ?></p>
                                            <a style="color: white !important;" class="button primary-bg w-100 btn_1 boxed-btn text-white" href="<?= base_url('detailjasa/') . $row['id_jasa'] ?>">Lihat Detail</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
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