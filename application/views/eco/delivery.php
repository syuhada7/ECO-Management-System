<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <i class="fa fa-edit"></i>
            <h3 class="box-title"> Delivery Schedule</h3>
            <div class="pull-right">
                <?php
                foreach ($row->result() as $key => $data) :
                ?>
                    <Span hidden><?= $id = $this->fungsi->user_login()->id_user; ?></Span>
                    <a href="<?= site_url('eco/v_list/' . $data->id_eco . '/' . $data->material_no) ?>" class="btn btn-warning">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <div class="header">
                    <img alt="Company Logo" height="150" src="<?= base_url() ?>uploads/logo/logo.png" width="200">
                </div>
            </div>
            <div class="row">
                <div class="col-lg">
                    <?php echo form_open_multipart('eco/save_delivery'); ?>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label>Registrant</label>
                            <input type="hidden" name="id_eco" value="<?= $data->id_eco ?>" class="form-control">
                            <input type="text" name="regis_id" value="<?= $this->fungsi->user_login()->nama; ?>" class="form-control" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label>Departement</label>
                            <input type="text" name="dept" value="<?= $this->fungsi->user_login()->dept; ?>" class="form-control" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label>Registration date</label>
                            <input type="text" name="regis_date" value="<?= date("d F Y H:i:s"); ?>" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label>Delivery date</label>
                            <input type="date" name="delivery_date" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label>Materials</label>
                            <input type="text" name="material_no" value="<?= $data->material_no ?>" class="form-control" readonly>
                        </div>
                        <div class="col-lg-4">
                            <label>Current Stock</label>
                            <input type="text" id="current_stock" name="previous_inventory" value="<?= $data->current_stock ?>" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>Qty Shipped</label>
                            <input type="number" id="qty_shipped" name="quantity_shipped" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label>Last Stcok</label>
                            <input type="number" id="last_stock" name="current_stock" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-4">
                            <label>Shipping WO</label>
                            <input type="text" name="shipped_wio" class="form-control">
                        </div>
                        <div class="col-lg-4">
                            <label>Note</label>
                            <textarea name="note" class="form-control"></textarea>
                        </div>
                        <div class="col-lg-4">
                            <br>
                            <button type="submit" id="btnSave" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Save</button> |
                            <button type="reset" class="btn btn-sm btn-default"><i class="fa fa-undo"></i> Reset</button>
                        </div>
                    </div>
                <?php endforeach; ?>
                <?php echo form_close(); ?>
                <script>
                    $(document).ready(function() {
                        $('#qty_shipped').on('input', function() {
                            let current = parseFloat($('#current_stock').val()) || 0;
                            let shipped = parseFloat($(this).val()) || 0;
                            let last = current - shipped;

                            // tampilkan hasil pengurangan
                            $('#last_stock').val(last >= 0 ? last : 0);

                            // jika melebihi stok, sembunyikan tombol Save
                            if (shipped > current) {
                                $('#btnSave').addClass('hidden');
                            } else {
                                $('#btnSave').removeClass('hidden');
                            }
                        });
                    });
                </script>
                </div>
            </div>
        </div>
    </div>
</section>