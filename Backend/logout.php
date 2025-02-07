<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

include 'koneksi.php';

try {
    
    $session_token = isset($_POST['session_token']) ? $_POST['session_token'] : '';

    
    if (empty($session_token)) {
        echo json_encode(["status" => "error", "message" => "Session token wajib diisi"]);
        exit;
    }

    
    $update = $conn->prepare("UPDATE users SET session_token = NULL WHERE session_token = ?");
    $update->execute([$session_token]);


    if ($update->rowCount() > 0) {
        echo json_encode(["status" => "success", "message" => "Logout berhasil"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Session token tidak ditemukan atau sudah tidak valid"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Terjadi kesalahan: " . $e->getMessage()]);
}
?>
