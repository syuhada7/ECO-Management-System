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
                            <?php date_default_timezone_set('Asia/Jakarta'); ?>
                            <input type="text" name="regis_date"
                                value="<?= date('d F Y H:i:s'); ?>"
                                class="form-control" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label>Departement</label>
                            <input type="text" name="dept" value="<?= $this->fungsi->user_login()->dept; ?>" class="form-control" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label>Registrant</label>
                            <input type="text" name="regis_id" value="<?= $this->fungsi->user_login()->nama; ?>" class="form-control" readonly>
                            <input type="hidden" name="id_eco" value="<?= $next_id ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>IN ECO No.</label>
                            <input type="text" name="in_eco_num" class="form-control">
                            <br>
                            <input type="file" name="attachment1" required>
                            <span><b>*Require upload file : html,pdf,jpeg,jpg,png</b></span>
                        </div>
                        <div class="col-lg-6">
                            <label>KR ECO No.</label>
                            <input type="text" name="kr_eco_num" class="form-control">
                            <br>
                            <input type="file" name="attachment2" required>
                            <span><b>*Require upload file : html,pdf,jpeg,jpg,png</b></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label>Model</label>
                            <div id="model_wrapper">
                                <div class="input-group mb-1">
                                    <input type="text" name="model_pn[]" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success add-model">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <label>Product name</label>
                            <input type="text" name="pn_name" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label>Part Number</label>
                            <div id="pn_wrapper">
                                <div class="input-group mb-1">
                                    <input type="text" name="pn_number[]" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success add-pn">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-3">
                            <label>Effective date</label>
                            <input type="date" name="efect_date" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Expected exhaustion date</label>
                            <input type="date" name="expec_date" value="" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>How to apply</label>
                            <input type="text" name="h_apply" class="form-control">
                        </div>
                        <div class="col-lg-3">
                            <label>Drawing P/N</label>
                            <input type="text" name="dwg_pn" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>Related Sub Materials</label>
                            <div id="rm_wrapper">
                                <div class="input-group mb-1">
                                    <input type="text" name="rm[]" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success add-rm">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label>Current stock</label>
                            <div id="stock_wrapper">
                                <div class="input-group mb-1">
                                    <input type="text" name="cr_stock[]" class="form-control">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-success add-stock">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {

        function addField(wrapper, inputName) {
            var html = `
        <div class="input-group mb-1">
            <input type="text" name="` + inputName + `[]" class="form-control">
            <span class="input-group-btn">
                <button type="button" class="btn btn-danger remove-field">
                    <i class="fa fa-minus"></i>
                </button>
            </span>
        </div>`;
            $(wrapper).append(html);
        }

        $('.add-model').click(function() {
            addField('#model_wrapper', 'model_pn');
        });

        $('.add-pn').click(function() {
            addField('#pn_wrapper', 'pn_number');
        });

        $('.add-rm').click(function() {
            addField('#rm_wrapper', 'rm');
        });

        $('.add-stock').click(function() {
            addField('#stock_wrapper', 'cr_stock');
        });

        $(document).on('click', '.remove-field', function() {
            $(this).closest('.input-group').remove();
        });

    });
</script>
<script>
    function checkDuplicate(inputName, currentInput) {
        let values = [];
        let isDuplicate = false;
        let currentVal = $(currentInput).val().trim().toLowerCase();

        if (currentVal === '') return false;

        $('input[name="' + inputName + '[]"]').each(function() {
            let val = $(this).val().trim().toLowerCase();
            if (val !== '') {
                if (values.includes(val)) {
                    isDuplicate = true;
                    return false;
                }
                values.push(val);
            }
        });

        return isDuplicate;
    }

    // MODEL
    $(document).on('blur', 'input[name="model_pn[]"]', function() {
        if (checkDuplicate('model_pn', this)) {
            alert('Model tidak boleh duplicate!');
            $(this).val('').focus();
        }
    });

    // PART NUMBER
    $(document).on('blur', 'input[name="pn_number[]"]', function() {
        if (checkDuplicate('pn_number', this)) {
            alert('Part Number tidak boleh duplicate!');
            $(this).val('').focus();
        }
    });

    // RELATED SUB MATERIAL
    $(document).on('blur', 'input[name="rm[]"]', function() {
        if (checkDuplicate('rm', this)) {
            alert('Related Sub Material tidak boleh duplicate!');
            $(this).val('').focus();
        }
    });

    // Cegah submit kalau masih ada duplicate
    $('form').on('submit', function(e) {
        let fields = ['model_pn', 'pn_number', 'rm'];
        let hasDuplicate = false;

        fields.forEach(function(field) {
            let vals = [];
            $('input[name="' + field + '[]"]').each(function() {
                let v = $(this).val().trim().toLowerCase();
                if (v !== '') {
                    if (vals.includes(v)) {
                        hasDuplicate = true;
                        return false;
                    }
                    vals.push(v);
                }
            });
        });

        if (hasDuplicate) {
            alert('Masih ada data duplicate. Mohon periksa kembali!');
            e.preventDefault();
        }
    });
</script>