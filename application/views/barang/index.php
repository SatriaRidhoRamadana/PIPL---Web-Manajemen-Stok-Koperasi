<div class="content-area">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 text-white">Data Barang</h4>
        <a href="<?= site_url('barang/create'); ?>" class="btn btn-primary">Tambah Barang</a>
    </div>
    <div class="card p-3 panel-surface">
        <div class="table-responsive">
            <table class="table table-bordered table-sm datatable align-middle">
            <thead class="table-light">
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th class="text-end">Harga Jual</th>
                    <th class="text-end">Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barang as $row): ?>
                    <tr>
                            <td class="text-nowrap"><?= $row->sku; ?></td>
                            <td class="td-truncate"><?= $row->nama_barang; ?></td>
                            <td class="td-truncate"><?= $row->nama_kategori; ?></td>
                        <td class="text-end">Rp <?= number_format($row->harga, 0, ',', '.'); ?></td>
                        <td class="text-end"><?= $row->stok; ?> <?= $row->satuan; ?></td>
                        <td>
                                <div class="actions d-inline-flex gap-2">
                                    <a href="<?= site_url('barang/edit/'.$row->id_barang); ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <a href="<?= site_url('barang/delete/'.$row->id_barang); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus barang ini?')">Hapus</a>
                                </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>
    </div>
</div>

