<?php
require_once __DIR__ . '/common/auth.php';
// Người chưa đăng nhập cần vào trang xác thực trước.
header('Location: ' . (isLoggedIn() ? 'product_list.php' : 'login.php'));
exit();
?>
