<?php
	/**
	 * @package Foundry
	 * @author TommusRhodus
	 * @version 3.0.0
	 */
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly
	}
	
	$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
?>

<li>
    <div class="user">
        <?php echo ebor_rating_html($rating); ?>
        <span class="bold-h6"><?php comment_author(); ?></span>
        <span class="date number uppercase"><?php echo get_comment_date( get_option( 'date_format' ) ); ?></span>
    </div>
    <?php comment_text(); ?>