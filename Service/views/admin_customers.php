<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý khách hàng - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-xl sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-user-shield text-3xl"></i>
                    <div>
                        <h1 class="text-2xl font-bold">Service Manager</h1>
                        <p class="text-blue-100 text-sm">Quản lý khách hàng</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="index.php?page=admin" class="bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full hover:bg-white/20 transition">
                        <i class="fas fa-home mr-2"></i>Dashboard
                    </a>
                    <div class="bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full">
                        <i class="fas fa-user mr-2"></i>
                        <span class="font-semibold"><?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                    </div>
                    <a href="index.php?page=logout" class="bg-red-500 px-5 py-2 rounded-full hover:bg-red-600 transition shadow-lg flex items-center">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Đăng xuất
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <h2 class="text-4xl font-bold text-gray-800 mb-2">Quản lý khách hàng</h2>
            <p class="text-gray-600">Xem và quản lý thông tin khách hàng</p>
        </div>

        <?php if (isset($message)): ?>
            <div class="mb-6 p-5 rounded-2xl shadow-lg flex items-start gap-4 <?php echo $success ? 'bg-green-50 border-2 border-green-500' : 'bg-red-50 border-2 border-red-500'; ?>">
                <div class="<?php echo $success ? 'bg-green-500' : 'bg-red-500'; ?> rounded-full w-12 h-12 flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-<?php echo $success ? 'check' : 'exclamation'; ?> text-white text-xl"></i>
                </div>
                <p class="<?php echo $success ? 'text-green-700' : 'text-red-700'; ?> font-semibold text-lg">
                    <?php echo htmlspecialchars($message); ?>
                </p>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-2xl shadow-xl p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">Danh sách khách hàng</h3>
                    <p class="text-gray-600">Tất cả khách hàng đã sử dụng dịch vụ</p>
                </div>
                <div class="bg-purple-100 text-purple-600 px-4 py-2 rounded-full font-semibold">
                    <i class="fas fa-users mr-2"></i>
                    <?php echo count($customers); ?> khách hàng
                </div>
            </div>

            <?php if (!empty($customers)): ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-gray-100 to-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">
                                    <i class="fas fa-hashtag mr-1"></i>ID
                                </th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">
                                    <i class="fas fa-user mr-1"></i>Họ và tên
                                </th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">
                                    <i class="fas fa-phone mr-1"></i>Số điện thoại
                                </th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">
                                    <i class="fas fa-envelope mr-1"></i>Email
                                </th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">
                                    <i class="fas fa-calendar mr-1"></i>Ngày tạo
                                </th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">
                                    <i class="fas fa-tools mr-1"></i>Hành động
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($customers as $customer): ?>
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-4 py-3">
                                        <span class="bg-gray-100 px-3 py-1 rounded-full font-semibold text-gray-700">
                                            #<?php echo $customer['id']; ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 font-semibold text-gray-800">
                                        <div class="flex items-center">
                                            <div class="bg-purple-100 text-purple-600 w-10 h-10 rounded-full flex items-center justify-center mr-3 font-bold">
                                                <?php echo strtoupper(substr($customer['name'], 0, 1)); ?>
                                            </div>
                                            <?php echo htmlspecialchars($customer['name']); ?>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <a href="tel:<?php echo htmlspecialchars($customer['phone']); ?>" class="text-blue-600 hover:underline">
                                            <?php echo htmlspecialchars($customer['phone']); ?>
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">
                                        <?php if (!empty($customer['email'])): ?>
                                            <a href="mailto:<?php echo htmlspecialchars($customer['email']); ?>" class="text-blue-600 hover:underline">
                                                <?php echo htmlspecialchars($customer['email']); ?>
                                            </a>
                                        <?php else: ?>
                                            <span class="text-gray-400 italic">Không có</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">
                                        <?php echo date('d/m/Y H:i', strtotime($customer['created_at'])); ?>
                                    </td>
                                    <td class="px-4 py-3">
                                        <form method="POST" action="" class="inline"
                                              onsubmit="return confirm('Bạn có chắc muốn xóa khách hàng này?\nTất cả yêu cầu liên quan cũng sẽ bị xóa.');">
                                            <input type="hidden" name="delete_id" value="<?php echo $customer['id']; ?>">
                                            <button type="submit" class="inline-flex items-center bg-red-100 text-red-600 px-4 py-2 rounded-full hover:bg-red-200 transition font-semibold">
                                                <i class="fas fa-trash mr-1"></i>Xóa
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-16">
                    <div class="bg-gray-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-gray-400 text-5xl"></i>
                    </div>
                    <p class="text-gray-600 text-xl font-semibold">Chưa có khách hàng nào</p>
                    <p class="text-gray-500 mt-2">Khách hàng sẽ tự động được thêm khi gửi yêu cầu</p>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
