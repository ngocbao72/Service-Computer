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
    <title>Thanh toán dịch vụ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        .card-payment {
            border-radius: 15px;
            padding: 2rem;
            background: #fff;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            transition: transform 0.3s ease;
        }
        .card-payment:hover {
            transform: translateY(-5px);
        }
        .btn-pay {
            width: 100%;
            font-size: 1.1rem;
            font-weight: 600;
        }
        .qr-img {
            border: 2px solid #007bff;
            border-radius: 15px;
            padding: 10px;
            background: #f8f9fa;
        }
        .order-number {
            font-size: 0.9rem;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card-payment text-center" style="max-width: 420px;">
            <h2 class="mb-4 text-primary">Thanh toán dịch vụ</h2>

            <!-- Dòng số tiền đã loại bỏ -->

            <p class="mb-2">Quét mã QR để thanh toán:</p>
            <img src="../assets/images/qr_vietqr.png" alt="QR Thanh toán" class="img-fluid qr-img mb-3" width="250">

            <div class="text-start mb-3">
                <p><strong>Ngân hàng:</strong> MB Bank</p>
                <p><strong>Chủ tài khoản:</strong> Vũ Ngọc Bảo</p>
                <p><strong>Nội dung:</strong> Thanh toán dịch vụ #<?php echo $orderNumber; ?></p>
            </div>

            <form method="post">
                <button type="submit" name="done" class="btn btn-success btn-pay">Hoàn tất thanh toán</button>
            </form>

            <p class="mt-3 order-number">Mã đơn hàng: #<?php echo $orderNumber; ?></p>
        </div>
    </div>
</body>
</html>
