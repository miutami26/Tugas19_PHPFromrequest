<?php
// Konfigurasi koneksi database
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan data yang diinputkan melalui form
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];
    $address = $_POST['address'];
    $password = $_POST['password'];


    // Mendapatkan informasi tentang file yang diunggah
    $avatar = $_FILES['avatar'];

    // Memeriksa apakah file avatar baru diunggah
    if ($avatar['name']) {
        $avatar_name = $avatar['name'];
        $avatar_tmp = $avatar['tmp_name'];
        $avatar_size = $avatar['size'];
        $avatar_error = $avatar['error'];

        // Memeriksa apakah tidak ada error saat mengunggah avatar
        if ($avatar_error === 0) {
            $avatar_destination = 'avatar/' . $avatar_name;

            // Pengecekan keberadaan direktori avatar
            if (!is_dir('avatar/')) {
                // Jika direktori belum ada, buat direktori baru
                mkdir('avatar/');
            }

            // Memindahkan avatar ke direktori tujuan
            move_uploaded_file($avatar_tmp, $avatar_destination);

            // Melakukan update data pengguna beserta avatar
            $query = "UPDATE users SET name='$name', email='$email', phone='$phone', address='$address', password='$password',role='$role', avatar='$avatar_name' WHERE id='$id'";
            $result = mysqli_query($conn, $query);

            // Memeriksa apakah query berhasil atau gagal
            if ($result) {
                echo "Data pengguna berhasil diupdate dengan avatar baru.";
            } else {
                echo "Terjadi kesalahan saat melakukan update data pengguna.";
            }
        } else {
            echo "Terjadi kesalahan saat mengunggah avatar baru.";
        }
    } else {
        // Jika tidak ada avatar baru diunggah, melakukan update data pengguna tanpa avatar
        $query = "UPDATE users SET name='$name', email='$email', phone='$phone', address='$address', password='$password', role='$role' WHERE id='$id'";
        $result = mysqli_query($conn, $query);

        // Memeriksa apakah query berhasil atau gagal
        if ($result) {
            echo "Data pengguna berhasil diupdate tanpa avatar baru.";
        } else {
            echo "Terjadi kesalahan saat melakukan update data pengguna.";
        }
    }
}

// Menutup koneksi database
mysqli_close($conn);