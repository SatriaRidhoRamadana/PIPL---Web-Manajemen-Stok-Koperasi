<?php
    $periode = ($start_date && $end_date)
        ? date('d/m/Y', strtotime($start_date)).' - '.date('d/m/Y', strtotime($end_date))
        : 'Semua periode';
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0 text-white">Laporan Penjualan</h4>
    <button class="btn btn-primary no-print" onclick="window.print();">Cetak</button>
</div>

<div class="print-header d-none d-print-block mb-3">
    <div class="d-flex align-items-center mb-2" style="gap: 8px;">
        <img src="<?= base_url('assets/img/MAN1Batam.png'); ?>" alt="Logo" style="width: 35px; height: 35px;">
        <div>
            <div class="title" style="font-size: 0.95rem; margin: 0;">Koperasi MAN 1 Batam</div>
            <div class="print-meta" style="font-size: 0.7rem; margin: 0;">Jl. Brigjen Katamso No.10, Batam</div>
        </div>
    </div>
    <div class="print-meta" style="font-size: 0.8rem; margin: 0.25rem 0; font-weight: 600;">Laporan Penjualan</div>
    <div class="print-meta" style="font-size: 0.7rem; margin: 0.1rem 0;">Periode: <?= $periode; ?> | Dicetak: <?= date('d/m/Y H:i'); ?></div>
</div>

<!-- Filter Tanggal -->
<div class="card p-4 mb-4 no-print">
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
            <div class="card-body text-center py-2">
                <h6 class="text-muted mb-1 small">Total Transaksi</h6>
                <h5 class="text-primary mb-0"><?= $total_transaksi; ?></h5>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-success">
            <div class="card-body text-center py-2">
                <h6 class="text-muted mb-1 small">Total Omzet</h6>
                <h6 class="text-success mb-0">Rp <?= number_format($total_omzet, 0, ',', '.'); ?></h6>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-info">
            <div class="card-body text-center py-2">
                <h6 class="text-muted mb-1 small">Rata-rata/Transaksi</h6>
                <h6 class="text-info mb-0">Rp <?= number_format($rata_transaksi, 0, ',', '.'); ?></h6>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-warning">
            <div class="card-body text-center py-2">
                <h6 class="text-muted mb-1 small">Total Uang Masuk</h6>
                <h6 class="text-warning mb-0">Rp <?= number_format($total_uang_masuk, 0, ',', '.'); ?></h6>
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

