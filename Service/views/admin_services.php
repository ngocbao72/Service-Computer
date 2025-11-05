<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý dịch vụ - Admin</title>
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
                        <p class="text-blue-100 text-sm">Quản lý dịch vụ</p>
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
            <h2 class="text-4xl font-bold text-gray-800 mb-2">Quản lý dịch vụ</h2>
            <p class="text-gray-600">Thêm, sửa, xóa các gói dịch vụ sửa chữa</p>
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

        <div class="bg-white rounded-2xl shadow-xl p-8 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-800">
                    <i class="fas fa-<?php echo isset($_GET['edit_id']) ? 'edit' : 'plus-circle'; ?> mr-2 text-blue-600"></i>
                    <?php echo isset($_GET['edit_id']) ? 'Chỉnh sửa dịch vụ' : 'Thêm dịch vụ mới'; ?>
                </h3>
                <?php if (isset($_GET['edit_id'])): ?>
                    <a href="index.php?page=admin_services" class="bg-gray-200 px-5 py-2 rounded-full hover:bg-gray-300 transition">
                        <i class="fas fa-times mr-2"></i>Hủy
                    </a>
                <?php endif; ?>
            </div>

            <form method="POST" action="">
                <?php if (isset($_GET['edit_id']) && isset($edit_service)): ?>
                    <input type="hidden" name="edit_id" value="<?php echo $edit_service['id']; ?>">
                <?php endif; ?>

                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="flex items-center text-gray-700 font-semibold mb-3">
                            <i class="fas fa-tag mr-2 text-blue-600"></i>
                            Tên dịch vụ <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input type="text" name="name" required
                               value="<?php echo isset($edit_service) ? htmlspecialchars($edit_service['name']) : ''; ?>"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition"
                               placeholder="Ví dụ: Sửa chữa laptop cơ bản">
                    </div>

                    <div>
                        <label class="flex items-center text-gray-700 font-semibold mb-3">
                            <i class="fas fa-dollar-sign mr-2 text-blue-600"></i>
                            Giá dịch vụ <span class="text-red-500 ml-1">*</span>
                        </label>
                        <input type="number" name="price" required min="0" step="1000"
                               value="<?php echo isset($edit_service) ? $edit_service['price'] : ''; ?>"
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition"
                               placeholder="200000">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="flex items-center text-gray-700 font-semibold mb-3">
                        <i class="fas fa-file-alt mr-2 text-blue-600"></i>
                        Mô tả chi tiết
                    </label>
                    <textarea name="description" rows="4"
                              class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition"
                              placeholder="Mô tả chi tiết về dịch vụ..."><?php echo isset($edit_service) ? htmlspecialchars($edit_service['description']) : ''; ?></textarea>
                </div>

                <button type="submit"
                        class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-4 rounded-full font-bold hover:from-blue-700 hover:to-blue-800 transition shadow-lg flex items-center">
                    <i class="fas fa-<?php echo isset($_GET['edit_id']) ? 'save' : 'plus'; ?> mr-2"></i>
                    <?php echo isset($_GET['edit_id']) ? 'Cập nhật dịch vụ' : 'Thêm dịch vụ'; ?>
                </button>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-xl p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">Danh sách dịch vụ</h3>
                    <p class="text-gray-600">Tất cả các gói dịch vụ hiện có</p>
                </div>
                <div class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full font-semibold">
                    <i class="fas fa-list mr-2"></i>
                    <?php echo count($services); ?> dịch vụ
                </div>
            </div>

            <?php if (!empty($services)): ?>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-gray-100 to-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">
                                    <i class="fas fa-hashtag mr-1"></i>ID
                                </th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">
                                    <i class="fas fa-tag mr-1"></i>Tên dịch vụ
                                </th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">
                                    <i class="fas fa-money-bill mr-1"></i>Giá
                                </th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">
                                    <i class="fas fa-file-alt mr-1"></i>Mô tả
                                </th>
                                <th class="px-4 py-3 text-left font-bold text-gray-700">
                                    <i class="fas fa-tools mr-1"></i>Hành động
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($services as $service): ?>
                                <tr class="border-b hover:bg-gray-50 transition">
                                    <td class="px-4 py-3">
                                        <span class="bg-gray-100 px-3 py-1 rounded-full font-semibold text-gray-700">
                                            #<?php echo $service['id']; ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 font-semibold text-gray-800">
                                        <?php echo htmlspecialchars($service['name']); ?>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="text-blue-600 font-bold">
                                            <?php echo number_format($service['price'], 0, ',', '.'); ?>đ
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">
                                        <?php
                                        $desc = htmlspecialchars($service['description']);
                                        echo strlen($desc) > 50 ? substr($desc, 0, 50) . '...' : $desc;
                                        ?>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex gap-2">
                                            <a href="index.php?page=admin_services&edit_id=<?php echo $service['id']; ?>"
                                               class="inline-flex items-center bg-blue-100 text-blue-600 px-4 py-2 rounded-full hover:bg-blue-200 transition font-semibold">
                                                <i class="fas fa-edit mr-1"></i>Sửa
                                            </a>
                                            <form method="POST" action="" class="inline"
                                                  onsubmit="return confirm('Bạn có chắc muốn xóa dịch vụ này?');">
                                                <input type="hidden" name="delete_id" value="<?php echo $service['id']; ?>">
                                                <button type="submit" class="inline-flex items-center bg-red-100 text-red-600 px-4 py-2 rounded-full hover:bg-red-200 transition font-semibold">
                                                    <i class="fas fa-trash mr-1"></i>Xóa
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
                    <p class="text-gray-600 text-xl font-semibold">Chưa có dịch vụ nào</p>
                    <p class="text-gray-500 mt-2">Thêm dịch vụ đầu tiên ở form bên trên</p>
                </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>
