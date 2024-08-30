/**
 * class for creating the Header inside of an AccordionItem
 */
class AccordionHeader {
    /**
     * constuctor
     * @param parentId - id of the AccordionItem to which the Header belongs
     */
    constructor(parentId) {
        this.parentId = parentId
        this.id = "header-" + parentId
    }

    /**
     * create an AccordionHeader:
     * 1. create a h2 HTML-Element with attributes
     * 2. create a button HTML-Element with attributes, needed for the accordion to work properly, set the caption of the button
     * 3. append the button to the header
     * 4. append the header to the AccordionItem it belongs to
     * @param caption - text that is displayed on the button of the AccordionItem
     */
    createHeader(caption) {
        let $header = $("<h2>", {"id": this.id, "class": "accordion-header"})
        let $button = $("<button>", {
            "class": "accordion-button collapsed",
            "type": "button",
            "data-bs-toggle": "collapse",
            "data-bs-target": "#collapse-" + this.parentId,
            "aria-expanded": "false",
            "aria-controls": "collapse-" + this.parentId
        });
        $button.html(caption)
        $($header).append($button)
        $("#" + this.parentId).append($header)
    }
}