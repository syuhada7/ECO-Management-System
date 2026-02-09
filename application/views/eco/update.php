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
                    <?= form_open_multipart('eco/update'); ?>
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
                            <input type="hidden" name="old_attachment1" value="<?= $row->in_eco_path ?>">
                            <input type="file" name="attachment1">
                            <?php if ($row->in_eco_path): ?>
                                <small>Current File: <?= $row->in_eco_path ?></small>
                            <?php endif; ?>
                            <br>
                            <span><b>*Require upload file : html,pdf,jpeg,jpg,png</b></span>
                        </div>
                        <div class="col-lg-6">
                            <label>KR ECO No.</label>
                            <input type="text" name="kr_eco_num" value="<?= $row->kr_eco_num ?>" class="form-control">
                            <br>
                            <input type="hidden" name="old_attachment2" value="<?= $row->kr_eco_path ?>">
                            <input type="file" name="attachment2">
                            <?php if ($row->kr_eco_path): ?>
                                <small>Current File: <?= $row->kr_eco_path ?></small>
                            <?php endif; ?>
                            <br>
                            <span><b>*Require upload file : html,pdf,jpeg,jpg,png</b></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label>Model</label>
                            <div id="model_wrapper">
                                <?php
                                $model_unique = [];
                                foreach ($e_model as $m) {
                                    if (!in_array($m->model_pn, $model_unique)) {
                                        $model_unique[] = $m->model_pn;
                                ?>
                                        <div class="input-group mb-1">
                                            <input type="text" name="model_pn[]" value="<?= $m->model_pn ?>" class="form-control">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-danger remove-field">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </span>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
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
                                <?php
                                $pn_unique = [];
                                foreach ($e_model as $m) {
                                    if (!in_array($m->pn_number, $pn_unique)) {
                                        $pn_unique[] = $m->pn_number;
                                ?>
                                        <div class="input-group mb-1">
                                            <input type="text" name="pn_number[]" value="<?= $m->pn_number ?>" class="form-control">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-danger remove-field">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </span>
                                        </div>
                                <?php
                                    }
                                }
                                ?>
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
                            <input type="text" name="h_apply" value="<?= $row->h_apply ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>Related Sub Materials</label>
                            <div id="rm_wrapper">
                                <?php foreach ($material as $rm): ?>
                                    <div class="input-group mb-1">
                                        <input type="text" name="rm[]" value="<?= $rm->material_no ?>" class="form-control">
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
                                <?php foreach ($material as $rm): ?>
                                    <div class="input-group mb-1">
                                        <input type="text" name="cr_stock[]" value="<?= $rm->current_stock ?>" class="form-control">
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
                                value="<?= date('Y-m-d H:i:s'); ?>"
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
<script>
    function checkDuplicate(name) {
        let values = [];
        let duplicate = false;

        $('input[name="' + name + '[]"]').each(function() {
            let val = $(this).val().trim().toLowerCase();
            if (val !== '') {
                if (values.includes(val)) {
                    duplicate = true;
                    return false;
                }
                values.push(val);
            }
        });

        return duplicate;
    }

    // realtime check
    $(document).on('blur', 'input[name="model_pn[]"]', function() {
        if (checkDuplicate('model_pn')) {
            alert('Model tidak boleh duplicate');
            $(this).val('').focus();
        }
    });

    $(document).on('blur', 'input[name="pn_number[]"]', function() {
        if (checkDuplicate('pn_number')) {
            alert('Part Number tidak boleh duplicate');
            $(this).val('').focus();
        }
    });

    $(document).on('blur', 'input[name="rm[]"]', function() {
        if (checkDuplicate('rm')) {
            alert('Related Sub Material tidak boleh duplicate');
            $(this).val('').focus();
        }
    });

    // block submit
    $('form').on('submit', function(e) {
        if (
            checkDuplicate('model_pn') ||
            checkDuplicate('pn_number') ||
            checkDuplicate('rm')
        ) {
            alert('Masih ada data duplicate. Mohon dicek kembali.');
            e.preventDefault();
        }
    });
</script>