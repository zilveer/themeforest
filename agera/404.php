<?php

	/**
	* 404 Page
	*
	* @package WordPress
	* @subpackage Agera
	*/	
global $mp_option;
get_header(); 
//flush_rewrite_rules();
?>
	<style>
		#content {
			background: url(<?php echo $mp_option['agera_404']; ?>) no-repeat;
		}
	</style>
	
	<div id="content" class="page-404">				
		<div class="posts-container left">
			<article class="blog-post">
            	<h2 class="mpc-page-title"><?php _e('Page 404', 'agera') ?></h2>         
					<p><?php _e( 'Sorry but you are looking for something that simply isn\'t there. ', 'agera' ); ?></p>
			</article>
		
		</div><!-- #main_content -->   
	    <aside class="sidebar sidebar-right">
	   		<?php get_sidebar(); ?>
		</aside> <!-- end sidebar --> 
	</div><!-- content -->
<?php get_footer(); ?>