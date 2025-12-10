<style>
.btn-actions {
    text-align: center;
    margin: 20px 0;
    display: block;
}

#struk-container {
    width: 100%;
    height: 100vh;
    margin: 0;
    font-family: 'Courier New', monospace;
    background: white;
    padding: 0;
    box-shadow: none;
    display: none;
    overflow-y: auto;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1000;
}

#struk-container.show-receipt {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

#struk-content {
    width: 80mm;
    padding: 10px;
    background: white;
}

.struk-header {
    text-align: center;
    border-bottom: 1px dashed #000;
    padding-bottom: 10px;
    margin-bottom: 10px;
}

.struk-logo {
    width: 60px;
    height: 60px;
    margin: 0 auto 10px;
}

.struk-title {
    font-weight: bold;
    font-size: 16px;
    margin-bottom: 5px;
}

.struk-info {
    font-size: 12px;
    margin: 2px 0;
}

.struk-divider {
    border-top: 1px dashed #000;
    margin: 10px 0;
}

.struk-item {
    margin-bottom: 8px;
    font-size: 12px;
}

.struk-item-name {
    font-weight: bold;
}

.struk-item-detail {
    display: flex;
    justify-content: space-between;
    margin-top: 2px;
}

.struk-total-section {
    margin-top: 10px;
    border-top: 1px dashed #000;
    padding-top: 10px;
}

.struk-row {
    display: flex;
    justify-content: space-between;
    margin: 5px 0;
    font-size: 12px;
}

.struk-row.grand-total {
    font-weight: bold;
    font-size: 14px;
    border-top: 1px solid #000;
    border-bottom: 1px solid #000;
    padding: 5px 0;
    margin-top: 5px;
}

.struk-footer {
    text-align: center;
    margin-top: 15px;
    border-top: 1px dashed #000;
    padding-top: 10px;
    font-size: 11px;
}

.struk-close-btn {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #dc3545;
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    z-index: 1001;
}

/* Detail section with green background and white text */
.detail-section {
    background: linear-gradient(90deg, #165f3d 0%, #0f4a2d 100%) !important;
    color: #fff !important;
    border: none !important;
    box-shadow: 0 6px 20px rgba(15,74,45,0.06) !important;
}

.detail-section h5,
.detail-section h6 {
    color: #fff !important;
    font-weight: 700;
}

.detail-table {
    width: 100%;
}

.detail-table td {
    padding: 8px;
    border-bottom: 1px solid rgba(255,255,255,0.2);
    color: #fff !important;
    background: transparent !important;
}

.detail-table .label {
    font-weight: 600;
    width: 120px;
    background: rgba(0,0,0,0.2);
    color: rgba(255,255,255,0.9) !important;
    border-radius: 4px;
    padding: 4px 8px !important;
}

.detail-table .value {
    color: #fff !important;
}

.detail-section .table {
    color: #fff !important;
    background: transparent !important;
}

.detail-section .table thead th {
    background: rgba(0,0,0,0.15) !important;
    color: #fff !important;
    font-weight: 700;
    border-color: rgba(255,255,255,0.2) !important;
}

.detail-section .table th,
.detail-section .table td {
    color: #fff !important;
    border-color: rgba(255,255,255,0.2) !important;
    background: transparent !important;
}

.detail-section .table tbody tr:hover {
    background: rgba(0,0,0,0.1) !important;
}

@media print {
    .btn-actions,
    .no-print,
    nav,
    .detail-section,
    .struk-close-btn {
        display: none !important;
    }

    body {
        margin: 0;
        padding: 0;
        background: #fff;
    }

    .app-background {
        padding: 0 !important;
        background: #fff !important;
    }

    .app-background > *:not(#struk-container) {
        display: none !important;
    }

    #struk-container {
        width: 100%;
        height: auto;
        position: static;
        display: flex !important;
        justify-content: center;
        align-items: flex-start;
        margin: 0;
        padding: 0;
        z-index: auto;
    }

    #struk-content {
        width: 80mm;
        padding: 5mm;
        box-shadow: none;
        page-break-after: avoid;
    }
}
</style>

