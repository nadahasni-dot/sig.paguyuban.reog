<input type="hidden" name="id_reservasi" value="<?= $reservasi['id_reservasi']; ?>">
<input type="hidden" name="id_user" value="<?= $reservasi['id_user']; ?>">
<input type="hidden" name="id_jasa" value="<?= $reservasi['id_jasa']; ?>">
<input type="hidden" name="id_paguyuban" value="<?= $reservasi['id_paguyuban']; ?>">
<div class="form-group">
    <label for="pemesan">Pemesan</label>
    <input type="text" id="pemesan" name="pemesan" value="<?= $reservasi['username'] ?>" class="form-control" style="width: 100%;" readonly />
</div>
<div class="form-group">
    <label for="notelp">Telepon Pemesan</label>
    <input type="text" id="notelp" name="telepon" value="<?= $reservasi['telepon_user'] ?>" class="form-control" style="width: 100%;" readonly />
</div>
<div class="form-group">
    <label for="namaJasa">Jasa</label>
    <input type="text" id="namaJasa" name="namajasa" value="<?= $reservasi['nama_jasa'] ?>" class="form-control" style="width: 100%;" readonly/>
</div>
<div class="form-group">
    <label for="tanggal">Tanggal</label>
    <input id="tanggal" value="<?= $reservasi['tanggal_reservasi'] ?>" type="date" class="form-control" name="tanggal_reservasi" placeholder="tanggal reservasi" readonly>
</div>
<div class="form-group">
    <label for="deskripsi">Deskripsi</label>
    <textarea name="deskripsi_reservasi" id="deskripsi" cols="30" rows="5" class="form-control" placeholder="Deskripsi reservasi" readonly required><?= $reservasi['deskripsi_reservasi'] ?></textarea>
</div>
<div class="form-group">
    <label for="status">Status</label>
    <select id="status" name="status_reservasi" class="form-control select2" style="width: 100%;" required>
        <option value="">Pilih Status Reservasi</option>
        <option <?= $reservasi['status_reservasi'] == 0 ? 'selected' : '' ?> value="0">Belum Dikonfirmasi</option>
        <option <?= $reservasi['status_reservasi'] == 1 ? 'selected' : '' ?> value="1">Sudah Dikonfirmasi</option>
    </select>
</div>
</div>