<input type="hidden" name="id_reservasi" value="<?= $reservasi['id_reservasi']; ?>">
<div class="form-group">
    <label for="pemesan">Pemesan</label>
    <select id="pemesan" name="id_user" class="form-control select2" style="width: 100%;" required>
        <option value="">Pilih Pemesan</option>
        <?php foreach ($umum as $row) : ?>
            <option <?= $reservasi['id_user'] == $row['id_user'] ? 'selected' : '' ?> value="<?= $row['id_user'] ?>"><?= $row['username'] ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-group">
    <label for="namaJasa">Jasa</label>
    <select id="namaJasa" name="jasa_paguyuban" class="form-control select2" style="width: 100%;" required>
        <option selected value="">Pilih Jasa</option>
        <?php foreach ($jasa as $row) : ?>
            <option <?php if ($row['id_jasa'] == $reservasi['id_jasa'] && $row['id_paguyuban'] == $reservasi['id_paguyuban']) echo 'selected' ?> value="<?= $row['id_jasa'] . '.' . $row['id_paguyuban'] ?>"><?= $row['nama_jasa'] . ' [' . $row['nama_paguyuban'] . ']' ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-group">
    <label for="tanggal">Tanggal</label>
    <input id="tanggal" value="<?= $reservasi['tanggal_reservasi'] ?>" type="date" class="form-control" name="tanggal_reservasi" placeholder="tanggal reservasi" required>
</div>
<div class="form-group">
    <label for="deskripsi">Deskripsi</label>
    <textarea name="deskripsi_reservasi" id="deskripsi" cols="30" rows="5" class="form-control" placeholder="Deskripsi reservasi" required><?= $reservasi['deskripsi_reservasi'] ?></textarea>
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