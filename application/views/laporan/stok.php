<?php $printed_at = date('d/m/Y H:i'); ?>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0 text-white">Laporan Stok Barang</h4>
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
    <div class="print-meta" style="font-size: 0.8rem; margin: 0.25rem 0; font-weight: 600;">Laporan Stok Barang</div>
    <div class="print-meta" style="font-size: 0.7rem; margin: 0.1rem 0;">Dicetak: <?= $printed_at; ?></div>
</div>
<div class="card p-4">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Barang</th>
                    <th>Kategori</th>
                    <th class="text-end">Stok</th>
                    <th class="text-end">Harga Jual</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barang as $row): ?>
                    <tr>
                        <td><?= $row->sku; ?></td>
                        <td><?= $row->nama_barang; ?></td>
                        <td><?= $row->nama_kategori; ?></td>
                        <td class="text-end"><?= $row->stok; ?> <?= $row->satuan; ?></td>
                        <td class="text-end">Rp <?= number_format($row->harga, 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


