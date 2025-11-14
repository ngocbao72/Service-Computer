<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dịch vụ - Service Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Chat AI */
        #ai-chat { font-family: 'Segoe UI', sans-serif; }
        #chat-body div { margin-bottom: 8px; }
        #chat-body div.user { text-align: right; }
        #chat-body div.ai { text-align: left; }
        #chat-body div span { display: inline-block; padding: 6px 10px; border-radius: 12px; max-width: 75%; word-wrap: break-word; }
        #chat-body div.user span { background-color: #007bff; color: white; }
        #chat-body div.ai span { background-color: #f1f1f1; color: black; }

        /* Nút AI tròn */
        #ai-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
            z-index: 50;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        #ai-button:hover {
            transform: scale(1.15);
            box-shadow: 0 10px 25px rgba(0,0,0,0.35);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">

<!-- Navbar -->
<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-2">
            <i class="fas fa-tools text-blue-600 text-2xl"></i>
            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                Service Manager
            </h1>
        </div>
        <div class="space-x-6">
            <a href="index.php" class="text-gray-700 hover:text-blue-600 transition font-medium">Trang chủ</a>
            <a href="about.php?page=about" class="text-blue-600 font-semibold">Giới thiệu</a>
            <a href="index.php?page=services" class="text-blue-600 font-semibold">Dịch vụ</a>
            <a href="booking.php?page=booking" class="text-blue-600 font-semibold">Đặt lịch</a>
            <a href="index.php?page=payment" class="text-blue-600 font-semibold">Thanh toán</a>
            <a href="index.php?page=login" class="bg-blue-600 text-white px-5 py-2 rounded-full hover:bg-blue-700 transition">
                Đăng nhập
            </a>
        </div>
    </div>
</nav>

<!-- Header -->
<div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-12 text-center">
    <h2 class="text-4xl font-bold mb-3">Các gói dịch vụ của chúng tôi</h2>
    <p class="text-blue-100 text-lg">Chọn gói dịch vụ phù hợp với nhu cầu của bạn</p>
</div>

<!-- Main content -->
<main class="container mx-auto px-4 py-12">

    <!-- Thanh tìm kiếm đẹp -->
    <div class="mb-12">
        <div class="relative max-w-md mx-auto">
            <input type="text" id="search-input" placeholder="Tìm dịch vụ..."
                class="w-full border-2 border-gray-300 rounded-full px-4 py-3 pl-12 focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-300 shadow-md transition duration-300 placeholder-gray-400">
            <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400 text-lg"></i>
            <button id="clear-search" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 hidden">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    <!-- Lưới dịch vụ -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="services-grid">
        <?php if (!empty($services)): ?>
            <?php foreach ($services as $service): ?>
                <div class="service-card bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition transform hover:-translate-y-2 duration-300">
                    <!-- Card header -->
                    <div class="relative h-48 bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                        <i class="fas fa-laptop text-white text-6xl opacity-20 absolute"></i>
                        <div class="relative text-center text-white p-6">
                            <i class="fas fa-wrench text-4xl mb-3"></i>
                            <h3 class="text-2xl font-bold service-name"><?php echo htmlspecialchars($service['name']); ?></h3>
                        </div>
                    </div>
                    <!-- Card body -->
                    <div class="p-6">
                        <p class="text-gray-600 mb-6 leading-relaxed min-h-[60px]">
                            <?php echo nl2br(htmlspecialchars($service['description'])); ?>
                        </p>
                        <div class="border-t pt-4 flex flex-col sm:flex-row justify-between items-center gap-4">
                            <div class="text-center sm:text-left">
                                <p class="text-sm text-gray-500 mb-1">Chỉ từ</p>
                                <span class="text-3xl font-bold text-blue-600">
                                    <?php echo number_format($service['price'], 0, ',', '.'); ?>đ
                                </span>
                            </div>
                            <div class="flex flex-col sm:flex-row gap-3">
                                <a href="index.php?page=error_form&service_id=<?php echo $service['id']; ?>"
                                   class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-3 rounded-full hover:from-blue-700 hover:to-blue-800 transition flex items-center justify-center space-x-2 shadow-md">
                                    <span>Chọn ngay</span>
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                                <a href="payment.php?page=payment_form&service_id=<?php echo $service['id']; ?>"
                                   class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-full hover:from-green-600 hover:to-green-700 transition flex items-center justify-center space-x-2 shadow-md">
                                    <span>Thanh toán</span>
                                    <i class="fas fa-qrcode"></i>
                                </a>
                            </div>
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
                    <p><i class="fas fa-phone mr-2 text-blue-500"></i> 083 225 9672</p>
                    <p><i class="fas fa-envelope mr-2 text-blue-500"></i> support@servicefix.vn</p>
                    <p><i class="fas fa-map-marker-alt mr-2 text-blue-500"></i> Số 2, Phố Xốm, Hà Đông, TP Hà Nội</p>
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

