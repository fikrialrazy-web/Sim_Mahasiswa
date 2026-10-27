<?php
require_once 'config.php';
if (!isset($_SESSION['is_logged_in'])) { header("Location: login.php"); exit; }
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$error = "";
$result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id=$id");
if (mysqli_num_rows($result) == 0) { die("Data tidak ditemukan."); }
$row = mysqli_fetch_assoc($result);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = htmlspecialchars(trim($_POST['nim']));
    $nama = htmlspecialchars(trim($_POST['nama']));
    $jurusan = htmlspecialchars(trim($_POST['jurusan']));
    if (empty($nim) || empty($nama) || empty($jurusan)) {
        $error = t('empty_field');
        $row['nim'] = $nim;
        $row['nama'] = $nama;
        $row['jurusan'] = $jurusan;
    } else {
        $query = "UPDATE mahasiswa SET nim='$nim', nama='$nama', jurusan='$jurusan' WHERE id=$id";
        if (mysqli_query($conn, $query)) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Gagal merubah data!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= t('edit') ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header class="header">
        <div class="header-inner">
            <a href="index.php" class="brand">SIM Mahasiswa</a>
            <nav class="header-nav">
                <span><?= t('welcome') ?>, <?= htmlspecialchars($_SESSION['username']) ?></span>
                <a href="?id=<?= $id ?>&amp;lang=id" class="<?= $lang === 'id' ? 'active' : '' ?>">ID</a>
                <a href="?id=<?= $id ?>&amp;lang=en" class="<?= $lang === 'en' ? 'active' : '' ?>">EN</a>
                <a href="logout.php"><?= t('logout') ?></a>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <a href="index.php" class="back-link">&larr; <?= t('back') ?></a>
            <h1><?= t('edit') ?></h1>
            <p class="page-sub" style="margin-bottom:16px;"><?= t('edit_desc') ?></p>

            <?php if ($error): ?>
                <div class="alert alert-error" style="max-width:480px;"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="" class="form-box">
                <div class="field">
                    <label for="nim"><?= t('nim') ?></label>
                    <input type="text" id="nim" name="nim" value="<?= htmlspecialchars($row['nim']) ?>" required>
                </div>

                <div class="field">
                    <label for="nama"><?= t('name') ?></label>
                    <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($row['nama']) ?>" required>
                </div>

                <div class="field">
                    <label for="jurusan"><?= t('major') ?></label>
                    <input type="text" id="jurusan" name="jurusan" value="<?= htmlspecialchars($row['jurusan']) ?>" required>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><?= t('save') ?></button>
                    <a href="index.php" class="btn"><?= t('cancel') ?></a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
