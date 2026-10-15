<?php
session_start();
if (!isset($_SESSION['usernames'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Data Siswa</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="home-container">
    <h1>Selamat datang, <span><?php echo htmlspecialchars($_SESSION['usernames']); ?></span>! 💕</h1>

    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        switch ($page) {
            case 'siswa_tambah':
                include 'siswa_tambah.php';
                break;
            case 'siswa_edit':
                include 'siswa_edit.php';
                break;
            case 'siswa_hapus':
                include 'siswa_hapus.php';
                break;
            default:
                include 'siswa_list.php';
                break;
        }
    } else {
        include 'siswa_list.php';
    }
    ?>
</div>
</body>
</html>
