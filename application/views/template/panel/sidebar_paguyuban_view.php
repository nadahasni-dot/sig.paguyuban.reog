  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#l" class="brand-link text-center">
      <!-- <img src="<?= base_url('assets/paguyubanlte/'); ?>dist/img/paguyubanLTELogo.png" alt="STEP-A Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-bold">SIG PAGUYUBAN REOG</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url('assets/img/') . $user['foto_user'] ?>" class="img-circle elevation-2" alt="User Image" style="height: 33px; width: 33px; object-fit: cover">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $user['username']; ?></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="<?= base_url('paguyuban'); ?>" class="nav-link <?= $menu == 'beranda_paguyuban' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Beranda
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('paguyuban/paguyuban'); ?>" class="nav-link <?= $menu == 'paguyuban_paguyuban' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-house-user"></i>
              <p>
                Paguyuban
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('paguyuban/jasa'); ?>" class="nav-link <?= $menu == 'jasa_paguyuban' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-people-arrows"></i>
              <p>
                Jasa
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('paguyuban/reservasi'); ?>" class="nav-link <?= $menu == 'reservasi' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Reservasi
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('paguyuban/transaksi'); ?>" class="nav-link <?= $menu == 'transaksi' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-wallet"></i>
              <p>
                Transaksi
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('paguyuban/settings'); ?>" class="nav-link <?= $menu == 'settings' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?= base_url('logout'); ?>" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Log out
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>