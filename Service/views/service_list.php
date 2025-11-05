<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách dịch vụ - Service Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <i class="fas fa-tools text-blue-600 text-2xl"></i>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">ServiceFix Manager</h1>
            </div>
            <div class="space-x-6">
                <a href="index.php" class="text-gray-700 hover:text-blue-600 transition font-medium">Trang chủ</a>
                <a href="index.php?page=services" class="text-blue-600 font-semibold">Dịch vụ</a>
                <a href="index.php?page=login" class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition">Đăng nhập</a>
            </div>
        </div>
    </nav>

    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-12">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-3">Các gói dịch vụ của chúng tôi</h2>
            <p class="text-blue-100 text-lg">Chọn gói dịch vụ phù hợp với nhu cầu của bạn</p>
        </div>
    </div>

    <main class="container mx-auto px-4 py-12">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php if (!empty($services)): ?>
                <?php foreach ($services as $service): ?>
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-2 duration-300">
                        <div class="relative h-48 bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                            <i class="fas fa-laptop text-white text-6xl opacity-20 absolute"></i>
                            <div class="relative text-center text-white p-6">
                                <i class="fas fa-wrench text-4xl mb-3"></i>
                                <h3 class="text-2xl font-bold"><?php echo htmlspecialchars($service['name']); ?></h3>
                            </div>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 mb-6 leading-relaxed min-h-[60px]"><?php echo nl2br(htmlspecialchars($service['description'])); ?></p>
                            <div class="border-t pt-4 flex justify-between items-center">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Chỉ từ</p>
                                    <span class="text-3xl font-bold text-blue-600">
                                        <?php echo number_format($service['price'], 0, ',', '.'); ?>đ
                                    </span>
                                </div>
                                <a href="index.php?page=error_form&service_id=<?php echo $service['id']; ?>"
                                   class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-full hover:from-blue-700 hover:to-blue-800 transition flex items-center space-x-2 shadow-md">
                                    <span>Chọn ngay</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-20">
                    <div class="bg-white rounded-2xl shadow-lg p-12 max-w-md mx-auto">
                        <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
                        <p class="text-gray-600 text-xl">Hiện chưa có dịch vụ nào</p>
                        <p class="text-gray-500 mt-2">Vui lòng quay lại sau</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="mt-16 bg-white rounded-2xl shadow-xl p-8 text-center">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Cần tư vấn thêm?</h3>
            <p class="text-gray-600 mb-6">Liên hệ với chúng tôi để được hỗ trợ và tư vấn miễn phí</p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="tel:0123456789" class="inline-flex items-center bg-green-600 text-white px-6 py-3 rounded-full hover:bg-green-700 transition shadow-md">
                    <i class="fas fa-phone mr-2"></i>
                    <span>0123 456 789</span>
                </a>
                <a href="mailto:support@servicefix.vn" class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700 transition shadow-md">
                    <i class="fas fa-envelope mr-2"></i>
                    <span>Email chúng tôi</span>
                </a>
            </div>
        </div>
    </main>

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
                        <p><i class="fas fa-envelope mr-2 text-blue-500"></i> support@servicefix.vn</p>
                        <p><i class="fas fa-map-marker-alt mr-2 text-blue-500"></i> 123 Đường ABC, TP.HCM</p>
                    </div>
                </div>
                <div>
                    <h4 class="text-lg font-bold text-white mb-4">Liên kết</h4>
                    <div class="space-y-2">
                        <a href="index.php" class="block hover:text-blue-400 transition">Trang chủ</a>
                        <a href="index.php?page=services" class="block hover:text-blue-400 transition">Dịch vụ</a>
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
