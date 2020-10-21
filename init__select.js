import {getJson} from "./functions";

$(".unit--select").click(function() {
    let mainCondition = this.classList.contains("unit--active")
    if (mainCondition === false)   {
        let conditionPriceGold = this.parentNode.parentNode.nextElementSibling.children[1].classList.contains("price--gold")
        let conditionPriceRetail = this.parentNode.parentNode.nextElementSibling.nextElementSibling.children[0].classList.contains("price")
        let currentId = this.parentNode.parentNode.nextElementSibling.children[1].id
        console.log(currentId)
        this.className += " unit--active"
        if (this.nextElementSibling != null) {
            this.nextElementSibling.classList.remove("unit--active")
        } else  {
            this.previousElementSibling.classList.remove("unit--active")
        }

        for (key in getJson) {
            if (currentId == getJson[key].productId) {
                var currentPriceGold = getJson[key].priceGold
                var currentPriceGoldAlt = getJson[key].priceGoldAlt

                var currentPrice = getJson[key].priceRetail
                var currentPriceAlt = getJson[key].priceRetailAlt
            }
        }
        if (conditionPriceGold === false) {
            this.parentNode.parentNode.nextElementSibling.children[1].className += " price--gold"
            this.parentNode.parentNode.nextElementSibling.children[1].innerHTML = currentPriceGold
        }
        if (conditionPriceGold === true) {
            this.parentNode.parentNode.nextElementSibling.children[1].classList.remove("price--gold")
            this.parentNode.parentNode.nextElementSibling.children[1].innerHTML = currentPriceGoldAlt
        }
        if (conditionPriceRetail === false) {
            this.parentNode.parentNode.nextElementSibling.nextElementSibling.children[0].className += " price"
            this.parentNode.parentNode.nextElementSibling.nextElementSibling.children[0].innerHTML = currentPrice
        }
        if (conditionPriceRetail === true) {
            this.parentNode.parentNode.nextElementSibling.nextElementSibling.children[0].classList.remove("price")
            this.parentNode.parentNode.nextElementSibling.nextElementSibling.children[0].innerHTML = currentPriceAlt
        }
    }
})
