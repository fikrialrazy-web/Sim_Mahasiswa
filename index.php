<?php
require_once 'config.php';
if (!isset($_SESSION['is_logged_in'])) {
    header("Location: login.php");
    exit;
}
if (isset($_GET['delete_id'])) {
    $id = intval($_GET['delete_id']);
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id=$id");
    header("Location: index.php");
    exit;
}
$result = mysqli_query($conn, "SELECT * FROM mahasiswa ORDER BY id DESC");
$total = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= t('title') ?></title>
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
            <div class="page-head">
                <div>
                    <h1><?= t('title') ?></h1>
                    <p class="page-sub"><?= $total ?> <?= $lang === 'id' ? 'data' : 'records' ?></p>
                </div>
                <a href="create.php" class="btn btn-primary"><?= t('add_data') ?></a>
            </div>

            <?php if ($total === 0): ?>
                <div class="empty">
                    <p><?= t('no_data') ?></p>
                    <a href="create.php" class="btn"><?= t('add_data') ?></a>
                </div>
            <?php else: ?>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th class="center" style="width:50px;">No</th>
                                <th><?= t('nim') ?></th>
                                <th><?= t('name') ?></th>
                                <th><?= t('major') ?></th>
                                <th class="actions"><?= t('action') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="center"><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['nim']) ?></td>
                                <td><?= htmlspecialchars($row['nama']) ?></td>
                                <td><?= htmlspecialchars($row['jurusan']) ?></td>
                                <td class="actions">
                                    <a href="edit.php?id=<?= $row['id'] ?>" class="link-edit"><?= t('edit') ?></a>
                                    &middot;
                                    <a href="index.php?delete_id=<?= $row['id'] ?>" class="link-del" onclick="return confirm('<?= t('confirm_del') ?>')"><?= t('delete') ?></a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
