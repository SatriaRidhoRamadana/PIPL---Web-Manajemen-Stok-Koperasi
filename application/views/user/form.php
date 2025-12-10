<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0 text-white"><?= $user ? 'Edit Pengguna' : 'Tambah Pengguna'; ?></h4>
    <a href="<?= site_url('user'); ?>" class="btn btn-light">Kembali</a>
</div>
<div class="card p-4">
    <?= form_open($user ? 'user/update/'.$user->id_user : 'user/store'); ?>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="full_name" class="form-control" value="<?= set_value('full_name', $user->full_name ?? ''); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="<?= set_value('username', $user->username ?? ''); ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Role</label>
                <select name="role" class="form-select" required>
                    <option value="">-- Pilih --</option>
                    <?php foreach (['admin', 'kasir', 'owner'] as $role): ?>
                        <option value="<?= $role; ?>" <?= set_select('role', $role, isset($user) && $user && $user->role == $role); ?>><?= ucfirst($role); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label"><?= $user ? 'Password Baru (opsional)' : 'Password'; ?></label>
                <input type="password" name="password" class="form-control" <?= $user ? '' : 'required'; ?>>
            </div>
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary"><?= $user ? 'Update' : 'Simpan'; ?></button>
        </div>
    <?= form_close(); ?>
</div>

