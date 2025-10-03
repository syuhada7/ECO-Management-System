<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fa fa-list"></i> ECO Meeting Report</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">ECO Meeting Report</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <i class="fa fa-list"></i>
            <h3 class="box-title">ECO Meeting Report</h3>
            <div class="pull-right">
                <div class="btn-group">
                    <button type="button" class="btn btn-default btn-flat"><a href="<?= site_url('#') ?>">File <i class="fa fa-eye"></i></a></button>
                </div>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <div style="display:inline-block; margin:8px; text-align:center;">
                        <img src="<?= site_url('uploads/eco_file/eco_meeting_materials.png') ?>" style="width:auto; height:auto; border:1px solid #ccc; padding:4px;">
                    </div>
                    <th colspan="5">Approval</th>
                    </th>
                </thead>
                <tbody>
                    <td>R&D</td>
                    <td>Materials</td>
                    <td>QC</td>
                    <td>Assy</td>
                    <td>Injection</td>
                </tbody>
                <tfoot>
                    <td>Approved</td>
                    <td>Approved</td>
                    <td>Approved</td>
                    <td>Approved</td>
                    <td>Approved</td>
                </tfoot>
            </table>
        </div>
    </div>
</section>
<!-- /.content -->