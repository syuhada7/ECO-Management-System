<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fa fa-list"></i> ECO First Release Date</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('eco_public'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">ECO First Release Date</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <i class="fa fa-list"></i>
            <h3 class="box-title">ECO Inspection QC</h3>
        </div>

        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <?php foreach ($row->result() as $key => $data) : ?>

                    <!-- Tampilkan gambar jika sudah ada -->
                    <?php if (!empty($data->img_qc)) : ?>
                        <div style="display:inline-block; margin:8px; text-align:center;">
                            <img src="<?= site_url('uploads/eco_file/' . $data->img_qc) ?>"
                                alt="Meeting File"
                                style="width:auto; height:auto; border:1px solid #ccc; padding:4px; max-width:500px;">
                        </div>
                    <?php endif; ?>
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