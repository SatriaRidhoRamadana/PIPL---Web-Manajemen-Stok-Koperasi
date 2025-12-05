<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Laporan Stok Barang</h4>
    <button class="btn btn-primary" onclick="window.print();">Cetak</button>
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

