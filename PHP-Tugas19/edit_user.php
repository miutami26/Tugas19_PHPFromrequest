<?php
// Konfigurasi koneksi database
$host = "localhost"; // ganti sesuai dengan host database Anda
$username = "root"; // ganti sesuai dengan username database Anda
$password = ""; // ganti sesuai dengan password database Anda
$database = "arkatama_store"; // ganti sesuai dengan nama database Anda

// Membuat koneksi ke database
$conn = mysqli_connect($host, $username, $password, $database);

// Memeriksa apakah koneksi berhasil atau gagal
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Mendapatkan ID pengguna dari parameter URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Mengambil data pengguna dari database berdasarkan ID
    $query = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    // Memeriksa apakah query berhasil atau gagal
    if (!$result) {
        die("Query gagal: " . mysqli_error($conn));
    }

    // Memeriksa apakah pengguna dengan ID yang diberikan ditemukan
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Menampilkan form untuk mengedit data pengguna
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Pengguna</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Edit Pengguna</h2>
        <form method="POST" action="update_user.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="<?php echo $row['name']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="<?php echo $row['email']; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="<?php echo $row['phone']; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role">
                            <option value="admin" <?php if ($row['role'] === 'admin') echo 'selected'; ?>>Admin</option>
                            <option value="staff" <?php if ($row['role'] === 'staff') echo 'selected'; ?>>staff</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="avatar" class="mb-2">Foto</label>
                            <input type="file" class="form-control" id="avatar" name="avatar">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" id="address" name="address"
                    style="height: 100px"></textarea>
                <label for="address">Alamat</label>
            </div>
            <div class="from-group float-end">
                <a href="tabel_user.php" class="btn btn-warning  mt-2">Batal</a>
                <button type="submit" class="btn btn-primary mt-2">Update</button>
            </div>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
    }
}