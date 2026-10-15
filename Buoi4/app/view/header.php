<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hệ thống Quản lý Giỏ hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        .header, .footer {
            background-color: #f4f4f4;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
        }
        nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #0066cc;
            font-weight: bold;
        }
        nav a:hover {
            text-decoration: underline;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .btn {
            display: inline-block;
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }
        .btn-primary { background-color: #28a745; color: white; }
        .btn-warning { background-color: #ffc107; color: black; }
        .btn-danger { background-color: #dc3545; color: white; }
        .btn-secondary { background-color: #6c757d; color: white; }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            max-width: 400px;
            padding: 8px;
            box-sizing: border-box;
        }
        .error {
            color: #dc3545;
            background-color: #f8d7da;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .auth-card { max-width: 560px; }
        .form-control { display: block; width: 100%; max-width: 460px; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        .mb-3 { margin-bottom: 15px; }
        .alert { padding: 10px 14px; margin: 12px 0; border-radius: 4px; }
        .alert-danger { color: #842029; background: #f8d7da; }
        .alert-success { color: #0f5132; background: #d1e7dd; }
        .alert-warning { color: #664d03; background: #fff3cd; padding: 14px; }
        .d-flex { display: flex; gap: 10px; }
        .justify-content-between { justify-content: space-between; }
        .align-items-center { align-items: center; }
        .gap-2 { gap: 8px; }
        .mt-4 { margin-top: 24px; }
        .mb-3 { margin-bottom: 16px; }
        .btn-success { background: #198754; color: white; }
        .btn-sm { padding: 4px 8px; font-size: 0.875rem; }
        @media (max-width: 640px) { .d-flex { flex-wrap: wrap; } table { font-size: 14px; } th, td { padding: 6px; } }
    </style>
</head>
<body>
    <div class="header">
        <h1>Quản Lý Sản Phẩm</h1>
        <nav>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="product_list.php">Danh sách sản phẩm</a>
                <a href="product_add.php">Thêm sản phẩm</a>
                <span>Xin chào, <?= htmlspecialchars($_SESSION['username'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?></span>
                <a href="logout.php">Đăng xuất</a>
            <?php else: ?>
                <a href="login.php">Đăng nhập</a>
                <a href="register.php">Đăng ký</a>
            <?php endif; ?>
        </nav>
    </div>
    <div class="content">
