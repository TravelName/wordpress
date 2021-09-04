<?php
/**
 * Name field of the comparison table.
 *
 * @package Neve_Pro\Modules\Woocommerce_Booster\Comparison_Table\Fields;
 */
namespace Neve_Pro\Modules\Woocommerce_Booster\Comparison_Table\Fields;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Field that provides show product rating in comparison table functionality.
 */
class Rating extends Abstract_Field {
	/**
	 * Field Label
	 *
	 * @var string
	 */
	protected $label = 'Rating';

	/**
	 * Get field value of the product.
	 *
	 * @param  \WC_Product $product is product instance.
	 * @return void
	 */
	public function render( \WC_Product $product ) {
		$rating = intval( $product->get_average_rating() );

		if ( $rating > 0 ) {
			?>
			<div style="float:left"><?php echo wp_kses_post( wc_get_rating_html( $rating ) ); ?></div>
			<?php
		} else {
			?>
			-
			<?php
		}
	}
}
