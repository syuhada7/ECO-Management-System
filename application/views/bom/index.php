<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fa fa-filter"></i> BOM Data</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Bill Of Materials</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <i class="fa fa-list"></i>
            <h3 class="box-title">List Data</h3>
            <div class="pull-right">
                <div class="btn-group">
                    <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#bomModal"><i class="fa fa-plus"></i> Create</button>
                </div>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <th>Date Update</th>
                    <th>PIC</th>
                    <th>Part-No</th>
                    <th>Status</th>
                    <th>Views Approval</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($row->result() as $key => $data) : ?>
                        <tr>
                            <td><?= $data->date_created ?></td>
                            <td><?= $data->u_created ?></td>
                            <td><?= $data->no_pn ?></td>
                            <td><?= $data->status ?></td>
                            <?php
                            $approvals = [
                                $data->approv1,
                                $data->approv2,
                                $data->approv3,
                                $data->approv4,
                                $data->approv5,
                                $data->approv6,
                                $data->approv7
                            ];

                            // Jika ada salah satu yang kosong → beri warna merah
                            $incomplete = in_array(null, $approvals, true) || in_array('', $approvals, true);

                            // Buat URL link
                            $link = site_url('bom/approval/' . $data->id_bom);
                            ?>
                            <td style="background-color: <?= $incomplete ? 'red' : '' ?>" class="text-center">
                                <a href="<?= $link ?>">
                                    <i class="fa fa-eye"></i>
                                </a>
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
<div class="modal fade" id="bomModal" tabindex="-1" role="dialog" aria-labelledby="bomModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="bomModal">Input BOM</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <?php echo form_open_multipart('bom/add'); ?>
                    <div class="form-group">
                        <div class="col-lg <?= form_error('no_pn') ? 'has-error' : null ?>">
                            <label>Part No *</label>
                            <input type="text" name="no_pn" value="<?= set_value('no_pn'); ?>" class="form-control">
                            <?= form_error('no_pn', '<small class="text-danger pl-3">', '</small>'); ?>
                            <input type="hidden" name="u_created" value="<?= $this->fungsi->user_login()->nama; ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg">
                            <label>File Upload *</label>
                            <input type="text" name="file_bom" class="form-control">
                            <br>
                            <input type="file" name="attachment1" required>
                            <span><b>*Require upload file : xls,xlsx</b></span>
                        </div>
                    </div>
                    <div class="col-lg <?= form_error('remarks') ? 'has-error' : null ?>">
                        <label>Remarks</label>
                        <textarea name="remarks" class="form-control"></textarea>
                        <?= form_error('remarks', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-paper-plane"></i> Save</button>
                                <button type="reset" class="btn btn-sm btn-default"><i class="fa fa-undo"></i> Reset</button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>