<?php
/**
 * Template Name: Blog
 *
 *
 * @package WordPress
 * @subpackage InTouch
 * @since InTouch 1.0
 */

get_header(); ?>

<?php 
global $ct_options, $post, $wp_query, $query, $ct_is_blogpage;

//$ct_breadcrumb = $ct_options['ct_breadcrumb'];
$show_likes = $ct_options['ct_blog_likes_meta'];
$show_comments = $ct_options['ct_blog_comments_meta'];
$show_views = $ct_options['ct_blog_views_meta'];
$show_date = $ct_options['ct_blog_date_meta'];
$show_category = $ct_options['ct_blog_categories_meta'];
$show_author = $ct_options['ct_blog_author_meta'];
$show_share = $ct_options['ct_blog_share_meta'];
$show_readmore = $ct_options['ct_blog_readmore_meta'];
$show_iframe = $ct_options['ct_blog_show_iframe'];

$pagination_type = stripslashes( $ct_options['ct_blog_pagination_type'] );
$excerpt_lenght = stripslashes( $ct_options['ct_blog_excerpt_lenght'] );

$sidebar_position = $ct_options['ct_blog_layout'];

$col_lg_push = '';
$col_lg_pull = '';
$content_class = 'col-lg-8';
$sidebar_class = 'col-lg-4';

if ( $sidebar_position == 'left-wide' ) :
	$col_lg_push = 'col-lg-push-4';
	$col_lg_pull = 'col-lg-pull-8';
elseif ( $sidebar_position == 'right-narrow' ) :
	$content_class = 'col-lg-9';
	$sidebar_class = 'col-lg-3';
elseif ( $sidebar_position == 'left-narrow' ) :
	$content_class = 'col-lg-9';
	$sidebar_class = 'col-lg-3';
	$col_lg_push = 'col-lg-push-3';
	$col_lg_pull = 'col-lg-pull-9';	
endif;
?>

<?php if ( is_active_sidebar('ct_blog_top') ): ?>
<!-- START BLOG PAGE TOP WIDGETS AREA -->
<div class="container">
	<div class="row">
		<div class="col-lg-12">
			<div class="top-widgets-area">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('ct_blog_top') ) : ?>
				<?php endif; ?>
			</div> <!-- .top-widgets-area -->
		</div><!-- .col-lg-12 -->
	</div><!-- .row -->
</div><!-- .container -->			
<!-- END BLOG PAGE TOP WIDGETS AREA -->
<?php endif; ?>	


<?php
if (is_page_template()) : $ct_is_blogpage = 1; endif;

	// What page are we on? And what is the pages limit?
	$max = $wp_query->max_num_pages;

	if ( get_query_var('paged') ) {
    	$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}

	query_posts( array( 'post_type' => 'post', 'paged' => $paged ) );


		if ( !function_exists( 'ct_blog_pagination' ) ) {
    		function ct_blog_pagination($pages = '', $range = 2)
    		{  
        		$showitems = ($range * 2)+1;  
 
		        global $paged;
		        if(empty($paged)) $paged = 1;

		        if($pages == '')
			    {
		            global $wp_query;
            		$pages = $wp_query->max_num_pages;
            		if(!$pages)
            		{
                		$pages = 1;
            		}
        		}   
 
		if(1 != $pages)
		{
			echo "<div class=\"pagination clearfix\" role=\"navigation\"><span>".__('Page ','color-theme-framework').$paged." ".__('of','color-theme-framework')." ".$pages."</span>";

			if (is_rtl()) {
				if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><i class=\"icon-double-angle-right\"></i> ".__('First','color-theme-framework')."</a>";
			} else {
				if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><i class=\"icon-double-angle-left\"></i> ".__('First','color-theme-framework')."</a>";
			}


			if (is_rtl()) {
				if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'><i class=\"icon-angle-right\"></i> ".__('Previous','color-theme-framework')."</a>";
			} else {
				if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'><i class=\"icon-angle-left\"></i> ".__('Previous','color-theme-framework')."</a>";
			}
 
			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
				}
			}
 
			if (is_rtl()) {
				if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">".__('Next','color-theme-framework')." <i class=\"icon-angle-left\"></i></a>";  
			} else {
				if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">".__('Next','color-theme-framework')." <i class=\"icon-angle-right\"></i></a>";
			}

			if (is_rtl()) {
				if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>".__('Last','color-theme-framework')." <i class=\"icon-double-angle-left\"></i></a>";
			} else {
				if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>".__('Last','color-theme-framework')." <i class=\"icon-double-angle-right\"></i></a>";
			}

			echo "</div>\n";
		}
    		}
		}

