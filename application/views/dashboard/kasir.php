<div class="row">
    <div class="col-lg-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="mb-0">Riwayat Penjualan</h5>
                <small class="text-muted">Periode: <?= date('d/m/Y', strtotime($start_date)); ?> - <?= date('d/m/Y', strtotime($end_date)); ?></small>
            </div>
            <?= form_open('dashboard', ['method' => 'get', 'class' => 'row g-2 mb-3']); ?>
    </div>
    <div class="col-lg-8">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="mb-0">Riwayat Penjualan</h5>
                <small class="text-muted">Periode: <?= date('d/m/Y', strtotime($start_date)); ?> - <?= date('d/m/Y', strtotime($end_date)); ?></small>
            </div>
            <?= form_open('dashboard', ['method' => 'get', 'class' => 'row g-2 mb-3']); ?>
                <div class="col-md-4">
                    <input type="date" name="start_date" class="form-control form-control-sm" value="<?= $start_date; ?>" placeholder="Mulai">

            <div class="row g-2 mb-3">
                <div class="col-md-4">
                    <div class="card border-primary">
                        <div class="card-body py-2 text-center">
                            <div class="text-muted small">Total Transaksi</div>
                            <div class="fw-bold h5 mb-0"><?= $total_transaksi; ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-success">
                        <div class="card-body py-2 text-center">
                            <div class="text-muted small">Total Omzet</div>
                            <div class="fw-bold h5 mb-0 text-success">Rp <?= number_format($total_omzet, 0, ',', '.'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-info">
                        <div class="card-body py-2 text-center">
                            <div class="text-muted small">Rata/Transaksi</div>
                            <div class="fw-bold h5 mb-0 text-info">Rp <?= number_format($rata_transaksi, 0, ',', '.'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
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
                            <th>Tanggal</th>
                            <th class="text-end">Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $row): ?>
                            <tr>
                                <td><?= $row->kode_penjualan; ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($row->tanggal)); ?></td>
                                <td class="text-end">Rp <?= number_format($row->total, 0, ',', '.'); ?></td>
                                <td class="text-end">
                                    <a href="<?= site_url('penjualan/show/'.$row->id_penjualan); ?>" class="btn btn-sm btn-outline-secondary text-dark detail-btn">Detail</a>
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

