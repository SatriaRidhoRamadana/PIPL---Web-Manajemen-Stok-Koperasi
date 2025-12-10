<style>
@media print {
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        width: 80mm;
        margin: 0 auto;
    }
    body > * {
        display: none !important;
    }
    #struk-container {
        display: block !important;
        visibility: visible;
        width: 100%;
        margin: 0;
        padding: 0;
        box-shadow: none;
    }
    .no-print {
        display: none !important;
    }
}

#struk-container {
    width: 80mm;
    margin: 20px auto;
    font-family: 'Courier New', monospace;
    background: white;
    padding: 10px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
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

.btn-actions {
    text-align: center;
    margin: 20px 0;
}

@media screen {
    .btn-actions {
        display: block;
    }
}
</style>

<div class="btn-actions no-print">
    <button onclick="window.print();" class="btn btn-success btn-sm me-2">
        <i class="bi bi-printer"></i> Cetak Struk
    </button>
    <a href="<?= site_url('penjualan'); ?>" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div id="struk-container">
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

