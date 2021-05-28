<input type="hidden" name="id_jasa" value="<?= $jasa['id_jasa']; ?>">
<input type="hidden" name="id_paguyuban" value="<?= $paguyuban['id_paguyuban']; ?>">
<div class="text-center">
    <img src="<?= base_url('assets/img/jasa/') . $jasa['foto_jasa'] ?>" alt="Foto Paguyuban" class="img-fluid" style="width: 100%; max-height: 200px; object-fit: cover">
</div>
<div class="form-group mt-2">
    <label for="namaJasa">Nama Jasa</label>
    <input id="namaJasa" type="text" value="<?= $jasa['nama_jasa']; ?>" class="form-control" name="nama_jasa" placeholder="Username" required>
</div>
<div class="form-group">
    <label for="deskripsiJasa">Deskripsi Jasa</label>
    <textarea rows="5" cols="30" id="deskripsiJasa" type="text" class="form-control" name="deskripsi_jasa" placeholder="Deskripsi jasa baru" required><?= $jasa['deskripsi_jasa']; ?></textarea>
</div>
<div class="form-group">
    <label for="hargaJasa">Harga Jasa</label>
    <input id="hargaJasa" type="number" value="<?= $jasa['harga_jasa'] ?>" class="form-control" name="harga_jasa" placeholder="Harga" required>
</div>
<label for="customFile">Choose Image</label>
<small class="text-info">biarkan kosong jika tidak ingin merubah gambar</small>
<div class="custom-file">
    <input type="file" class="custom-file-input" id="jasaImageEdit" accept="image/x-png,image/gif,image/jpeg" name="foto_jasa">
    <label class="custom-file-label" for="customFile">Choose file</label>
    <img style="object-fit: cover; height: 100px; width: 150px;" width="150px" height="100px" src="" alt="jasa" id="jasaPreviewEdit" class="img-fluid mt-2 d-none">
</div>