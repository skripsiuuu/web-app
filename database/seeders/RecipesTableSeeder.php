<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RecipesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('recipes')->delete();
        
        \DB::table('recipes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Omurice Khas Jepang',
                'slug' => 'omurice-khas-jepang',
                'category' => 'Resep Olahan Telur',
                'prep_time' => '20 Menit',
                'servings' => '1 Servings',
                'description' => 'Omurice khas Jepang merupakan hidangan berbasis telur dan nasi yang biasanya disajikan dengan cara membungkus nasi goreng saus tomat di dalam omelet telur yang lembut dan gurih. Menggunakan Telur Organik berkualitas akan membuat omelet tidak mudah robek, berwarna lebih cerah alami, dan tentunya lebih bernutrisi.',
            'ingredients' => '<ul><li>3 butir Telur Ayam Organik Mitra Hidup Sehat</li><li>1 porsi nasi putih (sebaiknya nasi sisa semalam)</li><li>50 gram fillet Dada Ayam Probiotik, potong dadu kecil</li><li>1/2 buah bawang bombay, cincang halus</li><li>3 sdm saus tomat (ketchup)</li><li>1 sdm mentega / margarin</li><li>1 sdt garam dan 1/2 sdt lada bubuk</li></ul>',
            'instructions' => '<ol><li>Persiapkan bahan-bahan utama dan kocok lepas telur organik di dalam mangkuk dengan sedikit garam.</li><li>Panaskan sedikit mentega di wajan anti lengket, tumis bawang bombay hingga harum.</li><li>Masukkan potongan ayam probiotik, masak hingga berubah warna dan matang.</li><li>Masukkan nasi putih, tambahkan saus tomat, garam, dan lada. Aduk rata hingga menjadi nasi goreng. Angkat dan sisihkan.</li><li>Bersihkan wajan, panaskan sedikit minyak/mentega dengan api sedang. Tuang telur yang sudah dikocok, ratakan ke seluruh permukaan wajan.</li><li>Saat bagian bawah telur mulai matang (tapi bagian atas masih sedikit basah), letakkan nasi goreng di tengahnya.</li><li>Lipat perlahan kedua sisi telur menutupi nasi, lalu balikkan perlahan ke atas piring saji.</li><li>Hidangkan Omurice selagi hangat dengan tambahan saus tomat di atasnya.</li></ol>',
                'image' => 'telur-1.jpg',
                'created_at' => '2026-06-03 17:20:03',
                'updated_at' => '2026-06-03 17:20:03',
            ),
            1 => 
            array (
                'id' => 2,
            'title' => 'Telur Dadar Sayuran (Fritatta Panggang Teflon)',
                'slug' => 'telur-dadar-sayuran-fritatta',
                'category' => 'Resep Olahan Telur',
                'prep_time' => '15 Menit',
                'servings' => '2 Servings',
                'description' => 'Solusi sarapan sehat dan praktis yang kaya akan protein dan serat. Fritatta atau telur dadar tebal ala Italia ini sangat cocok untuk menghabiskan sisa sayuran di kulkas. Kandungan gizi dari telur organik memastikan Anda mendapat asupan energi yang padat tanpa rasa begah.',
            'ingredients' => '<ul><li>4 butir Telur Ayam Organik Mitra Hidup Sehat</li><li>1 genggam daun bayam segar, iris kasar</li><li>1/2 buah paprika merah, potong dadu kecil</li><li>2 butir bawang merah, iris tipis</li><li>3 sdm susu cair (opsional, agar lebih fluffy)</li><li>1/2 sdt garam dan 1/2 sdt lada hitam</li><li>1 sdm minyak zaitun / minyak kelapa</li></ul>',
                'instructions' => '<ol><li>Pecahkan telur dalam mangkuk besar, tambahkan susu cair, garam, dan lada. Kocok hingga berbusa.</li><li>Masukkan potongan bayam dan paprika ke dalam adonan telur, aduk rata.</li><li>Panaskan minyak zaitun di atas teflon dengan api kecil-sedang, tumis bawang merah hingga harum.</li><li>Tuang adonan telur dan sayuran ke dalam teflon. Ratakan permukaannya.</li><li>Tutup teflon dan biarkan masak selama 5-7 menit dengan api kecil agar matang merata tanpa gosong di bawahnya.</li><li>Jika bagian atas sudah padat, angkat dan potong menjadi 4 bagian seperti pizza.</li><li>Sajikan selagi hangat sebagai menu sarapan atau bekal makan siang.</li></ol>',
                'image' => 'telur-2.jpg',
                'created_at' => '2026-06-03 17:20:03',
                'updated_at' => '2026-06-03 17:20:03',
            ),
            2 => 
            array (
                'id' => 3,
            'title' => 'Setup Telur Tomat (Tomato Egg Stir-fry)',
                'slug' => 'setup-telur-tomat',
                'category' => 'Resep Olahan Telur',
                'prep_time' => '10 Menit',
                'servings' => '2 Servings',
                'description' => 'Menu rumahan klasik yang sangat populer karena kesederhanaannya. Perpaduan asam segar dari tomat dan gurihnya telur organik menciptakan saus alami yang luar biasa nikmat saat disajikan di atas semangkuk nasi hangat.',
                'ingredients' => '<ul><li>3 butir Telur Ayam Organik Mitra Hidup Sehat, kocok lepas</li><li>3 buah tomat merah segar, potong kasar</li><li>2 siung bawang putih, cincang halus</li><li>1 batang daun bawang, iris tipis</li><li>1 sdm kecap asin</li><li>1/2 sdt gula pasir, 1/2 sdt garam, dan kaldu jamur secukupnya</li><li>2 sdm minyak goreng sehat</li></ul>',
            'instructions' => '<ol><li>Panaskan 1 sdm minyak di wajan, masukkan telur kocok. Buat orak-arik (scramble) setengah matang, lalu angkat dan sisihkan.</li><li>Tambahkan sisa 1 sdm minyak ke wajan yang sama, tumis bawang putih hingga harum.</li><li>Masukkan potongan tomat, tumis perlahan hingga tomat layu dan mengeluarkan air/sarinya.</li><li>Tambahkan sedikit air (sekitar 50 ml), lalu masukkan kecap asin, gula, garam, dan kaldu jamur.</li><li>Masukkan kembali telur orak-arik ke dalam wajan. Aduk perlahan agar telur meresap bumbu tomat.</li><li>Taburkan irisan daun bawang sesaat sebelum api dimatikan.</li><li>Sajikan selagi panas.</li></ol>',
                'image' => 'telur-3.jpg',
                'created_at' => '2026-06-03 17:20:03',
                'updated_at' => '2026-06-03 17:20:03',
            ),
            3 => 
            array (
                'id' => 4,
                'title' => 'Egg Muffin Panggang Sehat',
                'slug' => 'egg-muffin-panggang-sehat',
                'category' => 'Resep Olahan Telur',
                'prep_time' => '25 Menit',
                'servings' => '6 Servings',
                'description' => 'Camilan tinggi protein yang sangat mudah dibuat untuk meal prep mingguan. Anda bisa membuatnya di akhir pekan, menyimpannya di kulkas, dan tinggal dipanaskan saat butuh sarapan super cepat sebelum berangkat kerja.',
            'ingredients' => '<ul><li>6 butir Telur Ayam Organik Mitra Hidup Sehat</li><li>50 gr brokoli, rebus setengah matang dan cincang kasar</li><li>50 gr keju cheddar parut (bisa diganti keju rendah lemak)</li><li>1 buah sosis sapi/ayam berkualitas, potong dadu kecil</li><li>1/2 sdt garam, 1/4 sdt lada bubuk, 1/4 sdt kaldu jamur</li><li>Mentega untuk mengoles cetakan muffin</li></ul>',
            'instructions' => '<ol><li>Panaskan oven di suhu 180°C. Olesi cetakan muffin (loyang cupcake) dengan sedikit mentega agar tidak lengket.</li><li>Siapkan mangkuk besar, pecahkan seluruh telur dan kocok lepas bersama garam, lada, dan kaldu jamur.</li><li>Tata cincangan brokoli, sosis, dan sedikit keju di dasar setiap lubang cetakan muffin.</li><li>Tuangkan kocokan telur ke dalam masing-masing cetakan hingga 3/4 penuh (telur akan mengembang saat dipanggang).</li><li>Taburkan sisa keju parut di atasnya.</li><li>Panggang di dalam oven selama 15-18 menit atau hingga telur mengembang dan permukaannya kecoklatan.</li><li>Keluarkan dari oven, biarkan agak dingin sebelum dikeluarkan dari cetakan. Siap dinikmati!</li></ol>',
                'image' => 'telur-4.jpg',
                'created_at' => '2026-06-03 17:20:03',
                'updated_at' => '2026-06-03 17:20:03',
            ),
            4 => 
            array (
                'id' => 5,
            'title' => 'Sup Jagung Krim Telur (Egg Drop Soup)',
                'slug' => 'sup-jagung-krim-telur',
                'category' => 'Resep Olahan Telur',
                'prep_time' => '15 Menit',
                'servings' => '3 Servings',
                'description' => 'Sup hangat yang sangat nyaman di perut, cocok dikonsumsi saat cuaca dingin atau sedang tidak enak badan. Menggunakan telur organik memastikan kuah sup tidak berbau amis, melainkan gurih alami.',
            'ingredients' => '<ul><li>2 butir Telur Ayam Organik Mitra Hidup Sehat, kocok lepas</li><li>1 bonggol jagung manis, pipil bijinya</li><li>750 ml kaldu ayam (atau air putih + 1 sdt kaldu jamur)</li><li>2 siung bawang putih, cincang halus</li><li>1 sdm minyak wijen</li><li>2 sdm tepung maizena, larutkan dengan sedikit air</li><li>Garam dan lada putih secukupnya</li><li>Daun ketumbar atau daun bawang untuk taburan</li></ul>',
                'instructions' => '<ol><li>Panaskan sedikit minyak wijen di panci, tumis bawang putih hingga harum.</li><li>Masukkan kaldu ayam dan jagung manis pipil. Rebus hingga jagung matang dan empuk.</li><li>Tambahkan garam, lada putih, dan kaldu jamur sesuai selera. Koreksi rasa.</li><li>Tuangkan larutan maizena sedikit demi sedikit sambil terus diaduk hingga kuah sup mengental.</li><li>Kecilkan api. Sambil terus mengaduk kuah secara melingkar perlahan, tuangkan telur kocok sedikit demi sedikit membentuk serabut halus.</li><li>Matikan api, tuang ke dalam mangkuk saji.</li><li>Taburi dengan irisan daun bawang atau daun ketumbar. Sup hangat siap dihidangkan.</li></ol>',
                'image' => 'telur-5.jpg',
                'created_at' => '2026-06-03 17:20:03',
                'updated_at' => '2026-06-03 17:20:03',
            ),
            5 => 
            array (
                'id' => 6,
            'title' => 'Dada Ayam Panggang Rosemary (Lemon Herb Chicken)',
                'slug' => 'dada-ayam-panggang-rosemary',
                'category' => 'Resep Olahan Ayam',
                'prep_time' => '30 Menit',
                'servings' => '2 Servings',
                'description' => 'Olahan dada ayam tidak harus hambar dan kering! Resep ini menggunakan teknik marinasi sederhana untuk mengunci kelembapan daging. Menggunakan Dada Ayam Probiotik Mitra Hidup Sehat memastikan daging tetap juicy, berserat lembut, dan bebas hormon buatan.',
            'ingredients' => '<ul><li>2 potong (sekitar 300g) Dada Ayam Probiotik Mitra Hidup Sehat</li><li>2 siung bawang putih, parut halus</li><li>1 sdm perasan air lemon segar</li><li>1 sdt daun rosemary kering (atau thyme)</li><li>1 sdm minyak zaitun (olive oil)</li><li>1/2 sdt garam dan 1/2 sdt lada hitam kasar</li></ul>',
            'instructions' => '<ol><li>Cuci bersih dada ayam dan keringkan dengan tisu dapur. Sayat sedikit permukaannya agar bumbu lebih meresap.</li><li>Siapkan wadah, campurkan minyak zaitun, bawang putih parut, air lemon, rosemary, garam, dan lada hitam.</li><li>Lumuri dada ayam dengan bumbu marinasi tersebut secara merata. Diamkan di kulkas minimal 15 menit.</li><li>Panaskan wajan anti lengket atau teflon panggangan dengan api sedang. (Tidak perlu tambah minyak karena sudah ada di bumbu).</li><li>Panggang dada ayam selama 5-7 menit di satu sisi hingga kecoklatan. Balikkan, dan panggang lagi 5 menit hingga matang sempurna di bagian dalam.</li><li>Angkat dan istirahatkan ayam (resting) selama 3 menit sebelum dipotong agar juicy-nya tidak hilang.</li><li>Sajikan bersama sayuran rebus dan karbohidrat kompleks seperti ubi atau nasi merah.</li></ol>',
                'image' => 'ayam-1.jpg',
                'created_at' => '2026-06-03 17:20:03',
                'updated_at' => '2026-06-03 17:20:03',
            ),
            6 => 
            array (
                'id' => 7,
                'title' => 'Tumis Ayam Brokoli Saus Tiram',
                'slug' => 'tumis-ayam-brokoli-saus-tiram',
                'category' => 'Resep Olahan Ayam',
                'prep_time' => '20 Menit',
                'servings' => '3 Servings',
                'description' => 'Menu stir-fry super cepat yang kaya akan protein dan vitamin hijau. Potongan ayam probiotik yang padat sangat cocok ditumis dengan api besar untuk memberikan aroma smokey ala restoran Tiongkok yang menggugah selera.',
                'ingredients' => '<ul><li>250 gr fillet Dada/Paha Ayam Probiotik, iris tipis memanjang</li><li>1 bonggol brokoli, potong per kuntum, cuci bersih</li><li>3 siung bawang putih, memarkan dan cincang</li><li>1/2 ruas jahe, iris korek api</li><li>2 sdm saus tiram</li><li>1 sdm kecap asin</li><li>1 sdt minyak wijen</li><li>1 sdt maizena dilarutkan dengan 3 sdm air</li></ul>',
            'instructions' => '<ol><li>Seduh brokoli dengan air mendidih selama 2 menit, tiriskan (agar warnanya tetap hijau segar dan teksturnya renyah).</li><li>Panaskan wajan dengan 2 sdm minyak goreng sehat. Tumis bawang putih dan jahe hingga harum.</li><li>Masukkan irisan ayam probiotik. Tumis dengan api besar hingga ayam berubah warna dan matang.</li><li>Masukkan saus tiram dan kecap asin, aduk rata hingga ayam terbalut bumbu.</li><li>Masukkan brokoli yang sudah diseduh. Aduk cepat agar tercampur rata.</li><li>Tuang larutan maizena, aduk hingga kuah mengental dan berkilau.</li><li>Matikan api, tambahkan minyak wijen, aduk sekali lagi. Hidangkan segera.</li></ol>',
                'image' => 'ayam-2.jpg',
                'created_at' => '2026-06-03 17:20:03',
                'updated_at' => '2026-06-03 17:20:03',
            ),
            7 => 
            array (
                'id' => 8,
                'title' => 'Sup Ayam Kuah Bening Kaya Rempah',
                'slug' => 'sup-ayam-kuah-bening-kaya-rempah',
                'category' => 'Resep Olahan Ayam',
                'prep_time' => '40 Menit',
                'servings' => '4 Servings',
                'description' => 'Sup ayam kuah bening adalah comfort food sejati keluarga Indonesia. Kunci dari sup yang lezat dan sehat adalah kaldu yang jernih dan bebas lemak jahat. Ayam probiotik memiliki keunggulan lemak di bawah kulit yang sangat tipis, membuat kuah kaldu tetap gurih tanpa terasa "berminyak".',
            'ingredients' => '<ul><li>1/2 ekor Ayam Probiotik Mitra Hidup Sehat (potong jadi 6 bagian)</li><li>2 buah wortel, potong bulat tebal</li><li>1 buah kentang ukuran besar, potong dadu</li><li>100 gr buncis, potong memanjang</li><li>4 siung bawang merah dan 3 siung bawang putih, haluskan</li><li>1 ruas jahe, memarkan</li><li>1 batang daun bawang dan 1 batang seledri, iris kasar</li><li>Garam, lada putih, dan sejumput pala bubuk</li><li>1 liter air</li></ul>',
            'instructions' => '<ol><li>Rebus ayam probiotik dalam air mendidih bersama jahe selama 10 menit untuk membuang kotoran. Tiriskan ayam, buang air rebusan pertamanya.</li><li>Siapkan panci baru, didihkan 1 liter air segar. Masukkan kembali ayam ke dalamnya.</li><li>Tumis bumbu halus (bawang merah & putih) dengan sedikit minyak hingga harum dan matang. Masukkan bumbu tumis ini ke dalam panci rebusan ayam.</li><li>Tambahkan garam, lada, dan pala bubuk. Rebus dengan api kecil-sedang selama 20 menit agar kaldu keluar meresap.</li><li>Masukkan wortel dan kentang. Masak hingga sayuran setengah empuk.</li><li>Terakhir, masukkan buncis, daun bawang, dan seledri. Masak lagi sekitar 5 menit.</li><li>Koreksi rasa. Angkat dan sajikan selagi panas dengan taburan bawang goreng.</li></ol>',
                'image' => 'ayam-3.jpg',
                'created_at' => '2026-06-03 17:20:03',
                'updated_at' => '2026-06-03 17:20:03',
            ),
            8 => 
            array (
                'id' => 9,
                'title' => 'Sate Lilit Ayam Probiotik ala Bali',
                'slug' => 'sate-lilit-ayam-probiotik-ala-bali',
                'category' => 'Resep Olahan Ayam',
                'prep_time' => '35 Menit',
                'servings' => '4 Servings',
                'description' => 'Ingin makan sate tapi menghindari lemak bakar dan kolesterol? Sate lilit dada ayam adalah solusinya. Hidangan ini kaya akan rempah aromatik khas Bali dan sangat menyehatkan karena dipanggang menggunakan teflon.',
            'ingredients' => '<ul><li>350 gr fillet Dada Ayam Probiotik, cincang halus (bisa di-blender chopper)</li><li>3 sdm kelapa parut setengah tua</li><li>12 batang serai (untuk tusukan sate)</li><li>Bumbu Halus: 4 bawang merah, 2 bawang putih, 1 buah cabai merah besar, 1 ruas kunyit bakar, 1 sdt ketumbar bubuk.</li><li>1 lembar daun jeruk, buang tulang daunnya, iris super tipis</li><li>1/2 sdt garam, 1/2 sdt kaldu jamur</li><li>Sedikit minyak kelapa / minyak goreng biasa</li></ul>',
            'instructions' => '<ol><li>Tumis bumbu halus dengan sedikit minyak hingga harum dan matang. Angkat dan biarkan dingin.</li><li>Dalam wadah besar, campurkan ayam cincang, bumbu halus matang, kelapa parut, irisan daun jeruk, garam, dan kaldu jamur. Uleni hingga semua tercampur rata dan adonan bisa dibentuk.</li><li>Ambil sekepal adonan (sekitar 2-3 sdm), lilitkan dan padatkan pada bagian ujung batang serai. Lakukan hingga adonan habis.</li><li>Panaskan teflon anti lengket atau wajan panggangan datar, olesi sedikit minyak.</li><li>Panggang sate lilit dengan api kecil-sedang. Bolak-balik perlahan agar matang merata di setiap sisi dan tidak gosong.</li><li>Jika warnanya sudah kecoklatan cantik dan daging ayam matang, angkat.</li><li>Sate Lilit Ayam Probiotik siap disajikan dengan sambal matah sebagai pelengkap.</li></ol>',
                'image' => 'ayam-4.jpg',
                'created_at' => '2026-06-03 17:20:03',
                'updated_at' => '2026-06-03 17:20:03',
            ),
            9 => 
            array (
                'id' => 10,
            'title' => 'Salad Ayam Suwir Saus Wijen (Asian Shredded Chicken Salad)',
                'slug' => 'salad-ayam-suwir-saus-wijen',
                'category' => 'Resep Olahan Ayam',
                'prep_time' => '20 Menit',
                'servings' => '2 Servings',
            'description' => 'Menu diet yang rasanya tidak seperti makanan diet! Sangat segar, renyah, dan tinggi protein. Menggunakan metode perebusan lambat (poaching) membuat ayam probiotik tetap sangat lembut saat disuwir.',
            'ingredients' => '<ul><li>200 gr fillet Dada Ayam Probiotik Mitra Hidup Sehat</li><li>1 bonggol selada bokor (lettuce), sobek kasar</li><li>1 buah mentimun jepang, buang bijinya, potong memanjang</li><li>1 buah wortel, serut memanjang atau potong korek api</li><li>1 ruas jahe (untuk merebus ayam)</li><li>Bahan Saus Wijen (Dressing): 2 sdm roasted sesame dressing (saus wijen sangrai botolan), 1 sdm kecap asin, 1 sdt madu murni, 1/2 sdt perasan jeruk nipis/lemon.</li></ul>',
            'instructions' => '<ol><li>Rebus air bersama irisan jahe hingga mendidih. Masukkan dada ayam utuh. Rebus selama 12-15 menit (tergantung ketebalan) hingga matang.</li><li>Angkat ayam, rendam sebentar dalam air es agar proses memasak berhenti dan daging tetap lembut. Tiriskan, lalu suwir-suwir dagingnya dengan garpu.</li><li>Siapkan saus dressing: Campur saus wijen sangrai, kecap asin, madu, dan perasan jeruk nipis di mangkuk kecil. Aduk rata.</li><li>Siapkan piring atau mangkuk saji besar. Tata selada, mentimun, dan wortel serut.</li><li>Letakkan ayam suwir di atas tumpukan sayuran segar.</li><li>Siram merata dengan saus wijen sesaat sebelum dimakan.</li><li>Aduk rata, nikmati salad sehat yang crunchy dan segar!</li></ol>',
                'image' => 'ayam-5.jpg',
                'created_at' => '2026-06-03 17:20:03',
                'updated_at' => '2026-06-03 17:20:03',
            ),
        ));
        
        
    }
}