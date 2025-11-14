<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$question = $input['question'] ?? '';

if (!$question) {
    echo json_encode(['answer' => 'Xin hãy nhập câu hỏi']);
    exit();
}

// ⭐ API KEY GEMINI CỦA BẠN
$apiKey = 'AIzaSyDaXGpcTui7yTFl26RvXxiVm1vBAGCZ5ME';

// URL của Gemini API
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=$apiKey";

// Nội dung gửi lên Gemini
$data = [
    "contents" => [
        [
            "parts" => [
                ["text" => "Bạn là trợ lý AI chuyên về dịch vụ sửa chữa máy tính. Hãy trả lời ngắn gọn và dễ hiểu."],
                ["text" => $question]
            ]
        ]
    ],
    "generationConfig" => [
        "temperature" => 0.7
    ]
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

// Giải mã JSON
$result = json_decode($response, true);

// Lấy nội dung AI trả lời
$answer = $result['candidates'][0]['content']['parts'][0]['text'] 
          ?? 'Xin lỗi, tôi không hiểu câu hỏi này.';

// Trả về JSON
echo json_encode(['answer' => $answer]);
