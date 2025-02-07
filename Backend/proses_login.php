<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

include 'koneksi.php';

try {
    
    $username = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['pwd']) ? $_POST['pwd'] : '';

    if (empty($username) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "Username dan password wajib diisi"]);
        exit;
    }

    
    $query = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $query->execute([$username]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        
        if (password_verify($password, $user['password'])) {
            // Generate session_token baru
            $token = bin2hex(random_bytes(16));

            // Update session_token di database
            $update = $conn->prepare("UPDATE users SET session_token = ? WHERE username = ?");
            $update->execute([$token, $username]);

            
            echo json_encode([
                "status" => "success",
                "session_token" => $token,
                "hasil" => [
                    "name" => $user['name']
                ]
            ]);
        } else {
            echo json_encode(["status" => "error", "message" => "Username atau password salah"]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Username atau password salah"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Terjadi kesalahan: " . $e->getMessage()]);
}
?>
