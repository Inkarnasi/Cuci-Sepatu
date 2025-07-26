### TRANCANSOE
TRANCANSOE adalah sistem Tracking Cuci Sepatu dimana nantinya bisa tracking sejauh mana sepatu kita dikerjakan oleh pencuci. Proyek ini dibangun menggunakan Laravel dan Maze Dashboard
### Features
1. Dashboard
- Pengguna dapat mengakses halaman dashboard yang mungkin menampilkan informasi umum tentang aplikasi.

2. Manajemen Store
- Menampilkan daftar Store: Halaman untuk melihat daftar store.
- Edit Logo Store: Pengguna dapat mengedit logo store.
- Edit Informasi Store: Pengguna dapat memperbarui informasi store seperti nama, alamat, dan media sosial.
- Edit Media Sosial Store: Pengguna dapat memperbarui media sosial yang terkait dengan store.

3. Manajemen Doorprize
- Mengambil Data Hadiah: Rute untuk menampilkan data hadiah doorprize.
- Memilih Pemenang Doorprize: Fitur untuk memilih pemenang doorprize secara acak.

4. Manajemen Hadiah
- Menampilkan daftar Hadiah: Fitur untuk melihat hadiah yang tersedia.
- Tambah Hadiah: Fitur untuk menambah hadiah baru.
- Edit Hadiah: Fitur untuk mengedit informasi hadiah yang ada.
- Lihat Detail Hadiah: Fitur untuk melihat detail hadiah tertentu.
- Hapus Hadiah: Fitur untuk menghapus hadiah dari sistem.

5. Manajemen Pengguna
- Daftar Pengguna: Halaman untuk melihat daftar pengguna yang terdaftar.
- Tambah Pengguna: Pengguna dapat menambahkan pengguna baru.
- Edit Pengguna: Mengedit detail informasi pengguna.
- Hapus Pengguna: Menghapus pengguna dari sistem.

6. Manajemen Promosi
- Menampilkan daftar Promosi: Fitur untuk melihat promosi yang ada.
- Tambah Promosi: Fitur untuk menambah promosi baru.
- Edit Promosi: Fitur untuk mengedit promosi yang ada.
- Lihat Detail Promosi: Fitur untuk melihat detail promosi tertentu.
- Hapus Promosi: Fitur untuk menghapus promosi dari sistem.

7. Manajemen Membership
- Daftar Membership: Menampilkan daftar membership.
- Tambah Membership: Fitur untuk menambahkan membership baru.
- Verifikasi Membership: Fitur untuk memverifikasi membership.
- Lihat Detail Membership: Fitur untuk melihat detail membership.

8. Manajemen Blog dan Kategori Blog
- Daftar Kategori Blog: Fitur untuk melihat kategori blog yang tersedia.
- Tambah Kategori Blog: Pengguna dapat menambah kategori baru.
- Edit Kategori Blog: Mengedit kategori yang ada.
- Lihat Detail Kategori Blog: Fitur untuk melihat detail kategori tertentu.
- Hapus Kategori Blog: Fitur untuk menghapus kategori blog.

9. Daftar Blog: Fitur untuk menampilkan daftar blog yang ada.
- Tambah Blog: Pengguna dapat menambah postingan blog baru.
- Edit Blog: Mengedit postingan blog yang sudah ada.
- Lihat Detail Blog: Melihat detail postingan blog tertentu.
- Hapus Blog: Menghapus postingan blog.
- Publikasi Blog: Fitur untuk mempublikasikan blog.
- Simpan Sebagai Draft: Fitur untuk menyimpan blog sebagai draft.

10. Manajemen Kategori
- Daftar Kategori: Fitur untuk menampilkan daftar kategori.
- Tambah Kategori: Pengguna dapat menambah kategori baru.
- Edit Kategori: Mengedit informasi kategori yang sudah ada.
- Lihat Detail Kategori: Melihat detail kategori tertentu.
- Aktivasi/Deaktivasi Kategori: Pengguna dapat mengaktifkan atau menonaktifkan kategori.
- Manajemen Subkategori: Tambah, edit, dan hapus subkategori.

