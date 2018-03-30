<?php

/**
 * Template Name: bbPress - Statistics
 *
 * @package bbPress
 * @subpackage Theme
 */

// Get the statistics and extract them for later use in this template
// @todo - remove variable references
extract( bbp_get_statistics(), EXTR_SKIP );

get_header(); ?>

<?php $st_page_sidebar_pos = get_post_meta( $post->ID, '_st_page_sidebar', true ); ?>

<!-- #page-header -->
<div id="page-header" class="clearfix">
<div class="ht-container">
<h1><?php the_title(); ?></h1>
<?php if (get_post_meta( $post->ID, '_st_page_tagline', true )) { ?>
<p><?php echo get_post_meta( $post->ID, '_st_page_tagline', true ); ?></p>
<?php } ?>
</div>
</div>
<!-- /#page-header -->

<?php if (!get_post_meta( $post->ID, '_st_page_breadcrumbs', true )) { ?>
<!-- #breadcrumbs -->
<div id="page-subnav" class="clearfix">
<div class="ht-container">
<?php 
	$st_bbpress_breadcrumbs_args = array(
			// Modify default BBPress Breadcrumbs
			'before'          => '<nav class="bbp-breadcrumb">',
			'after'           => '</nav>',
			'sep'             => __( '&frasl;', 'bbpress' ),
	);
	bbp_breadcrumb($st_bbpress_breadcrumbs_args); ?>
</div>
</div>
<!-- /#breadcrumbs -->
<?php } ?>

    
<!-- #primary -->
<div id="primary" class="sidebar-<?php echo $st_page_sidebar_pos; ?> clearfix">
<div class="ht-container">
<!-- #content -->
  <section id="content" role="main">

	<?php do_action( 'bbp_before_main_content' ); ?>

	<?php do_action( 'bbp_template_notices' ); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div id="bbp-statistics" class="bbp-statistics">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">

				<?php get_the_content() ? the_content() : _e( '<p>Here are the statistics and popular topics of our forums.</p>', 'bbpress' ); ?>

				<div id="bbpress-forums">

					<dl role="main">

						<?php do_action( 'bbp_before_statistics' ); ?>

						<dt><?php _e( 'Registered Users', 'bbpress' ); ?></dt>
						<dd>
							<strong><?php echo $user_count; ?></strong>
						</dd>

						<dt><?php _e( 'Forums', 'bbpress' ); ?></dt>
						<dd>
							<strong><?php echo $forum_count; ?></strong>
						</dd>

						<dt><?php _e( 'Topics', 'bbpress' ); ?></dt>
						<dd>
							<strong><?php echo $topic_count; ?></strong>
						</dd>

						<dt><?php _e( 'Replies', 'bbpress' ); ?></dt>
						<dd>
							<strong><?php echo $reply_count; ?></strong>
						</dd>

						<dt><?php _e( 'Topic Tags', 'bbpress' ); ?></dt>
						<dd>
							<strong><?php echo $topic_tag_count; ?></strong>
						</dd>

						<?php if ( !empty( $empty_topic_tag_count ) ) : ?>

							<dt><?php _e( 'Empty Topic Tags', 'bbpress' ); ?></dt>
							<dd>
								<strong><?php echo $empty_topic_tag_count; ?></strong>
							</dd>

						<?php endif; ?>

						<?php if ( !empty( $topic_count_hidden ) ) : ?>

							<dt><?php _e( 'Hidden Topics', 'bbpress' ); ?></dt>
							<dd>
								<strong>
									<abbr title="<?php echo esc_attr( $hidden_topic_title ); ?>"><?php echo $topic_count_hidden; ?></abbr>
								</strong>
							</dd>

						<?php endif; ?>

						<?php if ( !empty( $reply_count_hidden ) ) : ?>

							<dt><?php _e( 'Hidden Replies', 'bbpress' ); ?></dt>
							<dd>
								<strong>
									<abbr title="<?php echo esc_attr( $hidden_reply_title ); ?>"><?php echo $reply_count_hidden; ?></abbr>
								</strong>
							</dd>

						<?php endif; ?>

						<?php do_action( 'bbp_after_statistics' ); ?>

					</dl>

					<?php do_action( 'bbp_before_popular_topics' ); ?>

					<?php bbp_set_query_name( 'bbp_popular_topics' ); ?>

					<?php if ( bbp_has_topics( array( 'meta_key' => '_bbp_reply_count', 'posts_per_page' => 15, 'max_num_pages' => 1, 'orderby' => 'meta_value_num', 'show_stickies' => false ) ) ) : ?>

						<h2 class="entry-title"><?php _e( 'Popular Topics', 'bbpress' ); ?></h2>

						<?php bbp_get_template_part( 'pagination', 'topics' ); ?>

						<?php bbp_get_template_part( 'loop',       'topics' ); ?>

						<?php bbp_get_template_part( 'pagination', 'topics' ); ?>

					<?php endif; ?>

					<?php bbp_reset_query_name(); ?>

					<?php do_action( 'bbp_after_popular_topics' ); ?>

				</div>
			</div>
		</div><!-- #bbp-statistics -->

	<?php endwhile; ?>

	<?php do_action( 'bbp_after_main_content' ); ?>

  </section>
  <!-- #content -->

  <?php if ($st_page_sidebar_pos != 'off') {
  get_sidebar();
  } ?>
</div>
</div>
<!-- #primary -->
<?php get_footer(); ?>
