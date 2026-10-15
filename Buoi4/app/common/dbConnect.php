<?php
$host = '127.0.0.1';
$port = '3307'; // Đổi thành cổng MySQL đang dùng nếu khác.
$dbname = 'shopping_cart';
$username = 'root';
$password = ''; // Nếu MySQL của bạn có mật khẩu thì điền vào đây

try {
    // Chuỗi DSN chuẩn dành cho PDO khi dùng cổng khác 3306
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8", $username, $password);
    
    // Thiết lập chế độ báo lỗi để nếu kết nối sai cổng sẽ báo ngay
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log('Database connection failed: ' . $e->getMessage());
    http_response_code(500);
    exit('Không thể kết nối cơ sở dữ liệu. Vui lòng kiểm tra cấu hình MySQL.');
}
?>
