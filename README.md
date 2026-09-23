# Sistem Informasi dan Portal Web Yayasan Mitra

Sistem Informasi dan Portal Web Yayasan Mitra adalah aplikasi berbasis web yang dirancang untuk memperkuat transparansi operasional panti asuhan, mempublikasikan kegiatan anak asuh, serta memfasilitasi penghimpunan donasi secara digital dan terstruktur.

Aplikasi ini menghubungkan masyarakat/calon donatur dengan pengelola yayasan melalui dua antarmuka utama:
1. **Front-End Publik (Donatur / Pengguna)**: Portal informasi profil, transparansi kegiatan, lokasi, kontak WhatsApp, dan kanal donasi digital.
2. **Back-End CMS (Admin / Pengurus Yayasan)**: Panel manajemen terpusat dengan antarmuka sederhana (*low technical barrier*) untuk mengelola anak asuh, donasi, kampanye, berita, serta laporan.

---

## Informasi Yayasan
- **Nama Yayasan**: Yayasan Himatun Ayat Bandung
- **Alamat**: Jl. Cibiru Indah 7 RT/RW 04/14 Des. Cibiru Wetan, Kec. Cileunyi, Kab. Bandung
- **Integrasi**: Google Maps API, WhatsApp Direct API, Payment Gateway / QRIS

---

## Arsitektur Percabangan Git (Branching Strategy)

Repositori ini menerapkan alur kerja berbasis fitur (*Feature-Branch Workflow*) dengan percabangan sebagai berikut:

```text
production (Branch rilis stabil / live server)
  └── develop (Branch integrasi & pengujian)
       │
       ├── [BAGIAN PENGGUNA / DONATUR]
       │    ├── feature/user-landingpage
       │    ├── feature/user-profile
       │    ├── feature/user-kampanye-donasi
       │    └── feature/user-berita-kegiatan
       │
       └── [BAGIAN ADMIN / PENGURUS]
            ├── feature/admin-auth
            ├── feature/admin-dashboard
            ├── feature/admin-data-anak-asuh
            ├── feature/admin-kelola-donasi
            ├── feature/admin-kelola-kampanye
            ├── feature/admin-cms-berita
            └── feature/admin-laporan-ekspor
```

---

## Rincian Modul Per Fitur

### 1. Branch Utama
| Branch | Fungsi | Keterangan |
| :--- | :--- | :--- |
| `production` | Production Live | Branch stabil yang dideploy ke server produksi yayasan. Hanya menerima merge dari `develop` atau `hotfix`. |
| `develop` | Integration & Staging | Branch integrasi utama tempat penggabungan seluruh branch fitur untuk pengujian bersama sebelum rilis. |

---

### 2. Sisi Donatur / Pengguna Publik (`feature/user-*`)
| Nama Branch | Acuan SRS | Deskripsi Fitur |
| :--- | :--- | :--- |
| `feature/user-landingpage` | KF-02 | Beranda utama, Hero banner, integrasi Peta Presisi Google Maps (Jl. Cibiru Indah 7), dan tombol chat interaktif WhatsApp Direct API. |
| `feature/user-profile` | KF-01, KF-03 | Profil lengkap yayasan, visi & misi, sejarah, bagan struktur kepengurusan, dan berkas transparansi dokumen legalitas resmi. |
| `feature/user-kampanye-donasi` | KF-05, PD-02, PD-03 | Katalog program binaan yang membutuhkan dana serta formulir pembayaran donasi online (QRIS, E-Wallet, Transfer Bank). |
| `feature/user-berita-kegiatan` | KF-04, PD-01 | Publikasi artikel berita operasional yayasan dan galeri foto dokumentasi kegiatan anak asuh. |

---

### 3. Sisi Admin / Pengurus Yayasan (`feature/admin-*`)
| Nama Branch | Menu Sidebar UI | Deskripsi Fitur |
| :--- | :--- | :--- |
| `feature/admin-auth` | *Otentikasi* | Sistem login khusus pengurus yayasan, manajemen sesi Laravel, proteksi route admin, dan pencegahan SQL Injection (KF-06, KNF-03, KNF-08). |
| `feature/admin-dashboard` | **Dashboard** | Ringkasan metrik yayasan (total dana donasi terkumpul, jumlah anak asuh aktif, kampanye aktif, dan aktivitas terkini). |
| `feature/admin-data-anak-asuh` | **Data Anak Asuh** | Modul CRUD pendataan biodata anak asuh binaan (nama, usia, jenjang pendidikan, kebutuhan asuhan). |
| `feature/admin-kelola-donasi` | **Kelola Donasi** | Pencatatan transaksi donasi masuk, verifikasi status pembayaran, dan riwayat pesan donatur (KF-08, PY-03). |
| `feature/admin-kelola-kampanye` | **Kelola Kampanye** | Pengelolaan (CRUD) program kampanye donasi, target nominal, deskripsi program, dan status masa berlaku kampanye (KF-07). |
| `feature/admin-cms-berita` | **CMS Berita** | Editor penulisan artikel/kegiatan yayasan dan manajemen upload foto galeri kegiatan anak asuh (KF-07, PY-01, PY-02). |
| `feature/admin-laporan-ekspor` | **Laporan & Ekspor** | Rekapitulasi laporan keuangan donasi terpusat dan fasilitas ekspor data ke format PDF/Excel untuk arsip dan transparansi (KNF-02, PY-03). |

---

## Panduan Alur Kerja Pengembangan

### 1. Memulai Pengerjaan Fitur
Selalu mulai pengerjaan dari branch `develop` terbaru:
```bash
git checkout develop
git pull origin develop
git checkout <nama-branch-fitur>
```

### 2. Standar Commit (Conventional Commits)
Gunakan format pesan commit yang jelas dan deskriptif:
```bash
git add .
git commit -m "feat: tambahkan integrasi peta google maps pada landing page"
# atau
git commit -m "fix: perbaiki validasi form donasi qris"
```

### 3. Menyelesaikan & Mengirim Fitur
Push branch fitur ke remote repositori dan ajukan Pull Request (PR) ke branch `develop`:
```bash
git push -u origin <nama-branch-fitur>
```

---

## Lisensi & Hak Cipta
Hak Cipta © 2026 Yayasan Mitra. Seluruh hak cipta dilindungi undang-undang.
