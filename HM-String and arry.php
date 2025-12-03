<?php

function section($title) {
    echo "\n\n==== $title ====\n";
}

function show($label, $value) {
    echo "\n-- $label:\n";
    if (is_bool($value)) {
        var_export($value);
        echo "\n";
    } elseif (is_null($value)) {
        echo "NULL\n";
    } elseif (is_array($value) || is_object($value)) {
        var_dump($value);
    } else {
        echo $value . "\n";
    }
}

/* =========================
   أمثلة دوال المصفوفات
   ========================= */


// إنشاء مصفوفات
$arr = [3, 1, 4, 1, 5];
$assoc = ['name'=>'Ali', 'age'=>20, 'city'=>'Sana\'a'];
show('مصفوفة أساسية $arr', $arr);
show('مصفوفة ترابطية $assoc', $assoc);

// معلومات وعمليات أساسية
show('count($arr)', count($arr));
show('empty([])', empty([]));
show('in_array(5, $arr)', in_array(5, $arr));
show('array_search(4, $arr)', array_search(4, $arr)); // يعيد المفتاح أو false

// إضافة / حذف عناصر (stack & queue)
$copy = $arr;
array_push($copy, 9); // add to end
show('بعد array_push(...,9)', $copy);
array_pop($copy); // remove from end
show('بعد array_pop', $copy);

array_unshift($copy, 0); // add to start
show('بعد array_unshift(...,0)', $copy);
array_shift($copy); // remove from start
show('بعد array_shift', $copy);

// دمج وقطع وفلترة
$a1 = [1,2,3];
$a2 = [4,5];
show('array_merge($a1,$a2)', array_merge($a1,$a2));

$dup = [1,2,2,3,3,3];
show('array_unique', array_unique($dup));

$slice = array_slice($arr, 1, 3); // from index 1 length 3
show('array_slice($arr,1,3)', $slice);

$spliceArr = $arr;
$removed = array_splice($spliceArr, 2, 2, ['a','b']); // استبدال
show('بعد array_splice استبدال من 2 بعدد2 بـ [a,b]', $spliceArr);
show('العناصر المزالة من array_splice', $removed);

// مفاتيح وقيم
$keys = array_keys($assoc);
$values = array_values($assoc);
show('array_keys($assoc)', $keys);
show('array_values($assoc)', $values);

// بحث وتصفية وتحويل
$foundKey = array_search(1, $arr);
show('array_search(1,$arr)', $foundKey);

$mapped = array_map(fn($x)=>$x*$x, $arr);
show('array_map square', $mapped);

$filtered = array_filter($arr, fn($x)=> $x%2==1); // odd only
show('array_filter odd', $filtered);

$reduced = array_reduce($arr, fn($carry,$item)=>$carry+$item, 0);
show('array_reduce sum', $reduced);

// فرز
$unsorted = [3, 1, 4, 2];
sort($unsorted); // فرز تصاعدي (يعيد true) ويغيّر المصفوفة
show('sort تصاعدي', $unsorted);

$assoc2 = ['b'=>2,'a'=>3,'c'=>1];
asort($assoc2); // يحافظ على المفاتيح
show('asort يحافظ على المفاتيح (قيمة تصاعدي)', $assoc2);
ksort($assoc2);
show('ksort (مفتاح تصاعدي)', $assoc2);

// عمليات حسابية
show('array_sum($arr)', array_sum($arr));
show('array_product([2,3,4])', array_product([2,3,4]));

// تحويلات ومفيدة
show('array_reverse([1,2,3])', array_reverse([1,2,3]));
show('array_flip(["a"=>1,"b"=>2])', array_flip(["a"=>1,"b"=>2]));
show('array_chunk(range(1,7),3)', array_chunk(range(1,7),3));
show('array_combine(keys, values)', array_combine(['x','y'], [9,8]));
show('array_fill(0,3,"x")', array_fill(0,3,'x'));
show('range(1,5)', range(1,5));

