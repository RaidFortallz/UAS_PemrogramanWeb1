<?php
include 'koneksi.php';

$page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
$limit = 5; // Atur jumlah item per halaman
$offset = ($page - 1) * $limit;

// Ambil data barang sesuai halaman
$query = "SELECT * FROM tb_barang LIMIT $limit OFFSET $offset";
$stmt = $conn->prepare($query);
$stmt->execute();
$barang = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

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
