<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage InTouch
 * @since InTouch 1.0
 */

get_header(); ?>

<?php
$about_author = $ct_options['ct_about_author'];
$ct_breadcrumb = $ct_options['ct_breadcrumb'];
$show_image = $ct_options['ct_featured_image_post'];
$show_likes = $ct_options['ct_single_likes_meta'];
$show_comments = $ct_options['ct_single_comments_meta'];
$show_views = $ct_options['ct_single_views_meta'];
$show_date = $ct_options['ct_single_date_meta'];
$show_category = $ct_options['ct_single_categories_meta'];
$show_author = $ct_options['ct_single_author_meta'];
$show_share = $ct_options['ct_single_share_meta'];
$video_thumb = get_post_meta( $post->ID, 'ct_mb_post_video_thumb', true);
$audio_thumb = get_post_meta( $post->ID, 'ct_mb_post_audio_thumb', true);
$mb_sidebar_position = get_post_meta( $post->ID, 'ct_mb_sidebar_position', true);

if ( ($mb_sidebar_position == '') and is_rtl() ) : $mb_sidebar_position = 'left-wide'; endif;

$col_lg_push = '';
$col_lg_pull = '';
$content_class = 'col-lg-8';
$sidebar_class = 'col-lg-4';

if ( $mb_sidebar_position == 'left-wide' ) :
	$col_lg_push = 'col-lg-push-4';
	$col_lg_pull = 'col-lg-pull-8';
elseif ( $mb_sidebar_position == 'right-narrow' ) :
	$content_class = 'col-lg-9';
	$sidebar_class = 'col-lg-3';
elseif ( $mb_sidebar_position == 'left-narrow' ) :
	$content_class = 'col-lg-9';
	$sidebar_class = 'col-lg-3';
	$col_lg_push = 'col-lg-push-3';
	$col_lg_pull = 'col-lg-pull-9';	
endif;

//Get post type: standard post or review
//$post_type = get_post_meta($post->ID, 'ct_mb_post_type', true);
//if( $post_type == '' ) $post_type = 'standard_post';
?>

<?php if ( $ct_breadcrumb ) : ?>
<div class="entry-navigation">
	<div class="container">
		<div class="row">
			<div class="col-lg-9">
				<div class="entry-breadcrumb ct-google-font">
					<?php ct_breadcrumb(); ?>
				</div><!-- .entry-breadcrumb -->
			</div><!-- .col-lg-9 -->
			<div class="col-lg-3">
				<nav class="nav-single">
					<h3 class="assistive-text"><i class="icon-file-text-alt"></i><?php _e( 'Posts navigation', 'color-theme-framework' ); ?></h3>
					<?php if (is_rtl()) : ?>
						<span class="nav-previous" title="<?php _e('Previous Post', 'color-theme-framework'); ?>"><?php previous_post_link( '%link', '<span class="meta-nav"><i class="icon-angle-right"></i></span>' ); ?></span>
						<span class="nav-next" title="<?php _e('Next Post', 'color-theme-framework'); ?>"><?php next_post_link( '%link', '<span class="meta-nav"><i class="icon-angle-left"></i></span>' ); ?></span>
					<?php else : ?>
						<span class="nav-previous" title="<?php _e('Previous Post', 'color-theme-framework'); ?>"><?php previous_post_link( '%link', '<span class="meta-nav"><i class="icon-angle-left"></i></span>' ); ?></span>
						<span class="nav-next" title="<?php _e('Next Post', 'color-theme-framework'); ?>"><?php next_post_link( '%link', '<span class="meta-nav"><i class="icon-angle-right"></i></span>' ); ?></span>
					<?php endif; ?>
				</nav><!-- .nav-single -->
			</div><!-- .col-lg-3 -->
		</div><!-- .row -->
	</div><!-- .container -->
</div><!-- .entry-navigation -->
<?php endif; ?>	


<?php if ( is_active_sidebar('ct_single_top') ): ?>
<!-- START TOP SINGLE WIDGETS AREA -->
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="top-widgets-area">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('ct_single_top') ) : ?>
				<?php endif; ?>
			</div> <!-- .top-widgets-area -->
		</div><!-- .col-lg-12 -->
	</div><!-- .row -->
</div><!-- .container -->			
<!-- END TOP SINGLE WIDGETS AREA -->
<?php endif; ?>	

