<div class="row g-4">
    <div class="col-md-3">
        <div class="card p-3">
            <div class="text-muted">Total Barang</div>
            <h3 class="fw-bold mb-0"><?= number_format($total_barang); ?></h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="text-muted">Transaksi Hari Ini</div>
            <h3 class="fw-bold mb-0"><?= number_format($total_transaksi); ?></h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="text-muted">Omzet Hari Ini</div>
            <h3 class="fw-bold mb-0">Rp <?= number_format($omzet_hari_ini, 0, ',', '.'); ?></h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card p-3">
            <div class="text-muted">Peran</div>
            <h3 class="fw-bold mb-0 text-uppercase"><?= current_user('role'); ?></h3>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-8">
        <div class="card p-3">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Grafik Penjualan 7 Hari</h5>
            </div>
            <canvas id="chartPenjualan" height="140"></canvas>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card p-3">
            <h5 class="mb-3">Stok Rendah</h5>
            <div class="table-responsive">
                <table class="table table-sm align-middle">
                    <thead>
                        <tr>
                            <th>Barang</th>
                            <th class="text-end">Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($low_stock as $item): ?>
                            <tr>
                                <td><?= $item->nama_barang; ?></td>
                                <td class="text-end">
                                    <?php if ($item->stok == 0): ?>
                                        <span class="badge bg-dark">Habis</span>
                                    <?php elseif ($item->stok <= 3): ?>
                                        <span class="badge bg-danger"><?= $item->stok; ?></span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark"><?= $item->stok; ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($low_stock)): ?>
                            <tr><td colspan="2" class="text-center text-muted">Semua stok aman</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const ctx = document.getElementById('chartPenjualan');
    const chartData = <?= json_encode(array_values($chart_data)); ?>;
    const labels = <?= json_encode(array_keys($chart_data)); ?>;
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Omzet',
                data: chartData,
                borderColor: '#4e73df',
                tension: 0.4,
                fill: true,
                backgroundColor: 'rgba(78,115,223,.15)'
            }]
        },
        options: {
            plugins: {
                legend: { display: false, labels: { color: '#fff' } },
                tooltip: { titleColor: '#fff', bodyColor: '#fff' }
            },
            scales: {
                x: { ticks: { color: '#fff' }, grid: { color: 'rgba(255,255,255,0.06)' } },
                y: {
                    ticks: {
                        color: '#fff',
                        callback: (value) => 'Rp ' + value.toLocaleString('id-ID')
                    },
                    grid: { color: 'rgba(255,255,255,0.06)' }
                }
            }
        }
    });
</script>


