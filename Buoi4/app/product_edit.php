<?php
ob_start();
session_start();
require_once 'common/dbConnect.php';
require_once 'model/product.php';
include 'view/header.php';

$id = $_GET['id'] ?? null;
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
    // Trường hợp 2: Người dùng bấm xác nhận lần cuối để lưu vào DB
    if (isset($_POST['confirm_update'])) {
        $name = trim($_POST['name'] ?? '');
        $price = trim($_POST['price'] ?? '');
        $quantity = trim($_POST['quantity'] ?? '');

        // Thực hiện cập nhật vào Database
        updateProduct($id, $name, $price, $quantity);
        
        // Chuyển hướng về danh sách sau khi cập nhật thành công
        header("Location: product_list.php");
        exit;
    } 
    // Trường hợp 1: Người dùng vừa bấm "Cập nhật" ở form đầu tiên -> Validate dữ liệu
    else {
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
            // Dữ liệu hợp lệ -> Chuyển sang hiển thị màn hình xác nhận
            $showConfirmation = true;
        }
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
                <li><strong>Tên sản phẩm mới:</strong> <?= htmlspecialchars($name) ?></li>
                <li><strong>Giá mới:</strong> <?= number_format($price, 2) ?></li>
                <li><strong>Số lượng mới:</strong> <?= $quantity ?></li>
            </ul>
            <hr>
            <!-- Form gửi dữ liệu ngầm để lưu thật sự khi bấm xác nhận lần 2 -->
            <form method="POST">
                <input type="hidden" name="name" value="<?= htmlspecialchars($name) ?>">
                <input type="hidden" name="price" value="<?= $price ?>">
                <input type="hidden" name="quantity" value="<?= $quantity ?>">
                
                <button type="submit" name="confirm_update" value="1" class="btn btn-success">Xác nhận cập nhật</button>
                <a href="product_edit.php?id=<?= $id ?>" class="btn btn-secondary">Quay lại chỉnh sửa</a>
            </form>
        </div>

    <!-- NẾU Ở BƯỚC NHẬP FORM BÌNH THƯỜNG -->
    <?php else: ?>
        <form method="POST">
            <div class="mb-3">
                <label>Tên sản phẩm</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($name) ?>" required>
            </div>
            <div class="mb-3">
                <label>Giá</label>
                <input type="number" step="0.01" name="price" class="form-control" value="<?= $price ?>" required>
            </div>
            <div class="mb-3">
                <label>Số lượng</label>
                <input type="number" name="quantity" class="form-control" value="<?= $quantity ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="product_list.php" class="btn btn-secondary">Quay lại</a>
        </form>
    <?php endif; ?>
</div>

<?php include 'view/footer.php'; ?>