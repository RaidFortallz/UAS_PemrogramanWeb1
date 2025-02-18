<?php
include 'check_session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="../css/profile_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
     <div class="hero-header">
        <div class="wrapper">
            <header>
                <div class="logo">
                <button class="btn-back" onclick="window.location.href='dashboard.php'">
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
                        <li><p>Profile</p></li>
                    </ul>
                </nav>
            </header>
            <div class="container">
                 <div class="hero-pic">
                    <img src="../img/account.png" id="profilePic" alt="profile pic">
                 </div>
                 <div class="hero-text">
                    <h5>Halo, Saya <span class="input">Admin</span></h5>
                    <h1 id="username_display">Pengguna</h1>
                    <p> Username: <span id="nama_user">-</span></p>
                    <p> Nama Lengkap: <span id="user_fullname">-</span></p>
                    <p> Email: <span id="user_email">-</span></p>

                    <div class="btn-group">
                       <a href="edit_profile.php" class="btn active">Edit Profile</a>
                       
                    </div>

                    <div class="social">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                        
                    </div>
                 </div>
            </div>
        </div>
     </div>

     <script src="https://cdn.jsdelivr.net/npm/typed.js/2.0.10/typed.min.js"></script>
     <script>

        function displayProfile() {
            const userName = localStorage.getItem('username') || 'Pengguna';
            const userEmail = localStorage.getItem('email') || '-';
            const userFullName = localStorage.getItem('nama') || '-';
            const userProfilePic = localStorage.getItem('img_user') || '../img/account.png';

            document.getElementById('nama_user').textContent = userName; 
            document.getElementById('username_display').textContent = userName;
            document.getElementById('user_email').textContent = userEmail;
            document.getElementById('user_fullname').textContent = userFullName;
            document.getElementById('profilePic').src = userProfilePic;

            console.log("Foto profil ditampilkan:", userProfilePic);

            
        }

        // Inisialisasi Typed.js dengan penundaan
        setTimeout(() => {
                var typed = new Typed(".input", {
                    strings: ["Admin","Manager","Supplier"],
                    typeSpeed: 70,
                    backSpeed: 55,
                    loop: true
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
