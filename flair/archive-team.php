<?php 
	get_header(); 
?>

<div class="pad90"></div>

<div class="container">
	<div class="row">
		<div class="col-sm-12 col-lg-12">
			
			<div id="grid-container" class="cbp-l-grid-team">
			    <ul class="cbp-l-grid-team">
						
						<?php 
							if ( have_posts() ) : while ( have_posts() ) : the_post(); 
							
								/**
								 * Get team member markup
								 */
								get_template_part('loop/content','team');
	
							endwhile;
							else : 
								
								/**
								 * Display no posts message if none are found.
								 */
								get_template_part('loop/content','none');
								
							endif;
						?>
			
			    </ul>
			</div>
			
			<div class="pad60"></div>

		</div>
	</div>
</div>
	
<?php 
	get_footer();