<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        
        $queryGambar = "SELECT gambar FROM tb_gambar_barang WHERE barang_id = :id";
        $stmtGambar = $conn->prepare($queryGambar);
        $stmtGambar->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtGambar->execute();
        $gambarList = $stmtGambar->fetchAll(PDO::FETCH_ASSOC);

        
        if ($gambarList) {
            echo json_encode(["status" => "success", "data" => $gambarList]);
        } else {
            echo json_encode(["status" => "error", "message" => "Tidak ada gambar ditemukan."]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "ID barang tidak valid."]);
}
?>
