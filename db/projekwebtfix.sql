-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 17, 2025 at 02:40 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projekwebtfix`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$AL0lk3L95YemoiosBTGIuO9itKjZ5xfsXlDhePc6F8l6a2qiJrpmy');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(100) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `id_kategori` int DEFAULT NULL,
  `deskripsi` text,
  `penerbit` varchar(255) DEFAULT NULL,
  `tahun_terbit` int DEFAULT NULL,
  `jumlah_halaman` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `penulis`, `harga`, `foto`, `id_kategori`, `deskripsi`, `penerbit`, `tahun_terbit`, `jumlah_halaman`) VALUES
(2, 'Cantik Itu Luka', 'Eka Kurniawan', 109000.00, 'CantikItuLuka.jpg', 2, 'Di satu sore, seorang perempuan bangkit dari kuburannya setelah dua puluh satu tahun kematian. Kebangkitannya menguak kutukan dan tragedi keluarga, yang terentang sejak akhir masa kolonial perpaduan antara epik keluarga yang dibalut roman, kisah hantu, kekejaman politik, mitologi, dan petualangan. Dari kekasih yang lenyap ditelan kabut hingga seorang ibu yang menginginkan bayi buruk rupa.', 'Gramedia Pustaka Utama', 2018, 520),
(3, 'Filosofi Teras', 'Henry Manampiring', 79000.00, 'FilosofiTeras.jpg', 2, 'Buku Filosofi Teras karya Henry Manampiring merupakan pengantar yang menarik ke dalam dunia filsafat Stoisisme, yang dikemas dengan gaya ringan dan relevan dengan kehidupan modern. Dalam buku ini, Stoisisme—sebuah aliran filsafat yang lahir pada abad ke-3 SM di Yunani—dijelaskan dalam konteks yang mudah dipahami oleh pembaca Indonesia, terutama bagi mereka yang sedang mencari cara untuk menghadapi tantangan hidup dengan lebih tenang dan rasional. Salah satu poin utama dalam buku ini adalah konsep dikotomi kendali, yang mengajarkan bahwa dalam hidup, ada hal-hal yang berada dalam kendali kita dan ada yang tidak. Henry Manampiring menguraikan bagaimana memahami perbedaan ini dapat membantu kita mengurangi stres dan kecemasan. Dengan fokus pada apa yang bisa dikendalikan, seseorang dapat lebih menerima keadaan dan menjalani hidup dengan lebih bijaksana.', 'Penerbit Buku Kompas', 2019, 344),
(12, 'Half', 'Monica Petra', 49000.00, 'poto10.jpg', 2, 'Sebenarnya, setiap manusia itu ‘satu’ atau ‘setengah’?\r\nKetika kita menemukan belahan jiwa, kita membentuk satu kesatuan atau tetap menjadi dua?\r\nMengapa ketika—kupikir—belahan jiwaku datang, aku malah merasa kosong?\r\nIan baik. Tapi, kurasa, ada sesuatu yang membuatku ragu. Jodoh memang pasti bertemu, namun benarkah dia yang tepat untuk menemani hari-hariku?', 'Elex Media Komputindo', 2025, 208),
(13, 'The Innovators: How a Group of Inventors, Hackers, Geniuses, and Geeks Created the Digital Revolution', 'Walter Isaacson', 250000.00, 'NF1.jpg', 3, 'Mulai dari Ada Lovelace pada tahun 1840-an yang meletakkan dasar pemrograman, hingga tokoh-tokoh seperti Vannevar Bush, Alan Turing, John von Neumann, J.C.R. Licklider, Doug Engelbart, Robert Noyce, Bill Gates, Steve Wozniak, Steve Jobs, Tim Berners-Lee, dan Larry Page, Isaacson dengan cermat memaparkan bagaimana pikiran mereka bekerja, lompatan kreatif yang mereka buat, dan pentingnya kemampuan mereka untuk bekerja sama. Buku ini bukan hanya sejarah teknologi, tetapi juga panduan tentang bagaimana inovasi sejati terwujud melalui gabungan ide, kreativitas, dan kerja tim.', 'Bentang Pustaka (edisi Bahasa Indonesia)', 2015, 532),
(14, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 399000.00, 'NF2.jpg', 3, '\"Sapiens: A Brief History of Humankind\" adalah sebuah karya non-fiksi monumental yang menyajikan gambaran luas tentang sejarah umat manusia, dimulai dari kemunculan Homo Sapiens di Afrika Timur sekitar 70.000 tahun yang lalu hingga abad ke-21. Harari dengan brilian menggabungkan wawasan dari berbagai disiplin ilmu seperti biologi, antropologi, sejarah, dan ekonomi untuk menjelaskan bagaimana Homo Sapiens menjadi spesies dominan di planet ini.', 'Dvir Publishing House Ltd', 2011, 443),
(15, 'Becoming', 'Michelle Obama', 300000.00, 'NF3.jpg', 3, '\"Becoming\" adalah memoar yang sangat personal dan inspiratif dari mantan Ibu Negara Amerika Serikat, Michelle Obama. Dalam buku ini, ia berbagi kisah hidupnya secara jujur dan mendalam, mulai dari masa kecilnya yang sederhana di South Side Chicago, pendidikan di Princeton University dan Harvard Law School, karier awalnya sebagai pengacara, pertemuan dan pernikahannya dengan Barack Obama, perjuangannya menyeimbangkan keluarga dan karier politik suaminya, hingga delapan tahun yang tak terlupakan sebagai Ibu Negara di Gedung Putih.', 'Crown Publishing Group', 2018, 464),
(16, 'Clean Code: A Handbook of Agile Software Craftsmanship', 'Robert C. Martin', 350000.00, 'T1.jpg', 4, '\"Clean Code\" adalah salah satu buku paling berpengaruh dan esensial dalam dunia pengembangan perangkat lunak. Ditulis oleh Robert C. Martin, seorang veteran di bidang rekayasa perangkat lunak dan arsitek di balik filosofi Agile, buku ini berfokus pada pentingnya menulis kode yang tidak hanya berfungsi, tetapi juga mudah dibaca, dipahami, diubah, dan dipelihara oleh pengembang lain (atau diri sendiri di masa depan).', 'Prentice Hall', 2008, 464),
(17, 'The Pragmatic Programmer: Your Journey to Mastery', 'David Thomas dan Andrew Hunt', 400000.00, 'T2.jpg', 4, '\"The Pragmatic Programmer\" adalah buku panduan yang kaya akan wawasan praktis untuk para pengembang perangkat lunak, dari pemula hingga yang berpengalaman. Buku ini tidak terpaku pada satu bahasa pemrograman atau teknologi tertentu, melainkan mengajarkan filosofi dan pendekatan yang dapat diterapkan secara universal untuk menulis kode yang lebih baik, menjadi pengembang yang lebih efektif, dan berkontribusi pada proyek perangkat lunak yang sukses.', 'Addison-Wesley', 2019, 352),
(18, 'Artificial Intelligence: A Modern Approach', 'Stuart J. Russell dan Peter Norvig', 500000.00, 'T3.jpg', 4, '\"Artificial Intelligence: A Modern Approach\" adalah buku teks standar dan paling populer di bidang kecerdasan buatan (AI) di seluruh dunia. Ditulis oleh dua tokoh terkemuka di bidang AI, Stuart J. Russell (profesor di UC Berkeley) dan Peter Norvig (Director of Research di Google), buku ini menyajikan pengantar yang komprehensif, mutakhir, dan mendalam tentang teori dan praktik kecerdasan buatan.', 'Pearson', 1995, 1136),
(19, 'The Silk Roads: A New History of the World', 'Peter Frankopan', 350000.00, 'S1.jpg', 5, 'Buku ini menantang pandangan Barat-sentris tentang sejarah dunia. Frankopan berargumen bahwa jantung dunia dan pusat perdagangan, budaya, serta kekuasaan sebenarnya berada di sepanjang Jalur Sutra, yang membentang dari Tiongkok hingga Mediterania. Ia menyajikan sejarah dunia yang kaya dan saling terkait, menyoroti peran Asia Tengah, Timur Tengah, dan Timur dalam membentuk peradaban. Ini adalah bacaan yang membuka mata tentang konektivitas global sepanjang sejarah.', 'Bloomsbury Publishing', 2015, 700),
(20, 'Collapse: How Societies Choose to Fail or Succeed', 'Jared Diamond', 250000.00, 'S2.jpg', 5, 'Setelah Guns, Germs, and Steel, Diamond kali ini menganalisis runtuhnya berbagai peradaban masa lalu (seperti peradaban Maya, Easter Island, Norse di Greenland) dan membandingkannya dengan masyarakat yang berhasil bertahan. Ia mengidentifikasi lima faktor utama yang berkontribusi pada keruntuhan: kerusakan lingkungan, perubahan iklim, musuh, teman dagang, dan respons masyarakat terhadap masalah. Buku ini menawarkan pelajaran penting tentang keberlanjutan dan tantangan lingkungan modern.', 'Viking Press', 2005, 600),
(21, 'The Lessons of History', 'Will Durant & Ariel Durant', 150000.00, 'S3.jpg', 5, 'Sebuah buku yang ringkas namun padat makna, merangkum pelajaran-pelajaran utama dari sejarah peradaban manusia yang telah mereka teliti selama puluhan tahun. Buku ini membahas tema-tema berulang seperti geografi sebagai penentu, biologi dan sifat manusia, moralitas, agama, ekonomi, perang, dan pertumbuhan peradaban. Ini adalah meditasi yang mendalam tentang makna sejarah dan relevansinya bagi masa kini dan masa depan.', 'Simon & Schuster', 1968, 128),
(22, 'Bumi Manusia', 'Pramoedya Ananta Toer', 150000.00, 'SJ1.jpg', 6, 'Bagian pertama dari Tetralogi Buru yang monumental. Mengisahkan Minke, seorang pribumi Jawa cerdas di awal abad ke-20 yang bersekolah di HBS Belanda. Melalui mata Minke, Pramoedya menyajikan potret kolonialisme Belanda, perjuangan identitas pribumi, rasialisme, dan bangkitnya kesadaran nasional. Sebuah karya fundamental dalam sastra Indonesia yang sarat kritik sosial dan politik.', 'Hasta Mitra', 1980, 500),
(23, 'Laskar Pelangi', 'Andrea Hirata', 120000.00, 'SJ2.jpg', 6, 'Novel populer yang mengisahkan perjuangan sepuluh anak di Belitung dalam mengejar pendidikan di sebuah sekolah Muhammadiyah yang nyaris ditutup. Dengan latar belakang kemiskinan dan lingkungan penambangan timah, kisah ini sarat inspirasi, persahabatan, dan semangat untuk meraih cita-cita. Ini adalah salah satu novel Indonesia yang paling banyak dibaca dan diadaptasi.', 'Bentang Pustaka', 2005, 300),
(24, 'The Great Gatsby', 'F. Scott Fitzgerald', 100000.00, 'SJ3.jpg', 6, 'Sebuah novel klasik Amerika yang mengkritik \"Mimpi Amerika\" dan kemewahan era Jazz Age tahun 1920-an. Kisahnya berpusat pada misteri Jay Gatsby, seorang jutawan baru yang penuh teka-teki, dan obsesinya pada masa lalu dan kekasih lamanya, Daisy Buchanan. Novel ini menyoroti tema-tema seperti kekayaan, kelas sosial, ilusi, dan kehampaan hidup.', 'Charles Scribner\'s Sons', 1925, 200),
(25, 'One Piece', 'Eiichiro Oda', 50000.00, 'K1.jpg', 7, 'Manga shonen paling populer dan terlaris di dunia. Kisahnya mengikuti petualangan Monkey D. Luffy, seorang anak laki-laki yang tubuhnya menjadi karet setelah memakan Buah Iblis. Bersama kru bajak lautnya, Topi Jerami, Luffy berlayar mengarungi Grand Line untuk menemukan harta karun legendaris \"One Piece\" dan menjadi Raja Bajak Laut. Penuh aksi, petualangan, humor, drama, dan pembangunan dunia yang luar biasa.', 'Shueisha', 1997, 108),
(26, 'Attack on Titan (Shingeki no Kyojin)', 'Hajime Isayama', 45000.00, 'K2.jpg', 7, 'Manga fantasi gelap yang sangat fenomenal. Kisahnya berlatar dunia di mana umat manusia hidup di balik tembok besar untuk melindungi diri dari raksasa pemakan manusia yang disebut Titan. Eren Yeager, Mikasa Ackerman, dan Armin Arlert bergabung dengan pasukan militer setelah kampung halaman mereka diserang. Cerita ini penuh misteri, plot twist yang mengejutkan, aksi brutal, dan eksplorasi tema perang, kebebasan, serta moralitas.', 'Kodansha', 2009, 108),
(27, 'Maus', 'Art Spiegelman', 200000.00, 'K3.jpg', 7, 'Sebuah graphic novel non-fiksi yang memenangkan Hadiah Pulitzer. Spiegelman menceritakan kisah nyata ayahnya, Vladek Spiegelman, seorang penyintas Holocaust. Yang unik, cerita ini digambarkan dengan karakter binatang: Yahudi sebagai tikus, Nazi sebagai kucing, dan Polandia sebagai babi. Maus adalah karya yang kuat dan mengharukan tentang trauma, ingatan, dan keberanian di tengah salah satu tragedi terbesar sejarah.', 'Pantheon Books', 1986, 296),
(28, 'Wonderwood: The Natural Timekeeper of The Forest', 'Jane B. Smart', 250000.00, 'A1.jpg', 8, '\"Wonderwood\" adalah sebuah buku visual yang memukau dan edukatif yang mengajak pembaca, baik anak-anak maupun dewasa, menjelajahi kehidupan dan ekosistem di dalam hutan sepanjang empat musim. Dengan ilustrasi yang indah dan detail yang akurat secara ilmiah, buku ini menggambarkan bagaimana pohon, tumbuhan, hewan, dan serangga berinteraksi dan beradaptasi dengan perubahan alam dari musim semi, panas, gugur, hingga dingin.', 'Thames & Hudson', 2022, 160),
(29, 'Ella and the Magical Paintbrush', 'Karen Blair', 80000.00, 'A2.jpg', 8, '\"Ella and the Magical Paintbrush\" adalah buku cerita bergambar yang memukau dan imajinatif, cocok untuk anak-anak usia 3-7 tahun. Kisahnya berpusat pada seorang gadis kecil bernama Ella yang menemukan kuas ajaib. Setiap kali Ella menggunakan kuas itu, apa pun yang ia lukis akan menjadi nyata!', 'Scholastic Press / Five Mile Press', 2017, 32),
(30, 'The Nightmare Thief', 'Karen White', 300000.00, 'A3.jpg', 8, '\"The Nightmare Thief\" adalah novel fantasi yang memikat dan penuh petualangan, cocok untuk pembaca muda usia 8-12 tahun. Kisah ini berpusat pada tokoh bernama Piper Bloom, seorang gadis yang punya rahasia unik: dia bisa merasakan dan, kadang-kadang, memasuki mimpi orang lain. Namun, ada juga konsekuensi dari kemampuannya itu.\r\n\r\nSuatu malam, Piper bertemu dengan seorang anak laki-laki misterius yang juga bisa memasuki mimpi, tapi dengan tujuan berbeda: dia adalah pencuri mimpi buruk. Dia mengambil mimpi buruk dari orang lain, seolah-olah itu adalah barang berharga. Piper pun terseret ke dalam dunia yang gelap dan berbahaya, di mana batas antara mimpi dan kenyataan menjadi kabur. Ia harus menghadapi makhluk-makhluk bayangan, mengungkap rahasia tentang dunia mimpi, dan mencari tahu mengapa mimpi buruk bisa dicuri—dan apa risikonya.', 'Margaret K. McElderry Books', 2018, 352),
(31, 'The Art of Happiness: A Handbook for Living', 'Dalai Lama XIV dan Howard C. Cutler', 80000.00, 'R1.jpg', 10, 'Buku ini adalah hasil kolaborasi antara pemimpin spiritual Tibet, Dalai Lama, dan seorang psikiater Amerika, Howard C. Cutler. Mereka mengeksplorasi konsep kebahagiaan dari sudut pandang Buddhisme dan psikologi modern. Buku ini menawarkan wawasan praktis tentang cara menghadapi penderitaan, mengubah perspektif, dan menumbuhkan rasa kasih sayang, toleransi, serta pemaafan dalam kehidupan sehari-hari. Ini bukan sekadar teks religius, melainkan panduan universal untuk mencapai kedamaian batin dan kebahagiaan sejati.', 'Riverhead Books', 1998, 320),
(32, 'Ayat-Ayat Cinta', 'Habiburrahman El Shirazy', 120000.00, 'R2.jpg', 10, 'Meskipun memiliki elemen fiksi (berupa novel), Ayat-Ayat Cinta sangat kental dengan nilai-nilai dan ajaran Islam, sehingga sering dianggap sebagai representasi karya religi populer. Kisahnya berpusat pada Fahri bin Abdullah Shiddiq, seorang mahasiswa Indonesia yang belajar di Al-Azhar, Mesir. Melalui kisah cinta segitiga yang kompleks dan penuh konflik, buku ini mengangkat isu-isu moral, sosial, dan religius dalam kehidupan muslim modern, seperti poligami, kesetiaan, kesabaran, dan kebijaksanaan dalam menghadapi cobaan. Novel ini tidak hanya menghibur tetapi juga mendidik tentang bagaimana ajaran Islam dapat diterapkan dalam kehidupan sehari-hari.', 'Republika Penerbit', 2004, 418),
(33, 'Mere Christianity', 'C.S. Lewis', 140000.00, 'R3.jpg', 10, 'Mere Christianity adalah salah satu buku paling berpengaruh tentang Kekristenan. C.S. Lewis, seorang mantan ateis yang beralih menjadi salah satu teolog Kristen paling terkenal, menyajikan argumen-argumen rasional tentang inti kepercayaan Kristen. Berdasarkan serangkaian siaran radio yang ia sampaikan selama Perang Dunia II, Lewis membahas konsep-konsep dasar moralitas, keberadaan Tuhan, hakikat Kristus, dan implikasi praktis dari iman Kristen dengan bahasa yang jelas, logis, dan mudah dijangkau, bahkan bagi mereka yang skeptis atau belum mengenal Kekristenan. Buku ini sangat direkomendasikan bagi siapa pun yang ingin memahami dasar-dasar teologi Kristen.', 'HarperOne', 1952, 192);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(2, 'Fiksi'),
(3, 'Non-Fiksi'),
(4, 'Teknologi'),
(5, 'Sejarah'),
(6, 'Sastra'),
(7, 'Komik'),
(8, 'Anak-anak'),
(10, 'Religi'),
(16, 'Memasak & Resep'),
(17, 'Seni & Desain');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `telepon`, `profile`) VALUES
(1, 'alia rahayu', 'al@gmail.com', '$2y$10$8rCvjcnCC7K4YntEB8v2dug8.7xrspwzbco9xIOsOk7tUtkvaiCqK', '081234567890', 'profile.jpeg'),
(2, 'al', 'a@gmail.com', '$2y$10$hrUv1KajjN3iIDZlol8e/.vmPaCwkkq.f9/XxVjCdYm7VskBCFQQ.', '', ''),
(3, 'b', 'b@gmail.com', '$2y$10$tk2HAZTnbyUEY/f8oVVI5OIQiOsgzsj/q0nwkKrjiMix/5Abu7WKO', '', ''),
(4, 'c', 'c@gmail.com', '$2y$10$7BAsTLP66AEioj5gHqN5UOI7NvD0SC3uS5c3frClhksUNzFsH8MFy', '', ''),
(5, 'nap', 'nap@gmail.com', '$2y$10$JQIMC4exD.4ryBMajHyJg.61aWgm.EOAVn2/fHa9hEmpAApvL092y', '087691876322', 'profile.jpeg'),
(6, 'abc', 'abc@example.com', '$2y$10$zQcxECxt4KiFiBncKMfk2.cPbb9m1o1xj2EdUVCZgJO2Un74C.xcu', '0812345678912', 'profile.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
