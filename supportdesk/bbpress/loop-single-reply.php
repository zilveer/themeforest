<?php

/**
 * Replies Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>



<div id="post-<?php bbp_reply_id(); ?>" <?php bbp_reply_class(); ?>>

	<div class="bbp-reply-author">

		<?php do_action( 'bbp_theme_before_reply_author_details' ); ?>

		<?php bbp_reply_author_link( array( 'type' => 'avatar', 'show_role' => false ) ); ?>

		<?php do_action( 'bbp_theme_after_reply_author_details' ); ?>

	</div><!-- .bbp-reply-author -->
    
    <div class="bbp-meta">
    
    <?php bbp_reply_author_link( array( 'type' => 'name', 'show_role' => false ) ); ?>
    
    <a href="<?php bbp_reply_url(); ?>" title="<?php bbp_reply_title(); ?>" class="bbp-reply-permalink"><span class="bbp-reply-post-date"><?php bbp_reply_post_date(); ?></span></a>
    
    </div>

	<div class="bbp-reply-content">

		<?php do_action( 'bbp_theme_before_reply_content' ); ?>

		<?php bbp_reply_content(); ?>

		<?php do_action( 'bbp_theme_after_reply_content' ); ?>

	</div><!-- .bbp-reply-content -->
    
    <?php do_action( 'bbp_theme_before_reply_admin_links' ); ?>

		<?php 
		$args = array (
			'id'     => 0,
			'before' => '<span class="bbp-admin-links">',
			'after'  => '</span>',
			'sep'    => ' / ',
			'links'  => array()
		);
		bbp_reply_admin_links( $args ); ?>

		<?php do_action( 'bbp_theme_after_reply_admin_links' ); ?>

</div><!-- #post-<?php bbp_reply_id(); ?> -->
