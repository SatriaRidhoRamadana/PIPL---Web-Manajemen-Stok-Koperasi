<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Laporan Penjualan</h4>
    <button class="btn btn-primary no-print" onclick="window.print();">Cetak</button>
</div>

<!-- Filter Tanggal -->
<div class="card p-4 mb-4">
    <?= form_open('laporan/penjualan', ['method' => 'get', 'class' => 'row g-3']); ?>
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
</div>

<!-- Analisis Penjualan -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-primary">
            <div class="card-body text-center">
                <h6 class="text-muted">Total Transaksi</h6>
                <h3 class="text-primary"><?= $total_transaksi; ?></h3>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-success">
            <div class="card-body text-center">
                <h6 class="text-muted">Total Omzet</h6>
                <h4 class="text-success">Rp <?= number_format($total_omzet, 0, ',', '.'); ?></h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-info">
            <div class="card-body text-center">
                <h6 class="text-muted">Rata-rata/Transaksi</h6>
                <h4 class="text-info">Rp <?= number_format($rata_transaksi, 0, ',', '.'); ?></h4>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-warning">
            <div class="card-body text-center">
                <h6 class="text-muted">Total Uang Masuk</h6>
                <h4 class="text-warning">Rp <?= number_format($total_uang_masuk, 0, ',', '.'); ?></h4>
            </div>
        </div>
    </div>
</div>

<!-- Detail Tabel -->
<div class="card p-4">
    <h6 class="mb-3">Detail Transaksi</h6>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Kasir</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($penjualan as $row): ?>
                    <tr>
                        <td><?= $row->kode_penjualan; ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($row->tanggal)); ?></td>
                        <td><?= $row->kasir_name; ?></td>
                        <td class="text-end">Rp <?= number_format($row->total, 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

