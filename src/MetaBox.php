<?php
/**
 * MetaBox.php
 */

namespace ICaspar\LightSlider;


/**
 * Class MetaBox
 * @package ICaspar\LightSlider
 */
class MetaBox {

	/**
	 * @var array
	 */
	private $metaBoxConfig = [];

	/**
	 * MetaBox constructor.
	 *
	 * @param array $metaBoxConfig
	 */
	public function __construct( array $metaBoxConfig ) {
		$this->metaBoxConfig = $metaBoxConfig;
	}

	/**
	 * Hook all registration functionality.
	 * @return void
	 */
	public function register() {
		add_action( 'load-post.php', [ $this, 'registerMetabox' ] );
		add_action( 'load-post-new.php', [ $this, 'registerMetabox' ] );
	}

	/**
	 * Callback to register the metabox.
	 * @return void
	 */
	public function registerMetabox() {
		add_action( 'add_meta_boxes', function () {
			add_meta_box(
				$this->metaBoxConfig['slug'],
				$this->metaBoxConfig['title'],
				[ $this, 'renderBox' ],
				$this->metaBoxConfig['post_type'],
				$this->metaBoxConfig['location']
			);
		} );

		add_action( 'save_post_' . $this->metaBoxConfig['post_type'], [ $this, 'saveMeta' ], 10, 2 );
	}

	/**
	 * Callback to render the metabox.
	 *
	 * @param \WP_Post $post
	 *
	 * @return void
	 */
	public function renderBox( \WP_Post $post ) {
		$view   = 'views/slide-link-metabox.php';
		$stored = $this->getStoredMeta( $post, $this->metaBoxConfig['meta_key'] );

		wp_nonce_field( $this->metaBoxConfig['meta_key'] . '_save', $this->metaBoxConfig['meta_key'] . '_nonce' );

		include $view;
	}

	/**
	 * Get previously stored metadata, if any.
	 *
	 * @param \WP_Post $post
	 * @param $field
	 *
	 * @return string
	 */
	private function getStoredMeta( \WP_Post $post, $field ) {
		$stored_meta = get_post_meta( $post->ID );

		return ! empty( $stored_meta[ $field ] )
			? $stored_meta[ $field ][0]
			: '';
	}

	/**
	 * Save new metadata.
	 *
	 * @param $post_id
	 * @param \WP_Post $post
	 *
	 * @return void
	 */
	public function saveMeta( $post_id, \WP_Post $post ) {
		if ( ! $this->isOkToSave( $post_id, $post ) ) {
			return;
		}

		if ( isset( $_POST[ $this->metaBoxConfig['meta_key'] ] ) ) {
			$input = $this->validate( $_POST[ $this->metaBoxConfig['meta_key'] ] );
			update_post_meta( $post_id, $this->metaBoxConfig['meta_key'], $input );
		}
	}

	/**
	 * Check that it's safe to save metadata.
	 *
	 * @param $post_id
	 * @param \WP_Post $post
	 *
	 * @return bool
	 */
	private function isOkToSave( $post_id, \WP_Post $post ) {
		$isAutosave = wp_is_post_autosave( $post_id );
		$isRevision = wp_is_post_revision( $post_id );

		if ( $isAutosave || $isRevision || ! $this->isValidNonce() ) {
			return false;
		}

		$post_type = get_post_type_object( $post->post_type );

		return current_user_can( $post_type->cap->edit_post, $post_id );
	}

	/**
	 * Check for a valid nonce.
	 * @return bool|false|int
	 */
	private function isValidNonce() {
		if ( isset( $_POST[ $this->metaBoxConfig['meta_key'] . '_nonce' ] ) ) {
			return wp_verify_nonce( $_POST[ $this->metaBoxConfig['meta_key'] . '_nonce' ], $this->metaBoxConfig['meta_key'] . '_save' );
		}

		return false;
	}

	/**
	 * Validate metabox input.
	 *
	 * @param $input
	 *
	 * @return string
	 */
	private function validate( $input ) {
		return esc_url_raw( $input );
	}
}