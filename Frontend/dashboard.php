<?php
include '../Backend/koneksi.php';

$query = "SELECT * FROM tb_barang";
$stmt = $conn->prepare($query);
$stmt->execute();
$barang = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Dashboard</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="dashboard_style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>

    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex justify-content-between p-4">
                <div class="sidebar-logo">
                    <a href="#">J-Wir Inventaris</a>
                </div>
                <button class="toggle-btn border-0" type="button">
                <i id="icon" class='bx bx-chevrons-right'></i>
                </button>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item" onclick="window.location.href='index.php'">
                    <a href="#" class="sidebar-link">
                    <i class='bx bxs-user-account'></i>
                    <span>Home</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                    <i class='bx bxs-layer'></i>
                    <span>Data Inventaris</span>
                    </a>
                    <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link" onclick="window.location.href='tambah.php'">
                                Tambah Barang
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">
                                Edit Barang
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link">
                                Hapus Barang
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                    <i class='bx bxs-bell-ring'></i>
                    <span>Notifikasi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                    <i class='bx bxs-cog'></i>
                    <span>Setting</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="#" class="sidebar-link">
                <i class='bx bx-log-out'></i>
                <span>Logout</span>
                </a>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-4 py-3">
                <form action="#" class="d-none d-sm-inline-block">
                    <div class="input-group input-group-navbar">
                        <input type="text" class="form-control border-0 rounded-0 pe-0" placeholder="Cari..." aria-label="Search" data-aos="fade-right" data-aos-duration="1400">
                        <button class="btn border-0 rounded-0" type="button" data-aos="fade-left" data-aos-duration="1400">
                        <i class='bx bx-search'></i>    
                        </button>
                    </div>
                </form>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="../img/account.png" class="avatar img-fluid" alt="" data-aos="slide-down" data-aos-duration="1400">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end rounded-0 border-0 shadow mt-3">
                                <a href="#" class="dropdown-item">
                                <i class='bx bxs-user-account'></i>
                                    <span>Profile</span>
                                 </a>
                                <a href="#" class="dropdown-item">
                                    <i class='bx bx-cog'></i>
                                    <span>About</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" class="dropdown-item">
                                    <i class='bx bx-help-circle' ></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <div class="mb-3">
                        <h3 class="fw-bold fs-4 mb-3" data-aos="fade-down" data-aos-duration="1400">
                            Selamat Datang Admin di Dashboard
                        </h3>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="card shadow" data-aos="fade-right" data-aos-duration="1400">
                                    <div class="card-body py-4">
                                        <h6 class="mb-2 fw-bold">
                                             Total Inventaris
                                        </h6>
                                        <p class="fw-bold mb-2">
                                        150 item
                                        </p>
                                        <div class="mb-0">
                                            <span class="badge text-success me-2">
                                                +9
                                            </span>
                                            <span class="fw-bold">
                                                Sejak Bulan Lalu
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="card shadow" data-aos="zoom-in" data-aos-duration="1400">
                                    <div class="card-body py-4">
                                        <h6 class="mb-2 fw-bold">
                                             Barang Habis
                                        </h6>
                                        <p class="fw-bold mb-2">
                                        12 item
                                        </p>
                                        <div class="mb-0">
                                            <span class="badge text-success me-2">
                                                -12
                                            </span>
                                            <span class="fw-bold">
                                                Sejak Bulan Lalu
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="card shadow" data-aos="fade-left" data-aos-duration="1400">
                                    <div class="card-body py-4">
                                        <h6 class="mb-2 fw-bold" >
                                             Kategori Barang
                                        </h6>
                                        <p class="fw-bold mb-2">
                                            8 kategori
                                        </p>
                                        <div class="mb-0">
                                            <span class="badge text-success me-2">
                                                +1
                                            </span>
                                            <span class="fw-bold">
                                                Sejak Bulan Lalu
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-7" data-aos="slide-up" data-aos-duration="1400">
                                <h3 class="fw-bold fs-4 my-3">Data Inventaris Barang</h3>
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
                            <div class="col-12 col-md-5">
                                <h3 class="fw-bold fs-4 my-3">
                                    Reports Overview
                                </h3>
                                <canvas id="bar-chart-grouped" width="800" height="450"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row text-body-secondary">
                            <div class="col-12 text-center">
                                    <p>&copy;Copyright by 22552011263_KELOMPOK 5_M Dimas Daniswara Putra_TIF RP 22 CNS_UASWEB1</p>
                                </a>
                            </div>
                            <div class="col-12 text-center text-body-secondary d-none d-md-block">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        <a href="#" class="text-body-secondary">Kontak</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="text-body-secondary">About</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="#" class="text-body-secondary">Terms & Conditions</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </footer>
        </div>
    </div>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({ offset: 1 });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="dashboard_js.js"></script>
</body>
</html>