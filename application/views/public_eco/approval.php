<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fa fa-list"></i> ECO Approval Meeting</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('eco_public'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">ECO Approval Meeting</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <i class="fa fa-list"></i>
            <h3 class="box-title">ECO Approval Meeting</h3>
        </div>

        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <?php foreach ($row->result() as $key => $data) : ?>
                    <hr>
                    <?php if (!empty($data->img_meeting)) : ?>
                        <?php
                        $file      = $data->img_meeting;
                        $file_path = site_url('uploads/eco_file/' . $file);
                        $ext       = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        ?>
                        <div style="margin:15px 0; text-align:center;">
                            <?php if ($ext === 'pdf') : ?>
                                <!-- PDF Preview -->
                                <iframe src="<?= $file_path ?>"
                                    width="100%"
                                    height="500px"
                                    style="border:1px solid #ccc;">
                                </iframe>
                            <?php elseif ($ext === 'xlsx' || $ext === 'xls') : ?>
                                <!-- Excel Icon -->
                                <i class="fa fa-file-excel-o"
                                    style="font-size:80px; color:#1D6F42;"></i>
                                <p><strong><?= $file ?></strong></p>
                            <?php elseif ($ext === 'pptx' || $ext === 'ppt') : ?>
                                <!-- PowerPoint Icon -->
                                <i class="fa fa-file-powerpoint-o"
                                    style="font-size:80px; color:#D24726;"></i>
                                <p><strong><?= $file ?></strong></p>
                            <?php else : ?>
                                <!-- File lainnya -->
                                <i class="fa fa-file-o"
                                    style="font-size:80px;"></i>
                                <p><strong><?= $file ?></strong></p>
                            <?php endif; ?>
                            <!-- Download Button -->
                            <br>
                            <a href="<?= $file_path ?>"
                                class="btn btn-sm btn-success"
                                download>
                                <i class="fa fa-download"></i> Download File
                            </a>
                        </div>
                    <?php endif; ?>
                    <!-- Tabel Approval -->
                    <thead>
                        <tr>
                            <th colspan="7" class="text-center">Approval</th>
                        </tr>
                        <tr>
                            <td>R&D</td>
                            <td>Materials</td>
                            <td>QC</td>
                            <td>PPIC</td>
                            <td>Molding</td>
                            <td>Injection</td>
                            <td>Assy</td>
                        </tr>
                    </thead>
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
                    </form>
                <?php endforeach; ?>
            </table>
            <br>
            <div class="pull-right">
                <div class="btn-group">
                    <a href="<?= site_url('eco_public') ?>" class="btn btn-warning">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Komentar -->
    <div class="box">
        <div class="box-header">
            <i class="fa fa-list"></i>
            <h3 class="box-title">Commentary List</h3>
            <div class="pull-right">
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#komenModal"><i class="fa fa-plus"></i> Create</button>
            </div>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <th>User name</th>
                <th>Date</th>
                <th>Remaks</th>
            </thead>
            <tbody>
                <?php foreach ($row2->result() as $key => $komen) : ?>
                    <tr>
                        <td><?= $komen->nama_user ?></td>
                        <td><?= $komen->date_komen ?></td>
                        <td><?= $komen->komen ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal Input -->
    <div class="modal fade" id="komenModal" tabindex="-1" role="dialog" aria-labelledby="komenModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="komenModal">Input Commentary</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= site_url('eco_public/komentar') ?>" method="POST">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Name *</label>
                                <input type="text" name="nama_user" class="form-control">
                                <input type="hidden" name="id_eco" value="<?= $data->id_eco ?>" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label>Date</label>
                                <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                <input type="text" name="date_komen"
                                    value="<?= date('d F Y H:i:s'); ?>"
                                    class="form-control" readonly>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg">
                                <label>Commentary *</label>
                                <textarea name="komentar" class="form-control"></textarea>
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
</section>
<!-- /.content -->