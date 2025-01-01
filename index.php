<?php
// Koneksi dan fungsi lainnya tetap sama seperti yang Anda kirimkan
// Fungsi untuk membuka koneksi ke database SQLite3, select, update, delete, dan add
// function connectDB() {
    // Membuka koneksi ke database SQLite
    include 'app.php';
    $students=selectStudents();
    
// }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Siswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Manajemen Siswa</h1>
            <p>Tambah, Update, Hapus dan Lihat Daftar Siswa</p>
        </header>

        <!-- Form untuk menambahkan siswa -->
        <section class="form-section">
            <h2>Tambah Siswa Baru</h2>
            <form action="index.php" method="POST">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" required>

                <label for="age">Usia:</label>
                <input type="number" id="age" name="age" required>

                <label for="grade">Kelas:</label>
                <input type="text" id="grade" name="grade" required>

                <button type="submit" name="add">Tambah Siswa</button>
            </form>
        </section>

        <!-- Tabel untuk menampilkan daftar siswa -->
        <section class="students-list">
            <h2>Daftar Siswa</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Usia</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Ambil data siswa dari database
                        // $students = selectStudents();
                        if ($students) {
                            foreach ($students as $student) {
                                // tambahkan htmlspecialchars untuk menghindari XSS
                                echo "<tr>
                                    <td>" . htmlspecialchars($student['id'], ENT_QUOTES, 'UTF-8') . "</td>
                                    <td>" . htmlspecialchars($student['name'], ENT_QUOTES, 'UTF-8') . "</td>
                                    <td>" . htmlspecialchars($student['age'], ENT_QUOTES, 'UTF-8') . "</td>
                                    <td>" . htmlspecialchars($student['grade'], ENT_QUOTES, 'UTF-8') . "</td>
                                    <td>
                                        <a href='edit.php?id=" . $student['id'] . "' class='btn btn-update'>Edit</a>
                                        <a href='delete.php?id=" . $student['id'] . "' class='btn btn-delete' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                                    </td>
                                </tr>";
                                // tambahkan htmlspecialchars untuk menghindari XSS
                            }
                        }
                    ?>
                </tbody>
            </table>
        </section>

        <footer>
            <p>&copy; 2024 Manajemen Siswa - ALH</p>
        </footer>
    </div>

    <!-- PHP untuk menambahkan siswa -->
    <?php
    if (isset($_POST['add'])) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $grade = $_POST['grade'];
        addStudent($name, $age, $grade);
    }

    // PHP untuk menghapus siswa berdasarkan ID
    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        deleteStudent($id);
    }
    ?>
</body>
</html>
