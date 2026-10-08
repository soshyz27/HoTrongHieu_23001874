<?php
// Nhúng file model vào
require_once 'model/product.php';

echo "<h3>Danh sách sản phẩm lấy từ Database:</h3>";

// Gọi hàm lấy tất cả sản phẩm
$products = getAllProducts();

// Dùng print_r để in mảng dữ liệu (kèm thẻ <pre> cho dễ đọc)
echo "<pre>";
print_r($products);
echo "</pre>";
?>