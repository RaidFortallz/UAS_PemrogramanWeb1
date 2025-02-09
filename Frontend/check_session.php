<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <div class="container">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function checkSession() {
            const sessionToken = localStorage.getItem('session_token');
            console.log("Session Token yang dikirim:", sessionToken);

            const formData = new FormData();
            formData.append('session_token', sessionToken);

            axios.post('../Backend/session.php', formData)
                .then(response => {
                    console.log("Response dari server:", response.data);

                    if (response.data.status === 'success') {
                        const userData = response.data;
                        localStorage.setItem('username', userData.username || 'Pengguna');
                        localStorage.setItem('email', userData.email || '-');
                        localStorage.setItem('nama', userData.name || '-');

                        console.log("Username disimpan:", localStorage.getItem('username'));
                        console.log("Email disimpan:", localStorage.getItem('email'));
                        console.log("Nama disimpan:", localStorage.getItem('nama'));
                    } else {
                        console.log("Gagal, redirect ke login");
                        window.location.href = 'login.php';
                    }
                })
                .catch(error => {
                    console.error('Error checking session', error);
                });
        }

        // Panggil fungsi checkSession saat halaman dimuat
        window.onload = checkSession;
    </script>
</body>
</html>
