<?php  
include '../Backend/koneksi.php';

// Ambil notifikasi terbaru dari database
$query = "SELECT * FROM tb_notifikasi ORDER BY waktu DESC LIMIT 5"; // Ambil 5 notifikasi terbaru
$stmt = $conn->prepare($query);
$stmt->execute();
$notifikasi = $stmt->fetchAll(PDO::FETCH_ASSOC);

include 'check_session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard_style.css">
</head>
<body>

    <div class="container mt-5">
        <h3 class="fw-bold fs-4 mb-3">Notifikasi Terbaru</h3>

        <!-- Tombol Kembali ke Dashboard -->
        <a href="dashboard.php" class="btn btn-primary mb-3">Kembali</a>

        <div class="card shadow">
            <div class="card-body py-4">
                <h6 class="mb-3 fw-bold">Daftar Notifikasi</h6>
                <ul class="list-group">
                    <?php if (!empty($notifikasi)): ?>
                        <?php foreach ($notifikasi as $notif): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <strong><?= $notif['judul']; ?></strong>
                                    <p class="mb-0"><?= $notif['deskripsi']; ?></p>
                                </div>
                                <span class="badge bg-info text-dark"><?= date('d-m-Y H:i:s', strtotime($notif['waktu'])); ?></span>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="list-group-item">Tidak ada notifikasi terbaru.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Footer -->
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