<div class="btn-actions no-print">
    <button onclick="window.print();" class="btn btn-success btn-sm me-2" id="print-btn">
        <i class="bi bi-printer"></i> Cetak Struk
    </button>
    <a href="<?= site_url('penjualan'); ?>" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="detail-section card p-4 mb-4">
    <h5 class="mb-4">Detail Transaksi</h5>
    
    <table class="detail-table">
        <tr>
            <td class="label">Kode Penjualan</td>
            <td class="value"><?= $penjualan->kode_penjualan; ?></td>
        </tr>
        <tr>
            <td class="label">Tanggal/Waktu</td>
            <td class="value"><?= date('d/m/Y H:i:s', strtotime($penjualan->tanggal)); ?></td>
        </tr>
        <tr>
            <td class="label">Kasir</td>
            <td class="value"><?= $penjualan->kasir_name; ?></td>
        </tr>
        <tr>
            <td class="label">Total</td>
            <td class="value"><strong>Rp <?= number_format($penjualan->total, 0, ',', '.'); ?></strong></td>
        </tr>
        <tr>
            <td class="label">Bayar</td>
            <td class="value"><strong>Rp <?= number_format($penjualan->bayar, 0, ',', '.'); ?></strong></td>
        </tr>
        <tr>
            <td class="label">Kembali</td>
            <td class="value"><strong>Rp <?= number_format($penjualan->kembali, 0, ',', '.'); ?></strong></td>
        </tr>
    </table>

    <h6 class="mt-4 mb-3">Daftar Barang</h6>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th class="text-end">Jumlah</th>
                    <th class="text-end">Harga</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detail as $row): ?>
                <tr>
                    <td><?= $row->nama_barang; ?></td>
                    <td class="text-end"><?= $row->jumlah; ?></td>
                    <td class="text-end">Rp <?= number_format($row->harga_saat_transaksi, 0, ',', '.'); ?></td>
                    <td class="text-end">Rp <?= number_format($row->subtotal, 0, ',', '.'); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="struk-container">
    <button class="struk-close-btn" onclick="document.getElementById('struk-container').classList.remove('show-receipt');">Tutup</button>
    <div id="struk-content">
        <div class="struk-header">
            <img src="<?= base_url('assets/img/MAN1Batam.png'); ?>" alt="Logo" class="struk-logo">
            <div class="struk-title">KOPERASI MAN 1 BATAM</div>
            <div class="struk-info">Jl. Brigjen Katamso No.10 29439 Batam Kepulauan Riau</div>
            <div class="struk-info">Telp: (0778) 393153</div>
        </div>

        <div class="struk-divider"></div>

        <div class="struk-info" style="text-align: center;">
            <div><strong><?= $penjualan->kode_penjualan; ?></strong></div>
            <div><?= date('d/m/Y H:i:s', strtotime($penjualan->tanggal)); ?></div>
            <div>Kasir: <?= $penjualan->kasir_name; ?></div>
        </div>

        <div class="struk-divider"></div>

        <?php foreach ($detail as $row): ?>
        <div class="struk-item">
            <div class="struk-item-name"><?= $row->nama_barang; ?></div>
            <div class="struk-item-detail">
                <span><?= $row->jumlah; ?> x Rp <?= number_format($row->harga_saat_transaksi, 0, ',', '.'); ?></span>
                <span>Rp <?= number_format($row->subtotal, 0, ',', '.'); ?></span>
            </div>
        </div>
        <?php endforeach; ?>

        <div class="struk-total-section">
            <div class="struk-row">
                <span>SUBTOTAL:</span>
                <span>Rp <?= number_format($penjualan->total, 0, ',', '.'); ?></span>
            </div>
            <div class="struk-row grand-total">
                <span>TOTAL:</span>
                <span>Rp <?= number_format($penjualan->total, 0, ',', '.'); ?></span>
            </div>
            <div class="struk-row">
                <span>BAYAR:</span>
                <span>Rp <?= number_format($penjualan->bayar, 0, ',', '.'); ?></span>
            </div>
            <div class="struk-row">
                <span>KEMBALI:</span>
                <span>Rp <?= number_format($penjualan->kembali, 0, ',', '.'); ?></span>
            </div>
        </div>

        <div class="struk-footer">
            <div>*** TERIMA KASIH ***</div>
            <div>Barang yang sudah dibeli</div>
            <div>tidak dapat ditukar/dikembalikan</div>
        </div>
    </div>
</div>

<script>
document.addEventListener('beforeprint', function() {
    document.getElementById('struk-container').classList.add('show-receipt');
});
</script>


