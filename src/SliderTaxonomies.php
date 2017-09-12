<?php
/**
 * SliderTaxonomies.php
 */

namespace ICaspar\LightSlider;


/**
 * Class SliderTaxonomies
 * @package ICaspar\LightSlider
 */
class SliderTaxonomies {

	/**
	 * @var array
	 */
	private $taxConfig = [];

	/**
	 * @var array
	 */
	private $taxArgs = [];

	/**
	 * SliderTaxonomies constructor.
	 *
	 * @param array $taxConfig
	 */
	public function __construct( array $taxConfig ) {
		$this->taxConfig = $taxConfig;
	}

	/**
	 * Register The Sliders taxonomy.
	 * @return void
	 */
	public function register() {
		$this->buildTaxonomyArgs();
		//die(var_dump($this->taxArgs));
		register_taxonomy( 'sliders', 'ic-slide', $this->taxArgs );
	}

	/**
	 * Build the Slider taxonomy args.
	 * @return void
	 */
	private function buildTaxonomyArgs() {
		if ( Slider::isSettingPresentAsArray( $this->taxConfig, 'args' ) ) {
			$this->taxArgs = $this->taxConfig['args'];
		}

		$this->buildTaxLabels();
		$this->buildTaxRewrite();
	}

	/**
	 * Build the Slider taxonomy labels.
	 * @return void
	 */
	private function buildTaxLabels() {
		if ( ! Slider::isSettingPresentAsArray( $this->taxConfig, 'taxonomy_names' ) ) {
			return;
		}

		$singular = $this->taxConfig['taxonomy_names']['singular'];
		$plural   = $this->taxConfig['taxonomy_names']['plural'];

		if ( ! $singular || ! $plural ) {
			return;
		}

		$this->taxArgs['labels'] = [
			'name'                       => $plural,
			'singular_name'              => $singular,
			'all_items'                  => sprintf( '%s %s', __( 'All', IC_LIGHT_SLIDER_TEXT_DOMAIN ), $plural ),
			'edit_item'                  => sprintf( '%s %s', __( 'Edit', IC_LIGHT_SLIDER_TEXT_DOMAIN ), $singular ),
			'view_item'                  => sprintf( '%s %s', __( 'View', IC_LIGHT_SLIDER_TEXT_DOMAIN ), $singular ),
			'update_item'                => sprintf( '%s %s', __( 'Update', IC_LIGHT_SLIDER_TEXT_DOMAIN ), $singular ),
			'add_new_item'               => sprintf( '%s %s', __( 'Add New', IC_LIGHT_SLIDER_TEXT_DOMAIN ), $singular ),
			'new_item_name'              => sprintf( '%s %s', __( 'New Name for', IC_LIGHT_SLIDER_TEXT_DOMAIN ), $singular ),
			'search_items'               => sprintf( '%s %s', __( 'Search', IC_LIGHT_SLIDER_TEXT_DOMAIN ), $plural ),
			'popular_items'              => sprintf( '%s %s', __( 'Popular' ), $plural ),
			'separate_items_with_commas' => sprintf( '%s %s %s', __( 'Separate', IC_LIGHT_SLIDER_TEXT_DOMAIN ), $plural, __( 'with commas', IC_LIGHT_SLIDER_TEXT_DOMAIN ) ),
			'add_or_remove_items'        => sprintf( '%s %s', __( 'Add or remove', IC_LIGHT_SLIDER_TEXT_DOMAIN ), $plural ),
			'choose_from_most_used'      => sprintf( '%s %s', __( 'Choose from most used', IC_LIGHT_SLIDER_TEXT_DOMAIN ), $plural ),
			'not_found'                  => sprintf( '%s %s', $singular, _x( 'not found', 'taxonomy term not found', IC_LIGHT_SLIDER_TEXT_DOMAIN ) ),
		];
	}

	/**
	 * Build the Slider taxonomy rewrite.
	 * @return void
	 */
	private function buildTaxRewrite() {
		if ( ! isset ( $this->taxConfig['slug'] ) ) {
			return;
		}

		$cleanSlug = sanitize_title( $this->taxConfig['slug'] );

		$this->taxArgs['rewrite'] = [ 'slug' => $cleanSlug ];
	}
}