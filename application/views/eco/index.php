<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fa fa-cubes"></i> ECO Data List</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">ECO Data List</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <i class="fa fa-cubes"></i>
            <h3 class="box-title">List Data ECO</h3>
            <div class="pull-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-flat"><a href="<?= site_url('eco/regis') ?>"><i class="fa fa-plus"> Created</i></a></button>
                </div>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <th>No</th>
                    <th>Departement</th>
                    <th>Registrations Date</th>
                    <th>Meeting Report</th>
                    <th>Model</th>
                    <th>P/N Name</th>
                    <th>IN ECO</th>
                    <th>KR ECO</th>
                    <th>Registrant</th>
                    <th>Effective Date</th>
                    <th>How to Apply</th>
                    <th>Final Status</th>
                    <th>First Release Date</th>
                    <th>Drawing P/N</th>
                    <th>Related Materials</th>
                    <th>Last Stock Date</th>
                    <th>Views Approval</th>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($row->result() as $key => $data) :
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data->dept ?></td>
                            <td><?= $data->regis_date ?></td>
                            <td><a href="<?= site_url('eco/meeting') ?>"><?= $data->status1 ?></a></td>
                            <td><?= $data->model_pn ?></td>
                            <td style="background-color: <?= empty($data->pn_name) ? 'red' : '' ?>">
                                <?= !empty($data->pn_name) ? $data->pn_name : '' ?>
                            </td>
                            <td style="background-color: 
                                <?=
                                (empty($data->in_eco_num) && empty($data->in_eco_path)) ? 'red' : ((empty($data->in_eco_num) || empty($data->in_eco_path)) ? 'yellow' : 'transparent')
                                ?>">
                                <?= !empty($data->in_eco_path)
                                    ? '<a href="' . site_url('uploads/eco_file/' . rawurlencode($data->in_eco_path)) . '" target="_blank">' . ($data->in_eco_num ?: "—") . '</a>'
                                    : ($data->in_eco_num ?: "—")
                                ?>
                            </td>
                            <td style="background-color: 
                                <?=
                                (empty($data->kr_eco_num) && empty($data->kr_eco_path)) ? 'red' : ((empty($data->kr_eco_num) || empty($data->kr_eco_path)) ? 'yellow' : 'transparent')
                                ?>">
                                <?= !empty($data->kr_eco_path)
                                    ? '<a href="' . site_url('uploads/eco_file/' . rawurlencode($data->kr_eco_path)) . '" target="_blank">' . ($data->kr_eco_num ?: "—") . '</a>'
                                    : ($data->kr_eco_num ?: "—")
                                ?>
                            </td>
                            <td><?= $data->register ?></td>
                            <td style="background-color:
                                <?php
                                $diff = (strtotime($data->effec_date) - time()) / 86400;
                                echo ($diff < 0) ? 'red' : (($diff <= 10) ? 'yellow' : '');
                                ?>">
                                <?= $data->effec_date ?>
                            </td>
                            <td><?= $data->h_apply ?></td>
                            <td><?= $data->status2 ?></td>
                            <td><a href=""><?= $data->fisrt_stcok ?></td>
                            <td><a href=""><?= $data->dwg_pn ?></td>
                            <td><a href=""><?= $data->rm ?></td>
                            <td><a href=""><?= $data->last_stock ?></td>
                            <td><a href="<?= site_url('eco/v_list') ?>"><i class="fa fa-eye"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- /.content -->