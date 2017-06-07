<?php

/*
 * settings @description: All the functionality for AdditionalWoo Settings @since 1.0.0 @created: 06/06/17
 */
class AdditionalWooSettings
{
    /*
     * __construct @description: @since 1.0.0 @created: 06/06/17
     */
    function __construct($parent)
    {
		add_action('init', array($this, 'plugin_init'), 1);
		//add_action('woocommerce_add_cart_item_data', array($this, 'cart_boxed'),10);       
		//add_action('woocommerce_single_product_summary', array($this, 'cart_boxed'),10);
		add_action( 'woocommerce_cart_item_removed', array($this, 'cart_after_remove'), 10);
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_loop_add_to_cart', 30 );
		add_action( 'wp_ajax_product_remove', array($this,'product_remove') );
		add_action( 'wp_ajax_nopriv_product_remove', array($this,'product_remove') );
    }
	
	function plugin_init()
	{
		global $additionalwoo;
		// styles & js
		wp_enqueue_style('frontend.css', $additionalwoo->dir . '/css/frontend.css', null, '0.01');	
		wp_enqueue_script( 'fronten.js', $additionalwoo->dir . '/js/frontend.js', array("jquery") );
		
		// bootstrap
		wp_enqueue_style('bootstrap.min.css', $additionalwoo->dir . '/css/bootstrap.min.css', null, '3.3.7');
		wp_enqueue_style('bootstrap-theme.min.css', $additionalwoo->dir . '/css/bootstrap-theme.min.css', null, '3.3.7');
		wp_enqueue_script('bootstrap.min.js', $additionalwoo->dir . '/js/bootstrap.min.js', array("jquery"), '3.3.7');
		
		// bootstrap-sweetalert
		wp_enqueue_style('sweetalert.css', $additionalwoo->dir . '/css/sweetalert.css', null, '1.0');
		wp_enqueue_script('sweetalert.min.js', $additionalwoo->dir . '/js/sweetalert.min.js', array("jquery"), '0.01');

		add_thickbox();
	}
	
	function cart_boxed()
	{
		 //die('#Code1011');
	}

	function cart_after_remove() {
		//die('#Code1013');
	}

	function product_remove() {
		$cart = WC()->instance()->cart;
	    $id = $_POST['product_id'];
	    $cart_id = $cart->generate_cart_id($id);
	    $cart_item_id = $cart->find_product_in_cart($cart_id);

		if($cart_item_id){
		   $cart->set_quantity($cart_item_id,0);
		}
		return true;
		die();
	}
}

?>