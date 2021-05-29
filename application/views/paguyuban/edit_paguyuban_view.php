<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Paguyuban</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('paguyuban'); ?>">Beranda</a></li>
                        <li class="breadcrumb-item">Paguyuban</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h2 class="card-title">Form Informasi Data Paguyuban</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?= validation_errors('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>') ?>
                            <?= $this->session->flashdata('message'); ?>
                            <form action="" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="namaPaguyubanAdd">Nama Paguyuban</label>
                                    <input id="namaPaguyubanAdd" value="<?= $paguyuban['nama_paguyuban'] ?>" type="text" class="form-control" name="nama_paguyuban" placeholder="nama paguyuban" required>
                                </div>
                                <div class="form-group">
                                    <label for="deskripsiAdd">Deskripsi</label>
                                    <textarea name="deskripsi_paguyuban" id="deskripsiAdd" cols="30" rows="5" class="form-control" placeholder="masukkan deskripsi" required><?= $paguyuban['deskripsi_paguyuban'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="alamatAdd">Alamat</label>
                                    <textarea name="alamat_paguyuban" id="alamatAdd" cols="30" rows="5" class="form-control" placeholder="alamat" required><?= $paguyuban['alamat_paguyuban'] ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="teleponPaguyubanAdd">Telepon</label>
                                    <input id="teleponPaguyubanAdd" type="tel" class="form-control" name="telepon_paguyuban" minlength="10" maxlength="16" placeholder="telepon paguyuban" value="<?= $paguyuban['telepon_paguyuban'] ?>" required>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="latitudeAdd">latitude</label>
                                            <input id="latitudeAdd" type="text" value="<?= $paguyuban['lat_paguyuban'] ?>" class="form-control" name="lat_paguyuban" placeholder="latitude" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="longitudeAdd">longitude</label>
                                            <input id="longitudeAdd" type="text" value="<?= $paguyuban['lng_paguyuban'] ?>" class="form-control" name="lng_paguyuban" placeholder="longitude" required>
                                        </div>
                                    </div>
                                </div>
                                <small class="text-info">Klik Pada Area Peta Untuk Menentukan Lokasi</small>
                                <div class="row">
                                    <div class="col">
                                        <div id="map" style="width: 100%; height: 480px;"></div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="paguyubanImage">Paguyuban Image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="paguyubanImage" accept="image/x-png,image/gif,image/jpeg" name="foto_paguyuban">
                                        <label class="custom-file-label" for="paguyubanImage">Choose file</label>
                                        <div class="row">
                                            <img style="object-fit: cover; height: 100px; width: 150px;" width="150px" height="100px" src="" alt="paguyuban" id="paguyubanPreview" class="img-fluid mt-2 d-none">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="submit" name="submit-type" class="btn btn-primary" value="Simpan">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
</div>
<!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->