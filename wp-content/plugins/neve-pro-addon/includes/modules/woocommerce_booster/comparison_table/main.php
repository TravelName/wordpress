<?php
/**
 * Main class of the Comparison Table.
 *
 * @package Neve_Pro\Modules\Woocommerce_Booster\Comparison_Table
 */
namespace Neve_Pro\Modules\Woocommerce_Booster\Comparison_Table;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Options
 */
class Main {
	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ) );

		$this->register_views();

		$this->init_activation();

		add_filter( 'woocommerce_continue_shopping_redirect', array( $this, 'update_continue_shopping_redirect_url' ) );
	}

	/**
	 * If the user coming by click the add to cart button in comparison table iframe, Update the Continue Shopping Redirect URL. (Redirect the user to parent window url of the comparison table.)
	 * This method updates the 'continue shopping' button that in the cart url.
	 *
	 * @param  string $current_target that current target url of the continue shopping button.
	 * @return string
	 */
	public function update_continue_shopping_redirect_url( $current_target ) {
		$url_parts = wp_parse_url( $current_target );

		// if the current target url is invalid, return to shop url for continue shopping url
		if ( ! isset( $url_parts['query'] ) ) {
			return get_permalink( wc_get_page_id( 'shop' ) );
		}

		parse_str( $url_parts['query'], $url_query );

		// find the parent window url of the iframe and return to this as continue shopping url
		if ( isset( $url_query['comparison-table-iframe'] ) && isset( $url_query['parent-window-url'] ) ) {
			return $url_query['parent-window-url'];
		}

		return $current_target;
	}

	/**
	 * Comparison Table Module Activation Processes.
	 *
	 * @return void
	 */
	public function init_activation() {
		new \Neve_Pro\Modules\Woocommerce_Booster\Comparison_Table\Activation();
	}

	/**
	 * Load View Classes of the Comparison Table.
	 *
	 * @return void
	 */
	public function register_views() {
		$view_classes = array(
			'Table',
			'Sticky_Bar',
			'Single_Product',
			'Catalog',
		);

		foreach ( $view_classes as $view_class ) {
			$path = 'Neve_Pro\Modules\Woocommerce_Booster\Comparison_Table\View\\' . $view_class;
			new $path();
		}
	}

	/**
	 * Load Comparison Table Assets
	 *
	 * @return void
	 */
	public function register_assets() {
		wp_enqueue_style( 'nv-ct-style', NEVE_PRO_INCLUDES_URL . 'modules/woocommerce_booster/comparison_table/assets/css/style.min.css', array(), NEVE_PRO_VERSION );
		wp_enqueue_script( 'nv-ct-script', NEVE_PRO_INCLUDES_URL . 'modules/woocommerce_booster/comparison_table/assets/js/script.js', array(), NEVE_PRO_VERSION, true );
	}
}
