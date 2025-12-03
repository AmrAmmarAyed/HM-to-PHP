<?php
date_default_timezone_set('Asia/Aden');

// تاريخ
function now_iso(){ return date('c'); }
function format_date($d, $fmt='Y-m-d H:i:s'){ $dt = new DateTime($d); return $dt->format($fmt); }
function add_days($d, $days){ $dt = new DateTime($d); $dt->modify("+{$days} days"); return $dt->format('Y-m-d H:i:s'); }
function diff_days($a, $b){ $da = new DateTime($a); $db = new DateTime($b); return $da->diff($db)->days; }
function to_timezone($d, $tz){ $dt = new DateTime($d); $dt->setTimezone(new DateTimeZone($tz)); return $dt->format('Y-m-d H:i:s'); }

// ملفات
function write_file($path, $content, $mode = FILE_APPEND){
    return file_put_contents($path, $content, $mode) !== false;
}
function read_file($path){
    return is_readable($path) ? file_get_contents($path) : false;
}
function ensure_dir($dir){
    if(!is_dir($dir)) return mkdir($dir, 0755, true);
    return true;
}
function append_line($path, $line){
    $h = fopen($path, 'a');
    if(!$h) return false;
    flock($h, LOCK_EX);
    fwrite($h, $line . PHP_EOL);
    fflush($h);
    flock($h, LOCK_UN);
    fclose($h);
    return true;
}
function list_dir($dir){
    if(!is_dir($dir)) return false;
    $files = array_diff(scandir($dir), ['.','..']);
    return array_values($files);
}
function safe_delete($path){
    if(is_file($path)) return unlink($path);
    return false;
}

// أمثلة
// echo now_iso(), PHP_EOL;
// echo format_date('2025-12-03'), PHP_EOL;
// echo add_days('2025-12-03', 5), PHP_EOL;
// echo diff_days('2025-12-03','2025-12-10'), PHP_EOL;
// write_file(__DIR__.'/v1.txt', "hello\n");
// append_line(__DIR__.'/v1.txt','سطر جديد');
