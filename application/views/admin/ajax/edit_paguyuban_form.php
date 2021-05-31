<input type="hidden" name="id_paguyuban" value="<?= $paguyuban['id_paguyuban']; ?>">
<input type="hidden" name="owner" value="<?= $paguyuban['id_user']; ?>">
<div class="form-group">
    <label for="pemilik">Pemilik Paguyuban</label>
    <select id="pemilik" name="id_user" class="form-control select2" style="width: 100%;" required>
        <option value="">Pilih Pemilik Paguyuban</option>
        <?php foreach ($owner as $row) : ?>
            <option <?= $row['id_user'] == $paguyuban['id_user'] ? 'selected' : '' ?> value="<?= $row['id_user'] ?>"><?= $row['username']; ?></option>
        <?php endforeach; ?>
    </select>
</div>
<div class="form-group">
    <label for="namaPaguyuban">Nama Paguyuban</label>
    <input id="namaPaguyuban" type="text" class="form-control" name="nama_paguyuban" placeholder="nama paguyuban baru" value="<?= $paguyuban['nama_paguyuban']; ?>" required>
</div>
<div class="form-group">
    <label for="deskripsi">Deskripsi</label>
    <textarea name="deskripsi_paguyuban" id="deskripsi" cols="30" rows="5" class="form-control" placeholder="masukkan deskripsi paguyuban" vrequired><?= $paguyuban['deskripsi_paguyuban']; ?></textarea>
</div>
<div class="form-group">
    <label for="saran">Saran</label>
    <textarea name="alamat_paguyuban" id="saran" cols="30" rows="5" class="form-control" placeholder="masukkan alamat paguyuban" required><?= $paguyuban['alamat_paguyuban']; ?></textarea>
</div>
<div class="form-group">
    <label for="teleponPaguyuban">Telepon</label>
    <input id="teleponPaguyuban" value="<?= $paguyuban['telepon_paguyuban']; ?>" type="tel" class="form-control" name="telepon_paguyuban" minlength="10" maxlength="16" placeholder="telepon paguyuban" required>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="noRekening">No Rekening</label>
            <input id="noRekening" value="<?= $paguyuban['no_rekening']; ?>" ype="text" class="form-control" name="no_rekening" placeholder="latitude" required>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="PemilikRekening">Pemilik Rekening</label>
            <input id="PemilikRekening" value="<?= $paguyuban['pemilik_rekening']; ?>" type="text" class="form-control" name="pemilik_rekening" placeholder="NAMA PEMILIK & JENIS BANK" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="latitude">latitude</label>
            <input id="latitude" value="<?= $paguyuban['lat_paguyuban']; ?>" ype="text" class="form-control" name="lat_paguyuban" placeholder="latitude" required>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="longitude">longitude</label>
            <input id="longitude" value="<?= $paguyuban['lng_paguyuban']; ?>" type="text" class="form-control" name="lng_paguyuban" placeholder="longitude" required>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="customFile">Choose Image</label>
    <small class="text-info">biarkan kosong jika tidak ingin merubah gambar</small>
    <div class="custom-file">
        <input type="file" class="custom-file-input" id="paguyubanImageEdit" accept="image/x-png,image/gif,image/jpeg" name="foto_paguyuban">
        <label class="custom-file-label" for="customFile">Choose file</label>
        <img style="object-fit: cover; height: 100px; width: 150px;" width="150px" height="100px" src="" alt="paguyuban" id="paguyubanPreviewEdit" class="img-fluid mt-2 d-none">
    </div>
</div>