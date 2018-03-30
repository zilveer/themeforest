<?php 
/**
 * The template for displaying Search Results pages
 *
 * @package WordPress
 * @subpackage Ken
 * @since Ken 1.0
 */

global $post; 
$layout = 'right';


get_header(); ?>
<div id="theme-page" class="page-master-holder">
	<div class="background-img background-img--page"></div>
	<div class="mk-main-wrapper-holder">
	<div class="theme-page-wrapper mk-main-wrapper <?php echo $layout; ?>-layout mk-grid vc_row-fluid">
		<div class="theme-content" itemprop="mainContentOfPage">
		<section class="mk-search-loop">	
		<?php

				if ( have_posts() ):
					while ( have_posts() ) :
						the_post();

						$post_type =  get_post_type();
				?>

					<article class="blog-list-entry">


						<?php /* Search post type icons that defines result post type */ ?>
						<div class="list-posttype-col">
							<a href="<?php echo get_permalink(); ?>" class="post-type-icon"><i class="mk-theme-icon-<?php echo $post_type; ?>"></i></a>
						</div>
						<?php /******** ?>



						<? /* Search content column that has all the data */ ?>
						<div class="list-content-col">
								<h3 class="the-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>

								<div class="listtype-meta">
									
									<?php if($post_type != 'page') : ?>
									<time datetime="<?php the_time( 'F, j' ); ?>" itemprop="datePublished" pubdate>
										<a href="<?php echo get_month_link( get_the_time( "Y" ), get_the_time( "m" ) ); ?>"><?php the_date(); ?></a>
									</time>
									<?php endif; ?>


									<?php if($post_type == 'post') { ?>

									<span><?php echo get_the_category_list( ', ' ); ?></span>
									
									<?php } elseif ($post_type == 'portfolio') { ?>

									<span><?php echo implode( ', ', mk_get_portfolio_tax($post->ID, false) ); ?></span>
									<?php } ?>

								</div>

								<!--<div class="the-excerpt"><?php //the_excerpt(); ?></div>-->
						</div>
						<?php /**********/ ?>
				</article>

				<?php

				endwhile;
				
				mk_theme_blog_pagenavi($before = '', $after = '', NULL, $paged);
				
				wp_reset_query();

				else :
?>

				<h3><?php _e('Nothing Found', 'mk_framework'); ?></h3>
				<p><?php _e('Sorry, Nothing found! Try searching a different phrase.', 'mk_framework'); ?></p>

<?php 
				get_search_form();

				endif;
			?>
			</section>
		</div>
	<?php if($layout != 'full') get_sidebar(); ?>	
	<div class="clearboth"></div>	
	</div>
	<div class="clearboth"></div>
	</div>
</div>
<?php get_footer(); ?>