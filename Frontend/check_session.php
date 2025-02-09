
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
            const formData = new FormData();
            formData.append('session_token', localStorage.getItem('session_token'));

            axios.post('../Backend/session.php', formData)
            .then(response => {
                console.log(response);
                if (response.data.status === 'success') {
                    const nama = response.data.hasil.name || 'Deafult Name';
                    localStorage.setItem('nama', nama);
                }else {
                    window.location.href = 'login.php';
                }
            })
            .catch(error => {
                console.error('Error checking session', error);
            });
        }

        // Panggil fungsi checkSession saat halaman dibuat
        checkSession();
    </script>
</body>
</html>