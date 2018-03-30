<?php
/**
 * The Template for displaying single portfolio project.
 *
 */

	get_header();
?>
<div class="page-heading bc-type-<?php echo esc_attr( etheme_get_option('breadcrumb_type') ); ?>">
	<div class="container">
		<div class="row">
			<div class="col-md-12 a-center">
				<h1 class="title"><span><?php the_title(); ?></span></h1>
				<?php etheme_breadcrumbs(); ?>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="page-content sidebar-position-without">
		<div class="row">
			<div class="content col-md-12">
				<?php 
				
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$args = array(
						'post_type' => 'etheme_portfolio',
						'paged' => $paged,	
						'posts_per_page' => etheme_get_option('portfolio_count'),
					);
					$loop = new WP_Query($args);
				?>
				
       			<?php if ( have_posts() ) : ?>
					
				<?php while ( have_posts() ) : the_post(); ?>

			            <div class="portfolio-single-item">
                				<?php the_content(); ?>
		                </div>  
				
				<?php endwhile; // End the loop. Whew. ?>
					
				<?php else: ?>

					<h3><?php _e('No pages were found!', ETHEME_DOMAIN) ?></h3>

				<?php endif; ?>
				<div class="clear"></div>
				
	    		<?php
					if(etheme_get_option('recent_projects')) {
		    			echo etheme_get_recent_portfolio(8, __('Recent Works', ETHEME_DOMAIN), $post->ID);
					}
	    			
	    			if(etheme_get_option('portfolio_comments')) {
		    			comments_template( '', true );
	    			}
	    		?>

			</div>
		</div>

	</div>
</div>
	
<?php
	get_footer();
?>