<div class="container">
	<div class="row">
		<div id="primary" class="<?php echo $content_class.' '.$col_lg_push; ?>">
			<div id="content" role="main">
				<?php /* The loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php setPostViews(get_the_ID()); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>  >

						<?php // if post has Feature image
						if(has_post_thumbnail()) : ?>
							<div class="entry-thumb">
								<?php
								if ( has_post_format ( 'video' ) ) :
									if ( $video_thumb == 'player' ) :
										ct_get_video_player();
									elseif ( $show_image ) :
										echo ct_get_big_thumb();
									endif;
								elseif ( has_post_format ( 'audio' ) ) :
									if ( $audio_thumb == 'player' ) :
										ct_get_audio_player();
									elseif ( $show_image ) :
										echo ct_get_big_thumb();
									endif;
								elseif ( has_post_format ( 'gallery' ) ) :
									echo ct_get_gallery();
	    						elseif ( $show_image ) :
	    							echo ct_get_big_thumb(); ?>
	    						<?php endif; ?>
							</div><!-- .entry-thumb -->
						<?php endif; //has_post_thumbnail ?>

						<h1 class="entry-title">
							<?php the_title(); ?>
						</h1><!-- .entry-title -->

						<div class="entry-content clearfix">
							<?php the_content(); ?>

							<?php // Displays a link to edit the current post, if a user is logged in and allowed to edit the post
							edit_post_link( __( 'Edit', 'color-theme-framework' ), '<span class="edit-link"><i class="icon-pencil"></i>', '</span>' );
							?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'color-theme-framework' ), 'after' => '</div>' ) ); ?>
						</div><!-- .entry-content -->

						<?php if ( get_the_tags($post->ID) ) : ?>
							<div class="entry-tags ct-google-font">
								<span><?php _e('Tags: ','color-theme-framework'); ?></span>
								<?php echo the_tags('',', ',''); ?>
							</div><!-- .entry-tags -->
						<?php endif; ?>

						<div class="entry-meta clearfix ct-google-font">
							<?php if ( $show_author ) :
								ct_get_meta_author();
							endif; ?>

							<?php if ( $show_views ) :
								ct_get_meta_views();
							endif; ?>

							<?php if ( $show_likes ) :
								ct_get_meta_likes();
							endif; ?>

							<?php if ( $show_date ) :
								ct_get_meta_date();
							endif; ?>

							<?php if ( $show_category ) :
								ct_get_meta_category();
							endif; ?>

							<?php if ( $show_comments and comments_open() ) :
								ct_get_meta_comments();
							endif; ?>

							<?php if ( $show_share ) :
								echo ct_get_meta_share();
							endif; ?>
						</div><!-- .entry-meta -->
					</article> <!-- /post ID -->

					<nav class="nav-single-hidden">
						<?php if( get_previous_post() ) : ?>
							<span class="nav-previous"><?php previous_posts_link(); ?></span>
						<?php endif; ?>
						<?php if( get_next_post() ) : ?>
							<!-- next_posts_link -->
							<span class="nav-next"><?php next_posts_link(); ?></span>
						<?php endif; ?>	
					</nav><!-- .nav-single-hidden -->

					<?php if ( $about_author ) : ?>
						<div class="author-info clearfix">
							<div class="author-avatar">
								<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentythirteen_author_bio_avatar_size', 75),'',get_the_author_meta('display_name') ); ?>
								<div class="author-social-icons">
									<?php if ( get_the_author_meta( 'twitter' ) ) { ?>
										<span class="ct-twitter-ico">
											<a href="<?php the_author_meta( 'twitter' ); ?>" title="<?php printf( __( 'Follow %s on Twitter', 'color-theme-framework' ), get_the_author_meta( 'display_name' ) ); ?>"><i class="icon-twitter-sign"></i></a>
										</span>
									<?php } // End check for twitter ?>
									<?php if ( get_the_author_meta( 'facebook' ) ) { ?>
										<span class="ct-facebook-ico">
											<a href="<?php the_author_meta( 'facebook' ); ?>" title="<?php printf( __( 'Follow %s on Facebook', 'color-theme-framework' ), get_the_author_meta( 'display_name' ) ); ?>"><i class="icon-facebook-sign"></i></a>
										</span>
									<?php } // End check for facebook ?>
									<?php if ( get_the_author_meta( 'google_plus' ) ) { ?>
										<span class="ct-google-ico">
											<a href="<?php the_author_meta( 'google_plus' ); ?>" title="<?php printf( __( 'Follow %s on Google Plus', 'color-theme-framework' ), get_the_author_meta( 'display_name' ) ); ?>"><i class="icon-google-plus-sign"></i></a>
										</span>
									<?php } // End check for facebook ?>
									<?php if ( get_the_author_meta( 'pinterest' ) ) { ?>
										<span class="ct-pinterest-ico">
											<a href="<?php the_author_meta( 'pinterest' ); ?>" title="<?php printf( __( 'Follow %s on Pinterest', 'color-theme-framework' ), get_the_author_meta( 'display_name' ) ); ?>"><i class="icon-pinterest-sign"></i></a>
										</span>
									<?php } // End check for facebook ?>
								</div><!-- .author-social-icons -->
							</div><!-- .author-avatar -->
							<div class="author-description">
								<h2 class="author-title"><?php printf( __( 'About %s', 'color-theme-framework' ), get_the_author() ); ?></h2>
								<p class="author-bio">
									<?php the_author_meta( 'description' ); ?>
									<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
										<?php
										if (is_rtl()) :
											printf( __( 'View all posts by %s <span class="meta-nav">&larr;</span>', 'color-theme-framework' ), get_the_author() );
										else :
											printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'color-theme-framework' ), get_the_author() );
										endif;
										?>
									</a>
								</p>
							</div><!-- .author-description -->
						</div><!-- .author-info -->
	  				<?php endif; ?>

					<?php if ( comments_open() ) : ?>
						<?php comments_template( '', true ); ?>
					<?php endif; ?>	
				<?php endwhile; // end of the loop. ?>
			</div><!-- #content -->
		</div><!-- .col-lg-8 #content -->

		<div id="secondary" class="widget-area <?php echo $sidebar_class.' '.$col_lg_pull; ?>" role="complementary">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('ct_single_sidebar') ) : ?>
			<?php endif; ?>
		</div><!-- .col-lg-4 -->
	</div><!-- .row -->
</div> <!-- .container -->

<?php get_footer(); ?>