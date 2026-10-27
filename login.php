<?php
require_once 'config.php';
if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
    header("Location: index.php");
    exit;
}
$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = md5(trim($_POST['password']));
    if (empty($username) || empty($_POST['password'])) {
        $error = t('empty_field');
    } else {
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['is_logged_in'] = true;
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit;
        } else {
            $error = "Username atau password salah!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="<?= $lang ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= t('login') ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="login-page">
        <div class="login-box">
            <div class="login-lang">
                <a href="?lang=id" class="<?= $lang === 'id' ? 'active' : '' ?>">ID</a> |
                <a href="?lang=en" class="<?= $lang === 'en' ? 'active' : '' ?>">EN</a>
            </div>

            <h1><?= t('title') ?></h1>
            <p class="sub"><?= t('login') ?></p>

            <?php if ($error): ?>
                <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="field">
                    <label for="username"><?= t('username') ?></label>
                    <input type="text" id="username" name="username" autocomplete="username" autofocus>
                </div>

                <div class="field">
                    <label for="password"><?= t('password') ?></label>
                    <input type="password" id="password" name="password" autocomplete="current-password">
                </div>

                <button type="submit" class="btn btn-primary"><?= t('login') ?></button>
            </form>
        </div>
    </div>
</body>
</html>
