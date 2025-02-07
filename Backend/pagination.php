<?php
include 'koneksi.php';

$itemsPerPage = 5;

// Hitung total barang
$queryCount = "SELECT COUNT(*) as total FROM tb_barang";
$stmtCount = $conn->prepare($queryCount);
$stmtCount->execute();
$totalItems = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];

// Ambil halaman dari URL (default: 1)
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $itemsPerPage;

// Ambil data barang sesuai halaman
$query = "SELECT * FROM tb_barang LIMIT :offset, :itemsPerPage";
$stmt = $conn->prepare($query);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
$stmt->execute();
$barang = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Hitung total halaman
$totalPages = ceil($totalItems / $itemsPerPage);
?>

