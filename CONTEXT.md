# WashWire Laundry — Konteks Proyek

> Proyek ini adalah **Sistem Manajemen Laundry** berbasis web yang dibangun untuk memenuhi tugas **CPMK4 ProjekTim PemwebII**. Aplikasi ini memungkinkan admin dan kasir untuk mengelola transaksi laundry dari hulu ke hilir. Pelanggan dapat melacak status cucian melalui landing page publik tanpa perlu login.

---

## Tech Stack

| Teknologi | Detail |
|---|---|
| **Backend** | Laravel 13.8 |
| **Frontend** | Livewire 4.3, Alpine.js 3, Tailwind CSS 3, Vite |
| **Database** | MySQL (`pemwebcpmk4`) |
| **Auth** | Laravel Breeze |
| **PDF** | barryvdh/laravel-dompdf (struk receipt) |

---

## Arsitektur & Alur

### Role Pengguna

| Role | Akses |
|---|---|
| **Admin** | Dashboard, Kelola Paket (CRUD), Tracking, Cetak Struk |
| **Kasir** | Dashboard, Kasir (buat transaksi), Tracking, Cetak Struk |

> **Catatan:** Tidak ada role pelanggan. Pelanggan melacak cucian via landing page publik (`/`) dengan memasukkan nomor invoice.

### Routes Utama

| Method | URI | Nama | Middleware | Handler |
|---|---|---|---|---|
| GET | `/` | `landing` | — (publik) | `CekStatusCucian` (Livewire) |
| GET | `/dashboard` | `dashboard` | auth, verified | `Dashboard` (Livewire) |
| GET | `/kasir` | `kasir.index` | auth, role:admin,kasir | `TransaksiForm` (Livewire) |
| GET | `/tracking` | `tracking.index` | auth, role:admin,kasir | `TransaksiTracking` (Livewire) |
| GET | `/struk/{transaksi}` | `struk.cetak` | auth, role:admin,kasir | `StrukController@cetak` |
| GET | `/paket` | `paket.index` | auth, role:admin | `PaketIndex` (Livewire) |
| GET | `/paket/buat` | `paket.buat` | auth, role:admin | `PaketForm` (Livewire) |
| GET | `/paket/{paket}/edit` | `paket.edit` | auth, role:admin | `PaketForm` (Livewire) |

### Alur Transaksi

```
Kasir input transaksi → Status "antrean" → "dicuci" → "disetrika" → "siap_diambil"
```
- Status maju satu arah (linear), tidak bisa mundur.
- Setiap klik tombol status di halaman Tracking memajukan status ke tahap berikutnya.
- Setelah transaksi dibuat, struk PDF otomatis terbuka di tab baru.

---

## Database Schema

### `users`

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint unsigned, PK | |
| name | varchar(255) | |
| email | varchar(255) | unique |
| role | string | default 'kasir' |
| password | varchar(255) | hashed |

### `paket_laundrys`

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint unsigned, PK | |
| nama | varchar(255) | e.g. "Cuci Komplit" |
| harga_per_kg | decimal(10,2) | |
| satuan | varchar(255) | default 'kg' |

Seeder default: Cuci Komplit (Rp8.000), Cuci Kering (Rp5.000), Setrika Saja (Rp6.000), Cuci Kilat 24 Jam (Rp12.000).

### `transaksis`

| Kolom | Tipe | Keterangan |
|---|---|---|
| id | bigint unsigned, PK | |
| no_nota | varchar(255) | unique, format `INV-XXXX` |
| nama_pelanggan | varchar(255) | |
| no_hp | varchar(255) | nullable |
| paket_laundry_id | bigint unsigned, FK | → `paket_laundrys.id` (cascade) |
| berat | decimal(8,2) | dalam kg |
| total_harga | decimal(10,2) | `harga_per_kg × berat` |
| status | enum('antrean','dicuci','disetrika','siap_diambil') | default 'antrean' |
| user_id | bigint unsigned, FK | → `users.id` (cascade), siapa kasir yang input |

### Relasi

```
User (1) ──< (N) Transaksi     (kasir membuat banyak transaksi)
PaketLaundry (1) ──< (N) Transaksi   (satu paket dipakai di banyak transaksi)
```

---

## Komponen Livewire

### `CekStatusCucian` (`/`)
Halaman landing page publik (tanpa auth) untuk pelanggan melacak status cucian. Menerima input nomor invoice, menampilkan detail transaksi dan progress timeline.

### `Dashboard` (`/dashboard`)
Menampilkan ringkasan: total transaksi hari ini, pemasukan hari ini, cucian pending (belum siap_diambil), dan 5 transaksi terbaru.

### `TransaksiForm` (`/kasir`)
- Form input transaksi baru: nama pelanggan, no HP (opsional), pilih paket, berat.
- **Computed property** `totalHarga()` — kalkulasi otomatis `harga_per_kg × berat` secara real-time.
- Nomor nota dibuat otomatis: `INV-` + urutan (padded 4 digit).
- Setelah simpan, dispatch event `buka-struk-baru` untuk membuka PDF struk di tab baru.

### `TransaksiTracking` (`/tracking`)
- Tabel daftar semua transaksi dengan fitur pencarian (live search).
- Setiap baris memiliki tombol status — diklik untuk memajukan status.
- Tombol "Cetak Ulang" untuk membuka ulang PDF struk.

### `PaketIndex` (`/paket`)
- Daftar paket laundry dengan pagination (10/halaman).
- Tombol hapus dengan konfirmasi.

### `PaketForm` (`/paket/buat`, `/paket/{paket}/edit`)
- Form create/edit paket laundry.
- Field: nama, harga_per_kg, satuan (kg/item).

---

## Struk PDF

Menggunakan **DomPDF** dengan ukuran thermal printer (lebar 80mm). Controller `StrukController@cetak` me-load transaksi dengan relasi `paket` dan `kasir`, lalu me-render view `resources/views/struk/cetak.blade.php` ke PDF.

---

## Seeder Default

```bash
php artisan db:seed
```

| Seeder | Isi |
|---|---|
| `UserSeeder` | admin@washwire.com / password (role: admin), kasir@washwire.com / password (role: kasir) |
| `PaketLaundrySeeder` | 4 paket laundry |
| `TransaksiSeeder` | 3 transaksi contoh (status berbeda-beda) |

---

## Catatan Penting

- Semua halaman utama menggunakan **Livewire full-page component** — tidak ada controller tradisional untuk rute-rute ini.
- Landing page (`/`) bersifat **publik** dan menggunakan layout `guest-tracking` — tanpa navigasi auth.
- Middleware `role` (didaftarkan di `bootstrap/app.php`) digunakan untuk membatasi akses admin.
- Session, cache, dan queue semuanya menggunakan **driver database**.
- Status transaksi bersifat **linear search** — method `statusBerikutnya()` di model `Transaksi` mengembalikan status selanjutnya berdasarkan array berurutan.
