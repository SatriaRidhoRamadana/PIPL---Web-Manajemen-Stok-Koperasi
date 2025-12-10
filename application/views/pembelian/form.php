<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0 text-white">Pembelian / Restock</h4>
    <a href="<?= site_url('pembelian'); ?>" class="btn btn-light">Kembali</a>
</div>
<div class="card p-4">
    <?= form_open('pembelian/store'); ?>
        <div class="table-responsive">
            <table class="table align-middle" id="table-pembelian">
                <thead class="table-light">
                    <tr>
                        <th>Barang</th>
                        <th width="120">Qty</th>
                        <th width="200">Harga Beli</th>
                        <th class="text-end" width="150">Subtotal</th>
                        <th width="60"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select name="barang_id[]" class="form-select" required>
                                <option value="">-- Pilih Barang --</option>
                                <?php foreach ($barang as $item): ?>
                                    <option value="<?= $item->id_barang; ?>"><?= $item->nama_barang; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <input type="number" name="qty[]" class="form-control qty" min="1" value="1" required>
                        </td>
                        <td>
                            <input type="number" name="harga[]" class="form-control harga-beli" min="0" value="0" required>
                        </td>
                        <td class="text-end subtotal-text">Rp 0</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-light btn-sm" onclick="removeItemRow(this)">✕</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-primary mb-4" data-target="#table-pembelian" onclick="addItemRow(this)">Tambah Baris</button>

        <div class="row">
            <div class="col-md-4 ms-auto">
                <label class="form-label">Total Pembelian</label>
                <div class="form-control bg-light fw-bold" id="totalPembelian">Rp 0</div>
            </div>
        </div>
        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary btn-lg">Simpan Pembelian</button>
        </div>
    <?= form_close(); ?>
</div>

<script>
    const calcPembelian = () => {
        let total = 0;
        document.querySelectorAll('#table-pembelian tbody tr').forEach(function (row) {
            const qty = parseFloat(row.querySelector('.qty').value || 0);
            const harga = parseFloat(row.querySelector('.harga-beli').value || 0);
            const subtotal = qty * harga;
            row.querySelector('.subtotal-text').innerText = formatRupiah(subtotal);
            total += subtotal;
        });
        document.getElementById('totalPembelian').innerText = formatRupiah(total);
    };

    document.addEventListener('input', function (e) {
        if (e.target.matches('#table-pembelian .qty') || e.target.matches('#table-pembelian .harga-beli')) {
            calcPembelian();
        }
    });

    calcPembelian();
</script>

