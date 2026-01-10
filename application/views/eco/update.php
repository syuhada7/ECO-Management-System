<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <i class="fa fa-edit"></i>
            <h3 class="box-title"> ECO Registrations</h3>
            <div class="pull-right">
                <Span hidden><?= $id = $this->fungsi->user_login()->id_user; ?></Span>
                <a href="<?= site_url('eco/index') ?>" class="btn btn-warning">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <div class="header">
                    <img alt="Company Logo" height="50" src="<?= base_url() ?>uploads/logo/logo.png" width="100">
                </div>
            </div>
            <div class="row">
                <div class="col-lg">
                    <?php echo form_open_multipart('eco/update'); ?>
                    <input type="hidden" name="id_eco" value="<?= $eco->id_eco ?>">
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label>Registration date</label>
                            <?php date_default_timezone_set('Asia/Jakarta'); ?>
                            <input type="text" name="regis_date"
                                value="<?= $eco->regis_date ?>"
                                class="form-control" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label>Departement</label>
                            <input type="text" name="dept" value="<?= $eco->dept ?>" class="form-control" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label>Registrant</label>
                            <input type="text" name="regis_id" value="<?= $eco->register ?>" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>IN ECO No.</label>
                            <input type="text" name="in_eco_num" value="<?= $eco->in_eco_num ?>" class="form-control">
                            <br>
                            <input type="file" name="attachment1">
                            <?php if ($eco->in_eco_path): ?>
                                <small>Current File: <?= $eco->in_eco_path ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-6">
                            <label>KR ECO No.</label>
                            <input type="text" name="kr_eco_num" value="<?= $eco->kr_eco_num ?>" class="form-control">
                            <br>
                            <input type="file" name="attachment2">
                            <?php if ($eco->kr_eco_path): ?>
                                <small>Current File: <?= $eco->kr_eco_path ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>Model</label>
                            <table>
                                <tr>
                                    <td style="padding-right:20px"><input type="text" name="model_pn" value="<?= $eco->model_pn ?>" class="form-control"></td>
                                    <td style="padding-right:20px"><input type="text" name="model_pn2" value="<?= $eco->model_pn2 ?>" class="form-control"></td>
                                    <td style="padding-right:20px"><input type="text" name="model_pn3" value="<?= $eco->model_pn3 ?>" class="form-control"></td>
                                    <td style="padding-right:20px"><input type="text" name="model_pn4" value="<?= $eco->model_pn4 ?>" class="form-control"></td>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <label>Product name</label>
                            <input type="text" name="pn_name" value="<?= $eco->pn_name ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label>Current stock</label>
                            <input type="number" name="cr_stock" value="<?= $eco->last_stock ?>" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label>Effective date</label>
                            <input type="date" name="efect_date" value="<?= $eco->effec_date ?>" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label>Expected exhaustion date</label>
                            <input type="date" name="expec_date" value="<?= $eco->expec_date ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label>How to apply</label>
                            <input type="text" name="h-apply" value="<?= $eco->h_apply ?>" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label>Drawing P/N</label>
                            <input type="text" name="dwg_pn" value="<?= $eco->dwg_pn ?>" class="form-control">
                            <br>
                            <input type="file" name="attachment3">
                            <?php if ($eco->dwg_path): ?>
                                <small>Current File: <?= $eco->dwg_path ?></small>
                            <?php endif; ?>
                            <br>
                        </div>
                        <div class="col-lg-4">
                            <label>Related Sub Materials</label>
                            <input type="text" name="rm" value="<?= $eco->rm ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label>Note</label>
                            <textarea name="ket" class="form-control"><?= $eco->ket ?></textarea>
                        </div>
                        <div class="col-lg-4">
                            <label>User Update</label>
                            <input type="text" name="user_u" value="<?= $this->fungsi->user_login()->nama; ?>" class="form-control" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label>Update time</label>
                            <?php date_default_timezone_set('Asia/Jakarta'); ?>
                            <input type="text" name="date_update"
                                value="<?= date('d F Y H:i:s'); ?>"
                                class="form-control" readonly>
                        </div>
                        <div class="col-lg-4">
                            <br>
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button> |
                            <button type="reset" class="btn btn-sm btn-default"><i class="fa fa-undo"></i> Reset</button>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</section>