# 🖨️ Spektrum Multi Grafika - Web Printing System

![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

🖨️ Spektrum Multi Grafika - Web Printing System
Spektrum Multi Grafika adalah sistem informasi pemesanan percetakan digital berbasis web yang modern dan responsif. Sistem ini dirancang untuk mempermudah pelanggan melakukan pemesanan dari mana saja tanpa perlu membuat akun (Guest Checkout), serta membantu staf operasional (Kasir) dan pemilik (Admin) dalam mengelola antrean, file desain, dan laporan transaksi secara efisien.

🎯 Tujuan Sistem
Mempermudah pemesanan jasa cetak melalui sistem multi-step form online maupun pesanan walk-in (langsung).

Mempermudah pelanggan dalam mengirimkan instruksi, berkas desain, dan verifikasi pembayaran.

Menyediakan dasbor pengelolaan operasional yang real-time dan efisien bagi Kasir dan Admin.

✨ Fitur Unggulan
🛒 1. Modul Pelanggan (Public Interface)
Fitur yang dapat diakses oleh pengguna umum untuk melakukan pemesanan secara mandiri.

Guest Checkout (Tanpa Login): Mempercepat alur konversi pesanan.

Katalog Layanan Digital: Menampilkan daftar jasa percetakan, harga, dan deskripsi.

Multi-Step Order (Formulir Berurutan):

Tahap 1: Input identitas (Nama, WA, Alamat), pemilihan layanan, dan Catatan.

Tahap 2: Wajib unggah foto KTP (Verifikasi) & file desain (opsional untuk jasa tertentu).

Tahap 3: Konfirmasi Harga Total & Pembayaran.

Struk Digital & Thermal Print: Generasi struk dengan nomor resi unik yang dioptimalkan untuk printer thermal (80mm) sebagai bukti pengambilan barang.

🧑‍💻 2. Modul Operasional Kasir (Staff Interface)
Fitur khusus untuk staf toko dalam mengelola antrean dan pesanan.

Dashboard Monitoring Real-Time: Ringkasan statistik (Total Antrean, Pesanan Pending, Selesai).

Manajemen Status Produksi: Ubah status pesanan (Pending ➔ Diproses ➔ Selesai) cukup dengan dropdown.

Pusat Detail Pesanan (Modal View): Tampilan pop-up (menggunakan Alpine.js) untuk melihat detail transaksi, instruksi khusus, verifikasi KTP, cek bukti transfer, dan tombol download file desain langsung dalam satu layar.

👑 3. Modul Administrasi & Manajemen (Admin Interface)
Fitur untuk pemilik atau administrator sistem.

Laporan Transaksi: Memantau pendapatan dan total pesanan yang masuk ke sistem.

Manajemen Layanan (CRUD Service): Menambah, mengubah, atau menghapus jenis jasa, satuan (Pcs, Meter, Lembar), dan harga.

Kendali Sistem: Hak akses penuh untuk menghapus data pesanan/transaksi yang tidak valid.

🛠️ Teknologi yang Digunakan (Tech Stack)
Sistem ini dibangun menggunakan arsitektur MVC (Model-View-Controller) dengan teknologi:

Framework Backend: Laravel 11 (PHP)

Frontend & UI/UX: Tailwind CSS & Alpine.js (Blade Templating)

Database: MySQL / SQLite

File Storage: Local Public Storage (Symlink) untuk pengamanan berkas KTP dan Desain.

🚀 Panduan Instalasi & Menjalankan Proyek
Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer lokal Anda:

1. Prasyarat Sistem
PHP >= 8.2

Composer

Node.js & NPM

XAMPP / Laragon (Untuk server MySQL lokal)

2. Langkah Instalasi
Clone Repositori:

git clone https://github.com/zulfa45/Sistem-Pemesanan-Percetakan---Laravel.git

cd Sistem-Pemesanan-Percetakan---Laravel

Install Dependencies (Backend & Frontend):

composer install

npm install

Pengaturan Environment (.env):

Salin file .env.example dan ubah namanya menjadi .env.

Buka file .env dan atur koneksi database Anda (DB_DATABASE, DB_USERNAME, dll).

Generate Application Key:

php artisan key:generate

Migrasi Database:

php artisan migrate:fresh

Tautkan Folder Penyimpanan (Sangat Penting!):
Perintah ini wajib dijalankan agar file desain, KTP, dan bukti pembayaran pelanggan dapat diakses oleh sistem.

php artisan storage:link

Build Aset Frontend:
Jalankan perintah ini untuk merender Tailwind CSS.

npm run build

Jalankan Server Lokal Laravel:

php artisan serve

Aplikasi sekarang bisa diakses di browser pada: http://127.0.0.1:8000

🔐 Akses Akun Default (Testing)
Jika database masih kosong setelah migrasi, buka terminal Anda, ketik php artisan tinker, lalu paste kode berikut secara berurutan untuk membuat akun bawaan:

App\Models\User::create(['name' => 'Admin Spektrum', 'email' => 'admin@admin', 'password' => bcrypt('11223344'), 'role' => 'admin']);

App\Models\User::create(['name' => 'Kasir Spektrum', 'email' => 'kasir@admin', 'password' => bcrypt('11223344'), 'role' => 'kasir']);

📖 Panduan Penggunaan (Tutorial Aplikasi)
Untuk menguji alur sistem (Testing Flow), ikuti langkah-langkah berikut:

Tahap 1: Setup Awal (Sebagai Admin)
Buka http://127.0.0.1:8000/login.

Login menggunakan Email: admin@admin | Password: 11223344.

Masuk ke menu "Kelola Jasa" di navigasi atas.

Tambahkan minimal 1 jenis jasa cetak (Contoh: "Cetak Spanduk Banner", Satuan: "Meter", Harga: 25000).

Logout dari akun Admin.

Tahap 2: Simulasi Pemesanan (Sebagai Pelanggan Publik)
Buka halaman utama web di http://127.0.0.1:8000.

Klik tombol "Pesan Sekarang". Anda tidak perlu login.

Isi data diri, unggah foto KTP, pilih Jasa Cetak, masukkan jumlah pesanan, dan unggah file Desain Anda.

Klik "Lanjut ke Pembayaran".

Sistem akan menampilkan total harga secara otomatis. Silakan pilih bank dan unggah gambar Bukti Transfer sembarang untuk simulasi.

Klik konfirmasi, dan Anda akan mendapatkan Struk Digital dengan Nomor Resi (contoh: SPK-ABCD123).

Tahap 3: Simulasi Penerimaan Order (Sebagai Kasir)
Buka kembali halaman http://127.0.0.1:8000/login.

Login menggunakan Email: kasir@admin | Password: 11223344.

Di Dashboard Kasir, pesanan yang baru saja dibuat oleh pelanggan akan muncul dalam tabel antrean.

Klik tombol hitam "Lihat Detail Lengkap".

Pop-up Modal akan terbuka menampilkan detail pesanan, foto KTP, gambar bukti bayar, dan tombol untuk mendownload file desain pelanggan.

Pada kolom aksi di tabel, ubah status pesanan dari "Tertunda (Pending)" menjadi "Kerjakan (Proses)", lalu "Selesai Cetak".
