<?php
include '../Backend/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data barang berdasarkan ID
    $query = "SELECT * FROM tb_barang WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $barang = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$barang) {
        echo "<script>alert('Barang tidak ditemukan!'); window.location.href='index.php';</script>";
        exit();
    }

    // Ambil gambar dari tb_gambar_barang berdasarkan id_barang
    $query_gambar = "SELECT * FROM tb_gambar_barang WHERE barang_id = :id_barang";
    $stmt_gambar = $conn->prepare($query_gambar);
    $stmt_gambar->bindParam(':id_barang', $id, PDO::PARAM_INT);
    $stmt_gambar->execute();
    $gambar_barang = $stmt_gambar->fetchAll(PDO::FETCH_ASSOC);

} else {
    echo "<script>alert('ID barang tidak valid!'); window.location.href='index.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Detail Halaman</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/detail_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
</head>
<body>

<div class="card-wrapper">
    <div class="card">
        <div class="product-imgs">
            <div class="img-display">
                <a href="javascript:history.back()" class="btn btn-primary mb-2">Kembali</a>
                <div class="img-showcase">
                    <?php foreach ($gambar_barang as $gambar) : ?>
                        <img src="../uploads/<?php echo $gambar['gambar']; ?>" alt="Gambar Barang">
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="img-select">
                <?php foreach ($gambar_barang as $key => $gambar) : ?>
                    <div class="img-item">
                        <a href="#" data-id="<?php echo $key + 1; ?>">
                            <img src="../uploads/<?php echo $gambar['gambar']; ?>" alt="Gambar Thumbnail">
                            
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="product-content">
            <h2 class="product-title"> <?php echo $barang['nama_barang']; ?> </h2>
            <div class="product-rating">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
                <span>4.7(21)</span>
            </div>
            <div class="product-price">
                <p class="new-price">Harga: <span>Rp<?php echo number_format($barang['harga'], 0, ',', '.'); ?></span></p>
            </div>
            <div class="product-detail">
                <h2>Deskripsi</h2>
                <p><?php echo $barang['deskripsi']; ?></p>
                <ul>
                    <li>Produk Masuk: <span><?php echo $barang['tanggal_masuk']; ?></span></li>
                    <li>Stok: <span><?php echo $barang['jumlah'] > 0 ? $barang['jumlah'] . ' (Tersedia)' : 'Kosong'; ?></span></li>
                    <li>Category: <span><?php echo $barang['kategori']; ?></span></li>
                    <li>Kondisi: <span><?php echo $barang['kondisi']; ?></span></li>
                    <li>Area: <span><?php echo $barang['lokasi']; ?></span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<footer class="bg-dark text-light py-4 mt-2">
    <div class="container text-center">
        <p class="mb-2">&copy;Copyright by 22552011263_KELOMPOK 5_M Dimas Daniswara Putra_TIF RP 22 CNS_UASWEB1</p>
        <p class="mb-2">&copy;Copyright by 22552011263_KELOMPOK 5_M Dimas Daniswara Putra_TIF RP 22 CNS_UASWEB1</p>
        <p class="mb-2">&copy;Copyright by 22552011263_KELOMPOK 5_M Dimas Daniswara Putra_TIF RP 22 CNS_UASWEB1</p>
        <p class="mb-2">&copy;Copyright by 22552011263_KELOMPOK 5_M Dimas Daniswara Putra_TIF RP 22 CNS_UASWEB1</p>
    </div>
</footer>

<script src="detail_js.js"></script>
</body>

</html>
