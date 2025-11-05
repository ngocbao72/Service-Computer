<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý yêu cầu - Admin</title>
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
                        <p class="text-blue-100 text-sm">Quản lý yêu cầu sửa chữa</p>
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
            <h2 class="text-4xl font-bold text-gray-800 mb-2">Quản lý yêu cầu sửa chữa</h2>
            <p class="text-gray-600">Xem và xử lý tất cả yêu cầu từ khách hàng</p>
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

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-gradient-to-br from-gray-500 to-gray-600 text-white p-5 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-2">
                    <i class="fas fa-clipboard-list text-3xl opacity-80"></i>
                    <span class="text-3xl font-bold">
                        <?php echo count($issues); ?>
                    </span>
                </div>
                <p class="text-sm font-medium opacity-90">Tổng yêu cầu</p>
            </div>

            <div class="bg-gradient-to-br from-orange-500 to-orange-600 text-white p-5 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-2">
                    <i class="fas fa-clock text-3xl opacity-80"></i>
                    <span class="text-3xl font-bold">
                        <?php echo count(array_filter($issues, function($i) { return $i['status'] == 'pending'; })); ?>
                    </span>
                </div>
                <p class="text-sm font-medium opacity-90">Chờ xử lý</p>
            </div>

            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 text-white p-5 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-2">
                    <i class="fas fa-spinner text-3xl opacity-80"></i>
                    <span class="text-3xl font-bold">
                        <?php echo count(array_filter($issues, function($i) { return $i['status'] == 'in_progress'; })); ?>
                    </span>
                </div>
                <p class="text-sm font-medium opacity-90">Đang xử lý</p>
            </div>

            <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-5 rounded-xl shadow-lg">
                <div class="flex items-center justify-between mb-2">
                    <i class="fas fa-check-circle text-3xl opacity-80"></i>
                    <span class="text-3xl font-bold">
                        <?php echo count(array_filter($issues, function($i) { return $i['status'] == 'done'; })); ?>
                    </span>
                </div>
                <p class="text-sm font-medium opacity-90">Hoàn thành</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">Danh sách yêu cầu</h3>
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
                                    <i class="fas fa-file-alt mr-1"></i>Mô tả
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
                                        <div>
                                            <p class="font-medium text-gray-800"><?php echo htmlspecialchars($issue['service_name']); ?></p>
                                            <p class="text-sm text-blue-600 font-semibold">
                                                <?php echo number_format($issue['service_price'], 0, ',', '.'); ?>đ
                                            </p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <p class="text-gray-600 text-sm">
                                            <?php
                                            $desc = htmlspecialchars($issue['description']);
                                            echo strlen($desc) > 60 ? substr($desc, 0, 60) . '...' : $desc;
                                            ?>
                                        </p>
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
                                    <td class="px-4 py-3 text-gray-600 text-sm">
                                        <?php echo date('d/m/Y H:i', strtotime($issue['created_at'])); ?>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex gap-2">
                                            <a href="index.php?page=admin_issue_detail&id=<?php echo $issue['id']; ?>"
                                               class="inline-flex items-center bg-blue-100 text-blue-600 px-3 py-1.5 rounded-full hover:bg-blue-200 transition font-semibold text-sm">
                                                <i class="fas fa-eye mr-1"></i>
                                                Chi tiết
                                            </a>
                                            <form method="POST" action="" class="inline"
                                                  onsubmit="return confirm('Bạn có chắc muốn xóa yêu cầu này?');">
                                                <input type="hidden" name="delete_id" value="<?php echo $issue['id']; ?>">
                                                <button type="submit" class="inline-flex items-center bg-red-100 text-red-600 px-3 py-1.5 rounded-full hover:bg-red-200 transition font-semibold text-sm">
                                                    <i class="fas fa-trash mr-1"></i>
                                                    Xóa
                                                </button>
                                            </form>
                                        </div>
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
