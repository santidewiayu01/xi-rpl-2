<div class="data-container">
    <h2><i class="fa-solid fa-users"></i> Data Siswa</h2>

    <button class="add-btn" onclick="location.href='home.php?page=siswa_tambah'">
        <i class="fa-solid fa-plus"></i> Tambah Siswa
    </button>

    <table class="table-siswa">
        <tr>
            <th width="5%">No</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>Gender</th>
            <th>Kelas</th>
            <th width="20%">Aksi</th>
        </tr>

        <?php
        include 'koneksi.php';
        $query = "SELECT * FROM siswa";
        $result = mysqli_query($conn, $query);
        $jumlah = mysqli_num_rows($result);

        if ($jumlah == 0) {
            echo "<tr><td colspan='6' align='center'>Data tidak ditemukan</td></tr>";
        } else {
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$no}</td>
                    <td>" . htmlspecialchars($row['nis']) . "</td>
                    <td>" . htmlspecialchars($row['nama']) . "</td>
                    <td>" . htmlspecialchars($row['gender']) . "</td>
                    <td>" . htmlspecialchars($row['kelas']) . "</td>
                    <td>
                        <button class='edit-btn' onclick=\"location.href='home.php?page=siswa_edit&nis={$row['nis']}'\">
                            <i class='fa-solid fa-pen'></i> Edit
                        </button>
                        <button class='delete-btn' onclick=\"hapusSiswa('{$row['nis']}')\">
                            <i class='fa-solid fa-trash'></i> Hapus
                        </button>
                    </td>
                </tr>";
                $no++;
            }
        }
        ?>
    </table>

    <div class="logout-section">
        <a href="logout.php" class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>
    </div>
</div>

<!-- Script SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function hapusSiswa(nis) {
    Swal.fire({
        title: 'Yakin ingin menghapus?',
        text: "Data siswa dengan NIS " + nis + " akan dihapus!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ff4f8b',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = 'home.php?page=siswa_hapus&nis=' + nis;
        }
    });
}
</script>
