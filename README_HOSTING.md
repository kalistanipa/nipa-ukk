# Panduan Deployment: Vercel + Aiven MySQL

Ikuti langkah-langkah di bawah ini untuk menghosting proyek **Peminjaman Buku** Anda.

## Langkah 1: Siapkan Database di Aiven
1. Daftar/Masuk ke [aiven.io](https://aiven.io/).
2. Buat layanan baru (**Create Service**).
3. Pilih **MySQL**.
4. Pilih Cloud Provider (misal: DigitalOcean atau Google Cloud) dan Region terdekat (misal: Singapore).
5. Pilih Plan gratis (**Free Tier**) jika tersedia, atau plan terkecil.
6. Setelah layanan aktif, buka tab **Overview** dan catat informasi berikut:
   - **Host**
   - **Port**
   - **User** (biasanya `avnadmin`)
   - **Password**
   - **Database** (biasanya `defaultdb`)

## Langkah 2: Impor Data ke Aiven
1. Gunakan aplikasi database client seperti **HeidiSQL**, **DBeaver**, atau **phpMyAdmin** (jika ada).
2. Hubungkan ke Aiven menggunakan detail di atas.
3. Jalankan isi dari file `db_perpustakaan.sql` di database Aiven tersebut.

> [!IMPORTANT]
> Pastikan SSL diaktifkan pada database client Anda saat menghubungkan ke Aiven.

## Langkah 3: Konfigurasi Vercel
1. Upload proyek Anda ke **GitHub**.
2. Masuk ke [Vercel](https://vercel.com/) dan buat project baru dari repositori GitHub tersebut.
3. Di bagian **Environment Variables**, tambahkan variabel berikut:
   - `DB_HOST`: [Host dari Aiven]
   - `DB_PORT`: [Port dari Aiven, misal 12345]
   - `DB_USER`: `avnadmin`
   - `DB_PASS`: [Password dari Aiven]
   - `DB_NAME`: `defaultdb` (atau sesuai yang Anda buat)
   - `DB_SSL`: `true`

## Langkah 4: Deploy
1. Klik **Deploy**.
2. Vercel akan memproses file `vercel.json` dan menggunakan runtime PHP.
3. Setelah selesai, buka URL yang diberikan oleh Vercel.

## Tips Debugging
Jika Anda menemui masalah koneksi:
- Periksa tab **Logs** di Vercel.
- Akses `/test_db.php` di URL Vercel Anda untuk mengetes apakah koneksi ke Aiven berhasil.
- Pastikan Aiven tidak memblokir IP Vercel (karena Vercel menggunakan IP dinamis, biasanya di Aiven Anda perlu mengizinkan `0.0.0.0/0` di bagian **IP Allowlist**).
