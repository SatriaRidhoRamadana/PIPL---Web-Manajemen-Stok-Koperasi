# Struktur Folder Aplikasi Koperasi MAN 1 Batam

## Overview
Aplikasi manajemen stok koperasi berbasis CodeIgniter 3 dengan styling Bootstrap 5.3.3 dan DataTables 1.13.8.

## Struktur Folder Penting

```
koperasi/
├── application/                    # Core aplikasi CodeIgniter
│   ├── config/                     # Konfigurasi aplikasi
│   │   ├── database.php           # Konfigurasi database
│   │   ├── config.php             # Konfigurasi umum
│   │   ├── routes.php             # Routing URL
│   │   └── ...
│   │
│   ├── controllers/               # Controller logika aplikasi
│   │   ├── Dashboard.php          # Dashboard admin/kasir/owner
│   │   ├── Auth.php               # Login/logout
│   │   ├── Barang.php             # CRUD barang (create, read, update, delete)
│   │   ├── Kategori.php           # CRUD kategori barang
│   │   ├── Penjualan.php          # Transaksi penjualan
│   │   ├── Pembelian.php          # Transaksi pembelian/restock
│   │   ├── Laporan.php            # Laporan penjualan/pembelian/stok
│   │   ├── User.php               # Management pengguna
│   │   └── Welcome.php            # Default page
│   │
│   ├── models/                    # Model database
│   │   ├── User_model.php         # User queries
│   │   ├── Barang_model.php       # Barang queries
│   │   ├── Kategori_model.php     # Kategori queries
│   │   ├── Penjualan_model.php    # Penjualan queries
│   │   ├── Pembelian_model.php    # Pembelian queries
│   │   ├── DetailPenjualan_model.php
│   │   ├── DetailPembelian_model.php
│   │   └── ...
│   │
│   ├── views/                     # Tampilan HTML/PHP
│   │   ├── auth/
│   │   │   └── login.php          # Login page dengan blur background
│   │   │
│   │   ├── layouts/
│   │   │   ├── header.php         # Header dengan navbar dan layout flexbox
│   │   │   └── footer.php         # Footer dengan contact info
│   │   │
│   │   ├── dashboard/
│   │   │   ├── index.php          # Dashboard admin/owner
│   │   │   └── kasir.php          # Dashboard kasir
│   │   │
│   │   ├── barang/
│   │   │   ├── index.php          # List barang (datatable)
│   │   │   └── form.php           # Form tambah/edit barang
│   │   │
│   │   ├── kategori/
│   │   │   └── ...                # CRUD kategori
│   │   │
│   │   ├── penjualan/
│   │   │   ├── index.php          # Riwayat penjualan
│   │   │   ├── form.php           # Form transaksi penjualan
│   │   │   └── show.php           # Detail/struk penjualan
│   │   │
│   │   ├── pembelian/
│   │   │   ├── index.php          # Riwayat pembelian
│   │   │   ├── form.php           # Form pembelian/restock
│   │   │   └── show.php           # Detail pembelian
│   │   │
│   │   ├── laporan/
│   │   │   ├── penjualan.php      # Laporan penjualan (admin/kasir/owner)
│   │   │   ├── penjualan_kasir.php # Laporan penjualan kasir
│   │   │   ├── pembelian.php      # Laporan pembelian
│   │   │   └── stok.php           # Laporan stok barang
│   │   │
│   │   ├── user/
│   │   │   ├── index.php          # Data pengguna
│   │   │   └── form.php           # Form tambah/edit pengguna
│   │   │
│   │   └── errors/                # Error pages
│   │
│   ├── helpers/
│   │   ├── auth_helper.php        # Helper fungsi autentikasi
│   │   └── role_helper.php        # Helper fungsi role/permission
│   │
│   ├── core/
│   │   └── MY_Controller.php      # Base controller custom
│   │
│   └── ...
│
├── assets/                        # Static files
│   ├── css/
│   │   └── custom.css             # Custom styling utama
│   │                             
│   ├── js/
│   │   └── main.js                # Custom JavaScript
│   │
│   ├── img/
│   │   ├── building.jpg           # Background image (blurred)
│   │   └── MAN1Batam.png          # School logo
│   │
│   └── ...
│
├── database/
│   └── koperasi_db.sql           # Database dump/schema
│
├── system/                        # CodeIgniter core (jangan dimodifikasi)
│   ├── core/                      # CodeIgniter core files
│   ├── database/                  # Database library
│   ├── helpers/                   # Built-in helpers
│   └── ...
│
├── index.php                      # Entry point aplikasi
├── composer.json                  # Dependencies
└── project_reference.md           # Dokumentasi Project
```

