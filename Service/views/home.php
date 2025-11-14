<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Manager - Dịch vụ sửa chữa chuyên nghiệp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50">
    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <i class="fas fa-tools text-blue-600 text-2xl"></i>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">Service Computer</h1>
            </div>
            <div class="space-x-6">
                <a href="index.php" class="text-gray-700 hover:text-blue-600 transition font-medium">Trang chủ</a>
                <a href="about.php?page=about" class="text-gray-700 hover:text-blue-600 transition font-medium">Giới thiệu</a>
                <a href="index.php?page=services" class="text-gray-700 hover:text-blue-600 transition font-medium">Dịch vụ</a>
                <a href="booking.php?page=booking" class="text-gray-700 hover:text-blue-600 transition font-medium">Đặt lịch</a>
                <a href="payment.php?page=payment" class="text-gray-700 hover:text-blue-600 transition font-medium">Thanh toán</a>
                <a href="index.php?page=login" class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition">Đăng nhập</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-blue-600 to-blue-800 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <img src="https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=1200" alt="background" class="w-full h-full object-cover">
        </div>
        <div class="container mx-auto px-4 py-20 relative">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-bold mb-6 leading-tight whitespace-nowrap overflow-hidden">
                    Dịch vụ sửa chữa laptop chuyên nghiệp
                </h2>
                <p class="text-xl mb-8 text-blue-100">Khắc phục mọi sự cố nhanh chóng, bảo hành rõ ràng, giá cả hợp lý</p>
                <a href="index.php?page=services" class="inline-flex items-center bg-white text-blue-600 px-8 py-4 rounded-full text-lg font-semibold hover:bg-gray-100 transition shadow-lg">
                    <span>Xem dịch vụ của chúng tôi</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <main class="container mx-auto px-4 py-16">
        <div class="text-center mb-16">
            <h3 class="text-3xl font-bold text-gray-800 mb-3">Tại sao chọn chúng tôi?</h3>
            <p class="text-gray-600">Cam kết mang đến dịch vụ tốt nhất cho khách hàng</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 mb-16">
            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2 duration-300">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <i class="fas fa-bolt text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-center text-gray-800">Nhanh chóng</h3>
                <p class="text-gray-600 text-center leading-relaxed">Sửa chữa nhanh chóng, giao hàng đúng hẹn. Thời gian là vàng bạc</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2 duration-300">
                <div class="bg-gradient-to-br from-green-500 to-green-600 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <i class="fas fa-shield-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-center text-gray-800">Uy tín</h3>
                <p class="text-gray-600 text-center leading-relaxed">Bảo hành rõ ràng, chất lượng được đảm bảo 100%</p>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2 duration-300">
                <div class="bg-gradient-to-br from-orange-500 to-orange-600 w-16 h-16 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <i class="fas fa-dollar-sign text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold mb-3 text-center text-gray-800">Giá cả hợp lý</h3>
                <p class="text-gray-600 text-center leading-relaxed">Chi phí minh bạch, không phát sinh thêm</p>
            </div>
        </div>

        <!-- Process Section -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="grid md:grid-cols-2">
                <div class="p-12 flex flex-col justify-center">
                    <h3 class="text-3xl font-bold text-gray-800 mb-6">Quy trình làm việc chuyên nghiệp</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-blue-100 text-blue-600 rounded-full w-8 h-8 flex items-center justify-center font-bold mr-4 flex-shrink-0">1</div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-1">Tiếp nhận yêu cầu</h4>
                                <p class="text-gray-600">Khách hàng gửi thông tin và mô tả lỗi</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-blue-100 text-blue-600 rounded-full w-8 h-8 flex items-center justify-center font-bold mr-4 flex-shrink-0">2</div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-1">Kiểm tra và báo giá</h4>
                                <p class="text-gray-600">Kỹ thuật viên kiểm tra và đưa ra giá chính xác</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-blue-100 text-blue-600 rounded-full w-8 h-8 flex items-center justify-center font-bold mr-4 flex-shrink-0">3</div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-1">Tiến hành sửa chữa</h4>
                                <p class="text-gray-600">Thực hiện sửa chữa với linh kiện chính hãng</p>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="bg-blue-100 text-blue-600 rounded-full w-8 h-8 flex items-center justify-center font-bold mr-4 flex-shrink-0">4</div>
                            <div>
                                <h4 class="font-bold text-gray-800 mb-1">Bàn giao và bảo hành</h4>
                                <p class="text-gray-600">Giao máy và cam kết bảo hành dài hạn</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <img src="https://images.unsplash.com/photo-1581092160562-40aa08e78837?w=800" alt="laptop repair" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12 mt-20">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <i class="fas fa-tools text-blue-500 text-xl"></i>
                        <h3 class="text-xl font-bold text-white">Service Manager</h3>
                    </div>
                    <p class="text-gray-400">Dịch vụ sửa chữa laptop chuyên nghiệp, uy tín hàng đầu</p>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-white mb-4">Liên hệ</h4>
                    <div class="space-y-2">
                        <p><i class="fas fa-phone mr-2 text-blue-500"></i> 0123 456 789</p>
                        <p><i class="fas fa-envelope mr-2 text-blue-500"></i> support@service.vn</p>
                        <p><i class="fas fa-map-marker-alt mr-2 text-blue-500"></i> Số 2, Phố Xốm, Hà Đông, TP.HN</p>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-white mb-4">Liên kết</h4>
                    <div class="space-y-2">
                        <a href="index.php" class="block hover:text-blue-400 transition">Trang chủ</a>
                        <a href="index.php?page=services" class="block hover:text-blue-400 transition">Dịch vụ</a>
                        <a href="payment.php?page=payment" class="block hover:text-blue-400 transition">Thanh toán</a>
                        <a href="index.php?page=login" class="block hover:text-blue-400 transition">Đăng nhập</a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8 text-center">
                <p class="text-gray-500">&copy; 2025 Service Manager. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
