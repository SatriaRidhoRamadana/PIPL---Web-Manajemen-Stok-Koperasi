# Timezone Configuration - Indonesia Western Time (WIB)

## Overview
Sistem telah dikonfigurasi untuk menggunakan timezone **Asia/Jakarta** (Indonesia Western Time - WIB), UTC+7.

## Configuration Points

### 1. **index.php** (Application Entry Point)
```php
// Line 309-311: Set timezone sebelum CodeIgniter bootstrap
date_default_timezone_set('Asia/Jakarta');
```

### 2. **application/config/config.php** (CodeIgniter Configuration)
```php
$config['time_reference'] = 'Asia/Jakarta';  // Line 500
$config['enable_hooks'] = TRUE;               // Line 105
```

### 3. **application/config/hooks.php** (System Hooks)
```php
$hook['pre_system'] = array(
    'class'    => '',
    'function' => 'set_timezone',
    'filename' => 'timezone.php',
    'filepath' => 'hooks',
    'params'   => array()
);

function set_timezone()
{
    date_default_timezone_set('Asia/Jakarta');
}
```

### 4. **application/hooks/timezone.php** (Hook Implementation)
Additional hook file untuk memastikan timezone consistency di semua database operations.

## Verifikasi Timezone

### Saat Testing dengan PHP CLI
```bash
php -r "date_default_timezone_set('Asia/Jakarta'); echo date('Y-m-d H:i:s');"
# Output: 2025-12-10 12:08:30 (WIB)
```

### Saat Application Running
- Semua `TIMESTAMP` di database akan menggunakan timezone WIB
- Fungsi `time()`, `date()`, dan `NOW()` akan mengembalikan waktu WIB
- Session timestamps akan sesuai WIB

## Database Timestamps

### Current Behavior
- **user_account**: `created_at` TIMESTAMP - WIB
- **barang**: `created_at` dan `updated_at` TIMESTAMP - WIB
- **penjualan**: `tanggal` DATETIME, `created_at` TIMESTAMP - WIB
- **pembelian**: `tanggal` DATETIME, `created_at` TIMESTAMP - WIB
- **detail_penjualan** & **detail_pembelian**: Mengikuti parent transaction - WIB

### MySQL Query untuk Verifikasi
```sql
-- Check MySQL timezone settings
SELECT @@global.time_zone, @@session.time_zone;

-- View current time in MySQL
SELECT NOW(), CURTIME(), CURDATE();

-- Set MySQL session timezone if needed (optional)
SET time_zone = '+07:00';
```

## Verification Steps

1. **Check PHP Timezone** (Console)
   ```bash
   php -i | grep timezone
   ```

2. **Check Application Logs**
   - Semua log timestamps akan menampilkan waktu WIB
   - File: `application/logs/log-*.php`

3. **Database Verification**
   - Login ke aplikasi dan buat transaksi
   - Periksa timestamp di database
   - Harus menunjukkan waktu WIB (UTC+7)

4. **Frontend Display**
   - Tampilan waktu di aplikasi akan menampilkan WIB
   - Use `date()` helper atau PHP date functions

## Related Files Modified

- ✅ `index.php` - Added timezone initialization
- ✅ `application/config/config.php` - Updated `time_reference` and `enable_hooks`
- ✅ `application/config/hooks.php` - Added pre_system hook
- ✅ `application/hooks/timezone.php` - New file for timezone management
- ✅ `docs/TIMEZONE.md` - This documentation

## Notes

- Timezone WIB (UTC+7) berlaku sepanjang tahun (tidak ada daylight saving)
- Semua timestamp di database dan PHP akan konsisten
- Session expiration juga akan menggunakan WIB
- Untuk operasi timezone-aware lainnya, gunakan `date_default_timezone_get()`

## Testing Recommendations

Setelah deployment:
1. Create a new transaction (penjualan/pembelian)
2. Check database timestamp
3. Compare with current time in Indonesia
4. Verify in application logs
5. Test report generation with timestamps
