<?php
/**
 * SlidePostType.php
 */

namespace ICaspar\LightSlider;


/**
 * Class SlidePostType
 * @package ICaspar\LightSlider
 */
class SlidePostType {

	/**
	 * @var array
	 */
	private $postTypeConfig = [];

	/**
	 * @var array
	 */
	private $slideArgs = [];

	/**
	 * SlidePostType constructor.
	 *
	 * @param array $postTypeConfig
	 */
	public function __construct( array $postTypeConfig ) {
		$this->postTypeConfig = $postTypeConfig;
	}

	/**
	 * Register the Slide custom post type.
	 * @return void
	 */
	public function register() {
		$this->buildSlideArgs();
		register_post_type( 'ic-slide', $this->slideArgs );
	}

	/**
	 * Build the post type argument array.
	 * @return void
	 */
	private function buildSlideArgs() {
		if ( Slider::isSettingPresentAsArray( $this->postTypeConfig, 'args' ) ) {
			$this->slideArgs = $this->postTypeConfig['args'];
		}

		$this->buildLabels();
		$this->buildPostSupports();
		$this->buildRewrite();
	}

	/**
	 * Build the post type labels sub-array.
	 * @return void
	 */
	private function buildLabels() {
		if ( ! Slider::isSettingPresentAsArray( $this->postTypeConfig,'post_type_names' ) ) {
			return;
		}

		$singular = $this->postTypeConfig['post_type_names']['singular'];
		$plural   = $this->postTypeConfig['post_type_names']['plural'];

		if ( ! $singular || ! $plural ) {
			return;
		}

		$this->slideArgs['labels'] = [
			'name'                  => 'Slides',
			'singular_name'         => $singular,
			'add_new'               => sprintf( ' % s % s', __( 'Add New', IC_LIGHT_SLIDER_TEXT_DOMAIN ), $singular ),
			'add_new_item'          => sprintf( ' % s % s', __( 'Add New', IC_LIGHT_SLIDER_TEXT_DOMAIN ), $singular ),
			'edit_item'             => sprintf( ' % s % s', __( 'Edit', IC_LIGHT_SLIDER_TEXT_DOMAIN ), $singular ),
			'new_item'              => sprintf( ' % s % s', __( 'New', IC_LIGHT_SLIDER_TEXT_DOMAIN ), $singular ),
			'view_item'             => sprintf( ' % s % s', __( 'View', IC_LIGHT_SLIDER_TEXT_DOMAIN ), $singular ),
			'search_items'          => sprintf( ' % s % s', __( 'Search', IC_LIGHT_SLIDER_TEXT_DOMAIN ), $plural ),
			'all_items'             => sprintf( ' % s % s', __( 'All', IC_LIGHT_SLIDER_TEXT_DOMAIN ), $plural ),
			'archives'              => sprintf( ' % s % s', $singular, __( 'Archives', IC_LIGHT_SLIDER_TEXT_DOMAIN ) ),
			'insert_into_item'      => sprintf( ' % s % s', __( 'Insert into', IC_LIGHT_SLIDER_TEXT_DOMAIN ), $singular ),
			'uploaded_to_this_item' => sprintf( ' % s % s', __( 'Upload to this', IC_LIGHT_SLIDER_TEXT_DOMAIN ), $singular ),
			'filter_items_list'     => $plural,
			'items_list_navigation' => $plural,
			'items_list'            => $plural,
			'not_found'             => sprintf( ' %s %s %s',
				__( 'No', IC_LIGHT_SLIDER_TEXT_DOMAIN ),
				$plural,
				__( 'found', IC_LIGHT_SLIDER_TEXT_DOMAIN )
			),
		];
	}

	/**
	 * Build the post type supports sub-array.
	 * @return void
	 */
	private function buildPostSupports() {
		if ( ! Slider::isSettingPresentAsArray( $this->postTypeConfig,'supports' ) ) {
			$this->slideArgs['supports'] = array_keys( get_all_post_type_supports( 'post' ) );
		} else {
			$this->slideArgs['supports'] = $this->postTypeConfig['supports'];
		}

	}

	/**
	 * Set the post type rewrite slug.
	 * @return void
	 */
	private function buildRewrite() {
		if ( ! isset( $this->postTypeConfig['slug'] ) ) {
			return;
		}

		$cleanSlug = sanitize_title( $this->postTypeConfig['slug'] );

		$this->slideArgs['rewrite'] = [ 'slug' => $cleanSlug ];
	}
}