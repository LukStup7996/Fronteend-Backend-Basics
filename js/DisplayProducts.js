class DisplayProducts {
    constructor(product) {
        this.product = product;
    }

    createProductForm() {
        const $divCol = $('<div class="col"></div>')
        const $divCard = $('<div class="card text-smaller"></div>')
        const $img = this.getImage()
        const $divCardBody = $('<div class="card-body"></div>')
        const $h5CardTitle = $('<h5 class="card-title">' + this.product.name.substring(0, 10) + '</h5>')
        const $divCardText = $('<p class="card-text">' + this.product.name + '</p>')
        const $addButton = new AddButton(this.product.id, "Add to Cart");

        $divCard.append($img)
        $divCardBody.append($h5CardTitle)
        $divCardBody.append($divCardText)
        $divCardBody.append($addButton.button)
        $divCard.append($divCardBody)

        return $divCol.append($divCard)

    }

    getImage() {
        return $("<img src='img/" + this.product.id + ".png' />")
    }
}