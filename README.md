# Sistem Manajemen Skripsi

Sistem manajemen skripsi berbasis web untuk mengelola data skripsi mahasiswa, dosen, jadwal UPS, dan ruang penyimpanan.

## 🚀 Fitur Utama

### Admin
- ✅ **Dashboard** - Overview sistem
- ✅ **Manajemen Mahasiswa** - CRUD data mahasiswa
- ✅ **Manajemen Dosen** - CRUD data dosen  
- ✅ **Manajemen Skripsi** - CRUD data skripsi dengan tampilan menarik
- ✅ **Upload Arsip** - Upload file skripsi (PDF/DOC/DOCX)
- ✅ **Jadwal UPS** - Kelola jadwal ujian pendadaran
- ✅ **Ruang Penyimpanan** - Kelola ruang arsip skripsi
- ✅ **Pengajuan Skripsi** - Review pengajuan mahasiswa

### Dosen
- ✅ **Beranda** - Dashboard dosen
- ✅ **Inventori** - Lihat skripsi yang dibimbing
- ✅ **Jadwal** - Lihat jadwal UPS
- ✅ **Pengajuan** - Review pengajuan skripsi
- ✅ **Profil** - Edit profil dan ganti password

### Mahasiswa
- ✅ **Beranda** - Dashboard mahasiswa
- ✅ **Jadwal** - Lihat jadwal UPS
- ✅ **Pengajuan** - Ajukan skripsi

### Kajur
- ✅ **Dashboard** - Overview untuk kajur
- ✅ **Skripsi Tersimpan** - Lihat arsip skripsi
- ✅ **Pengajuan** - Review pengajuan

## 🛠️ Teknologi

- **Backend**: PHP Native (MVC Pattern)
- **Database**: MySQL
- **Frontend**: Bootstrap 5 + Font Awesome
- **Server**: XAMPP (Apache + MySQL)

## 📋 Persyaratan Sistem

- PHP 7.4 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Apache Web Server
- XAMPP (direkomendasikan)

## 🚀 Cara Install & Setup

### 1. Clone/Download Project
```bash
# Download project ke folder htdocs XAMPP
C:\xampp\htdocs\project_skripsi\
```

### 2. Setup Database
1. **Buka phpMyAdmin**: `http://localhost/phpmyadmin`
2. **Buat database baru**: `db_skripsi`
3. **Import file**: `database.sql`
4. **Verifikasi**: Pastikan semua tabel terbuat

### 3. Konfigurasi Database
File: `config/config.php`
```php
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'db_skripsi';
```

### 4. Test Koneksi
```bash
# Jalankan test koneksi
php test_connection.php

# Jalankan test login
php test_login.php

# Jalankan test pengajuan skripsi
php test_pengajuan.php

# Jalankan test jadwal UPS
php test_jadwal_ups.php

# Jalankan test ruang penyimpanan
php test_ruang_penyimpanan.php

## 🔐 Login Default

### Admin
- **URL**: `http://localhost/project_skripsi/index.php?role=admin&controller=Login&action=index`
- **Username**: `zaky`
- **Password**: `zky123`

### Dosen
- **Username**: `bambang`, `siti`, `joko`
- **Password**: `zky123`

### Mahasiswa  
- **Username**: `ahmad`, `siti_nur`, `budi`
- **Password**: `zky123`

### Kajur
- **Username**: `kajur`
- **Password**: `zky123`

## 📁 Struktur Project

```
project_skripsi/
├── assets/                 # CSS, JS, Images
├── config/                 # Konfigurasi database & auth
├── controllers/           # Controller untuk setiap role
│   ├── admin/
│   ├── dosen/
│   ├── kajur/
│   └── mahasiswa/
├── models/                # Model database
├── uploads/               # Folder upload file
├── views/                 # View/template
│   ├── admin/
│   ├── dosen/
│   ├── kajur/
│   └── mahasiswa/
├── index.php              # Router utama
├── database.sql           # Struktur database
└── README.md
```

## 🎨 Fitur UI/UX Terbaru

### ✅ Tampilan Modern
- **Bootstrap 5** dengan gradient background
- **Font Awesome** icons
- **Responsive design** untuk mobile
- **Card-based layout** yang clean

### ✅ Halaman Skripsi yang Diperbaiki
- **List Skripsi**: Tabel dengan hover effects
- **Detail Skripsi**: Layout card yang informatif
- **Upload Arsip**: Drag & drop area yang menarik
- **Form Tambah/Edit**: Validasi dan UX yang baik

### ✅ Halaman Pengajuan Skripsi yang Diperbaiki
- **List Pengajuan**: Tabel dengan status badges berwarna
- **Detail Pengajuan**: Timeline dan informasi lengkap
- **Form Tambah/Edit**: Dropdown status dan validasi
- **Statistik**: Card dengan jumlah per status

### ✅ Navigasi yang Mudah
- **Breadcrumb navigation**
- **Action buttons** dengan icons
- **Status badges** yang informatif
- **Confirmation dialogs** untuk aksi penting

## 🔧 Perbaikan yang Telah Dilakukan

### ✅ Database
- **Hapus duplikasi data** di `database.sql`
- **Perbaiki password hash** untuk admin
- **Struktur tabel** yang konsisten

### ✅ Backend
- **Perbaiki error koneksi** di view
- **Tambahkan method** yang hilang di controller
- **Validasi input** yang lebih baik
- **Error handling** yang proper
- **Perbaiki model PengajuanSkripsi** dan Skripsi

### ✅ Frontend  
- **Redesign halaman skripsi** dengan Bootstrap 5
- **Tambah icons** dan visual elements
- **Improve responsive design**
- **Better user experience**
- **Redesign halaman pengajuan skripsi** dengan UI yang menarik
- **Redesign halaman jadwal UPS** dengan responsive design
- **Tambah fitur detail** untuk semua entitas
- **Statistik dan dashboard** yang informatif

## 🚨 Troubleshooting

### Error "Undefined variable $conn"
**Solusi**: Sudah diperbaiki dengan menambahkan koneksi di view

### Error "mysqli_query(): Argument #1 must be of type mysqli"
**Solusi**: Sudah diperbaiki dengan menggunakan class Database

### Error di halaman Jadwal UPS
**Solusi**: Sudah diperbaiki dengan:
- Menghilangkan penggunaan model langsung di view
- Menggunakan Database class untuk koneksi
- Menambahkan method detail() di controller
- Redesign UI dengan Bootstrap dan responsive design

### Error di halaman Ruang Penyimpanan
**Solusi**: Sudah diperbaiki dengan:
- Menghilangkan penggunaan model langsung di view
- Menggunakan Database class untuk koneksi
- Menambahkan method detail() di controller
- Redesign UI dengan tema informatika (gradient biru)
- Menambahkan fitur monitoring dan status sistem

### Database tidak terhubung
**Solusi**: 
1. Pastikan XAMPP berjalan
2. Import database.sql
3. Cek konfigurasi di config.php

### Login gagal
**Solusi**:
1. Pastikan database sudah diimport
2. Cek username/password default
3. Jalankan test_login.php

## 📞 Support

Jika ada masalah atau pertanyaan:
1. Cek file `test_connection.php` dan `test_login.php`
2. Pastikan semua persyaratan terpenuhi
3. Cek error log Apache/PHP

## 🎯 Status Project

**✅ READY TO USE** - Sistem sudah siap digunakan dengan:
- Database yang bersih
- UI/UX yang modern
- Error handling yang baik
- Dokumentasi lengkap

---

**Happy Coding! 🚀**
