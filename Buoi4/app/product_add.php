<?php
ob_start();
session_start();
require_once 'common/dbConnect.php';
require_once 'model/product.php';
include 'view/header.php';

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $quantity = trim($_POST['quantity'] ?? '');

    if (empty($name)) {
        $error = "Tên sản phẩm không được để trống.";
    } elseif (!is_numeric($price) || $price <= 0) {
        $error = "Giá sản phẩm phải là số lớn hơn 0.";
    } elseif (!is_numeric($quantity) || $quantity < 0) {
        $error = "Số lượng phải là số lớn hơn hoặc bằng 0.";
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
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Giá</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Số lượng</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Lưu sản phẩm</button>
        <a href="product_list.php" class="btn btn-secondary">Quay lại</a>
    </form>
    
</div>

<?php include 'view/footer.php'; ?>