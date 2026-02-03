<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Model</th>
            <th>Part Number</th>
            <th>Sub Material</th>
            <th>Current Stock</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $rowspan = count($eco_rows);
        foreach ($eco_rows as $i => $row):
        ?>
            <tr style="background-color: <?= ($row->cr_stock === '' ? '#f8d7da' : '') ?>" class="text-center">

                <td>
                    <?= $row->model_pn ?>
                </td>
                <td><?= $row->pn_number ?></td>
                <td>
                    <a href="<?= site_url('eco_public/v_list/' . $row->id_eco) ?>">
                        <?= $row->rm ?>
                    </a>
                </td>
                <td>
                    <span class="label label-<?= $row->cr_stock > 0 ? 'success' : 'danger' ?>">
                        <?= $row->cr_stock ?>
                    </span>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>