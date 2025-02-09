<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

include 'koneksi.php';

try {
    
    error_log(print_r($_POST, true));

    $username = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['pwd']) ? $_POST['pwd'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    if (empty($username) || empty($password) || empty($name) || empty($email)) {
        echo json_encode(["status" => "error", "message" => "Username, password, nama, dan email wajib diisi"]);
        exit;
    }

    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    $query = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $query->execute([$username]);

    if ($query->rowCount() > 0) {
        echo json_encode(["status" => "error", "message" => "Username sudah terdaftar"]);
        exit;
    }

    
    $insert = $conn->prepare("INSERT INTO users (username, password, name, email) VALUES (?, ?, ?, ?)");
    $insert->execute([$username, $hashedPassword, $name, $email]);

    if ($insert->rowCount() > 0) {
        echo json_encode(["status" => "success", "message" => "Pendaftaran berhasil"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Pendaftaran gagal"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Terjadi kesalahan: " . $e->getMessage()]);
}
?>
