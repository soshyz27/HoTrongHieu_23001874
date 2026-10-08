<?php
require_once __DIR__ . '/../common/dbConnect.php';

// Lấy tất cả sản phẩm
function getAllProducts() {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM products");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Lấy sản phẩm theo ID
function getProductById($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Thêm sản phẩm mới
function addProduct($name, $price, $quantity) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO products (name, price, quantity) VALUES (?, ?, ?)");
    return $stmt->execute([$name, $price, $quantity]);
}

// Cập nhật sản phẩm
function updateProduct($id, $name, $price, $quantity) {
    global $conn;
    $stmt = $conn->prepare("UPDATE products SET name = ?, price = ?, quantity = ? WHERE id = ?");
    return $stmt->execute([$name, $price, $quantity, $id]);
}

// Xóa sản phẩm
function deleteProduct($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    return $stmt->execute([$id]);
}
?>