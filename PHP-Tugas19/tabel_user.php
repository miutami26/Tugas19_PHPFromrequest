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

// Menghapus data pengguna dari database
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $query = "DELETE FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }
}

// Mengambil data pengguna dari database
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

// Memeriksa apakah query berhasil atau gagal
if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
//Periksa apakah pengguna telah login
if (!isset($_SESSION['user'])) {
header("Location: login.php");
exit();
}
?>


<!DOCTYPE html>
<html>

<head>
    <title>Tabel Pengguna</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Tabel Pengguna</h2>

        <div class="row">
            <div class="col-md-12 ">
                <div class="float-end">
                    <a href="logout.php" class="btn btn-secondary mb-3">Logout</a>
                    <a href="tambah_user.php" class="btn btn-primary mb-3">Tambah Data</a>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover table-bordered border-primary ">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Aksi</th>
                    <th>Nama</th>
                    <th>Avatar</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mengambil data pengguna dari database
                $query = "SELECT * FROM users";
                $result = mysqli_query($conn, $query);

                // Memeriksa apakah query berhasil atau gagal
                if (!$result) {
                    die("Query gagal: " . mysqli_error($conn));
                }
                // Menampilkan data pengguna ke dalam tabel
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>
                            <a href='edit_user.php?id=" . $row['id'] . "' class='btn btn-primary btn-sm'>Edit</a>
                            <a href='lihat_user.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Lihat</a>
                            <a href='?delete=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\")'>Hapus</a>
                        </td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td><img src='avatar/" . $row['avatar'] . "' alt='Avatar' class='avatar' width='50px' height='50px'></td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['role'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
// Menutup koneksi database
mysqli_close($conn);
?>