<!-- Nút AI tròn -->
<div id="ai-button">
    <i class="fas fa-robot text-2xl"></i>
</div>

<!-- Chatbot AI -->
<div id="ai-chat" class="fixed bottom-24 right-5 w-80 bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col hidden">
    <div id="ai-header" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-4 py-3 font-bold flex justify-between items-center rounded-t-2xl">
        <div class="flex items-center space-x-2">
            <i class="fas fa-robot text-lg"></i>
            <span>Trợ lý AI</span>
        </div>
        <i class="fas fa-times cursor-pointer" onclick="toggleChat()"></i>
    </div>
    <div id="chat-body" class="flex-1 p-3 overflow-y-auto"></div>
    <div id="chat-input-area" class="p-3 border-t flex">
        <input type="text" id="chat-input" placeholder="Hỏi trợ lý AI..." class="flex-1 border rounded px-3 py-2 mr-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
        <button id="chat-send" class="bg-gradient-to-r from-blue-600 to-blue-800 text-white px-4 py-2 rounded-full hover:from-blue-700 hover:to-blue-900 transition-shadow shadow-lg">Gửi</button>
    </div>
</div>

<script>
const aiButton = document.getElementById('ai-button');
const chat = document.getElementById('ai-chat');
const chatBody = document.getElementById('chat-body');
const chatInputArea = document.getElementById('chat-input-area');
const chatInput = document.getElementById('chat-input');
const chatSend = document.getElementById('chat-send');

let firstOpen = true;

aiButton.addEventListener('click', () => {
    chat.classList.toggle('hidden');
    if(firstOpen) {
        firstOpen = false;
        chatBody.innerHTML += `<div class="ai"><span>Xin chào, tôi là trợ lý ảo AI về dịch vụ sửa chữa máy tính. Tôi có thể giúp gì cho bạn?</span></div>`;
        chatBody.scrollTop = chatBody.scrollHeight;
    }
});

function toggleChat() { chat.classList.add('hidden'); }

chatSend.addEventListener('click', () => {
    const question = chatInput.value.trim();
    if(!question) return;

    chatBody.innerHTML += `<div class="user"><span>${question}</span></div>`;
    chatInput.value = '';
    chatBody.scrollTop = chatBody.scrollHeight;

    fetch('api.php', { 
        method: 'POST', 
        headers: { 'Content-Type': 'application/json' }, 
        body: JSON.stringify({ question }) 
    })
    .then(res => res.json())
    .then(data => {
        chatBody.innerHTML += `<div class="ai"><span>${data.answer}</span></div>`;
        chatBody.scrollTop = chatBody.scrollHeight;
    })
    .catch(err => {
        chatBody.innerHTML += `<div class="ai"><span>Đã có lỗi xảy ra.</span></div>`;
    });
});

// Thanh tìm kiếm dịch vụ đẹp
const searchInput = document.getElementById('search-input');
const clearBtn = document.getElementById('clear-search');

function normalize(str) {
    return str.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
}

searchInput.addEventListener('input', () => {
    clearBtn.style.display = searchInput.value ? 'block' : 'none';
    const keyword = normalize(searchInput.value);
    const cards = document.querySelectorAll('.service-card');
    cards.forEach(card => {
        const name = normalize(card.querySelector('.service-name').textContent);
        card.style.display = name.includes(keyword) ? '' : 'none';
    });
});

clearBtn.addEventListener('click', () => {
    searchInput.value = '';
    clearBtn.style.display = 'none';
    const cards = document.querySelectorAll('.service-card');
    cards.forEach(card => card.style.display = '');
});
</script>

</body>
</html>
