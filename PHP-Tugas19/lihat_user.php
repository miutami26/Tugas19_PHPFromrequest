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

<!DOCTYPE html>
<html>

<head>
    <title>Detail Pengguna</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Detail Pengguna</h2>
        <div class="row">
            <div class="col-md-6">
                <img src="avatar/<?php echo $avatar; ?>" alt="Avatar" class="avatar" width="150px" height="150px">
            </div>
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <th>Nama:</th>
                        <td><?php echo $name; ?></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><?php echo $email; ?></td>
                    </tr>
                    <tr>
                        <th>Phone:</th>
                        <td><?php echo $phone; ?></td>
                    </tr>
                    <tr>
                        <th>Role:</th>
                        <td><?php echo $role; ?></td>
                    </tr>
                    <tr>
                        <th>address:</th>
                        <td><?php echo $address; ?></td>
                    </tr>
                </table>
            </div>
            <div class="from-group float-end">
                <a href="tabel_user.php" class="btn btn-primary mt-2">Kembali</a>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>