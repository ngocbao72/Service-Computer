<!-- views/payment.php -->
<?php
// Mã đơn hàng ngẫu nhiên
$orderNumber = rand(1000, 9999);

// Xử lý khi bấm nút Hoàn tất
if (isset($_POST['done'])) {
    header('Location: index.php'); // chuyển về trang chủ
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán dịch vụ - ServiceFix</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .card-payment {
            max-width: 420px;
            border-radius: 20px;
            padding: 2rem;
            background: #fff;
            border: 3px solid #e2e8f0;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
            transition: 0.3s;
        }
        .card-payment:hover {
            box-shadow: 0 15px 35px rgba(0,0,0,0.25);
        }
        .qr-img {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body class="bg-gray-50">

<!-- NAV BAR -->
<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <div class="bg-blue-600 text-white p-2 rounded-xl shadow-md">
                <i class="fas fa-tools text-xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-800">
                <span class="text-blue-600">ServiceFix</span>
            </h1>
        </div>

        <!-- Menu -->
        <div class="hidden md:flex items-center space-x-8 font-medium">
            <a href="index.php" class="text-gray-700 hover:text-blue-600 transition">Trang chủ</a>
            <a href="about.php?page=about" class="text-gray-700 hover:text-blue-600 transition">Giới thiệu</a>
            <a href="index.php?page=services" class="text-gray-700 hover:text-blue-600 transition">Dịch vụ</a>
            <a href="booking.php?page=booking" class="text-gray-700 hover:text-blue-600 transition">Đặt lịch</a>
            <a href="buildpc.php?page=buildpc" class="text-gray-700 hover:text-blue-600 transition">Build PC</a>
            <a href="payment.php?page=payment" class="text-blue-600 font-semibold">Thanh toán</a>

            <a href="index.php?page=login"
               class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition shadow-md">
                Đăng nhập
            </a>
        </div>
    </div>
</nav>

<!-- PAYMENT CARD -->
<div class="flex justify-center items-center min-h-screen">
    <div class="card-payment text-center">

        <h2 class="mb-4 text-primary text-2xl font-bold">Thanh toán dịch vụ</h2>

        <!-- Dòng QR nổi bật -->
        <p class="mb-4 text-xl font-semibold text-blue-700 flex justify-center items-center gap-3 
                  border-2 border-blue-500 bg-blue-50 px-4 py-2 rounded-xl shadow-sm">
            <i class="fa-solid fa-qrcode text-2xl text-blue-700"></i>
            Quét mã QR để thanh toán
        </p>

        <!-- QR Code -->
        <img src="/Service/assets/Image1.jpg" alt="QR Thanh toán" 
             class="qr-img mb-3" width="250"
             style="border:3px solid #60a5fa; border-radius:15px; padding:10px;">

        <!-- Thông tin ngân hàng -->
        <div class="text-start mb-4">
            <p><strong>Ngân hàng:</strong> MB Bank</p>
            <p><strong>Chủ tài khoản:</strong> Vũ Ngọc Bảo</p>
            <p><strong>Nội dung:</strong> Thanh toán dịch vụ #<?php echo $orderNumber; ?></p>
        </div>

        <!-- Nút hoàn tất -->
        <form method="post">
            <button type="submit" name="done" 
                    class="btn btn-success w-100 py-2"
                    style="font-size:1.1rem; border-radius:12px;">
                Hoàn tất thanh toán
            </button>
        </form>

        <!-- Mã đơn hàng -->
        <p class="mt-3 text-muted small">Mã đơn hàng: #<?php echo $orderNumber; ?></p>
    </div>
</div>

</body>
</html>
