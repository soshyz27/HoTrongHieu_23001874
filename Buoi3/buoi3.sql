CREATE DATABASE shopping_cart;

USE shopping_cart;

CREATE TABLE cart_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    quantity INT NOT NULL
);

-- Thêm sản phẩm
INSERT INTO
    cart_items (name, price, quantity)
VALUES ('áo phông', 150000, 2),
    ('quần kaki', 300000, 2),
    ('áo sơ mi', 220000, 6),
    ('quần jean', 350000, 1),
    ('áo khoác', 500000, 8);

-- Hiển thị toàn bộ sản phẩm
SELECT * FROM cart_items;

-- Sản phẩm có giá > 100000
SELECT * FROM cart_items WHERE price > 100000;

-- Sản phẩm có số lượng > 5
SELECT * FROM cart_items WHERE quantity > 5;

--  Sắp xếp giá giảm dần
SELECT * FROM cart_items ORDER BY price DESC;

-- Cập nhật giá
UPDATE cart_items SET price = 180000 WHERE id = 1;

-- Kiểm tra
SELECT * FROM cart_items WHERE id = 1;

-- Cập nhật số lượng
UPDATE cart_items SET quantity = 10 WHERE id = 2;

-- Kiểm tra
SELECT * FROM cart_items WHERE id = 2;

--Xóa một sản phẩm
DELETE FROM cart_items WHERE id = 4;

-- Kiểm tra
SELECT * FROM cart_items;

-- Hiển thị thành tiền
SELECT
    name,
    price,
    quantity,
    price * quantity AS total
FROM cart_items;

--Tổng tiền giỏ hàng
SELECT SUM(price * quantity) AS total_cart FROM cart_items;

-- QUẢN LÝ VÉ XEM PHIM

CREATE TABLE movies (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    total_seats INT NOT NULL,
    available_seats INT NOT NULL
);

-- Thêm phim
INSERT INTO
    movies (
        title,
        price,
        total_seats,
        available_seats
    )
VALUES ('Avengers', 100000, 100, 90),
    ('Avatar', 120000, 80, 50),
    ('Batman', 90000, 120, 100),
    (
        'Interstellar',
        150000,
        70,
        20
    ),
    ('Titanic', 110000, 60, 45);

-- Hiển thị toàn bộ phim
SELECT * FROM movies;

-- Phim có giá > 100000
SELECT * FROM movies WHERE price > 100000;

-- Phim còn > 50 ghế
SELECT * FROM movies WHERE available_seats > 50;

-- Sắp xếp giá vé giảm dần
SELECT * FROM movies ORDER BY price DESC;

-- Cập nhật số ghế còn lại
UPDATE movies SET available_seats = 75 WHERE id = 1;

-- Kiểm tra
SELECT * FROM movies WHERE id = 1;

-- Xóa một phim
DELETE FROM movies WHERE id = 5;

-- Kiểm tra
SELECT * FROM movies;

-- Tính số vé đã bán
SELECT
    title,
    total_seats,
    available_seats,
    total_seats - available_seats AS sold_seats
FROM movies;

-- Tính doanh thu từng phim
SELECT
    title,
    price,
    total_seats - available_seats AS sold_seats,
    (total_seats - available_seats) * price AS revenue
FROM movies;

-- Tổng doanh thu
SELECT SUM(
        (total_seats - available_seats) * price
    ) AS total_revenue
FROM movies;

-- Phim bán nhiều vé nhất
SELECT MAX(total_seats - available_seats) AS max_sold_seats
FROM movies;

-- Tìm tên phim bán nhiều vé nhất
SELECT
    title,
    total_seats - available_seats AS sold_seats
FROM movies
ORDER BY sold_seats DESC
LIMIT 1;