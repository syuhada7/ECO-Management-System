<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fa fa-list"></i> ECO First Release Date</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('eco_public'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">ECO First Release Date</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <i class="fa fa-list"></i>
            <h3 class="box-title">ECO Inspection QC</h3>
        </div>

        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <?php foreach ($row->result() as $key => $data) : ?>
                    <hr>
                    <?php if (!empty($data->img_qc)) : ?>
                        <?php
                        $file      = $data->img_qc;
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
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                <!-- Tabel -->
                <thead>
                    <tr>
                        <th colspan="7" class="text-center">History Upload File Inspections</th>
                    </tr>
                    <tr>
                        <td>Registrations Date</td>
                        <td>Registrant</td>
                        <td>Departement</td>
                        <td>File Name</td>
                        <td>First Release Date</td>
                        <td>Actions</td>
                    </tr>
                </thead>
                <tfoot>
                    <?php foreach ($row2->result() as $key => $data2) : ?>
                        <tr>
                            <td><?= $data2->date_created  ?></td>
                            <td><?= $data2->username  ?></td>
                            <td><?= $data2->depart  ?></td>
                            <td><?= $data2->file1 ?></td>
                            <td><?= $data2->date_1 ?></td>
                            <td><a href="<?= $data2->file1 ?>"
                                    class="btn btn-sm btn-success"
                                    download>
                                    <i class="fa fa-download"></i> Download File
                                </a></td>
                        </tr>
                    <?php endforeach; ?>
                </tfoot>
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
</section>
<!-- /.content -->