<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Service Manager</title>
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
                        <p class="text-blue-100 text-sm">Khu vực quản trị</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
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
            <h2 class="text-4xl font-bold text-gray-800 mb-2">Bảng điều khiển</h2>
            <p class="text-gray-600">Quản lý hệ thống Service Manager</p>
        </div>

        <?php if (isset($message)): ?>
            <div class="mb-6 p-5 rounded-2xl shadow-lg flex items-start gap-4 <?php echo $success ? 'bg-green-50 border-2 border-green-500' : 'bg-red-50 border-2 border-red-500'; ?>">
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

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 p-3 rounded-full">
                        <i class="fas fa-cog text-3xl"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-2">Quản lý dịch vụ</h3>
                <p class="text-blue-100 mb-4">Thêm, sửa, xóa các gói dịch vụ</p>
                <a href="index.php?page=admin_services" class="inline-flex items-center bg-white text-blue-600 px-5 py-2 rounded-full hover:bg-blue-50 transition font-semibold shadow-md">
                    <span>Quản lý</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 p-3 rounded-full">
                        <i class="fas fa-clipboard-list text-3xl"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-2">Yêu cầu sửa chữa</h3>
                <p class="text-green-100 mb-4">Xem và xử lý yêu cầu từ khách hàng</p>
                <a href="index.php?page=admin_issues" class="inline-flex items-center bg-white text-green-600 px-5 py-2 rounded-full hover:bg-green-50 transition font-semibold shadow-md">
                    <span>Xem yêu cầu</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 p-3 rounded-full">
                        <i class="fas fa-users text-3xl"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-2">Khách hàng</h3>
                <p class="text-purple-100 mb-4">Quản lý thông tin khách hàng</p>
                <a href="index.php?page=admin_customers" class="inline-flex items-center bg-white text-purple-600 px-5 py-2 rounded-full hover:bg-purple-50 transition font-semibold shadow-md">
                    <span>Quản lý</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-white/20 p-3 rounded-full">
                        <i class="fas fa-home text-3xl"></i>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-2">Trang khách hàng</h3>
                <p class="text-orange-100 mb-4">Xem trang web khách hàng</p>
                <a href="index.php" class="inline-flex items-center bg-white text-orange-600 px-5 py-2 rounded-full hover:bg-orange-50 transition font-semibold shadow-md">
                    <span>Xem trang chủ</span>
                    <i class="fas fa-external-link-alt ml-2"></i>
                </a>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">Danh sách yêu cầu sửa chữa</h3>
                    <p class="text-gray-600">Quản lý và cập nhật trạng thái yêu cầu</p>
                </div>
                <div class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full font-semibold">
                    <i class="fas fa-list mr-2"></i>
                    <?php echo count($issues); ?> yêu cầu
                </div>
            </div>

            <?php if (!empty($issues)): ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-gray-100 to-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">
                                    <i class="fas fa-hashtag mr-1"></i>ID
                                </th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">
                                    <i class="fas fa-user mr-1"></i>Khách hàng
                                </th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">
                                    <i class="fas fa-cog mr-1"></i>Dịch vụ
                                </th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">
                                    <i class="fas fa-tasks mr-1"></i>Trạng thái
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
                            <?php foreach ($issues as $issue): ?>
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-4 py-3">
                                        <span class="bg-gray-100 px-3 py-1 rounded-full font-semibold text-gray-700">
                                            #<?php echo $issue['id']; ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div>
                                            <p class="font-semibold text-gray-800"><?php echo htmlspecialchars($issue['customer_name']); ?></p>
                                            <p class="text-sm text-gray-600">
                                                <i class="fas fa-phone mr-1"></i>
                                                <?php echo htmlspecialchars($issue['customer_phone']); ?>
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="text-gray-800"><?php echo htmlspecialchars($issue['service_name']); ?></span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <form method="POST" action="" class="inline">
                                            <input type="hidden" name="issue_id" value="<?php echo $issue['id']; ?>">
                                            <select name="status" onchange="this.form.submit()"
                                                    class="px-3 py-2 border-2 rounded-xl font-semibold cursor-pointer transition <?php
                                                        echo $issue['status'] == 'done' ? 'bg-green-50 text-green-700 border-green-300' :
                                                            ($issue['status'] == 'in_progress' ? 'bg-yellow-50 text-yellow-700 border-yellow-300' : 'bg-gray-50 text-gray-700 border-gray-300');
                                                    ?>">
                                                <option value="pending" <?php echo $issue['status'] == 'pending' ? 'selected' : ''; ?>>Chờ xử lý</option>
                                                <option value="in_progress" <?php echo $issue['status'] == 'in_progress' ? 'selected' : ''; ?>>Đang xử lý</option>
                                                <option value="done" <?php echo $issue['status'] == 'done' ? 'selected' : ''; ?>>Hoàn thành</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">
                                        <?php echo date('d/m/Y H:i', strtotime($issue['created_at'])); ?>
                                    </td>
                                    <td class="px-4 py-3">
                                        <a href="index.php?page=admin_issue_detail&id=<?php echo $issue['id']; ?>"
                                           class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                                            <i class="fas fa-eye mr-1"></i>
                                            Chi tiết
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-16">
                    <div class="bg-gray-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-inbox text-gray-400 text-5xl"></i>
                    </div>
                    <p class="text-gray-600 text-xl font-semibold">Chưa có yêu cầu nào</p>
                    <p class="text-gray-500 mt-2">Các yêu cầu từ khách hàng sẽ hiển thị ở đây</p>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
