<?php
    $periode = ($start_date && $end_date)
        ? date('d/m/Y', strtotime($start_date)).' - '.date('d/m/Y', strtotime($end_date))
        : 'Semua periode';
?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0 text-white">Laporan Pembelian</h4>
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
    <div class="print-meta" style="font-size: 0.8rem; margin: 0.25rem 0; font-weight: 600;">Laporan Pembelian</div>
    <div class="print-meta" style="font-size: 0.7rem; margin: 0.1rem 0;">Periode: <?= $periode; ?> | Dicetak: <?= date('d/m/Y H:i'); ?></div>
</div>

<div class="card p-4">
    <div class="no-print">
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
    </div>

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


