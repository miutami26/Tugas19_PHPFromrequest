<?php
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

// Mengambil ID pengguna dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengambil data pengguna dari database berdasarkan ID
    $query = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    // Memeriksa apakah query berhasil atau gagal
    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }

    // Memeriksa apakah pengguna ditemukan
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $avatar = $row['avatar'];
        $email = $row['email'];
        $phone = $row['phone'];
        $role = $row['role'];
        $address = $row['address'];

    } else {
        die("Pengguna tidak ditemukan");
    }
} else {
    die("ID pengguna tidak diberikan");
}

// Menutup koneksi database
mysqli_close($conn);
?>