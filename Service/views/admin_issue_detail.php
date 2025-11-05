<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết yêu cầu #<?php echo isset($issue) ? $issue['id'] : ''; ?> - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-user-shield text-2xl"></i>
                    <div>
                        <h1 class="text-xl font-bold">Service Manager</h1>
                        <p class="text-blue-100 text-xs">Chi tiết yêu cầu</p>
                    </div>
                </div>
                <div class="flex items-center space-x-3 text-sm">
                    <a href="index.php?page=admin" class="bg-white/10 backdrop-blur-sm px-3 py-1.5 rounded-full hover:bg-white/20 transition">
                        <i class="fas fa-home mr-1"></i>Dashboard
                    </a>
                    <div class="bg-white/10 backdrop-blur-sm px-3 py-1.5 rounded-full">
                        <i class="fas fa-user mr-1"></i>
                        <span class="font-medium"><?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                    </div>
                    <a href="index.php?page=logout" class="bg-red-500 px-3 py-1.5 rounded-full hover:bg-red-600 transition">
                        <i class="fas fa-sign-out-alt mr-1"></i>Đăng xuất
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 py-6">
        <div class="mb-4">
            <a href="index.php?page=admin" class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium">
                <i class="fas fa-arrow-left mr-1"></i>
                Quay lại Dashboard
            </a>
        </div>

        <?php if (isset($issue) && $issue): ?>
            <div class="grid lg:grid-cols-3 gap-4">
                <div class="lg:col-span-2 space-y-4">
                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-bold text-gray-800 flex items-center">
                                <i class="fas fa-clipboard-list mr-2 text-blue-600 text-lg"></i>
                                Yêu cầu #<?php echo $issue['id']; ?>
                            </h2>
                            <span class="px-3 py-1 rounded-full text-sm font-semibold <?php
                                echo $issue['status'] == 'done' ? 'bg-green-100 text-green-700' :
                                    ($issue['status'] == 'in_progress' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-700');
                            ?>">
                                <?php
                                $status_text = [
                                    'pending' => 'Chờ xử lý',
                                    'in_progress' => 'Đang xử lý',
                                    'done' => 'Hoàn thành'
                                ];
                                echo $status_text[$issue['status']];
                                ?>
                            </span>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-cog mr-1.5 text-blue-600"></i>
                                Dịch vụ được chọn
                            </h3>
                            <div class="bg-blue-50 p-3 rounded-lg border border-blue-200">
                                <p class="font-bold text-gray-800 mb-1"><?php echo htmlspecialchars($issue['service_name']); ?></p>
                                <p class="text-blue-600 font-semibold">
                                    <i class="fas fa-tag mr-1 text-sm"></i>
                                    <?php echo number_format($issue['service_price'], 0, ',', '.'); ?>đ
                                </p>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h3 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
                                <i class="fas fa-file-alt mr-1.5 text-blue-600"></i>
                                Mô tả vấn đề
                            </h3>
                            <div class="bg-gray-50 p-3 rounded-lg border border-gray-200">
                                <p class="text-gray-800 text-sm leading-relaxed whitespace-pre-line"><?php echo htmlspecialchars($issue['description']); ?></p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-gray-600 text-xs mb-1">
                                    <i class="fas fa-calendar-plus mr-1"></i>Ngày gửi
                                </p>
                                <p class="text-gray-800 font-semibold">
                                    <?php echo date('d/m/Y H:i', strtotime($issue['created_at'])); ?>
                                </p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-gray-600 text-xs mb-1">
                                    <i class="fas fa-sync-alt mr-1"></i>Cập nhật lần cuối
                                </p>
                                <p class="text-gray-800 font-semibold">
                                    <?php echo date('d/m/Y H:i', strtotime($issue['updated_at'])); ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-5">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-tasks mr-2 text-blue-600"></i>
                            Cập nhật trạng thái
                        </h3>

                        <?php if (isset($message)): ?>
                            <div class="mb-4 p-3 rounded-lg flex items-start gap-3 <?php echo $success ? 'bg-green-50 border border-green-300' : 'bg-red-50 border border-red-300'; ?>">
                                <div class="<?php echo $success ? 'bg-green-500' : 'bg-red-500'; ?> rounded-full w-8 h-8 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-<?php echo $success ? 'check' : 'exclamation'; ?> text-white text-sm"></i>
                                </div>
                                <p class="<?php echo $success ? 'text-green-700' : 'text-red-700'; ?> font-medium text-sm">
                                    <?php echo htmlspecialchars($message); ?>
                                </p>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <input type="hidden" name="issue_id" value="<?php echo $issue['id']; ?>">

                            <div class="mb-4">
                                <label class="block text-gray-700 font-medium mb-2 text-sm">Chọn trạng thái mới</label>
                                <select name="status" required
                                        class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-blue-500 transition font-medium">
                                    <option value="pending" <?php echo $issue['status'] == 'pending' ? 'selected' : ''; ?>>Chờ xử lý</option>
                                    <option value="in_progress" <?php echo $issue['status'] == 'in_progress' ? 'selected' : ''; ?>>Đang xử lý</option>
                                    <option value="done" <?php echo $issue['status'] == 'done' ? 'selected' : ''; ?>>Hoàn thành</option>
                                </select>
                            </div>

                            <div class="flex gap-2">
                                <button type="submit"
                                        class="flex-1 bg-blue-600 text-white px-4 py-2.5 rounded-lg font-medium hover:bg-blue-700 transition flex items-center justify-center text-sm">
                                    <i class="fas fa-save mr-1.5"></i>
                                    Cập nhật trạng thái
                                </button>
                                <button type="submit" name="delete_id" value="<?php echo $issue['id']; ?>"
                                        onclick="return confirm('Bạn có chắc muốn xóa yêu cầu này?');"
                                        class="bg-red-100 text-red-600 px-4 py-2.5 rounded-lg font-medium hover:bg-red-200 transition flex items-center text-sm">
                                    <i class="fas fa-trash mr-1.5"></i>
                                    Xóa
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow p-5 sticky top-20">
                        <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-user mr-2 text-blue-600"></i>
                            Thông tin khách hàng
                        </h3>

                        <div class="text-center mb-4">
                            <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3 text-2xl font-bold shadow">
                                <?php echo strtoupper(substr($issue['customer_name'], 0, 1)); ?>
                            </div>
                            <h4 class="text-lg font-bold text-gray-800"><?php echo htmlspecialchars($issue['customer_name']); ?></h4>
                            <p class="text-gray-600 text-sm">Khách hàng #<?php echo $issue['customer_id']; ?></p>
                        </div>

                        <div class="space-y-3 mb-4">
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-gray-600 text-xs mb-1.5 flex items-center">
                                    <i class="fas fa-phone mr-1.5 text-blue-600"></i>
                                    Số điện thoại
                                </p>
                                <a href="tel:<?php echo htmlspecialchars($issue['customer_phone']); ?>"
                                   class="text-blue-600 hover:text-blue-800 font-semibold text-sm">
                                    <?php echo htmlspecialchars($issue['customer_phone']); ?>
                                </a>
                            </div>

                            <?php if (!empty($issue['customer_email'])): ?>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <p class="text-gray-600 text-xs mb-1.5 flex items-center">
                                        <i class="fas fa-envelope mr-1.5 text-blue-600"></i>
                                        Email
                                    </p>
                                    <a href="mailto:<?php echo htmlspecialchars($issue['customer_email']); ?>"
                                       class="text-blue-600 hover:text-blue-800 font-semibold text-sm break-all">
                                        <?php echo htmlspecialchars($issue['customer_email']); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="space-y-2">
                            <a href="tel:<?php echo htmlspecialchars($issue['customer_phone']); ?>"
                               class="w-full bg-green-600 text-white px-4 py-2.5 rounded-lg font-medium hover:bg-green-700 transition flex items-center justify-center text-sm">
                                <i class="fas fa-phone mr-1.5"></i>
                                Gọi điện ngay
                            </a>
                            <?php if (!empty($issue['customer_email'])): ?>
                                <a href="mailto:<?php echo htmlspecialchars($issue['customer_email']); ?>"
                                   class="w-full bg-blue-600 text-white px-4 py-2.5 rounded-lg font-medium hover:bg-blue-700 transition flex items-center justify-center text-sm">
                                    <i class="fas fa-envelope mr-1.5"></i>
                                    Gửi email
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-lg shadow p-8 text-center">
                <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Không tìm thấy yêu cầu</h3>
                <p class="text-gray-600 mb-6 text-sm">Yêu cầu này không tồn tại hoặc đã bị xóa</p>
                <a href="index.php?page=admin" class="inline-flex items-center bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition font-medium text-sm">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Quay lại Dashboard
                </a>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>
