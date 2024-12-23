# UAS-Pemweb_Bagas-Andreanto_122140017
# F1 Academy Website

## Data Diri
- Nama: Bagas Andreanto
- NIM: 122140017
- Kelas: Pemrograman Web RA

## Deskripsi Proyek
Platform website ini dirancang untuk mendukung proses registrasi balapan dari akademi F1 yang merupakan lanjutan dari projek UTS. Pada web ini terdapat dua jenis user yaitu Pembalap, dan Admin. User dapat melakukan register dengan meninputkan username, email, dan password, kemudian login untuk dapat mengakses website. 
Pada halaman dashboard, user dapat menambahkan data pendaftaran (Create), membuka data (Read), memperbarui data (Update), dan menghapus data (Delete).

### Perbedaan hak akses untuk user:
Pembalap:
- hanya dapat melihat data user lain, tidak dapat menerapkan operasi update dan delete.
- tidak bisa mengakses data pengguna

Admin:
- bisa melakukan operasi CRUD pada semua data pengguna
- dapat mengakses informasi data pengguna (melihat alamat ip dan jenis browser pengguna)

### Akun Admin
- username: admin
- email: admin@f1.com
- password: admin123

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

![Form Input berupa Register](https://github.com/bagas017/UAS-Pemweb_Bagas-Andreanto_122140017/assets_readme/1_register.gif)

- **Tabel HTML**:
  - Data pendaftaran ditampilkan dalam tabel di halaman `users.php` menggunakan kombinasi PHP dan HTML.
 
  ![Tabel Users](https://github.com/username/repository/raw/main/image.png)


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

   ![Event Handling & Validasi JS](https://github.com/username/repository/raw/main/demo.gif)
  
---

### 2. Server-side Programming (Bobot: 30%)
#### 2.1 Pengelolaan Data dengan PHP (20%)
- **Metode POST/GET:**
  - Data dikirim ke server menggunakan metode POST di `register.php` dan `login.php`.
- **Validasi Sisi Server:**
  - Data divalidasi sebelum disimpan ke database.
- **Penyimpanan Data:**
  - Data pengguna, IP address, dan jenis browser disimpan di database pada proses registrasi.
 
   ![Penambahan data ke Database](https://github.com/username/repository/raw/main/demo.gif)

#### 2.2 Objek PHP Berbasis OOP (10%)
- **Class RaceManager:**
  - `registerRace`: Mendaftarkan pengguna ke race.
  - `getRaceDetails`: Mengambil detail race berdasarkan ID.
- **Penggunaan Objek:**
  - Objek digunakan di `registerace.php` dan `read.php` untuk menangani data race.

  ![OOP](https://github.com/username/repository/raw/main/image.png)

---

### 3. Database Management (Bobot: 20%)
#### 3.1 Pembuatan Tabel Database (5%)
- Tabel `users` dan `race_registration` dibuat untuk menyimpan data.

  ![Tabel users pada Database](https://github.com/username/repository/raw/main/image.png)
  ![Tabel race_registration pada Database](https://github.com/username/repository/raw/main/image.png)

#### 3.2 Konfigurasi Koneksi Database (5%)
- `config.php` digunakan untuk koneksi ke database.

  ![config menghubungkan ke database](https://github.com/username/repository/raw/main/image.png)

#### 3.3 Manipulasi Data pada Database (10%)
- **CRUD Operations:**
  - Tambah data pengguna di `register.php`.
  - Tampilkan data di `dashboard.php`.
  - Ubah data race di `update.php`.
  - Hapus data race di `delete.php`.

   ![Operasi CRUD](https://github.com/username/repository/raw/main/demo.gif)

---

### 4. State Management (Bobot: 20%)
#### 4.1 State Management dengan Session (10%)
- **Session:**
  - Sesi dimulai dengan `session_start()`.
  - Informasi pengguna seperti `user_id`, `username`, dan token disimpan dalam session.

  ![Session](https://github.com/username/repository/raw/main/image.png)

#### 4.2 Pengelolaan State dengan Cookie dan Browser Storage (10%)
- **Cookie:**
  - Token pengguna disimpan di cookie saat login dan dihapus saat logout.

  ![Cookie](https://github.com/username/repository/raw/main/demo.gif)
  
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
