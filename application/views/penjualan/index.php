<div class="content-area">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Penjualan Hari Ini</h4>
        <a href="<?= site_url('penjualan/create'); ?>" class="btn btn-primary">Transaksi Baru</a>
    </div>
    <div class="card p-3 panel-surface">
        <div class="table-responsive">
            <table class="table table-striped table-sm datatable align-middle">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Waktu</th>
                    <th class="text-end">Total</th>
                    <th class="text-end">Bayar</th>
                    <th class="text-end">Kembalian</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($penjualan as $row): ?>
                    <tr>
                        <td class="text-nowrap"><?= $row->kode_penjualan; ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($row->tanggal)); ?></td>
                        <td class="text-end">Rp <?= number_format($row->total, 0, ',', '.'); ?></td>
                        <td class="text-end">Rp <?= number_format($row->bayar, 0, ',', '.'); ?></td>
                        <td class="text-end">Rp <?= number_format($row->kembali, 0, ',', '.'); ?></td>
                        <td class="text-end">
                            <a href="<?= site_url('penjualan/show/'.$row->id_penjualan); ?>" class="btn btn-sm btn-outline-secondary text-dark detail-btn">Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
</div>

