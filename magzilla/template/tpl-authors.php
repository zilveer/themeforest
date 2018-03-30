<?php 
/**
 * Template Name: Authors
 *
 * @package Magzilla
 * @since 	Magzilla 1.0
**/ 
global $ft_option;
global $main_classes;
global $sidebar_classes;
global $fave_container;
global $fave_sidebar;

get_header();

	$stick_sidebar = '';
	if( $ft_option['sticky_sidebar'] != 0 ) {
		$stick_sidebar = 'magzilla_sticky';
	}

	$fave_meta = get_post_meta( get_the_ID(), '_favethemes_meta', true );

	$fave_sidebar = $fave_meta['fave_sidebar'];
 
	if( $fave_meta['fave_use_sidebar'] == "right") {
		$main_classes = "col-lg-8 col-md-8 col-sm-8 col-xs-12";
		$sidebar_classes = "col-lg-4 col-md-4 col-sm-4 col-xs-12";

	} elseif ( $fave_meta['fave_use_sidebar'] == "left" ) {
		$main_classes = "col-lg-8 col-md-8 col-sm-8 col-xs-12 col-lg-push-4 col-md-push-4 col-sm-push-4";
		$sidebar_classes = "col-lg-4 col-md-4 col-sm-4 col-xs-12 col-lg-pull-8 col-md-pull-8 col-sm-pull-8";

	} else {
		$main_classes = "col-lg-12 col-md-12 col-sm-12 col-xs-12";
	}


$exclude_authors = get_post_meta( get_the_ID(), 'fave_exclude_authors', false );
$authors_role = get_post_meta( get_the_ID(), 'fave_authors_role', true );
$order = get_post_meta( get_the_ID(), 'fave_authors_order', true );
$orderby = get_post_meta( get_the_ID(), 'fave_authors_orderby', true );
$items_num = get_post_meta( get_the_ID(), 'fave_authors_num', true );

$query_args = array(
	'role' => $authors_role,
	'exclude' => $exclude_authors,
	'order' => $order,
	'orderby' => $orderby,
	'number' => $items_num
);
$authors = get_users( $query_args );
?>

