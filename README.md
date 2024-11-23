## Hutan Pinusan Kalilo - Sistem Pemesanan Tiket Online
Aplikasi web pemesanan tiket untuk wisata Hutan Pinusan Kalilo. Sistem ini memungkinkan pengunjung untuk memesan tiket secara online, melihat status pemesanan, dan mengelola tiket mereka.
##🌟 Fitur
Pengunjung

## Autentikasi pengguna (login/register)
- Pemesanan tiket online
- Upload bukti pembayaran
- Lihat status pemesanan
- Download tiket yang sudah dikonfirmasi
- Virtual tour lokasi wisata

## Admin

- Dashboard admin
- Manajemen pemesanan tiket
- Konfirmasi pembayaran
- Laporan pemesanan

## 🚀 Teknologi yang Digunakan

- Framework: Laravel 11.0
- Frontend:

 - Tailwind CSS
 - Alpine.js
 - Blade Template


- Admin Panel: Filament
- Database: MySQL
- File Storage: Laravel Storage

## 💻 Instalasi

Clone repository
```
bashCopygit clone https://github.com/yourusername/hutan-pinusan-kalilo.git
cd hutan-pinusan-kalilo
```

Install dependencies
```
bashCopycomposer install
npm install
```

Setup environment
```
bashCopycp .env.example .env
php artisan key:generate
```

Konfigurasi database di file .env
```
envCopyDB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laraveltiket
DB_USERNAME=root
DB_PASSWORD=
```
 
Jalankan migrasi dan seeder
```
bashCopyphp artisan migrate --seed
```

Link storage
```
bashCopyphp artisan storage:link
```

Jalankan server
```
bashCopyphp artisan serve
```
## 📁 Struktur Database
Tabel pengunjung

- id (PK)
- name
- email (unique)
- phone
- password
- remember_token
- created_at
- updated_at

Tabel pemesanan

- id (PK)
- order_code (unique)
- visitor_id (FK)
- order_date
- num_people
- price
- proof_of_payment
- status
- created_at
- updated_at

## 👥 User Roles
Admin

- Akses ke dashboard admin
- Manajemen semua pemesanan
- Konfirmasi pembayaran
- Lihat laporan

Pengunjung

- Pemesanan tiket
- Upload bukti pembayaran
- Lihat status pemesanan
- Download tiket

## 🔒 Authentication

- Login menggunakan email dan password
- Register dengan nama, email, dan password
- Middleware auth untuk halaman terproteksi

## 📱 Responsif
- Aplikasi dioptimalkan untuk:

- Desktop (>1024px)
- Tablet (768px - 1024px)
- Mobile (<768px)

## 📷 Screenshot
![image](https://github.com/user-attachments/assets/5e53d095-d1fa-4b37-b158-931fb1ae79df)
Halaman Utama
![image](https://github.com/user-attachments/assets/b80df51c-f599-4143-aa58-e712c9b50f51)
Halaman Pemesanan
![image](https://github.com/user-attachments/assets/c205271b-4b50-4e2c-988d-c7b256d809e3)
Dashboard Admin
![image](https://github.com/user-attachments/assets/53950639-6eae-4978-827c-1d21109ce843)

## 🤝 Kontribusi
Kontribusi selalu disambut baik! Silakan buat pull request untuk:

- Bug fixes
- New features
- Documentation improvements

## 📝 License
- MIT License
## 👨‍💻 Developer
- Ilham Setyaka

- GitHub: @GalyleoIlhamSetyaka

## 🙏 Acknowledgments

- Laravel
- Filament
- Tailwind CSS
- Alpine.js

## 📞 Contact
- Untuk pertanyaan dan saran, silakan hubungi:

- Email: your-email@example.com
- GitHub Issues: New Issue


## Dibuat dengan ❤️ untuk Hutan Pinusan Kalilo
