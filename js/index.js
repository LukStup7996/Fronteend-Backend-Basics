$(document).ready(function () {
    $.ajax({
        url: "http://localhost/FEB_BEB/api/index.php?action=listTypes",
        method: "GET",
    }).done(function (response) {
        for (let item of response) {
            let accordionItem = new AccordionItem(item.productType, "#productsAccordion", item.url);
            accordionItem.createAccordionItem();
        }
    }).fail(function (error) {
        console.log("error: " + error);
    }).always(function () {

    });
});

let navigation = new Navigation();
navigation.navigationControll();

// create a new cart in div with id cart-output
let cart = new EmbedItemCart();
cart.buildCart("cart-output");





