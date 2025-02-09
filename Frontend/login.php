<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../css/login_style.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

    <div class="container">
        <div class="form-box login">
            <form id="loginForm">
                <h1>Login</h1>
                <div class="input-box">
                <input type="text" id="logUsername" placeholder="Username" required>
                <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                <input type="password" id="logPassword" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>

        <div class="form-box register">
            <form id="registerForm">
                <h1>Register</h1>
                <div class="input-box">
                <input type="text" id="regUsername" placeholder="Username" required>
                <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                <input type="text" id="regName" placeholder="Nama Lengkap" required>
                <i class='bx bxs-user-pin'></i>
                </div>
                <div class="input-box">
                <input type="password" id="regPassword" placeholder="Password" required>
                <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" class="btn">Register</button>
            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Selamat Datang!</h1>
                <p>Belum punya akun?</p>
                <button class="btn register-btn">Register</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h2>Selamat Datang Kembali!</h2>
                <p>Sudah punya akun?</p>
                <button class="btn login-btn">Login</button>
            </div>
        </div>

    </div>

    <script src="script.js"></script>
</body>
</html>