## File-File Kunci

### Styling & UI
- **assets/css/custom.css**
  - CSS variables: --brand, --brand-dark, --brand-bright
  - Background blur & overlay (body::before/after pseudo-elements)
  - DataTable styling dengan border hijau 2-3px
  - Print media queries untuk compact layout PDF
  - Flexbox layout untuk sticky footer

### Layout & Views
- **application/views/layouts/header.php**
  - HTML boilerplate
  - Navbar dengan flexbox container
  - Load semua CSS dan JS libraries
  - Flexbox height: 100vh untuk full page

- **application/views/layouts/footer.php**
  - Footer global dengan contact info
  - Styled dengan green gradient
  - Flex-shrink: 0 untuk sticky bottom

### Authentication
- **application/views/auth/login.php**
  - Login form dengan blur background
  - Green gradient card styling

### Controllers Utama
- **Dashboard.php** - Dashboard dengan role-based view
- **Barang.php** - CRUD barang dengan kategori
- **Penjualan.php** - Transaksi penjualan + struk
- **Pembelian.php** - Transaksi pembelian
- **Laporan.php** - Generate laporan penjualan/pembelian/stok
- **User.php** - Management pengguna (admin only)
- **Auth.php** - Login/logout logic

### Models Utama
- **Barang_model.php** - Query barang dengan kategori
- **Penjualan_model.php** - Query penjualan + detail
- **Pembelian_model.php** - Query pembelian + detail
- **User_model.php** - Query user dengan role
- **Kategori_model.php** - Query kategori barang

## Fitur Utama

### 1. Authentication & Authorization
- Login dengan email/username
- Role-based access: Admin, Kasir, Owner
- Session management

### 2. Master Data
- **Barang**: CRUD dengan kategori, SKU, harga, stok
- **Kategori**: CRUD kategori barang
- **User**: CRUD pengguna dengan role assignment

### 3. Transaksi
- **Penjualan**: Form transaksi, detail/struk, laporan
- **Pembelian**: Form restock, detail, laporan

### 4. Laporan
- **Laporan Penjualan**: Analytics + tabel detail (web & PDF)
- **Laporan Pembelian**: Tabel detail per periode
- **Laporan Stok**: Inventori barang real-time
- PDF print dengan layout compact (header repeat, page break smart)

### 5. UI/UX
- Responsive design (Bootstrap 5.3.3)
- DataTable pagination (5/10/20 per page)
- Green theme (#165f3d primary, #0f4a2d dark)
- Background blur 2px dengan overlay 0.15 opacity
- Sticky footer
- White text titles untuk visibility
- Professional print layout

## Database Schema
Lihat `database/koperasi_db.sql` untuk skema lengkap.

### Tabel Utama
- `users` - Pengguna aplikasi
- `barang` - Master barang
- `kategori` - Kategori barang
- `penjualan` - Header transaksi penjualan
- `detail_penjualan` - Detail baris penjualan
- `pembelian` - Header transaksi pembelian
- `detail_pembelian` - Detail baris pembelian

## Technologies Used
- **Framework**: CodeIgniter 3
- **Frontend**: Bootstrap 5.3.3, DataTables 1.13.8
- **Language**: PHP 7.x+, JavaScript
- **Database**: MySQL/MariaDB
- **Font**: Nunito (Google Fonts)

## Color Scheme
- **Primary Green**: #165f3d
- **Dark Green**: #0f4a2d
- **Bright Green**: #28a745
- **Background Overlay**: rgba(15, 74, 45, 0.15)
- **Text**: White (#fff) untuk titles, #15302a untuk body

## Responsive Breakpoints
- Mobile: < 576px
- Tablet: 576px - 992px
- Desktop: > 992px

## Print Styling
- Font size 0.85rem untuk table
- Margin/padding minimal
- Header table repeat otomatis
- Page break smart di row level
- Analytics cards jadi teks plain berukuran kecil
