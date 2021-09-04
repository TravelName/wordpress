<?php
/**
 * Class that manages options of the Comparison Table feature.
 *
 * @package Neve_Pro\Modules\Woocommerce_Booster\Comparison_Table
 */
namespace Neve_Pro\Modules\Woocommerce_Booster\Comparison_Table;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Neve_Pro\Modules\Woocommerce_Booster\Comparison_Table;
use Neve\Core\Settings\Mods;

/**
 * Class Options
 */
class Options {
	const MODS_COMPARISON_TABLE_OPEN_POPUP_PRODUCT_LIMIT = 'neve_comparison_table_open_popup_product_limit';
	const MODS_COMPARISON_TABLE_NUMBER_OF_PRODUCTS_LIMIT = 'neve_comparison_table_number_of_products_limit';
	
	/**
	 * That specify if the module is activated on Neve Pro extra features tab.
	 *
	 * @return bool
	 */
	public static function is_module_activated() {
		return get_option( 'nv_pro_enable_comparison_table', false );
	}

	/**
	 * Get neve_comparison_table_number_of_products_limit theme mod as normalized.
	 *
	 * @return int
	 */
	public static function get_number_of_products_limit() {
		$number_of_products_limit = Mods::get( self::MODS_COMPARISON_TABLE_NUMBER_OF_PRODUCTS_LIMIT, 3 );

		if ( $number_of_products_limit > 4 || $number_of_products_limit < 2 ) {
			return 3;
		}

		return $number_of_products_limit;
	}

	/**
	 * Get neve_comparison_table_open_popup_product_limit theme mod as normalized.
	 *
	 * @return int
	 */
	public static function get_open_popup_product_limit() {
		$open_popup_product_limit = Mods::get( self::MODS_COMPARISON_TABLE_OPEN_POPUP_PRODUCT_LIMIT, 3 );

		if ( $open_popup_product_limit > 4 || $open_popup_product_limit < 2 ) {
			return 3;
		}

		return $open_popup_product_limit;
	}
}
