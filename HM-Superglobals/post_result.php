<?php
// post_result.php
header('Content-Type: text/html; charset=utf-8');

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

echo "<!doctype html><html><head><meta charset='utf-8'><title>نتيجة POST</title></head><body>";

if ($username === null && $password === null) {
    echo "<p>لم يصل أي بيانات. <a href='post_form.php'>العودة للنموذج</a></p>";
} else {
    // التحقق المطلوب: username = admin و password = 1234
    if ($username === 'admin' && $password === '1234') {
        echo "<p>مرحبًا بالمشرف</p>";
    } else {
        echo "<p>بيانات غير صحيحة</p>";
    }
}

echo "</body></html>";
