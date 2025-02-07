<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama_barang = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $jumlah = $_POST['jumlah'];
    $kondisi = $_POST['kondisi'];
    $lokasi = $_POST['lokasi'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    // 🔹 Update semua field di tb_barang
    $query = "UPDATE tb_barang 
              SET nama_barang = ?, kategori = ?, jumlah = ?, kondisi = ?, lokasi = ?, tanggal_masuk = ?, deskripsi = ?, harga = ? 
              WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->execute([$nama_barang, $kategori, $jumlah, $kondisi, $lokasi, $tanggal_masuk, $deskripsi, $harga, $id]);

    // 🔹 Update atau Tambahkan Gambar Utama
    if (!empty($_FILES['gambar_utama']['name'])) {
        $gambar_utama = $_FILES['gambar_utama'];
        $ext = pathinfo($gambar_utama['name'], PATHINFO_EXTENSION);
        $filename = "barang_" . time() . ".$ext";
        move_uploaded_file($gambar_utama['tmp_name'], "../uploads/$filename");

        // 🔹 Simpan di tb_barang
        $query = "UPDATE tb_barang SET gambar = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$filename, $id]);

        // 🔹 Simpan juga di tb_gambar_barang jika belum ada (tidak ditampilkan di input gambar tambahan)
        $queryCheck = "SELECT COUNT(*) FROM tb_gambar_barang WHERE barang_id = ? AND gambar = ?";
        $stmtCheck = $conn->prepare($queryCheck);
        $stmtCheck->execute([$id, $filename]);
        $exists = $stmtCheck->fetchColumn();

        if (!$exists) {
            $queryInsert = "INSERT INTO tb_gambar_barang (barang_id, gambar) VALUES (?, ?)";
            $stmtInsert = $conn->prepare($queryInsert);
            $stmtInsert->execute([$id, $filename]);
        }
    }

    // 🔹 Update atau Tambahkan Gambar Tambahan
    if (!empty($_FILES['gambar_tambahan']['name'][0])) {
        foreach ($_FILES['gambar_tambahan']['tmp_name'] as $key => $tmp_name) {
            if (!empty($tmp_name)) {
                $ext = pathinfo($_FILES['gambar_tambahan']['name'][$key], PATHINFO_EXTENSION);
                $filename = "barang_tambahan_" . time() . "_$key.$ext";
                move_uploaded_file($tmp_name, "../uploads/$filename");

                if (!empty($_POST['gambar_tambahan_id'][$key])) {
                    // 🔹 Jika gambar lama ada, lakukan DELETE & INSERT (biar gak ada gambar duplikat)
                    $query = "DELETE FROM tb_gambar_barang WHERE id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$_POST['gambar_tambahan_id'][$key]]);

                    $query = "INSERT INTO tb_gambar_barang (barang_id, gambar) VALUES (?, ?)";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$id, $filename]);
                } else {
                    // 🔹 Jika tidak ada ID gambar lama, lakukan INSERT
                    $query = "INSERT INTO tb_gambar_barang (barang_id, gambar) VALUES (?, ?)";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$id, $filename]);
                }
            }
        }
    }

    // 🔹 Redirect kembali ke halaman edit_grid setelah update
    header("Location: ../Frontend/edit_grid.php");
    exit;
}


?>
