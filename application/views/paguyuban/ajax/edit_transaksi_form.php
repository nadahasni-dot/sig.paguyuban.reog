<input type="hidden" name="id_transaksi" value="<?= $transaksi['id_transaksi']; ?>">
<div class="text-center">
    <img src="<?= base_url('assets/img/transaksi/') . $transaksi['bukti_transaksi'] ?>" alt="Foto Paguyuban" class="img-fluid" style="width: 100%; max-height: 400px; object-fit: cover">
</div>
<div class="form-group">
    <label for="pemesan">Pemesan</label>
    <input id="pemesan" value="<?= $transaksi['username'] ?>" type="text" class="form-control" name="username" placeholder="Pemesan" readonly required>
</div>
<div class="form-group">
    <label for="jasa">Jasa Yang Dipesan</label>
    <input id="jasa" value="<?= $transaksi['nama_jasa'] ?>" type="text" class="form-control" name="username" placeholder="Jasa yang dipesan" readonly required>
</div>
<div class="form-group">
    <label for="tanggal">Tanggal Pembayaran</label>
    <input id="tanggal" value="<?= $transaksi['tanggal_transaksi'] ?>" type="date" class="form-control" name="tanggal_transaksi" placeholder="tanggal transaksi" readonly required>
</div>
<div class="form-group">
    <label for="nominal">Nominal</label>
    <input id="nominal" value="<?= $transaksi['nominal_transaksi'] ?>" type="number" class="form-control" name="nominal_transaksi" placeholder="nominal transaksi" readonly required>
</div>
<div class="form-group">
    <label for="status">Status</label>
    <select id="status" name="status_transaksi" class="form-control select2" style="width: 100%;" required>
        <option value="">Pilih Status Transaksi</option>
        <option <?= $transaksi['status_transaksi'] == 0 ? 'selected' : '' ?> value="0">Belum Dikonfirmasi</option>
        <option <?= $transaksi['status_transaksi'] == 1 ? 'selected' : '' ?> value="1">Sudah Dikonfirmasi</option>
    </select>
</div>