<?php
include '../Backend/koneksi.php';

// Ambil semua data barang
$query = "SELECT * FROM tb_barang";
$stmt = $conn->prepare($query);
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/editgrid_style.css">
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex align-items-center justify-content-center position-relative mb-4">
            <a href="dashboard.php" class="btn btn-secondary position-absolute start-0">⬅ Kembali</a>
            <h2 class="mb-0">Daftar Barang</h2>
        </div>

        <div class="row g-3">
            <?php foreach ($items as $item) : ?>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card shadow-sm">
                        <img src="../uploads/<?= htmlspecialchars($item['gambar']); ?>" class="card-img-top" alt="<?= htmlspecialchars($item['nama_barang']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($item['nama_barang']); ?></h5>
                            <p class="card-text"><strong>Kategori:</strong> <?= htmlspecialchars($item['kategori']); ?></p>
                            <p class="card-text"><strong>Harga:</strong> Rp<?= number_format($item['harga'], 0, ',', '.'); ?></p>
                            <a href="edit.php?id=<?= $item['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
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

</body>
</html>
