<?php
/**
 * Author:          Andrei Baicus <andrei@themeisle.com>
 * Created on:      2019-02-11
 *
 * @package Neve Pro
 */

namespace Neve_Pro\Modules\Woocommerce_Booster;

use Neve_Pro\Core\Abstract_Module;
use Neve\Core\Settings\Mods;
use Neve_Pro\Modules\Woocommerce_Booster\Comparison_Table\Options;

/**
 * Class Module
 *
 * @package Neve_Pro\Modules\Woocommerce_Booster
 */
class Module extends Abstract_Module {

	const MODS_COMPARISON_TABLE_DISPLAY_TYPE  = 'neve_comparison_table_view_type';
	const MODS_COMPARISON_TABLE_TABLE_PAGE_ID = 'neve_comparison_table_page_id';

	/**
	 * Holds the base module namespace
	 * Used to load submodules.
	 *
	 * @var string $module_namespace
	 */
	private $module_namespace = 'Neve_Pro\Modules\Woocommerce_Booster';

	/**
	 * Return comparison page url.
	 *
	 * @return string Comparison url.
	 */
	public static function get_comparison_link() {

		$page_id = Mods::get( self::MODS_COMPARISON_TABLE_TABLE_PAGE_ID, 0 );
		if ( $page_id < 1 ) {
			return '';
		}
		if ( ! get_post( $page_id ) instanceof \WP_Post ) {
			return '';
		}

		return get_page_link( $page_id );

	}

	/**
	 * Define module properties.
	 *
	 * @access  public
	 * @return void
	 *
	 * @version 1.0.0
	 */
	public function define_module_properties() {
		$this->slug              = 'woocommerce_booster';
		$this->name              = __( 'WooCommerce Booster', 'neve' );
		$this->description       = __( 'Empower your online store with awesome new features, specially designed for a smooth WooCommerce integration.', 'neve' );
		$this->documentation     = array(
			'url'   => 'https://docs.themeisle.com/article/1058-woocommerce-booster-documentation',
			'label' => __( 'Learn more', 'neve' ),
		);
		$this->order             = 2;
		$this->dependent_plugins = array(
			'woocommerce' => array(
				'path' => 'woocommerce/woocommerce.php',
				'name' => 'WooCommerce',
			),
		);
		$this->has_dynamic_style = true;
		$this->min_req_license   = 2;

		$options = array(
			'enable_cart_notices'       => array(
				'label'             => __( 'Enable Multi-Announcement Bars', 'neve' ),
				'documentation'     => [
					'url'   => 'https://bit.ly/neve-woo-mab',
					'label' => __( 'Learn More', 'neve' ),
				],
				'type'              => 'toggle',
				'default'           => true,
				'show_in_rest'      => true,
				'sanitize_callback' => function ( $value ) {
					return is_bool( $value ) ? $value : false;
				},
			),
			'enable_variation_swatches' => array(
				'label'             => esc_html__( 'Enable variation swatches', 'neve' ),
				'type'              => 'toggle',
				'default'           => true,
				'documentation'     => [
					'url'   => 'https://bit.ly/neve-woo-vs',
					'label' => 'Learn more',
				],
				'sanitize_callback' => function ( $value ) {
					return is_bool( $value ) ? $value : false;
				},
			),
		);

		if ( neve_pro_is_new_skin() ) {
			$options['enable_comparison_table'] = array(
				'label'             => __( 'Enable Comparison Table', 'neve' ),
				'type'              => 'toggle',
				'documentation'     => [
					'url'   => 'https://bit.ly/neve-woo-comp',
					'label' => __( 'Learn More', 'neve' ),
				],
				'default'           => false,
				'show_in_rest'      => true,
				'sanitize_callback' => function ( $value ) {
					return is_bool( $value ) ? $value : false;
				},
			);
		}

		$this->options = array(
			array(
				'label'   => __( 'Extra features', 'neve' ),
				'options' => $options,
			),
		);
	}

	/**
	 * Check if module should be loaded.
	 *
	 * @return bool
	 */
	public function should_load() {
		return ( $this->is_active() && class_exists( 'WooCommerce' ) );
	}

