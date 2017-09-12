<?php
/**
 * SliderShortcode.php
 */

namespace ICaspar\LightSlider;


/**
 * Class SliderShortcode
 * @package ICaspar\LightSlider
 */
class SliderShortcode {

	/**
	 * Register the slider shortcode.
	 * @return void
	 */
	public function register() {
		add_shortcode( 'ic-slider', [ $this, 'showSlider' ] );
	}

	/**
	 * Show a slider
	 * @param array $slider
	 *
	 * @return string|void
	 */
	public function showSlider( array $slider ) {
		if ( empty( $slider ) || ! isset( $slider['slider'] ) ) {
			return;
		}

		$slider = $slider['slider'];

		ob_start();

		Slider::showSlider( $slider );

		return ob_get_clean();
	}
}