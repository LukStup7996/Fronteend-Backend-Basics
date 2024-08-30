class Navigation {
    navigationControll() {
        const $allocateSpace = $("#nav-bar");

        const $linkButtonArea = $("<nav>", {"class": "nav"});
        const $navShop = $("<a>", {
            "class": "nav-link active",
            "aria-current": "page", "href": "index.html"
        });
        $navShop.html("Shop");
        $linkButtonArea.append($navShop);
        const $navCart = $("<a>", {"class": "nav-link", "href": "cartIndex.html"});
        $navCart.html("Cart");
        $linkButtonArea.append($navCart);
        $allocateSpace.append($linkButtonArea);

    }
}