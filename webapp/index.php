<?php

require_once('classes/CBR/Currency.php');
$cbrCurrency = new \CBR\Currency();
$content = $cbrCurrency->fetchData();

// Разбираем содержимое, при помощи регулярных выражений
$pattern = "{<Valute ID=\"([^\"]+)[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>([^<]+)}i";

preg_match_all($pattern, $content, $out, PREG_SET_ORDER);

$dollar = '';
$euro = '';

var_dump($out);

foreach ($out as $cur) {
    if ($cur[2] == 840) {
        $dollar = str_replace(',', '.', $cur[4]);
    }
    if ($cur[2] == 978) {
        $euro = str_replace(',', '.', $cur[4]);
    }
}

echo "Доллар - " . $dollar . "<br />";
echo "Евро - " . $euro . "<br />";
