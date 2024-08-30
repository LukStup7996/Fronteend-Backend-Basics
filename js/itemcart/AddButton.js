class AddButton {
    constructor(productId, label) {
        this.productId = productId;
        this.label = label;
        this.button = this.createButton();
    }

    /*
    create a new button element with given label, set the on click event
     */
    createButton() {
        let $button = $('<button>', {
            "class": "btn btn-secondary btn-sm",
            "type": "button",
            "data-bs-toggle": "modal",
            "data-bs-target": "#addProductModal"
        });
        $button.html(this.label);
        this.handleClick($button);
        return $button;
    }

    /*
    when clicked on button, add an element to cart via ajax
     */
    handleClick($button) {
        let self = this;
        $button.on("click", function () {
            return $.ajax({
                url: "http://localhost/FEB_BEB/api/index.php?action=addarticle&articleId=" + self.productId,
                method: "GET",
            }).done(function (response) {
                self.updateCartDependingOnResponse(response);
            }).fail(function (error) {
                console.log("could not add product to cart: " + error)
            })
        })
    }

    /*
    send message to modal, depending on response (OK/ERROR)
    search for the parent element of the current cart list
    remove the list and build a new one with the same parent
     */
    updateCartDependingOnResponse(response){
        $("#modal-title").html("Add Product:");
        if(response.state === "OK"){
            $("#modal-text").html("Product successfully added to Cart!");
            let $parent = $("#cart-item-list").parent().attr('id');
            $("#cart-item-list").remove();
            let cart = new EmbedItemCart();
            cart.buildCart($parent);
        }else{
            $("#modal-text").html("Product could not be added to Cart!");
        }
    }
}