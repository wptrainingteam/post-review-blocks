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

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function create_block_post_review_blocks_block_init() {
	register_block_type( __DIR__ . '/build/rating-block' );
	register_block_type( __DIR__ . '/build/review-card-block' );
}
add_action( 'init', 'create_block_post_review_blocks_block_init' );

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
