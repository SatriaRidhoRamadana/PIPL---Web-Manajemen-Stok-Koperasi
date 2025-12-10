# Sistem Point of Sale (POS) Koperasi - Referensi Proyek

## Deskripsi Proyek
Sistem Point of Sale (POS) berbasis web untuk koperasi yang dibangun menggunakan framework CodeIgniter 3. Sistem ini dirancang untuk mengelola operasional penjualan, inventori, dan pelaporan dalam koperasi.

## Teknologi yang Digunakan
- **Framework**: CodeIgniter 3.1.12
- **Bahasa Pemrograman**: PHP 8.2.12
- **Database**: MySQL/MariaDB 10.4.32
- **Frontend**: HTML, CSS, JavaScript (jQuery)
- **Server**: Apache (XAMPP)
- **Versi PHP**: 8.2.12

## Struktur Database

### Tabel Utama

#### 1. user_account
```sql
- id_user (INT, PRIMARY KEY, AUTO_INCREMENT)
- username (VARCHAR(50), UNIQUE)
- password_hash (VARCHAR(255))
- full_name (VARCHAR(100))
- role (ENUM: 'admin', 'kasir', 'owner')
- created_at (TIMESTAMP)
```

#### 2. kategori
```sql
- id_kategori (INT, PRIMARY KEY, AUTO_INCREMENT)
- nama_kategori (VARCHAR(100))
- deskripsi (TEXT, NULL)
```

#### 3. barang
```sql
- id_barang (INT, PRIMARY KEY, AUTO_INCREMENT)
- sku (VARCHAR(50), UNIQUE, NULL)
- nama_barang (VARCHAR(200))
- id_kategori (INT, FOREIGN KEY)
- harga (DECIMAL(15,2))
- stok (INT, DEFAULT 0)
- satuan (VARCHAR(20), DEFAULT 'pcs')
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

#### 4. penjualan
```sql
- id_penjualan (INT, PRIMARY KEY, AUTO_INCREMENT)
- kode_penjualan (VARCHAR(50), UNIQUE)
- id_user (INT, FOREIGN KEY)
- tanggal (DATETIME)
- total (DECIMAL(15,2))
- bayar (DECIMAL(15,2), NULL)
- kembali (DECIMAL(15,2), NULL)
- created_at (TIMESTAMP)
```

#### 5. detail_penjualan
```sql
- id_detail (INT, PRIMARY KEY, AUTO_INCREMENT)
- id_penjualan (INT, FOREIGN KEY)
- id_barang (INT, FOREIGN KEY)
- jumlah (INT)
- harga_saat_transaksi (DECIMAL(15,2))
- subtotal (DECIMAL(15,2))
```

#### 6. pembelian
```sql
- id_pembelian (INT, PRIMARY KEY, AUTO_INCREMENT)
- kode_pembelian (VARCHAR(50), UNIQUE)
- tanggal (DATETIME)
- total (DECIMAL(15,2))
- created_at (TIMESTAMP)

Catatan: Informasi supplier dapat dicatat dalam form pembelian tetapi tidak disimpan dalam database sebagai kolom terpisah.
```

#### 7. detail_pembelian
```sql
- id_detail (INT, PRIMARY KEY, AUTO_INCREMENT)
- id_pembelian (INT, FOREIGN KEY)
- id_barang (INT, FOREIGN KEY)
- jumlah (INT)
- harga_beli (DECIMAL(15,2))
- subtotal (DECIMAL(15,2))
```

## Arsitektur Aplikasi

### Struktur Direktori CodeIgniter
```
application/
├── config/
│   ├── config.php (konfigurasi utama)
│   ├── database.php (konfigurasi database)
│   └── autoload.php (auto-loading libraries/helpers)
├── controllers/
│   ├── Auth.php (otentikasi)
│   ├── Dashboard.php (dashboard utama)
│   ├── Barang.php (manajemen barang)
│   ├── Kategori.php (manajemen kategori)
│   ├── Penjualan.php (transaksi penjualan)
│   ├── Pembelian.php (transaksi pembelian)
│   ├── Laporan.php (pelaporan)
│   └── User.php (manajemen user)
├── models/
│   ├── User_model.php
│   ├── Barang_model.php
│   ├── Kategori_model.php
│   ├── Penjualan_model.php
│   ├── Pembelian_model.php
│   └── DetailPenjualan_model.php
├── views/
│   ├── auth/login.php
│   ├── dashboard/
│   │   ├── index.php
│   │   └── kasir.php
│   ├── barang/
│   ├── kategori/
│   ├── penjualan/
│   ├── pembelian/
│   ├── laporan/
│   └── layouts/
├── helpers/
│   ├── auth_helper.php
│   └── role_helper.php
└── core/
    └── MY_Controller.php (base controller)
