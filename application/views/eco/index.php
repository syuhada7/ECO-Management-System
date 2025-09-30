<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fa fa-list"></i> ECO Data List</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">ECO Data List</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <i class="fa fa-list"></i>
            <h3 class="box-title">List Data ECO</h3>
            <div class="pull-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-flat"><a href="<?= site_url('eco/regis') ?>">Created</a></button>
                </div>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <th>No</th>
                    <th>Departement</th>
                    <th>Registrations Date</th>
                    <th>Status</th>
                    <th>Model</th>
                    <th>P/N Name</th>
                    <th>IN ECO</th>
                    <th>KR ECO</th>
                    <th>Registrant</th>
                    <th>Effective Date</th>
                    <th>How to Apply</th>
                    <th>Final Status</th>
                    <th>Last Stock</th>
                    <th>Views</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($row->result() as $key => $data) :
                        $no = 1;
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data->dept ?></td>
                            <td><?= $data->regis_date ?></td>
                            <td><a href=""><?= $data->status1 ?></a></td>
                            <td><?= $data->model_pn ?></td>
                            <td><?= $data->pn_name ?></td>
                            <td><a href=""><?= $data->in_eco_num ?></a></td>
                            <td><a href=""><?= $data->kr_eco_num ?></a></td>
                            <td><?= $data->register ?></td>
                            <td><?= $data->effec_date ?></td>
                            <td><?= $data->h_apply ?></td>
                            <td><a href=""><?= $data->status2 ?></a></td>
                            <td><?= $data->last_stock ?></td>
                            <td><a href="<?= site_url('eco/v_list') ?>"><i class="fa fa-eye"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- /.content -->