
# 🛡️ Pengamanan Data Klub dan Pemain

## 📘 Studi Kasus: Keamanan Data Klub dan Pemain dalam Aplikasi Sepak Bola

### 🏷️ Latar Belakang
Aplikasi manajemen data sepak bola menyimpan informasi sensitif terkait klub dan pemain, seperti:
- Nama klub dan pemain,
- Gaji,
- Statistik performa,
- Data kontrak dan transfer.

Data disimpan dalam file CSV dan database lokal, dan aplikasi dijalankan menggunakan script `start.sh`. Untuk menghindari risiko kebocoran data, perlu diterapkan langkah-langkah keamanan yang menyeluruh, termasuk pada level startup aplikasi.

---

### 🎯 Tujuan
- Membatasi akses ke script `start.sh`.
- Mengamankan data file klub dan pemain.
- Menyediakan audit log untuk pelacakan aktivitas.
- Menjalankan aplikasi dalam lingkungan yang terisolasi.

---

## ✅ Solusi Implementasi Keamanan

### 1. 🔐 Validasi User Eksekusi

```bash
if [ "$USER" != "adminuser" ]; then
    echo "Access denied for user $USER"
    exit 1
fi
```

> ✅ Hanya user `adminuser` yang dapat menjalankan script.

---

### 2. 📝 Logging Aktivitas

```bash
mkdir -p logs
echo "$(date): Application started by $USER" >> logs/startup.log
```

> ✅ Mencatat siapa dan kapan aplikasi dijalankan.

---

### 3. 🧱 Isolasi Aplikasi Menggunakan Docker

```bash
docker run -d --name clubapp -v ./data:/app/data secure-image:latest
```

> ✅ Menjalankan aplikasi di container untuk menghindari risiko terhadap sistem utama.

---

### 4. 🔐 Pengaturan Hak Akses File

```bash
chmod 600 ./data/club.csv
chown root:appuser ./data/club.csv
```

> ✅ Membatasi akses hanya pada user tertentu.

---

### 5. 🔥 (Opsional) Firewall / Whitelist IP

```bash
ufw allow from 192.168.1.100 to any port 3306
```

> ✅ Membatasi akses database hanya dari IP tertentu.

---

## 📄 Contoh `start.sh` Lengkap

```bash
#!/bin/bash

# Validasi user
if [ "$USER" != "adminuser" ]; then
    echo "Access denied for user $USER"
    exit 1
fi

# Logging
mkdir -p logs
echo "$(date): Application started by $USER" >> logs/startup.log

# Jalankan aplikasi dalam container
docker run -d --name clubapp -v ./data:/app/data secure-image:latest

# Atur permission data
chmod 600 ./data/club.csv
chown root:appuser ./data/club.csv
```

---

## 🧪 Hasil yang Diharapkan
- Data klub dan pemain hanya bisa diakses oleh proses sah.
- Setiap eksekusi aplikasi tercatat.
- Sistem tidak bisa dieksekusi oleh user tidak sah.
- Risiko pencurian data berkurang drastis.

---

## ⚠️ Risiko Jika Tidak Diamankan
- Kebocoran gaji dan data kontrak.
- Penyalahgunaan atau penghapusan data oleh user lokal.
- Tidak ada jejak log jika terjadi pelanggaran.

---

## 📌 Catatan Tambahan
- Pastikan Docker dan ufw (firewall) sudah terinstal.
- Jalankan `chmod +x start.sh` agar script bisa dieksekusi.
- Gunakan environment `.env` untuk menyimpan password secara aman jika diperlukan.

---

## 👤 Penulis
- Nama: Wahyu Cahya Bagus Pamungkas 
- Proyek: CIE406 – Keamanan Informasi
- Studi Kasus: Data Klub dan Pemain
