<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Detail Penjualan</h4>
    <div>
        <a href="javascript:window.print();" class="btn btn-primary">Cetak</a>
        <a href="<?= site_url('penjualan'); ?>" class="btn btn-light">Kembali</a>
    </div>
</div>
<div class="card p-4" id="print-area">
    <div class="row">
        <div class="col-md-6">
            <p><strong>Kode:</strong> <?= $penjualan->kode_penjualan; ?></p>
            <p><strong>Tanggal:</strong> <?= date('d/m/Y H:i', strtotime($penjualan->tanggal)); ?></p>
        </div>
        <div class="col-md-6 text-md-end">
            <p><strong>Kasir:</strong> <?= $penjualan->kasir_name; ?></p>
        </div>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Harga</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detail as $row): ?>
                    <tr>
                        <td><?= $row->nama_barang; ?></td>
                        <td class="text-center"><?= $row->jumlah; ?></td>
                        <td class="text-end">Rp <?= number_format($row->harga_saat_transaksi, 0, ',', '.'); ?></td>
                        <td class="text-end">Rp <?= number_format($row->subtotal, 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="col-md-4 ms-auto">
            <table class="table">
                <tr>
                    <td>Total</td>
                    <td class="text-end">Rp <?= number_format($penjualan->total, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td>Bayar</td>
                    <td class="text-end">Rp <?= number_format($penjualan->bayar, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td>Kembalian</td>
                    <td class="text-end">Rp <?= number_format($penjualan->kembali, 0, ',', '.'); ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

