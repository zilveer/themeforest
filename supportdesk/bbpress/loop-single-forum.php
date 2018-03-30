<?php

/**
 * Forums Loop - Single Forum
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<ul id="bbp-forum-<?php bbp_forum_id(); ?>" <?php bbp_forum_class(); ?>>

	<li class="bbp-forum-info">

	<div class="bbp-forum-header">
    
    	<?php do_action( 'bbp_theme_before_forum_title' ); ?>
		<a class="bbp-forum-title" href="<?php bbp_forum_permalink(); ?>" title="<?php bbp_forum_title(); ?>"><?php bbp_forum_title(); ?></a>
        
        <?php do_action( 'bbp_theme_after_forum_title' ); ?>
        
        <?php do_action( 'bbp_theme_before_forum_description' ); ?>
        
		<div class="bbp-forum-content"><?php the_content(); ?></div>
        
        <?php do_action( 'bbp_theme_after_forum_description' ); ?>
	</div>
 
		<?php do_action( 'bbp_theme_before_forum_sub_forums' ); ?>

			<?php if (is_single()) {
			
			bbp_list_forums();
			
			} else {
			
			st_bbp_list_forums( array (
			'before'            => '<ul class="bbp-forums-list">',
			'after'             => '</ul>',
			'link_before'       => '<li class="bbp-forum">',
			'link_after'        => '</li>',
			'count_before'      => '<div class="topic-reply-counts"> '. __( 'Topics:', 'framework') .' ',
			'count_after'       => '</div>',
			'count_sep'         => '<br />'. __( 'Posts:', 'framework') .' ',
			'separator'         => '<div style="clear:both;"></div>',
			'forum_id'          => '',
			'show_topic_count'  => true,
			'show_reply_count'  => true,
			'show_freshness_link' => true,
			)); 
			
			} ?>

		<?php do_action( 'bbp_theme_after_forum_sub_forums' ); ?>

		<?php bbp_forum_row_actions(); ?>
	</li>
<?php if (is_single()) { ?>
	<li class="bbp-forum-topic-count">
		<?php _e('Topics: ','framework') ?><?php bbp_forum_topic_count(); ?><br />
        <?php _e('Posts: ','framework') ?> <?php bbp_show_lead_topic() ? bbp_forum_reply_count() : bbp_forum_post_count(); ?>
	</li>

	<li class="bbp-forum-freshness">

		<?php do_action( 'bbp_theme_before_forum_freshness_link' ); ?>

		<?php st_last_poster_block ( get_the_ID()  ) ?>


		<?php do_action( 'bbp_theme_after_forum_freshness_link' ); ?>

	</li>
<?php } ?>
</ul><!-- #bbp-forum-<?php bbp_forum_id(); ?> -->