```

## Fitur Utama Sistem

### 1. Sistem Otentikasi
- Login dengan username dan password
- Role-based access control (admin, kasir, owner)
- Session management
- Redirect otomatis berdasarkan role setelah login

### 2. Dashboard
- **Admin/Owner**: Overview keseluruhan sistem
  - Total barang
  - Total transaksi hari ini
  - Omzet hari ini
  - Stok rendah (threshold 10)
  - Chart penjualan 7 hari terakhir
- **Kasir**: Transaksi penjualan hari ini

### 3. Manajemen Barang (Admin Only)
- CRUD barang (Create, Read, Update, Delete)
- Kategori barang
- SKU (Stock Keeping Unit)
- Stok management
- Harga jual dan satuan

### 4. Transaksi Penjualan (Kasir Only)
- Point of Sale interface
- Pencarian barang
- Keranjang belanja
- Perhitungan subtotal dan total
- Pembayaran dan kembalian
- Update stok otomatis
- Cetak nota

### 5. Transaksi Pembelian (Admin)
- Pencatatan pembelian barang
- Update stok masuk
- Detail pembelian per barang
- Generate kode pembelian otomatis

### 6. Pelaporan (ADMIN dan Owner)
- Laporan penjualan harian/mingguan/bulanan
- Laporan pembelian
- Laporan stok barang
- Laporan omzet

### 7. Manajemen User (Admin only)
- CRUD user account
- Role assignment
- Password management

## Role dan Permission

### 1. Admin
**Program Flow:**
1. Login → Dashboard Admin
2. Akses penuh ke semua modul
3. Manajemen sistem dan user
4. Backup dan konfigurasi

**Tugas Utama:**
- Manajemen user (tambah, edit, hapus, reset password)
- Backup database otomatis/manual
- Konfigurasi sistem (pengaturan umum)
- Full access ke semua fitur (barang, kategori, penjualan, pembelian, laporan)
- Monitoring keseluruhan sistem
- Pengaturan keamanan sistem

**Fitur Akses:**
- Semua fitur sistem
- Dashboard admin dengan statistik lengkap
- Manajemen user dan role
- Backup dan restore database
- Konfigurasi aplikasi

### 2. Owner
**Program Flow:**
1. Login → Dashboard Owner
2. Fokus pada monitoring dan analisis
3. Akses laporan dan statistik
4. Tidak dapat melakukan transaksi langsung

**Tugas Utama:**
- Monitoring performa koperasi
- Analisis penjualan dan pembelian
- Melihat laporan keuangan
- Pengawasan stok barang
- Persetujuan pembelian (jika diperlukan)
- Cetak laporan untuk keperluan manajemen

**Fitur Akses:**
- Dashboard overview dengan chart dan statistik
- Laporan penjualan (harian, mingguan, bulanan)
- Laporan pembelian
- Laporan stok barang
- Laporan omzet dan profit
- View-only untuk manajemen barang dan kategori
- Tidak dapat melakukan transaksi penjualan/pembelian

### 3. Kasir
**Program Flow:**
1. Login → Dashboard Kasir
2. Fokus pada transaksi penjualan
3. Pencarian dan penjualan barang
4. Cetak nota dan laporan harian

**Tugas Utama:**
- Melakukan transaksi penjualan
- Pencarian barang berdasarkan nama/SKU
- Mengelola keranjang belanja
- Proses pembayaran dan hitung kembalian
- Cetak nota transaksi
- Update stok otomatis setelah penjualan
- Laporan penjualan harian

**Fitur Akses:**
- Dashboard kasir (transaksi hari ini)
- Point of Sale interface
- Pencarian dan view barang
- Transaksi penjualan
- Cetak nota
- Laporan penjualan harian
- View-only untuk stok barang
- Tidak dapat mengubah data master (barang, kategori, user)

## Helper Functions

### auth_helper.php
- `is_logged_in()`: Cek status login
- `current_user($key)`: Ambil data user saat ini
- `set_user_session($user)`: Set session user
- `destroy_user_session()`: Hapus session
- `require_login()`: Redirect ke login jika belum login

### role_helper.php
- `check_role($roles)`: Validasi role user
- Role validation untuk akses fitur tertentu

## Base Controller (MY_Controller.php)
- Extends CI_Controller
- Auto-load helpers
- Render method untuk template
- Common functionality

## Konfigurasi Utama

### Database Configuration
```php
$db['default'] = array(
    'dsn' => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'koperasi_pipl',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
```

### Session Configuration
- Driver: files
- Expiration: 7200 seconds (2 jam)
- Save path: application/cache/sessions

## Dependencies

### Composer Dependencies
```json
{
    "require": {
        "php": ">=5.3.7"
    }
}
```

Catatan: CodeIgniter 3 disertakan langsung dalam repository (folder `system/`), bukan diinstall via Composer.

## File Penting untuk Referensi

### Controllers
- `Auth.php`: Handle login/logout
- `Dashboard.php`: Dashboard dengan role-based view
- `Barang.php`: CRUD operations untuk barang
- `Penjualan.php`: Handle transaksi penjualan

### Models
- `User_model.php`: User authentication dan management
- `Barang_model.php`: Barang operations dan stock management
- `Penjualan_model.php`: Sales transactions dan reporting

### Views
- `auth/login.php`: Login form
- `dashboard/index.php`: Admin/Owner dashboard
- `dashboard/kasir.php`: Kasir dashboard
- `layouts/`: Template layouts

## Diagram Sistem

### Flowchart Aplikasi
1. Mulai → Cek Login
2. Jika belum login → Halaman Login
3. Jika sudah login → Dashboard
4. Dashboard → Cek Role
5. Role = Kasir → Alur Kasir
6. Role = Owner → Alur Owner
7. Role = Admin → Alur Admin
8. Setiap alur memiliki sub-flow untuk fitur spesifik

### Use Case Diagram
- **Kasir**: Lihat Dashboard, Cetak Nota, Kelola Stok (view only)
- **Owner**: Lihat Dashboard, Kelola Stok, Lihat Omzet, Cetak Laporan
- **Admin**: Semua use case Owner + Backup Data

### Class Diagram
- **Barang**: CRUD operations, stock checking
- **Kategori**: Basic CRUD
- **Penjualan**: Transaction creation, reporting
- **DetailPenjualan**: Transaction details
- **User**: Authentication, role management
- **Pembelian**: Purchase transactions
- **DetailPembelian**: Purchase details

## Testing dan Deployment

### Environment Setup
- XAMPP dengan PHP 8.2.12 (atau PHP 8.0+)
- MySQL/MariaDB 10.4.32
- Import database dari `database/koperasi_db.sql`
- Set base_url di config.php
- Nama database: `koperasi_pipl`
- Default user accounts tersedia di database

### Default Users
- **Admin**: username: admin, password: (hashed)
- **Kasir**: username: kasir, password: (hashed)
- **Owner**: username: owner, password: (hashed)

## Catatan Pengembangan

### Best Practices Implemented
- MVC Architecture
- Role-based access control
- Database transactions untuk data integrity
- Input validation
- Session security
- Session expiration: 7200 seconds (2 jam)
- CodeIgniter security features

### Areas for Improvement
- CSRF protection (currently disabled: `$config['csrf_protection'] = FALSE;`)
- Input sanitization enhancement
- Error logging implementation
- Unit testing
- API endpoints untuk mobile integration
- Implementasi supplier tracking dalam database (saat ini hanya dicatat di form)

## Struktur Laporan Proyek

Untuk membuat laporan proyek lengkap, sertakan bagian berikut:

1. **Pendahuluan**
   - Latar belakang koperasi
   - Tujuan pengembangan sistem
   - Ruang lingkup proyek

2. **Analisis Kebutuhan**
   - Functional requirements
   - Non-functional requirements
   - User roles dan permissions

3. **Perancangan Sistem**
   - Use case diagram
   - Class diagram
   - Database design
   - UI/UX design

4. **Implementasi**
   - Teknologi yang digunakan
   - Struktur aplikasi
   - Kode penting dan penjelasan

5. **Testing**
   - Unit testing
   - Integration testing
   - User acceptance testing

6. **Kesimpulan**
   - Pencapaian proyek
   - Kendala yang dihadapi
   - Saran pengembangan selanjutnya

---

*File referensi ini dibuat untuk memudahkan chatbot lain dalam membuat laporan proyek yang komprehensif berdasarkan kode dan struktur aplikasi yang ada.*
