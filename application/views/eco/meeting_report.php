<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fa fa-list"></i> ECO Meeting Report</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">ECO Meeting Report</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <i class="fa fa-list"></i>
            <h3 class="box-title">ECO Meeting Report</h3>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <?php
                foreach ($row->result() as $key => $data) :
                ?>
                    <div class="pull-right">
                        <div class="btn-group">
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#imgModal">Upload File Meeting <i class="fa fa-upload"></i></button>
                        </div>
                    </div>
                    <div style="display:inline-block; margin:8px; text-align:center;">
                        <img src="<?= site_url('uploads/eco_file/' . $data->img_meeting) ?>" style="width:auto; height:auto; border:1px solid #ccc; padding:4px;">
                    </div>
                    <thead>
                        <th colspan="5">Approval</th>
                        </th>
                    </thead>
                    <tbody>
                        <td>R&D</td>
                        <td>Materials</td>
                        <td>QC</td>
                        <td>PPIC</td>
                        <td>Molding</td>
                        <td>Injection</td>
                        <td>Assy</td>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><?= $data->aproval1 ?></td>
                            <td><?= $data->aproval2 ?></td>
                            <td><?= $data->aproval3 ?></td>
                            <td><?= $data->aproval4 ?></td>
                            <td><?= $data->aproval5 ?></td>
                            <td><?= $data->aproval6 ?></td>
                            <td><?= $data->aproval7 ?></td>
                        </tr>
                    </tfoot>
                <?php endforeach; ?>
            </table>
            <br>
            <div class="pull-right">
                <div class="btn-group">
                    <a href="<?= site_url('eco/index') ?>" class="btn btn-warning">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

<!-- Modal Input -->
<div class="modal fade" id="imgModal" tabindex="-1" role="dialog" aria-labelledby="imgModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="imgModal">Input User</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open_multipart('eco/upload_meeting'); ?>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <label>File Upload</label>
                        <input type="file" name="attachment1" required>
                        <input type="hidden" name="id_eco" value="<?= $data->id_eco ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-paper-plane"></i> Save</button>
                    <button type="reset" class="btn btn-sm btn-default"><i class="fa fa-undo"></i> Reset</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>