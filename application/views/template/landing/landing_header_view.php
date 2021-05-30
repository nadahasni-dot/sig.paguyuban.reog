<!doctype html>
<html class="no-js" lang="zxx">

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title><?= $title ?></title>
  <meta name="description" content="Sistem Informasi Geografis Persebaran Paguyuban Reog di Kabupaten Jember">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- <link rel="manifest" href="site.webmanifest"> -->
  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets/landing/') ?>img/favicon.png">
  <!-- Place favicon.ico in the root directory -->

  <!-- CSS here -->
  <link rel="stylesheet" href="<?= base_url('assets/landing/') ?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/landing/') ?>css/owl.carousel.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/landing/') ?>css/magnific-popup.css">
  <link rel="stylesheet" href="<?= base_url('assets/landing/') ?>css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/landing/') ?>css/themify-icons.css">
  <link rel="stylesheet" href="<?= base_url('assets/landing/') ?>css/nice-select.css">
  <link rel="stylesheet" href="<?= base_url('assets/landing/') ?>css/flaticon.css">
  <link rel="stylesheet" href="<?= base_url('assets/landing/') ?>css/gijgo.css">
  <link rel="stylesheet" href="<?= base_url('assets/landing/') ?>css/animate.css">
  <link rel="stylesheet" href="<?= base_url('assets/landing/') ?>css/slick.css">
  <link rel="stylesheet" href="<?= base_url('assets/landing/') ?>css/slicknav.css">
  <!-- fullCalendar -->
  <!-- <link rel="stylesheet" href="<?= base_url('assets/adminlte/'); ?>plugins/fullcalendar/main.css">
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css"> -->
  <!-- leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />  

  <link rel="stylesheet" href="<?= base_url('assets/landing/') ?>css/style.css">
  <!-- <link rel="stylesheet" href="css/responsive.css"> -->
</head>

<body>

  <!-- header-start -->
  <header>
    <div class="header-area ">
      <div id="sticky-header" class="main-header-area">
        <div class="container-fluid">
          <div class="header_bottom_border">
            <div class="row align-items-center">
              <div class="col-xl-2 col-lg-2">
                <div class="logo">
                  <a href="<?= base_url() ?>">
                    <img src="<?= base_url('assets/landing/') ?>img/logo.png" alt="">
                  </a>
                </div>
              </div>
              <div class="col-xl-6 col-lg-6">
                <div class="main-menu  d-none d-lg-block">
                  <nav>
                    <ul id="navigation">
                      <li><a class="active" href="<?= base_url() ?>">home</a></li>
                      <li><a href="<?= base_url('about') ?>">About</a></li>
                      <li><a class="" href="<?= base_url('daftarpaguyuban') ?>">Paguyuban</a></li>
                      <!-- <li><a href="#">pages <i class="ti-angle-down"></i></a>
                        <ul class="submenu">
                          <li><a href="destination_details.html">Destinations details</a></li>
                          <li><a href="elements.html">elements</a></li>
                        </ul>
                      </li>
                      <li><a href="#">blog <i class="ti-angle-down"></i></a>
                        <ul class="submenu">
                          <li><a href="blog.html">blog</a></li>
                          <li><a href="single-blog.html">single-blog</a></li>
                        </ul>
                      </li> -->
                      <li><a href="<?= base_url('contact') ?>">Contact</a></li>
                      <li><a href="<?= base_url('auth') ?>">login</a></li>
                    </ul>
                  </nav>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 d-none d-lg-block">
                <div class="social_wrap d-flex align-items-center justify-content-end">
                  <!-- <div class="number">
                    <p> <i class="fa fa-phone"></i> 10(256)-928 256</p>
                  </div>
                  <div class="social_links d-none d-xl-block">
                    
                      <ul>
                        <li><a href="">Test</a></li>
                        <li><a href="#"> <i class="fa fa-instagram"></i> </a></li>
                      <li><a href="#"> <i class="fa fa-linkedin"></i> </a></li>
                      <li><a href="#"> <i class="fa fa-facebook"></i> </a></li>
                      <li><a href="#"> <i class="fa fa-google-plus"></i> </a></li>
                      </ul>
                    
                  </div> -->
                </div>
              </div>
              <div class="seach_icon">
                <a data-toggle="modal" data-target="#exampleModalCenter" href="#">
                  <i class="fa fa-search"></i>
                </a>
              </div>
              <div class="col-12">
                <div class="mobile_menu d-block d-lg-none"></div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </header>
  <!-- header-end -->