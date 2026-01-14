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

// Safety check
if (
    isset($data['entry'][0]['changes'][0]['value']['messages'][0])
) {
    $message = $data['entry'][0]['changes'][0]['value']['messages'][0];

    $from      = $message['from']; // phone number
    $msgType  = $message['type'];
    $time     = date('Y-m-d H:i:s', $message['timestamp']);

    $text = '';
    if ($msgType === 'text') {
        $text = $message['text']['body'];
    }

    // ✅ THIS IS YOUR "FRESH MESSAGE"
    error_log("NEW MESSAGE | From: $from | Message: $text | Time: $time");

    // 👇 from here you can do ANYTHING
}

http_response_code(200);
echo "EVENT_RECEIVED";
