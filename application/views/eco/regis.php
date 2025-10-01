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
                    <?php echo form_open_multipart('eco/save'); ?>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label>Registration date</label>
                            <input type="text" name="regis_date" value="<?= date("d F Y H:i:s"); ?>" class="form-control" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label>Departement</label>
                            <input type="text" name="dept" value="<?= $this->fungsi->user_login()->dept; ?>" class="form-control" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label>Registrant</label>
                            <input type="text" name="regis_id" value="<?= $this->fungsi->user_login()->nama; ?>" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>Model</label>
                            <input type="text" name="model_pn" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label>Product name</label>
                            <input type="text" name="pn_name" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>IN ECO No.</label>
                            <input type="text" name="in_eco_num" class="form-control">
                            <br>
                            <input type="file" name="attachment1" required>
                        </div>
                        <div class="col-lg-6">
                            <label>KR ECO No.</label>
                            <input type="text" name="kr_eco_num" class="form-control">
                            <br>
                            <input type="file" name="attachment2" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label>Current stock</label>
                            <input type="text" name="cr_stock" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label>Effective date</label>
                            <input type="date" name="efect_date" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label>Expected exhaustion date</label>
                            <input type="date" name="expec-date" value="" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label>How to apply</label>
                            <input type="text" name="h-apply" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label>Drawing P/N</label>
                            <input type="text" name="dwg_pn" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label>Related Materials</label>
                            <input type="text" name="rm" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>Note</label>
                            <textarea name="ket" class="form-control"></textarea>
                        </div>
                        <div class="col-lg-6">
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