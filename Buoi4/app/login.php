<?php
require_once __DIR__ . '/common/auth.php';
redirectIfLoggedIn();
require_once __DIR__ . '/model/user.php';

$error = '';
$username = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim(is_string($_POST['username'] ?? null) ? $_POST['username'] : '');
    $password = is_string($_POST['password'] ?? null) ? $_POST['password'] : '';
    $user = $username !== '' && $password !== '' ? getUserByUsername($username) : false;
    if ($user && password_verify($password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = (int) $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: product_list.php');
        exit;
    }
    $error = 'Tên đăng nhập hoặc mật khẩu không chính xác.';
}
include __DIR__ . '/view/header.php';
?>
<main class="container mt-4 auth-card">
    <h2>Đăng nhập</h2>
    <?php if (isset($_GET['registered'])): ?><div class="alert alert-success">Đăng ký thành công. Bạn có thể đăng nhập.</div><?php endif; ?>
    <?php if ($error !== ''): ?><div class="alert alert-danger"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
    <form method="post" autocomplete="on">
        <div class="mb-3"><label for="username">Tên đăng nhập</label><input id="username" name="username" maxlength="50" class="form-control" value="<?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>" required></div>
        <div class="mb-3"><label for="password">Mật khẩu</label><input id="password" type="password" name="password" class="form-control" required></div>
        <button class="btn btn-primary" type="submit">Đăng nhập</button>
        <a class="btn btn-secondary" href="register.php">Đăng ký</a>
    </form>
</main>
<?php include __DIR__ . '/view/footer.php'; ?>
