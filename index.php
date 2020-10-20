<?php
echo <<<HEADER
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Petrovich</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="misc/libs-8d0dd6b566.min.css">
    <link rel="stylesheet" type="text/css" href="misc/bundle-1732f80f0a.min.css">    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
HEADER;

$file = file_get_contents('products.json');
$decode = json_decode($file, true);

foreach ($decode as $key => $value) {
    $productId = $decode[$key]['productId'];
    $code = str_replace('00000', '', $decode[$key]['code']);
//    $primaryImageUrl =  $decode[$key]['primaryImageUrl'];
    $img_modificator = '_220x220_1';
    $primaryImageUrl = substr_replace($decode[$key]['primaryImageUrl'], $img_modificator, -4, -10);
    $title = $decode[$key]['title'];
    $assocProducts = $decode[$key]['assocProducts'];
    $priceRetail = $decode[$key]['priceRetail'];
    $priceRetailAlt = $decode[$key]['priceRetailAlt'];
    $priceGold = $decode[$key]['priceGold'];
    $priceGoldAlt = $decode[$key]['priceGoldAlt'];
    echo <<<PRODUCT_TEMPLATE
    <body> 
        <main> 

        <div id="products_section">
            <div class="products_page pg_0">
                <div class="product product_horizontal">                                
                    <span class="product_code">$code</span>
                    <div class="product_status_tooltip_container">
                        <span class="product_status">Наличие ??? </span>
                    </div>                                
                    <div class="product_photo">
                        <a href="#" class="url--link product__link">
                            <img src="$primaryImageUrl">
                        </a>                                    
                    </div>
                    <div class="product_description">
                        <a href="#" class="product__link">$title</a>
                    </div>
                    <div class="product_tags hidden-sm">
                        <p>Могут понадобиться:</p>
                       <a href="#" class="url--link">$assocProducts,</a>
                    </div>
                    <div class="product_units">
                        <div class="unit--wrapper">
                            <div class="unit--select unit--active">
                                <p class="ng-binding">За м. кв.</p>
                            </div>
                            <div class="unit--select">
                                <p class="ng-binding">За упаковку</p>
                            </div>
                        </div>
                    </div>
                        <p class="product_price_club_card">
                            <span class="product_price_club_card_text">По карте<br>клуба</span>
                            <span class="goldPrice">$priceGold</span>
                            <span class="rouble__i black__i">
                                <svg version="1.0" id="rouble__b" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="30px" height="22px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
                                   <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#rouble_black"></use>
                                </svg>
                             </span>
                        </p>
                        <p class="product_price_default">
                            <span class="retailPrice">$priceRetail</span>
                            <span class="rouble__i black__i">
                                <svg version="1.0" id="rouble__g" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="30px" height="22px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
                                   <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#rouble_gray"></use>
                                </svg>
                             </span>
                        </p>
                        <div class="product_price_points">
                            <p class="ng-binding">Можно купить за 231,75 балла</p>
                        </div>
                        <div class="list--unit-padd"></div>
                        <div class="list--unit-desc">
                            <div class="unit--info">
                                <div class="unit--desc-i"></div>
                                <div class="unit--desc-t">
                                    <p>
                                        <span class="ng-binding">Продается упаковками:</span>
                                        <span class="unit--infoInn">1 упак. = 2.47 м. кв. </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="product__wrapper">
                            <div class="product_count_wrapper">
                                <div class="stepper">
                                    <input class="product__count stepper-input" type="number" value="1"  >
                                    <span is="click-counter" class="stepper-arrow up"></span>
                                    <span class="stepper-arrow down"></span>                                            
                                </div>
                            </div>
                            <span class="btn btn_cart" data-url="/cart/" data-product-id="$productId">
                                <svg class="ic ic_cart">
                                   <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#cart"></use>
                                </svg>
                                <span class="ng-binding">В корзину</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
    </main>
 
          
PRODUCT_TEMPLATE;
}
echo <<<SCRIPT
<script >
//   Замыкания
$(".stepper-arrow.up").click(function() {
  let val = +this.previousElementSibling.getAttribute("value") || 0
  this.previousElementSibling.setAttribute("value", ++val)
})
 
$(".stepper-arrow.down").click(function() {
    let valMinus = this.parentNode.querySelector('input').getAttribute("value");
    if (valMinus > 0) {        
        this.parentNode.querySelector('input').setAttribute("value", --valMinus)
         }   
    })  
</script>

<script >
$(".product__count.stepper-input").change(function() {
  this.setAttribute("value", this.value)  
})
</script>
<!--<script >-->
<!--$(".unit&#45;&#45;select").click(function() {    -->
<!--    console.log("fff")-->
<!--    // this.classList.add("unit&#45;&#45;active")-->
<!--    this.className += " unit&#45;&#45;active"-->
<!--    this.previousElementSibling.classList.remove("unit&#45;&#45;active")-->
<!--})-->
<!--</script>-->

<script>
$(".unit--select").click(function() {
    let condition = this.classList.contains("unit--active")
    console.log(condition)
    if (condition === false)   {
        this.className += " unit--active"
        if (this.nextElementSibling != null) {
            this.nextElementSibling.classList.remove("unit--active")
        } else  {
            this.previousElementSibling.classList.remove("unit--active")
        }
    }          
})
</script>
</body>
SCRIPT;

?>
