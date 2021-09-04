<?php
/**
 * ...
 *
 * @package Neve_Pro\Modules\Woocommerce_Booster\Comparison_Table\View
 */
namespace Neve_Pro\Modules\Woocommerce_Booster\Comparison_Table\View;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Neve\Core\Settings\Mods;
use Neve_Pro\Modules\Woocommerce_Booster\Comparison_Table\Product_Fields;
use Neve_Pro\Modules\Woocommerce_Booster\Comparison_Table\Data_Store;
use Neve_Pro\Modules\Woocommerce_Booster\Comparison_Table\Functions;
use Neve_Pro\Modules\Woocommerce_Booster\Comparison_Table\Related_Products;
use Neve_Pro\Modules\Woocommerce_Booster\Module;
use WC_Product;

/**
 * ...
 */
class Table {
	const ENABLE_RELATED_PRODUCTS         = 'neve_comparison_table_enable_related_products';
	const IS_ALTERNATING_BG_COLOR_ENABLED = 'neve_comparison_table_enable_alternating_row_bg_color';
	const PRODUCT_LISTING_TYPE            = 'neve_comparison_table_product_listing_type';

	/**
	 * Is related product for comparison table enabled?
	 *
	 * @var bool
	 */
	private $is_related_products_enabled;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		$this->is_related_products_enabled = Mods::get( self::ENABLE_RELATED_PRODUCTS, false );

