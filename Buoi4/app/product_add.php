<?php
ob_start();
require_once __DIR__ . '/common/auth.php';
requireLogin();
require_once 'common/dbConnect.php';
require_once 'model/product.php';
include 'view/header.php';

$error = "";
$name = "";
$price = "";
$quantity = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) && is_string($_POST['name']) ? trim($_POST['name']) : '';
    $price = isset($_POST['price']) && is_string($_POST['price']) ? trim($_POST['price']) : '';
    $quantity = isset($_POST['quantity']) && is_string($_POST['quantity']) ? trim($_POST['quantity']) : '';

    if (empty($name)) {
        $error = "Tên sản phẩm không được để trống.";
    } elseif (!is_numeric($price) || $price <= 0) {
        $error = "Giá sản phẩm phải là số lớn hơn 0.";
    } elseif (!preg_match('/\A\d+\z/', $quantity) || $quantity < 0 || $quantity > 2147483647) {
        $error = "Số lượng phải là số nguyên lớn hơn hoặc bằng 0.";
    } else {
        addProduct($name, $price, $quantity);
        header("Location: product_list.php");
        exit;
    }
}
?>

<div class="container mt-4">
    <h2>Thêm sản phẩm mới</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
        <div class="mb-3">
            <label>Tên sản phẩm</label>
            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" required>
        </div>
        <div class="mb-3">
            <label>Giá</label>
            <input type="number" step="0.01" name="price" class="form-control" value="<?= htmlspecialchars($price, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" required>
        </div>
        <div class="mb-3">
            <label>Số lượng</label>
            <input type="number" min="0" step="1" name="quantity" class="form-control" value="<?= htmlspecialchars($quantity, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Lưu sản phẩm</button>
        <a href="product_list.php" class="btn btn-secondary">Quay lại</a>
    </form>
    
</div>

<?php include 'view/footer.php'; ?>
