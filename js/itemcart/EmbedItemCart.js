class EmbedItemCart {

    /*
    get cart data from backend via ajax
    after receiving data, remove list and build it again with updated data
     */
    buildCart(appendToId) {
        let self = this;
        $.ajax({
            url: "http://localhost/FEB_BEB/api/index.php?action=listcart",
            type: 'GET',
        }).done(function (response) {
            $("#cart-item-list").remove();
            let $list = $("<ul>", {"id": "cart-item-list"});
            self.getItemsInCart(response, $list);
            $('#' + appendToId).append($list);
        }).fail(function (error) {
            console.log("could not list cart: " + error);
        });
    }

    /*
    for every item in cart make a list element
    append buttons for add and remove item from cart
     */
    getItemsInCart(response, $list) {
        for (let item of Object.values(response.cart)) {
            let $visibleItem = $("<li>", {"id": item.articleId});
            $visibleItem.html(
                item.amount + " x " + item.articleName +
                " " + item.total + "€" + "\n"
            );
            let $addButton = new AddButton(item.articleId, "+");
            $visibleItem.append($addButton.button);
            let $removeButton = new RemoveButton(item.articleId, "-");
            $visibleItem.append($removeButton.button);
            $list.append($visibleItem);
        }
    }

}