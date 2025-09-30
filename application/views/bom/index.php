<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fa fa-list"></i> BOM Data</h1>
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
            </div>
        </div>
        <div class="box-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <th>Part-No</th>
                    <th>Part Name</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($row->result() as $key => $data) : ?>
                        <tr>
                            <td><?= $data->part_no ?></td>
                            <td><?= $data->part_name ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<!-- /.content -->