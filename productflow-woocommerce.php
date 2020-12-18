<?php
/**
 * Plugin Name: ProductFlow Woocommerce
 * Plugin URI: https://www.productflow.com
 * Description:
 * Version: 1.0
 * Author: ProductFlow
 * Author URI: https://www.productflow.com
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

//Autoload all classes
require_once plugin_dir_path( __FILE__ ) . 'admin/class-productflow.php';

/**
 * Begins execution of the plugin.
 */
function run_productflow() {
	$plugin = new ProductFlow( __FILE__ );
}

run_productflow();
