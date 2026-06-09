<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('articles')->delete();
        
        \DB::table('articles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Mengapa Kuning Telur Organik Berwarna Lebih Pekat? Ini Rahasia Nutrisinya!',
                'slug' => 'mengapa-kuning-telur-organik-berwarna-lebih-pekat-ini-rahasia-nutrisinya',
                'category' => 'Artikel Gizi & Nutrisi',
                'content' => '<p>Pernahkah Anda memecahkan telur dan menyadari bahwa warna kuning telurnya jauh lebih pekat, hampir menyerupai warna oranye cerah? Banyak orang mengira ini adalah hasil dari zat pewarna buatan. Padahal, warna kuning telur yang pekat justru merupakan indikator utama dari kualitas nutrisi yang jauh lebih superior dibandingkan telur konvensional.</p><p>Warna cerah pada kuning telur organik berasal dari asupan beta-karoten alami yang didapatkan ayam dari pakan berkualitas tinggi, seperti biji-bijian pilihan dan sayuran hijau. Pakan alami ini tidak hanya memengaruhi warna, tetapi juga mendongkrak profil nutrisi di dalamnya. Telur organik terbukti secara ilmiah memiliki kandungan Omega-3 dan Kolin yang jauh lebih tinggi. Omega-3 sangat esensial untuk menjaga kesehatan jantung, sementara Kolin berperan penting dalam perkembangan fungsi otak dan memelihara kesehatan mata.</p><p>Memilih bahan makanan tidak boleh sekadar melihat ukuran, tetapi juga kepadatan nutrisinya. Pastikan asupan Omega-3 keluarga Anda terpenuhi setiap hari dengan memilih Telur Ayam Organik dari Mitra Hidup Sehat, di mana kualitas pakan dan kesejahteraan peternakan menjadi prioritas utama kami.</p>',
                'excerpt' => 'Pernahkah Anda memecahkan telur dan menyadari bahwa warna kuning telurnya jauh lebih pekat, hampir menyerupai warna oranye cerah?',
                'image' => 'gizi-1.jpg',
                'created_at' => '2026-06-03 16:17:05',
                'updated_at' => '2026-06-03 16:17:05',
            ),
            1 => 
            array (
                'id' => 2,
                'title' => 'Bahaya Tersembunyi Residu Antibiotik pada Bahan Pangan Konvensional',
                'slug' => 'bahaya-tersembunyi-residu-antibiotik-pada-bahan-pangan-konvensional',
                'category' => 'Artikel Gizi & Nutrisi',
                'content' => '<p>Di era produksi makanan massal seperti sekarang, memenuhi permintaan pasar yang tinggi seringkali memunculkan jalan pintas di sektor peternakan. Salah satu praktik yang paling umum dan mengkhawatirkan adalah penggunaan antibiotik secara rutin pada hewan ternak konvensional, bukan untuk mengobati penyakit, melainkan untuk memacu pertumbuhan agar cepat panen.</p><p>Apa dampaknya bagi tubuh kita yang mengonsumsinya? Dalam jangka panjang, residu antibiotik yang tertinggal pada daging dapat memicu masalah kesehatan yang serius. Salah satu ancaman terbesarnya adalah resistensi antibiotik, kondisi di mana bakteri di dalam tubuh manusia menjadi kebal terhadap obat-obatan medis. Selain itu, residu bahan kimia ini dapat mengganggu keseimbangan flora usus yang berujung pada menurunnya sistem imun tubuh dan membuat kita lebih rentan terhadap alergi dan penyakit.</p><p>Sudah saatnya kita lebih kritis terhadap apa yang kita sajikan di meja makan. Lindungi diri Anda dan keluarga dari paparan kimia yang tidak perlu dengan beralih ke sumber protein yang lebih bersih. Ayam Probiotik dari Mitra Hidup Sehat dijamin 100% bebas antibiotik, memberikan Anda rasa aman di setiap gigitannya.</p>',
                'excerpt' => 'Di era produksi makanan massal seperti sekarang, memenuhi permintaan pasar yang tinggi seringkali memunculkan jalan pintas di sektor peternakan.',
                'image' => 'gizi-2.jpg',
                'created_at' => '2026-06-03 16:17:05',
                'updated_at' => '2026-06-03 16:17:05',
            ),
            2 => 
            array (
                'id' => 3,
                'title' => 'Memahami Cara Kerja Probiotik pada Peternakan Ayam dan Dampaknya bagi Tubuh Kita',
                'slug' => 'memahami-cara-kerja-probiotik-pada-peternakan-ayam-dan-dampaknya-bagi-tubuh-kita',
                'category' => 'Artikel Gizi & Nutrisi',
                'content' => '<p>Kata "probiotik" mungkin lebih sering Anda dengar dalam iklan minuman yogurt atau suplemen pencernaan. Namun, tahukah Anda bahwa probiotik kini menjadi inovasi mutakhir di dunia peternakan unggas? Konsepnya sederhana namun sangat berdampak: menciptakan hewan ternak yang sehat secara alami, sehingga menghasilkan daging dengan kualitas yang jauh lebih baik untuk manusia.</p><p>Probiotik adalah kumpulan bakteri baik, seperti Lactobacillus, yang dicampurkan secara presisi ke dalam pakan dan air minum ayam. Bakteri baik ini bekerja dengan cara menjaga kesehatan saluran pencernaan unggas, memaksimalkan penyerapan nutrisi dari makanan, dan membangun sistem kekebalan tubuh alami. Karena ayam tumbuh dengan sehat tanpa stres dan tanpa bahan kimia, daging yang dihasilkan memiliki kadar lemak jahat yang lebih rendah dan tinggi protein. Tekstur dagingnya pun lebih padat dan seratnya sangat mudah dicerna oleh lambung manusia.</p><p>Mengonsumsi makanan sehat berawal dari bahan baku yang dipelihara dengan cara yang sehat pula. Dapatkan manfaat optimal dari daging berkualitas premium dengan mengonsumsi olahan Ayam Probiotik dari Mitra Hidup Sehat.</p>',
                'excerpt' => 'Kata "probiotik" mungkin lebih sering Anda dengar dalam iklan minuman yogurt atau suplemen pencernaan.',
                'image' => 'gizi-3.jpg',
                'created_at' => '2026-06-03 16:17:05',
                'updated_at' => '2026-06-03 16:17:05',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Mitos Kolesterol pada Telur: Beda Telur Biasa vs Telur Organik',
                'slug' => 'mitos-kolesterol-pada-telur-beda-telur-biasa-vs-telur-organik',
                'category' => 'Artikel Gizi & Nutrisi',
            'content' => '<p>Banyak orang menghindari makan telur setiap hari karena takut kolesterolnya melonjak. Reputasi buruk ini telah lama melekat pada telur, membuat banyak orang melewatkan sumber protein paling terjangkau dan bernutrisi ini. Mari kita luruskan mitos kesehatan yang satu ini dengan memahami perbedaan antara kolesterol dalam telur konvensional dan telur organik.</p><p>Faktanya, tubuh kita membutuhkan kolesterol. Namun, kita harus membedakan antara HDL (High-Density Lipoprotein atau kolesterol baik) dan LDL (Low-Density Lipoprotein atau kolesterol jahat). Mengonsumsi telur berkualitas, khususnya telur organik, justru terbukti membantu meningkatkan kadar HDL dalam darah. Hal ini dikarenakan ayam organik diberi pakan alami tanpa tambahan bahan kimia, sehingga menghasilkan telur dengan rasio lemak sehat dan asam lemak Omega-3 yang sangat seimbang, yang justru bekerja melindungi pembuluh darah jantung Anda.</p><p>Jadi, Anda tidak perlu lagi menghindari kuning telur atau takut makan telur setiap hari. Kuncinya ada pada kualitas. Pilih Telur Ayam Organik dari Mitra Hidup Sehat yang aman untuk jantung dan lengkapi kebutuhan gizi harian Anda tanpa rasa was-was.</p>',
                'excerpt' => 'Banyak orang menghindari makan telur setiap hari karena takut kolesterolnya melonjak. Reputasi buruk ini telah lama melekat pada telur.',
                'image' => 'gizi-4.jpg',
                'created_at' => '2026-06-03 16:17:05',
                'updated_at' => '2026-06-03 16:17:05',
            ),
            4 => 
            array (
                'id' => 5,
                'title' => 'Asam Amino Esensial: Blok Bangunan Utama untuk Sistem Imun yang Kuat',
                'slug' => 'asam-amino-esensial-blok-bangunan-utama-untuk-sistem-imun-yang-kuat',
                'category' => 'Artikel Gizi & Nutrisi',
            'content' => '<p>Ketika berbicara tentang membangun kekebalan tubuh, kita sering kali hanya fokus pada Vitamin C atau suplemen herbal. Padahal, ada komponen fundamental yang sering terlupakan namun menjadi pilar utama pertahanan tubuh kita: Asam Amino Esensial. Tanpa asupan ini, tubuh akan kesulitan memproduksi sel-sel imun yang baru.</p><p>Protein yang kita makan akan dipecah oleh tubuh menjadi asam amino. Terdapat 9 jenis asam amino esensial yang tidak bisa diproduksi sendiri oleh tubuh manusia, artinya, kita wajib mendapatkannya dari makanan. Asam amino inilah yang bertugas sebagai "blok bangunan" untuk memproduksi antibodi yang akan melawan serangan virus, bakteri, dan infeksi. Semakin tinggi kualitas protein yang Anda konsumsi, semakin efisien tubuh Anda membangun benteng pertahanannya.</p><p>Tidak semua sumber protein memiliki profil asam amino yang lengkap dan mudah diserap. Penuhi kebutuhan harian Anda dengan sumber protein berbioavailabilitas tinggi (mudah diserap tubuh), seperti Ayam Probiotik dari Mitra Hidup Sehat. Tubuh yang kuat bermula dari asupan protein yang tepat!</p>',
                'excerpt' => 'Ketika berbicara tentang membangun kekebalan tubuh, kita sering kali hanya fokus pada Vitamin C atau suplemen herbal.',
                'image' => 'gizi-5.jpg',
                'created_at' => '2026-06-03 16:17:05',
                'updated_at' => '2026-06-03 16:17:05',
            ),
            5 => 
            array (
                'id' => 6,
                'title' => 'Panduan Transisi ke Gaya Hidup Organik Tanpa Menguras Kantong',
                'slug' => 'panduan-transisi-ke-gaya-hidup-organik-tanpa-menguras-kantong',
                'category' => 'Artikel Gaya Hidup Sehat',
            'content' => '<p>Gaya hidup organik sering kali terstigma sebagai gaya hidup eksklusif yang mahal. Pikiran tentang tagihan belanja bulanan yang membengkak sering membuat orang mengurungkan niat untuk beralih ke makanan sehat. Kenyataannya, transisi ke pola makan organik bisa dilakukan dengan cerdas, bertahap, dan tetap bersahabat dengan isi dompet Anda.</p><p>Mengubah gaya hidup tidak harus dilakukan secara drastis dalam semalam. Anda bisa memulai dari hal yang paling fundamental dan paling sering dikonsumsi setiap hari, yaitu lauk pauk sumber protein. Ketimbang mengganti seluruh isi dapur, alokasikan anggaran Anda untuk membeli protein berkualitas. Anda bisa menyiasatinya dengan membeli ayam utuh yang bisa diolah menjadi berbagai macam menu (mulai dari kaldu tulang hingga dada panggang) untuk menekan pengeluaran. Memasak sendiri di rumah juga terbukti jauh lebih hemat dibandingkan membeli makanan sehat di restoran.</p><p>Kesehatan adalah investasi jangka panjang, dan investasi terbaik dimulai dari meja makan Anda sendiri. Mulailah langkah kecil menuju hidup yang lebih berkualitas dengan mengganti stok protein di kulkas Anda menggunakan Telur Organik dan Ayam Probiotik dari Mitra Hidup Sehat.</p>',
                'excerpt' => 'Gaya hidup organik sering kali terstigma sebagai gaya hidup eksklusif yang mahal.',
                'image' => 'gaya-hidup-1.jpg',
                'created_at' => '2026-06-03 16:17:05',
                'updated_at' => '2026-06-03 16:17:05',
            ),
            6 => 
            array (
                'id' => 7,
                'title' => 'Meal Prep Anti Bosan: Strategi Makan Sehat untuk Pekerja Kantoran',
                'slug' => 'meal-prep-anti-bosan-strategi-makan-sehat-untuk-pekerja-kantoran',
                'category' => 'Artikel Gaya Hidup Sehat',
            'content' => '<p>Jadwal meeting yang padat, tumpukan deadline, dan lelahnya menembus kemacetan adalah musuh utama dari pola makan sehat bagi pekerja kantoran. Di tengah kondisi ini, godaan untuk membeli fast food atau makanan instan melalui aplikasi pesan antar menjadi sangat tinggi. Jika Anda ingin memutus siklus jajan sembarangan ini, strategi meal prep (persiapan makanan) adalah solusi terbaiknya.</p><p>Tantangan terbesar dalam melakukan meal prep adalah memastikan makanan tidak terasa hambar atau teksturnya rusak saat dipanaskan kembali di kantor. Rahasianya terletak pada pemilihan bahan baku. Bahan daging konvensional yang sering kali disuntik air (plumping) akan menyusut drastis, menjadi kering, atau berair saat disimpan di kulkas. Gunakan wadah kaca kedap udara dan pastikan Anda menggunakan daging segar yang tidak melalui proses penyuntikan bahan kimia.</p><p>Untuk hasil masakan yang tetap juicy dan lezat berhari-hari, Ayam Probiotik dari Mitra Hidup Sehat adalah pilihan yang cerdas. Karena diternakkan secara alami, ayam ini memiliki tekstur daging yang padat, menjadikannya bahan sempurna untuk menu meal prep mingguan Anda.</p>',
                'excerpt' => 'Jadwal meeting yang padat, tumpukan deadline, dan lelahnya menembus kemacetan adalah musuh utama dari pola makan sehat bagi pekerja kantoran.',
                'image' => 'gaya-hidup-2.jpg',
                'created_at' => '2026-06-03 16:17:05',
                'updated_at' => '2026-06-03 16:17:05',
            ),
            7 => 
            array (
                'id' => 8,
                'title' => 'Gut-Brain Connection: Mengapa Pencernaan Sehat Bikin Mood Jadi Lebih Baik?',
                'slug' => 'gut-brain-connection-mengapa-pencernaan-sehat-bikin-mood-jadi-lebih-baik',
                'category' => 'Artikel Gaya Hidup Sehat',
            'content' => '<p>Pernahkah Anda merasa sakit perut saat sedang merasa panik atau gugup? Atau, apakah Anda sering merasa lelah, lesu, dan bad mood setelah seharian mengonsumsi junk food? Ini bukanlah sugesti semata. Secara medis, fenomena ini adalah manifestasi dari Gut-Brain Connection—koneksi dua arah antara saluran pencernaan dan otak kita.</p><p>Para ilmuwan bahkan menyebut usus sebagai "otak kedua". Di dalam saluran pencernaan kita, hidup triliunan mikrobioma (bakteri baik) yang bertugas menjaga keseimbangan tubuh. Fakta yang mengejutkan adalah, sekitar 90% hormon serotonin (hormon yang mengatur rasa bahagia dan mencegah stres) diproduksi di dalam usus, bukan di otak! Ketika kita mengonsumsi makanan olahan, tinggi gula, atau protein yang mengandung residu kimiawi, bakteri baik di usus bisa mati. Akibatnya, pencernaan terganggu, energi merosot tajam, dan suasana hati menjadi tidak stabil.</p><p>Jaga keseimbangan mikrobioma Anda dengan mengonsumsi makanan yang ramah cerna. Mengonsumsi Ayam Probiotik dari Mitra Hidup Sehat tidak hanya memberikan asupan gizi tinggi, tetapi sifat alami dagingnya sangat bersahabat bagi lambung dan usus Anda.</p>',
                'excerpt' => 'Pernahkah Anda merasa sakit perut saat sedang merasa panik atau gugup? Secara medis, fenomena ini adalah manifestasi dari Gut-Brain Connection.',
                'image' => 'gaya-hidup-3.jpg',
                'created_at' => '2026-06-03 16:17:05',
                'updated_at' => '2026-06-03 16:17:05',
            ),
            8 => 
            array (
                'id' => 9,
                'title' => 'Rahasia Recovery Otot Pasca-Olahraga untuk Hasil yang Maksimal',
                'slug' => 'rahasia-recovery-otot-pasca-olahraga-untuk-hasil-yang-maksimal',
                'category' => 'Artikel Gaya Hidup Sehat',
            'content' => '<p>Banyak orang yang menghabiskan waktu berjam-jam mengangkat beban di gym, mengikuti kelas kardio, atau berlari puluhan kilometer, namun tidak melihat perubahan signifikan pada tubuhnya. Kesalahan terbesar yang sering dilakukan oleh penggiat olahraga pemula adalah mengabaikan fase paling krusial: fase recovery atau pemulihan pasca-olahraga.</p><p>Saat Anda berolahraga dengan intensitas tinggi, jaringan otot sebenarnya sedang mengalami kerusakan kecil (micro-tears). Otot Anda tidak membesar atau menguat saat Anda sedang mengangkat beban, melainkan saat Anda sedang beristirahat dan memberikan nutrisi yang tepat. Dalam "jendela anabolik" (sekitar 45 menit hingga 1 jam setelah berolahraga), tubuh sangat membutuhkan asupan protein bersih tanpa kelebihan lemak jenuh untuk segera memperbaiki robekan otot tersebut.</p><p>Jangan sia-siakan keringat dan kerja keras Anda di tempat gym. Maksimalkan sesi workout Anda dengan memberikan bahan bakar terbaik bagi tubuh melalui asupan protein berkualitas tinggi dari dada Ayam Probiotik Mitra Hidup Sehat.</p>',
                'excerpt' => 'Banyak orang yang menghabiskan waktu berjam-jam berolahraga, namun tidak melihat perubahan karena mengabaikan fase recovery.',
                'image' => 'gaya-hidup-4.jpg',
                'created_at' => '2026-06-03 16:17:05',
                'updated_at' => '2026-06-03 16:17:05',
            ),
            9 => 
            array (
                'id' => 10,
                'title' => 'Sarapan Tinggi Protein: Kunci Menghindari Kantuk di Jam Kritis Siang Hari',
                'slug' => 'sarapan-tinggi-protein-kunci-menghindari-kantuk-di-jam-kritis-siang-hari',
                'category' => 'Artikel Gaya Hidup Sehat',
            'content' => '<p>Pukul 2 siang sering kali menjadi "jam kritis" bagi produktivitas. Rasa kantuk yang luar biasa tiba-tiba menyerang, membuat Anda sulit berkonsentrasi di depan layar komputer. Banyak orang menyalahkan kurang tidur di malam hari, padahal pelaku utamanya sering kali adalah menu sarapan yang Anda konsumsi di pagi harinya.</p><p>Sarapan tradisional sering kali didominasi oleh karbohidrat sederhana, seperti roti manis, sereal bergula, atau porsi nasi yang terlalu besar. Makanan ini akan membuat kadar gula darah Anda melonjak tajam dengan cepat, memberikan energi instan. Namun, beberapa jam kemudian, gula darah akan merosot sama tajamnya (sugar crash). Inilah yang memicu rasa lemas dan kantuk yang tak tertahankan di siang hari. Sebaliknya, sarapan tinggi protein dicerna secara perlahan oleh tubuh, memberikan pasokan energi yang stabil dan memberikan rasa kenyang lebih lama.</p><p>Ubah rutinitas pagi Anda untuk hari yang lebih produktif. Awali hari dengan menu sarapan simpel namun padat nutrisi menggunakan Telur Ayam Organik dari Mitra Hidup Sehat, dan rasakan bedanya pada tingkat fokus Anda sepanjang hari!</p>',
                'excerpt' => 'Pukul 2 siang sering kali menjadi "jam kritis" bagi produktivitas karena rasa kantuk luar biasa yang tiba-tiba menyerang.',
                'image' => 'gaya-hidup-5.jpg',
                'created_at' => '2026-06-03 16:17:05',
                'updated_at' => '2026-06-03 16:17:05',
            ),
        ));
        
        
    }
}