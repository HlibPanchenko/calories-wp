jQuery(document).ready(function($) {
    // Get the modal
    var modal = $("#reset-modal");

    // Get the button that opens the modal
    var btn = $("#btn-to-renew");

    // Get the <span> element that closes the modal
    var span = $(".modal-reset_close").first();

    // When the user clicks on the button, open the modal and disable scrolling
    btn.click(function() {
        modal.show();
        $("body").addClass("no-scroll");
    });

    // When the user clicks on <span> (x) or outside the modal, close the modal and enable scrolling
    function closeModal() {
        modal.hide();
        $("body").removeClass("no-scroll");
    }

    span.click(closeModal);

    $(window).click(function(event) {
        if ($(event.target).is(modal)) {
            closeModal();
        }
    });
});
