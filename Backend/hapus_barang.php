<?php
include 'koneksi.php';

header('Content-Type: application/json'); // Set response sebagai JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        // Cek apakah barang ada di database
        $query = "SELECT gambar FROM tb_barang WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $barang = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($barang) {
            // Hapus gambar dari folder uploads
            $gambarPath = "../uploads/" . $barang['gambar'];
            if (!empty($barang['gambar']) && file_exists($gambarPath)) {
                unlink($gambarPath);
            }

            // Hapus data barang dari database
            $deleteQuery = "DELETE FROM tb_barang WHERE id = :id";
            $deleteStmt = $conn->prepare($deleteQuery);
            $deleteStmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($deleteStmt->execute()) {
                echo json_encode(["status" => "success"]);
                exit();
            } else {
                echo json_encode(["status" => "failed"]);
                exit();
            }
        } else {
            echo json_encode(["status" => "not found"]);
            exit();
        }
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
        exit();
    }
} else {
    echo json_encode(["status" => "invalid request"]);
    exit();
}
?>
