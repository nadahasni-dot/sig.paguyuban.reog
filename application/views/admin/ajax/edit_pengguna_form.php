<input type="hidden" name="id_user" value="<?= $user['id_user']; ?>">
<div class="form-group">
    <label for="userName">Username</label>
    <input id="userName" type="text" value="<?= $user['username']; ?>" class="form-control" name="username" placeholder="Username" required>
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input id="email" type="email" value="<?= $user['email']; ?>" class="form-control" name="email" placeholder="Email" required>
</div>
<div class="form-group">
    <label for="telepon_user">Phone</label>
    <input id="telepon_user" type="tel" value="<?= $user['telepon_user']; ?>" class="form-control" name="telepon_user" placeholder="Phone" required>
</div>
<div class="form-group">
    <label for="role">Role</label>
    <select id="role" name="role" class="form-control select2" style="width: 100%;" required>
        <option <?= $user['role'] == NULL ? 'selected': ''; ?> value="">Pilih Role</option>
        <option <?= $user['role'] == 1 ? 'selected': ''; ?> value="1">ADMIN</option>
        <option <?= $user['role'] == 2 ? 'selected': ''; ?> value="2">PAGUYUBAN</option>
        <option <?= $user['role'] == 3 ? 'selected': ''; ?> value="3">UMUM</option>
    </select>
</div>
<div class="form-group">
    <label for="status_user">User Status</label>
    <select id="status_user" name="status_user" class="form-control select2" style="width: 100%;" required>
        <option <?= $user['status_user'] == NULL ? 'selected': ''; ?> value="">Pilih Status</option>
        <option <?= $user['status_user'] == 1 ? 'selected': ''; ?> value="1">ACTIVE</option>
        <option <?= $user['status_user'] == 0 ? 'selected': ''; ?> value="0">NOT VERIFIED</option>        
    </select>
</div>
<hr>
<div class="form-group">
    <label for="password">Password</label>
    <small class="text-info">Kosongi jika tidak ingin merubah password</small>
    <input id="password" autocomplete="name" minlength="6" maxlength="20" type="password" class="form-control" name="password">
</div>