// Check if Load More Button
if ( $pagination_type == 'load_more' ) :
	wp_enqueue_script(
				'pbd-alp-load-posts',
 				get_template_directory_uri() . '/js/load-posts.js',
 				array('jquery'),
 				'1.0',
 				true
 	);

	$max = $wp_query->max_num_pages;

	if ( get_query_var('paged') ) {
    	$paged = get_query_var('paged');
	} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
	} else {
		$paged = 1;
	}

	// Add some parameters for the JS.
	wp_localize_script(
	 			'pbd-alp-load-posts',
 				'pbd_alp',
 				array(
	 				'startPage' => $paged,
 					'maxPages' => $max,
 					'nextLink' => next_posts($max, false)
 				)
 	);

 	/* Localization JS */
    $ct_blog_array = array(	'show_more'			=> __('Show More Posts', 'color-theme-framework'),
							'loading_posts' 	=> __('Loading Posts...', 'color-theme-framework'),
							'no_posts' 			=> __('No More Posts to Show', 'color-theme-framework')
					);
	wp_localize_script( 'pbd-alp-load-posts', 'ct_blog_localization', $ct_blog_array );

endif;

?>


<div class="container">
	<div class="row">
		<div id="primary" class="<?php echo $content_class.' '.$col_lg_push; ?>">
			<div id="content" role="main">
					
					<h3 class="widget-title">
						<?php _e('Blog','color-theme-framework'); ?>
						<span class="bottom-triangle"></span>
					</h3>
					<div id="entry-blog">
						<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>  >
								<?php 
								// if post has Feature image
								if(has_post_thumbnail()) : ?>
									<div class="entry-thumb">
										<?php
										if ( has_post_format ( 'video' ) ) :
											if ( $show_iframe ) :
												ct_get_video_player();
											else :
												echo ct_get_big_thumb();
												ct_get_video_icon();
											endif;
										elseif ( has_post_format ( 'audio' ) ) :
											if ( $show_iframe ) :
												ct_get_audio_player();
											else :
												echo ct_get_big_thumb();
												ct_get_audio_icon();
											endif;
   										else:
   											echo ct_get_big_thumb(); ?>
   										<?php endif; ?>
									</div><!-- .entry-thumb -->
								<?php endif; //has_post_thumbnail ?>

								<h4 class="entry-title">
									<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'color-theme-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_title(); ?></a>
								</h4><!-- .entry-title -->

								<?php if ( $excerpt_lenght != 0 ) : ?>
									<div class="entry-content">
										<?php ct_get_post_excerpt($excerpt_lenght); ?>
									</div><!-- .entry-content -->
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

									<?php if ( $show_readmore ) : ?>
										<div class="meta-readmore">
											<?php ct_get_readmore(); ?>
										</div><!-- .meta-readmore -->
									<?php endif; ?>
								</div><!-- .entry-meta -->
							</article> <!-- /post ID -->
						<?php endwhile; ?>
						<?php endif; ?>

	    <!-- Begin Navigation -->
		<?php if ( $wp_query->max_num_pages > 1 ) : ?>
		  <div class="blog-navigation clearfix" role="navigation">
			<?php if(function_exists('ct_blog_pagination')) { ct_blog_pagination($max); } ?>
		  </div> <!-- blog-navigation -->
		<?php endif; ?>
		<!-- End Navigation -->
					</div> <!-- .blog-entry -->
			</div><!-- #content -->
		</div><!-- .col-lg-8 #content -->

		<div id="secondary" class="widget-area <?php echo $sidebar_class.' '.$col_lg_pull; ?>" role="complementary">
		  <?php
		    if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("ct_blog_sidebar") ) : ?>
		  <?php endif; ?>
		</div><!-- .col-lg-4 -->
	</div><!-- .row -->
</div> <!-- .container -->

<?php wp_reset_query(); ?>

<?php get_footer(); ?>