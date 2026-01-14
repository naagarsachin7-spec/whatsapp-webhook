<?php
$verify_token = "my_verify_token_123";

// ✅ Webhook verification (GET)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (
        isset($_GET['hub_mode']) &&
        $_GET['hub_mode'] === 'subscribe' &&
        isset($_GET['hub_verify_token']) &&
        $_GET['hub_verify_token'] === $verify_token
    ) {
        echo $_GET['hub_challenge'];
        exit;
    }
}

// ✅ Incoming WhatsApp messages (POST)
$input = file_get_contents("php://input");

// 🔥 Log to Render logs (STDOUT)
error_log("WHATSAPP_EVENT: " . $input);

http_response_code(200);
echo "EVENT_RECEIVED";