	/**
	 * Run WooCommerce Booster Module
	 */
	public function run_module() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'customize_controls_print_scripts', array( $this, 'change_iframe_preview' ), 30 );

		$submodules = array(
			$this->module_namespace . '\Rest\Server',
			$this->module_namespace . '\Views\Shop_Page',
			$this->module_namespace . '\Views\Shop_Product',
			$this->module_namespace . '\Views\Wish_List',
			$this->module_namespace . '\Views\Quick_View',
			$this->module_namespace . '\Views\Single_Product_Video',
			$this->module_namespace . '\Views\Single_Product',
			$this->module_namespace . '\Views\Cart_Page',
			$this->module_namespace . '\Views\Checkout_Page',
			$this->module_namespace . '\Views\Payment_Icons',
		);

		if ( get_theme_mod( 'neve_shop_pagination_type' ) === 'infinite' ) {
			$submodules[] = $this->module_namespace . '\Views\Infinite_Scroll';
		}

		$mods = array();
		foreach ( $submodules as $index => $mod ) {
			if ( class_exists( $mod ) ) {
				$mods[ $index ] = new $mod();
				$mods[ $index ]->register_hooks();
			}
		}

		add_filter( 'neve_pro_filter_customizer_modules', array( $this, 'add_customizer_classes' ) );
		add_filter( 'neve_header_presets_v2', array( $this, 'add_header_presets' ) );

		$is_cn_enabled = get_option( 'nv_pro_enable_cart_notices', true );
		if ( $is_cn_enabled ) {
			$this->register_cart_notices();
		}

		$is_ct_enabled = Options::is_module_activated();
		if ( $is_ct_enabled && neve_pro_is_new_skin() ) {
			$this->register_comparison_table();
		}

		$is_variation_enabled = get_option( 'nv_pro_enable_variation_swatches', true );
		if ( $is_variation_enabled ) {
			$this->register_variation_swatches();
		}
	}

	/**
	 * Register cart notices classes.
	 */
	private function register_cart_notices() {
		$class    = $this->module_namespace . '\Cart_Notices\Cart_Notices';
		$instance = new $class();
		$instance->init();
	}

	/**
	 * Register comparison table classes.
	 */
	private function register_comparison_table() {
		$class = $this->module_namespace . '\Comparison_Table\Main';
		( new $class() );
	}

	/**
	 * Register variation swatches classes.
	 */
	private function register_variation_swatches() {
		$variation_swatches_admin = $this->module_namespace . '\Variation_Swatches\Variation_Swatches';
		$admin_instance           = new $variation_swatches_admin();
		$admin_instance->init();

		$variation_swatches_public = $this->module_namespace . '\Views\Variation_Swatches';
		$public_instance           = new $variation_swatches_public();
		$public_instance->init();
	}

	/**
	 * Add header presets.
	 *
	 * @param array $presets header presets array.
	 *
	 * @return array
	 */
	public function add_header_presets( $presets ) {
		return array_merge(
			$presets,
			array(
				array(
					'label' => 'Two Row Search Cart',
					'image' => NEVE_PRO_INCLUDES_URL . 'modules/woocommerce_booster/assets/img/TwoRowSearchCart.jpg',
					'setup' => '{"hfg_header_layout_v2":"{\"desktop\":{\"top\":{\"left\":[],\"c-left\":[],\"center\":[],\"c-right\":[],\"right\":[]},\"main\":{\"left\":[{\"id\":\"logo\"}],\"c-left\":[],\"center\":[{\"id\":\"header_search\"}],\"c-right\":[],\"right\":[{\"id\":\"header_cart_icon\"}]},\"bottom\":{\"left\":[{\"id\":\"primary-menu\"}],\"c-left\":[],\"center\":[],\"c-right\":[],\"right\":[]}},\"mobile\":{\"top\":{\"left\":[],\"c-left\":[],\"center\":[],\"c-right\":[],\"right\":[]},\"main\":{\"left\":[{\"id\":\"logo\"}],\"c-left\":[],\"center\":[],\"c-right\":[],\"right\":[{\"id\":\"header_search_responsive\"},{\"id\":\"header_cart_icon\"}]},\"bottom\":{\"left\":[{\"id\":\"nav-icon\"}],\"c-left\":[],\"center\":[],\"c-right\":[],\"right\":[]},\"sidebar\":[{\"id\":\"primary-menu\"}]}}","logo_component_align":{"mobile":"center","tablet":"center","desktop":"center"}}',
				),
				array(
					'label' => 'Search Menu Cart',
					'image' => NEVE_PRO_INCLUDES_URL . 'modules/woocommerce_booster/assets/img/SearchMenuCart.jpg',
					'setup' => '{"hfg_header_layout_v2":"{\"desktop\":{\"top\":{\"left\":[],\"c-left\":[],\"center\":[],\"c-right\":[],\"right\":[]},\"main\":{\"left\":[{\"id\":\"logo\"},{\"id\":\"header_search_responsive\"}],\"c-left\":[],\"center\":[],\"c-right\":[],\"right\":[{\"id\":\"header_cart_icon\"},{\"id\":\"primary-menu\"}]},\"bottom\":{\"left\":[],\"c-left\":[],\"center\":[],\"c-right\":[],\"right\":[]}},\"mobile\":{\"top\":{\"left\":[],\"c-left\":[],\"center\":[],\"c-right\":[],\"right\":[]},\"main\":{\"left\":[{\"id\":\"logo\"}],\"c-left\":[],\"center\":[],\"c-right\":[],\"right\":[{\"id\":\"header_cart_icon\"},{\"id\":\"nav-icon\"}]},\"bottom\":{\"left\":[],\"c-left\":[],\"center\":[],\"c-right\":[],\"right\":[]},\"sidebar\":[{\"id\":\"header_search\"},{\"id\":\"primary-menu\"}]}}"}',
				),
				array(
					'label' => 'Two Row Search Cart',
					'image' => NEVE_PRO_INCLUDES_URL . 'modules/woocommerce_booster/assets/img/TwoRowSearchCart2.jpg',
					'setup' => '{"hfg_header_layout_v2":"{\"desktop\":{\"top\":{\"left\":[],\"c-left\":[],\"center\":[],\"c-right\":[],\"right\":[{\"id\":\"header_cart_icon\"}]},\"main\":{\"left\":[{\"id\":\"logo\"},{\"id\":\"primary-menu\"}],\"c-left\":[],\"center\":[],\"c-right\":[],\"right\":[{\"id\":\"header_search\"}]},\"bottom\":{\"left\":[],\"c-left\":[],\"center\":[],\"c-right\":[],\"right\":[]}},\"mobile\":{\"top\":{\"left\":[],\"c-left\":[],\"center\":[],\"c-right\":[],\"right\":[{\"id\":\"header_cart_icon\"}]},\"main\":{\"left\":[{\"id\":\"logo\"}],\"c-left\":[],\"center\":[],\"c-right\":[],\"right\":[{\"id\":\"nav-icon\"},{\"id\":\"header_search_responsive\"}]},\"bottom\":{\"left\":[],\"c-left\":[],\"center\":[],\"c-right\":[],\"right\":[]},\"sidebar\":[{\"id\":\"primary-menu\"}]}}"}',
				),
			)
		);
	}

	/**
	 * Add customizer classes.
	 *
	 * @param array $classes loaded classes.
	 *
	 * @return array
	 */
	public function add_customizer_classes( $classes ) {
		return array_merge(
			array(
				'Modules\Woocommerce_Booster\Customizer\Single_Product',
				'Modules\Woocommerce_Booster\Customizer\Cart_Page',
				'Modules\Woocommerce_Booster\Customizer\Checkout_Page',
				'Modules\Woocommerce_Booster\Customizer\Shop_Page',
				'Modules\Woocommerce_Booster\Customizer\Payment_Icons',
				'Modules\Woocommerce_Booster\Customizer\Cart_Icon',
				'Modules\Woocommerce_Booster\Customizer\Typography',
				'Modules\Woocommerce_Booster\Customizer\Comparison_Table',
			),
			$classes
		);
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function enqueue_scripts() {
		$path = neve_pro_is_new_skin() ? 'style.min.css' : 'style-legacy.min.css';

		$this->rtl_enqueue_style( 'neve-pro-addon-woo-booster', NEVE_PRO_INCLUDES_URL . 'modules/woocommerce_booster/assets/' . $path, array(), NEVE_PRO_VERSION );

		wp_register_script(
			'neve-pro-addon-woo-booster',
			NEVE_PRO_INCLUDES_URL . 'modules/woocommerce_booster/assets/js/build/script.js',
			array(
				'jquery',
				'woocommerce',
				'wc-cart-fragments',
			),
			NEVE_PRO_VERSION,
			true
		);

		global $wp_query;
		$url = wc_get_endpoint_url( 'nv-wish-list', '', get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) );

		$woo_booster_options = array(
			'relatedSliderStatus'    => $this->get_theme_mod_status( 'neve_enable_product_related_slider' ),
			'gallerySliderStatus'    => $this->get_theme_mod_status( 'neve_enable_product_gallery_thumbnails_slider' ),
			'recentlyViewedStatus'   => $this->get_theme_mod_status( 'neve_enable_related_viewed' ),
			'labelsAsPlaceholders'   => $this->get_theme_mod_status( 'neve_checkout_labels_placeholders' ),
			'relatedSliderPerCol'    => get_theme_mod( 'neve_single_product_related_columns' ),
			'galleryLayout'          => $this->get_gallery_layout(),
			'modalContentEndpoint'   => rest_url( NEVE_PRO_REST_NAMESPACE . '/products/post/' ),
			'wishListUpdateEndpoint' => rest_url( NEVE_PRO_REST_NAMESPACE . '/update_wishlist/' ),
			'userWishlist'           => get_user_meta( get_current_user_id(), 'wish_list_products', true ),
			'infiniteScrollQuery'    => wp_json_encode( $wp_query->query ),
			'nonce'                  => wp_create_nonce( 'wp_rest' ),
			'loggedIn'               => is_user_logged_in(),
			'i18n'                   => apply_filters(
				'neve_wishlist_strings',
				array(
					/* translators: %s - url */
					'wishListNoticeTextAdd'    => sprintf( esc_html__( 'This product has been added to your %s.', 'neve' ), sprintf( '<a href="%1$s">%2$s</a>', esc_url( $url ), esc_html__( 'wish list', 'neve' ) ) ),
					/* translators: %s - url */
					'wishListNoticeTextRemove' => sprintf( esc_html__( 'This product has been removed from your %s.', 'neve' ), sprintf( '<a href="%1$s">%2$s</a>', esc_url( $url ), esc_html__( 'wish list', 'neve' ) ) ),
					'emptyWishList'            => esc_html__( 'You don\'t have any products in your wish list yet.', 'neve' ),
					'wishlistError'            => esc_html__( 'There was an error while trying to update the wishlist.', 'neve' ),
				)
			),
		);

		if ( Options::is_module_activated() ) {
			$woo_booster_options['comparisonTable'] = array(
				'cartRedirectAfterAdd'  => get_option( 'woocommerce_cart_redirect_after_add' ),
				// TODO: remove it from this array.
				'iframeURL'             => add_query_arg(
					array(
						'comparison-table-iframe' => 1,
						'product_ids'             => 'product-ids-placeholder',
					),
					get_site_url()
				),
				'viewType'              => Mods::get( self::MODS_COMPARISON_TABLE_DISPLAY_TYPE, 'page' ),
				'numberOfProductsLimit' => Options::get_number_of_products_limit(),
				'tableURL'              => add_query_arg( 'product_ids', 'product-ids-placeholder', esc_url( self::get_comparison_link() ) ),
				'i18n'                  => array(
					/* translators: %s - number of products limit */
					'numberOfProductsLimitNoticeMessage' => sprintf( esc_html__( 'A maximum %s products can be added to the comparison table.', 'neve' ), Options::get_number_of_products_limit() ),
				),
			);

			if ( Mods::get( self::MODS_COMPARISON_TABLE_DISPLAY_TYPE, 'page' ) === 'popup' ) {
				$woo_booster_options['comparisonTable']['autoOpenModalLimit'] = Options::get_open_popup_product_limit();
				$woo_booster_options['comparisonTable']['iframeURL']          = add_query_arg(
					array(
						'comparison-table-iframe' => 1,
						'product_ids'             => 'product-ids-placeholder',
						'parent-window-url'       => 'parent-window-url-placeholder',
					),
					get_site_url()
				);
			}
		}

		wp_localize_script(
			'neve-pro-addon-woo-booster',
			'neveWooBooster',
			$woo_booster_options
		);

		wp_script_add_data( 'neve-pro-addon-woo-booster', 'async', true );
		wp_enqueue_script( 'neve-pro-addon-woo-booster' );
		wp_enqueue_script( 'wc-add-to-cart-variation' );
	}

	/**
	 * Get status of a theme mod.
	 *
	 * @param string $mod Theme mod name.
	 *
	 * @return string
	 */
	private function get_theme_mod_status( $mod ) {
		$status = get_theme_mod( $mod, false );

		if ( false === $status ) {
			return 'disabled';
		}

		return 'enabled';
	}

	/**
	 * Get gallery layout.
	 *
	 * @return string
	 */
	private function get_gallery_layout() {
		return get_theme_mod( 'neve_single_product_gallery_layout', 'normal' );
	}

	/**
	 * Scripts to change the iframe preview.
	 */
	public function change_iframe_preview() {
		?>
		<script type="text/javascript">
			jQuery(document).ready(function ($) {
				wp.customize.section('neve_cart_page_layout', function (section) {
					section.expanded.bind(function (isExpanded) {
						if (isExpanded) {
							wp.customize.previewer.previewUrl.set('<?php echo esc_js( wc_get_page_permalink( 'cart' ) ); ?>')
						}
					});
				});
			});
		</script>
		<?php
	}
}