11. Plus Services
- Daftar Plus Services: Menampilkan daftar layanan tambahan.
- Tambah Plus Service: Fitur untuk menambah layanan baru.
- Edit Plus Service: Mengedit layanan tambahan yang sudah ada.
- Aktivasi/Deaktivasi Plus Service: Fitur untuk mengaktifkan atau menonaktifkan layanan.

12. Manajemen Transaksi
- Daftar Transaksi: Fitur untuk menampilkan semua transaksi.
- Tambah Transaksi: Fitur untuk menambah transaksi baru.
- Proses Transaksi: Mengubah status Pending menjadi sedang diproses.
- Selesai Transaksi: Menguba Status sedang Diproses menjadi Finish.
- Revisi Transaksi: Fitur untuk mengatur revisi pada Status.
- Cetak PDF Transaksi: Fitur untuk mencetak transaksi dalam format PDF.
- Pelunasan Transaksi: Fitur untuk pelunasan pembayaran.
- Update Status Pickup: Fitur untuk mengatur status pengambilan barang.

13. Tracking Status
14. Pendaftaran Memberships
15. Perpanjangan Memberships
### Installation
1. Clone repository ini:

    ```bash
    git clone https://github.com/Dafaaq/tracansoe.git
    ```

2. Install Dependencies:

    ```
    cd e-vote
    composer install
    npm install

    ```

3. Konfigurasi .env: Salin file .env.example menjadi .env dan sesuaikan konfigurasi database dan pengaturan lainnya.
    ```
    cp .env.example .env
    ```
4. Generate Key:
    ```
    php artisan key:generate
    ```
5. Migrate Database:
    ```
    php artisan migrate
    ```
6. Seed Database (Opsional):
    ```
    php artisan db:seed
    ```
7. Jalankan Aplikasi:
    ```
    php artisan serve
    ```
