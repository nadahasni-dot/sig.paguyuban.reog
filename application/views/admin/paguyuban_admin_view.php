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
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Beranda</a></li>
                        <li class="breadcrumb-item active">Paguyuban</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h2 class="card-title">Daftar Paguyuban</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <?= validation_errors('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>') ?>
                            <?= $this->session->flashdata('message'); ?>

                            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus mr-2"></i>Tambah Paguyuban</button>

                            <table id="allPost" class="table table-bordered table-striped table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Paguyuban</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($paguyuban as $row) :
                                    ?>
                                        <tr>
                                            <td class="align-middle"><?= $no++ ?></td>
                                            <td class="align-middle">
                                                <p class="m-0"><a href="<?= base_url('admin/detailpaguyuban/') . $row['id_paguyuban']; ?>" class="h6"><?= $row['nama_paguyuban']; ?></a></p>
                                                <p class="m-0">
                                                    <a href="<?= $row['id_paguyuban']; ?>" class="text-small text-danger action-edit">Edit</a> |
                                                    <a href="<?= base_url('admin/detailpaguyuban/') . $row['id_paguyuban']; ?>" class="text-small text-danger">Detail</a> |
                                                    <a href="<?= base_url('admin/deletepaguyuban/') . $row['id_paguyuban']; ?>" class="text-small text-danger action-delete">Hapus</a>
                                                </p>
                                            </td>
                                            <td class="align-middle"><?= $row['alamat_paguyuban'] ?></td>
                                            <td class="align-middle"><?= $row['telepon_paguyuban'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Paguyuban</th>
                                        <th>Alamat</th>
                                        <th>Telepon</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-tambah">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Paguyuban</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pemilikAdd">Pemilik Paguyuban</label>
                        <select id="pemilikAdd" name="id_user" class="form-control select2" style="width: 100%;" required>
                            <option selected value="">Pilih Pemilik Paguyuban</option>
                            <?php foreach ($owner as $row) : ?>
                                <option value="<?= $row['id_user'] ?>"><?= $row['username']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="namaPaguyubanAdd">Nama Paguyuban</label>
                        <input id="namaPaguyubanAdd" type="text" class="form-control" name="nama_paguyuban" placeholder="nama paguyuban" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsiAdd">Deskripsi</label>
                        <textarea name="deskripsi_paguyuban" id="deskripsiAdd" cols="30" rows="5" class="form-control" placeholder="masukkan deskripsi" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="alamatAdd">Alamat</label>
                        <textarea name="alamat_paguyuban" id="alamatAdd" cols="30" rows="5" class="form-control" placeholder="alamat" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="teleponPaguyubanAdd">Telepon</label>
                        <input id="teleponPaguyubanAdd" type="tel" class="form-control" name="telepon_paguyuban" minlength="10" maxlength="16" placeholder="telepon paguyuban" required>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="latitudeAdd">latitude</label>
                                <input id="latitudeAdd" type="text" class="form-control" name="lat_paguyuban" placeholder="latitude" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="longitudeAdd">longitude</label>
                                <input id="longitudeAdd" type="text" class="form-control" name="lng_paguyuban" placeholder="longitude" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="paguyubanImage">Paguyuban Image</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="paguyubanImage" accept="image/x-png,image/gif,image/jpeg" name="foto_paguyuban" required>
                            <label class="custom-file-label" for="paguyubanImage">Choose file</label>
                            <img style="object-fit: cover; height: 100px; width: 150px;" width="150px" height="100px" src="" alt="paguyuban" id="paguyubanPreview" class="img-fluid mt-2 d-none">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="submit-type" class="btn btn-primary" value="Tambah">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
</div>

<div class="modal fade" id="edit-modal">
    <form action="" method="post" autocomplete="off" enctype="multipart/form-data">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Paguyuban</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="editBody"></div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="submit-type" class="btn btn-primary" value="Save">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </form>
</div>