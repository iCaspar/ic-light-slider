<?php
/**
 * SliderWidget.php
 */

namespace ICaspar\LightSlider;


/**
 * Class SliderWidget
 * @package ICaspar\LightSlider
 */
class SliderWidget extends \WP_Widget {

	/**
	 * @var array
	 */
	private $terms = [
		'taxonomy'   => 'sliders',
		'hide_empty' => true,
	];

	/**
	 * @var array
	 */
	private $defaults = [
		'title'  => '',
		'slider' => 0,
	];

	/**
	 * SliderWidget constructor.
	 */
	public function __construct() {
		$widgetOptions = [
			'classname'   => 'ic-light-slider-widget',
			'description' => __( 'Light Slider Widget', IC_LIGHT_SLIDER_TEXT_DOMAIN ),
		];

		parent::__construct( $widgetOptions['classname'], $widgetOptions['description'], $widgetOptions );
	}

	/**
	 * Register the Slider widget.
	 * @return void
	 */
	public function register() {
		register_widget( __CLASS__ );
	}

	/**
	 * Display the Slider widget admin form.
	 * @param array $instance
	 *
	 * @return void
	 */
	public function form( $instance ) {
		$html     = 'views/slider-widget-form.php';
		$instance = wp_parse_args( $instance, $this->defaults );

		include $html;
	}

	/**
	 * Update a Slider widget.
	 * @param array $newInstance
	 * @param array $oldInstance
	 *
	 * @return mixed
	 */
	public function update( $newInstance, $oldInstance ) {
		$safeInstance['title']  = sanitize_text_field( $newInstance['title'] );
		$safeInstance['slider'] = (int) $newInstance['slider'];

		return $safeInstance;
	}

	/**
	 * Display a Slider widget.
	 * @param array $args
	 * @param array $instance
	 *
	 * @return void
	 */
	public function widget( $args, $instance ) {
		$instance = wp_parse_args( $instance, $this->defaults );

		$slider = $this->getTermSlug( $instance['slider'] );

		Slider::showSlider( $slider );
	}

	/**
	 * Get the term slug given a term's ID.
	 * @param int $termID
	 *
	 * @return string
	 */
	private function getTermSlug( $termID ) {
		$term = get_term( $termID, 'sliders' );

		return $term->slug;
	}
}