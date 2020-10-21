import {getJson} from "./functions";

$(".stepper-arrow.up").click(function() {
    let val = +this.previousElementSibling.getAttribute("value") || 0
    this.previousElementSibling.setAttribute("value", ++val)
    for (key in getJson) {
        if (this.getAttribute("data-id") == getJson[key].productId) {
            var priceGold = getJson[key].priceGold
            var priceGoldAlt = getJson[key].priceGoldAlt

            var price = getJson[key].priceRetail
            var priceAlt = getJson[key].priceRetailAlt
        }
    }
    this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[0].innerHTML = priceAlt*val
    this.parentNode.parentNode.parentNode.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.children[1].innerHTML = priceGoldAlt*val

})
$(".stepper-arrow.down").click(function() {
    let valMinus = this.parentNode.querySelector('input').getAttribute("value");
    if (valMinus > 0) {
        this.parentNode.querySelector('input').setAttribute("value", --valMinus)
    }
})
