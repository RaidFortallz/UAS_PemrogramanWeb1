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


    $query = $conn->prepare("SELECT name FROM users WHERE session_token = ?");
    $query->execute([$session_token]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        echo json_encode([
            "status" => "success",
            "name" => $user['name']
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Session token tidak valid"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Terjadi kesalahan: " . $e->getMessage()]);
}
?>
