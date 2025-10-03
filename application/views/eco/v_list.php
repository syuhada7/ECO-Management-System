<!DOCTYPE html>
<html>

<head>
    <title>Data ECO</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 10px 0;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }

        th {
            background: green;
            color: white;
        }

        .hidden {
            display: none;
        }

        .highlight {
            background: yellow;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <!-- Table Material -->
    <h3>Material List</h3>
    <table>
        <thead>
            <tr>
                <th>Material P/N</th>
                <th>Current Stock</th>
                <th>Effective date of change</th>
                <th>Expected exhaustion date</th>
                <th>Shipping available</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($materials as $m): ?>
                <tr>
                    <td class="highlight" data-id="<?= $m['material_no'] ?>"><?= $m['material_no'] ?></td>
                    <td><?= $m['stock'] ?></td>
                    <td><?= $m['effective_date'] ?></td>
                    <td><?= $m['exhaust_date'] ?></td>
                    <td><?= $m['shipping'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Table Delivery (kosong dulu, muncul saat klik Material) -->
    <h3>Delivery Schedule</h3>
    <table id="deliveryTable" class="hidden">
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
                var material = $(this).data("id");

                $.ajax({
                    url: "<?= site_url('eco/get_delivery/') ?>" + material,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var rows = "";
                        if (data.length > 0) {
                            $.each(data, function(i, item) {
                                rows += "<tr>" +
                                    "<td>" + (i + 1) + "</td>" +
                                    "<td>" + item.delivery_schedule + "</td>" +
                                    "<td>" + item.previous_inventory + "</td>" +
                                    "<td>" + item.quantity_shipped + "</td>" +
                                    "<td>" + item.current_stock + "</td>" +
                                    "<td>" + item.shipped_wio + "</td>" +
                                    "<td>" + item.note + "</td>" +
                                    "</tr>";
                            });
                        } else {
                            rows = "<tr><td colspan='7'>No delivery data found for " + material + "</td></tr>";
                        }

                        $("#deliveryTable tbody").html(rows);
                        $("#deliveryTable").removeClass("hidden");
                    }
                });
            });
        });
    </script>

</body>

</html>