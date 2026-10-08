<?php
require_once 'common/dbConnect.php';
require_once 'model/product.php';
include 'view/header.php';

$products = getAllProducts();
?>

<div class="container mt-4">
    <h2>Danh sách sản phẩm</h2>
    
    <!-- Thanh công cụ: Thêm mới và Xóa theo ID trỏ về product_delete.php -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="product_add.php" class="btn btn-primary">Thêm sản phẩm mới</a>
        
        <form action="product_delete.php" method="POST" class="d-flex gap-2" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm có ID này không?');">
            <input type="number" name="id" class="form-control" placeholder="Nhập ID cần xóa" required style="width: 180px;">
            <button type="submit" class="btn btn-danger">Xóa theo ID</button>
        </form>
    </div>

    <!-- Hiển thị thông báo nếu ID không tồn tại -->
    <?php if (isset($_GET['msg']) && $_GET['msg'] == 'not_found'): ?>
        <div class="alert alert-danger">Sản phẩm không tồn tại hoặc đã bị xóa.</div>
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Chức năng</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $row): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= number_format($row['price']) ?> VNĐ</td>
                <td><?= $row['quantity'] ?></td>
                <td>
                    <a href="product_edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                    <!-- Nút xóa trực tiếp từng dòng cũng trỏ vào product_delete.php -->
                    <a href="product_delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'view/footer.php'; ?>