<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Siswa</title>

    <!-- Link CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="home-container">
        <h1><i class="fa-solid fa-user-graduate"></i> Data Siswa</h1>

        <div class="form-container">
            <h2><i class="fa-solid fa-user-plus"></i> Tambah Siswa</h2>

            <form action="" method="POST">
                <div class="input-group">
                    <label for="nis">NIS</label>
                    <input type="text" id="nis" name="nis" required>
                </div>
                <div class="input-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" required>
                </div>
                <div class="input-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" required>
                        <option value="">-- Pilih Gender --</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="input-group">
                    <label for="kelas">Kelas</label>
                    <input type="text" id="kelas" name="kelas" required>
                </div>

                <div class="button-group">
                    <button type="submit" name="simpan" class="save-btn">
                        <i class="fa-solid fa-floppy-disk"></i> Simpan
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
if (isset($_POST['simpan'])) {
    $nis = mysqli_real_escape_string($conn, $_POST['nis']);
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $kelas = mysqli_real_escape_string($conn, $_POST['kelas']);

    // Cek apakah NIS sudah ada
    $cek_nis = mysqli_query($conn, "SELECT * FROM siswa WHERE nis = '$nis'");
    if (mysqli_num_rows($cek_nis) > 0) {
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'NIS sudah terdaftar!',
            text: 'Gunakan NIS lain untuk siswa baru.',
            confirmButtonColor: '#ff4f8b'
        });
        </script>";
    } else {
        // Simpan data baru
        $query = "INSERT INTO siswa (nis, nama, gender, kelas) VALUES ('$nis', '$nama', '$gender', '$kelas')";
        if (mysqli_query($conn, $query)) {
            echo "
            <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data siswa berhasil disimpan.',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                window.location='home.php';
            });
            </script>";
        } else {
            echo "
            <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Terjadi kesalahan saat menyimpan data.',
                confirmButtonColor: '#ff4f8b'
            });
            </script>";
        }
    }
}
?>
