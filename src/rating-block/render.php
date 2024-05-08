<?php
global $post;


$ratingEmojis = '';
// Get the rating and rating style from the post meta
$rating = get_post_meta( get_the_ID(), '_rating', true );
$ratingStyle = get_post_meta( get_the_ID(), '_ratingStyle', true );
// If the rating style is not set, default to star
if ( ! $ratingStyle ) {
    $ratingStyle = 'heart';
}
// Generate the rating emojis.
for ( $i = 0; $i < $rating; $i++ ) {
    $ratingEmojis .= $ratingStyle === 'star' ? '⭐️' : '❤️';
}

?>
<p <?php echo get_block_wrapper_attributes(); ?>>
		<?php echo wp_kses_post( '<strong>Rating:</strong> <span class="rating-' . $ratingStyle . '">' . $ratingEmojis . '</span>', 'multiblock-plugin' ); ?>
</p>
