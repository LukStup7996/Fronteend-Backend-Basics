/**
 * class for creating the body inside of an AccordionItem
 */
class AccordionBody {
    /**
     * constructor:
     * @param parentId - id of the AccordionItem to which the body belongs
     */
    constructor(parentId, url) {
        this.parentId = parentId
        this.url = url;
    }

    /**
     * create an AccordionBody:
     * 1. create a div HTML-Element (collapse) with attributes, that is responsible for open and close the body
     * 2. create a div HTML-Element (accordionBody) with attributes and content to it
     * 3. append the accordionBody-div to the collapse-div
     * 4. append the collapse-div to the AccordionItem it belongs to
     * @param headerId - id of the accordionItems Header that the body belongs to
     */
    createBody(headerId) {
        let $collapse = $("<div>", {
            "id": "collapse-" + this.parentId,
            "class": "accordion-collapse collapse",
            "aria-labelledby": headerId,
            "data-bs-parent": "#productsAccordion"
        });
        let $accordionBody = $("<div>", {"class": "accordion-body"});
        let $container = $("<div>", {"class": "container"})
        this.appendProducts($container);
        $accordionBody.append($container);
        $collapse.append($accordionBody)
        $("#" + this.parentId).append($collapse);
    }

    appendProducts(appendToElement) {
        let datagrepper = new DataGrepper();
        let promise = datagrepper.getProductsByType(this.url);
        promise.done((response) => {

            //function for displaying products
            for (let product of response.products) {
                let displayProducts = new DisplayProducts(product);
                let itemToHTMLElement = displayProducts.createProductForm();
                appendToElement.append(itemToHTMLElement);
            }
        });
    }
}