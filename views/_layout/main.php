<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/public/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand" href="/">🏎️ Thuê Xe</a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="/cars">Danh sách xe</a></li>
            <li class="nav-item"><a class="nav-link" href="/bookings">Đơn thuê</a></li>
            <li class="nav-item"><a class="nav-link" href="/logout">Đăng xuất</a></li>
        </ul>
    </nav>
    <div class="container mt-4">
        <?php if (isset($content)) echo $content; ?>
    </div>

    <footer class="text-center mt-5 text-muted">
        &copy; <?= date('Y') ?> Thuê xe - Dự án PHP thuần tại: <a href="https://github.com/Thoai1503/Rental_car_web_PHP">https://github.com/Thoai1503/Rental_car_web_PHP</a>
    </footer>
</body>
</html>