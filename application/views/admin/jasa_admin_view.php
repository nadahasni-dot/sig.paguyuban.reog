<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Jasa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Beranda</a></li>
                        <li class="breadcrumb-item active">Jasa</li>
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
                            <h2 class="card-title">Daftar Jasa</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <?= validation_errors('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>') ?>
                            <?= $this->session->flashdata('message'); ?>

                            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus mr-2"></i>Tambah Jasa</button>

                            <table id="allPost" class="table table-bordered table-striped table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jasa</th>
                                        <th>Paguyuban</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($jasa as $row) :
                                    ?>
                                        <tr>
                                            <td class="align-middle"><?= $no++; ?></td>
                                            <td class="align-middle">
                                                <p class="m-0"><a href="<?= $row['id_jasa']; ?>" class="h6 action-edit"><?= $row['nama_jasa']; ?></a></p>
                                                <p class="m-0">
                                                    <a href="<?= $row['id_jasa']; ?>" class="text-small text-danger action-edit">Edit</a> |
                                                    <a href="<?= base_url('admin/deletejasa/') . $row['id_jasa']; ?>" class="text-small text-danger action-delete">Hapus</a>
                                                </p>
                                            </td>
                                            <td class="align-middle"><?= $row['nama_paguyuban']; ?></td>
                                            <td class="align-middle"><?= number_format($row['harga_jasa']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Jasa</th>
                                        <th>Paguyuban</th>
                                        <th>Harga</th>
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
                    <h4 class="modal-title">Tambah Jasa</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="paguyubanAdd">Paguyuban</label>
                        <select id="paguyubanAdd" class="form-control select2" name="id_paguyuban" required>
                            <option value="">Pilih Paguyuban</option>
                            <?php foreach($paguyuban as $row) : ?>
                            <option value="<?= $row['id_paguyuban'] ?>"><?= $row['nama_paguyuban']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="namaJasaAdd">Nama Jasa</label>
                        <input id="namaJasaAdd" type="text" class="form-control" name="nama_jasa" placeholder="Nama jasa baru" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsiJasaAdd">Deskripsi Jasa</label>
                        <textarea rows="5" cols="30" id="deskripsiJasaAdd" type="text" class="form-control" name="deskripsi_jasa" placeholder="Deskripsi jasa baru" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="hargaJasaAdd">Harga Jasa</label>
                        <input id="hargaJasaAdd" type="number" class="form-control" name="harga_jasa" placeholder="Harga" required>
                    </div>
                    <div class="form-group">
                        <label for="jasaImage">Jasa Foto</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="jasaImage" accept="image/x-png,image/gif,image/jpeg" name="foto_jasa" required>
                            <label class="custom-file-label" for="jasaImage">Choose file</label>
                            <img style="object-fit: cover; height: 100px; width: 150px;" width="150px" height="100px" src="" alt="jasa" id="jasaPreview" class="img-fluid mt-2 d-none">
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
                    <h4 class="modal-title">Edit Jasa</h4>
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