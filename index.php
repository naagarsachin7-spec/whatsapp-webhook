<?php
$verify_token = "my_verify_token_123";

/* =========================
   WEBHOOK VERIFICATION
========================= */
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

/* =========================
   HANDLE INCOMING MESSAGE
========================= */
$input = file_get_contents("php://input");
$data  = json_decode($input, true);

// ✅ REMOVE RAW LOGGING
// error_log("WHATSAPP_EVENT: " . $input);

if (isset($data['entry'][0]['changes'][0]['value']['messages'][0])) {

    $msg = $data['entry'][0]['changes'][0]['value']['messages'][0];

    $from = $msg['from'];
    $time = date('Y-m-d H:i:s', $msg['timestamp']);
    $text = '';

    if ($msg['type'] === 'text') {
        $text = $msg['text']['body'];
    }

    // ✅ CLEAN, FRESH MESSAGE
    error_log("NEW MESSAGE | From: $from | Message: $text | Time: $time");
}

http_response_code(200);
echo "EVENT_RECEIVED";
