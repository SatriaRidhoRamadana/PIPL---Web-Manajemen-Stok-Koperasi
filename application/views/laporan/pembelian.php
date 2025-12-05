<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Laporan Pembelian</h4>
    <button class="btn btn-primary" onclick="window.print();">Cetak</button>
</div>
<div class="card p-4">
    <?= form_open('laporan/pembelian', ['method' => 'get', 'class' => 'row g-3']); ?>
        <div class="col-md-4">
            <label class="form-label">Mulai</label>
            <input type="date" name="start_date" class="form-control" value="<?= $start_date; ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Sampai</label>
            <input type="date" name="end_date" class="form-control" value="<?= $end_date; ?>">
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button class="btn btn-primary w-100">Terapkan</button>
        </div>
    <?= form_close(); ?>

    <div class="table-responsive mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $grand = 0; ?>
                <?php foreach ($pembelian as $row): $grand += $row->total; ?>
                    <tr>
                        <td><?= $row->kode_pembelian; ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($row->tanggal)); ?></td>
                        <td class="text-end">Rp <?= number_format($row->total, 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="text-end">Grand Total</th>
                    <th class="text-end">Rp <?= number_format($grand, 0, ',', '.'); ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>


