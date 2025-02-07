<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

include 'koneksi.php';

try {
    
    $username = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['pwd']) ? $_POST['pwd'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';

    if (empty($username) || empty($password) || empty($name)) {
        echo json_encode(["status" => "error", "message" => "Username, password, dan nama wajib diisi"]);
        exit;
    }

    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    $query = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $query->execute([$username]);

    if ($query->rowCount() > 0) {
        echo json_encode(["status" => "error", "message" => "Username sudah terdaftar"]);
        exit;
    }

    
    $insert = $conn->prepare("INSERT INTO users (username, password, name) VALUES (?, ?, ?)");
    $insert->execute([$username, $hashedPassword, $name]);

    if ($insert->rowCount() > 0) {
        echo json_encode(["status" => "success", "message" => "Pendaftaran berhasil"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Pendaftaran gagal"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Terjadi kesalahan: " . $e->getMessage()]);
}
?>
