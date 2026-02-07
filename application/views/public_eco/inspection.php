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
        <hr>
        <!-- ================= PREVIEW FILE ================= -->
        <div id="preview-area" style="margin:15px 0; text-align:center;">
            <p class="text-muted">Click file name to preview</p>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
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
                            <td>
                                <a href="<?= site_url('uploads/eco_file/' . $data2->file1) ?>"
                                    class="btn btn-sm btn-success"
                                    download>
                                    <i class="fa fa-download"></i> Download File
                                </a>
                            </td>
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