class DataGrepper {
    getProductsByType(url) {
        return $.ajax({
            url: url,
            method: "GET",
        });
    }
}