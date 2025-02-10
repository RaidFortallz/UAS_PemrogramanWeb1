<?php
include '../Backend/koneksi.php';

$query = "SELECT * FROM tb_barang ORDER BY id DESC";
$stmt = $conn->prepare($query);
$stmt->execute();
$barang = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Query untuk statistik
$totalBarang = $conn->query("SELECT COUNT(*) FROM tb_barang")->fetchColumn();
$totalKategori = $conn->query("SELECT COUNT(DISTINCT kategori) FROM tb_barang")->fetchColumn();
$barangRusak = $conn->query("SELECT COUNT(*) FROM tb_barang WHERE kondisi = 'Rusak'")->fetchColumn();

include 'check_session.php';

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
    <link rel="stylesheet" href="../css/dashboard_style.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
</head>
<body>

    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex justify-content-between p-4">
                <div class="sidebar-logo">
                    <a href="#">StokKu</a>
                </div>
                <button class="toggle-btn border-0" type="button">
                <i id="icon" class='bx bx-chevrons-right'></i>
                </button>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item" onclick="window.location.href='index.php'">
                    <a href="#" class="sidebar-link">
                    <i class='bx bxs-home-alt-2'></i>
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
                            <a href="#" class="sidebar-link" onclick="window.location.href='edit_grid.php'">
                                Edit Barang
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="#" class="sidebar-link" onclick="window.location.href='hapus.php'">
                                Hapus Barang
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" onclick="window.location.href='notifikasi.php'">
                    <i class='bx bxs-bell-ring'></i>
                    <span>Notifikasi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" onclick="window.location.href='setting.php'">
                    <i class='bx bxs-cog'></i>
                    <span>Setting</span>
                    </a>
                </li>
            </ul>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-4 py-3">
            <form action="#" class="d-none d-sm-inline-block">
                    <div class="input-group input-group-navbar">
                        <input type="text" class="form-control border-0 rounded-0 pe-0" 
                            id="search-barang" placeholder="Cari..." 
                            aria-label="Search" data-aos="fade-right" data-aos-duration="1400">
                        <button class="btn border-0 rounded-0" type="button" data-aos="fade-left" data-aos-duration="1400">
                            <i class='bx bx-search'></i>    
                        </button>
                    </div>
                </form>
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="../img/account.png" id="profilePic" class="avatar img-fluid" alt="" data-aos="slide-down" data-aos-duration="1400">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end rounded-0 border-0 shadow mt-3">
                                <a href="#" class="dropdown-item" onclick="window.location.href='profile.php'">
                                <i class='bx bxs-user-account'></i>
                                    <span>Profile</span>
                                 </a>
                                <div class="dropdown-divider"></div>
                                <a href="#" id="logout" class="dropdown-item">
                                <i class='bx bx-log-out'></i>
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
                        <h3 class="fw-bold fs-4 mb-3" id="nama_user" data-aos="fade-down" data-aos-duration="1400">
                            
                        </h3>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="card shadow" data-aos="fade-right" data-aos-duration="1400">
                                    <div class="card-body py-4">
                                        <h6 class="mb-2 fw-bold">
                                             Total Barang Inventaris
                                        </h6>
                                        <p class="fw-bold mb-2">
                                        <?= $totalBarang ?> item
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="card shadow" data-aos="zoom-in" data-aos-duration="1400">
                                    <div class="card-body py-4">
                                        <h6 class="mb-2 fw-bold">
                                             Total Kategori
                                        </h6>
                                        <p class="fw-bold mb-2">
                                        <?= $totalKategori ?> kategori
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="card shadow" data-aos="fade-left" data-aos-duration="1400">
                                    <div class="card-body py-4">
                                        <h6 class="mb-2 fw-bold" >
                                             Barang Rusak
                                        </h6>
                                        <p class="fw-bold mb-2">
                                        <?= $barangRusak ?> item
                                        </p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-7" data-aos="slide-up" data-aos-duration="1400">
                                <h3 class="fw-bold fs-4 my-3">Data Inventaris Barang</h3>
                                <div class="table-container">
                                    <div class="table-responsive"> 
                                        
                                    <div id="data-table">
                                        <!-- Data tabel akan dimuat dari pagination.php -->
                                    </div>


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
                            <p class="mt-5 mb-2">&copy;Copyright by KELOMPOK 7_TIF RP 22 CNS_UASWEB1</p>
                                <div class="anggota-kelompok">
                                    <ul class="list-anggota">
                                        <li>Ageng Eko Widitya <br> (22552011082)</li>
                                        <li>Hikam Sirrul Arifin <br> (22552011066)</li>
                                        <li>M Dimas Daniswara Putra <br> (22552011263)</li>
                                        <li>Naufal Pratista Sugandhi <br> (22552011077)</li>
                                    </ul>
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({ offset: 1 });

        // Cek apakah session_token ada di localStorage
        const sessionToken = localStorage.getItem('session_token');

        if (!sessionToken) {
            // Jika session_token tidak ada, arahkan ke login
            window.location.href = 'login.php';
        } else {
            // Jika session_token ada, tampilkan nama pengguna
            const userName = localStorage.getItem('username');
            if (userName) {
                document.getElementById('nama_user').textContent = 'Halo, ' + userName + '!'; 
            } else {
                document.getElementById('nama_user').textContent = 'Halo, pengguna!';
            }
        }

        // Logout functionality
        document.getElementById('logout').addEventListener('click', function() {
            // Ambil session_token dari localStorage
            const sessionToken = localStorage.getItem('session_token');

            if (!sessionToken) {
                alert("Anda belum login atau session sudah habis.");
                window.location.href = 'login.php';
                return;
            }

            // Buat objek FormData untuk mengirimkan session_token
            const formData = new FormData();
            formData.append('session_token', sessionToken);

            // Kirim request logout ke API logout.php
            axios.post('../Backend/logout.php', formData)
                .then(response => {
                    if (response.data.status === 'success') {
                        // Menghapus session_token dan nama dari localStorage
                        localStorage.removeItem('session_token');
                        localStorage.removeItem('nama');
                        
                        // Redirect ke halaman login setelah logout berhasil
                        window.location.href = 'login.php';
                    } else {
                        alert(response.data.message); // Tampilkan pesan error
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan pada server.');
                });
        });

        function displayProfile() {
            const userProfilePic = localStorage.getItem('img_user') || '../img/account.png';
            document.getElementById('profilePic').src = userProfilePic;

            console.log("Foto profil ditampilkan:", userProfilePic);
        }
       


        function loadTable(url, params = {}) {
    var currentScroll = window.scrollY; 

    $.ajax({
        url: url,
        type: "GET",
        data: params,
        success: function(response) {
            $("#data-table").html(response);
            window.scrollTo(0, currentScroll);
        },
        error: function(xhr, status, error) {
            console.error("Error loading table:", error);
        }
    });
}

// Definisikan loadPage terlebih dahulu
window.loadPage = function (page) {
    loadTable("../Backend/pagination.php", { page: page });
};

// Setelah loadPage dideklarasikan, baru dipanggil
$(document).ready(function() {
    loadPage(1); // Panggil setelah fungsi sudah ada

    $("#search").on("keyup", function () {
        let searchText = $(this).val().trim();
        if (searchText === "") {
            loadTable("../Backend/pagination.php"); // Kembali ke pagination jika kosong
        } else {
            loadTable("../Backend/cari_barang.php", { search: searchText });
        }
    });
});

document.getElementById("search-barang").addEventListener("input", function () {
    let keyword = this.value.trim();
    console.log("Keyword:", keyword); // Debugging output

    if (keyword.length > 0) {
        axios.get(`../Backend/pagination.php?search=${keyword}`)
            .then(response => {
                console.log(response.data); // Cek data yang diterima dari backend
                document.getElementById("data-table").innerHTML = response.data;
            })
            .catch(error => console.error("Error:", error));
    } else {
        axios.get("../Backend/pagination.php")
            .then(response => document.getElementById("data-table").innerHTML = response.data)
            .catch(error => console.error("Error:", error));
    }
});

document.addEventListener('DOMContentLoaded', (event) => {
    const anggotaKelompok = document.querySelector('.anggota-kelompok');
    if (anggotaKelompok) {
        anggotaKelompok.style.display = 'flex';
        anggotaKelompok.style.justifyContent = 'center';
        anggotaKelompok.style.alignItems = 'center';
        anggotaKelompok.style.flexWrap = 'wrap';
    }
    
    const listAnggota = document.querySelector('.list-anggota');
    if (listAnggota) {
        listAnggota.style.display = 'flex';
        listAnggota.style.justifyContent = 'center';
        listAnggota.style.alignItems = 'center';
        listAnggota.style.listStyleType = 'none';
        listAnggota.style.padding = '0';
        listAnggota.style.margin = '0';

        const listItems = listAnggota.querySelectorAll('li');
        listItems.forEach(item => {
            item.style.margin = '0 30px';  
            item.style.padding = '5px 10px';
            item.style.borderRadius = '5px';
        });
    }
});

    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="dashboard_js.js"></script>
</body>
</html>