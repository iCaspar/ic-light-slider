<?php
/**
 * SlideShow.php
 */

namespace ICaspar\LightSlider;


/**
 * Class SlideShow
 * @package ICaspar\LightSlider
 */
class SlideShow {

	/**
	 * @var string
	 */
	private $sliderName = '';

	/**
	 * SlideShow constructor.
	 *
	 * @param string $sliderName
	 */
	public function __construct( $sliderName ) {
		$this->sliderName = $sliderName;
	}

	/**
	 * Display a slider.
	 * @return void
	 */
	public function show() {
		$html = 'views/slideshow.php';

		$slides = $this->getSlides();

		if ($slides->have_posts()) {
			include $html;
		}

		wp_reset_postdata();

		SliderAssets::enqueueScripts();
		SliderAssets::localizeScript( $this->sliderName );
	}

	/**
	 * Gets a Query object with slides to show.
	 * @return \WP_Query
	 */
	private function getSlides() {
		$args = [
			'post_type' => 'ic-slide',
			'tax_query' => [
				[
					'taxonomy' => 'sliders',
					'field' => 'slug',
					'terms' => $this->sliderName,
				],
			],
			'orderby' => 'menu_order',
			'order' => 'ASC',
			'nopaging' => true,
		];

		return new \WP_Query( $args );
	}
}