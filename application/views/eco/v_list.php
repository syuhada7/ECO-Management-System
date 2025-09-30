<style>
    body {
        font-family: Arial, sans-serif;
    }

    h2 {
        margin-bottom: 10px;
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 1px solid #333;
        padding: 8px;
        text-align: center;
    }

    th {
        background-color: #4caf50;
        color: #fff;
    }

    .sub-title {
        background-color: #388e3c;
        color: #fff;
        font-weight: bold;
    }

    .btn-link {
        display: inline-block;
        background: #1976d2;
        color: #fff;
        padding: 6px 12px;
        text-decoration: none;
        margin: 10px 0;
    }

    .btn-link:hover {
        background: #125a9c;
    }
</style>
<?php
// Dummy data - nanti bisa diganti dari database
$header = [
    "no" => "01",
    "registration_date" => "2025.07.01",
    "in_eco" => "ELOB3062205",
    "in_eco_mgr" => "Rink",
    "kr_eco" => "ELOB3062205",
    "kr_eco_mgr" => "Rink",
    "registrant" => "Agung",
    "effective_date" => "25.07.08",
    "how_to_apply" => "Running Change",
    "final_status" => "In progress/complete",
    "last_stock_confirm" => "25.07.20"
];

$material = [
    "pn" => "MCK12345601",
    "stock" => "2000",
    "effective_change" => "25.10.01",
    "expected_exhaustion" => "25.09.01",
    "shipping" => "possible",
    "issue" => ""
];

$history = [
    [
        "no" => "01",
        "delivery_schedule" => "25.08.15",
        "previous_inventory" => "2000",
        "quantity_shipped" => "500",
        "current_stock" => "1500",
        "shipped_wo" => "JOK015LB",
        "note" => ""
    ]
];
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1><i class="fa fa-list"></i> ECO Views Data</h1>
    <ol class="breadcrumb">
        <li><a href="<?= base_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Views Detail ECO</li>
    </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <i class="fa fa-list"></i>
            <h3 class="box-title">Views Data ECO</h3>
            <div class="pull-right">
            </div>
        </div>
        <div class="box-body table-responsive">
            <!-- Header Table -->
            <table>
                <tr>
                    <th>No.</th>
                    <th>Registration date</th>
                    <th>IN ECO</th>
                    <th></th>
                    <th>KR ECO</th>
                    <th></th>
                    <th>registrant</th>
                    <th>Effective date</th>
                    <th>How to apply</th>
                    <th>Final Status</th>
                    <th>Last stock confirmation date</th>
                </tr>
                <tr>
                    <td><?= $header["no"] ?></td>
                    <td><?= $header["registration_date"] ?></td>
                    <td><?= $header["in_eco"] ?></td>
                    <td><?= $header["in_eco_mgr"] ?></td>
                    <td><?= $header["kr_eco"] ?></td>
                    <td><?= $header["kr_eco_mgr"] ?></td>
                    <td><?= $header["registrant"] ?></td>
                    <td><?= $header["effective_date"] ?></td>
                    <td><?= $header["how_to_apply"] ?></td>
                    <td><?= $header["final_status"] ?></td>
                    <td><?= $header["last_stock_confirm"] ?></td>
                </tr>
            </table>

            <!-- Material Detail -->
            <table>
                <tr class="sub-title">
                    <th>Material P/N</th>
                    <th>Current Stock</th>
                    <th>Effective date of change</th>
                    <th>Expected exhaustion date</th>
                    <th>Shipping available</th>
                    <th>ISSUE</th>
                </tr>
                <tr>
                    <td><?= $material["pn"] ?></td>
                    <td><?= $material["stock"] ?></td>
                    <td><?= $material["effective_change"] ?></td>
                    <td><?= $material["expected_exhaustion"] ?></td>
                    <td><?= $material["shipping"] ?></td>
                    <td><?= $material["issue"] ?></td>
                </tr>
            </table>

            <!-- Link -->
            <a href="#history" class="btn-link">Click to view detailed history</a>

            <!-- History Detail -->
            <table id="history">
                <tr class="sub-title">
                    <th>No.</th>
                    <th>Delivery schedule</th>
                    <th>Previous inventory</th>
                    <th>Quantity shipped</th>
                    <th>Current Stock</th>
                    <th>Shipped W/O</th>
                    <th>note</th>
                </tr>
                <?php foreach ($history as $row): ?>
                    <tr>
                        <td><?= $row["no"] ?></td>
                        <td><?= $row["delivery_schedule"] ?></td>
                        <td><?= $row["previous_inventory"] ?></td>
                        <td><?= $row["quantity_shipped"] ?></td>
                        <td><?= $row["current_stock"] ?></td>
                        <td><?= $row["shipped_wo"] ?></td>
                        <td><?= $row["note"] ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</section>
<!-- /.content -->