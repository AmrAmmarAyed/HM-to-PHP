<?php
$students = ["سامي","نور","علي","هدى","ياسر"];
echo "<!doctype html><html lang='ar'><head><meta charset='utf-8'><title>Loop Practice</title></head><body style='direction:rtl;font-family:Tahoma;padding:18px'>";
foreach($students as $s){
    echo "<p>مرحبًا {$s}، نتمنى لك حظًا سعيدًا في الامتحان!</p>";
}
echo "<hr>";
for($i=1;$i<=10;$i++){
    $style = ($i%2==0) ? "color:green;font-weight:bold" : "";
    echo "<span style='{$style}'>".$i."</span> ";
}
echo "</body></html>";
