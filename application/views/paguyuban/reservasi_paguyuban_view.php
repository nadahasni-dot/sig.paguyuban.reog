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
                        <li class="breadcrumb-item"><a href="<?= base_url('paguyuban'); ?>">Beranda</a></li>
                        <li class="breadcrumb-item active">Reservasi</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <?php if ($paguyuban) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h2 class="card-title">Kalender Reservasi</h2>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>                                    
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <?= validation_errors('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>') ?>
                                <?= $this->session->flashdata('message'); ?>

                                <div id="calendar"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            <?php endif; ?>

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

                            <?php if (!$paguyuban) : ?>
                                <div class="row">
                                    <div class="col">
                                        <div class="alert alert-info">
                                            <h5><i class="icon fas fa-info"></i> Perhatian!</h5>
                                            Anda belum mengisi detail paguyuban anda, harap mengisi detail informasi paguyuban untuk melanjutkan
                                            <div class="row mt-2">
                                                <a href="<?= base_url('paguyuban/paguyuban') ?>" style="text-decoration: none;" class="btn btn-light text-dark p-1">Isi Informasi Data Paguyuban</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else : ?>
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
                                                        <a href="<?= base_url('paguyuban/deletereservasi/') . $row['id_reservasi']; ?>" class="text-small text-danger action-delete">Hapus</a>
                                                    </p>
                                                </td>
                                                <td class="align-middle"><?= $row['username']; ?></td>
                                                <td class="align-middle"><?= $row['nama_jasa']; ?></td>
                                                <td class="align-middle"><?= $row['nama_paguyuban']; ?></td>
                                                <td class="align-middle"><?= $row['status_reservasi'] == 0 ? 'Belum Dikonfirmasi' : 'Sudah Dikonfirmasi'; ?></td>
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
                            <?php endif; ?>
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