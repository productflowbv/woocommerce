<?php

require_once( plugin_dir_path( __FILE__ ) . 'class-productflow-base-class.php' );

class ProductFlow {

	/**
	 * Constructor
	 */
	public function __construct( $pluginPath ) {
		$this->pluginPath = $pluginPath; // set path of main plugin file for hook reference
		/**
		 * Check if WooCommerce is active
		 **/
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			// Run plugin code
			add_action( 'admin_enqueue_scripts', array( $this, 'include_styles' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'include_scripts' ) );
			$this->includes();
			$this->init_classes();
		}
	}

	/**
	 * Include the necessary files, so we can use them in this class.
	 */
	public function includes() {
		require_once( plugin_dir_path( __FILE__ ) . 'class-productflow-admin.php' );
		require_once( plugin_dir_path( __FILE__ ) . 'class-productflow-filters.php' );
	}

	/**
	 * Instantiate all necessary classes
	 */
	public function init_classes() {
		new ProductFlow_Admin();
	}

	public function include_scripts() {
		//dont remove
	}

	public function include_styles() {
		//dont remove
	}

}