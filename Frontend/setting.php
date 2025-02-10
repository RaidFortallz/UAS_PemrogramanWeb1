<?php 
// Definisikan variabel default agar tidak ada error 'undefined variable'
$theme = isset($theme) ? $theme : 'light';
$language = isset($language) ? $language : 'id';
$notifications = isset($notifications) ? $notifications : 1; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Website</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/dashboard_style.css">
</head>
<body>
    <!-- Container Pengaturan -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <!-- Card untuk Pengaturan -->
            <div class="col-md-8">
                <div class="card shadow-lg rounded">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h3 class="mb-0">Pengaturan Website</h3>
                    </div>
                    <div class="card-body">
                        <!-- Form Pengaturan -->
                        <form action="save_settings.php" method="POST">
                            <div class="row">
                                <!-- Pengaturan Tampilan -->
                                <div class="col-md-6 mb-4">
                                    <h5 class="fw-bold">Pengaturan Tampilan</h5>
                                    <div class="mb-3">
                                        <label for="theme" class="form-label">Tema</label>
                                        <select class="form-select" id="theme" name="theme">
                                            <option value="light" <?= ($theme == 'light') ? 'selected' : '' ?>>Terang</option>
                                            <option value="dark" <?= ($theme == 'dark') ? 'selected' : '' ?>>Gelap</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="language" class="form-label">Bahasa</label>
                                        <select class="form-select" id="language" name="language">
                                            <option value="id" <?= ($language == 'id') ? 'selected' : '' ?>>Bahasa Indonesia</option>
                                            <option value="en" <?= ($language == 'en') ? 'selected' : '' ?>>English</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Pengaturan Notifikasi -->
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <h5 class="fw-bold">Pengaturan Notifikasi</h5>
                                    <div class="mb-3">
                                        <label for="notifications" class="form-label">Aktifkan Notifikasi</label>
                                        <select class="form-select" id="notifications" name="notifications">
                                            <option value="1" <?= ($notifications == 1) ? 'selected' : '' ?>>Aktif</option>
                                            <option value="0" <?= ($notifications == 0) ? 'selected' : '' ?>>Nonaktif</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <!-- Footer dengan Tombol Kembali -->
                        <a href="dashboard.php" class="btn btn-warning">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer id="footer" class="text-center pb-4 mt-5">
    <p class="mt-5 mb-2" style="color: #000000;">&copy;Copyright by KELOMPOK 7_TIF RP 22 CNS_UASWEB1</p>
        <div class="anggota-kelompok">
            <ul class="list-anggota">
                <li>Ageng Eko Widitya <br> (22552011082)</li>
                <li>Hikam Sirrul Arifin <br> (22552011066)</li>
                <li>M Dimas Daniswara Putra <br> (22552011263)</li>
                <li>Naufal Pratista Sugandhi <br> (22552011077)</li>
            </ul>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
