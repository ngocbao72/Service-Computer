<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gửi yêu cầu sửa chữa - Service Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <i class="fas fa-tools text-blue-600 text-2xl"></i>
                <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">Service Manager</h1>
            </div>
            <div class="space-x-6">
                <a href="index.php" class="text-gray-700 hover:text-blue-600 transition font-medium">Trang chủ</a>
                <a href="index.php?page=services" class="text-gray-700 hover:text-blue-600 transition font-medium">Dịch vụ</a>
                <a href="index.php?page=login" class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition">Đăng nhập</a>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-12">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-8">
                <div class="inline-block bg-blue-100 p-4 rounded-full mb-4">
                    <i class="fas fa-clipboard-list text-blue-600 text-4xl"></i>
                </div>
                <h2 class="text-4xl font-bold text-gray-800 mb-3">Gửi yêu cầu sửa chữa</h2>
                <p class="text-gray-600">Điền thông tin và mô tả chi tiết vấn đề của bạn</p>
            </div>

            <?php if (isset($message)): ?>
                <div class="mb-6 p-6 rounded-2xl shadow-lg flex items-start gap-4 <?php echo $success ? 'bg-green-50 border-2 border-green-500' : 'bg-red-50 border-2 border-red-500'; ?>">
                    <div class="<?php echo $success ? 'bg-green-500' : 'bg-red-500'; ?> rounded-full w-12 h-12 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-<?php echo $success ? 'check' : 'exclamation'; ?> text-white text-xl"></i>
                    </div>
                    <div class="flex-1">
                        <p class="<?php echo $success ? 'text-green-700' : 'text-red-700'; ?> font-semibold text-lg">
                            <?php echo htmlspecialchars($message); ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!isset($success) || !$success): ?>
                <div class="bg-white rounded-2xl shadow-xl p-8">
                    <form method="POST" action="">
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="flex items-center text-gray-700 font-semibold mb-3">
                                    <i class="fas fa-user mr-2 text-blue-600"></i>
                                    Họ và tên <span class="text-red-500 ml-1">*</span>
                                </label>
                                <input type="text" name="name" required
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition"
                                       placeholder="Nguyễn Văn A">
                            </div>

                            <div>
                                <label class="flex items-center text-gray-700 font-semibold mb-3">
                                    <i class="fas fa-phone mr-2 text-blue-600"></i>
                                    Số điện thoại <span class="text-red-500 ml-1">*</span>
                                </label>
                                <input type="tel" name="phone" required pattern="[0-9]{10,11}"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition"
                                       placeholder="0123456789">
                            </div>
                        </div>

                        <div class="mb-6">
                            <label class="flex items-center text-gray-700 font-semibold mb-3">
                                <i class="fas fa-envelope mr-2 text-blue-600"></i>
                                Email <span class="text-gray-400 text-sm">(không bắt buộc)</span>
                            </label>
                            <input type="email" name="email"
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition"
                                   placeholder="email@example.com">
                        </div>

                        <div class="mb-6">
                            <label class="flex items-center text-gray-700 font-semibold mb-3">
                                <i class="fas fa-cog mr-2 text-blue-600"></i>
                                Chọn dịch vụ <span class="text-red-500 ml-1">*</span>
                            </label>
                            <select name="service_id" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition bg-white">
                                <option value="">-- Chọn dịch vụ cần sử dụng --</option>
                                <?php foreach ($services as $service): ?>
                                    <option value="<?php echo $service['id']; ?>"
                                            <?php echo (isset($_GET['service_id']) && $_GET['service_id'] == $service['id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($service['name']); ?> - <?php echo number_format($service['price'], 0, ',', '.'); ?>đ
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-8">
                            <label class="flex items-center text-gray-700 font-semibold mb-3">
                                <i class="fas fa-file-alt mr-2 text-blue-600"></i>
                                Mô tả lỗi đang gặp phải <span class="text-red-500 ml-1">*</span>
                            </label>
                            <textarea name="description" required rows="6"
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition"
                                      placeholder="Ví dụ: Máy không khởi động được, màn hình bị đen, không lên hình..."></textarea>
                            <p class="text-gray-500 text-sm mt-2">
                                <i class="fas fa-info-circle mr-1"></i>
                                Mô tả càng chi tiết càng giúp chúng tôi hỗ trợ bạn tốt hơn
                            </p>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4">
                            <button type="submit"
                                    class="flex-1 bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-4 rounded-full font-semibold hover:from-blue-700 hover:to-blue-800 transition shadow-lg flex items-center justify-center">
                                <i class="fas fa-paper-plane mr-2"></i>
                                <span>Gửi yêu cầu ngay</span>
                            </button>
                            <a href="index.php?page=services"
                               class="flex-1 bg-gray-200 text-gray-700 px-8 py-4 rounded-full font-semibold text-center hover:bg-gray-300 transition flex items-center justify-center">
                                <i class="fas fa-arrow-left mr-2"></i>
                                <span>Quay lại</span>
                            </a>
                        </div>
                    </form>
                </div>
            <?php else: ?>
                <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
                    <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-check text-green-600 text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Gửi yêu cầu thành công!</h3>
                    <p class="text-gray-600 mb-8">Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất</p>
                    <a href="index.php?page=services" class="inline-flex items-center bg-blue-600 text-white px-8 py-4 rounded-full hover:bg-blue-700 transition shadow-lg">
                        <i class="fas fa-arrow-left mr-2"></i>
                        <span>Quay lại danh sách dịch vụ</span>
                    </a>
                </div>
            <?php endif; ?>
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
                <p class="text-gray-500">&copy; 2025 ServiceFix Manager. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
