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
    $img_modificator = '_220x220_1';
    $primaryImageUrl = substr_replace($decode[$key]['primaryImageUrl'], $img_modificator, -4, -10);
    $title = $decode[$key]['title'];
    $assocProducts = $decode[$key]['assocProducts'];
//    $priceRetailAlt = round($decode[$key]['priceRetailAlt'], 2) ;
//    $priceGoldAlt = round($decode[$key]['priceGoldAlt'],2) ;
    $priceRetailAlt = $decode[$key]['priceRetailAlt'];
    $priceGoldAlt = $decode[$key]['priceGoldAlt'];
    $priceRetail = $decode[$key]['priceRetail'];
    $priceGold = $decode[$key]['priceGold'];
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
                            <span class="goldPrice" id="$productId"> $priceGoldAlt</span>
                            <span class="rouble__i black__i">
                                <svg version="1.0" id="rouble__b" xmlns="http://www.w3.org/2000/svg" x="0" y="0" width="30px" height="22px" viewBox="0 0 50 50" enable-background="new 0 0 50 50" xml:space="preserve">
                                   <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#rouble_black"></use>
                                </svg>
                             </span>
                        </p>
                        <p class="product_price_default">
                            <span class="retailPrice">$priceRetailAlt</span>
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
                                    <input class="product__count stepper-input" type="number" value="1" data-id="$productId"  >
                                    <span is="click-counter" class="stepper-arrow up" data-id="$productId"></span>
                                    <span class="stepper-arrow down" data-id="$productId"></span>                                            
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
function getJsonData(){
    var jqXHR = $.ajax({
        url: "products.json",
        async: false});
    return $.parseJSON(jqXHR.responseText);
}
const getJson = getJsonData()

$(".unit--select").click(function() {
    let mainCondition = this.classList.contains("unit--active")
    if (mainCondition === false)   {
        let conditionPriceGold   = this.parentNode.parentNode.nextElementSibling.children[1].classList.contains("price--gold")
        let conditionPriceRetail = this.parentNode.parentNode.nextElementSibling.nextElementSibling.children[0].classList.contains("price")
        let currentId            = this.parentNode.parentNode.nextElementSibling.children[1].id
        let currentValue         = this.parentNode.parentNode.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.children[0].children[0].children[0].getAttribute("value")
        
        this.className += " unit--active"
        if (this.nextElementSibling != null) {
            this.nextElementSibling.classList.remove("unit--active")
        } else  {
            this.previousElementSibling.classList.remove("unit--active")
        }

        for (key in getJson) {
            if (currentId == getJson[key].productId) {
                var basePriceGold    = getJson[key].priceGold
                var basePriceGoldAlt = getJson[key].priceGoldAlt
                var basePrice        = getJson[key].priceRetail
                var basePriceAlt     = getJson[key].priceRetailAlt
            }
        }
        if (conditionPriceGold === false) {
            this.parentNode.parentNode.nextElementSibling.children[1].className += " price--gold"
            this.parentNode.parentNode.nextElementSibling.children[1].innerHTML = basePriceGold*currentValue
        }
        if (conditionPriceGold === true) {    
            this.parentNode.parentNode.nextElementSibling.children[1].classList.remove("price--gold")
            this.parentNode.parentNode.nextElementSibling.children[1].innerHTML = basePriceGoldAlt*currentValue
        }
        if (conditionPriceRetail === false) {
            this.parentNode.parentNode.nextElementSibling.nextElementSibling.children[0].className += " price"
            this.parentNode.parentNode.nextElementSibling.nextElementSibling.children[0].innerHTML = basePrice*currentValue
        }
        if (conditionPriceRetail === true) {
            this.parentNode.parentNode.nextElementSibling.nextElementSibling.children[0].classList.remove("price")
            this.parentNode.parentNode.nextElementSibling.nextElementSibling.children[0].innerHTML = basePriceAlt*currentValue
        }
    }
})

$(".stepper-arrow.up").click(function() {
    let val = +this.previousElementSibling.getAttribute("value") || 0
    this.previousElementSibling.setAttribute("value", ++val)
    let currentPriceGold = this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[1].textContent
    let currentPrice = this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[0].textContent
    // console.log(currentPrice)
    for (key in getJson) {
        if (this.getAttribute("data-id") == getJson[key].productId) {            
            var priceGoldAlt = getJson[key].priceGoldAlt
            var priceAlt = getJson[key].priceRetailAlt
        }
    }
    this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[0].innerHTML = priceAlt*val
    this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[1].innerHTML = priceGoldAlt*val

})
$(".stepper-arrow.down").click(function() {
    let val = this.parentNode.querySelector('input').getAttribute("value");
    let currentId = this.getAttribute("data-id")
    if (val > 0) {
        this.parentNode.querySelector('input').setAttribute("value", --val)
        this.parentNode.querySelector('input').innerHTML = val
    }    
    for (key in getJson) {
        if (currentId == getJson[key].productId) {
             var basePriceGold = getJson[key].priceGold
             var basePriceGoldAlt = getJson[key].priceGoldAlt
             var basePrice = getJson[key].priceRetail
             var basePriceAlt = getJson[key].priceRetailAlt 
        }
    }     
    let parent = this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[0]
    let unitActive = parent.querySelector(".unit--active")
    let condition  = unitActive.children[0].textContent
    if (condition === "За м. кв.") {
      this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[0].innerHTML = basePriceAlt*val
      this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[1].innerHTML = basePriceGoldAlt*val
  } else  {
      this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[0].innerHTML = basePrice*val
      this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[1].innerHTML = basePriceGold*val
  } 
})

$(".product__count.stepper-input").change(function() {            
  this.setAttribute("value", this.value)  
  let currentId = this.getAttribute("data-id")
  for (key in getJson) {
      if (currentId == getJson[key].productId)   {
          var basePriceGold = getJson[key].priceGold
          var basePriceGoldAlt = getJson[key].priceGoldAlt
          var basePrice = getJson[key].priceRetail
          var basePriceAlt = getJson[key].priceRetailAlt
      } 
  }
  let parent = this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[0]
  let unitActive = parent.querySelector(".unit--active")
  let condition  = unitActive.children[0].textContent
  if (condition === "За м. кв.") {
      this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[0].innerHTML = basePriceAlt*this.value
      this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[1].innerHTML = basePriceGoldAlt*this.value
  } else  {
      this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[0].innerHTML = basePrice*this.value
      this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[1].innerHTML = basePriceGold*this.value
  }   
})
</script>
</body>
SCRIPT;
?>
