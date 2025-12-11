<?php
// upload_result.php
header('Content-Type: text/html; charset=utf-8');

echo "<!doctype html><html><head><meta charset='utf-8'><title>نتيجة الرفع</title></head><body>";

if (!isset($_FILES['uploaded_file'])) {
    echo "<p>لم يتم ارسال ملف. <a href='upload_form.php'>العودة للنموذج</a></p>";
    exit;
}

$file = $_FILES['uploaded_file'];

// فحص الأخطاء الأساسية
if ($file['error'] !== UPLOAD_ERR_OK) {
    echo "<p>حدث خطأ أثناء الرفع (كود الخطأ: " . intval($file['error']) . ").</p>";
    exit;
}

// إعدادات الفحص
$maxFileSize = 2 * 1024 * 1024; // 2 ميجابايت
$allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'txt']; // امتدادات مسموحة (فحص اسمي فقط كما طلبت)
$uploadsDir = __DIR__ . DIRECTORY_SEPARATOR . 'uploads';

// تحقق من الحجم
if ($file['size'] > $maxFileSize) {
    echo "<p>حجم الملف كبير جدًا. الحد الأقصى هو " . ($maxFileSize / (1024*1024)) . " ميجابايت.</p>";
    exit;
}

// تحقق من الامتداد اسميًا
$originalName = $file['name'];
$ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
if (!in_array($ext, $allowedExt)) {
    echo "<p>الامتداد غير مسموح به. الامتدادات المسموحة: " . implode(', ', $allowedExt) . ".</p>";
    exit;
}

// تأكد من وجود مجلد uploads
if (!is_dir($uploadsDir)) {
    if (!mkdir($uploadsDir, 0755, true)) {
        echo "<p>فشل إنشاء مجلد uploads على الخادم.</p>";
        exit;
    }
}

// أنشئ اسم ملف جديد لمنع الكتابة فوق ملفات موجودة
$safeBase = preg_replace('/[^A-Za-z0-9_\-]/', '_', pathinfo($originalName, PATHINFO_FILENAME));
$targetFilename = $safeBase . '_' . time() . '.' . $ext;
$targetPath = $uploadsDir . DIRECTORY_SEPARATOR . $targetFilename;

// انقل الملف
if (move_uploaded_file($file['tmp_name'], $targetPath)) {
    echo "<p>تم رفع الملف بنجاح.</p>";
    echo "<ul>";
    echo "<li>الاسم الأصلي: " . htmlspecialchars($originalName, ENT_QUOTES, 'UTF-8') . "</li>";
    echo "<li>الاسم المحفوظ: " . htmlspecialchars($targetFilename, ENT_QUOTES, 'UTF-8') . "</li>";
    echo "<li>الحجم: " . intval($file['size']) . " بايت</li>";
    echo "</ul>";
    echo "<p>المسار على الخادم (نسخة للعرض): uploads/" . htmlspecialchars($targetFilename, ENT_QUOTES, 'UTF-8') . "</p>";
} else {
    echo "<p>فشل نقل الملف للمجلد النهائي.</p>";
}

echo "</body></html>";
