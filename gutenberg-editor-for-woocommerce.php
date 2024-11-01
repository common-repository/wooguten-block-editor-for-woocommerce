<?php
/**
 * Plugin Name: WooGuten - Block Editor for WooCommerce
 * Plugin URI: #
 * Description: Enable/Disable Gutenberg Editor for WooCommerce Products
 * Version: 0.9.0
 * Author: web-lodge
 * Author URI: https://web-lodge.com
 * Text Domain: wc-gutenberg
 * Domain Path: /languages
 * Copyright 2019 web-lodge.com. All rights reserved.
 * Tested up to: 5.3
 * WC tested up to: 3.6.2
 **/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 
 */
class WCGE_WC_Gutenberg_Editor{
	
	function __construct(){
		add_filter('use_block_editor_for_post_type', array($this, 'wcge_activate_gutenberg_products'), 99, 2);

		add_action( 'admin_enqueue_scripts', array($this, 'wcge_admin_scripts'), 10 );

		add_filter( 'woocommerce_taxonomy_args_product_cat', array($this, 'wcge_product_cat_allow_rest') );
		add_filter( 'woocommerce_taxonomy_args_product_tag', array($this, 'wcge_product_cat_allow_rest') );
	}

	function wcge_activate_gutenberg_products($can_edit, $post_type){
		if($post_type == 'product'){
			$can_edit = true;
		}
		
		return $can_edit;
	}
	
	function wcge_admin_scripts() {
		$screen       = get_current_screen();
		$screen_id    = $screen ? $screen->id : '';
		if ( in_array( $screen_id, array( 'product', 'edit-product' ) ) ) {
			wp_enqueue_script('wcge_admin_script', plugin_dir_url( __FILE__ ) . '/assets/js/admin.js', array('jquery', 'postbox','wc-admin-product-meta-boxes'), '0.9.0', true );

		}
	}
	
	function wcge_product_cat_allow_rest( $args ) {
	    $args['show_in_rest'] = true;
	    return $args;
	}
}

new WCGE_WC_Gutenberg_Editor();