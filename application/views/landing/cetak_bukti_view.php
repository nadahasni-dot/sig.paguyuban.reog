<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bukti Pembayaran Transaksi ID: <?= $transaksi['id_transaksi'] ?> <?= $transaksi['nama_jasa'] ?> <?= $transaksi['username'] ?> <?= $transaksi['tanggal_transaksi'] ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url('assets/adminlte') ?>/dist/css/adminlte.min.css">
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <i class="fas fa-globe"></i> SIG PAGUYUBAN REOG.
                        <small class="float-right">Tanggal Cetak: <?= date('d-m-Y', time()); ?></small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    Dari
                    <address>
                        <strong><?= $reservasi['username']; ?></strong><br>
                        Phone: <?= $reservasi['telepon_user']; ?><br>
                        Email: <?= $reservasi['email']; ?>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    Kepada
                    <address>
                        <strong><?= $reservasi['no_rekening']; ?> <?= $reservasi['pemilik_rekening'] ?></strong><br>
                        <?= $reservasi['alamat_paguyuban']; ?><br>
                        Phone: <?= $reservasi['telepon_paguyuban']; ?><br>
                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Transaksi ID: <?= $transaksi['id_transaksi']; ?></b><br>
                    <br>
                    <b>Reservasi ID:</b> <?= $transaksi['id_reservasi']; ?><br>
                    <b>Tanggal Bayar:</b> <?= $transaksi['tanggal_transaksi']; ?><br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Qty</th>
                                <th>Paguyuban</th>
                                <th>Jasa</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Reservasi</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><?= $reservasi['nama_paguyuban']; ?></td>
                                <td><?= $reservasi['nama_jasa']; ?></td>
                                <td><?= $reservasi['deskripsi_reservasi']; ?></td>
                                <td><?= $reservasi['tanggal_reservasi']; ?></td>
                                <td>Rp. <?= number_format($transaksi['nominal_transaksi']); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <p class="lead">Payment Methods:</p>

                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        Pembayaran transfer melalui rekening bank: <?= $reservasi['no_rekening'] . ' ' . $reservasi['pemilik_rekening']; ?>
                    </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                    <p class="lead">Tanggal Transaksi <?= $transaksi['tanggal_transaksi']; ?></p>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>Rp. <?= number_format($transaksi['nominal_transaksi']); ?></td>
                            </tr>
                            <tr>
                                <th>Tax</th>
                                <td>Rp. 0</td>
                            </tr>
                            <tr>
                                <th>Shipping:</th>
                                <td>Rp. 0</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>Rp. <?= number_format($transaksi['nominal_transaksi']); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
    <!-- Page specific script -->
    <script>
        window.addEventListener("load", window.print());
    </script>
</body>

</html>