<?php
$verify_token = "my_verify_token_123";

/**
 * Webhook verification
 * Render + Docker correctly passes hub.* params
 */
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (
        isset($_GET['hub.mode']) &&
        $_GET['hub.mode'] === 'subscribe' &&
        isset($_GET['hub.verify_token']) &&
        $_GET['hub.verify_token'] === $verify_token
    ) {
        echo $_GET['hub.challenge'];
        exit;
    }
}

$input = file_get_contents("php://input");
file_put_contents("log.txt", $input . PHP_EOL, FILE_APPEND);

http_response_code(200);
echo "EVENT_RECEIVED";
