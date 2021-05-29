<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Transaksi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Beranda</a></li>
                        <li class="breadcrumb-item active">Transaksi</li>
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
                            <h2 class="card-title">Daftar Transaksi</h2>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <?= validation_errors('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>') ?>
                            <?= $this->session->flashdata('message'); ?>

                            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus mr-2"></i>Tambah Transaksi</button>

                            <table id="allPost" class="table table-bordered table-striped table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>User</th>
                                        <th>Status</th>
                                        <th>Nominal</th>
                                        <th>Jasa</th>
                                        <th>Paguyuban</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($transaksi as $row) :
                                    ?>
                                        <tr>
                                            <td class="align-middle"><?= $no++; ?></td>
                                            <td class="align-middle">
                                                <p class="m-0"><a href="<?= $row['id_transaksi']; ?>" class="h6 action-edit"><?= date('d M Y', strtotime($row['tanggal_transaksi'])) ?></a></p>
                                                <p class="m-0">
                                                    <a href="<?= $row['id_transaksi']; ?>" class="text-small text-danger action-edit">Edit</a> |
                                                    <a href="<?= base_url('admin/deletetransaksi/') . $row['id_transaksi']; ?>" class="text-small text-danger action-delete">Hapus</a>
                                                </p>
                                            </td>
                                            <td class="align-middle"><?= $row['username']; ?></td>
                                            <td class="align-middle"><?= $row['status_transaksi'] == 0 ? 'Belum Dikonfirmasi' : 'Sudah Dikonfirmasi'; ?></td>
                                            <td class="align-middle"><?= number_format($row['nominal_transaksi']); ?></td>
                                            <td class="align-middle"><?= $row['nama_jasa']; ?></td>
                                            <td class="align-middle"><?= $row['nama_paguyuban']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>User</th>
                                        <th>Status</th>
                                        <th>Nominal</th>
                                        <th>Jasa</th>
                                        <th>Paguyuban</th>
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
                        <label for="reservasiAdd">Reservasi</label>
                        <select id="reservasiAdd" name="id_reservasi" class="form-control select2" style="width: 100%;" required>
                            <option selected value="">Pilih Reservasi</option>
                            <?php foreach ($reservasi as $row) : ?>
                                <option value="<?= $row['id_reservasi'] ?>"><?= $row['username'] . ' mereservasi ' . $row['nama_jasa'] . ' [' . $row['nama_paguyuban'] . ']' ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tanggalAdd">Tanggal</label>
                        <input id="tanggalAdd" type="date" class="form-control" name="tanggal_transaksi" placeholder="tanggal transaksi" required>
                    </div>
                    <div class="form-group">
                        <label for="nominalAdd">Nominal</label>
                        <input id="nominalAdd" type="number" class="form-control" name="nominal_transaksi" placeholder="nominal transaksi" required>
                    </div>                    
                    <div class="form-group">
                        <label for="statusAdd">Status</label>
                        <select id="statusAdd" name="status_transaksi" class="form-control select2" style="width: 100%;" required>
                            <option selected value="">Pilih Status Reservasi</option>
                            <option value="0">Belum Dikonfirmasi</option>
                            <option value="1">Sudah Dikonfirmasi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="buktiImage">Bukti Transaksi</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="buktiImage" accept="image/x-png,image/gif,image/jpeg" name="bukti_transaksi" required>
                            <label class="custom-file-label" for="buktiImage">Choose file</label>
                            <img style="object-fit: cover; height: 100px; width: 150px;" width="150px" height="100px" src="" alt="bukti" id="buktiPreview" class="img-fluid mt-2 d-none">
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
                    <h4 class="modal-title">Edit Transaksi</h4>
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