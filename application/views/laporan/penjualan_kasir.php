<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Laporan Penjualan Harian</h4>
    <button class="btn btn-primary" onclick="window.print();">Cetak</button>
</div>
<div class="card p-4">
    <p class="text-muted mb-3">Tanggal: <?= date('d/m/Y'); ?></p>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Waktu</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php $grand = 0; ?>
                <?php foreach ($penjualan as $row): $grand += $row->total; ?>
                    <tr>
                        <td><?= $row->kode_penjualan; ?></td>
                        <td><?= date('H:i', strtotime($row->tanggal)); ?></td>
                        <td class="text-end">Rp <?= number_format($row->total, 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($penjualan)): ?>
                    <tr><td colspan="3" class="text-center text-muted">Belum ada transaksi</td></tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="2" class="text-end">Total</th>
                    <th class="text-end">Rp <?= number_format($grand, 0, ',', '.'); ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

