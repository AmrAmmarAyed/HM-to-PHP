<?php
// Closure يحتفظ بالعملة
function currencyHolder($initial="USD"){
    return function($action=null,$value=null) use (&$initial){
        if($action==="set" && $value) $initial = $value;
        return $initial;
    };
}

// Currying لدالة الضريبة
function taxRate($rate){
    return function($price) use ($rate){
        return $price + ($price * $rate / 100);
    };
}

// Lambda مربع
$square = function($x){ return $x * $x; };

// Higher-order apply
function applyToArray(array $arr, callable $fn){
    $out = [];
    foreach($arr as $k=>$v) $out[$k] = $fn($v);
    return $out;
}

// Composition
function compose(callable $f, callable $g){
    return function($x) use ($f,$g){
        return $f($g($x));
    };
}

$cur = currencyHolder("SAR");
echo $cur()."\n";
$cur("set","YER");
echo $cur()."\n";

$addTax = taxRate(15);
echo $addTax(100)."\n";

echo $square(6)."\n";

$nums = [1,2,3,4];
$double = fn($n)=> $n*2;
print_r(applyToArray($nums,$double));

$doubleFn = function($n){ return $n*2; };
$subFive = function($n){ return $n-5; };
$combo = compose($doubleFn, $subFive);
echo $combo(10)."\n";
