-- Buat database
CREATE DATABASE IF NOT EXISTS db_skripsi;
USE db_skripsi;

-- Tabel user (untuk login semua role)
CREATE TABLE IF NOT EXISTS user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin','dosen','mahasiswa','kajur') NOT NULL
);

-- User admin default - zaky mubarok dengan password zky123
INSERT INTO user (username, password, role) VALUES ('zaky', '$2y$10$jYBVyf4vGhl0TonlWZNIJeTNYu6Ai6dMUiDv91Vtgtn8M2X6JgmIq', 'admin');

-- Tabel mahasiswa
CREATE TABLE IF NOT EXISTS mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nim VARCHAR(30) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL,
    prodi VARCHAR(100) NOT NULL
);

-- Data contoh mahasiswa
INSERT INTO mahasiswa (nama, nim, email, prodi) VALUES
('Ahmad Rizki', '2021001', 'ahmad.rizki@email.com', 'Teknik Informatika'),
('Siti Nurhaliza', '2021002', 'siti.nurhaliza@email.com', 'Sistem Informasi'),
('Budi Santoso', '2021003', 'budi.santoso@email.com', 'Teknik Informatika'),
('Dewi Sartika', '2021004', 'dewi.sartika@email.com', 'Sistem Informasi'),
('Muhammad Fajar', '2021005', 'muhammad.fajar@email.com', 'Teknik Informatika');

-- Tabel dosen
CREATE TABLE IF NOT EXISTS dosen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    nip VARCHAR(30) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL
);

-- Data contoh dosen
INSERT INTO dosen (nama, nip, email) VALUES
('Dr. Ir. Bambang Setiawan, M.T.', '198501012010011001', 'bambang.setiawan@email.com'),
('Dr. Siti Aminah, S.Kom., M.Kom.', '198602152010012002', 'siti.aminah@email.com'),
('Ir. Joko Widodo, M.T.', '198703202010011003', 'joko.widodo@email.com'),
('Dra. Sri Wahyuni, M.Kom.', '198804102010012004', 'sri.wahyuni@email.com'),
('Dr. Ahmad Hidayat, S.T., M.T.', '198905152010011005', 'ahmad.hidayat@email.com');

-- Tabel ruang penyimpanan
CREATE TABLE IF NOT EXISTS ruang_penyimpanan (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    lokasi VARCHAR(100) NOT NULL,
    keterangan VARCHAR(255)
);

-- Data contoh ruang penyimpanan
INSERT INTO ruang_penyimpanan (nama, lokasi, keterangan) VALUES
('Ruang Arsip A', 'Lantai 1 Gedung A', 'Untuk skripsi tahun 2020-2021'),
('Ruang Arsip B', 'Lantai 1 Gedung A', 'Untuk skripsi tahun 2021-2022'),
('Ruang Arsip C', 'Lantai 2 Gedung B', 'Untuk skripsi tahun 2022-2023'),
('Ruang Arsip D', 'Lantai 2 Gedung B', 'Untuk skripsi tahun 2023-2024'),
('Ruang Arsip E', 'Lantai 3 Gedung C', 'Untuk skripsi tahun 2024-2025');

-- Tabel pengajuan skripsi
CREATE TABLE IF NOT EXISTS pengajuan_skripsi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mahasiswa_nama VARCHAR(100) NOT NULL,
    judul VARCHAR(255) NOT NULL,
    tanggal DATE NOT NULL,
    status VARCHAR(50) NOT NULL
);

-- Data contoh pengajuan skripsi
INSERT INTO pengajuan_skripsi (mahasiswa_nama, judul, tanggal, status) VALUES
('Ahmad Rizki', 'Sistem Informasi Akademik Berbasis Web', '2024-01-15', 'Disetujui'),
('Siti Nurhaliza', 'Aplikasi E-Learning untuk Pembelajaran Jarak Jauh', '2024-01-20', 'Menunggu'),
('Budi Santoso', 'Sistem Monitoring Kehadiran Mahasiswa', '2024-01-25', 'Disetujui'),
('Dewi Sartika', 'Aplikasi Manajemen Perpustakaan Digital', '2024-02-01', 'Ditolak'),
('Muhammad Fajar', 'Sistem Informasi Geografis untuk Pariwisata', '2024-02-05', 'Menunggu');

-- Tabel jadwal UPS
CREATE TABLE IF NOT EXISTS jadwal_ups (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tanggal DATE NOT NULL,
    waktu TIME NOT NULL,
    ruangan VARCHAR(100) NOT NULL,
    keterangan VARCHAR(255)
);

-- Data contoh jadwal UPS
INSERT INTO jadwal_ups (tanggal, waktu, ruangan, keterangan) VALUES
('2024-03-15', '09:00:00', 'Ruang Sidang A', 'UPS Ahmad Rizki - Sistem Informasi Akademik'),
('2024-03-16', '10:00:00', 'Ruang Sidang B', 'UPS Siti Nurhaliza - E-Learning'),
('2024-03-17', '14:00:00', 'Ruang Sidang A', 'UPS Budi Santoso - Monitoring Kehadiran'),
('2024-03-18', '09:00:00', 'Ruang Sidang C', 'UPS Muhammad Fajar - SIG Pariwisata'),
('2024-03-19', '13:00:00', 'Ruang Sidang B', 'UPS Mahasiswa Baru - TBD');

-- Tabel skripsi
CREATE TABLE IF NOT EXISTS skripsi (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    mahasiswa_id INT NOT NULL,
    dosen_id INT NOT NULL,
    tahun VARCHAR(10) NOT NULL,
    file_arsip VARCHAR(255),
    ruang_penyimpanan_id INT,
    FOREIGN KEY (mahasiswa_id) REFERENCES mahasiswa(id),
    FOREIGN KEY (dosen_id) REFERENCES dosen(id),
    FOREIGN KEY (ruang_penyimpanan_id) REFERENCES ruang_penyimpanan(id)
);

-- Data contoh skripsi
INSERT INTO skripsi (judul, mahasiswa_id, dosen_id, tahun, file_arsip, ruang_penyimpanan_id) VALUES
('Sistem Informasi Akademik Berbasis Web', 1, 1, '2024', 'skripsi_ahmad_rizki.pdf', 1),
('Aplikasi E-Learning untuk Pembelajaran Jarak Jauh', 2, 2, '2024', 'skripsi_siti_nurhaliza.pdf', 1),
('Sistem Monitoring Kehadiran Mahasiswa', 3, 3, '2024', 'skripsi_budi_santoso.pdf', 2),
('Sistem Informasi Geografis untuk Pariwisata', 5, 4, '2024', 'skripsi_muhammad_fajar.pdf', 2);

-- Tambahkan user untuk dosen
INSERT INTO user (username, password, role) VALUES
('bambang', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dosen'),
('siti', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dosen'),
('joko', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'dosen');

-- Tambahkan user untuk mahasiswa
INSERT INTO user (username, password, role) VALUES
('ahmad', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mahasiswa'),
('siti_nur', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mahasiswa'),
('budi', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'mahasiswa');

-- Tambahkan user untuk kajur
INSERT INTO user (username, password, role) VALUES
('kajur', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'kajur');