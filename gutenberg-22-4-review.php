<?php
/**
 * Plugin Name: Gutenberg 22.4 Review Demo
 * Description: Demo plugin for Gutenberg 22.4 review. Includes a block pattern ready for pattern overrides on a custom block.
 * Version: 0.1.0
 * Author: VictorStackAI
 * License: GPL-2.0-or-later
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register block, scripts, styles, and patterns.
 */
function g224_register_spotlight_card_block() {
	$plugin_url  = plugin_dir_url( __FILE__ );
	$plugin_path = plugin_dir_path( __FILE__ );

	wp_register_script(
		'g224-spotlight-editor',
		$plugin_url . 'blocks/spotlight-card/editor.js',
		array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-components', 'wp-i18n' ),
		filemtime( $plugin_path . 'blocks/spotlight-card/editor.js' ),
		true
	);

	wp_register_style(
		'g224-spotlight-style',
		$plugin_url . 'blocks/spotlight-card/style.css',
		array(),
		filemtime( $plugin_path . 'blocks/spotlight-card/style.css' )
	);

	register_block_type(
		'g224/spotlight-card',
		array(
			'editor_script'   => 'g224-spotlight-editor',
			'style'           => 'g224-spotlight-style',
			'render_callback' => 'g224_render_spotlight_card',
			'attributes'      => array(
				'title'   => array(
					'type'    => 'string',
					'default' => 'Ship with clarity',
				),
				'summary' => array(
					'type'    => 'string',
					'default' => 'Pattern overrides let each instance customize this text without breaking the synced pattern.',
				),
			),
		)
	);

	register_block_pattern(
		'g224/spotlight-card',
		array(
			'title'       => 'Spotlight Card (Overrides Ready)',
			'description' => 'A custom block configured for Gutenberg 22.4 pattern overrides.',
			'categories'  => array( 'text', 'featured' ),
			'content'     => '<!-- wp:g224/spotlight-card {"title":"Launch faster","summary":"Swap this copy per instance using pattern overrides.","metadata":{"name":"spotlight-card","bindings":{"title":{"source":"core/pattern-overrides"},"summary":{"source":"core/pattern-overrides"}}}} /-->',
		)
	);
}
add_action( 'init', 'g224_register_spotlight_card_block' );

/**
 * Render callback for the spotlight card block.
 *
 * @param array $attributes Block attributes.
 * @return string
 */
function g224_render_spotlight_card( $attributes ) {
	$title   = isset( $attributes['title'] ) ? $attributes['title'] : '';
	$summary = isset( $attributes['summary'] ) ? $attributes['summary'] : '';

	if ( '' === trim( $title ) && '' === trim( $summary ) ) {
		return '';
	}

	$wrapper_attributes = get_block_wrapper_attributes( array( 'class' => 'g224-spotlight-card' ) );

	return sprintf(
		'<div %1$s><h3 class="g224-spotlight-card__title">%2$s</h3><p class="g224-spotlight-card__summary">%3$s</p></div>',
		$wrapper_attributes,
		wp_kses_post( $title ),
		wp_kses_post( $summary )
	);
}

/**
 * Enable block bindings (and pattern overrides) for specific attributes.
 *
 * @param array $supported Supported attributes.
 * @return array
 */
function g224_enable_pattern_overrides_for_spotlight( $supported ) {
	$supported[] = 'title';
	$supported[] = 'summary';
	return array_values( array_unique( $supported ) );
}
add_filter( 'block_bindings_supported_attributes_g224/spotlight-card', 'g224_enable_pattern_overrides_for_spotlight' );
