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

    $query = $conn->prepare("SELECT id, name, username, email, password, img_user FROM users WHERE session_token = ?");
    $query->execute([$session_token]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(["status" => "error", "message" => "Session token tidak valid"]);
        exit;
    }

    $user_id = $user['id'];
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $old_password = isset($_POST['old_password']) ? $_POST['old_password'] : '';
    $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    if (empty($username) || empty($name) || empty($email)) {
        echo json_encode(["status" => "error", "message" => "Username, nama lengkap, dan email wajib diisi"]);
        exit;
    }

    // **Upload gambar**
    if (isset($_FILES['img_user']) && $_FILES['img_user']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../uploads/";
        $file_name = time() . "_" . basename($_FILES["img_user"]["name"]); // Rename file agar unik
        $target_file = $target_dir . $file_name;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validasi format file
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            echo json_encode(["status" => "error", "message" => "Format gambar tidak didukung"]);
            exit;
        }

        // Pindahkan file ke server
        if (move_uploaded_file($_FILES["img_user"]["tmp_name"], $target_file)) {
            $img_user = $target_file;
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal mengunggah gambar"]);
            exit;
        }
    } else {
        // Jika tidak ada gambar diunggah, gunakan gambar lama
        $img_user = $user['img_user'];
    }

    if (!empty($old_password) && !empty($new_password) && !empty($confirm_password)) {
        if (password_verify($old_password, $user['password'])) {
            if ($new_password === $confirm_password) {
                $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);

                $update = $conn->prepare("UPDATE users SET username = ?, name = ?, email = ?, password = ?, img_user = ? WHERE id = ?");
                $update->execute([$username, $name, $email, $hashedPassword, $img_user, $user_id]);
            } else {
                echo json_encode(["status" => "error", "message" => "Konfirmasi password baru tidak cocok"]);
                exit;
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Password lama tidak cocok"]);
            exit;
        }
    } else {
        $update = $conn->prepare("UPDATE users SET username = ?, name = ?, email = ?, img_user = ? WHERE id = ?");
        $update->execute([$username, $name, $email, $img_user, $user_id]);
    }

    if ($update->rowCount() > 0) {
        echo json_encode(["status" => "success", "message" => "Profil berhasil diperbarui", "img_user" => $img_user]);
    } else {
        echo json_encode(["status" => "error", "message" => "Profil gagal diperbarui"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => "Terjadi kesalahan: " . $e->getMessage()]);
}
?>
