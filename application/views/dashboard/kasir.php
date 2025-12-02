<div class="row">
    <div class="col-lg-4">
        <div class="card p-4 text-center">
            <h5>Transaksi Baru</h5>
            <p class="text-muted">Mulai proses penjualan</p>
            <a href="<?= site_url('penjualan/create'); ?>" class="btn btn-primary">Buat Transaksi</a>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Riwayat Hari Ini</h5>
                <small><?= date('d/m/Y'); ?></small>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Waktu</th>
                            <th class="text-end">Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $row): ?>
                            <tr>
                                <td><?= $row->kode_penjualan; ?></td>
                                <td><?= date('H:i', strtotime($row->tanggal)); ?></td>
                                <td class="text-end">Rp <?= number_format($row->total, 0, ',', '.'); ?></td>
                                <td class="text-end">
                                    <a href="<?= site_url('penjualan/show/'.$row->id_penjualan); ?>" class="btn btn-sm btn-outline-primary">Detail</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($transactions)): ?>
                            <tr><td colspan="4" class="text-center text-muted">Belum ada transaksi</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

