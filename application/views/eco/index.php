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
                    <th></th>
                    <th>Department</th>
                    <th>Registrations Date</th>
                    <th>Meeting Report</th>
                    <th>IN ECO</th>
                    <th>KR ECO</th>
                    <th>P/N Name</th>
                    <th>Registrant</th>
                    <th>Effective Date</th>
                    <th>How to Apply</th>
                    <th>Final Status</th>
                    <th>First Release Date</th>
                    <th>Drawing P/N</th>
                    <th>Details Materials</th>
                    <th>Views Approval</th>
                    <!-- <th>Details</th> -->
                </thead>
                <tbody>
                    <?php
                    foreach ($row->result() as $key => $data) :
                    ?>
                        <tr>
                            <td><a href="<?= site_url('eco/edit/' . $data->id_eco) ?>" class="btn btn-small btn-warning">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </td>
                            <td><?= $data->dept ?></td>
                            <td><?= $data->regis_date ?></td>
                            <td style="background-color: <?= empty($data->status1) ? 'red' : '' ?>">
                                <a href="<?= site_url('eco/meeting/' . $data->id_eco) ?>">
                                    <?= $data->status1 ?></a>
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
                            <td style="background-color: <?= empty($data->pn_name) ? 'red' : '' ?>">
                                <?= !empty($data->pn_name) ? $data->pn_name : '' ?>
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
                            <?php
                            $isInvalidDate = empty($data->first_release_date) || $data->first_release_date === '0000-00-00';
                            ?>
                            <td style="background-color: <?= $isInvalidDate ? 'red' : '' ?>" class="text-center">
                                <a href="<?= site_url('eco/inspection/' . $data->id_eco) ?>">
                                    <?= $isInvalidDate ? '<i class="fa fa-eye"></i>' : $data->first_release_date ?>
                                </a>
                            </td>
                            <td><?= $data->dwg_pn ?></td>
                            <td class="text-center">
                                <input type="checkbox"
                                    class="eco-detail-checkbox"
                                    value="<?= $data->id_eco ?>">
                            </td>
                            <?php
                            $approvals = [
                                $data->aproval1,
                                $data->aproval2,
                                $data->aproval3,
                                $data->aproval4,
                                $data->aproval5,
                                $data->aproval6,
                                $data->aproval7
                            ];

                            // Jika ada salah satu yang kosong → beri warna merah
                            $incomplete = in_array(null, $approvals, true) || in_array('', $approvals, true);

                            // Buat URL link
                            $link = site_url('eco/approval/' . $data->id_eco);
                            ?>
                            <td style="background-color: <?= $incomplete ? 'red' : '' ?>" class="text-center">
                                <a href="<?= $link ?>">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                            <!-- <td class="text-center">
                                <a href="<?= site_url('eco/details/' . $data->id_eco) ?>">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td> -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="box box-info box2" style="display:none;">
        <div class="box-header with-border">
            <h3 class="box-title">
                <i class="fa fa-info-circle"></i> Detail ECO
            </h3>
        </div>
        <div class="box-body" id="ecoDetailContent">
            <!-- Detail akan muncul di sini -->
        </div>
    </div>
</section>
<!-- /.content -->
<script>
    $(document).ready(function() {

        $('.eco-detail-checkbox').on('change', function() {

            // jika checkbox dicentang
            if ($(this).is(':checked')) {

                // uncheck checkbox lain (opsional)
                $('.eco-detail-checkbox').not(this).prop('checked', false);

                let id_eco = $(this).val();

                $.ajax({
                    url: "<?= site_url('eco/detail_ajax') ?>",
                    type: "POST",
                    data: {
                        id_eco: id_eco
                    },
                    dataType: "html",
                    success: function(response) {
                        $('.box2').slideDown();
                        $('#ecoDetailContent').html(response);
                    },
                    error: function() {
                        alert('Gagal mengambil data detail');
                    }
                });

            } else {
                $('.box2').slideUp();
                $('#ecoDetailContent').html('');
            }
        });

    });
</script>