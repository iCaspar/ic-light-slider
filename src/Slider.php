<?php
/**
 * Slider.php
 */

namespace ICaspar\LightSlider;


/**
 * Class Slider
 * @package ICaspar\LightSlider
 */
class Slider {

	/**
	 * @var array
	 */
	private $config = [];

	/**
	 * @var SliderAssets
	 */
	public $assets;

	/**
	 * Slider constructor.
	 *
	 * @param array $config
	 */
	public function __construct( array $config ) {
		$this->config = $config;
		$this->assets = new SliderAssets();
	}

	/**
	 * Initialize the Slider Plugin.
	 *
	 * @return void
	 */
	public function init() {
		add_action( 'init', [ $this, 'registerSlidePostType' ] );
		add_action( 'init', [ $this, 'registerTaxonomy' ] );
		add_action( 'init', [ $this, 'registerShortcode' ] );
		add_action( 'widgets_init', [ $this, 'registerWidget' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'registerAssets' ] );

		if ( is_admin() ) {
			add_action( 'admin_init', [ $this, 'maybeActivate' ] );
			$this->registerMetaBox();
		}
	}

	/**
	 * Callback to register the Slide post type.
	 * @return void
	 */
	public function registerSlidePostType() {
		if ( ! self::isSettingPresentAsArray( $this->config, 'post_type_config' ) ) {
			return;
		}

		$slidePostType = new SlidePostType( $this->config['post_type_config'] );
		$slidePostType->register();
	}

	/**
	 * Callback to register Slider taxonomy.
	 * @return void
	 */
	public function registerTaxonomy() {
		if ( ! self::isSettingPresentAsArray( $this->config, 'taxonomy_config' ) ) {
			return;
		}

		$taxonomies = new SliderTaxonomies( $this->config['taxonomy_config'] );
		$taxonomies->register();
	}

	/**
	 * Callback to register the Slider shortcode.
	 * @return void
	 */
	public function registerShortcode() {
		$sliderShortcode = new SliderShortcode();
		$sliderShortcode->register();
	}

	/**
	 * Callback to register the Slider widget.
	 * @return void
	 */
	public function registerWidget() {
		$widget = new SliderWidget();
		$widget->register();
	}

	/**
	 * Callback to register styles and scripts.
	 * @return void
	 */
	public function registerAssets() {
		$this->assets->registerScripts();
		$this->assets->enqueueStyles();
	}

	/**
	 * Register Metabox on the Slide edit page.
	 * @return void
	 */
	private function registerMetaBox() {
		if ( ! self::isSettingPresentAsArray( $this->config, 'meta_box_config' ) ) {
			return;
		}

		$metaBox = new MetaBox( $this->config['meta_box_config'] );
		$metaBox->register();
	}

	/**
	 * Find whether a setting exists as an array.
	 *
	 * @param array $config
	 * @param string $setting
	 *
	 * @return bool
	 */
	public static function isSettingPresentAsArray( array $config, $setting ) {
		return isset( $config[ $setting ] ) && is_array( $config[ $setting ] );
	}

	/**
	 * Display a slider.
	 *
	 * @param $sliderName
	 *
	 * @return void
	 */
	public static function showSlider( $sliderName ) {
		$slideShow = new SlideShow( $sliderName );
		$slideShow->show();
	}

	/**
	 * Callback to do housecleaning after activation.
	 * @return void
	 */
	public function maybeActivate() {
		if ( false == get_option( 'ic_light_slider_active' ) ) {
			flush_rewrite_rules();
			update_option( 'ic_light_slider_active', true );
		}
	}
}