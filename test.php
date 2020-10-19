<?php

echo <<<HEADER
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Petrovich</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="misc/libs-8d0dd6b566.min.css">
    <link rel="stylesheet" type="text/css" href="misc/bundle-1732f80f0a.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
HEADER;

$file = file_get_contents('products.json');
$decode = json_decode($file, true);
//var_dump($decode);

//var_dump($decode[0]['assocProducts']);

//foreach ($decode as $key => $value) {
//    echo $decode[$key]['code'] . " \r\n" ;
//}

foreach ($decode as $key => $value) {
    $productId = $decode[$key]['productId'];
    $code = str_replace('00000', '', $decode[$key]['code']);
    $img_modificator = '_220x220_1';
    $primaryImageUrl = substr_replace($decode[$key]['primaryImageUrl'], $img_modificator, -4, -10 );
    $title = $decode[$key]['title'];
    $assocProducts = $decode[$key]['assocProducts'];
    $priceRetail = $decode[$key]['priceRetail'];
    $priceRetailAlt = $decode[$key]['priceRetailAlt'];
    $priceGold = $decode[$key]['priceGold'];
    $priceGoldAlt = $decode[$key]['priceGoldAlt'];
    echo $primaryImageUrl. "<br/>";


}

