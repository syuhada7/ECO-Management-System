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
                    <input type="hidden" name="id_eco" value="<?= $row->id_eco ?>">
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label>Registration date</label>
                            <?php date_default_timezone_set('Asia/Jakarta'); ?>
                            <input type="text" name="regis_date"
                                value="<?= $row->regis_date ?>"
                                class="form-control" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label>Departement</label>
                            <input type="text" name="dept" value="<?= $row->dept ?>" class="form-control" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label>Registrant</label>
                            <input type="text" name="regis_id" value="<?= $row->register ?>" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>IN ECO No.</label>
                            <input type="text" name="in_eco_num" value="<?= $row->in_eco_num ?>" class="form-control">
                            <br>
                            <input type="file" name="attachment1">
                            <?php if ($row->in_eco_path): ?>
                                <small>Current File: <?= $row->in_eco_path ?></small>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-6">
                            <label>KR ECO No.</label>
                            <input type="text" name="kr_eco_num" value="<?= $row->kr_eco_num ?>" class="form-control">
                            <br>
                            <input type="file" name="attachment2">
                            <?php if ($row->kr_eco_path): ?>
                                <small>Current File: <?= $row->kr_eco_path ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label>Model</label>
                            <div id="model_wrapper">
                                <?php foreach ($detail_eco as $m): ?>
                                    <div class="input-group mb-1">
                                        <input type="text" name="model_pn[]" value="<?= $m->model_pn ?>" class="form-control">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger remove-field">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </span>
                                    </div>
                                <?php endforeach; ?>
                                <button type="button" class="btn btn-success btn-xs add-model">
                                    <i class="fa fa-plus"></i> Add
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>Product Name</label>
                            <input type="text" name="pn_name" value="<?= $row->pn_name ?>" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label>Part Number</label>
                            <div id="pn_wrapper">
                                <?php foreach ($detail_eco as $m): ?>
                                    <div class="input-group mb-1">
                                        <input type="text" name="pn_number[]" value="<?= $m->pn_number ?>" class="form-control">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger remove-field">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </span>
                                    </div>
                                <?php endforeach; ?>
                                <button type="button" class="btn btn-success btn-xs add-pn">
                                    <i class="fa fa-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label>Effective date</label>
                            <input type="date" name="efect_date" value="<?= $row->effec_date ?>" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label>Expected exhaustion date</label>
                            <input type="date" name="expec_date" value="<?= $row->expec_date ?>" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label>How to apply</label>
                            <input type="text" name="h-apply" value="<?= $row->h_apply ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>Related Sub Materials</label>
                            <div id="rm_wrapper">
                                <?php foreach ($detail_eco as $m): ?>
                                    <div class="input-group mb-1">
                                        <input type="text" name="rm[]" value="<?= $m->rm ?>" class="form-control">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger remove-field">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </span>
                                    </div>
                                <?php endforeach; ?>
                                <button type="button" class="btn btn-success btn-xs add-rm">
                                    <i class="fa fa-plus"></i> Add
                                </button>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Current Stock</label>
                            <div id="stock_wrapper">
                                <?php foreach ($detail_eco as $m): ?>
                                    <div class="input-group mb-1">
                                        <input type="text" name="cr_stock[]" value="<?= $m->cr_stock ?>" class="form-control">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-danger remove-field">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </span>
                                    </div>
                                <?php endforeach; ?>
                                <button type="button" class="btn btn-success btn-xs add-stock">
                                    <i class="fa fa-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label>Drawing P/N</label>
                            <input type="text" name="dwg_pn" value="<?= $row->dwg_pn ?>" class="form-control">
                        </div>
                        <div class="col-lg-8">
                            <label>Note</label>
                            <textarea name="ket" class="form-control"><?= $row->ket ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
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
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function() {

        function addField(wrapper, name) {
            let html = `
        <div class="input-group mb-1">
            <input type="text" name="` + name + `[]" class="form-control">
            <span class="input-group-btn">
                <button type="button" class="btn btn-danger remove-field">
                    <i class="fa fa-minus"></i>
                </button>
            </span>
        </div>`;
            $(wrapper).append(html);
        }

        $('.add-model').click(() => addField('#model_wrapper', 'model_pn'));
        $('.add-pn').click(() => addField('#pn_wrapper', 'pn_number'));
        $('.add-rm').click(() => addField('#rm_wrapper', 'rm'));
        $('.add-stock').click(() => addField('#stock_wrapper', 'cr_stock'));

        $(document).on('click', '.remove-field', function() {
            $(this).closest('.input-group').remove();
        });

    });
</script>