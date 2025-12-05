<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Koperasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">
    <style>
        body { background: linear-gradient(120deg, var(--brand), var(--brand-dark)); min-height: 100vh; color: #fff; }
        .card { border: none; border-radius: 18px; box-shadow: 0 15px 45px rgba(15,74,45,0.18); }
        .card .text-muted { color: rgba(255,255,255,0.85); }
        .card h3 { color: #fff; font-family: 'Nunito', sans-serif; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height:100vh;">
            <div class="col-md-5">
                <div class="card p-4 panel-surface">
                    <div class="text-center mb-4">
                        <h3 class="mb-0" style="color:#000 !important;">Koperasi POS</h3>
                        <small class="text-muted">Silakan login untuk melanjutkan</small>
                    </div>
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= $error; ?></div>
                    <?php endif; ?>
                    <?= form_open('auth'); ?>
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="<?= set_value('username'); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Login</button>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


