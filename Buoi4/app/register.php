<?php
require_once __DIR__ . '/common/auth.php';
redirectIfLoggedIn();
require_once __DIR__ . '/model/user.php';

$error = '';
$username = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim(is_string($_POST['username'] ?? null) ? $_POST['username'] : '');
    $password = is_string($_POST['password'] ?? null) ? $_POST['password'] : '';

    if ($username === '' || $password === '') {
        $error = 'Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.';
    } elseif (strlen($username) > 50) {
        $error = 'Tên đăng nhập không được vượt quá 50 ký tự.';
    } elseif (strlen($password) < 6) {
        $error = 'Mật khẩu phải có ít nhất 6 ký tự.';
    } elseif (getUserByUsername($username)) {
        $error = 'Tên đăng nhập đã tồn tại. Vui lòng chọn tên khác.';
    } else {
        try {
            registerUser($username, $password);
            header('Location: login.php?registered=1');
            exit;
        } catch (PDOException $e) {
            $error = 'Không thể đăng ký tài khoản. Vui lòng thử lại.';
        }
    }
}
include __DIR__ . '/view/header.php';
?>
<main class="container mt-4 auth-card">
    <h2>Đăng ký tài khoản</h2>
    <?php if ($error !== ''): ?><div class="alert alert-danger"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
    <form method="post" autocomplete="on">
        <div class="mb-3"><label for="username">Tên đăng nhập</label><input id="username" name="username" maxlength="50" class="form-control" value="<?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>" required></div>
        <div class="mb-3"><label for="password">Mật khẩu (ít nhất 6 ký tự)</label><input id="password" type="password" name="password" class="form-control" minlength="6" required></div>
        <button class="btn btn-primary" type="submit">Tạo tài khoản</button>
        <a class="btn btn-secondary" href="login.php">Đăng nhập</a>
    </form>
</main>
<?php include __DIR__ . '/view/footer.php'; ?>
