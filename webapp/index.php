<?php

require_once('classes/CBR/Currency.php');
$cbrCurrency = new \CBR\Currency();
$out = $cbrCurrency->getData();

echo '<meta charset="utf-8" />';
echo '<h1>Курс валют на '.$cbrCurrency->getDate().'</h1>';
echo "<h2>Доллар - " . $cbrCurrency->getDollar() . "</h2>";
echo "<h2>Евро - " . $cbrCurrency->getEuro() . "</h2>";
