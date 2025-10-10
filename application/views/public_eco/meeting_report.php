<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fa fa-list"></i> ECO Meeting Report</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('eco_public'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">ECO Meeting Report</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <i class="fa fa-list"></i>
            <h3 class="box-title">ECO Meeting Report</h3>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <?php
                foreach ($row->result() as $key => $data) :
                ?>
                    <div style="display:inline-block; margin:8px; text-align:center;">
                        <img src="<?= site_url('uploads/eco_file/' . $data->img_meeting) ?>" style="width:auto; height:auto; border:1px solid #ccc; padding:4px;">
                    </div>
                    <thead>
                        <th colspan="5">Approval</th>
                        </th>
                    </thead>
                    <tbody>
                        <td>R&D</td>
                        <td>Materials</td>
                        <td>QC</td>
                        <td>PPIC</td>
                        <td>Molding</td>
                        <td>Injection</td>
                        <td>Assy</td>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><?= $data->aproval1 ?></td>
                            <td><?= $data->aproval2 ?></td>
                            <td><?= $data->aproval3 ?></td>
                            <td><?= $data->aproval4 ?></td>
                            <td><?= $data->aproval5 ?></td>
                            <td><?= $data->aproval6 ?></td>
                            <td><?= $data->aproval7 ?></td>
                        </tr>
                    </tfoot>
                <?php endforeach; ?>
            </table>
            <br>
            <div class="pull-right">
                <div class="btn-group">
                    <a href="<?= site_url('eco_public') ?>" class="btn btn-warning">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->