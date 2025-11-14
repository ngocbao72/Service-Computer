<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Giới thiệu - ServiceFix</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    html {
      scroll-behavior: smooth;
    }
    .fade-in {
      animation: fadeIn 1s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">

  <!-- Header -->
  <header class="fixed top-0 left-0 w-full bg-white/90 backdrop-blur-md shadow-md z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <a href="index.php" class="text-2xl font-bold text-blue-600">Service</a>
      <nav class="space-x-6 font-medium">
        <a href="index.php" class="text-gray-700 hover:text-blue-600">Trang chủ</a>
        <a href="about.php" class="text-gray-700 hover:text-blue-600">Giới thiệu</a>
        <a href="index.php?page=services" class="text-gray-700 hover:text-blue-600">Dịch vụ</a>
        <a href="booking.php" class="text-gray-700 hover:text-blue-600">Đặt lịch</a> 
        <a href="index.php?page=login" class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition">Đăng nhập</a>
      </nav>
    </div>
  </header>


<!-- Phần giới thiệu -->
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

  <!-- Giới thiệu -->
  <section class="max-w-6xl mx-auto px-6 py-16 fade-in">
    <h2 class="text-3xl font-bold text-center text-blue-600 mb-10">Về Chúng Tôi</h2>
    <div class="grid md:grid-cols-2 gap-12 items-center">
      <div>
        <p class="text-gray-700 leading-relaxed mb-4">
          <strong>ServiceFix</strong> được thành lập với mục tiêu mang lại sự tiện lợi tối đa cho khách hàng trong lĩnh vực sửa chữa, bảo trì và nâng cấp máy tính.
        </p>
        <p class="text-gray-700 leading-relaxed mb-4">
          Với đội ngũ kỹ thuật viên nhiều năm kinh nghiệm, ServiceFix luôn đảm bảo mang đến chất lượng dịch vụ hàng đầu cùng thời gian xử lý nhanh chóng.
        </p>
        <p class="text-gray-700 leading-relaxed">
          Chúng tôi tin rằng mỗi thiết bị đều xứng đáng được chăm sóc tốt nhất, giúp bạn yên tâm sử dụng công nghệ mà không lo sự cố.
        </p>
      </div>
      <img src="https://cdn.pixabay.com/photo/2016/06/29/09/38/laptop-1483974_1280.jpg"
           alt="About ServiceFix"
           class="rounded-2xl shadow-lg hover:scale-105 transition duration-500">
    </div>
  </section>

  <!-- Sứ mệnh & Tầm nhìn -->
  <section class="bg-blue-50 py-16 fade-in">
    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-10">
      <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition">
        <h3 class="text-2xl font-bold text-blue-600 mb-4">🎯 Sứ mệnh của chúng tôi</h3>
        <p class="text-gray-700 leading-relaxed">
          Cung cấp dịch vụ sửa chữa máy tính chất lượng, nhanh chóng, giúp khách hàng tiết kiệm thời gian và chi phí tối đa.
        </p>
      </div>
      <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition">
        <h3 class="text-2xl font-bold text-blue-600 mb-4">🌟 Tầm nhìn</h3>
        <p class="text-gray-700 leading-relaxed">
          Trở thành hệ thống sửa chữa máy tính hàng đầu Việt Nam, mang lại niềm tin tuyệt đối và sự hài lòng cho khách hàng.
        </p>
      </div>
    </div>
  </section>

  <!-- Lý do chọn -->
  <section class="max-w-6xl mx-auto px-6 py-16 text-center fade-in">
    <h2 class="text-3xl font-bold text-blue-600 mb-10">Vì sao chọn ServiceFix?</h2>
    <div class="grid md:grid-cols-3 gap-8">
      <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition">
        <div class="text-4xl mb-3">👨‍🔧</div>
        <h4 class="font-semibold text-lg mb-2">Kỹ thuật viên chuyên nghiệp</h4>
        <p class="text-gray-600">Đội ngũ có chứng chỉ và nhiều năm kinh nghiệm, xử lý mọi lỗi phần cứng & phần mềm.</p>
      </div>
      <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition">
        <div class="text-4xl mb-3">⚡</div>
        <h4 class="font-semibold text-lg mb-2">Dịch vụ nhanh chóng</h4>
        <p class="text-gray-600">Tiếp nhận và xử lý trong thời gian ngắn nhất, giúp bạn không bị gián đoạn công việc.</p>
      </div>
      <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition">
        <div class="text-4xl mb-3">💰</div>
        <h4 class="font-semibold text-lg mb-2">Giá cả minh bạch</h4>
        <p class="text-gray-600">Báo giá rõ ràng, không phát sinh chi phí ẩn, luôn ưu tiên quyền lợi khách hàng.</p>
      </div>
    </div>
  </section>

  <!-- Liên hệ nhanh -->
  <section class="bg-gradient-to-r from-blue-600 to-blue-500 text-white py-14 text-center fade-in">
    <h2 class="text-3xl font-bold mb-4">Bạn cần hỗ trợ ngay?</h2>
    <p class="text-lg mb-6">Liên hệ với chúng tôi để được tư vấn và đặt lịch sửa chữa nhanh chóng nhất!</p>
    <div class="flex justify-center gap-6">
      <a href="booking.php" class="bg-green-500 hover:bg-green-600 px-6 py-3 rounded-full text-white font-semibold transition shadow-md">Đặt lịch ngay</a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white text-center py-6 mt-20">
    <p>&copy; 2025 ServiceFix. Tất cả quyền được bảo lưu.</p>
  </footer>

</body>
</html>
