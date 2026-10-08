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
    </style>
</head>
<body>
    <div class="header">
        <h1>Quản Lý Sản Phẩm</h1>
        <nav>
            <a href="product_list.php">Danh sách sản phẩm</a> | 
            <a href="product_add.php">Thêm sản phẩm</a>
        </nav>
    </div>
    <div class="content">