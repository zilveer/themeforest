<?php 
	get_header(); 
	
	$sidebar = get_option('show_sidebar', '1');
	$class = ( '1' == $sidebar ) ? 'col-md-8': 'col-md-12';
?>
		
<div class="pad90"></div>

<div class="container">
	<div class="row">
		<div class="col-sm-12 col-lg-12">
		
			<?php get_template_part('inc/content', 'blogtitle'); ?>
		
			<div class="row">
			
				<div class="pad30"></div>
				
				<div class="<?php echo $class; ?>">

					<?php 
						if ( have_posts() ) : while ( have_posts() ) : the_post();
							
							/**
							 * Get blog posts by blog layout.
							 */
							get_template_part('loop/content', 'post');
						
						endwhile;	
						else : 
							
							/**
							 * Display no posts message if none are found.
							 */
							get_template_part('loop/content','none');
							
						endif;
					?>
				
				</div>
				<!--/col-md-8-->
			
				<?php 
					if( '1' == $sidebar )
						get_sidebar(); 
				?>
			
			</div>
			<!--/row-->
			
			<?php 
				/**
				 * Post pagination, use ebor_pagination() first and fall back to default
				 */
				echo function_exists('ebor_pagination') ? ebor_pagination() : posts_nav_link();
			?>
			
		</div>
	</div>
</div>
	
<?php 
	get_footer();