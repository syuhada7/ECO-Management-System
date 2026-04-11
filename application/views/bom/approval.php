<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fa fa-list"></i> BOM Approval</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">BOM Approval</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <i class="fa fa-list"></i>
            <h3 class="box-title">BOM Approval</h3>
        </div>

        <div class="box-body table-responsive">
            <?php
            // Ambil departemen user dari session
            $dept = $this->fungsi->user_login()->dept;
            // Peta nama kolom berdasarkan departemen
            $deptColumns = [
                'RnD'        => 'approv1',
                'Materials'  => 'approv2',
                'QC'         => 'approv3',
                'PPIC'       => 'approv4',
                'Molding'    => 'approv5',
                'Injection'  => 'approv6',
                'Assembly'   => 'approv7'
            ];
            ?>

            <table class="table table-bordered table-striped">
                <?php foreach ($row->result() as $key => $data) : ?>
                    <?php if (!empty($data->file_bom)) : ?>
                        <?php
                        $file      = $data->file_bom;
                        $file_path = site_url('uploads/bom_file/' . $file);
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
                    <?php
                    // Ambil nama kolom departemen login
                    $user_col = isset($deptColumns[$dept]) ? $deptColumns[$dept] : null;
                    $is_approved = ($user_col && !empty($data->$user_col)); // sudah pernah approve?
                    ?>

                    <form action="<?= site_url('bom/update_approval') ?>" method="post">
                        <input type="hidden" name="id_bom" value="<?= $data->id_bom ?>">
                        <!-- Tombol Save hanya muncul jika user punya kolom & belum approve -->
                        <?php if ($user_col && !$is_approved) : ?>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-primary" type="submit" name="btnApprove">
                                        Save <i class="fa fa-save"></i>
                                    </button>
                                </div>
                            </div>
                        <?php elseif ($is_approved) : ?>
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-default" disabled>
                                        Approved <i class="fa fa-check"></i>
                                    </button>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Gambar jika ada -->
                        <?php if (!empty($data->file_bom)) : ?>
                            <div style="display:inline-block; margin:8px; text-align:center;">
                                <img src="<?= site_url('uploads/bom_file/' . $data->file_bom) ?>"
                                    alt="BOM File"
                                    style="width:auto; height:auto; border:1px solid #ccc; padding:4px; max-width:500px;">
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
                                <?php foreach ($deptColumns as $dName => $colName) : ?>
                                    <td>
                                        <?php if ($dept === $dName) : ?>
                                            <?php if (empty($data->$colName)) : ?>
                                                <!-- User hanya bisa pilih jika belum approve -->
                                                <select name="approval_value" class="form-control" required>
                                                    <option value="">--</option>
                                                    <option value="Approved">Approved</option>
                                                    <option value="Not Approved">Not Approved</option>
                                                </select>
                                                <input type="hidden" name="approval_column" value="<?= $colName ?>">
                                            <?php else : ?>
                                                <!-- Sudah approve, tampilkan hasil -->
                                                <?= $data->$colName ?>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <!-- Kolom lain hanya tampil -->
                                            <?= $data->$colName ?>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        </tfoot>
                    </form>
                <?php endforeach; ?>
            </table>
            <br>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <th>Date Update</th>
                        <th>PIC</th>
                        <th>Part-No</th>
                        <th>Status</th>
                        <th>Remarks</th>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($row->result() as $key => $data) : ?>
                            <tr>
                                <td><?= $data->date_created ?></td>
                                <td><?= $data->u_created ?></td>
                                <td><?= $data->no_pn ?></td>
                                <td><?= $data->status ?></td>
                                <td><?= $data->remarks ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <br>
            <div class="pull-right">
                <div class="btn-group">
                    <a href="<?= site_url('bom/index') ?>" class="btn btn-warning">
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
                    <form action="<?= site_url('bom/komentar') ?>" method="POST">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Name</label>
                                <input type="text" name="nama_user" value="<?= $this->fungsi->user_login()->nama; ?>" class="form-control" readonly>
                                <input type="hidden" name="id_bom" value="<?= $data->id_bom ?>" class="form-control">
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