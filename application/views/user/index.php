<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0 text-white">Data Pengguna</h4>
    <a href="<?= site_url('user/create'); ?>" class="btn btn-primary">Tambah User</a>
</div>
<div class="card p-3">
    <div class="table-responsive">
        <table class="table table-bordered datatable">
            <thead class="table-light">
                <tr>
                    <th>Nama Lengkap</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th width="160">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user->full_name; ?></td>
                        <td><?= $user->username; ?></td>
                        <td class="text-uppercase"><?= $user->role; ?></td>
                        <td>
                            <a href="<?= site_url('user/edit/'.$user->id_user); ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?= site_url('user/delete/'.$user->id_user); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus user ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

