<?php
/**
 * config.php
 */

return [
	'post_type_config' => [
		'post_type_names' => [
			'singular' => _x( 'Slide', 'singular post type name', IC_LIGHT_SLIDER_TEXT_DOMAIN ),
			'plural'   => _x( 'Slides', 'plural post type name', IC_LIGHT_SLIDER_TEXT_DOMAIN ),
		],
		'supports'        => [
			'title',
			'thumbnail',
			'page-attributes',
		],
		'slug'            => 'ic-slide',
		'args'            => [
			'public'            => true,
			'description'       => _x( 'Slides', IC_LIGHT_SLIDER_TEXT_DOMAIN ),
			'menu_position'     => 24,
			'menu_icon'         => 'dashicons-images-alt',
			'show_in_nav_menus' => false,
			'has_archive'       => false,
			'hierarchical'      => true,
		],
	],
	'taxonomy_config'  => [
		'taxonomy_names' => [
			'singular' => _x( 'Slider', 'singular taxonomy name', ICASPAR_HUB_TEXT_DOMAIN ),
			'plural'   => _x( 'Sliders', 'plural taxonomy name', ICASPAR_HUB_TEXT_DOMAIN ),
		],
		'slug'        => 'ic-slide-groups',
		'args'           => [
			'show_in_nav_menus' => false,
			'show_admin_column' => true,
			'hierarchical'      => true,
		],
	],
	'meta_box_config'  => [
		'slug'      => 'slide-link',
		'title'     => __( 'Slide Link URL', IC_LIGHT_SLIDER_TEXT_DOMAIN ),
		'post_type' => 'ic-slide',
		'location'  => 'normal',
		'meta_key'  => '_slide-link',
	],
];