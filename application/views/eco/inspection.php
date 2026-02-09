<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fa fa-list"></i> ECO First Release Date</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
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

                    <!-- Bagian tombol upload/replace -->
                    <div class="pull-right">
                        <div class="btn-group">
                            <?php if (empty($data->img_qc)) : ?>
                                <!-- Jika belum ada file -->
                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#imgModal<?= $data->id_eco ?>">
                                    Upload New File <i class="fa fa-upload"></i>
                                </button>
                            <?php else : ?>
                                <!-- Jika sudah ada file -->
                                <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#imgModal<?= $data->id_eco ?>">
                                    Upload Other File Inspection <i class="fa fa-refresh"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                    <!-- ================= PREVIEW FILE ================= -->
                    <div id="preview-area" style="margin:15px 0; text-align:center;">
                        <p class="text-muted">Click file name to preview</p>
                    </div>

                    <!-- Modal Upload / Replace File -->
                    <div class="modal fade" id="imgModal<?= $data->id_eco ?>" tabindex="-1" role="dialog" aria-labelledby="imgModalLabel<?= $data->id_eco ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="imgModalLabel<?= $data->id_eco ?>">
                                        <?= empty($data->img_qc) ? 'Upload File Inspection' : 'Replace File Meeting'; ?>
                                    </h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <?php echo form_open_multipart('eco/upload_inspection'); ?>
                                    <div class="form-group row">
                                        <div class="col-lg-8">
                                            <label>First release date</label>
                                            <input type="date" name="fr_date" value="<?= $data->first_release_date ?>" class="form-control">
                                            <input type="hidden" name="regis_id" value="<?= $this->fungsi->user_login()->nama; ?>" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-8">
                                            <label><?= empty($data->img_qc) ? 'Select File' : 'Select New File to Replace'; ?></label>
                                            <input type="file" name="attachment1" required>
                                            <input type="hidden" name="id_eco" value="<?= $data->id_eco ?>">
                                            <input type="hidden" name="dept" value="<?= $this->fungsi->user_login()->dept; ?>" class="form-control" readonly>
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
                            <td>
                                <?php if (!empty($data2->file1)) : ?>
                                    <a href="javascript:void(0)"
                                        class="preview-file"
                                        data-file="<?= $data2->file1 ?>">
                                        <?= $data2->file1 ?>
                                    </a>
                                <?php else : ?>
                                    <span class="text-danger">No File</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $data2->date_1 ?></td>
                            <td class="text-center">
                                <?php
                                $file = $data2->file1;
                                $path = './uploads/eco_file/' . $file;
                                $isFileExist = (!empty($file) && file_exists($path));
                                ?>

                                <?php if ($isFileExist) : ?>
                                    <!-- FILE ADA -->
                                    <a href="<?= site_url('uploads/eco_file/' . $file) ?>"
                                        class="btn btn-sm btn-success"
                                        download>
                                        <i class="fa fa-download"></i>
                                    </a>

                                    <a href="<?= site_url('eco/del_ins/' . $data2->id_fdate) ?>"
                                        class="btn btn-sm btn-danger"
                                        onclick="return confirm('Are you sure delete this file?')">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                <?php else : ?>
                                    <!-- FILE HILANG / BELUM ADA -->
                                    <button class="btn btn-sm btn-primary"
                                        data-toggle="modal"
                                        data-target="#updateMissingModal<?= $data2->id_fdate ?>">
                                        <i class="fa fa-upload"></i> Upload
                                    </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tfoot>
            </table>
            <br>
            <div class="pull-right">
                <div class="btn-group">
                    <a href="<?= site_url('eco/index') ?>" class="btn btn-warning">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
            <?php foreach ($row2->result() as $data2) : ?>
                <div class="modal fade" id="updateMissingModal<?= $data2->id_fdate ?>" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title">Upload Replacement File</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body">
                                <?= form_open_multipart('eco/upload_f_ins'); ?>

                                <div class="form-group">
                                    <label>First Release Date</label>
                                    <input type="date"
                                        name="fr_date"
                                        value="<?= $data2->date_1 ?>"
                                        class="form-control">
                                </div>

                                <div class="form-group">
                                    <label>Select File</label>
                                    <input type="file"
                                        name="attachment1"
                                        class="form-control"
                                        required>
                                </div>

                                <!-- 🔑 IDENTITAS PENTING -->
                                <input type="hidden" name="id_eco" value="<?= $data2->id_eco ?>">
                                <input type="hidden" name="id_fdate" value="<?= $data2->id_fdate ?>">
                                <input type="hidden" name="mode" value="update_only">

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="fa fa-save"></i> Update
                                    </button>
                                </div>

                                <?= form_close(); ?>
                            </div>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.preview-file').forEach(function(el) {
                el.addEventListener('click', function() {

                    let file = this.dataset.file;
                    let ext = file.split('.').pop().toLowerCase();
                    let url = "<?= site_url('uploads/eco_file/') ?>" + file;

                    let html = '';

                    if (ext === 'pdf') {
                        html = `
                    <iframe src="${url}"
                        width="100%"
                        height="500px"
                        style="border:1px solid #ccc;">
                    </iframe>`;
                    } else if (['jpg', 'jpeg', 'png'].includes(ext)) {
                        html = `
                    <img src="${url}"
                         style="max-width:100%; max-height:500px; border:1px solid #ccc;">`;
                    } else if (['xls', 'xlsx'].includes(ext)) {
                        html = `
                    <i class="fa fa-file-excel-o"
                       style="font-size:80px; color:#1D6F42;"></i>
                    <p><strong>${file}</strong></p>`;
                    } else if (['ppt', 'pptx'].includes(ext)) {
                        html = `
                    <i class="fa fa-file-powerpoint-o"
                       style="font-size:80px; color:#D24726;"></i>
                    <p><strong>${file}</strong></p>`;
                    } else {
                        html = `
                    <i class="fa fa-file-o" style="font-size:80px;"></i>
                    <p><strong>${file}</strong></p>`;
                    }

                    document.getElementById('preview-area').innerHTML = html;
                });
            });

        });
    </script>
</section>
<!-- /.content -->