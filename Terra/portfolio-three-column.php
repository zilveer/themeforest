<?php
/**
 * Template Name: Template - Portfolio Page
 *
 * A Full Width custom page template without sidebar.
 * @package WordPress
 */

get_header(); ?>



<?php if((is_page() || is_single()) && !is_front_page()): ?>
	<div class="full_container_page_title">	
		<div class="container animationStart">		
			<div class="row no_bm">
				<div class="sixteen columns">
				    <?php boc_breadcrumbs(); ?>
					<div class="page_heading"><h1><?php the_title(); ?></h1></div>
				</div>		
			</div>
		</div>
	</div>
<?php endif; ?>




		<!-- Portfolio -->
		
		<script type="text/javascript">
		jQuery(document).ready(function($){
		    $('#portfolio_filter').hover(
		            function() {
		                $('#filter_list').stop(false, true).slideDown({
		                	duration:500,
		                	easing:"easeOutExpo"});
		            },
		            function() {
		                $('#filter_list').stop(false, true).slideUp({
		                	duration:200,
		                	easing:"easeOutExpo"});
		            }
			);
		});
		
		jQuery(window).load(function(){
			jQuery(function($){
		        
		        var $container = $('#portfolio_items');
	
		        $container.isotope({
		          itemSelector : '.element'
		        });
		        
		        
		        var $optionSets = $('#filter_list'),
		            $optionLinks = $optionSets.find('li div');
	
		        $optionLinks.click(function(){
		        	var selector = $(this).attr('data-option-value');
		        	$container.isotope({ filter: selector });
		        	
		        	
		        	$("#current_filter").html($(this).html());
		        	$('#filter_list').stop(false, true).slideUp({
	                	duration:100,
	                	easing:"easeOutExpo"});
		        	return false;
		        });
		        
		      });
			
			jQuery('.element').promise().done(function() {
				jQuery('.type1 .info_overlay_padding').each(function(i,el){

					 var new_overlay_w = jQuery(el).parents('.pic_info:first').width() - 20;
					 var new_overlay_h = jQuery(el).parents('.pic_info:first').height() - 20;
					 
					 jQuery(el).css({'width':new_overlay_w,'height':new_overlay_h});
				 });
			});  
		});  
			
		</script>


	<div class="container">
		
		<div class="row portfolio_section">
				
				<div class="sixteen columns">
					<?php
					$portfolio_category = get_terms('portfolio_category');
					
					if($portfolio_category): ?>			
							<div id="portfolio_filter">
						        <span id="current_filter"><?php _e('All', 'Terra');?></span>
						        <ul id="filter_list"  data-option-key="filter">
								<?php foreach($portfolio_category as $portfolio_cat): ?>		
									<li><div data-option-value=".<?php echo $portfolio_cat->slug; ?>"><?php echo $portfolio_cat->name; ?></a></li>
								<?php endforeach; ?>			        
			                    	<li><div data-option-value="*"><?php _e('All', 'Terra');?></a></li>
						        </ul>
						    </div>				    
						    <div class="portfolio_filter_showing_text"><?php _e('Filter:', 'Terra');?></div>				
					
					<?php endif; ?>
				</div>
				
		
				<div id="portfolio_items" class="clearfix animationStart">
				<?php 

					$portfolio_style = ot_get_option('portfolio_style') ? ot_get_option('portfolio_style') : 'type1';
				
					$args = array(
						'post_type' => 'portfolio',
						'posts_per_page' => (ot_get_option('portfolio_items_per_page',9) ? ot_get_option('portfolio_items_per_page',9) : 9),
						'paged' => $paged
					);
		
					$gallery = new WP_Query($args);
		
					while($gallery->have_posts()): $gallery->the_post();
						if(has_post_thumbnail()):
		
						$data_types = '';
						$cats = array();
						
						$item_cats = get_the_terms($post->ID, 'portfolio_category');
						if($item_cats):
						foreach($item_cats as $item_cat) {
							$data_types .= $item_cat->slug . ' ';
							$cats[] = $item_cat->name;
						}
						endif;
		
						$full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'portfolio-full'); ?>
						
						
							<div class="one-third column info_item element <?php echo $data_types;?>">	
								<a href="<?php the_permalink(); ?>" title="">
									<div class="pic_info <?php echo $portfolio_style;?>">
										<?php the_post_thumbnail('portfolio-medium'); ?><div class="img_overlay_icon"><span class="portfolio_icon icon_<?php echo getPortfolioItemIcon($post->ID);?>"></span></div>
										<div class="info_overlay">
											<div class="info_overlay_padding">
												<div class="info_desc">
													<span class="portfolio_icon icon_<?php echo getPortfolioItemIcon($post->ID);?>"></span>									
													<h3><?php the_title(); ?></h3>
													<p><?php echo implode(' / ', $cats);?></p>
												</div>
											</div>
										</div>
									</div>
								</a>
							</div>		
		
					<?php endif; endwhile; ?>
				</div>
				
				<script type="text/javascript">
						// Resize filter box
						var new_w = jQuery("#filter_list").width() - 20;
						jQuery("#current_filter").css('width',new_w);
		
				</script>
		
		</div>
		<!-- Portfolio::END -->		
		
		<?php boc_pagination($gallery->max_num_pages, $range = 2); ?>
	</div>
	
<?php get_footer(); ?>