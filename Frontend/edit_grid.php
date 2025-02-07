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
        <h2 class="text-center mb-4">Daftar Barang</h2>

        
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
</body>
</html>
