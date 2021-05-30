<!-- bradcam_area  -->
<div class="bradcam_area bradcam_bg_2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="bradcam_text text-center">
                    <h3>Paguyuban Reog Jember</h3>
                    <p>Temukan Paguyuban Reog di Jember</p>
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


<div class="popular_places_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <?php foreach ($paguyuban as $row) : ?>
                        <div class="col-lg-6 col-md-6">
                            <div class="single_place">
                                <div class="thumb">
                                    <img style="max-height: 200px; object-fit: cover;" src="<?= base_url('assets/img/paguyuban/') . $row['foto_paguyuban'] ?>" alt="">
                                </div>
                                <div class="place_info">
                                    <a href="<?= base_url('detailpaguyuban/') . $row['id_paguyuban'] ?>">
                                        <h3><?= $row['nama_paguyuban'] ?></h3>
                                    </a>
                                    <p><?= $row['alamat_paguyuban'] ?></p>
                                    <div class="rating_days d-flex justify-content-between">
                                        <span class="d-flex justify-content-center align-items-center">                                            
                                            <a href="#">(<?= $row['count_jasa'] ?> Jasa)</a>
                                        </span>                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- <div class="row">
                    <div class="col-lg-12">
                        <div class="more_place_btn text-center">
                            <a class="boxed-btn4" href="#">More Places</a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="section_title text-center mb_70">
                <h3>Persebaran Paguyuban Reog</h3>
                <p>Berikut adalah persebaran lokasi paguyuban reog yang terdaftar pada sistem</p>
            </div>
        </div>
        <div id="map" style="width: 100%; height: 400px;"></div>
    </div>
</div>

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
                            <a class="boxed-btn4 mt-3" href="<?= base_url('auth/register') ?>" type="submit">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- newletter_area_end  -->