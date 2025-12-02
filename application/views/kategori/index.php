<div class="row g-4">
    <div class="col-lg-4">
        <div class="card p-4">
            <h5 class="mb-3">Tambah Kategori</h5>
            <?= form_open('kategori/store'); ?>
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kode Kategori</label>
                    <input type="text" name="kode_kategori" class="form-control" required>
                    <div class="form-text">Kode singkat (tanpa spasi), akan menjadi prefix pada SKU barang.</div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Simpan</button>
            <?= form_close(); ?>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card p-3">
            <h5>Daftar Kategori</h5>
            <div class="table-responsive mt-3">
                <table class="table table-striped datatable">
                    <thead>
                        <tr>
                            <th>Nama Kategori</th>
                            <th width="160">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($kategori as $kat): ?>
                            <tr>
                                    <td><?= $kat->nama_kategori; ?></td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-sm btn-primary btn-edit-kategori" 
                                                data-id="<?= $kat->id_kategori; ?>" 
                                                data-nama="<?= htmlspecialchars($kat->nama_kategori, ENT_QUOTES); ?>" 
                                                data-kode="<?= isset($kat->kode_kategori) ? $kat->kode_kategori : ''; ?>">
                                                Edit
                                            </button>
                                            <a href="<?= site_url('kategori/delete/'.$kat->id_kategori); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus kategori?')">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Edit Kategori Modal -->
<div class="modal fade" id="kategoriModal" tabindex="-1" aria-labelledby="kategoriModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="kategoriModalLabel">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="kategoriModalForm" method="post" action="">
            <div class="modal-body">
                        <div class="mb-3">
                                <label class="form-label">Nama Kategori</label>
                                <input type="text" name="nama_kategori" id="modal_nama_kategori" class="form-control" required>
                        </div>
                        <div class="mb-3">
                                <label class="form-label">Kode Kategori</label>
                                <input type="text" name="kode_kategori" id="modal_kode_kategori" class="form-control" required>
                                <div class="form-text">Kode singkat (tanpa spasi), akan menjadi prefix pada SKU barang.</div>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
        (function(){
                // bootstrap modal instance will be created by data attributes when triggered
                const modalEl = document.getElementById('kategoriModal');
                const modalForm = document.getElementById('kategoriModalForm');
                const namaInput = document.getElementById('modal_nama_kategori');
                const kodeInput = document.getElementById('modal_kode_kategori');

                document.querySelectorAll('.btn-edit-kategori').forEach(btn => {
                        btn.addEventListener('click', function(){
                                const id = this.getAttribute('data-id');
                                const nama = this.getAttribute('data-nama');
                                const kode = this.getAttribute('data-kode');
                                // set form action to kategori/update/{id}
                                modalForm.action = '<?= site_url('kategori/update/'); ?>' + id;
                                namaInput.value = nama;
                                kodeInput.value = kode;
                                // show modal via Bootstrap's modal API
                                var modal = new bootstrap.Modal(modalEl);
                                modal.show();
                        });
                });
        })();
</script>

