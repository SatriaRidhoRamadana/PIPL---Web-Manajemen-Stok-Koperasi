<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Detail Pembelian</h4>
    <a href="<?= site_url('pembelian'); ?>" class="btn btn-light">Kembali</a>
</div>
<div class="card p-4">
    <div class="row">
        <div class="col-md-6">
            <p><strong>Kode:</strong> <?= $pembelian->kode_pembelian; ?></p>
            <p><strong>Tanggal:</strong> <?= date('d/m/Y H:i', strtotime($pembelian->tanggal)); ?></p>
        </div>
        <div class="col-md-6 text-md-end">
            <p><strong>Diperbarui:</strong> <?= isset($pembelian->created_at) ? date('d/m/Y H:i', strtotime($pembelian->created_at)) : '-'; ?></p>
        </div>
    </div>
    <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Barang</th>
                    <th class="text-center">Qty</th>
                    <th class="text-end">Harga Beli</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detail as $row): ?>
                    <tr>
                        <td><?= $row->nama_barang; ?></td>
                        <td class="text-center"><?= $row->jumlah; ?></td>
                        <td class="text-end">Rp <?= number_format($row->harga_beli, 0, ',', '.'); ?></td>
                        <td class="text-end">Rp <?= number_format($row->subtotal, 0, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="text-end">
        <h5>Total: Rp <?= number_format($pembelian->total, 0, ',', '.'); ?></h5>
    </div>
</div>

