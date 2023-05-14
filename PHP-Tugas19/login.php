<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "arkatama_store";

// Membuat koneksi ke database
$conn = mysqli_connect($host, $username, $password, $database);

// Memeriksa apakah koneksi berhasil atau gagal
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Memeriksa apakah form login telah dikirim
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Melakukan query untuk memeriksa pengguna yang cocok dengan email dan password yang diberikan
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Login berhasil, simpan data pengguna dalam sesi
        $user = mysqli_fetch_assoc($result);
        $_SESSION['user'] = $user;
        header("Location: tabel_user.php");
        exit();
    } else {
        // Login gagal, tampilkan pesan error
        $error_message = "Email atau password salah. Silakan coba lagi.";
    }
}

// Menutup koneksi database
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Log | In</title>
</head>

<body>
    <div class="container">
        <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>

            <?php if (isset($error_message)) : ?>
            <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <div class="input-group">
                <input type="email" placeholder="Email" name="email" id="email" value="" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" id="password" value="" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Login</button>
            </div>
            <p class="login-register-text">Anda belum punya akun? <a href="register.php">Register</a></p>
        </form>
    </div>
</body>

</html>