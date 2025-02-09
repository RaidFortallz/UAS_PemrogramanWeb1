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
    <title>Hapus Barang</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/editgrid_style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Tambahkan jQuery -->
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex align-items-center justify-content-center position-relative mb-4">
            <a href="dashboard.php" class="btn btn-secondary position-absolute start-0">⬅ Kembali</a>
            <h2 class="mb-0">Hapus Barang</h2>
        </div>

        <div class="row g-3">
            <?php foreach ($items as $item) : ?>
                <div class="col-lg-3 col-md-4 col-sm-6 item-card" data-id="<?= $item['id']; ?>">
                    <div class="card shadow-sm">
                        <img src="../uploads/<?= htmlspecialchars($item['gambar']); ?>" class="card-img-top" alt="<?= htmlspecialchars($item['nama_barang']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($item['nama_barang']); ?></h5>
                            <p class="card-text"><strong>Kategori:</strong> <?= htmlspecialchars($item['kategori']); ?></p>
                            <p class="card-text"><strong>Harga:</strong> Rp<?= number_format($item['harga'], 0, ',', '.'); ?></p>
                            <button type="button" class="btn btn-danger btn-sm hapus-btn" data-id="<?= $item['id']; ?>">Hapus</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
    $(document).ready(function () {
        $(".hapus-btn").on("click", function (e) {
            e.preventDefault();

            let itemCard = $(this).closest(".item-card");
            let id = $(this).data("id");

            if (confirm("Apakah Anda yakin ingin menghapus barang ini?")) {
                $.ajax({
                    url: "../Backend/hapus_barang.php",
                    type: "POST",
                    data: { id: id },
                    dataType: "json",
                    success: function (response) {
                        if (response.status === "success") {
                            alert("Barang berhasil dihapus!");
                            itemCard.fadeOut(500, function () { $(this).remove(); });
                        } else if (response.status === "not found") {
                            alert("Barang tidak ditemukan!");
                        } else {
                            alert("Gagal menghapus barang.");
                        }
                    },
                    error: function () {
                        alert("Terjadi kesalahan pada server.");
                    }
                });
            }
        });
    });
    </script>

</body>
</html>
