<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0"><?= $barang ? 'Edit Barang' : 'Tambah Barang'; ?></h4>
    <a href="<?= site_url('barang'); ?>" class="btn btn-light">Kembali</a>
</div>
<script>
    (function(){
        const select = document.querySelector('select[name="id_kategori"]');
        const prefix = document.getElementById('sku-prefix');
        const skuInput = document.getElementById('sku-input');

        function updatePrefix(){
            const opt = select.options[select.selectedIndex];
            const kode = opt ? opt.getAttribute('data-kode') : '';
            prefix.textContent = kode ? kode + '-' : '--';
            // if sku doesn't already start with kode-, optionally prepend
            if(kode){
                const val = skuInput.value || '';
                if(!val.startsWith(kode + '-')){
                    skuInput.value = kode + '-' + val.replace(new RegExp('^'+kode+'-'), '');
                }
            }
        }

        if(select){
            select.addEventListener('change', updatePrefix);
            // init
            updatePrefix();
        }
    })();
</script>
<div class="card p-4">
    <?= form_open($barang ? 'barang/update/'.$barang->id_barang : 'barang/store'); ?>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">SKU / Kode</label>
                <div class="input-group">
                    <span class="input-group-text" id="sku-prefix">--</span>
                    <input type="text" name="sku" id="sku-input" class="form-control" value="<?= set_value('sku', $barang->sku ?? ''); ?>" required>
                </div>
                <div class="form-text">Prefix akan otomatis berdasarkan Kategori yang dipilih.</div>
            </div>
            <div class="col-md-8">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" value="<?= set_value('nama_barang', $barang->nama_barang ?? ''); ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Kategori</label>
                <select name="id_kategori" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <?php foreach ($kategori as $kat): ?>
                        <option value="<?= $kat->id_kategori; ?>" data-kode="<?= isset($kat->kode_kategori) ? $kat->kode_kategori : ''; ?>" <?= set_select('id_kategori', $kat->id_kategori, isset($barang) && $barang && $barang->id_kategori == $kat->id_kategori); ?>><?= $kat->nama_kategori; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Satuan</label>
                <input type="text" name="satuan" class="form-control" value="<?= set_value('satuan', $barang->satuan ?? 'pcs'); ?>">
            </div>
            <div class="col-md-4">
                <label class="form-label">Stok</label>
                <input type="number" name="stok" class="form-control" value="<?= set_value('stok', $barang->stok ?? 0); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Harga Jual</label>
                <input type="number" name="harga" class="form-control" value="<?= set_value('harga', $barang->harga ?? 0); ?>" required>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary"><?= $barang ? 'Update' : 'Simpan'; ?></button>
        </div>
    <?= form_close(); ?>
</div>

