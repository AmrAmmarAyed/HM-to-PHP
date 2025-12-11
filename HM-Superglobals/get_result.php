<?php
// get_result.php
header('Content-Type: text/html; charset=utf-8');

$name = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

echo "<!doctype html><html><head><meta charset='utf-8'><title>نتيجة GET</title></head><body>";
if ($name === null || $name === '') {
    echo "<p>لم تدخل اسمًا. <a href='get_form.php'>العودة للنموذج</a></p>";
} else {
    echo "<p>الاسم المرسل: <strong>" . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . "</strong></p>";
}
echo "</body></html>";
