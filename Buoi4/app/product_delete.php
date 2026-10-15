<?php
ob_start();
require_once __DIR__ . '/common/auth.php';
requireLogin();
require_once 'common/dbConnect.php';
require_once 'model/product.php';

$id = filter_var($_POST['id'] ?? $_GET['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

if ($id === false) {
    header("Location: product_list.php?msg=invalid_id");
    exit;
}

$confirmationToken = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    $submittedToken = $_POST['confirmation_token'] ?? null;
    $sessionToken = $_SESSION['delete_confirmation'][$id] ?? null;

    if (!is_string($submittedToken) || !is_string($sessionToken) || !hash_equals($sessionToken, $submittedToken)) {
        header("Location: product_list.php?msg=invalid_confirmation");
        exit;
    }

    unset($_SESSION['delete_confirmation'][$id]);
}

// ID hợp lệ vẫn cần xác nhận rõ ràng trên máy chủ trước khi xóa.
$product = getProductById($id);
if (!$product) {
    header("Location: product_list.php?msg=not_found");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    if (deleteProduct($id)) {
        header("Location: product_list.php");
        exit;
    }
    header("Location: product_list.php?msg=delete_failed");
    exit;
}

$confirmationToken = bin2hex(random_bytes(32));
$_SESSION['delete_confirmation'][$id] = $confirmationToken;
?>

<?php include 'view/header.php'; ?>
<div class="container mt-4">
    <h2>Xác nhận xóa sản phẩm</h2>
    <div class="alert alert-warning">
        Bạn có chắc chắn muốn xóa sản phẩm
        <strong><?= htmlspecialchars($product['name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></strong>
        (ID: <?= (int) $product['id'] ?>) không?
    </div>
    <form method="POST">
        <input type="hidden" name="id" value="<?= (int) $product['id'] ?>">
        <input type="hidden" name="confirmation_token" value="<?= htmlspecialchars($confirmationToken, ENT_QUOTES, 'UTF-8') ?>">
        <button type="submit" name="confirm_delete" value="1" class="btn btn-danger">Xác nhận xóa</button>
        <a href="product_list.php" class="btn btn-secondary">Hủy</a>
    </form>
</div>
<?php include 'view/footer.php'; ?>