// اختلاف وتقاطع
$a = [1,2,3,4];
$b = [3,4,5];
show('array_diff($a,$b) => عناصر في a وليست في b', array_diff($a,$b));
show('array_intersect($a,$b) => عناصر مشتركة', array_intersect($a,$b));

// دمج حسب المفاتيح
show('array_replace([a=>1,b=>2],[b=>9])', array_replace(['a'=>1,'b'=>2], ['b'=>9]));

// split & join
$chunks = array_chunk(range(1,10), 4);
show('array_chunk(1..10,4)', $chunks);
$joined = implode('-', ['a','b','c']);
show('implode("-", ["a","b","c"])', $joined);

// دوال متقدمة / مفيدة
show('array_column([["id"=>1,"name"=>"A"],["id"=>2,"name"=>"B"]],"name")',
    array_column([["id"=>1,"name"=>"A"],["id"=>2,"name"=>"B"]],"name"));

/* =========================
   أمثلة دوال النصوص
   ========================= */
section('أمثلة دوال النصوص (strings)');

$str = "  Hello World! مرحبا بالعالم  ";
show('النص الأصلي', $str);

// الطول والتقطيع
show('strlen($str)', strlen($str));
show('trim($str)', trim($str));
show('ltrim($str)', ltrim($str));
show('rtrim($str)', rtrim($str));
show('substr(trim($str), 0, 12)', substr(trim($str), 0, 12));
show('substr($str, 2, 5)', substr($str, 2, 5));

// بحث واستبدال
show('strpos("hello world", "world")', strpos("hello world", "world"));
show('strrpos("ababa","ba")', strrpos("ababa","ba"));

show('str_replace("World","PHP", "Hello World")', str_replace("World","PHP","Hello World"));
show('str_ireplace case-insensitive', str_ireplace("hello","HEY","HeLLo world"));

// حالة الأحرف
show('strtolower("ABC")', strtolower("ABC"));
show('strtoupper("abc")', strtoupper("abc"));
show('ucfirst("hello")', ucfirst("hello"));
show('ucwords("hello world from php")', ucwords("hello world from php"));

// تقسيم ودمج
$csv = "apple,banana,pear";
show('explode(",", $csv)', explode(",", $csv));
show('implode(" + ", ["a","b"])', implode(" + ", ["a","b"]));
show('str_split("abcd",2)', str_split("abcd",2));

// تكرار وعكس وخلط
show('str_repeat("ha",3)', str_repeat("ha",3));
show('str_shuffle("abcdef")', str_shuffle("abcdef"));
show('strrev("abc")', strrev("abc"));

// مقارنة
show('strcmp("a","b")', strcmp("a","b")); // <0 if a<b
show('strcasecmp case-insensitive', strcasecmp("A","a"));

// تنسيقات وطباعة
show('sprintf("Hello %s %d","Ali",2025)', sprintf("Hello %s %d","Ali",2025));
printf("\nExample printf: Hello %s\n", "Student"); // يطبع مباشرة

// دوال تعبيرات منتظمة (PCRE)
$txt = "Email: test@example.com, phone: +970-777-111";
preg_match('/[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}/', $txt, $m);
show('preg_match email', $m[0] ?? null);

$replaced = preg_replace('/\+\d+[-\d]*/', '[phone]', $txt);
show('preg_replace to mask phone', $replaced);

show('preg_split by non-word', preg_split('/\W+/', "one,two three.four"));

// تحويل HTML وأمن
$html = "<b>Text</b> & \"quotes\"";
show('htmlspecialchars($html)', htmlspecialchars($html));
show('html_entity_decode(htmlentities($html)) roundtrip', html_entity_decode(htmlentities($html)));

// تشابه النصوص
$a = "kitten";
$b = "sitting";
$sim = 0;
similar_text($a, $b, $sim);
show('similar_text("kitten","sitting") percent', $sim);

// تحويل سطر إلى <br>
show('nl2br("line1\nline2")', nl2br("line1\nline2"));

?>