### License
Silahkan kalau mau pakai no problem asalkan jangan diganti footernya landing page :(

### View Page
1. Landing Page
   ![Screenshot 2024-10-08 at 16-50-22 Cuci Sepatu Modern](https://github.com/user-attachments/assets/93eec6c0-f73d-4380-8e09-4fb4ab11669c)
![Screenshot 2024-10-08 at 16-50-40 Cuci Sepatu Modern](https://github.com/user-attachments/assets/5ca2160a-23d4-4d6f-b8b6-1858c1675d06)
![Screenshot 2024-10-08 at 16-50-50 Cuci Sepatu Modern](https://github.com/user-attachments/assets/044cf9af-9a7d-4490-bfe5-8a252f6b1164)
![Screenshot 2024-10-08 at 16-51-05 Cuci Sepatu Modern](https://github.com/user-attachments/assets/2f8a8b7f-6a70-4e85-a2c9-fe959c74157d)
![Screenshot 2024-10-08 at 16-51-11 Cuci Sepatu Modern](https://github.com/user-attachments/assets/c73316c0-d869-4721-a53d-eb95e794c9a5)
![Screenshot 2024-10-08 at 16-51-17 Cuci Sepatu Modern](https://github.com/user-attachments/assets/de6c49e3-28f7-435c-96c2-7f0d5803f946)
![Screenshot 2024-10-08 at 16-51-24 Cuci Sepatu Modern](https://github.com/user-attachments/assets/b161bc4f-abba-4a50-a821-36d1cb059b1e)
![Screenshot 2024-10-08 at 16-51-31 Cuci Sepatu Modern](https://github.com/user-attachments/assets/394234e9-bd70-4fd8-84a2-7b2217676f4e)
![Screenshot 2024-10-08 at 16-51-40 Cuci Sepatu Modern](https://github.com/user-attachments/assets/62badbed-0989-4fc8-967f-191cb378fa7f)
![Screenshot 2024-10-08 at 16-51-50 Cuci Sepatu Modern](https://github.com/user-attachments/assets/e8391e0c-1392-4260-951c-2555e3df1a80)
![Screenshot 2024-10-08 at 16-52-00 Cuci Sepatu Modern](https://github.com/user-attachments/assets/b271c54b-6fe3-4617-b113-4e6058e72e79)
![Screenshot 2024-10-08 at 16-52-57 Cuci Sepatu Modern](https://github.com/user-attachments/assets/7130fab5-8657-4697-96dd-53009c7b034e)
![Screenshot 2024-10-08 at 16-53-03 Cuci Sepatu Modern](https://github.com/user-attachments/assets/5a233eb9-a5a5-4039-b340-ea8e8e9b73c1)
![Screenshot 2024-10-08 at 16-53-11 Cuci Sepatu Modern](https://github.com/user-attachments/assets/d23663ac-0c09-4b46-919e-a505b7f32adf)
![Screenshot 2024-10-08 at 16-53-19 Cuci Sepatu Modern](https://github.com/user-attachments/assets/0a2b1495-722c-4965-9b21-14cfc874168f)
![Screenshot 2024-10-08 at 16-53-25 Cuci Sepatu Modern](https://github.com/user-attachments/assets/1b523e82-3dff-40f5-9e34-a42ad1b46a37)
![Screenshot 2024-10-08 at 16-53-31 Cuci Sepatu Modern](https://github.com/user-attachments/assets/3790f7d0-ae93-42ba-8d13-e07296e9d82d)

3. Login
   ![Screenshot 2024-10-08 at 16-53-40 Login Page](https://github.com/user-attachments/assets/5c5d266f-f301-40c9-8f7b-4199896dfb3f)

5. Dashboard
   ![Screenshot 2024-10-08 at 16-54-05 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/308089d4-3e22-4c99-9b41-7c33802e6e41)


https://github.com/user-attachments/assets/4c143d77-9e92-4844-9640-2d7dee3bec88



7. Manajemen Store
![Screenshot 2024-10-08 at 16-59-52 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/2d09ff5a-d102-467a-9aab-f02e48132321)
![Screenshot 2024-10-08 at 17-00-00 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/8625031d-7965-45f7-bcea-61503d45285c)
![Screenshot 2024-10-08 at 17-00-18 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/e247e5b3-05bf-4b48-a237-5778e1a3f756)

8. Manajemen Promo
![Screenshot 2024-10-08 at 16-54-20 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/b15885fd-19ac-48bb-81bb-46904af251a4)
![Screenshot 2024-10-08 at 16-54-29 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/c36053cf-8e0d-4770-b202-f0f94804e51d)
![Screenshot 2024-10-08 at 16-54-49 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/d8a8989b-e7ee-44a9-9eef-49c62b95a175)
![Screenshot 2024-10-08 at 16-55-02 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/6cfd0b33-e736-4cc6-b0f7-4b524c148c4d)

10. Manajemen Kategori Blog
![Screenshot 2024-10-08 at 16-55-22 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/01da5a9a-3996-4820-8abf-6c342cc4d0a9)
![Screenshot 2024-10-08 at 16-55-38 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/56faa5f1-d277-4b2c-a6fd-12ff8ce72994)
![Screenshot 2024-10-08 at 16-55-49 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/1c21cd81-bb1a-4093-a1bd-f776b7fd21b6)

12. Manajemen Blog
![Screenshot 2024-10-08 at 16-56-01 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/c1bfffa2-c66b-4bb3-8829-32dddbea37da)
![Screenshot 2024-10-08 at 16-56-13 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/0e83322b-d65d-4139-aa63-f488a61938a8)
![Screenshot 2024-10-08 at 16-56-23 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/7389a827-70c1-4198-97b8-4902aba4f420)

13. Manajemen Kategori
![Screenshot 2024-10-08 at 16-56-36 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/65e0cb66-5877-4c44-9a28-e5d536a0d3c6)
![Screenshot 2024-10-08 at 16-56-43 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/36b3eb22-9dc2-45e4-85a6-d4a9b47b5e09)
![Screenshot 2024-10-08 at 16-56-51 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/0d618453-3f6f-4f30-834a-9ef221b34925)
![Screenshot 2024-10-08 at 16-57-01 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/ded0c3d1-1802-4d71-a793-ffaeddc81181)
![Screenshot 2024-10-08 at 16-57-12 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/1a7d6f54-b5a9-4674-805f-0eb02a585a9a)
![Screenshot 2024-10-08 at 16-57-32 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/c1ab7e74-9d9e-47bd-a1c3-be3cbe357f72)

15. Manajemen Plus Service
![Screenshot 2024-10-08 at 16-57-43 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/da23dade-282b-4374-98c5-472cc55a2eae)

17. Manajemen Transaksi
![Screenshot 2024-10-08 at 16-57-52 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/c2fa1d3b-e24a-4656-9c1e-e3c7ae45116c)
![Screenshot 2024-10-08 at 17-00-28 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/85989259-ecd3-4b11-9f90-b88d81fae7fd)
![Screenshot 2024-10-08 at 17-49-37 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/ac292b00-a9c1-4cc9-95a2-0e2b517c007b)
![Screenshot 2024-10-08 at 18-00-35 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/e868353f-31ed-4646-ba32-1a385cd1c790)
![Screenshot 2024-10-08 at 18-03-20 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/8b456c8b-78fd-4ba4-960b-2fee5d991885)
![Screenshot 2024-10-08 at 18-04-40 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/e1561d04-0a60-4fd6-ba81-51ea596a685d)
![Screenshot 2024-10-08 at 18-05-24 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/eda10584-3391-42f1-a2fb-aad70cc91c3e)
![Screenshot 2024-10-08 at 18-06-16 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/4c4521f9-e0f7-46f1-92af-9b5a7d3920bc)
![Screenshot 2024-10-08 at 18-06-46 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/9be6b016-0954-48a1-8cb9-6b97e381c0c0)
![Screenshot 2024-10-08 at 18-07-03 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/83e2260d-5b9a-4a44-b94e-5860fa44848e)


19. Manajemen Hadiah
![Screenshot 2024-10-08 at 16-58-02 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/1ce6f700-8656-4c2e-b1c8-573ddb26ba70)
![Screenshot 2024-10-08 at 16-58-53 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/39983350-da01-412f-8fc6-c250161cf416)
![Screenshot 2024-10-08 at 16-59-01 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/2df468e8-f4f4-47fa-98b9-6b92f15972d9)
![Screenshot 2024-10-08 at 16-59-09 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/ac693af6-acb4-4f9a-b375-3e35ae047f61)

21. Manajemen User
![Screenshot 2024-10-08 at 16-58-09 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/ec8eb21e-14b3-4ed7-b915-2d5ce0b750b2)
![Screenshot 2024-10-08 at 16-58-26 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/808989cc-1dff-4b5c-9e9e-fee7c44cd3ae)
![Screenshot 2024-10-08 at 16-58-40 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/6682984f-f160-49f5-b07b-3256b4faaf8b)

22. Manajemen Membership
![Screenshot 2024-10-08 at 17-46-58 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/2c0c8de7-7e4f-4153-b0c8-80ef2e28123e)
![Screenshot 2024-10-08 at 17-47-40 Dashboard - Mazer Admin Dashboard](https://github.com/user-attachments/assets/8c6c4ab8-a257-4126-b7d9-f3f2f752157a)

23. Manajemen
24. Tracking
![image](https://github.com/user-attachments/assets/0acede90-9828-4221-926b-8f49f6217d3f)
![image](https://github.com/user-attachments/assets/ca15cdf5-c191-4492-9f66-3c5526951cd6)




