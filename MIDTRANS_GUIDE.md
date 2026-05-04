# Panduan Integrasi Midtrans (Sandbox Mode)

Berikut adalah langkah-langkah untuk mengaktifkan Payment Gateway Midtrans pada project **Spektrum Multi Grafika**.

## 1. Registrasi Akun Midtrans Sandbox

1. Buka [Midtrans Dashboard](https://dashboard.midtrans.com/register).
2. Pastikan Anda berada di mode **Sandbox** (terlihat di pojok kiri atas dashboard).
3. Buka menu **Settings** > **Access Keys**.

## 2. Konfigurasi `.env`

Salin **Client Key** dan **Server Key** dari dashboard Midtrans ke file `.env` Anda:

```env
MIDTRANS_CLIENT_KEY=Mid-YOUR_CLIENT_KEY_HERE
MIDTRANS_SERVER_KEY=YOUR_SERVER_KEY_HERE
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

## 3. Konfigurasi Callback (Notification URL)

Agar status pesanan berubah otomatis dari `Menunggu Pembayaran` menjadi `Pending` (Siap Diproses), Anda harus mengatur Notification URL di dashboard Midtrans:

1. Di Dashboard Midtrans, buka menu **Settings** > **Configuration**.
2. Pada field **Payment Notification URL**, isi dengan:
   `https://domain-anda.com/midtrans-callback`
   _(Jika mencoba di localhost, Anda bisa menggunakan **Ngrok** untuk mendapatkan URL publik, misal: `https://abcd-123.ngrok-free.app/midtrans-callback`)_.
3. Simpan konfigurasi.

## 4. Cara Pengujian (Testing)

1. Lakukan pemesanan di website.
2. Di halaman pembayaran, klik tombol **BAYAR SEKARANG**.
3. Pilih metode pembayaran (misal: Bank Transfer - BCA).
4. Salin Nomor Virtual Account yang muncul.
5. Gunakan [Midtrans Simulator](https://simulator.sandbox.midtrans.com/bca/va/index) untuk melakukan simulasi pembayaran.
6. Masukkan nomor VA dan klik **Pay**.
7. Status di website akan berubah otomatis (setelah callback diterima).

## 5. File yang Telah Diubah

- `app/Http/Controllers/PublicOrderController.php`: Logika pembuatan token dan callback.
- `resources/views/publik/bayar.blade.php`: Tampilan baru yang lebih menarik & tombol Snap.
- `config/services.php`: Tempat konfigurasi Midtrans.
- `routes/web.php`: Penambahan route callback.
- `bootstrap/app.php`: Pengecualian CSRF untuk callback.
- `database/migrations/...`: Penambahan kolom `snap_token` di tabel orders.
