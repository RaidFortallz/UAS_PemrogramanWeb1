<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="tambah_style.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Tambah Barang</h2>
        <form action="../Backend/tambah_barang.php" method="POST" enctype="multipart/form-data">
            <div class="col-md-5 mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" name="nama_barang" required>
            </div>

            <div class="row g-3">
                <div class="col-md-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-control" name="kategori" required>
                        <option value="">Pilih Kategori</option>
                        <option value="">Pilih Kategori</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Perabot">Perabot</option>
                        <option value="Buku">Buku</option>
                        <option value="Medis">Medis</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="jumlah" class="form-label">Jumlah</label>
                    <input type="number" class="form-control" name="jumlah" required>
                </div>
                <div class="col-md-3">
                    <label for="kondisi" class="form-label">Kondisi</label>
                    <select class="form-control" name="kondisi" required>
                        <option value="Baik">Baik</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="lokasi" class="form-label">Lokasi Barang</label>
                    <input type="text" class="form-control" name="lokasi" required>
                </div>
            </div>

            <div class="col-md-5 row g-3">
                <div class="col-md-6">
                    <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                    <input type="date" class="form-control" name="tanggal_masuk" required>
                </div>
            </div>

            <div class="col-md-6 row g-3">
                <div class="col-md-6">
                    <label for="gambar1" class="form-label">Gambar</label>
                    <input type="file" class="form-control" name="gambar1" id="gambar1" required>
                    <div class="uploaded-images" id="uploaded-images-1"></div>
                </div>
            </div>

            <div class="uploaded-images" id="additional-images"></div>

            <div class="row g-3" id="add-image-row">
                <div class="col-md-6 mt-6">
                    <button type="button" class="btn btn-secondary" id="add-image-btn">Tambah Gambar</button>
                </div>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" rows="3" required></textarea>
            </div>
            <div class="col-md-4 mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" name="harga" required>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Barang</button>
            <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script>
        // Fungsi untuk menampilkan gambar pertama dan tombol cancel-nya
        document.getElementById('gambar1').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                const cancelBtn = document.createElement('button');
                cancelBtn.classList.add('cancel-btn');
                cancelBtn.innerHTML = 'X';
                cancelBtn.addEventListener('click', function() {
                    document.getElementById('gambar1').value = ''; 
                    document.getElementById('uploaded-images-1').innerHTML = ''; 
                });
                const div = document.createElement('div');
                div.classList.add('position-relative');
                div.appendChild(imgElement);
                div.appendChild(cancelBtn);

                document.getElementById('uploaded-images-1').innerHTML = ''; 
                document.getElementById('uploaded-images-1').appendChild(div);
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        });

        // Fungsi untuk menambah input gambar baru
        function addImageInput() {
            let imageInputHTML = ` 
                <div class="col-md-6 mt-3">
                    <input type="file" class="form-control" name="gambar_additional[]">
                    <div class="uploaded-images"></div>
                </div>`;
            const additionalImages = document.getElementById('additional-images');
            additionalImages.insertAdjacentHTML('beforeend', imageInputHTML);

            // Pindahkan button "Tambah Gambar" ke bawah input gambar baru
            const addImageRow = document.getElementById('add-image-row');
            additionalImages.appendChild(addImageRow);

            // Tambahkan event listener untuk preview gambar dan cancel di input baru
            const newImageInputs = document.querySelectorAll('#additional-images input[type="file"]');
            const newImageInput = newImageInputs[newImageInputs.length - 1];

            newImageInput.addEventListener('change', function(event) {
                const file = event.target.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    const cancelBtn = document.createElement('button');
                    cancelBtn.classList.add('cancel-btn');
                    cancelBtn.innerHTML = 'X';
                    cancelBtn.addEventListener('click', function() {
                        event.target.value = ''; 
                        event.target.closest('.col-md-6').querySelector('.uploaded-images').innerHTML = ''; 
                    });

                    const div = document.createElement('div');
                    div.classList.add('position-relative');
                    div.appendChild(imgElement);
                    div.appendChild(cancelBtn);

                    event.target.closest('.col-md-6').querySelector('.uploaded-images').innerHTML = ''; 
                    event.target.closest('.col-md-6').querySelector('.uploaded-images').appendChild(div);
                };

                if (file) {
                    reader.readAsDataURL(file);
                }
            });
        }

        document.getElementById('add-image-btn').addEventListener('click', addImageInput);
    </script>
</body>
</html>
