<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class CategoryBlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Instansiasi Faker
        $faker = Faker::create();
        $faker->addProvider(new \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider($faker));

        // Definisikan kategori terkait shoe cleaning
        $categories = [
            ['name_category_blog' => 'Cleaning Tips', 'slug' => Str::slug('Cleaning Tips')],
            ['name_category_blog' => 'Product Reviews', 'slug' => Str::slug('Product Reviews')],
            ['name_category_blog' => 'Service Updates', 'slug' => Str::slug('Service Updates')],
            ['name_category_blog' => 'Customer Stories', 'slug' => Str::slug('Customer Stories')],
            ['name_category_blog' => 'Maintenance Guides', 'slug' => Str::slug('Maintenance Guides')],
        ];

        // Masukkan kategori ke dalam database
        foreach ($categories as $category) {
            DB::table('category_blogs')->insert([
                'uuid' => (string) Str::uuid(),
                'name_category_blog' => $category['name_category_blog'],
                'slug' => $category['slug'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Mengambil semua category_blog_id dari database setelah insert
        $categoryBlogs = DB::table('category_blogs')->get();

        // Mengambil user_id dari user dengan role 'karyawan'
        $karyawanUserId = DB::table('users')->where('role', 'karyawan')->value('id');

        // Data blog untuk setiap kategori dengan deskripsi lebih panjang
        $blogs = [
            'Cleaning Tips' => [
                [
                    'title' => 'Bagaimana caranya membersihkan sepatu canvas',
                    'slug' => 'bagaimana-caranya-membersihkan-sepatu-canvas',
                    'content' => 'Temukan cara mudah membersihkan sepatu canvas Anda.',
                    'description' => 'Membersihkan sepatu canvas adalah salah satu tantangan tersendiri karena materialnya yang mudah rusak '
                        . 'jika tidak ditangani dengan hati-hati. Dalam panduan ini, Anda akan menemukan cara terbaik untuk '
                        . 'membersihkan sepatu canvas Anda tanpa merusak kain atau warna sepatu tersebut. Langkah-langkah ini mencakup persiapan bahan '
                        . 'yang aman, penggunaan alat-alat yang tepat, serta tips tentang cara menjaga sepatu tetap bersih dan segar lebih lama. '
                        . 'Kami juga akan membahas beberapa produk pembersih yang direkomendasikan untuk sepatu berbahan canvas yang telah teruji dan aman digunakan.',
                ],
                [
                    'title' => 'Tips Membersihkan Sepatu Putih',
                    'slug' => 'tips-membersihkan-sepatu-putih',
                    'content' => 'Cara menjaga sepatu putih Anda tetap bersih.',
                    'description' => 'Sepatu putih memang elegan, tetapi mudah kotor. Di sini, kami akan memberikan tips tentang bagaimana cara '
                        . 'efektif membersihkan sepatu putih tanpa merusak bahan atau warnanya. Anda akan belajar cara mencegah noda membandel '
                        . 'serta produk apa saja yang sebaiknya digunakan untuk perawatan sepatu putih. Selain itu, kami juga membahas cara menyimpan '
                        . 'sepatu putih agar tidak menguning dan tetap terlihat seperti baru lebih lama. Panduan ini dilengkapi dengan video tutorial langkah demi langkah.',
                ],
            ],
            'Product Reviews' => [
                [
                    'title' => 'Sepatu Lokal Branded Terbaru Airwalk',
                    'slug' => 'sepatu-lokal-branded-terbaru-airwalk',
                    'content' => 'Sepatu Airwalk terbaru, stylish dan nyaman.',
                    'description' => 'Sepatu Airwalk telah menjadi salah satu pilihan favorit di kalangan pecinta sepatu lokal. Dengan desain yang stylish '
                        . 'dan bahan berkualitas, Airwalk kembali meluncurkan seri terbaru yang mendapat banyak perhatian. Seri ini tidak hanya unggul '
                        . 'dari segi tampilan, tetapi juga dari segi kenyamanan. Dalam ulasan ini, kami membahas lebih lanjut mengenai teknologi yang '
                        . 'digunakan dalam pembuatan sepatu, kenyamanan saat dipakai, serta daya tahan sepatu ini setelah penggunaan sehari-hari. '
                        . 'Banyak pengguna yang sudah mencoba sepatu ini menyatakan puas dengan kualitas dan keawetannya, membuat sepatu ini salah satu pilihan terbaik di pasar.',
                ],
                [
                    'title' => 'Review Sepatu Converse Terbaru',
                    'slug' => 'review-sepatu-converse-terbaru',
                    'content' => 'Converse kembali dengan seri terbaru mereka.',
                    'description' => 'Converse, brand legendaris yang dikenal karena gaya klasik dan daya tahannya, baru saja merilis seri terbaru. '
                        . 'Sepatu ini mempertahankan gaya ikonik Converse dengan beberapa inovasi baru, termasuk bahan lebih tahan lama dan lebih nyaman. '
                        . 'Dalam ulasan ini, kami akan membahas lebih lanjut pengalaman pemakaian sehari-hari, kenyamanan untuk aktivitas kasual, serta bagaimana sepatu ini '
                        . 'tetap relevan bagi generasi muda yang mengedepankan gaya. Sepatu ini juga cocok digunakan dalam berbagai aktivitas dan cuaca.',
                ],
            ],
            'Service Updates' => [
                [
                    'title' => 'Update Layanan Pembersihan Sepatu di Kota Anda',
                    'slug' => 'update-layanan-pembersihan-sepatu-di-kota-anda',
                    'content' => 'Layanan pembersihan sepatu kini hadir di kota Anda.',
                    'description' => 'Kami terus berupaya memperluas jangkauan layanan kami agar lebih dekat dengan pelanggan setia. Kini, layanan pembersihan sepatu kami telah '
                        . 'tersedia di lebih banyak kota besar di Indonesia. Dalam pembaruan layanan kali ini, kami juga menambahkan beberapa fitur baru, seperti layanan antar-jemput sepatu gratis '
                        . 'dan diskon khusus bagi pelanggan pertama kali. Kami memperkenalkan beberapa produk pembersih baru yang lebih ramah lingkungan tanpa mengurangi kualitas pembersihan.',
                ],
                [
                    'title' => 'Penambahan Fitur Baru pada Layanan Kami',
                    'slug' => 'penambahan-fitur-baru-pada-layanan-kami',
                    'content' => 'Fitur baru untuk pengalaman pembersihan sepatu yang lebih baik.',
                    'description' => 'Layanan kami kini dilengkapi dengan fitur tracking untuk memantau proses pembersihan sepatu Anda secara real-time. Pelanggan dapat melihat status pengerjaan '
                        . 'dan estimasi waktu selesai melalui aplikasi kami. Fitur ini dirancang untuk memberikan transparansi lebih dalam proses pembersihan dan memudahkan pelanggan '
                        . 'memastikan sepatu mereka dalam kondisi aman dan sesuai dengan jadwal yang ditentukan. Kami juga memberikan opsi notifikasi melalui email atau SMS untuk update status.',
                ],
            ],
            'Customer Stories' => [
                [
                    'title' => 'Pengalaman Pelanggan Setia Kami',
                    'slug' => 'pengalaman-pelanggan-setia-kami',
                    'content' => 'Cerita inspiratif dari pelanggan kami.',
                    'description' => 'Di sini, kami berbagi pengalaman luar biasa dari pelanggan-pelanggan setia kami yang telah menggunakan layanan kami selama bertahun-tahun. '
                        . 'Beberapa dari mereka telah mempercayakan sepatu kesayangan mereka kepada kami sejak layanan pertama kali dibuka. Dalam cerita ini, mereka berbagi bagaimana kami '
                        . 'telah membantu menjaga sepatu mereka tetap dalam kondisi prima. Mereka juga membagikan tips dan pengalaman pribadi mereka mengenai cara terbaik menjaga sepatu '
                        . 'dan barang-barang kesayangan lainnya. Cerita ini penuh inspirasi dan bisa memberikan insight baru untuk Anda yang ingin merawat sepatu dengan lebih baik.',
                ],
                [
                    'title' => 'Kisah Sukses Pelanggan Kami',
                    'slug' => 'kisah-sukses-pelanggan-kami',
                    'content' => 'Testimoni dari pelanggan yang telah merasakan manfaat layanan kami.',
                    'description' => 'Beberapa pelanggan kami telah merasakan perubahan signifikan setelah menggunakan layanan pembersihan sepatu kami. Mereka berbagi bagaimana sepatu yang sudah '
                        . 'hampir rusak berhasil kami perbaiki dan kembali terlihat baru. Testimoni ini memberikan gambaran tentang kualitas layanan kami dan komitmen kami terhadap kepuasan pelanggan. '
                        . 'Baca lebih lanjut tentang pengalaman luar biasa mereka dan apa yang membuat mereka terus mempercayai layanan kami.',
                ],
            ],
            'Maintenance Guides' => [
                [
                    'title' => 'Cara Merawat Sepatu Kulit Agar Tahan Lama',
                    'slug' => 'cara-merawat-sepatu-kulit-agar-tahan-lama',
                    'content' => 'Tips penting merawat sepatu kulit Anda.',
                    'description' => 'Sepatu kulit merupakan salah satu jenis sepatu yang paling elegan namun membutuhkan perawatan khusus agar tetap awet. Dalam panduan ini, kami akan menjelaskan '
                        . 'langkah-langkah detail tentang cara membersihkan sepatu kulit tanpa merusak teksturnya, produk-produk perawatan apa saja yang bisa Anda gunakan, dan cara menyimpan sepatu kulit '
                        . 'agar terhindar dari kelembapan yang bisa merusak kulit. Panduan ini juga mencakup tips untuk menghilangkan noda dan menjaga kilap alami sepatu kulit agar tetap terlihat baru.',
                ],
                [
                    'title' => 'Perawatan Sepatu Kets untuk Penggunaan Sehari-hari',
                    'slug' => 'perawatan-sepatu-kets-untuk-penggunaan-sehari-hari',
                    'content' => 'Langkah-langkah sederhana untuk menjaga sepatu kets tetap awet.',
                    'description' => 'Sepatu kets adalah pilihan populer untuk penggunaan sehari-hari, tetapi butuh perawatan yang tepat agar tetap nyaman dan tahan lama. Dalam artikel ini, kami membagikan '
                        . 'beberapa tips penting untuk menjaga sepatu kets Anda dalam kondisi prima. Kami juga akan membahas produk pembersih yang direkomendasikan, serta cara menghindari kerusakan '
                        . 'yang biasanya terjadi akibat penggunaan yang sering. Dengan panduan ini, sepatu kets Anda akan tetap nyaman digunakan meskipun dipakai setiap hari.',
                ],
            ],
        ];


        // Loop setiap kategori dan insert data blog sesuai dengan kategori
        foreach ($categoryBlogs as $category) {
            // Ambil data blog yang sesuai dengan nama kategori
            foreach ($blogs[$category->name_category_blog] as $blogData) {
                DB::table('blogs')->insert([
                    'uuid' => (string) Str::uuid(),
                    'title' => $blogData['title'], // Judul sesuai kategori
                    'slug' => $blogData['slug'],   // Slug sesuai judul
                    'content' => $blogData['content'], // Konten manual yang singkat dan menarik
                    'image_url' => $faker->imageUrl(640, 480), // Gambar dari Faker Picsum
                    'description' => $blogData['description'], // Deskripsi manual panjang sesuai kategori
                    'status_publish' => 'published', // Semua blog dipublikasikan
                    'date_publish' => now()->format('Y-m-d'), // Tanggal sekarang
                    'time_publish' => now()->format('H:i:s'), // Waktu sekarang
                    'user_id' => $karyawanUserId, // Menggunakan user_id dari karyawan
                    'category_blog_id' => $category->id, // ID kategori yang sesuai
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
