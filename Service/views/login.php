<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin - ServiceFix Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gradient-to-br from-blue-600 to-blue-800 min-h-screen flex items-center justify-center">
    <div class="absolute top-4 left-4">
        <a href="index.php" class="inline-flex items-center text-white hover:text-blue-200 transition">
            <i class="fas fa-arrow-left mr-2"></i>
            <span>Quay lại trang chủ</span>
        </a>
    </div>

    <div class="container mx-auto px-4 py-12">
        <div class="max-w-md mx-auto">
            <div class="text-center mb-8">
                <div class="inline-block bg-white p-4 rounded-full mb-4 shadow-lg">
                    <i class="fas fa-shield-alt text-blue-600 text-5xl"></i>
                </div>
                <h1 class="text-white text-4xl font-bold mb-2">ServiceFix Manager</h1>
                <p class="text-blue-100">Đăng nhập khu vực quản trị</p>
            </div>

            <?php if (isset($message)): ?>
                <div class="mb-6 p-5 rounded-2xl shadow-lg flex items-start gap-4 <?php echo $success ? 'bg-green-50 border-2 border-green-500' : 'bg-red-50 border-2 border-red-500'; ?>">
                    <div class="<?php echo $success ? 'bg-green-500' : 'bg-red-500'; ?> rounded-full w-10 h-10 flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-<?php echo $success ? 'check' : 'exclamation-triangle'; ?> text-white"></i>
                    </div>
                    <p class="<?php echo $success ? 'text-green-700' : 'text-red-700'; ?> font-semibold">
                        <?php echo htmlspecialchars($message); ?>
                    </p>
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-2xl shadow-2xl p-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Đăng nhập Admin</h2>

                <form method="POST" action="" class="space-y-6">
                    <div>
                        <label class="flex items-center text-gray-700 font-semibold mb-3">
                            <i class="fas fa-user mr-2 text-blue-600"></i>
                            Tên đăng nhập
                        </label>
                        <input type="text" name="username" required autofocus
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition"
                               placeholder="Nhập tên đăng nhập">
                    </div>

                    <div>
                        <label class="flex items-center text-gray-700 font-semibold mb-3">
                            <i class="fas fa-lock mr-2 text-blue-600"></i>
                            Mật khẩu
                        </label>
                        <input type="password" name="password" required
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 transition"
                               placeholder="Nhập mật khẩu">
                    </div>

                    <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 rounded-full font-bold hover:from-blue-700 hover:to-blue-800 transition shadow-lg flex items-center justify-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        <span>Đăng nhập</span>
                    </button>
                </form>

                <div class="mt-6 p-4 bg-blue-50 rounded-xl border border-blue-200">
                    <p class="text-sm text-blue-800 font-semibold mb-2 flex items-center">
                        <i class="fas fa-info-circle mr-2"></i>
                        Tài khoản mặc định
                    </p>
                    <div class="text-sm text-blue-700 space-y-1">
                        <p><span class="font-mono bg-white px-2 py-1 rounded">admin</span> / <span class="font-mono bg-white px-2 py-1 rounded">password</span></p>
                    </div>
                </div>
            </div>

            <div class="mt-6 text-center">
                <a href="index.php?page=services" class="text-white hover:text-blue-200 transition inline-flex items-center">
                    <i class="fas fa-tools mr-2"></i>
                    <span>Xem dịch vụ</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
