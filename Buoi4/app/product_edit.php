<?php
ob_start();
require_once __DIR__ . '/common/auth.php';
requireLogin();
require_once 'common/dbConnect.php';
require_once 'model/product.php';
include 'view/header.php';

$rawId = $_GET['id'] ?? null;
$id = is_scalar($rawId)
    ? filter_var($rawId, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]])
    : false;
if ($id === false) {
    echo "<div class='container mt-4'><div class='alert alert-danger'>ID sản phẩm không hợp lệ!</div></div>";
    include 'view/footer.php';
    exit;
}

$product = getProductById($id);

if (!$product) {
    echo "<div class='container mt-4'><div class='alert alert-danger'>Sản phẩm không tồn tại!</div></div>";
    include 'view/footer.php';
    exit;
}

$error = "";
$showConfirmation = false;

// Khởi tạo giá trị mặc định từ database hoặc từ POST lên
$name = $product['name'];
$price = $product['price'];
$quantity = $product['quantity'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isConfirmationPost = isset($_POST['confirm_update']);
    $name = isset($_POST['name']) && is_string($_POST['name']) ? trim($_POST['name']) : '';
    $price = isset($_POST['price']) && is_string($_POST['price']) ? trim($_POST['price']) : '';
    $quantity = isset($_POST['quantity']) && is_string($_POST['quantity']) ? trim($_POST['quantity']) : '';

    if (empty($name)) {
        $error = "Tên sản phẩm không được để trống.";
    } elseif (!is_numeric($price) || $price <= 0) {
        $error = "Giá sản phẩm phải là số lớn hơn 0.";
    } elseif (!preg_match('/\A\d+\z/', $quantity) || $quantity < 0 || $quantity > 2147483647) {
        $error = "Số lượng phải là số nguyên lớn hơn hoặc bằng 0.";
    } elseif ($isConfirmationPost) {
        if (updateProduct($id, $name, $price, $quantity)) {
            header("Location: product_list.php");
            exit;
        }
        $error = "Không thể cập nhật sản phẩm.";
    } else {
        $showConfirmation = true;
    }
}
?>

<div class="container mt-4">
    <h2>Sửa thông tin sản phẩm</h2>

    <!-- Hiển thị lỗi nếu có -->
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <!-- NẾU ĐANG Ở BƯỚC XÁC NHẬN -->
    <?php if ($showConfirmation): ?>
        <div class="alert alert-warning">
            <h4 class="alert-heading">Xác nhận thay đổi thông tin!</h4>
            <p>Vui lòng kiểm tra lại thông tin sản phẩm sau khi cập nhật trước khi lưu chính thức:</p>
            <ul class="mb-3">
                <li><strong>Tên sản phẩm mới:</strong> <?= htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></li>
                <li><strong>Giá mới:</strong> <?= number_format($price, 2) ?></li>
                <li><strong>Số lượng mới:</strong> <?= htmlspecialchars($quantity, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></li>
            </ul>
            <hr>
            <!-- Form gửi dữ liệu ngầm để lưu thật sự khi bấm xác nhận lần 2 -->
            <form method="POST">
                <input type="hidden" name="name" value="<?= htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
                <input type="hidden" name="price" value="<?= htmlspecialchars($price, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
                <input type="hidden" name="quantity" value="<?= htmlspecialchars($quantity, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>">
                
                <button type="submit" name="confirm_update" value="1" class="btn btn-success">Xác nhận cập nhật</button>
                <a href="product_edit.php?id=<?= htmlspecialchars((string) $id, ENT_QUOTES, 'UTF-8') ?>" class="btn btn-secondary">Quay lại chỉnh sửa</a>
            </form>
        </div>

    <!-- NẾU Ở BƯỚC NHẬP FORM BÌNH THƯỜNG -->
    <?php else: ?>
        <form method="POST">
            <div class="mb-3">
                <label>Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" required>
            </div>
            <div class="mb-3">
                <label>Giá</label>
                <input type="number" step="0.01" name="price" class="form-control" value="<?= htmlspecialchars((string) $price, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" required>
            </div>
            <div class="mb-3">
                <label>Số lượng</label>
                <input type="number" min="0" step="1" name="quantity" class="form-control" value="<?= htmlspecialchars((string) $quantity, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="product_list.php" class="btn btn-secondary">Quay lại</a>
        </form>
    <?php endif; ?>
</div>

<?php include 'view/footer.php'; ?>
