<div class="register-box">
  <div class="register-logo">
    <a href="<?= base_url('login') ?>">
      <h2>SIG PAGUYUBAN REOG</h2>
    </a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <?= $this->session->flashdata('message'); ?>

      <form action="" role="form" id="registrationForm" method="post">
        <?php echo form_error('username', '<small class="text-danger">', '</small>'); ?>
        <div class="input-group form-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username" value="<?= set_value('username'); ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <?php echo form_error('telepon_user', '<small class="text-danger">', '</small>'); ?>
        <div class="input-group form-group mb-3">
          <input type="tel" name="telepon_user" class="form-control" placeholder="Phone Number" value="<?= set_value('telepon_user'); ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
        <div class="input-group form-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" value="<?= set_value('email'); ?>" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <?php echo form_error('role', '<small class="text-danger">', '</small>'); ?>
        <div class="input-group form-group mb-3">
          <select name="role" class="form-control select2" placeholder="role" value="<?= set_value('role'); ?>" required>
            <option value="">Select Role</option>
            <option value="3">Umum</option>
            <option value="2">Paguyuban</option>
          </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <?php echo form_error('password', '<small class="text-danger">', '</small>'); ?>
        <div class="input-group form-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?php echo form_error('confpassword', '<small class="text-danger">', '</small>'); ?>
        <div class="input-group form-group mb-3">
          <input type="password" name="confpassword" class="form-control" placeholder="Retype password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12 mb-3">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
            <a href="<?= base_url(); ?>" class="btn btn-danger btn-block">Back to home</a>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="<?= base_url('login'); ?>" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->