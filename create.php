<?php
require_once 'config.php';
if (!isset($_SESSION['is_logged_in'])) { header("Location: login.php"); exit; }
$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = htmlspecialchars(trim($_POST['nim']));
    $nama = htmlspecialchars(trim($_POST['nama']));
    $jurusan = htmlspecialchars(trim($_POST['jurusan']));
    if (empty($nim) || empty($nama) || empty($jurusan)) {
        $error = t('empty_field');
    } else {
        $query = "INSERT INTO mahasiswa (nim, nama, jurusan) VALUES ('$nim', '$nama', '$jurusan')";
        if (mysqli_query($conn, $query)) {
            header("Location: index.php");
            exit;
        } else {
            $error = "Gagal menyimpan data!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= t('add_data') ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <header class="header">
        <div class="header-inner">
            <a href="index.php" class="brand">SIM Mahasiswa</a>
            <nav class="header-nav">
                <span><?= t('welcome') ?>, <?= htmlspecialchars($_SESSION['username']) ?></span>
                <a href="?lang=id" class="<?= $lang === 'id' ? 'active' : '' ?>">ID</a>
                <a href="?lang=en" class="<?= $lang === 'en' ? 'active' : '' ?>">EN</a>
                <a href="logout.php"><?= t('logout') ?></a>
            </nav>
        </div>
    </header>

    <main>
        <div class="container">
            <a href="index.php" class="back-link">&larr; <?= t('back') ?></a>
            <h1><?= t('add_data') ?></h1>
            <p class="page-sub" style="margin-bottom:16px;"><?= t('add_desc') ?></p>

            <?php if ($error): ?>
                <div class="alert alert-error" style="max-width:480px;"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="" class="form-box">
                <div class="field">
                    <label for="nim"><?= t('nim') ?></label>
                    <input type="text" id="nim" name="nim" value="<?= htmlspecialchars($_POST['nim'] ?? '') ?>" required>
                </div>

                <div class="field">
                    <label for="nama"><?= t('name') ?></label>
                    <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? '') ?>" required>
                </div>

                <div class="field">
                    <label for="jurusan"><?= t('major') ?></label>
                    <input type="text" id="jurusan" name="jurusan" value="<?= htmlspecialchars($_POST['jurusan'] ?? '') ?>" required>
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
