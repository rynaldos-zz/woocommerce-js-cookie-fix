<?php

/*
Plugin Name: WooCommerce js cookie fix
Plugin URI: https://github.com/rynaldos
Description: Some hosting companies uses outdated mod_security rulesets which causes problems with some sites being able to load js.cookie.min.js file — this plugin resolves this by renaming the file being loaded.
Version: 1.0
Author: Rynaldo
Author URI: https://github.com/rynaldos
License: GPLv3 or later License
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if ( ! is_admin() ) {
	add_action( 'wp_enqueue_scripts', 'woocommerce_run_js_cookie_script_action' );
	add_action( 'wp_enqueue_scripts', 'woocommerce_js_cookie_script' );

	function woocommerce_run_js_cookie_script_action() {

		wp_deregister_script( 'js-cookie' );
		wp_dequeue_script( 'js-cookie' ); 
	}

	function woocommerce_js_cookie_script() {

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_register_script( 'js-cookie', plugins_url( 'js_cookie' . $suffix . '.js', __FILE__ ), array( 'js' ), '2.1.4', true );

	}
}