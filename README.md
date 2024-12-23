# UAS-Pemweb_Bagas-Andreanto_122140017
# F1 Academy Platform

## Data Diri
- Nama: Bagas Andreanto
- NIM: 122140017
- Kelas: Pemrograman Web RA

## Deskripsi Proyek
Platform website ini dirancang untuk mendukung proses registrasi balapan dari akademi F1 yang merupakan lanjutan dari projek UTS. Pada web ini terdapat dua jenis user yaitu Pembalap, dan Admin. Untuk user sebagai pembalap dapat melakukan registrasi dengan username, akun, dan password. Kemudian dapat login ke website dengan akun dan password yang sudah di daftarkan sebelumnya. 
Setelah login user akan berada pada halaman dahboard yang merupakan halaman pendaftaran untuk Race dengan terdapat tabel para pendaftar, tombol daftar, tombol data user, beberapa tombol operasi tabel seperti read, update, dan delete, serta tombol logout untuk keluar.
User (pembalap) dapat melakukan pendaftaran dengan mengklik tombol daftar race baru.

Platform ini dirancang untuk mendukung proses registrasi, manajemen data, dan otentikasi pengguna untuk F1 Academy. Sistem ini mengintegrasikan komponen client-side dan server-side untuk memenuhi ketentuan UAS Pemrograman Web.

---

## Struktur Proyek

### 1. Client-side Programming (Bobot: 30%)
#### 1.1 Manipulasi DOM dengan JavaScript (15%)
- **Form Input**:
  - Form registrasi dan login memiliki elemen input seperti:
    - Username
    - Email
    - Password
    - Konfirmasi Password
- **Tabel HTML**:
  - Data pendaftaran ditampilkan dalam tabel di halaman `dashboard.php` menggunakan kombinasi PHP dan HTML.

#### 1.2 Event Handling (15%)
- **Event Handling:**
  - `input`: Validasi panjang password di `register.js` dan `login.js`.
  - `blur`: Validasi format email di `login.js`.
  - `submit`: Validasi form sebelum data dikirim ke server.
  - `click`: Menampilkan atau menyembunyikan form menggunakan `main.js`.
- **Validasi Input:**
  - Password minimal 8 karakter.
  - Format email harus valid.
  - Password dan konfirmasi password harus cocok.

---

### 2. Server-side Programming (Bobot: 30%)
#### 2.1 Pengelolaan Data dengan PHP (20%)
- **Metode POST/GET:**
  - Data dikirim ke server menggunakan metode POST di `register.php` dan `login.php`.
- **Validasi Sisi Server:**
  - Data divalidasi sebelum disimpan ke database.
- **Penyimpanan Data:**
  - Data pengguna, IP address, dan jenis browser disimpan di database pada proses registrasi.

#### 2.2 Objek PHP Berbasis OOP (10%)
- **Class RaceManager:**
  - `registerRace`: Mendaftarkan pengguna ke race.
  - `getRaceDetails`: Mengambil detail race berdasarkan ID.
- **Penggunaan Objek:**
  - Objek digunakan di `registerace.php` dan `read.php` untuk menangani data race.

---

### 3. Database Management (Bobot: 20%)
#### 3.1 Pembuatan Tabel Database (5%)
- Tabel `users` dan `race_registration` dibuat untuk menyimpan data.

#### 3.2 Konfigurasi Koneksi Database (5%)
- `config.php` digunakan untuk koneksi ke database.

#### 3.3 Manipulasi Data pada Database (10%)
- **CRUD Operations:**
  - Tambah data pengguna di `register.php`.
  - Tampilkan data di `dashboard.php`.
  - Ubah data race di `update.php`.
  - Hapus data race di `delete.php`.

---

### 4. State Management (Bobot: 20%)
#### 4.1 State Management dengan Session (10%)
- **Session:**
  - Sesi dimulai dengan `session_start()`.
  - Informasi pengguna seperti `user_id`, `username`, dan token disimpan dalam session.

#### 4.2 Pengelolaan State dengan Cookie dan Browser Storage (10%)
- **Cookie:**
  - Token pengguna disimpan di cookie saat login dan dihapus saat logout.
- **Browser Storage:**
  - LocalStorage digunakan di `registerace.php` untuk menyimpan data form secara lokal.

---

## File dan Fungsinya

| File            | Fungsi                                                   |
|-----------------|---------------------------------------------------------|
| `config.php`    | Mengatur koneksi ke database.                           |
| `dashboard.php` | Menampilkan data pendaftaran dan navigasi.              |
| `register.php`  | Menangani registrasi pengguna baru.                     |
| `login.php`     | Proses login pengguna.                                  |
| `logout.php`    | Menghapus sesi dan cookie pengguna.                     |
| `read.php`      | Menampilkan detail data race.                           |
| `update.php`    | Mengubah data pendaftaran race.                         |
| `delete.php`    | Menghapus data pendaftaran race.                        |
| `race_manager.php` | Class PHP untuk pengelolaan data race.               |
| `main.js`       | Mengatur interaksi form login dan registrasi.           |
| `login.js`      | Validasi form login.                                    |
| `register.js`   | Validasi form registrasi.                               |

---

## Cara Instalasi
1. Clone repository ini:
   ```bash
   git clone https://github.com/username/f1-academy-platform.git
   ```
2. Masuk ke direktori proyek:
   ```bash
   cd f1-academy-platform
   ```
3. Konfigurasi database:
   - Buat database MySQL.
   - Import file `database.sql`.
   - Edit file `config.php` sesuai pengaturan database Anda.
4. Jalankan server lokal:
   - Gunakan XAMPP atau WAMP untuk menjalankan server PHP.

---

## Lisensi
Proyek ini dilisensikan di bawah [MIT License](LICENSE).
