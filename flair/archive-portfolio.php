<?php 
	get_header(); 
	$cats = get_categories('taxonomy=portfolio-category');
?>

<div class="pad90"></div>

<div class="container">
	<div class="row">
		<div class="col-sm-12 col-lg-12">
			
			<?php if(!( empty($cats) )) : ?>
				<div id="filters-container" class="cbp-l-filters-button">
			        <button data-filter="*" class="cbp-filter-item-active cbp-filter-item"><?php _e('All','flair'); ?><span class="cbp-filter-counter"></span></button>
			        <?php 
			        	foreach ($cats as $cat){
			        		echo '<button data-filter=".'. $cat->slug .'" class="cbp-filter-item">'. $cat->name .'<span class="cbp-filter-counter"></span></button>';
			        	} 
			        ?>
			    </div> 
			<?php endif; ?>
							
			<div class="cbp-l-grid-project">
			
				<div id="grid-container3" class="cbp-l-grid-projects">
					<ul>
					
						<?php 
							if ( have_posts() ) : while ( have_posts() ) : the_post();
								
								/**
								 * Get blog posts by blog layout.
								 */
								get_template_part('loop/content', 'portfolio');
							
							endwhile;	
							else : 
								
								/**
								 * Display no posts message if none are found.
								 */
								get_template_part('loop/content','none');
								
							endif;
							wp_reset_query();
						?>
					
					</ul>
				</div>
			
			</div>
			<div class="pad45"></div>

		</div>
	</div>
</div>
	
<?php 
	get_footer();