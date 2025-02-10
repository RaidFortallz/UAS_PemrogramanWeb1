<?php
include '../Backend/koneksi.php';

// Cek apakah ada ID barang yang dikirim
if (!isset($_GET['id'])) {
    echo "ID barang tidak ditemukan!";
    exit;
}

$id = $_GET['id'];

$query = "SELECT * FROM tb_barang WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->execute([$id]);
$item = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$item) {
    echo "Barang tidak ditemukan!";
    exit;
}

$queryGambar = "SELECT id, gambar FROM tb_gambar_barang WHERE barang_id = ?";
$stmtGambar = $conn->prepare($queryGambar);
$stmtGambar->execute([$id]);
$gambarTambahan = $stmtGambar->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/editgrid_style.css">
</head>
        <body>
            <div class="container mt-5 position-relative">
                    <a href="edit_grid.php" class="btn btn-secondary back-btn">⬅ Kembali</a>
                    <h2 class="mb-4">Edit Barang</h2>
                    <div class="row">
                        
                        <div class="row">
                    <div class="col-md-6 left-container">
                        <form action="../Backend/edit_barang.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($item['id']); ?>">

                            <div class="mb-3">
                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                <input type="text" class="form-control" name="nama_barang" value="<?= htmlspecialchars($item['nama_barang']); ?>" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-control" name="kategori" required>
                                        <option value="Elektronik" <?= ($item['kategori'] == 'Elektronik') ? 'selected' : ''; ?>>Elektronik</option>
                                        <option value="Perabot" <?= ($item['kategori'] == 'Perabot') ? 'selected' : ''; ?>>Perabot</option>
                                        <option value="Buku" <?= ($item['kategori'] == 'Buku') ? 'selected' : ''; ?>>Buku</option>
                                        <option value="Medis" <?= ($item['kategori'] == 'Medis') ? 'selected' : ''; ?>>Medis</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="jumlah" class="form-label">Jumlah</label>
                                    <input type="number" class="form-control" name="jumlah" value="<?= htmlspecialchars($item['jumlah']); ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="kondisi" class="form-label">Kondisi</label>
                                    <select class="form-control" name="kondisi" required>
                                        <option value="Baik" <?= ($item['kondisi'] == 'Baik') ? 'selected' : ''; ?>>Baik</option>
                                        <option value="Rusak" <?= ($item['kondisi'] == 'Rusak') ? 'selected' : ''; ?>>Rusak</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="lokasi" class="form-label">Lokasi Barang</label>
                                    <input type="text" class="form-control" name="lokasi" value="<?= htmlspecialchars($item['lokasi']); ?>" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                                <input type="date" class="form-control" name="tanggal_masuk" value="<?= htmlspecialchars($item['tanggal_masuk']); ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" rows="3" required><?= htmlspecialchars($item['deskripsi']); ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" class="form-control" name="harga" value="<?= htmlspecialchars($item['harga']); ?>" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        
                            </div>

                            <div class="col-md-6 right-container">

                            <div class="mb-3">
                                <label for="gambar_utama" class="form-label">Gambar Thumbnail</label>
                                <div class="d-flex align-items-center">
                                    <img src="../uploads/<?= htmlspecialchars($item['gambar']); ?>" id="gambar_utama_preview" class="img-thumbnail me-2" width="150">
                                    <input type="file" class="form-control" name="gambar_utama" id="gambar_utama" onchange="previewImage('gambar_utama', 'gambar_utama_preview')">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="gambar_tambahan" class="form-label">Gambar Tambahan (Max 3)</label>
                                <div id="gambar_tambahan_container">
                                    <?php foreach ($gambarTambahan as $index => $gambar) : ?>
                                        <div class="d-flex align-items-center mb-2" id="gambar_container_<?= $index ?>">
                                            <img src="../uploads/<?= htmlspecialchars($gambar['gambar']); ?>" id="gambar_tambahan_preview_<?= $index ?>" class="img-thumbnail me-2" width="100">
                                            
                                            
                                            <input type="hidden" name="gambar_tambahan_id[]" value="<?= $gambar['id'] ?>">

                                            <input type="file" class="form-control me-2" name="gambar_tambahan[]" id="gambar_tambahan_<?= $index ?>" onchange="previewImage('gambar_tambahan_<?= $index ?>', 'gambar_tambahan_preview_<?= $index ?>')">
                                            
                                            <button type="button" class="btn btn-danger" onclick="removeImageInput('gambar_container_<?= $index ?>')">Hapus</button>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                                <button type="button" class="btn btn-success mt-2" id="add-image-btn" onclick="addImageInput()">Tambah Gambar</button>
                            </div>

                            </div>
                    </div>
                    </form>
                </div>

                <footer id="footer" class="text-center pb-4 mt-5">
                <p class="mt-5 mb-2" style="color: #000000;">&copy;Copyright by KELOMPOK 7_TIF RP 22 CNS_UASWEB1</p>
                    <div class="anggota-kelompok">
                        <ul class="list-anggota">
                            <li>Ageng Eko Widitya <br> (22552011082)</li>
                            <li>Hikam Sirrul Arifin <br> (22552011066)</li>
                            <li>M Dimas Daniswara Putra <br> (22552011263)</li>
                            <li>Naufal Pratista Sugandhi <br> (22552011077)</li>
                        </ul>
                    </div>
                </footer>

            </body>
            
            <script>
            function previewImage(inputId, previewId) {
                const input = document.getElementById(inputId);
                const preview = document.getElementById(previewId);
                const file = input.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                }

                if (file) {
                    reader.readAsDataURL(file);
                }
            }

            function addImageInput() {
                const container = document.getElementById('gambar_tambahan_container');
                const index = container.children.length;
                if (index >= 3) {
                    document.getElementById('add-image-btn').disabled = true;
                    return;
                }

                const uniqueId = new Date().getTime();

                const div = document.createElement('div');
                div.classList.add('d-flex', 'align-items-center', 'mb-2');
                div.id = `gambar_container_${uniqueId}`;

                const img = document.createElement('img');
                img.id = `gambar_tambahan_preview_${uniqueId}`;
                img.classList.add('img-thumbnail', 'me-2');
                img.width = 100;

                const input = document.createElement('input');
                input.type = 'file';
                input.classList.add('form-control', 'me-2');
                input.name = 'gambar_tambahan[]';
                input.id = `gambar_tambahan_${uniqueId}`;
                input.onchange = function() {
                    previewImage(input.id, img.id);
                }

                const button = document.createElement('button');
                button.type = 'button';
                button.classList.add('btn', 'btn-danger');
                button.innerText = 'Hapus';
                button.onclick = function() {
                    removeImageInput(div.id);
                }

                div.appendChild(img);
                div.appendChild(input);
                div.appendChild(button);
                container.appendChild(div);

                checkImageLimit();
            }

            function removeImageInput(containerId) {
                const container = document.getElementById(containerId);
                container.remove();
                checkImageLimit();
            }

            function checkImageLimit() {
                const container = document.getElementById('gambar_tambahan_container');
                const addButton = document.getElementById('add-image-btn');
                const index = container.children.length;
                if (index >= 3) {
                    addButton.disabled = true;
                } else {
                    addButton.disabled = false;
                }
            }

            // Panggil checkImageLimit saat halaman dimuat untuk memastikan kondisi awal
            window.onload = checkImageLimit;

            document.addEventListener('DOMContentLoaded', (event) => {
    const anggotaKelompok = document.querySelector('.anggota-kelompok');
    if (anggotaKelompok) {
        anggotaKelompok.style.display = 'flex';
        anggotaKelompok.style.justifyContent = 'center';
        anggotaKelompok.style.alignItems = 'center';
        anggotaKelompok.style.flexWrap = 'wrap';
    }
    
    const listAnggota = document.querySelector('.list-anggota');
    if (listAnggota) {
        listAnggota.style.display = 'flex';
        listAnggota.style.justifyContent = 'center';
        listAnggota.style.alignItems = 'center';
        listAnggota.style.listStyleType = 'none';
        listAnggota.style.padding = '0';
        listAnggota.style.margin = '0';

        const listItems = listAnggota.querySelectorAll('li');
        listItems.forEach(item => {
            item.style.margin = '0 30px';  
            item.style.padding = '5px 10px';
            item.style.borderRadius = '5px';
        });
    }
});
            </script>
            </html>





