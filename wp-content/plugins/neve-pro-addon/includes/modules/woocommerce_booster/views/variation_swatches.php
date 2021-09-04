<?php
/**
 *  Class that add variation swatches functionalities.
 *
 * @package Neve_Pro\Modules\Woocommerce_Booster\Views
 */

namespace Neve_Pro\Modules\Woocommerce_Booster\Views;

use Neve\Views\Base_View;

/**
 * Class Variation_Swatches
 *
 * @package Neve_Pro\Modules\Woocommerce_Booster\Views
 */
class Variation_Swatches extends Base_View {

	/**
	 * Initialize the module.
	 */
	public function init() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'after_setup_theme', array( $this, 'define_public_hooks' ) );
	}

	/**
	 * Enqueue public scripts.
	 */
	public function enqueue_scripts() {
		wp_register_style(
			'nv-vswatches-style',
			NEVE_PRO_INCLUDES_URL . 'modules/woocommerce_booster/variation_swatches/css/style.min.css',
			array(),
			NEVE_PRO_VERSION
		);
		wp_style_add_data( 'nv-vswatches-style', 'rtl', 'replace' );
		wp_style_add_data( 'nv-vswatches-style', 'suffix', '.min' );

		wp_enqueue_style( 'nv-vswatches-style' );
	}

	/**
	 * Define public hooks.
	 */
	public function define_public_hooks() {
		add_filter( 'woocommerce_dropdown_variation_attribute_options_html', array( $this, 'swatches_display' ), 100, 2 );
	}

	/**
	 * Function that manages variation swatches display.
	 *
	 * @param string $html Swatches html code.
	 * @param array  $args Swatches arguments.
	 *
	 * @return string
	 */
	public function swatches_display( $html, $args ) {

		if ( ! array_key_exists( 'attribute', $args ) ) {
			return $html;
		}

		$type = $this->get_attribute_type( $args['attribute'] );
		if ( $type === false || $type === 'select' ) {
			return $html;
		}

		if ( in_array( $type, [ 'color', 'label', 'image' ], true ) ) {
			return $this->render_swatches( $html, $args, $type );
		}
		return $html;
	}

	/**
	 * Render variation swatches.
	 */
	private function render_swatches( $html, $args, $type ) {
		$options   = $args['options'];
		$attribute = $args['attribute'];
		$product   = $args['product'];
		$id        = $args['id'] ? $args['id'] : sanitize_title( $attribute );
		$markup    = '<div class="nv-variation-container">';
		$markup   .= $html;

		if ( empty( $options ) ) {
			return $html;
		}
		if ( empty( $product ) ) {
			return $html;
		}

		$terms   = wc_get_product_terms( $product->get_id(), $attribute, array( 'fields' => 'all' ) );
		$markup .= '<ul class="nv-vswatches-wrapper variation-' . esc_attr( $type ) . '">';

		foreach ( $terms as $term ) {
			if ( ! in_array( $term->slug, $options, true ) ) {
				continue;
			}

			$term_value = get_term_meta( $term->term_id, 'product_' . $attribute, true );
			$name       = esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name ) );

			$item_classes   = array();
			$item_classes[] = sanitize_title( $args['selected'] ) === $term->slug ? 'nv-vswatch-active' : '';
			$item_classes[] = $type;
			$item_classes[] = empty( $term_value ) ? 'nv-vswatch-empty' : '';

			$markup .= '<li class="nv-vswatch-item ' . esc_attr( implode( ' ', $item_classes ) ) . '"  data-value="' . esc_attr( $term->slug ) . '" title="' . esc_attr( $name ) . '" data-attribute_name="attribute_' . esc_attr( $id ) . '">';
			if ( $type === 'color' ) {
				$markup .= '<span class="nv-vswatch-overlay"></span>';
				if ( ! empty( $term_value ) ) {
					$markup .= '<span class="nv-vswatch-color" style="background-color: ' . esc_attr( $term_value ) . '"></span>';
				}
			}
			if ( $type === 'image' ) {
				$markup .= '<span class="nv-vswatch-overlay"></span>';
				if ( ! empty( $term_value ) ) {
					$markup .= '<img class="nv-vswatch-image" src="' . esc_url( $term_value ) . '">';
				}
			}
			if ( $type === 'label' ) {
				$term_value = empty( $term_value ) ? $name : $term_value;
				$markup    .= '<label class="nv-vswatch-label">' . wp_kses_post( $term_value ) . '</label>';
			}
			$markup .= '</li>';
		}
		$markup .= '</ul>';
		$markup .= '</div>';

		return $markup;
	}

	/**
	 * Get attribute type.
	 *
	 * @param string $attribute Attribute name.
	 *
	 * @return false | string
	 */
	private function get_attribute_type( $attribute ) {
		$attribute_taxonomies = wc_get_attribute_taxonomies();
		if ( ! taxonomy_exists( $attribute ) ) {
			return false;
		}

		$taxonomy_object = array_filter(
			$attribute_taxonomies,
			static function ( $taxonomy ) use ( $attribute ) {
				return $attribute === 'pa_' . $taxonomy->attribute_name;
			}
		);

		$taxonomy_object = array_pop( $taxonomy_object );
		if ( ! empty( $taxonomy_object ) && property_exists( $taxonomy_object, 'attribute_type' ) ) {
			return $taxonomy_object->attribute_type;
		}

		return false;
	}

}
