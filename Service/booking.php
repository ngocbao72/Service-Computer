<?php
// booking.php
// Giả sử bạn đã include hoặc require file kết nối DB
// require_once 'db.php';


$success = false;

if(isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $service_id = $_POST['service'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Xử lý lưu dữ liệu (ở đây bạn có thể lưu vào DB)
    // Ví dụ:
    // $stmt = $db->prepare("INSERT INTO bookings (name,phone,email,service_id,date,time) VALUES (?,?,?,?,?,?)");
    // $stmt->execute([$name,$phone,$email,$service_id,$date,$time]);

    $success = true;
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lịch sửa chữa - Service Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">

<!-- Navbar đơn giản -->
<nav class="bg-white shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo -->
        <div class="flex items-center space-x-3">
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

<!-- Header -->
<div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-12 text-center">
    <h2 class="text-4xl font-bold mb-3">Đặt lịch sửa chữa</h2>
    <p class="text-blue-100 text-lg">Vui lòng điền thông tin để chúng tôi liên hệ</p>
</div>

<!-- Form đặt lịch -->
<main class="container mx-auto px-4 py-12">
    <div class="max-w-lg mx-auto bg-white rounded-2xl shadow-xl p-8">
        <?php if($success): ?>
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4 text-center">
                Đặt lịch thành công! Chúng tôi sẽ liên hệ với bạn sớm.
            </div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Họ và tên</label>
                <input type="text" name="name" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Số điện thoại</label>
                <input type="text" name="phone" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Email</label>
                <input type="email" name="email" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Chọn dịch vụ</label>
                <select name="service" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <?php foreach($services as $s): ?>
                        <option value="<?php echo $s['id']; ?>"><?php echo $s['name']; ?> - <?php echo number_format($s['price'],0,',','.'); ?>đ</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Ngày</label>
                <input type="date" name="date" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Giờ</label>
                <input type="time" name="time" required class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>
            <button type="submit" name="submit" class="w-full bg-blue-600 text-white py-3 rounded-full hover:bg-blue-700 transition font-semibold">Đặt lịch</button>
        </form>
    </div>
</main>

</body>
</html>
