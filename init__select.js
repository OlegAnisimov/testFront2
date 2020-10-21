function getJsonData(){
    var jqXHR = $.ajax({
        url: "products.json",
        async: false});

    return $.parseJSON(jqXHR.responseText);
}
const getJson = getJsonData()
// console.log(typeof getJson)
// let retailPriceAlt = getJson[0].priceRetailAlt
// let priceGoldAlt = getJson[0].priceGoldAlt
// let priceRetail = getJson[0].priceRetail
// let priceGold = getJson[0].priceGold
console.log()
$(".goldPrice").val
for (x in getJson) {
    let retailPriceAlt = getJson[x].priceRetailAlt
    let priceGoldAlt = getJson[x].priceGoldAlt
    let priceRetail = getJson[x].priceRetail
    let priceGold = getJson[x].priceGold
    // console.log(retailPriceAlt)
}

$(".unit--select").click(function() {
    let mainCondition = this.classList.contains("unit--active")
    if (mainCondition === false)   {
        this.className += " unit--active"
        let conditionPriceGold = this.parentNode.parentNode.nextElementSibling.children[1].classList.contains("price--gold")
        if (conditionPriceGold === false) {
            this.parentNode.parentNode.nextElementSibling.children[1].className += " price--gold"
            this.parentNode.parentNode.nextElementSibling.children[1].innerHTML = priceGold
        }
        if (conditionPriceGold === true) {
            this.parentNode.parentNode.nextElementSibling.children[1].classList.remove("price--gold")
            this.parentNode.parentNode.nextElementSibling.children[1].innerHTML = priceGoldAlt
        }

        if (this.nextElementSibling != null) {
            this.nextElementSibling.classList.remove("unit--active")
        } else  {
            this.previousElementSibling.classList.remove("unit--active")
        }
    }
})
