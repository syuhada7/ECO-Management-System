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
            <?php
            // Ambil departemen user dari session
            $dept = $this->fungsi->user_login()->dept;
            // Peta nama kolom berdasarkan departemen
            $deptColumns = [
                'RnD'        => 'aproval1',
                'Materials'  => 'aproval2',
                'QC'         => 'aproval3',
                'PPIC'       => 'aproval4',
                'Molding'    => 'aproval5',
                'Injection'  => 'aproval6',
                'Assembly'   => 'aproval7'
            ];
            ?>

            <table class="table table-bordered table-striped">
                <?php foreach ($row->result() as $key => $data) : ?>
                    <?php
                    // Ambil nama kolom departemen login
                    $user_col = isset($deptColumns[$dept]) ? $deptColumns[$dept] : null;
                    $is_approved = ($user_col && !empty($data->$user_col)); // sudah pernah approve?
                    ?>

                    <form action="<?= site_url('eco/update_approval') ?>" method="post">
                        <input type="hidden" name="id_eco" value="<?= $data->id_eco ?>">
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
                        <?php if (!empty($data->img_meeting)) : ?>
                            <div style="display:inline-block; margin:8px; text-align:center;">
                                <img src="<?= site_url('uploads/eco_file/' . $data->img_meeting) ?>"
                                    alt="Meeting File"
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