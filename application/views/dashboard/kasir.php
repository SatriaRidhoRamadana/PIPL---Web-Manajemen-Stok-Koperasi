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
            <h5 class="mb-3">Riwayat Penjualan</h5>
            <?= form_open('dashboard', ['method' => 'get', 'class' => 'row g-2 mb-3']); ?>
                <div class="col-md-4">
                    <input type="date" name="start_date" class="form-control form-control-sm" value="<?= $start_date; ?>" placeholder="Mulai">
                </div>
                <div class="col-md-4">
                    <input type="date" name="end_date" class="form-control form-control-sm" value="<?= $end_date; ?>" placeholder="Sampai">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary btn-sm w-100">Terapkan</button>
                </div>
            <?= form_close(); ?>
            <div class="table-responsive">
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

