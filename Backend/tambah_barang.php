<?php
include '../Backend/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $jumlah = $_POST['jumlah'];
    $kondisi = $_POST['kondisi'];
    $lokasi = $_POST['lokasi'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    // Mengambil nama dan lokasi file gambar pertama
    $gambar1 = $_FILES['gambar1']['name'];
    $gambar_tmp1 = $_FILES['gambar1']['tmp_name'];
    $gambar_path1 = "../uploads/" . basename($gambar1);

    // Mengambil gambar tambahan
    $gambar_additional = isset($_FILES['gambar_additional']) ? $_FILES['gambar_additional'] : [];

    // Menyimpan gambar pertama ke dalam tb_barang dan tb_gambar_barang
        if (move_uploaded_file($gambar_tmp1, $gambar_path1)) {
            try {
                // Menambahkan barang ke tb_barang
                $query_barang = "INSERT INTO tb_barang (nama_barang, kategori, jumlah, kondisi, lokasi, tanggal_masuk, gambar, deskripsi, harga) 
                                VALUES (:nama_barang, :kategori, :jumlah, :kondisi, :lokasi, :tanggal_masuk, :gambar, :deskripsi, :harga)";
                $stmt_barang = $conn->prepare($query_barang);
                $stmt_barang->bindParam(':nama_barang', $nama_barang);
                $stmt_barang->bindParam(':kategori', $kategori);
                $stmt_barang->bindParam(':jumlah', $jumlah);
                $stmt_barang->bindParam(':kondisi', $kondisi);
                $stmt_barang->bindParam(':lokasi', $lokasi);
                $stmt_barang->bindParam(':tanggal_masuk', $tanggal_masuk);
                $stmt_barang->bindParam(':gambar', $gambar1);
                $stmt_barang->bindParam(':deskripsi', $deskripsi);
                $stmt_barang->bindParam(':harga', $harga);

                if ($stmt_barang->execute()) {
                    $barang_id = $conn->lastInsertId(); // Mendapatkan ID barang yang baru ditambahkan

                    // Menyimpan gambar pertama ke tb_gambar_barang juga
                    $query_gambar1 = "INSERT INTO tb_gambar_barang (barang_id, gambar) VALUES (:barang_id, :gambar)";
                    $stmt_gambar1 = $conn->prepare($query_gambar1);
                    $stmt_gambar1->bindParam(':barang_id', $barang_id);
                    $stmt_gambar1->bindParam(':gambar', $gambar1);
                    $stmt_gambar1->execute();

                    // Menambahkan gambar lainnya ke tb_gambar_barang
                    if (isset($gambar_additional['name'])) {
                        foreach ($gambar_additional['name'] as $index => $gambar_name) {
                            $gambar_tmp = $gambar_additional['tmp_name'][$index];
                            $gambar_path = "../uploads/" . basename($gambar_name);
                            
                            if (move_uploaded_file($gambar_tmp, $gambar_path)) {
                                $query_gambar = "INSERT INTO tb_gambar_barang (barang_id, gambar) VALUES (:barang_id, :gambar)";
                                $stmt_gambar = $conn->prepare($query_gambar);
                                $stmt_gambar->bindParam(':barang_id', $barang_id);
                                $stmt_gambar->bindParam(':gambar', $gambar_name);
                                $stmt_gambar->execute();
                            }
                        }
                    }

                    echo "<script>alert('Barang berhasil ditambahkan!'); window.location.href='../Frontend/dashboard.php';</script>";
                } else {
                    echo "<script>alert('Gagal menambahkan barang!'); window.history.back();</script>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "<script>alert('Gagal mengupload gambar!'); window.history.back();</script>";
        }

}
?>
