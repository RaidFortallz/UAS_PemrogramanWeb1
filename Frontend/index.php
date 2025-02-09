<?php
include '../Backend/koneksi.php';

// Query data barang
$query = "SELECT * FROM tb_barang";
$stmt = $conn->prepare($query);
$stmt->execute();
$barang = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Query untuk statistik
$totalBarang = $conn->query("SELECT COUNT(*) FROM tb_barang")->fetchColumn();
$totalKategori = $conn->query("SELECT COUNT(DISTINCT kategori) FROM tb_barang")->fetchColumn();
$barangRusak = $conn->query("SELECT COUNT(*) FROM tb_barang WHERE kondisi = 'Rusak'")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Utama</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/index_style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>
    <!-- Navbar -->
    <section id="nav-bar">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="../img/inventaris1.png" class="img img-fluid" alt="image"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link active" href="#banner">HOME</a></li>
                        <li class="nav-item"><a class="nav-link" href="#tabel">TABEL</a></li>
                        <li class="nav-item"><a class="nav-link" href="#footer">CONTACT</a></li>
                        <li class="nav-item"><a class="nav-link" href="../Frontend/login.php">LOGIN</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </section>

    <!-- Banner -->
    <section id="banner">
        <div class="container">
            <div class="row content">
                <div class="col-md-6 mt-5 ps-5" data-aos="fade-right" data-aos-duration="1400">
                    <p class="fs-1 fw-semibold">SELAMAT DATANG</p>
                    <p class="fs-5">Ini adalah Halaman Menu Utama dari Inventaris Barang</p>
                </div>
                <div class="col-md-6 text-center" data-aos="zoom-in" data-aos-duration="1400">
                    <img src="../img/inventory.png" class="img_home img-fluid" alt="image">
                </div>
            </div>
        </div>
        <img src="../img/wave1.png" class="img_bottom" alt="image">
    </section>

    <!-- Informasi Inventaris -->
<section id="info" class="container mt-5">
    <div class="row align-items-center">
        <div class="col-md-5" data-aos="fade-right">
            <img src="../img/inventaris2.png" class="img-fluid rounded" alt="Inventaris Barang">
        </div>
        <div class="col-md-7" data-aos="fade-left">
            <div class="p-4">
                <h3 class="fw-bold">Tentang Sistem Inventaris</h3>
                <p class="fs-5 text-start">
                    Sistem Inventaris Barang ini dirancang untuk membantu dalam pencatatan, pengelolaan, dan 
                    pemantauan barang secara efisien. Dengan fitur pencarian cepat, statistik real-time, dan 
                    tampilan data yang rapi, Anda dapat dengan mudah melacak kondisi serta jumlah barang yang tersedia.
                </p>
                <p class="fs-5 text-start">
                    Dari pencatatan kategori hingga kondisi barang, sistem ini memastikan bahwa semua informasi 
                    terorganisir dengan baik sehingga proses inventarisasi menjadi lebih efektif dan terstruktur.
                </p>
            </div>
        </div>
    </div>
</section>



    <!-- Statistik Ringkas -->
    <section id="stats" class="container mt-5">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card shadow-sm p-4" data-aos="fade-up">
                    <h4>Total Barang</h4>
                    <p class="fs-3 fw-bold"><?= $totalBarang ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm p-4" data-aos="fade-up" data-aos-delay="200">
                    <h4>Total Kategori</h4>
                    <p class="fs-3 fw-bold"><?= $totalKategori ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm p-4 text-danger" data-aos="fade-up" data-aos-delay="400">
                    <h4>Barang Rusak</h4>
                    <p class="fs-3 fw-bold"><?= $barangRusak ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tabel Data Barang -->
    <section id="tabel" data-aos="flip-right" data-aos-duration="1400">
        <div class="container mt-5">
            <h2 class="text-center mb-4">Daftar Barang Inventaris</h2>
            
            <div class="input-group mb-3" style="max-width: 300px;">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input class="form-control w-50" id="searchBox" type="text" placeholder="Cari Barang..." />
            </div>

            <div class="table-container">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Kondisi</th>
                                <th>Lokasi</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="barangTable">
                            <?php foreach ($barang as $item) : ?>
                                <tr class="<?= $item['jumlah'] < 5 ? 'table-warning' : '' ?>">
                                    <td><?= htmlspecialchars($item['id']); ?></td>
                                    <td><?= htmlspecialchars($item['nama_barang']); ?></td>
                                    <td><?= htmlspecialchars($item['kategori']); ?></td>
                                    <td><?= htmlspecialchars($item['jumlah']); ?></td>
                                    <td><?= htmlspecialchars($item['kondisi']); ?></td>
                                    <td><?= htmlspecialchars($item['lokasi']); ?></td>
                                    <td>
                                        <img src="../uploads/<?= htmlspecialchars($item['gambar']); ?>" class="table-img" alt="Gambar">
                                    </td>
                                    <td>
                                        <a href="detail.php?id=<?= $item['id']; ?>" class="btn btn-info btn-sm">Detail</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Informasi Tambahan -->
<section id="info-tambahan" class="container mt-5">
    <div class="row align-items-center">
        <div class="col-md-8 text-end" data-aos="fade-right">
            <h3 class="fw-bold">Mengapa Sistem Inventaris Penting?</h3>
            <p class="fs-5">
                Sistem inventaris membantu dalam pengelolaan barang agar lebih efisien, menghindari kehilangan barang, 
                serta memastikan semua aset terdata dengan baik. Dengan sistem ini, pencatatan dan pelacakan barang menjadi lebih mudah.
            </p>
            <p class="fs-5">
                Dengan data yang selalu diperbarui, pengambilan keputusan menjadi lebih cepat dan akurat, mengurangi kemungkinan kesalahan 
                dalam perhitungan jumlah stok dan kondisi barang.
            </p>
        </div>
        <div class="col-md-4 text-center" data-aos="fade-left">
            <img src="../img/inventaris4.png" class="img-fluid rounded shadow" alt="Manajemen Inventaris">
        </div>
    </div>
</section>


    <!-- Footer -->
    <footer id="footer" class="text-white text-center pb-4 mt-5">
        <img src="../img/wave2.png" class="img_footer img-fluid" alt="image">
        <p class="mt-5 mb-2">&copy;Copyright by Kelompok 5</p>
    </footer>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({ offset: 1 });

        // Pencarian Barang
        document.getElementById("searchBox").addEventListener("keyup", function() {
            let search = this.value.toLowerCase();
            let rows = document.querySelectorAll("#barangTable tr");

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(search) ? "" : "none";
            });
        });
    </script>
</body>
</html>
