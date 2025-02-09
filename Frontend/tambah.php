<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/tambah_style.css">
</head>
<body>
    <div class="container mt-5 position-relative">
            <a href="dashboard.php" class="btn btn-secondary back-btn">← Kembali</a>
            <h2 class="mb-4">Tambah Barang</h2>
            <div class="row">
                <!-- Container Kiri -->
                <div class="col-md-6 left-container">
                <form action="../Backend/tambah_barang.php" method="POST" enctype="multipart/form-data" onsubmit="console.log('Form submitted');">
                        <div class="mb-3">
                            <label for="nama_barang" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" name="nama_barang" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-control" name="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <option value="Elektronik">Elektronik</option>
                                    <option value="Perabot">Perabot</option>
                                    <option value="Buku">Buku</option>
                                    <option value="Medis">Medis</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="jumlah" class="form-label">Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kondisi" class="form-label">Kondisi</label>
                                <select class="form-control" name="kondisi" required>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak">Rusak</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lokasi" class="form-label">Lokasi Barang</label>
                                <input type="text" class="form-control" name="lokasi" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                            <input type="date" class="form-control" name="tanggal_masuk" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control" name="harga" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Tambah Barang</button>
                    
                </div>

                <!-- Container Kanan -->
                <div class="col-md-6 right-container">
                    <div class="mb-3">
                        <label for="gambar1" class="form-label">Gambar (Jumlah max 4)</label>
                        <input type="file" class="form-control" name="gambar1" id="gambar1" required>
                        <div class="uploaded-images" id="uploaded-images-1"></div>
                    </div>

                    <div id="additional-images"></div>

                    <button type="button" class="btn btn-success mt-2" id="add-image-btn">Tambah Gambar</button>
                </div>
            </div>
            </form>
        </div>

        <footer id="footer" class="text-white text-center pb-4 mt-5">
            <p class="mt-5 mb-2">&copy; Copyright by 22552011263_KELOMPOK 5_M Dimas Daniswara Putra_TIF RP 22 CNS_UASWEB1</p>
        </footer>

        <script>
            const maxImages = 3;
            let currentImages = 0;

            document.getElementById('gambar1').addEventListener('change', function(event) {
                previewImage(event, 'uploaded-images-1', this);
            });

            function previewImage(event, containerId, inputElement) {
                const file = event.target.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imgElement = document.createElement('img');
                    imgElement.src = e.target.result;
                    imgElement.classList.add('img-thumbnail', 'mt-2');

                    const cancelBtn = document.createElement('button');
                    cancelBtn.classList.add('btn', 'btn-danger', 'btn-sm', 'ms-2');
                    cancelBtn.innerHTML = 'X';
                    cancelBtn.addEventListener('click', function() {
                        inputElement.value = ''; 
                        document.getElementById(containerId).innerHTML = ''; 
                    });

                    const div = document.createElement('div');
                    div.classList.add('d-flex', 'align-items-center', 'gap-2', 'mt-2');
                    div.appendChild(imgElement);
                    div.appendChild(cancelBtn);

                    document.getElementById(containerId).innerHTML = ''; 
                    document.getElementById(containerId).appendChild(div);
                };

                if (file) {
                    reader.readAsDataURL(file);
                }
            }

            function addImageInput() {
                if (currentImages >= maxImages) return; 

                let uniqueId = new Date().getTime(); 
                let imageInputHTML = `
                    <div class="mb-3" id="image-container-${uniqueId}">
                        <div class="input-group">
                            <input type="file" class="form-control" name="gambar_additional[]" id="gambar-${uniqueId}">
                            <button type="button" class="btn btn-danger btn-sm ms-2 remove-image-btn" data-id="${uniqueId}">X</button>
                        </div>
                        <div class="uploaded-images" id="uploaded-images-${uniqueId}"></div>
                    </div>`;

                document.getElementById('additional-images').insertAdjacentHTML('beforeend', imageInputHTML);

                document.getElementById(`gambar-${uniqueId}`).addEventListener('change', function(event) {
                    previewImage(event, `uploaded-images-${uniqueId}`, this);
                });

                document.querySelector(`[data-id="${uniqueId}"]`).addEventListener('click', function() {
                    document.getElementById(`image-container-${uniqueId}`).remove();
                    currentImages--; // Kurangi jumlah gambar saat dihapus
                    checkImageLimit();
                });

                currentImages++; 
                checkImageLimit();
            }

            function checkImageLimit() {
                const addButton = document.getElementById('add-image-btn');
                if (currentImages >= maxImages) {
                    addButton.disabled = true; 
                } else {
                    addButton.disabled = false; 
                }
            }

            document.getElementById('add-image-btn').addEventListener('click', addImageInput);
        </script>
    </div>
</body>
</html>
