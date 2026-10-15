<?php
include 'koneksi.php';

// Pastikan parameter NIS ada di URL
if (!isset($_GET['nis'])) {
    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    <script>
    Swal.fire({
        icon: 'error',
        title: 'NIS tidak ditemukan!',
        text: 'Silakan pilih data siswa yang ingin dihapus.',
        confirmButtonColor: '#ff4f8b'
    }).then(() => {
        window.location='home.php';
    });
    </script>";
    exit;
}

$nis = mysqli_real_escape_string($conn, $_GET['nis']);
$hapus = mysqli_query($conn, "DELETE FROM siswa WHERE nis='$nis'");

// SweetAlert setelah aksi hapus
echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";

if ($hapus) {
    echo "
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Data Terhapus!',
        text: 'Data siswa dengan NIS $nis telah berhasil dihapus 💕',
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
        title: 'Gagal Menghapus!',
        text: 'Terjadi kesalahan saat menghapus data siswa 😢',
        confirmButtonColor: '#ff4f8b'
    }).then(() => {
        window.location='home.php';
    });
    </script>";
}
?>
