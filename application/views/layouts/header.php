<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title.' | ' : ''; ?>Koperasi MAN 1 Batam</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="<?= site_url('dashboard'); ?>">
                <img src="<?= base_url('assets/img/MAN1Batam.png'); ?>" alt="Logo" style="width: 35px; height: 35px; margin-right: 10px;">
                <span>Koperasi MAN 1 Batam</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <?php if (has_role(array('admin', 'owner'))): ?>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('dashboard'); ?>">Dashboard</a></li>
                    <?php endif; ?>
                    <?php if (has_role('admin')): ?>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('barang'); ?>">Barang</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('kategori'); ?>">Kategori</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('pembelian'); ?>">Pembelian</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('user'); ?>">Pengguna</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Laporan</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= site_url('laporan/penjualan'); ?>">Penjualan</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('laporan/stok'); ?>">Stok</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('laporan/pembelian'); ?>">Pembelian</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if (has_role('owner')): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Laporan</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="<?= site_url('laporan/penjualan'); ?>">Penjualan</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('laporan/stok'); ?>">Stok</a></li>
                                <li><a class="dropdown-item" href="<?= site_url('laporan/pembelian'); ?>">Pembelian</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if (has_role('kasir')): ?>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('penjualan/create'); ?>">Transaksi Baru</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('penjualan'); ?>">Riwayat Hari Ini</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= site_url('laporan/penjualan_harian'); ?>">Laporan Harian</a></li>
                    <?php endif; ?>
                </ul>
                <?php if (is_logged_in()): ?>
                    <div class="d-flex align-items-center text-white">
                        <div class="me-3 text-end">
                            <div><?= current_user('full_name'); ?></div>
                            <small class="text-white-50 text-uppercase"><?= current_user('role'); ?></small>
                        </div>
                        <a href="<?= site_url('logout'); ?>" class="btn btn-outline-light btn-sm">Logout</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="container-fluid py-4 app-background">
        <?php $this->load->view('layouts/flash'); ?>


