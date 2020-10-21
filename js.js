// получение данных из json
function getJsonData(){
    var jqXHR = $.ajax({
        url: "products.json",
        async: false});
    return $.parseJSON(jqXHR.responseText);
}
const getJson = getJsonData()
// Обработка изменения типа тары
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
// обработка кликов по стрелкам, изменение кол-ва товара
$(".stepper-arrow.up").click(function() {
    let val = +this.previousElementSibling.getAttribute("value") || 0
    let currentId = this.getAttribute("data-id")
    this.previousElementSibling.setAttribute("value", ++val)
    this.previousElementSibling.value = val

    for (key in getJson) {
        if (currentId == getJson[key].productId) {
            var basePriceGold    = getJson[key].priceGold
            var basePriceGoldAlt = getJson[key].priceGoldAlt
            var basePrice        = getJson[key].priceRetail
            var basePriceAlt     = getJson[key].priceRetailAlt
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
$(".stepper-arrow.down").click(function() {
    let val = this.parentNode.querySelector('input').getAttribute("value");
    let currentId = this.getAttribute("data-id")
    if (val > 0) {
        this.parentNode.querySelector('input').setAttribute("value", --val)
        this.previousElementSibling.previousElementSibling.value = val
    }
    for (key in getJson) {
        if (currentId == getJson[key].productId) {
            var basePriceGold    = getJson[key].priceGold
            var basePriceGoldAlt = getJson[key].priceGoldAlt
            var basePrice        = getJson[key].priceRetail
            var basePriceAlt     = getJson[key].priceRetailAlt
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
// обработка изменения значения инпута с кол-вом товара
$(".product__count.stepper-input").change(function() {
    this.setAttribute("value", this.value)
    let currentId = this.getAttribute("data-id")
    for (key in getJson) {
        if (currentId == getJson[key].productId)   {
            var basePriceGold     = getJson[key].priceGold
            var basePriceGoldAlt  = getJson[key].priceGoldAlt
            var basePrice         = getJson[key].priceRetail
            var basePriceAlt      = getJson[key].priceRetailAlt
        }
    }
    let parent     = this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[0]
    let unitActive = parent.querySelector(".unit--active")
    let condition  = unitActive.children[0].textContent
    if (condition  === "За м. кв.") {
        this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[0].innerHTML = basePriceAlt*this.value
        this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[1].innerHTML = basePriceGoldAlt*this.value
    } else  {
        this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[0].innerHTML = basePrice*this.value
        this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[1].innerHTML = basePriceGold*this.value
    }
})
