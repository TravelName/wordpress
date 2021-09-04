<?php
/**
 * Description field of the comparison table.
 *
 * @package Neve_Pro\Modules\Woocommerce_Booster\Comparison_Table\Fields;
 */
namespace Neve_Pro\Modules\Woocommerce_Booster\Comparison_Table\Fields;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Field that provides show product description in comparison table functionality.
 */
class Description extends Abstract_Field {
	/**
	 * Field Label
	 *
	 * @var string
	 */
	protected $label = 'Description';

	/**
	 * Get field value of the product.
	 *
	 * @param  \WC_Product $product is product instance.
	 * @return void
	 */
	public function render( \WC_Product $product ) {
		echo wp_kses_post( $product->get_short_description() );
	}
}
