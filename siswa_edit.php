<?php
include 'koneksi.php';

// Ambil NIS dari URL
if (!isset($_GET['nis'])) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
    Swal.fire({
        icon: 'error',
        title: 'NIS tidak ditemukan!',
        text: 'Silakan pilih data yang ingin diedit.',
        confirmButtonColor: '#ff4f8b'
    }).then(() => {
        window.location='home.php';
    });
    </script>";
    exit;
}

$nis = mysqli_real_escape_string($conn, $_GET['nis']);
$query = mysqli_query($conn, "SELECT * FROM siswa WHERE nis='$nis'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Data tidak ditemukan!',
        text: 'Siswa dengan NIS tersebut tidak ada di database.',
        confirmButtonColor: '#ff4f8b'
    }).then(() => {
        window.location='home.php';
    });
    </script>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Siswa</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="home-container">
        <h1><i class="fa-solid fa-user-pen"></i> Edit Data Siswa</h1>

        <div class="form-container">
            <form action="" method="POST">
                <div class="input-group">
                    <label for="nis">NIS</label>
                    <input type="text" id="nis_display" value="<?= htmlspecialchars($data['nis']); ?>" readonly>
                    <input type="hidden" name="nis" value="<?= htmlspecialchars($data['nis']); ?>">
                </div>

                <div class="input-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']); ?>" required>
                </div>
                <div class="input-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="L" <?= ($data['gender'] == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                        <option value="P" <?= ($data['gender'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="kelas">Kelas</label>
                    <input type="text" id="kelas" name="kelas" value="<?= htmlspecialchars($data['kelas']); ?>" required>
                </div>

                <div class="button-group">
                    <button type="submit" name="update" class="save-btn">
                        <i class="fa-solid fa-floppy-disk"></i> Update
                    </button>
                    <button type="button" class="cancel-btn" onclick="location.href='home.php'">
                        <i class="fa-solid fa-arrow-left"></i> Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
// Fungsi update data siswa
if (isset($_POST['update'])) {
    $nis = mysqli_real_escape_string($conn, $_POST['nis']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);

    $update = mysqli_query($conn, "UPDATE siswa SET nama='$nama', gender='$gender', kelas='$kelas' WHERE nis='$nis'");


    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

    if ($update) {
        echo "
        <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil 💖',
            text: 'Data siswa telah diperbarui!',
            showConfirmButton: false,
            timer: 1800,
            background: '#fff0f5',
            color: '#ff4f8b'
        }).then(() => {
            window.location='home.php';
        });
        </script>";
    } else {
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal 😢',
            text: 'Terjadi kesalahan saat memperbarui data.',
            confirmButtonColor: '#ff4f8b'
        });
        </script>";
    }
}
?>
