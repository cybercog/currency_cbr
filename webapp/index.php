<?php

require_once('classes/CBR/Currency.php');
$cbrCurrency = new \CBR\Currency();
$out = $cbrCurrency->getData();

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
