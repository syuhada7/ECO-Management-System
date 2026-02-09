<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <i class="fa fa-edit"></i>
            <h3 class="box-title"> ECO Details</h3>
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
                    <img alt="Company Logo" height="100" src="<?= base_url() ?>uploads/logo/logo.png" width="150">
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                    <?php
                    foreach ($row->result() as $key => $data) :
                    ?>
                        <tr>
                            <th>Department</th>
                            <td><?= $data->dept ?></td>
                        </tr>
                        <tr>
                            <th>Registrations Date</th>
                            <td><?= $data->regis_date ?></td>
                        </tr>
                        <tr>
                            <th>Meeting Report</th>
                            <td>
                                <a href="<?= site_url('eco/meeting/' . $data->id_eco) ?>">
                                    <?= $data->status1 ?></a>
                            </td>
                        </tr>
                        <tr>
                            <th>IN ECO</th>
                            <td>
                                <a href="<? site_url('uploads/eco_file/' . rawurlencode($data->in_eco_path)) ?>" target="_blank"><?= $data->in_eco_num ?></a>
                            </td>
                        </tr>
                        <tr>
                            <th>KR ECO</th>
                            <td>
                                <a href="<? site_url('uploads/eco_file/' . rawurlencode($data->kr_eco_path)) ?>" target="_blank"><?= $data->kr_eco_num ?></a>
                            </td>
                        </tr>
                        <tr>
                            <th>P/N Name</th>
                            <td>
                                <?= $data->pn_name ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Model</th>
                            <?php
                            $rowspan = count($eco_rows);
                            foreach ($eco_rows as $i => $row):
                            ?>
                                <td>
                                    <?= $row->model_pn ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                        <tr>
                            <th>Part Number</th>
                            <?php
                            $rowspan = count($eco_rows);
                            foreach ($eco_rows as $i => $row):
                            ?>
                                <td>
                                    <?= $row->pn_number ?>
                                </td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>