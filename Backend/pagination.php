<?php
include 'koneksi.php';

$itemsPerPage = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;

// Ambil data barang sesuai halaman
$query = "SELECT * FROM tb_barang LIMIT $offset, $itemsPerPage";
$stmt = $conn->prepare($query);
$stmt->execute();
$barang = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Hitung total barang
$queryCount = "SELECT COUNT(*) as total FROM tb_barang";
$stmtCount = $conn->prepare($queryCount);
$stmtCount->execute();
$totalItems = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];
$totalPages = ceil($totalItems / $itemsPerPage);

$no = $offset + 1; // Menentukan nomor urut
?>

<table class="table table-striped table-hover table-bordered text-center">
    <thead class="table-dark">
        <tr>
            <th>No</th>
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
            <tr class="<?= $item['jumlah'] < 5 ? 'table-warning' : '' ?>">
                <td><?= $no++; ?></td>
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

<!-- Pagination -->
<nav>
    <ul class="pagination justify-content-center">
        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
            <a class="page-link" href="#" onclick="loadPage(<?= $page - 1 ?>)">Previous</a>
        </li>
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                <a class="page-link" href="#" onclick="loadPage(<?= $i ?>)"><?= $i ?></a>
            </li>
        <?php endfor; ?>
        <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>">
            <a class="page-link" href="#" onclick="loadPage(<?= $page + 1 ?>)">Next</a>
        </li>
    </ul>
</nav>