<div class="<?php echo $fave_container; ?>">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="page-header">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</div>		
		</div><!-- col-xs-12 col-sm-12 col-md-12 col-lg-12 -->
	</div><!-- row -->

	<div class="row">
		<div class="<?php echo $main_classes; ?>">
			<main class="site-main" role="main">
				<div class="authors-archive">
					
					<?php
	                foreach ( $authors as $author ):
	                    
	                    // Get the author ID
	                    $author_id = $author->ID;
	                    ?>
							<div class="post-author-for-archive">
								<div class="media">
									<div class="media-left media-top">
										<a href="<?php echo get_author_posts_url( $author_id ); ?>">
											<img class="media-object img-circle post-author-avatar" src="<?php echo fave_get_avatar_url(get_avatar( $author_id, 70 )); ?>" alt="avatar">
										</a>
									</div>
									<div class="media-body">
										<h2 class="post-author"><?php echo get_the_author_meta( 'display_name', $author_id ); ?></h2>
										<ul class="list-inline post-meta">
											
											<li class="post-label">
													<a href="<?php echo get_author_posts_url( $author_id ); ?>">
														<i class="fa fa-bookmark"></i> <?php echo count_user_posts( $author_id ); ?> <?php _e( 'Posts', 'magzilla' ); ?>
													</a>
											</li>
											<!-- <li>|</li> -->
											<li class="post-total-comments"><i class="fa fa-comment-o"></i> <?php echo fave_user_comment_count( $author_id ); ?> <?php _e( 'Comments', 'magzilla' ); ?></li>
											<li class="post-author-social-links">
												<?php if( get_the_author_meta('fave_author_flickr', $author_id ) ) { ?>
												<a href="<?php echo esc_url( get_the_author_meta('fave_author_flickr', $author_id ) ); ?>"><i class="fa fa-flickr"></i></a>
												<?php } ?>

												<?php if( get_the_author_meta('fave_author_pinterest', $author_id ) ) { ?>
												<a href="<?php echo esc_url( get_the_author_meta('fave_author_pinterest', $author_id ) ); ?>"><i class="fa fa-pinterest-square"></i></a>
												<?php } ?>

												<?php if( get_the_author_meta('fave_author_youtube', $author_id ) ) { ?>
												<a href="<?php echo esc_url( get_the_author_meta('fave_author_youtube', $author_id ) ); ?>"><i class="fa fa-youtube-square"></i></a>
												<?php } ?>

												<?php if( get_the_author_meta('fave_author_foursquare', $author_id ) ) { ?>
												<a href="<?php echo esc_url( get_the_author_meta('fave_author_foursquare', $author_id ) ); ?>"><i class="fa fa-foursquare"></i></a>
												<?php } ?>

												<?php if( get_the_author_meta('fave_author_instagram', $author_id ) ) { ?>
												<a href="<?php echo esc_url( get_the_author_meta('fave_author_instagram', $author_id ) ); ?>"><i class="fa fa-instagram"></i></a>
												<?php } ?>

												<?php if( get_the_author_meta('fave_author_twitter', $author_id ) ) { ?>
												<a href="<?php echo esc_url( get_the_author_meta('fave_author_twitter', $author_id ) ); ?>"><i class="fa fa-twitter-square"></i></a>
												<?php } ?>

												<?php if( get_the_author_meta('fave_author_vimeo', $author_id ) ) { ?>
												<a href="<?php echo esc_url( get_the_author_meta('fave_author_vimeo', $author_id ) ); ?>"><i class="fa fa-vimeo-square"></i></a>
												<?php } ?>

												<?php if( get_the_author_meta('fave_author_facebook', $author_id ) ) { ?>
												<a href="<?php echo esc_url( get_the_author_meta('fave_author_facebook', $author_id ) ); ?>"><i class="fa fa-facebook-square"></i></a>
												<?php } ?>

												<?php if( get_the_author_meta('fave_author_google_plus', $author_id ) ) { ?>
												<a href="<?php echo esc_url( get_the_author_meta('fave_author_google_plus', $author_id ) ); ?>"><i class="fa fa-google-plus-square"></i></a>
												<?php } ?>

												<?php if( get_the_author_meta('fave_author_linkedin', $author_id ) ) { ?>
												<a href="<?php echo esc_url( get_the_author_meta('fave_author_linkedin', $author_id ) ); ?>"><i class="fa fa-linkedin-square"></i></a>
												<?php } ?>

												<?php if( get_the_author_meta('fave_author_tumblr', $author_id ) ) { ?>
												<a href="<?php echo esc_url( get_the_author_meta('fave_author_tumblr', $author_id ) ); ?>"><i class="fa fa-tumblr-square"></i></a>
												<?php } ?>

												<?php if( get_the_author_meta('fave_author_dribbble', $author_id ) ) { ?>
												<a href="<?php echo esc_url( get_the_author_meta('fave_author_dribbble', $author_id ) ); ?>"><i class="fa fa-dribbble"></i></a>
												<?php } ?>

												<?php if( get_the_author_meta('user_email', $author_id ) ) { ?>
												<a href="mailto:<?php echo get_the_author_meta('user_email' , $author_id ); ?>"><i class="fa fa-envelope"></i></a>
												<?php } ?>
											</li>
											
										</ul><!-- post-meta -->
										<p><?php echo wp_trim_words( get_the_author_meta( 'description', $author_id ), 50, '...' ); ?></p>
									</div><!-- media-body -->
								</div><!-- media -->
							</div><!-- post-author -->

						<?php endforeach; ?>	


				</div><!-- entry-content -->
			</main><!-- site-main -->
		</div><!-- col-lg-12 col-md-12 col-sm-12 col-xs-12 -->

		<?php if( $fave_meta['fave_use_sidebar'] != "none" ) { ?>
		<div class="<?php echo $sidebar_classes.' '.$stick_sidebar; ?>">
			<?php get_sidebar(); ?>
		</div><!-- col-lg-4 col-md-4 col-sm-4 col-xs-12 -->
		<?php } ?>

	</div><!-- .row -->

</div>

<?php get_footer(); ?>s