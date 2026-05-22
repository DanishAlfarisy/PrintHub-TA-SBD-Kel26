# PrintHub

## Deskripsi Umum

PrintHub adalah website pemesanan fotokopi secara online yang dikembangkan sebagai tugas mata kuliah **Rekayasa Perangkat Lunak**. Sistem ini dibuat untuk mempermudah pengguna dalam melakukan pemesanan fotokopi, mengunggah dokumen, dan mengatur kebutuhan cetak secara online tanpa harus datang langsung ke tempat fotokopi.

Link video Demo : 
https://drive.google.com/drive/folders/1hAG6WLyuEa0-Cm_DA2fz-4OYeSBaoUG7?usp=sharing

## Cara Instalasi dan Menjalankan
1. Clone repository : 
git clone https://github.com/DanishAlfarisy/PrintHub-TA-SBD-Kel26.git

2. Install dependency : 
composer install
npm install

3. Buat file .env : 
copy .env.example .env

4. Generate key :
php artisan key:generate

5. Atur Database di file .env
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=

6. Jalankan migration
php artisan migrate

7. Jalankan project
npm run dev
php artisan serve

8. Akses melalui : 
http://127.0.0.1:8000
