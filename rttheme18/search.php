<?php
/* 
* rt-theme product taxomony categories
*/
global $rt_sidebar_location, $rt_title;

$layout = get_option(RT_THEMESLUG."_blog_layout");

$rt_title = sprintf( __( 'Search Results for: %s', 'rt_theme' ), get_search_query() );

//more splitter 0 = split content with more tag, 1 = ignore more tag
$more = 1; 	  

get_header();	
?>
<section class="content_block_background">
	<section class="content_block clearfix">
			<section id="search-results" class="<?php echo "content ".$rt_sidebar_location[0] ; ?>" >		
			<div class="row">

				<?php do_action( "get_info_bar", apply_filters( 'get_info_bar_search', array( "called_for" => "inside_content" ) ) ); ?>


				<?php if ( have_posts() ) : 

					while ( have_posts() ) : the_post(); ?>

							<article class="search_result loop" id="post-<?php the_ID(); ?>"> 

								<div class="search-post-title">
									<span class="icon-right-hand"></span> <a href="<?php echo get_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a> 				 
								</div><!-- / end div  .post-title-holder -->

								<?php 
									$the_excerpt = rt_search_highlight( trim( get_search_query() ), get_the_excerpt() );						
									echo $the_excerpt;
								?>

							</article>  

					<?php
					endwhile;

					rt_get_pagination( $wp_query );
					wp_reset_query();
				else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>

			</div>
			</section><!-- / end section .content -->  
		<?php get_sidebar(); ?>
	</section>
</section>

<?php get_footer(); ?>