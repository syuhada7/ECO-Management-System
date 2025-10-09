<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fa fa-cubes"></i> ECO View Data</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('eco_public'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">ECO View Data</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <i class="fa fa-cubes"></i>
            <h3 class="box-title">ECO View Data</h3>
            <div class="pull-right">
                <Span hidden><?= $id = $this->fungsi->user_login()->id_user; ?></Span>
                <a href="<?= site_url('eco_public') ?>" class="btn btn-warning">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <th>No</th>
                    <th>Registration date</th>
                    <th>IN ECO</th>
                    <th>KR ECO</th>
                    <th>Registrant</th>
                    <th>Effective date</th>
                    <th>How to apply</th>
                    <th>Final status</th>
                    <th>Last stock confirmation date</th>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($row->result() as $key => $data) :
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $data->regis_date ?></td>
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
                            <td><?= $data->last_stock_date ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <h3>Material List</h3>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Material P/N</th>
                        <th>Current Stock</th>
                        <th>Effective date of change</th>
                        <th>Expected exhaustion date</th>
                        <th>Shipping available</th>
                        <th>Issue</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($row2->result() as $key => $m) : ?>
                        <tr>
                            <td class="highlight" data-id="<?= $m->id_eco ?>" data-pn="<?= $m->material_no ?>"><?= $m->material_no ?></td>
                            <td><?= $m->current_stock ?></td>
                            <td><?= date('y.m.d', strtotime($data->effec_date)) ?></td>
                            <td><?= date('y.m.d', strtotime($data->expec_date)) ?></td>
                            <td><?= $m->shipping_available ?></td>
                            <td><?= $m->issue ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <h3>Delivery Schedule</h3>
            <table id="deliveryTable" class="table table-bordered table-striped hidden">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Delivery schedule</th>
                        <th>Previous inventory</th>
                        <th>Quantity shipped</th>
                        <th>Current Stock</th>
                        <th>Shipped W/O</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <script>
                $(document).ready(function() {
                    $(".highlight").on("click", function() {
                        var id = $(this).data("id");
                        var pn = $(this).data("pn");

                        // Reset highlight
                        $(".highlight").removeClass("active");
                        $(this).addClass("active");

                        $.ajax({
                            url: "<?= site_url('eco_public/get_delivery/') ?>" + id + "/" + pn,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                var rows = "";
                                if (data.error) {
                                    rows = "<tr><td colspan='7' style='color:red'>" + data.error + "</td></tr>";
                                } else if (data.length > 0) {
                                    $.each(data, function(i, item) {
                                        rows += "<tr>" +
                                            "<td>" + (i + 1) + "</td>" +
                                            "<td>" + item.delivery_schedule + "</td>" +
                                            "<td>" + item.previous_inventory + "</td>" +
                                            "<td>" + item.quantity_shipped + "</td>" +
                                            "<td>" + item.current_stock + "</td>" +
                                            "<td>" + item.shipped_wio + "</td>" +
                                            "<td>" + (item.note || '') + "</td>" +
                                            "</tr>";
                                    });
                                } else {
                                    rows = "<tr><td colspan='7'>No delivery data found for " + pn + "</td></tr>";
                                }

                                $("#deliveryTable tbody").html(rows);
                                $("#deliveryTable").removeClass("hidden");
                            }
                        });
                    });
                });
            </script>
        </div>
    </div>
</section>