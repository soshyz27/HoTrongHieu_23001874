<?php
ob_start();
session_start();
require_once 'common/dbConnect.php';
require_once 'model/product.php';

// Lấy ID từ POST (khi gõ vào ô input) hoặc từ GET (khi bấm nút Xóa ở bảng)
$id = $_POST['id'] ?? $_GET['id'] ?? null;

if ($id) {
    // Kiểm tra xem sản phẩm có tồn tại trong CSDL không
    $product = getProductById($id);

    if ($product) {
        // Nếu tồn tại -> thực hiện xóa
        deleteProduct($id);
        header("Location: product_list.php");
        exit;
    } else {
        // Nếu không tồn tại -> chuyển hướng về danh sách kèm thông báo lỗi
        header("Location: product_list.php?msg=not_found");
        exit;
    }
} else {
    // Nếu không có ID nào được gửi lên -> về lại trang danh sách
    header("Location: product_list.php");
    exit;
}
?>