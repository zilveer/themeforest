<?php
/* 
* rt-theme archive
*/
global $rt_sidebar_location, $rt_title;

	$rt_pagination =true;
	$layout = "three"; //show posts in three columns - available values = one, two, three, four, five

	if ( is_day() ) :
		$rt_title = sprintf( __( 'Daily Archives: %s', 'rt_theme' ), get_the_date() );
	elseif ( is_month() ) :
		$rt_title = sprintf( __( 'Monthly Archives: %s', 'rt_theme' ), get_the_date( __( 'F Y', 'rt_theme' ) ) );
	elseif ( is_year() ) :
		$rt_title = sprintf( __( 'Yearly Archives: %s', 'rt_theme' ), get_the_date( __( 'Y', 'rt_theme' ) ) );
	elseif ( is_author() ) :
	 	$rt_title = sprintf( __( 'All posts by: %s', 'rt_theme' ), get_the_author()  ); 
	elseif ( is_tag() ) :
	 	$rt_title = sprintf( __( 'Tag Archives: %s', 'rt_theme' ), single_tag_title( '', false ) );
	else :
		$rt_title = __( 'Archives', 'rt_theme' );
	endif;


get_header();	
?>

<section class="content_block_background">
	<section class="content_block clearfix archives">
		<section <?php post_class("content ".$rt_sidebar_location[0] ); ?> >		
		<div class="row">

			<?php do_action( "get_info_bar", apply_filters( 'get_info_bar_archives', array( "called_for" => "inside_content" ) ) ); ?>
	 
			<?php if( is_author() ){
				get_template_part("author","bio");
			}	 	
			?>		

			<?php if ( have_posts() ) : 
								
				do_action( "blog_post_loop", $wp_query, $layout, true);
				
			else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>

		</div>
		</section><!-- / end section .content -->  


		<?php get_sidebar(); ?>
	</section>
</section>

<?php get_footer(); ?>