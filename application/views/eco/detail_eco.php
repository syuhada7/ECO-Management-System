<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-center">Sub Material</th>
            <th class="text-center">Current Stock</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>

        <?php
        $rowspan = count($eco_rows);
        foreach ($eco_rows as $i => $row):
        ?>
            <tr style="background-color: <?= ($row->current_stock === '' ? '#f8d7da' : '') ?>" class="text-center">
                <td>
                    <?= $row->material_no ?>
                </td>
                <td>
                    <span class="label label-<?= $row->current_stock > 0 ? 'success' : 'danger' ?>">
                        <?= $row->current_stock ?>
                    </span>
                </td>
                <td>
                    <a href="<?= site_url('eco/v_list/' . $row->id_eco . '/' . $row->material_no) ?>">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>