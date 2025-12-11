<?php
// session_test.php
session_start();
header('Content-Type: text/html; charset=utf-8');

echo "<!doctype html><html><head><meta charset='utf-8'><title>اختبار الجلسة</title></head><body>";

if (!isset($_SESSION['name'])) {
    // إذا لم يكن الاسم محفوظًا، اعرض النموذج
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($name && $name !== '') {
            $_SESSION['name'] = $name;
            echo "<p>تم حفظ الاسم. <a href='session_test.php'>تابع</a></p>";
        } else {
            echo "<p>الاسم فارغ. الرجاء إدخال اسم.</p>";
            showForm();
        }
    } else {
        showForm();
    }
} else {
    $saved = htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8');
    echo "<p>مرحبًا يا {$saved}, هذه ليست زيارتك الأولى.</p>";
    echo "<form method='post' action='session_test.php'><button name='clear' value='1' type='submit'>مسح الاسم (للتجربة)</button></form>";

    // خيار لمسح الاسم (اختياري للتجربة)
    if (isset($_POST['clear']) && $_POST['clear'] == '1') {
        unset($_SESSION['name']);
        echo "<p>تم مسح الاسم. <a href='session_test.php'>إعادة تحميل</a></p>";
    }
}

function showForm() {
    echo <<<HTML
    <h2>أدخل اسمك</h2>
    <form method="post" action="session_test.php">
        <input type="text" name="name" placeholder="اكتب اسمك" required>
        <button type="submit">حفظ</button>
    </form>
HTML;
}

echo "</body></html>";
