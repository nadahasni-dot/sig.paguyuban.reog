<input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi']; ?>">

<div class="form-group">
    <label for="reservasi">Reservasi</label>
    <select id="reservasi" name="id_reservasi" class="form-control select2" style="width: 100%;" required>
        <option value="">Pilih Reservasi</option>
        <?php foreach ($reservasi as $row) : ?>
            <option <?= $row['id_reservasi'] == $transaksi['id_reservasi'] ? 'selected' : '' ?> value="<?= $row['id_reservasi'] ?>"><?= $row['username'] . ' mereservasi ' . $row['nama_jasa'] . ' [' . $row['nama_paguyuban'] . ']' ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-group">
    <label for="tanggal">Tanggal</label>
    <input id="tanggal" value="<?= $transaksi['tanggal_transaksi'] ?>" type="date" class="form-control" name="tanggal_transaksi" placeholder="tanggal transaksi" required>
</div>
<div class="form-group">
    <label for="nominal">Nominal</label>
    <input id="nominal" value="<?= $transaksi['nominal_transaksi'] ?>" type="number" class="form-control" name="nominal_transaksi" placeholder="nominal transaksi" required>
</div>
<div class="form-group">
    <label for="status">Status</label>
    <select id="status" name="status_transaksi" class="form-control select2" style="width: 100%;" required>
        <option value="">Pilih Status Transaksi</option>
        <option <?= $transaksi['status_transaksi'] == 0 ? 'selected' : '' ?> value="0">Belum Dikonfirmasi</option>
        <option <?= $transaksi['status_transaksi'] == 1 ? 'selected' : '' ?> value="1">Sudah Dikonfirmasi</option>
    </select>
</div>
<div class="form-group">
    <label for="buktiImageEdit">Bukti Transaksi</label>
    <small class="text-info">biarkan kosong jika tidak ingin merubah gambar</small>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="buktiImageEdit" accept="image/x-png,image/gif,image/jpeg" name="bukti_transaksi">
        <label class="custom-file-label" for="buktiImageEdit">Choose file</label>
        <img style="object-fit: cover; height: 100px; width: 150px;" width="150px" height="100px" src="" alt="bukti" id="buktiPreviewEdit" class="img-fluid mt-2 d-none">
    </div>
</div>