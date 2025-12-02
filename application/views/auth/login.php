<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Koperasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body { background: linear-gradient(120deg, #4e73df, #224abe); min-height: 100vh; }
        .card { border: none; border-radius: 18px; box-shadow: 0 15px 45px rgba(0,0,0,0.2); }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height:100vh;">
            <div class="col-md-5">
                <div class="card p-4">
                    <div class="text-center mb-4">
                        <h3 class="mb-0">Koperasi POS</h3>
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


