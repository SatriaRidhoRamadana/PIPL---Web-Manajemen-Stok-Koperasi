<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0 text-white">Transaksi Penjualan</h4>
    <a href="<?= site_url('penjualan'); ?>" class="btn btn-light">Riwayat</a>
</div>
<div class="card p-4">
    <?= form_open('penjualan/store', ['id' => 'form-penjualan']); ?>
        <div class="table-responsive">
            <table class="table align-middle" id="table-penjualan">
                <thead class="table-light">
                    <tr>
                        <th>Barang</th>
                        <th width="120">Qty</th>
                        <th class="text-end" width="150">Harga</th>
                        <th class="text-end" width="150">Subtotal</th>
                        <th width="60"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="barang_id[]" class="form-select pilih-barang" required>
                                <option value="">-- Pilih Barang --</option>
                                <?php foreach ($barang as $item): ?>
                                    <option value="<?= $item->id_barang; ?>" data-harga="<?= $item->harga; ?>"><?= $item->nama_barang; ?> (Stok: <?= $item->stok; ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="qty[]" class="form-control qty" min="1" value="1" required>
                        </td>
                        <td class="text-end harga-text">Rp 0</td>
                        <td class="text-end subtotal-text">Rp 0</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-light btn-sm" onclick="removeItemRow(this)">✕</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-primary mb-4" data-target="#table-penjualan" onclick="addItemRow(this)">Tambah Baris</button>

        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Total</label>
                <input type="text" class="form-control form-control-lg bg-white text-dark fw-bold" id="totalText" value="Rp 0" readonly>
            </div>
            <div class="col-md-3">
                <label class="form-label">Uang Bayar</label>
                <input type="number" name="bayar" class="form-control form-control-lg bg-white text-dark" id="inputBayar" required>
            </div>
            <div class="col-md-3">
                <label class="form-label">Kembalian</label>
                <input type="text" class="form-control form-control-lg bg-white text-dark" id="kembalianText" value="Rp 0" readonly>
            </div>
        </div>
        <div class="mt-4 text-end">
            <button type="submit" class="btn btn-primary btn-lg">Simpan Transaksi</button>
        </div>
    <?= form_close(); ?>
</div>

<script>
    function recalcRow(row) {
        const select = row.querySelector('.pilih-barang');
        const qtyInput = row.querySelector('.qty');
        const harga = select.selectedOptions[0]?.dataset.harga ? parseFloat(select.selectedOptions[0].dataset.harga) : 0;
        const qty = parseInt(qtyInput.value) || 0;
        const subtotal = harga * qty;
        row.querySelector('.harga-text').innerText = formatRupiah(harga);
        row.querySelector('.subtotal-text').innerText = formatRupiah(subtotal);
        recalcTotal();
    }

    function recalcTotal() {
        let total = 0;
        document.querySelectorAll('#table-penjualan tbody tr').forEach(function (row) {
            const text = row.querySelector('.subtotal-text').innerText.replace(/[^0-9]/g, '');
            total += parseInt(text || 0);
        });
        document.getElementById('totalText').value = formatRupiah(total);
        const bayar = parseInt(document.getElementById('inputBayar').value || 0);
        document.getElementById('kembalianText').value = formatRupiah(Math.max(bayar - total, 0));
    }

    function handlePenjualanInput(e) {
        if (e.target.matches('.pilih-barang') || e.target.matches('.qty')) {
            recalcRow(e.target.closest('tr'));
        }
        if (e.target.id === 'inputBayar') {
            recalcTotal();
        }
    }

    document.addEventListener('change', handlePenjualanInput);
    document.addEventListener('input', handlePenjualanInput);
    recalcTotal();
</script>

