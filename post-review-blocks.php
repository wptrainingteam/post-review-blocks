<?php
/**
 * Plugin Name:       Post Review Blocks
 * Description:       Example block scaffolded with Create Block tool.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            The WordPress Contributors
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       post-review-blocks
 *
 * @package CreateBlock
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function create_block_post_review_blocks_block_init() {
	register_block_type( __DIR__ . '/build/rating-block' );
	register_block_type( __DIR__ . '/build/review-card-block' );
}
add_action( 'init', 'create_block_post_review_blocks_block_init' );

function limit_rating_block_to_post_type( $allowed_block_types, $editor_context ) {
	// Only allow paragraphs, headings, lists, and the rating block in the post editor for Posts.
	if ( 'post' === $editor_context->post->post_type ) {
		return array(
			'core/paragraph',
			'core/heading',
			'core/list',
			'create-block/rating-block'
		);
	}

	return $allowed_block_types;
}
add_filter( 'allowed_block_types_all', 'limit_rating_block_to_post_type', 10, 2 );


// Add some post meta
add_action(
	'init',
	function() {
		register_post_meta(
			'',
			'_rating',
			array(
				'show_in_rest' => true,
				'single'       => true,
				'type'         => 'integer',
                'auth_callback' => function() {
                    return current_user_can( 'edit_posts' );
                }
			)
		);
		register_post_meta(
			'',
			'_ratingStyle',
			array(
				'show_in_rest' => true,
				'single'       => true,
				'type'         => 'string',
                'auth_callback' => function() {
                    return current_user_can( 'edit_posts' );
                }
			)
		);
	}
);
