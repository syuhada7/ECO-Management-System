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
                <?php foreach ($row->result() as $key => $data) : ?>

                    <!-- Bagian tombol upload/replace -->
                    <div class="pull-right">
                        <div class="btn-group">
                            <?php if (empty($data->img_meeting)) : ?>
                                <!-- Jika belum ada file -->
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#imgModal<?= $data->id_eco ?>">
                                    Upload File Meeting <i class="fa fa-upload"></i>
                                </button>
                            <?php else : ?>
                                <!-- Jika sudah ada file -->
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#imgModal<?= $data->id_eco ?>">
                                    Replace File <i class="fa fa-refresh"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Tampilkan gambar jika sudah ada -->
                    <?php if (!empty($data->img_meeting)) : ?>
                        <div style="display:inline-block; margin:8px; text-align:center;">
                            <img src="<?= site_url('uploads/eco_file/' . $data->img_meeting) ?>"
                                alt="Meeting File"
                                style="width:auto; height:auto; border:1px solid #ccc; padding:4px; max-width:500px;">
                        </div>
                    <?php endif; ?>

                    <!-- Table Approval -->
                    <thead>
                        <tr>
                            <th colspan="7">Approval</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>R&D</td>
                            <td>Materials</td>
                            <td>QC</td>
                            <td>PPIC</td>
                            <td>Molding</td>
                            <td>Injection</td>
                            <td>Assy</td>
                        </tr>
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

                    <!-- Modal Upload / Replace File -->
                    <div class="modal fade" id="imgModal<?= $data->id_eco ?>" tabindex="-1" role="dialog" aria-labelledby="imgModalLabel<?= $data->id_eco ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="imgModalLabel<?= $data->id_eco ?>">
                                        <?= empty($data->img_meeting) ? 'Upload File Meeting' : 'Replace File Meeting'; ?>
                                    </h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <?php echo form_open_multipart('eco/upload_meeting'); ?>
                                    <div class="form-group row">
                                        <div class="col-lg-8">
                                            <label><?= empty($data->img_meeting) ? 'Select File' : 'Select New File to Replace'; ?></label>
                                            <input type="file" name="attachment1" required>
                                            <input type="hidden" name="id_eco" value="<?= $data->id_eco ?>">
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fa fa-paper-plane"></i> Save
                                        </button>
                                        <button type="reset" class="btn btn-sm btn-default">
                                            <i class="fa fa-undo"></i> Reset
                                        </button>
                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>

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