<?php
// Tích hợp file kết nối database
// File config/config.php CHỈ chứa các hằng số DB và các hàm get_db_connection()
// Giả định file này đã được tạo và chứa: define('DB_HOST', ...); function get_db_connection() {...}
require_once "config/config.php"; 

// --- GÁN BIẾN KẾT NỐI $conn BẰNG CÁCH GỌI HÀM ---
// Biến $conn được tạo ra ở phạm vi toàn cục từ giá trị trả về của hàm.
// Nếu kết nối thất bại, hàm get_db_connection() sẽ tự động dừng chương trình (die).
// *LƯU Ý*: Nếu bạn chạy script này trên môi trường không có file config/config.php, nó sẽ báo lỗi.
$conn = get_db_connection();

// Khởi tạo các biến kết quả truy vấn là null
$cpus = $rams = $gpus = $ssds = $psus = $cases = null;
$mainboard_data = [];
$db_error = null;

// Hàm format giá
function format_currency($price) {
    if (!is_numeric($price)) return '0đ';
    return number_format($price, 0, ',', '.') . 'đ';
}

// Hàm truy vấn an toàn
function fetch_all_data($conn, $table, $columns) {
    // Kiểm tra $conn có phải là đối tượng kết nối hợp lệ không
    if (!($conn instanceof mysqli)) {
        return [];
    }
    
    // Thêm cột 'id' để có thể dùng trong Javascript (tùy chọn)
    $columns_with_id = (strpos($columns, 'id') === false) ? "id, " . $columns : $columns;
    
    $result = $conn->query("SELECT $columns_with_id FROM $table ORDER BY price ASC");
    if (!$result) {
        // Có lỗi truy vấn
        error_log("Lỗi truy vấn bảng '$table': " . $conn->error);
        return [];
    }
    
    // Trả về đối tượng mysqli_result hoặc mảng nếu không có dữ liệu
    return $result;
}

// Hàm fetch an toàn cho vòng lặp
function safe_fetch($result) {
    return $result instanceof mysqli_result ? $result->fetch_assoc() : false;
}

