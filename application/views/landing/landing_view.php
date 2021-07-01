<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>Reog Jember</h3>
                    <p>Cari dan temukan persebaran Paguyuban Reog di Kabupaten Jember</p>
                    <a href="<?= base_url('daftarpaguyuban') ?>" class="boxed-btn3 mt-3">Cari</a>                    
                    <p class="mt-5">SISTEM INFORMASI GEOGRAFIS INI DAPAT MEMBANTU ANDA MENEMUKAN PAGUYUBAN REOG DI WILAYAH KABUPATEN JEMBER DAN MEMUDAHKAN ANDA UNTUK MELAKUKAN PEMESANAN PAGUYUBAN YANG ANDA INGINKAN</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ bradcam_area  -->

<!-- where_togo_area_start  -->
<div class="where_togo_area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-3">
                <div class="form_area">
                    <h3>Mencari Paguyuban Reog di Jember?</h3>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="search_wrap">
                    <form class="search_form" action="<?= base_url('daftarpaguyuban') ?>" method="GET">
                        <div class="input_field mr-1">
                            <input type="text" name="query" placeholder="cari paguyuban disini">
                        </div>
                        <div class="search_btn">
                            <button class="boxed-btn4" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- where_togo_area_end  -->

<!-- popular_destination_area_start  -->
<div class="popular_destination_area">
    <div class="container">
        <?php if ($this->session->userdata('role') == 3) : ?>
            <div class="alert alert-success mb-3">Selamat Datang <?= $user['username']; ?>. Anda sekarang dapat melakukan reservasi jasa pertunjukan reog.</div>
        <?php endif; ?>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section_title text-center mb_70">
                    <h3>Paguyuban Reog Populer</h3>
                    <p>Berikut adalah beberapa rekomendasi Paguyuban Reog Populer di Kabupaten Jember</p>
                </div>
            </div>
        </div>
        <div class="row d-flex">
            <?php
            $no = 1;
            foreach ($paguyuban as $row) :
            ?>
                <div class="col-lg-4 col-md-6">
                    <div class="single_destination">
                        <div class="thumb">
                            <img style="max-height: 250px; width: 100%; object-fit: cover;" src="<?= base_url('assets/img/paguyuban/') . $row['foto_paguyuban'] ?>" alt="<?= $row['nama_paguyuban'] ?>">
                        </div>
                        <div class="content">
                            <a href="<?= base_url('detailpaguyuban/') . $row['id_paguyuban'] ?>">
                                <p><?= $row['nama_paguyuban'] ?></p>
                            </a>
                            <p><a class="m-0" href="<?= base_url('detailpaguyuban/') . $row['id_paguyuban'] ?>"><?= $row['count_jasa'] ?> Jasa</a></p>
                        </div>
                    </div>
                </div>
            <?php
                if ($no > 6) {
                    break;
                }
                $no++;
            endforeach;
            ?>
            <!-- <div class="col-lg-4 col-md-6">
                <div class="single_destination">
                    <div class="thumb">
                        <img src="<?= base_url('assets/landing/') ?>img/destination/2.png" alt="">
                    </div>
                    <div class="content">
                        <p class="d-flex align-items-center">Brazil <a href="travel_destination.html"> 03 Places</a> </p>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_destination">
                    <div class="thumb">
                        <img src="<?= base_url('assets/landing/') ?>img/destination/3.png" alt="">
                    </div>
                    <div class="content">
                        <p class="d-flex align-items-center">America <a href="travel_destination.html"> 10 Places</a> </p>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_destination">
                    <div class="thumb">
                        <img src="<?= base_url('assets/landing/') ?>img/destination/4.png" alt="">
                    </div>
                    <div class="content">
                        <p class="d-flex align-items-center">Nepal <a href="travel_destination.html"> 02 Places</a> </p>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_destination">
                    <div class="thumb">
                        <img src="<?= base_url('assets/landing/') ?>img/destination/5.png" alt="">
                    </div>
                    <div class="content">
                        <p class="d-flex align-items-center">Maldives <a href="travel_destination.html"> 02 Places</a> </p>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="single_destination">
                    <div class="thumb">
                        <img src="<?= base_url('assets/landing/') ?>img/destination/6.png" alt="">
                    </div>
                    <div class="content">
                        <p class="d-flex align-items-center">Indonesia <a href="travel_destination.html"> 05 Places</a> </p>

                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>
<!-- popular_destination_area_end  -->


<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="section_title text-center mb_70">
                <h3>Persebaran Paguyuban Reog</h3>
                <p>Berikut adalah persebaran lokasi paguyuban reog yang terdaftar pada sistem</p>
            </div>
        </div>
        <div id="map" style="width: 100%; height: 400px; overflow: hidden; z-index: 0;"></div>
    </div>
</div>

<?php if (!$this->session->userdata('id_user')) : ?>
    <!-- newletter_area_start  -->
    <div class="newletter_area overlay">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-10">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="newsletter_text text-center">
                                <h4>Daftarkan Diri Anda</h4>
                                <p>Daftarkan diri anda untuk melakukan reservasi atau daftarkan Paguyuban Reog Anda untuk membuka reservasi</p>
                                <a class="boxed-btn4 mt-3" href="<?= base_url('auth/registration') ?>" type="submit">Daftar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- newletter_area_end  -->
<?php endif; ?>