<?php
get_header(); ?>

	<div class="full_container_page_title">	
		<div class="container animationStart">	
			<div class="row no_bm">
				<div class="sixteen columns">
				    <?php boc_breadcrumbs(); ?>
					<div class="page_heading"><h1><?php single_cat_title(); ?></h1></div>
				</div>
			</div>
		</div>
	</div>	
	
	
	<div class="container animationStart startNow">
		<div class="row">
							
				<?php
				
				$portfolio_style = ot_get_option('portfolio_style') ? ot_get_option('portfolio_style') : 'type1';
								
				while(have_posts()): the_post();
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
										
				?>
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
				<?php 
					endif; 
				endwhile; 
				?>
				<div class="h10 clear"></div>
			
		<?php boc_pagination(); ?>
		</div>
	
	</div>
<?php get_footer(); ?>