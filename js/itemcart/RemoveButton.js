class RemoveButton{

    constructor(productId, label){
        this.productId = productId;
        this.label = label;
        this.button = this.createButton();
    }

    createButton(){
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

    handleClick($button){
        let self = this;
        $button.on("click", function(){
            return $.ajax({
                url: "http://localhost/FEB_BEB/api/index.php?action=removearticle&articleId=" + self.productId,
                method: "GET",
            }).done(function (response){
                self.updateCartDependingOnResponse (response);
            }).fail(function(error){
                console.log("could not remove product from cart: " + error)
            })
        })
    }

    updateCartDependingOnResponse(response){
        $("#modal-title").html("Remove Product:");
        if(response.state == "OK"){
            $("#modal-text").html("Product successfully removed from Cart!");
            let $parent = $("#cart-item-list").parent().attr('id');
            $("#cart-item-list").remove();
            let cart = new EmbedItemCart();
            cart.buildCart($parent);
        }else{
            $("#modal-text").html("Product could not be removed from Cart!");
        }
    }

}