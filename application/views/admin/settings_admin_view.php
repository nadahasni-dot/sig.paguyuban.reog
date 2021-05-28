  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
          <div class="container-fluid">
              <div class="row mb-2">
                  <div class="col-sm-6">
                      <h1 class="m-0 text-dark">Settings</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                          <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Dashboard</a></li>
                          <li class="breadcrumb-item">Settings</li>
                      </ol>
                  </div><!-- /.col -->
              </div><!-- /.row -->
          </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
          <div class="container-fluid">
              <div class="row">
                  <div class="col-md-4">
                      <!-- Widget: user widget style 1 -->
                      <div class="card card-widget widget-user">
                          <!-- Add the bg color to the header using any of the bg-* classes -->
                          <div class="widget-user-header text-white bg-primary">
                              <h3 class="widget-user-username text-right"><?= $user['username']; ?></h3>
                              <?php
                                $role = null;
                                if ($user['role'] == 1) {
                                    $role = 'ADMIN';
                                }

                                if ($user['role'] == 2) {
                                    $role = 'PEMILIK PAGUYUBAN';
                                }

                                if ($user['role'] == 3) {
                                    $role = 'UMUM';
                                }
                                ?>
                              <h5 class="widget-user-desc text-right"><?= $role ?></h5>
                          </div>
                          <div class="widget-user-image">
                              <img class="img-circle" style="object-fit: cover; width: 120px; height: 120px;" src="<?= base_url('assets/img/') . $user['foto_user']; ?>" alt="User Avatar">
                          </div>
                          <div class="card-footer">
                              <div class="row">
                                  <div class="col-sm-6 border-right">
                                      <div class="description-block">
                                          <h5 class="description-header">EMAIL</h5>
                                          <span class="description-text"><?= $user['email'] == null ? '-' : $user['email']; ?></span>
                                      </div>
                                      <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                                  <div class="col-sm-6 border-right">
                                      <div class="description-block">
                                          <h5 class="description-header">PRODI</h5>
                                          <span class="description-text"><?= $user['telepon_user'] == null ? '-' : $user['telepon_user']; ?></span>
                                      </div>
                                      <!-- /.description-block -->
                                  </div>
                                  <!-- /.col -->
                              </div>
                              <!-- /.row -->
                          </div>
                      </div>
                      <!-- /.widget-user -->
                  </div>
                  <!-- /.col-md-4 -->
                  <div class="col-md-8">
                      <div class="card card-primary card-outline card-outline-tabs">
                          <div class="card-header p-0 border-bottom-0">
                              <ul class="nav nav-tabs" id="tab-modal" role="tablist">
                                  <li class="nav-item">
                                      <a class="nav-link active" id="tab-edit-info-website" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Profile</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" id="tab-edit-contact" data-toggle="pill" href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile" aria-selected="false">Password</a>
                                  </li>
                              </ul>
                          </div>
                          <div class="card-body">
                              <div class="tab-content" id="tab-modal">
                                  <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="tab-edit-info-website">
                                      <div class="row">
                                          <div class="col">
                                              <?= validation_errors('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>') ?>
                                              <?= $this->session->flashdata('message'); ?>
                                          </div>
                                      </div>
                                      <dl class="row">
                                          <dt class="col-sm-4">Last Update</dt>
                                          <dd class="col-sm-8"><?= $user['user_updated'] == null ? '-' : date('d M Y H:i:s', $user['user_updated']); ?></dd>
                                          <dt class="col-sm-4">Nama</dt>
                                          <dd class="col-sm-8"><?= $user['username'] == null ? '-' : $user['username']; ?></dd>
                                          <dt class="col-sm-4">Email</dt>
                                          <dd class="col-sm-8"><?= $user['email'] == null ? '-' : $user['email']; ?></dd>
                                          <dt class="col-sm-4">Telepon</dt>
                                          <dd class="col-sm-8"><?= $user['telepon_user'] == null ? '-' : $user['telepon_user']; ?></dd>
                                      </dl>
                                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-pencil mr-1" aria-hidden="true"></i>Edit Profile</button>
                                  </div>
                                  <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel" aria-labelledby="tab-edit-contact">
                                      <form role="form" action="" method="POST">
                                          <div class="form-group">
                                              <label for="passlama">Password Lama</label>
                                              <input type="password" class="form-control" id="passlama" placeholder="Password Lama" name="password_lama" required maxlength="50" minlength="6">
                                          </div>
                                          <div class="form-group">
                                              <label for="passbaru">Password Baru</label>
                                              <input type="password" class="form-control" id="passbaru" placeholder="Password Baru" name="password_baru" required maxlength="50" minlength="6">
                                          </div>
                                          <div class="form-group">
                                              <label for="verpass">Verifikasi Password</label>
                                              <input type="password" class="form-control" id="verpass" placeholder="Verifikasi Password Baru" name="password_baru_ver" required maxlength="50" minlength="6">
                                          </div>
                                          <div class="form-group">
                                              <button type="submit" name="update_action" value="password" class="btn btn-block btn-primary">Rubah Password</button>
                                          </div>
                                      </form>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!-- /.col-md-8 -->
              </div><!-- /.container-fluid -->
          </div>
          <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
  </div>

  <div class="modal fade" id="modal-edit">
      <div class="modal-dialog">
          <div class="modal-content">
              <form action="" method="POST" enctype="multipart/form-data">
                  <div class="modal-header">
                      <h4 class="modal-title">Edit Profile</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <label for="username">Nama</label>
                          <input type="text" class="form-control" id="username" placeholder="Nama" name="username" required maxlength="50" value="<?= $user['username']; ?>">
                      </div>
                      <div class="form-group">
                          <label for="email">Email</label>
                          <input type="email" class="form-control" id="email" placeholder="NIM" name="email" required maxlength="50" value="<?= $user['email']; ?>">
                      </div>                      
                      <div class="form-group">
                          <label for="telepon">Telepon</label>
                          <input type="tel" class="form-control" id="telepon" placeholder="Angkatan" name="telepon_user" maxlength="16" value="<?= $user['telepon_user']; ?>" required>
                      </div>                                            
                      <div class="form-group">
                          <label for="exampleInputFile">Foto</label>
                          <small class="text-danger">Kosongi jika tidak ingin merubah foto</small>
                          <div class="input-group">
                              <div class="custom-file">
                                  <input type="file" name="foto_user" accept="image/*" class="custom-file-input" id="foto_user">
                                  <label class="custom-file-label" for="foto_user">Choose file</label>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" name="update_action" value="profile" class="btn btn-primary">Update</button>
                  </div>
              </form>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->