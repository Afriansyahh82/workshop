<?php
$conn = new mysqli("localhost", "root", "", "pertemuan2");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
$sql = "SELECT * FROM notes ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Catatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class='text-bg-info p-3'>
    <h2>Daftar Catatan</h2>
    <a href="pages/create.php" class="btn btn-primary">Tambah Catatan Baru</a>
    <br><br>
    <table border="1" cellpadding="8" cellspacing="0" class='table table-dark table-striped'>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Isi Catatan</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $no = 1;
                // Looping data dari database
               // Looping data dari database
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $no++ . "</td>";
    echo "<td>" . htmlspecialchars($row['judul']) . "</td>"; // Menggunakan htmlspecialchars untuk keamanan
    echo "<td>" . htmlspecialchars($row['isi']) . "</td>"; // Menggunakan htmlspecialchars untuk keamanan
    echo "<td>" . date('d-m-Y H:i', strtotime($row['created_at'])) . "</td>";
    echo "<td>";
    echo "<a href='./pages/edit.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a> | "; // Perbaikan di sini
    echo "<a href='./actions/delete.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm (\"Apakah anda yakin ingin menghapus catatan ini?\" );'>Hapus</a>";
    echo "</td>";
    echo "</tr>";
}

            } else {
                echo "<tr><td colspan='5'>Belum ada catatan.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>
<?php
$conn->close();
?>