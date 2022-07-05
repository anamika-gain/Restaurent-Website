$(document).ready(function($) {
    // Declare the body variable
    var $body = $("body");

    // Function that shows and hides the sidebar cart
    $(".cart-button, .close-button, #sidebar-cart-curtain").click(function(e) {
        e.preventDefault();

        // Add the show-sidebar-cart class to the body tag
        $body.toggleClass("show-sidebar-cart");

        // Check if the sidebar curtain is visible
        if ($("#sidebar-cart-curtain").is(":visible")) {
            // Hide the curtain
            $("#sidebar-cart-curtain").fadeOut(500);
        } else {
            // Show the curtain
            $("#sidebar-cart-curtain").fadeIn(500);
        }
    });

    // Function that adds or subtracts quantity when a 
    // plus or minus button is clicked
    $body.on('click', '.plus-button, .minus-button', function() {
        // Get quanitity input values
        $('.plus-button').hide();
        $('.minus-button').hide();
        var qty = $(this).closest('.qty').find('.qty-input');
        var val = parseFloat(qty.val());
        var max = parseFloat(qty.attr('max'));
        var min = parseFloat(qty.attr('min'));
        var step = parseFloat(qty.attr('step'));

        var productId = qty.attr('productId');
        var productSizeId = qty.attr('productSizeId');
        var productOptionIds = qty.attr('productOptionIds');
        var productAddonIds = qty.attr('productAddonIds');
        var subCategoryAddonIds = qty.attr('subCategoryAddonIds');


        // Check which button is clicked
        if ($(this).is('.plus-button')) {
            // Increase the value
            qty.val(val + step);
        } else {
            // Check if minimum button is clicked and that value is 
            // >= to the minimum required
            if (min && min >= val) {
                // Do nothing because value is the minimum required
                qty.val(min);
            } else if (val > 0) {
                // Subtract the value
                qty.val(val - step);
            }
        }

        var productQuantity = qty.val();

        updateCartQuantity(productId, productSizeId, productOptionIds, productAddonIds, subCategoryAddonIds, productQuantity);

        //updateCartQuantity(qty.attr("id"), qty.val());

        $('.plus-button').show();
        $('.minus-button').show();
    });
});