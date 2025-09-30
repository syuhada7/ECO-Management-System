<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Edit Data User</h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?= base_url('user'); ?>"><i class="fa fa-user"></i> User Data</a></li>
    <li class="active"><i class="fa fa-user-plus"></i> Edit User</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
      <i class="fa fa-edit"></i>
      <h3 class="box-title">Update User Form</h3>
      <div class="pull-right">
        <a href="<?= site_url('User'); ?>" class="btn btn-sm btn-warning">
          <i class="fa fa-arrow-left"></i> Back
        </a>
      </div>
    </div>
    <div class="box-body">
      <div class="row">
        <div class="col-lg">
          <form action="<?= base_url('User/edit'); ?>" method="POST">
            <div class="form-group">
              <div class="col-lg-6 <?= form_error('nama') ? 'has-error' : null ?>">
                <label>Nama PIC</label>
                <input type="hidden" name="id_user" value="<?= $row->id_user ?>">
                <input type="text" name="nama" value="<?= $this->input->post('nama') ?? $row->nama_pic ?>" class="form-control">
              </div>
              <div class="col-lg-6 <?= form_error('email') ? 'has-error' : null ?>">
                <label>NIK</label>
                <input type="text" name="nik" value="<?= $this->input->post('nik') ?? $row->nik ?>" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-6 <?= form_error('password1') ? 'has-error' : null ?>">
                <label>Password</label>
                <input type="password" name="password1" class="form-control" value="<?= $this->input->post('password1'); ?>">
              </div>
              <div class="col-lg-6 <?= form_error('password2') ? 'has-error' : null ?>">
                <label>Re-Password</label>
                <input type="password" name="password2" class="form-control" value="<?= $this->input->post('password2'); ?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-6 <?= form_error('dept') ? 'has-error' : null ?>">
                <label>Departement *</label>
                <select name="dept" class="form-control">
                  <option>--</option>
                  <option value="RnD">RnD</option>
                  <option value="Molding">Molding</option>
                  <option value="PPIC">PPIC</option>
                  <option value="Injection">Injection</option>
                  <option value="Assembly">Assembly</option>
                  <option value="Materials">Materials</option>
                  <option value="QC">QC</option>
                </select>
                <?= form_error('dept', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="col-lg-6 <?= form_error('level') ? 'has-error' : null ?>">
                <label>Level</label>
                <select name="level" class="form-control">
                  <?php $level = $this->input->post('level') ? $this->input->post('level') : $row->level ?>
                  <option value="1">Administrator</option>
                  <option value="2" <?= $level == 2 ? "selected" : null ?>>Manager</option>
                  <option value="3" <?= $level == 3 ? "selected" : null ?>>SPV/Leader</option>
                  <option value="4" <?= $level == 4 ? "selected" : null ?>>User</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-lg-6">
                <br>
                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Update</button> |
                <button type="reset" class="btn btn-sm btn-default"><i class="fa fa-undo"></i> Reset</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
</section>
<!-- /.content -->