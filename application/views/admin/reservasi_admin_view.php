<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reservasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Beranda</a></li>
                        <li class="breadcrumb-item active">Reservasi</li>
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
                            <h2 class="card-title">Daftar Reservasi</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <?= validation_errors('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>') ?>
                            <?= $this->session->flashdata('message'); ?>

                            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus mr-2"></i>Tambah Reservasi</button>

                            <table id="allPost" class="table table-bordered table-striped table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tangal Reservasi</th>
                                        <th>Pemesan</th>
                                        <th>Jasa</th>
                                        <th>Paguyuban</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($reservasi as $row) :
                                    ?>
                                        <tr>
                                            <td class="align-middle"><?= $no++; ?></td>
                                            <td class="align-middle">
                                                <p class="m-0"><a href="<?= $row['id_reservasi']; ?>" class="h6 action-edit"><?= date('d M Y', strtotime($row['tanggal_reservasi'])); ?></a></p>
                                                <p class="m-0">
                                                    <a href="<?= $row['id_reservasi']; ?>" class="text-small text-danger action-edit">Edit</a> |
                                                    <a href="<?= base_url('admin/deletereservasi/') . $row['id_reservasi']; ?>" class="text-small text-danger action-delete">Hapus</a>
                                                </p>
                                            </td>
                                            <td class="align-middle"><?= $row['username']; ?></td>
                                            <td class="align-middle"><?= $row['nama_jasa']; ?></td>
                                            <td class="align-middle"><?= $row['nama_paguyuban']; ?></td>
                                            <td class="align-middle"><?= $row['status_reservasi'] == 0 ? 'Belum Ddikonfirmasi' : 'Sudah Dikonfirmasi'; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Tangal Reservasi</th>
                                        <th>Pemesan</th>
                                        <th>Jasa</th>
                                        <th>Paguyuban</th>
                                        <th>Status</th>
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
                    <h4 class="modal-title">Tambah Reservasi</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pemesanAdd">Pemesan</label>
                        <select id="pemesanAdd" name="id_user" class="form-control select2" style="width: 100%;" required>
                            <option selected value="">Pilih Pemesan</option>
                            <?php foreach ($umum as $row) : ?>
                                <option value="<?= $row['id_user'] ?>"><?= $row['username'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="namaJasaAdd">Jasa</label>
                        <select id="namaJasaAdd" name="jasa_paguyuban" class="form-control select2" style="width: 100%;" required>
                            <option selected value="">Pilih Jasa</option>
                            <?php foreach ($jasa as $row) : ?>
                                <option value="<?= $row['id_jasa'] . '.' . $row['id_paguyuban'] ?>"><?= $row['nama_jasa'] . ' [' . $row['nama_paguyuban'] . ']' ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggalAdd">Tanggal</label>
                        <input id="tanggalAdd" type="date" class="form-control" name="tanggal_reservasi" placeholder="tanggal reservasi" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsiAdd">Deskripsi</label>
                        <textarea name="deskripsi_reservasi" id="deskripsiAdd" cols="30" rows="5" class="form-control" placeholder="Deskripsi reservasi" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="statusAdd">Status</label>
                        <select id="statusAdd" name="status_reservasi" class="form-control select2" style="width: 100%;" required>
                            <option selected value="">Pilih Status Reservasi</option>
                            <option value="0">Belum Dikonfirmasi</option>
                            <option value="1">Sudah Dikonfirmasi</option>
                        </select>
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
                    <h4 class="modal-title">Edit Reservasi</h4>
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