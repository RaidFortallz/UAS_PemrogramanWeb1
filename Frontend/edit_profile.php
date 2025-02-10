<?php
include 'check_session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../css/editprofile_css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="hero-header">
        <div class="wrapper">
            <header>
                <div class="logo">
                    <button class="btn-back" onclick="window.location.href='profile.php'">
                        <i class="fa fa-arrow-left"></i> Kembali
                    </button>
                </div>
                <nav>
                    <div class="togglebtn">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <ul class="navlinks">
                        <li><p>Edit Profile</p></li>
                    </ul>
                </nav>
            </header>
            <div class="container edit-profile-container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card mt-8">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 text-center d-flex flex-column align-items-center">
                                        <div class="hero-pic mt-6">
                                            <img src="../img/account.png" class="rounded-circle" id="profilePic" alt="profile pic">
                                        </div>
                                        <input type="file" id="uploadImage" name="img_user" style="display:none" accept="image/*">
                                        <button class="btn btn-outline-primary mt-3" onclick="document.getElementById('uploadImage').click()">Ganti Profile</button>
                                    </div>
                                    <div class="col-md-8">
                                        <form id="editProfileForm" enctype="multipart/form-data">
                                            <div class="form-group mb-3">
                                                <label for="username">Username</label>
                                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="fullname">Nama Lengkap</label>
                                                <input type="text" class="form-control" id="fullname" name="name" placeholder="Enter full name">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                                            </div>
                                            <div class="form-group mb-3">
                                                <p>Ganti Password:</p>
                                                <label for="old_password">Password Lama</label>
                                                <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Enter old password">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="new_password">Password Baru</label>
                                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="confirm_password">Konfirmasi Password Baru</label>
                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm new password">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/typed.js/2.0.10/typed.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        

        function displayProfile() {
    const userName = localStorage.getItem('username') || 'Pengguna';
    const userEmail = localStorage.getItem('email') || '-';
    const userFullName = localStorage.getItem('nama') || '-';
    const userProfilePic = localStorage.getItem('img_user') || '../img/account.png';

    document.getElementById('username').value = userName;
    document.getElementById('email').value = userEmail;
    document.getElementById('fullname').value = userFullName;
    document.getElementById('profilePic').src = userProfilePic;

    console.log("Foto profil ditampilkan:", userProfilePic);
}


        function previewImage() {
        const file = document.getElementById('uploadImage').files[0];
        const reader = new FileReader();
        reader.onloadend = function () {
            document.getElementById('profilePic').src = reader.result;
        }
        if (file) {
            reader.readAsDataURL(file);
        } else {
            document.getElementById('profilePic').src = '../img/account.png';
        }
    }

    document.getElementById('uploadImage').addEventListener('change', previewImage);

    document.getElementById('editProfileForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    const fileInput = document.getElementById('uploadImage');
    const sessionToken = localStorage.getItem('session_token');

    if (fileInput.files.length > 0) {
        formData.append('img_user', fileInput.files[0]); // Tambahkan file ke FormData
    }

    if (sessionToken) {
        formData.append('session_token', sessionToken);
    }

    axios.post('../Backend/update_profile.php', formData, {
        headers: { 'Content-Type': 'multipart/form-data' }
    })
    .then(response => {
        console.log("Response dari server:", response.data);
        if (response.data.status === 'success') {
            alert('Profil berhasil diperbarui');
            window.location.href = 'profile.php';
        } else {
            alert('Profil gagal diperbarui: ' + response.data.message);
        }
    })
    .catch(error => {
        console.error('Error updating profile', error);
    });
});


        // Panggil fungsi checkSession saat halaman dimuat
        window.onload = checkSession;

        var togglebtn = document.querySelector(".togglebtn");
        var nav = document.querySelector(".navlinks");
        var links = document.querySelector(".navlinks li");

        togglebtn.addEventListener("click", function(){
            this.classList.toggle("click");
            nav.classList.toggle("open");
        });
    </script>
</body>
</html>