// --- 1. LẤY DỮ LIỆU TỪ DATABASE --- //
if ($conn) {
    // Lấy dữ liệu cho các linh kiện
    $cpus = fetch_all_data($conn, "cpus", "name, price, socket");
    $rams = fetch_all_data($conn, "rams", "name, price");
    $gpus = fetch_all_data($conn, "gpus", "name, price");
    $ssds = fetch_all_data($conn, "ssds", "name, price");
    $psus = fetch_all_data($conn, "psus", "name, price");
    $cases = fetch_all_data($conn, "cases", "name, price");

    // Lấy Mainboard và lưu vào mảng (dễ thao tác trong PHP và JS hơn)
    $mainboard_results = fetch_all_data($conn, "mainboards", "name, price, socket");
    if ($mainboard_results) {
        while ($mb = $mainboard_results->fetch_assoc()) {
            $mainboard_data[] = $mb;
        }
    }
    
    // Đóng kết nối
    $conn->close();
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xây dựng cấu hình PC - ServiceFix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        html { scroll-behavior: smooth; }
        .fade-in { animation: fadeIn 1s ease-in-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        /* Đảm bảo các option bị ẩn không chiếm chỗ */
        .mainboard-option[style*="display: none"] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 pt-20">

    <header class="fixed top-0 left-0 w-full bg-white/90 backdrop-blur-md shadow-md z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="index.php" class="text-2xl font-bold text-blue-600">ServiceFix</a>
            <nav class="space-x-6 font-medium">
                <a href="index.php" class="text-gray-700 hover:text-blue-600">Trang chủ</a>
                <a href="about.php" class="text-gray-700 hover:text-blue-600">Giới thiệu</a>
                <a href="index.php?page=services" class="text-gray-700 hover:text-blue-600">Dịch vụ</a>
                <a href="booking.php" class="text-gray-700 hover:text-blue-600">Đặt lịch</a> 
                <a href="buildpc.php" class="text-gray-700 hover:text-blue-600">Build PC</a>
                <a href="payment.php" class="text-gray-700 hover:text-blue-600">Thanh toán</a>
                <a href="index.php?page=login" class="bg-blue-50 text-blue-600 px-5 py-2 rounded-full hover:bg-blue-100 transition">Đăng nhập</a>
            </nav>
        </div>
    </header>

    <section class="relative bg-gradient-to-r from-blue-700 to-indigo-800 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <img src="https://images.unsplash.com/photo-1547743125-998816c7a72d?w=1200&auto=format&fit=crop" alt="PC Gaming Setup" class="w-full h-full object-cover">
        </div>
        <div class="container mx-auto px-4 py-20 relative">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-4xl sm:text-5xl md:text-6xl font-extrabold mb-4 leading-tight fade-in">
                    🔧 Tự Xây Dựng Cấu Hình PC
                </h2>
                <p class="text-xl mb-8 text-blue-100 fade-in delay-200">
                    Tùy chọn linh kiện, kiểm tra tương thích và tính toán chi phí tức thì.
                </p>
            </div>
        </div>
    </section>

    <section class="max-w-4xl mx-auto px-6 py-16 fade-in">
        <div class="bg-white p-8 md:p-10 rounded-2xl shadow-2xl border border-gray-100">
            
            <h3 class="text-3xl font-bold text-center text-blue-600 mb-8">Danh sách Linh kiện</h3>

            <div id="component-list" class="space-y-6">
                <div>
                    <label for="cpu" class="block font-semibold mb-2 flex justify-between items-center text-lg">
                        <span>1. Bộ vi xử lý (CPU) <i class="fas fa-microchip text-blue-500 ml-2"></i></span>
                        <span id="cpu-price-display" class="font-bold text-gray-700 text-sm"></span>
                    </label>
                    <select id="cpu" class="w-full p-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition shadow-sm" data-id="cpu">
                        <option value="0" data-price="0" data-socket="">-- Chọn CPU --</option>
                        <?php 
                        if ($cpus) {
                            $cpus->data_seek(0); // Đảm bảo con trỏ ở đầu
                            while ($cpu = safe_fetch($cpus)): ?>
                                <option value="<?= htmlspecialchars($cpu['id']) ?>" data-price="<?= htmlspecialchars($cpu['price']) ?>" data-socket="<?= htmlspecialchars($cpu['socket']) ?>">
                                    <?= htmlspecialchars($cpu['name']) ?> — <?= format_currency($cpu['price']) ?>
                                </option>
                        <?php endwhile; } ?>
                    </select>
                </div>

                <div>
                    <label for="main" class="block font-semibold mb-2 flex justify-between items-center text-lg">
                        <span>2. Bo mạch chủ (Mainboard) <i class="fas fa-th text-blue-500 ml-2"></i></span>
                        <span id="main-price-display" class="font-bold text-gray-700 text-sm"></span>
                    </label>
                    <select id="main" class="w-full p-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition shadow-sm" data-id="main">
                        <option value="0" data-price="0" data-socket="" selected>-- Chọn Mainboard --</option>
                        <?php foreach ($mainboard_data as $mb): ?>
                            <option value="<?= htmlspecialchars($mb['id']) ?>" data-price="<?= htmlspecialchars($mb['price']) ?>" data-socket="<?= htmlspecialchars($mb['socket']) ?>" class="mainboard-option">
                                <?= htmlspecialchars($mb['name']) ?> — <?= format_currency($mb['price']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p id="main-compatibility-note" class="mt-1 text-sm text-red-500 font-medium hidden">⚠️ Mainboard không tương thích với CPU đã chọn.</p>
                </div>

                <div>
                    <label for="ram" class="block font-semibold mb-2 flex justify-between items-center text-lg">
                        <span>3. Bộ nhớ (RAM) <i class="fas fa-memory text-blue-500 ml-2"></i></span>
                        <span id="ram-price-display" class="font-bold text-gray-700 text-sm"></span>
                    </label>
                    <select id="ram" class="w-full p-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition shadow-sm" data-id="ram">
                        <option value="0" data-price="0">-- Chọn RAM --</option>
                        <?php 
                        if ($rams) {
                            $rams->data_seek(0);
                            while ($ram = safe_fetch($rams)): ?>
                                <option value="<?= htmlspecialchars($ram['id']) ?>" data-price="<?= htmlspecialchars($ram['price']) ?>">
                                    <?= htmlspecialchars($ram['name']) ?> — <?= format_currency($ram['price']) ?>
                                </option>
                        <?php endwhile; }?>
                    </select>
                </div>

                <div>
                    <label for="gpu" class="block font-semibold mb-2 flex justify-between items-center text-lg">
                        <span>4. Card đồ họa (GPU) <i class="fas fa-tv text-blue-500 ml-2"></i></span>
                        <span id="gpu-price-display" class="font-bold text-gray-700 text-sm"></span>
                    </label>
                    <select id="gpu" class="w-full p-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition shadow-sm" data-id="gpu">
                        <option value="0" data-price="0">-- Chọn GPU --</option>
                        <?php 
                        if ($gpus) {
                            $gpus->data_seek(0);
                            while ($gpu = safe_fetch($gpus)): ?>
                                <option value="<?= htmlspecialchars($gpu['id']) ?>" data-price="<?= htmlspecialchars($gpu['price']) ?>">
                                    <?= htmlspecialchars($gpu['name']) ?> — <?= format_currency($gpu['price']) ?>
                                </option>
                        <?php endwhile; }?>
                    </select>
                </div>
                
                <div>
                    <label for="ssd" class="block font-semibold mb-2 flex justify-between items-center text-lg">
                        <span>5. Ổ cứng (SSD/HDD) <i class="fas fa-hdd text-blue-500 ml-2"></i></span>
                        <span id="ssd-price-display" class="font-bold text-gray-700 text-sm"></span>
                    </label>
                    <select id="ssd" class="w-full p-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition shadow-sm" data-id="ssd">
                        <option value="0" data-price="0">-- Chọn Ổ cứng --</option>
                        <?php 
                        if ($ssds) {
                            $ssds->data_seek(0);
                            while ($ssd = safe_fetch($ssds)): ?>
                                <option value="<?= htmlspecialchars($ssd['id']) ?>" data-price="<?= htmlspecialchars($ssd['price']) ?>">
                                    <?= htmlspecialchars($ssd['name']) ?> — <?= format_currency($ssd['price']) ?>
                                </option>
                        <?php endwhile; }?>
                    </select>
                </div>

                <div>
                    <label for="psu" class="block font-semibold mb-2 flex justify-between items-center text-lg">
                        <span>6. Bộ nguồn (PSU) <i class="fas fa-power-off text-blue-500 ml-2"></i></span>
                        <span id="psu-price-display" class="font-bold text-gray-700 text-sm"></span>
                    </label>
                    <select id="psu" class="w-full p-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition shadow-sm" data-id="psu">
                        <option value="0" data-price="0">-- Chọn Bộ nguồn --</option>
                        <?php 
                        if ($psus) {
                            $psus->data_seek(0);
                            while ($psu = safe_fetch($psus)): ?>
                                <option value="<?= htmlspecialchars($psu['id']) ?>" data-price="<?= htmlspecialchars($psu['price']) ?>">
                                    <?= htmlspecialchars($psu['name']) ?> — <?= format_currency($psu['price']) ?>
                                </option>
                        <?php endwhile; }?>
                    </select>
                </div>
                
                <div>
                    <label for="case" class="block font-semibold mb-2 flex justify-between items-center text-lg">
                        <span>7. Vỏ case <i class="fas fa-box text-blue-500 ml-2"></i></span>
                        <span id="case-price-display" class="font-bold text-gray-700 text-sm"></span>
                    </label>
                    <select id="case" class="w-full p-3 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition shadow-sm" data-id="case">
                        <option value="0" data-price="0">-- Chọn Vỏ case --</option>
                        <?php 
                        if ($cases) {
                            $cases->data_seek(0);
                            while ($case = safe_fetch($cases)): ?>
                                <option value="<?= htmlspecialchars($case['id']) ?>" data-price="<?= htmlspecialchars($case['price']) ?>">
                                    <?= htmlspecialchars($case['name']) ?> — <?= format_currency($case['price']) ?>
                                </option>
                        <?php endwhile; }?>
                    </select>
                </div>

            </div>
            
            <div id="totalBox" class="mt-8 p-6 bg-blue-600 rounded-xl text-white text-center shadow-lg">
                <h4 class="text-xl font-bold mb-1">TỔNG CHI PHÍ ƯỚC TÍNH:</h4>
                <div class="text-4xl font-extrabold" id="total-price">0đ</div>
            </div>
            
            <div class="mt-6 text-center">
                <button id="checkout-button" class="bg-green-500 hover:bg-green-600 text-white text-xl font-bold px-10 py-4 rounded-full transition shadow-lg disabled:opacity-50" disabled>
                    <i class="fas fa-shopping-cart mr-2"></i> Vui lòng chọn đủ linh kiện
                </button>
            </div>

        </div>
    </section>

    <section class="bg-gray-100 py-16 fade-in">
        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-3 gap-8 text-center">
            <div class="bg-white p-6 rounded-xl shadow-md">
                <i class="fas fa-check-circle text-blue-600 text-3xl mb-3"></i>
                <h4 class="font-semibold text-lg mb-2">Kiểm tra Tương thích</h4>
                <p class="text-gray-600">Hệ thống tự động kiểm tra socket CPU và Mainboard.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md">
                <i class="fas fa-shield-alt text-blue-600 text-3xl mb-3"></i>
                <h4 class="font-semibold text-lg mb-2">Linh kiện chính hãng</h4>
                <p class="text-gray-600">Cam kết 100% linh kiện mới, có hóa đơn và bảo hành rõ ràng.</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-md">
                <i class="fas fa-tools text-blue-600 text-3xl mb-3"></i>
                <h4 class="font-semibold text-lg mb-2">Miễn phí lắp đặt</h4>
                <p class="text-gray-600">Hỗ trợ lắp đặt, cài đặt hệ điều hành và driver miễn phí.</p>
            </div>
        </div>
    </section>
    
    <footer class="bg-gray-900 text-white text-center py-6 mt-12">
        <p>&copy; 2025 ServiceFix. Tất cả quyền được bảo lưu.</p>
    </footer>

    <script>
        // --- CÁC HÀM TIỆN ÍCH VÀ KHỞI TẠO ---
        const mainboardSelect = document.getElementById("main");
        const mainboardOptions = Array.from(mainboardSelect.options).filter(opt => opt.value !== '0');
        const allSelects = document.querySelectorAll("select");
        const priceDisplayMap = {
            cpu: 'cpu-price-display',
            main: 'main-price-display',
            ram: 'ram-price-display',
            gpu: 'gpu-price-display',
            ssd: 'ssd-price-display',
            psu: 'psu-price-display',
            case: 'case-price-display'
        };

        function formatCurrency(number) {
            // Chuyển đổi về số nguyên trước khi format
            const price = parseInt(number); 
            if (isNaN(price) || price === 0) return '';
            return "(+" + price.toLocaleString("vi-VN") + "đ)";
        }

        // --- CẬP NHẬT GIÁ RIÊNG LẺ VÀ TÍNH TỔNG ---
        function calculateTotal() {
            let total = 0;
            let allSelected = true;
            let isCompatible = true;
            
            const cpuSocket = document.getElementById("cpu").options[document.getElementById("cpu").selectedIndex]?.dataset.socket || '';
            const mainSocket = document.getElementById("main").options[document.getElementById("main").selectedIndex]?.dataset.socket || '';
            const mainboardCompatibilityNote = document.getElementById("main-compatibility-note");

            allSelects.forEach(s => {
                const selectedOption = s.options[s.selectedIndex];
                const price = Number(selectedOption?.dataset.price || 0);
                const componentId = s.dataset.id;
                
                // Cập nhật giá riêng lẻ
                if (componentId && priceDisplayMap[componentId]) {
                    document.getElementById(priceDisplayMap[componentId]).innerText = formatCurrency(price);
                }

                if (selectedOption.value === "0") {
                    allSelected = false; 
                }
                
                total += price;
            });
            
            // 2. Kiểm tra tính tương thích giữa CPU và Mainboard
            if (cpuSocket && mainSocket && cpuSocket !== mainSocket) {
                isCompatible = false;
                mainboardCompatibilityNote.classList.remove('hidden');
                allSelected = false; // Bắt buộc phải chọn lại nếu không tương thích
            } else {
                 mainboardCompatibilityNote.classList.add('hidden');
            }

            // Cập nhật tổng chi phí
            document.getElementById("total-price").innerText = formatCurrency(total).replace('(', '').replace(')', ''); // Bỏ dấu (+) ở tổng tiền
            
            // Cập nhật trạng thái nút thanh toán
            const checkoutButton = document.getElementById("checkout-button");
            const canCheckout = allSelected && isCompatible;
            
            checkoutButton.disabled = !canCheckout;
            if (canCheckout) {
                checkoutButton.innerHTML = '<i class="fas fa-shopping-cart mr-2"></i> Đặt hàng cấu hình này';
            } else if (!isCompatible) {
                checkoutButton.innerHTML = '<i class="fas fa-times-circle mr-2"></i> Lỗi tương thích';
            } else {
                checkoutButton.innerHTML = '<i class="fas fa-shopping-cart mr-2"></i> Vui lòng chọn đủ linh kiện';
            }
        }

        // --- LỌC MAINBOARD THEO SOCKET CPU ---
        function filterMainboard() {
            const cpuSelect = document.getElementById("cpu");
            const cpuSocket = cpuSelect.options[cpuSelect.selectedIndex]?.dataset.socket;
            
            let isCurrentMainboardCompatible = false;
            let currentMainboardSocket = mainboardSelect.options[mainboardSelect.selectedIndex]?.dataset.socket;

            mainboardOptions.forEach((opt) => {
                const mbSocket = opt.dataset.socket;
                
                // Nếu chưa chọn CPU, hiển thị tất cả
                if (!cpuSocket) {
                    opt.style.display = "block";
                    return;
                }
                
                // Lọc theo Socket
                if (mbSocket === cpuSocket) {
                    opt.style.display = "block";
                    if (opt.selected) {
                        isCurrentMainboardCompatible = true;
                    }
                } else {
                    opt.style.display = "none";
                }
            });
            
            // Nếu Mainboard đang chọn không tương thích với CPU mới, đặt lại giá trị Mainboard
            if (cpuSocket && currentMainboardSocket && cpuSocket !== currentMainboardSocket) {
                 mainboardSelect.value = "0";
            }
            
            calculateTotal(); 
        }

        // --- XỬ LÝ SỰ KIỆN CLICK ĐẶT HÀNG ---
        document.getElementById("checkout-button").addEventListener('click', function() {
            if (!this.disabled) {
                // Ở đây, bạn sẽ cần gửi dữ liệu cấu hình đã chọn lên server 
                // (ví dụ: qua AJAX hoặc Form POST) để lưu vào giỏ hàng/đơn hàng.
                // Tạm thời, ta chỉ chuyển hướng đến trang thanh toán
                window.location.href = 'payment.php'; 
            }
        });

        // --- GẮN SỰ KIỆN LẮNG NGHE CHO TẤT CẢ CÁC THẺ SELECT ---
        document.getElementById("cpu").addEventListener("change", filterMainboard);

        allSelects.forEach(select => {
            if (select.id !== "cpu") {
                select.addEventListener("change", calculateTotal);
            }
        });

        // --- KHỞI TẠO LẦN ĐẦU ---
        // Chạy lần đầu để tính toán tổng tiền và lọc Mainboard (nếu có giá trị mặc định)
        filterMainboard();
        calculateTotal(); 
    </script>

</body>
</html>