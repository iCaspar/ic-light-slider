<?php
/**
 * SliderAssets.php
 */

namespace ICaspar\LightSlider;


/**
 * Class SliderAssets
 * @package ICaspar\LightSlider
 */
class SliderAssets {
	/**
	 * @var string
	 */
	private $assetsUrl = '';

	/**
	 * @var string
	 */
	private $fileSuffix = '';

	/**
	 * SliderAssets constructor.
	 */
	public function __construct() {
		$this->setAssetsUrl();
	}

	/**
	 * Set the Asset URL depending on dev environment.
	 * @return void
	 */
	private function setAssetsUrl() {
		$dev              = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG;
		$this->assetsUrl  = IC_LIGHT_SLIDER_URL . ( $dev ? 'assets/src/' : 'assets/dist/' );
		$this->fileSuffix = ( $dev ? '' : '.min' );
	}

	/**
	 * Register Slider scripts.
	 * @return void
	 */
	public function registerScripts() {
		wp_register_script(
			'slick-slider',
			'//cdn.jsdelivr.net/npm/slick-carousel@1.7.1/slick/slick.min.js',
			'jquery',
			'1.7.1',
			true
		);
		wp_register_script(
			'slick-start',
			$this->assetsUrl . 'js/slick-start' . $this->fileSuffix . '.js',
			[ 'slick-slider' ],
			IC_LIGHT_SLIDER_VERSION,
			true
		);
	}

	/**
	 * Enqueue Slider styles.
	 * @return void
	 */
	public function enqueueStyles() {
		wp_enqueue_style(
			'slick-slider',
			'//cdn.jsdelivr.net/npm/slick-carousel@1.7.1/slick/slick.min.css',
			[],
			'1.7.1',
			'screen'
		);
		wp_enqueue_style(
			'slick-slider-theme',
			'//cdn.jsdelivr.net/npm/slick-carousel@1.7.1/slick/slick-theme.min.css',
			[ 'slick-slider' ],
			'1.7.1',
			'screen'
		);
	}

	/**
	 * Enqueue Slider scripts (previously registered).
	 * @return void
	 */
	public static function enqueueScripts() {
		wp_enqueue_script( 'slick-slider' );
		wp_enqueue_script( 'slick-start' );
	}

	/**
	 * Localize the slider script.
	 * @return void
	 */
	public static function localizeScript( $slideName ) {
		wp_localize_script(
			'slick-starter',
			'icLightSlider_' . $slideName,
			[ 'slider' => $slideName ] );
	}

}