		add_action( 'neve_do_single_page', array( $this, 'show_choosen_page_content' ), 0 );
		add_filter( 'body_class', array( $this, 'add_comparison_table_class_to_body_classes' ) );
		add_filter( 'body_class', array( $this, 'add_woocommerce_class_to_body_classes' ) );
	}

	/**
	 * Show chosen page content
	 *
	 * @return void
	 */
	public function show_choosen_page_content() {
		global $post;

		if ( Mods::get( Module::MODS_COMPARISON_TABLE_TABLE_PAGE_ID, 0 ) !== $post->ID ) {
			return;
		}

		$this->render_comparison_products_table();
	}

	/**
	 * Output Remove Product Button
	 *
	 * @param  WC_Product $product WC_Product instance.
	 */
	private function render_remove_button( $product ) {
		printf( '<button value="%d" class="nv-ct-remove-product" type="button">×</button>', esc_html( (string) $product->get_id() ) );
	}

		/**
		 * Render for no products in the comparison table.
		 */
	private function render_no_product_in_the_table() {
		?>
			<span><?php esc_html_e( 'There are no products in your comparison list.', 'neve' ); ?></span>
		<?php
	}

	/**
	 * Render the comparison table.
	 *
	 * @param bool $related render with related products.
	 */
	public function render_comparison_products_table( $related = true ) {

		$comparison_table = new Data_Store();
		$total_product    = $comparison_table->get_total_product();
		$products         = $comparison_table->get_products();

		$mods_product_listing_type = Mods::get( self::PRODUCT_LISTING_TYPE, 'column' );

		if ( ! $total_product ) {
			$this->render_no_product_in_the_table();
			return;
		}

		wc_print_notices();

		echo '<span class="ct-byline">';
		/* translators: %s: product count */
		printf( esc_html__( 'You have %d product in the list', 'neve' ), esc_html( (string) $total_product ) );
		echo '</span>';

		$fields = ( new Product_Fields( $comparison_table ) )->get_available_fields();

		$table_classes = array( 'nv-ct' );

		if ( $this->should_the_table_be_wide( $fields, $mods_product_listing_type ) ) {
			$table_classes[] = 'nv-ct-wide';
		}

		// define class for table orientation
		if ( $mods_product_listing_type === 'row' ) {
			$table_classes[] = 'nv-ct-layout-row';
		} else {
			$table_classes[] = 'nv-ct-layout-column';

			$table_classes[] = sprintf( 'nv-ct-%s-product', $total_product );
		}

		// define class for striped table.
		if ( Mods::get( self::IS_ALTERNATING_BG_COLOR_ENABLED, 0 ) ) {
			$table_classes[] = 'nv-ct-striped-table';
		}
		?>
		<div class="nv-ct-container">
		<?php
			$this->render_table( $mods_product_listing_type, $table_classes, $fields, $products );

		if ( $this->is_related_products_enabled && $related ) {
			$this->render_related_products();
		}
		?>
		</div>
		<?php
	}

	/**
	 * Function that decide that table should be wide
	 *
	 * @param  array  $fields result of get_available_fields() function.
	 * @param  string $product_listing_type row or column.
	 * @return bool
	 */
	private function should_the_table_be_wide( $fields, $product_listing_type ) {
		if ( $product_listing_type === 'row' && $this->is_available_fields_contains( $fields, 'Description' ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Function that checks if the given field in the comparison table exists.
	 *
	 * @param  array  $fields result of get_available_fields() function.
	 * @param  string $searchable_field_class class name to search for.
	 * @return bool
	 */
	private function is_available_fields_contains( $fields, $searchable_field_class ) {
		foreach ( $fields as $field ) {
			if ( is_a( $field, 'Neve_Pro\Modules\Woocommerce_Booster\Comparison_Table\Fields\\' . $searchable_field_class ) ) {
				return true;
			}
		}

		return false;
	}

		/**
		 * View Table.
		 *
		 * @param  string $selected_tableview_option declares table orientation ( show products as row OR show products as column ).
		 * @param  array  $table_classes contains classes of the table tag.
		 * @param  array  $fields that fields of the comparison table.
		 * @param  array  $products that products of comparison table.
		 * @return void
		 */
	private function render_table( $selected_tableview_option, $table_classes, $fields, $products ) {
		?>
		<div class="nv-ct-table-wrap">
			<table table-layout="fixed" class='<?php echo esc_attr( implode( ' ', $table_classes ) ); ?>'>
				<?php
				if ( $selected_tableview_option === 'column' ) {
					$this->render_table_body_column( $fields, $products );
				} else {
					$this->render_table_body_row( $fields, $products );
				}
				?>
			</table>
		</div>
		<?php
	}

	/**
	 * Column Based View Table ( Shows products as column )
	 *
	 * @param  array $fields that fields of the comparison table.
	 * @param  array $products that products of comparison table.
	 * @return void
	 */
	private function render_table_body_column( $fields, $products ) {
		?>
			<thead>
				<tr>
					<th></th>
					<?php foreach ( $products as $product ) { ?>
						<td class="nv-ct-image-container">
							<div>
								<?php $this->render_remove_button( $product ); ?>
								<?php $this->render_product_image( $product ); ?>
							</div>
						</td>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php foreach ( $fields as $field ) { ?>
					<tr>
						<th><?php echo esc_html( ( $field->hide_table_title ) ? '' : $field->get_label() ); ?></th>
						<?php foreach ( $products as $product ) { ?>
							<td><?php $field->render( $product ); ?></td>
						<?php } ?>
					</tr>
				<?php } ?>
			</tbody>
		<?php
	}

	/**
	 * Row Based View Table ( Shows products as row )
	 *
	 * @param  array $fields that fields of the comparison table.
	 * @param  array $products that products of comparison table.
	 * @return void
	 */
	private function render_table_body_row( $fields, $products ) {
		?>
			<thead>
				<tr>
					<th colspan="2"></th>
					<?php foreach ( $fields as $field ) { ?>
						<th><?php echo esc_html( ( $field->hide_table_title ) ? '' : $field->get_label() ); ?></th>
					<?php } ?>
				</tr>
				</thead>
				<tbody>
				<?php foreach ( $products as $product ) { ?>
					<tr>
						<th><?php $this->render_remove_button( $product ); ?></th>
						<td class="nv-ct-image-container"><?php $this->render_product_image( $product ); ?></td>
						<?php foreach ( $fields as $field ) { ?>
							<td><?php $field->render( $product ); ?></td>
						<?php } ?>
					</tr>
				<?php } ?>
			</tbody>
		<?php
	}

	/**
	 * Print output of the given product's image.
	 *
	 * @param  WC_Product $product instance of WC_Product.
	 * @return void
	 */
	private function render_product_image( $product ) {
		?>
		<a href="<?php echo esc_url( $product->get_permalink() ); ?>"><img src="<?php echo esc_url( Functions::get_product_image_url( $product ) ); ?>" /></a>
		<?php
	}

	/**
	 * View Related Products of Comparison Table Products
	 */
	private function render_related_products() {
		// related product ids of comparison table products.
		$ct_datastore = new Data_Store();

		$related_product_ids = ( new Related_Products( $ct_datastore ) )->get_related_product_ids();

		$args = array(
			'columns'          => 4,
			'related_products' => array_map( 'wc_get_product', $related_product_ids ),
		);

		// set global loop values.
		wc_set_loop_prop( 'name', 'related' );
		wc_set_loop_prop( 'columns', (string) $args['columns'] );

		?>
		<div id="nv-ct-related-products">
			<?php
				wc_get_template( 'single-product/related.php', $args );
			?>
		</div>
		<?php
	}

	/**
	 * Add 'nv-ct-enabled' class to page body tag.
	 *
	 * @param array $classes that existing classes of the body.
	 * @return array
	 */
	public function add_comparison_table_class_to_body_classes( $classes ) {
		if ( $this->is_the_page_contains_comparison_table() || is_woocommerce() ) {
			$classes[] = 'nv-ct-enabled';
		}

		if ( $this->is_the_page_contains_comparison_table() ) {
			$classes[] = 'nv-ct-comparison-table-content';
		}

		return $classes;
	}

	/**
	 * Check if it is the current page contains comparison table?
	 *
	 * @return bool
	 */
	public function is_the_page_contains_comparison_table() {
		global $post;

		return is_a( $post, 'WP_Post' ) && ( Mods::get( Module::MODS_COMPARISON_TABLE_TABLE_PAGE_ID ) === $post->ID );
	}

	/**
	 * Add 'woocommerce' class to comparison table body tag.
	 *
	 * @param array $classes that existing classes of the body.
	 * @return array
	 */
	public function add_woocommerce_class_to_body_classes( $classes ) {
		if ( ! $this->is_the_page_contains_comparison_table() ) {
			return $classes;
		}

		return array_merge( $classes, array( 'woocommerce' ) );
	}
}
