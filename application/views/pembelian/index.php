<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Riwayat Pembelian</h4>
    <a href="<?= site_url('pembelian/create'); ?>" class="btn btn-primary">Pembelian Baru</a>
</div>
<div class="card p-3">
    <div class="table-responsive">
        <table class="table table-striped datatable">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th class="text-end">Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pembelian as $row): ?>
                    <tr>
                        <td><?= $row->kode_pembelian; ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($row->tanggal)); ?></td>
                        <td class="text-end">Rp <?= number_format($row->total, 0, ',', '.'); ?></td>
                        <td class="text-end">
                            <a href="<?= site_url('pembelian/show/'.$row->id_pembelian); ?>" class="btn btn-sm btn-outline-primary">Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

