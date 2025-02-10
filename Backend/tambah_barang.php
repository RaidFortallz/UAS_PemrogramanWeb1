<?php
include '../Backend/koneksi.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo '<pre>';
    print_r($_FILES);
    echo '</pre>';
    echo 'Method: ' . $_SERVER["REQUEST_METHOD"] . '<br>';
    echo 'POST: ' . print_r($_POST, true) . '<br>';
    echo 'Request Headers: ' . print_r(getallheaders(), true) . '<br>';
    echo 'Server Info: ' . print_r($_SERVER, true) . '<br>';

    if (isset($_FILES['gambar1'])) {
        echo 'File gambar1 ditemukan<br>';
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

        echo 'Nama file: ' . $gambar1 . '<br>';
        echo 'Temporary file: ' . $gambar_tmp1 . '<br>';

        // Mengambil gambar tambahan
        $gambar_additional = isset($_FILES['gambar_additional']) ? $_FILES['gambar_additional'] : [];

        // Menyimpan gambar pertama ke dalam tb_barang dan tb_gambar_barang
        if (move_uploaded_file($gambar_tmp1, $gambar_path1)) {
            echo 'Upload gambar utama berhasil<br>';
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

                    // Mengecek apakah ada gambar tambahan yang diunggah
                    if (isset($_FILES['gambar_additional']) && count($_FILES['gambar_additional']['name']) > 0) {
                        foreach ($_FILES['gambar_additional']['tmp_name'] as $key => $tmp_name) {
                            $file_name = $_FILES['gambar_additional']['name'][$key];
                            $file_tmp = $_FILES['gambar_additional']['tmp_name'][$key];
                    
                            $upload_dir = "uploads/"; // Folder penyimpanan
                            $upload_path = $upload_dir . basename($file_name);
                    
                            if (move_uploaded_file($file_tmp, $upload_path)) {
                                echo "Gambar tambahan $file_name berhasil diunggah.<br>";
                            } else {
                                echo "Gagal mengunggah gambar tambahan $file_name.<br>";
                            }
                        }
                    } else {
                        echo "Tidak ada gambar tambahan yang diunggah.<br>";
                    }
                    

                    echo "<script>alert('Barang berhasil ditambahkan!'); window.location.href='../Frontend/dashboard.php';</script>";
                } else {
                    echo "<script>alert('Gagal menambahkan barang!'); window.history.back();</script>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            echo "<script>alert('Gagal mengupload gambar!');</script>";
        }
    } else {
        echo "<script>alert('Gambar utama tidak ditemukan!');</script>";
        exit();
    }
}
?>
