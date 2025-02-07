<?php
include '../Backend/koneksi.php';

$query = "SELECT * FROM tb_barang";
$stmt = $conn->prepare($query);
$stmt->execute();
$barang = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Utama</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="index_style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>

<body>
    <section id="nav-bar">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="../img/inventory.png" class="img img-fluid" alt="image"></a>
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

    <section id="tabel" data-aos="flip-right" data-aos-duration="1400">
    <div class="container mt-5">
        <h2 class="text-center mb-4">Daftar Barang Inventaris</h2>
        <div class="table-container">
            <div class="table-responsive"> <!-- Menambahkan class Bootstrap -->
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
                    <tbody>
                        <?php foreach ($barang as $item) : ?>
                            <tr>
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


    <footer id="footer" class="text-white text-center pb-4 mt-5">
        <img src="../img/wave2.png" class="img_footer img-fluid" alt="image">
        <p class="mt-5 mb-2">&copy;Copyright by 22552011263_KELOMPOK 5_M Dimas Daniswara Putra_TIF RP 22 CNS_UASWEB1</p>
    </footer>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({ offset: 1 });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        let lastScrollTop = 0;
        const navbar = document.querySelector('.navbar');

        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > lastScrollTop) {
                navbar.style.top = '-70px'; 
            } else {
                navbar.style.top = '0';
            }

            lastScrollTop = scrollTop;
        });
    </script>
</body>
</html>
