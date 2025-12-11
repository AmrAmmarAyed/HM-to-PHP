<?php
// info.php
header('Content-Type: text/html; charset=utf-8');
echo "<!doctype html><html><head><meta charset='utf-8'><title>Server Info</title></head><body>";

echo "<h2>كل محتويات \$_SERVER</h2>";
echo "<pre>";
print_r($_SERVER);
echo "</pre>";

// استخرج بنفسك REQUEST_METHOD, REMOTE_ADDR, HTTP_USER_AGENT
$request_method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'غير معروف';
$remote_addr = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'غير معروف';
$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : 'غير معروف';

echo "<h3>القيم المستخرجة</h3>";
echo "<ul>";
echo "<li><strong>REQUEST_METHOD:</strong> " . htmlspecialchars($request_method, ENT_QUOTES, 'UTF-8') . "</li>";
echo "<li><strong>REMOTE_ADDR:</strong> " . htmlspecialchars($remote_addr, ENT_QUOTES, 'UTF-8') . "</li>";
echo "<li><strong>HTTP_USER_AGENT:</strong> " . htmlspecialchars($user_agent, ENT_QUOTES, 'UTF-8') . "</li>";
echo "</ul>";

echo "</body></html>";
