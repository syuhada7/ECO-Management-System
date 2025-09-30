<!-- Content Header (Page header) -->
<section class="content-header">
  <h1><i class="fa fa-users"></i> User Data</h1>
  <ol class="breadcrumb">
    <li><a href="<?= base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Users</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="box">
    <div class="box-header">
      <i class="fa fa-list"></i>
      <h3 class="box-title">List Data</h3>
      <div class="pull-right">
        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#userModal"><i class="fa fa-plus"></i> Create</button>
      </div>
    </div>
    <div class="box-body table-responsive">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
          <th>NIK</th>
          <th>PIC Name</th>
          <th>Departement</th>
          <th>Level</th>
          <th>Action</th>
        </thead>
        <tbody>
          <?php
          foreach ($row->result() as $key => $data) : ?>
            <tr>
              <td><?= $data->nik ?></td>
              <td><?= $data->nama ?></td>
              <td><?= $data->dept ?></td>
              <td><?= $data->level == 1 ? "Administrator" : "User" ?></td>
              <td class="text-center" width="160">
                <!-- <?= anchor('user/edit/' . $data->id_user, '<button class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></button>'); ?> -->
                <a href="<?= site_url('user/delete/' . $data->id_user); ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure delete <?= $data->nama ?> ?');"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>
<!-- /.content -->

<!-- Modal Input -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="userModal">Input User</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('User/add'); ?>" method="POST">
          <div class="form-group row">
            <div class="col-lg-6 <?= form_error('nama') ? 'has-error' : null ?>">
              <label>PIC Name *</label>
              <input type="text" name="nama" value="<?= set_value('nama'); ?>" class="form-control">
              <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="col-lg-6 <?= form_error('nik') ? 'has-error' : null ?>">
              <label>NIK *</label>
              <input type="text" name="nik" value="<?= set_value('nik'); ?>" class="form-control">
              <?= form_error('nik', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>
          <div class="form-group row">
            <div class="col-lg-6 <?= form_error('password1') ? 'has-error' : null ?>">
              <label>Password *</label>
              <input type="password" name="password1" class="form-control">
              <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="col-lg-6 <?= form_error('password2') ? 'has-error' : null ?>">
              <label>Re-Password *</label>
              <input type="password" name="password2" class="form-control">
              <?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>
          <div class="form-group row">
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
              <label>Level *</label>
              <select name="level" class="form-control">
                <option>--</option>
                <option value="1">Administrator</option>
                <option value="2">Manager</option>
                <option value="3">SPV/Leader</option>
                <option value="4">User</option>
              </select>
              <?= form_error('level', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-paper-plane"></i> Save</button>
            <button type="reset" class="btn btn-sm btn-default"><i class="fa fa-undo"></i> Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>