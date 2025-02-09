// Ambil elemen form
const loginForm = document.getElementById('loginForm');
const registerForm = document.getElementById('registerForm');

// Fungsi untuk menangani login
const handleLogin = (e) => {
    e.preventDefault();

    const username = document.getElementById('logUsername').value;
    const password = document.getElementById('logPassword').value;

    if (!username || !password) {
        alert("Username dan password wajib diisi");
        return;
    }

    const formData = new FormData();
    formData.append("user", username);
    formData.append("pwd", password);

    
    axios.post('../Backend/proses_login.php', formData)
        .then(response => {
            console.log(typeof response.data);
            console.log('Response', response.data);
            if (response.data.status === 'success') {

                console.log('Hasil:', response.data.hasil);
                console.log('Name:', response.data.hasil.name);

                if (response.data.hasil && response.data.hasil.name){
                localStorage.setItem('session_token', response.data.session_token);
                localStorage.setItem('nama', response.data.hasil.name);
                
                window.location.href = 'dashboard.php';

                } else {
                    console.log('Nama tidak ditemukan');
                    alert('Nama Pengguna tidak ditemukan dalam response');
                }
            } else {
                console.error('Kesalahan pada response data:', response.data);
                alert('Nama pengguna tidak ditemukan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan pada server.');
        });
};


const handleRegister = (e) => {
    e.preventDefault();

    const username = document.getElementById('regUsername').value;
    const password = document.getElementById('regPassword').value;
    const name = document.getElementById('regName').value;
    const email = document.getElementById('regEmail').value;

    console.log("Username:", username);
    console.log("Password:", password);
    console.log("Name:", name);
    console.log("Email:", email);
    
    if (!username || !password || !name || !email) {
        alert("Semua field harus diisi!");
        return;
    }

    const formData = new FormData();
    formData.append("user", username);
    formData.append("pwd", password);
    formData.append("name", name);
    formData.append("email", email);

    axios.post('../Backend/proses_register.php', formData)
        .then(response => {
            if (response.data.status === 'success') {
                alert('Pendaftaran berhasil');
                window.location.href = 'login.php'; 
            } else {
                alert(response.data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan pada server.');
        });
};


if (loginForm) loginForm.addEventListener('submit', handleLogin);
if (registerForm) registerForm.addEventListener('submit', handleRegister);


const container = document.querySelector('.container');
const registerBtn = document.querySelector('.register-btn');
const loginBtn = document.querySelector('.login-btn');

registerBtn.addEventListener('click', () => {
    container.classList.add('active');
});

loginBtn.addEventListener('click', () => {
    container.classList.remove('active');
});