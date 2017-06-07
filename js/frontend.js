jQuery( document ).on( 'click', '.remove', function() {
    var product_id = jQuery(this).attr("data-product_id");
	jQuery.ajax({
        type: 'POST',
		dataType: 'json',
		url: "/wp-admin/admin-ajax.php",
		data: { action: "product_remove", 
			product_id: product_id
		},success: function(data){
            jQuery('.mini_cart_item').html('Your cart is currently empty.');
            jQuery('.total').html('<strong>Subtotal:</strong><span class="woocommerce-Price-amount"><span class="woocommerce-Price-currencySymbol">&nbsp;$</span>0.00</span>');
            jQuery('.amount').html('$0.00');
            swal("Removed", "Cart is clean", "error"); 
        }
        
	});
	return false;
});

jQuery(document).ready(function($) {
    $('#site-header-cart').mouseover(function() {
});

$('.ajax_add_to_cart').click(function() {
    $('body').trigger("myEventAddCart");
}); 

$('body').on('myEventAddCart',function(e,data) {
    $(this).append('<a href="#TB_inline?inlineId=hidden_cart" id="show_hidden_cart" title="<h2>Cart</h2>" class="thickbox" style="display:none"></a>');
        // Some customization:
        var box = '';
        box += '<div class="widget_shopping_cart_content">';
        box += '<p>';
        box += '<h4>Product added to chart</h4>';
        box += '</p>';
        box += '<p class="buttons">';
        box += ' <a href="" onclick="javascript:tb_remove();return false;" class="button wc-forward">Continue Shopping</a>';
        box += ' <a href="/store/checkout/" class="button checkout wc-forward">Checkout</a>';
        box += '</p>';
        box += '</div>';
        
        $(this).append('<div id="hidden_cart" style="display:block">'+box+'</div>');
        $('#show_hidden_cart').click();
    });
});
