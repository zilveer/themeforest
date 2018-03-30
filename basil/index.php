<?php get_header();

$sections = array();

if ( is_page() ){

	$header_style = ot_get_option('to_header_style','full');
	switch($header_style){
		case 'full' :
			$slider_class = '';
			$slider_img_class = 'short';
			$slider_image_size = '_tpl_recipe_slider_short';
		break;
		case 'floating' :
			$slider_class = ' basilSliderTall';
			$slider_img_class = 'tall';
			$slider_image_size = '_tpl_recipe_slider_tall';
		break;
		case 'transparent' :
			$slider_class = ' basilSliderTall';
			$slider_img_class = 'tall';
			$slider_image_size = '_tpl_recipe_slider_tall';
		break;
		
	}

	$tweets_slider_count = 0;
	
	// Loop through page builder content
	if ( !function_exists('carbon_get_post_meta') ) {
		return '';
	}
	
	$sections = carbon_get_post_meta($post->ID, 'basil_page_sections', 'complex');
	
}
	
if (empty($sections)){
	
	// Page defaults set here
	$postListStyle = ot_get_option('to_general_blog_style','List');
	$bg_color = '';
	$sectionAnimation = false;
	if ($postListStyle == 'Panels' && !is_single()) { $content_position = 'full'; } else { $content_position = 'left'; }
	$sectionAnimation = false;
	$hide_title = false;
	$sidebar = false;
	
	if (is_single()):
		$content_position = carbon_get_post_meta($post->ID, 'post_content_position');
		$hide_title = carbon_get_post_meta($post->ID, 'post_hide_title');
		$sidebar = carbon_get_post_meta($post->ID, 'post_sidebar');
	endif;
	
	?>
	<!-- PAGE CONTENT -->
	<section class="basilHPBlock <?php echo $bg_color; ?> basil<?php echo ucwords($content_position); ?>Content">
		<div class="basilShell">
		
			<?php if ($sectionAnimation): ?><div class="wow <?php echo $sectionAnimation; ?>" data-wow-offset="50" data-wow-duration="0.75s"><?php endif; ?>
		
			<article class="basilPageContent">
				<?php
				if (!$hide_title) { basil_page_title(); }
				get_template_part('loop'); # Loop
				?>
			</article>
			
			<?php
			
			// Sidebar
			if ($content_position != 'full') {
			
				?><aside class="basilSidebar"><?php
				
				if ( !$sidebar) {
					$sidebar = 'default-sidebar';
				}
					
				echo '<div class="sidebar ' . basil_get_sidebar_position() . '">';
					echo '<ul class="widgets">';
						dynamic_sidebar($sidebar);
					echo '</ul>';
				echo '</div>';
				
				?></aside><?php
			
			} ?>
			
			<?php if ($sectionAnimation): ?></div><?php endif; ?>
				
		</div>
	</section>
	<?php
	
} else {

	// Sort the sections by key (for those servers that are messing with the order for some reason)
	ksort($sections);
	$slider_on_page = false;
	
	foreach ($sections as $s) {
	
		$section_type = $s['_type'];
		
		switch($section_type){
			
			case '_recipe_slider' :
			
				$disabled = $s['disabled'];
				
				if (!$disabled):
				
					// Is Cooked active?
					if(class_exists('cooked_plugin')) {
					
						$recipe_info = cp_recipe_info_settings();
				
						$sectionAnimation = $s['section_animation'];
						$recipeSlider = isset($s['recipe_slider']) ? $s['recipe_slider'] : array();
						
						if (empty($recipeSlider)):
											
							$recipe_query = new WP_Query(
								array(
									'orderby' => 'date',
									'order' => 'desc',
									'post_type' => 'cp_recipe',
									'posts_per_page' => 5,
									'meta_query' => array(
										array(
											'key'     => '_cp_private_recipe',
											'compare' => 'NOT EXISTS'
										)
									)
								)
							);
							if ($recipe_query->have_posts()): while ($recipe_query->have_posts()): $recipe_query->the_post();
								$recipeSlider[] = array('recipe' => $post->ID);
							endwhile; endif;
							
							wp_reset_query();
							
						endif;
						
						?><!-- SLIDER -->
						<section class="basilSlider<?php echo $slider_class; ?><?php if ($sectionAnimation): echo ' wow '.$sectionAnimation; endif; ?>" <?php if ($sectionAnimation): echo ' data-wow-offset="50" data-wow-duration="0.75s"'; endif; ?>>
							<div class="basilImageSlider">
								<?php foreach($recipeSlider as $slider):
									$recipe_id = $slider['recipe'];
									$recipe_image = get_post_thumbnail_id($recipe_id);
									$recipe_image = wp_get_attachment_image_src($recipe_image, 'basil_tpl_recipe_slider_'.$slider_img_class);
									$private_recipe = get_post_meta($recipe_id, '_cp_private_recipe', true);
									if (!$private_recipe && $recipe_id): ?>
										<div class="basilSlide" style="background:url('<?php echo $recipe_image[0]; ?>') center center; background-size:cover;"></div>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
							<div class="basilShell">
								<div class="basilSliderNav">
									<a href="#" class="basilSliderPrev" data-wow-delay="0.5s" data-wow-duration="0.75s"><i class="fa fa-angle-left"></i></a>
									<a href="#" class="basilSliderNext" data-wow-delay="0.5s" data-wow-duration="0.75s"><i class="fa fa-angle-right"></i></a>
								</div>
								<div class="basilRecipeSlider">
									<?php
										
									foreach($recipeSlider as $slider):
									
										if ($slider['recipe']):

											$recipe_query = new WP_Query( array('p' => $slider['recipe'],'post_type' => 'cp_recipe') );
											if ( $recipe_query->have_posts() ) {
												
												$recipe_query->the_post();
												$entry_id = $post->ID;
												$entry_link = get_permalink($entry_id);
												$entry_image = get_post_thumbnail_id($entry_id);
												$entry_title = get_the_title($entry_id);
												$entry_rating = cp_recipe_rating($entry_id);
												$entry_description = get_post_meta($entry_id, '_cp_recipe_short_description', true);
												$entry_excerpt = get_post_meta($entry_id, '_cp_recipe_excerpt', true);
												$prep_time = get_post_meta($entry_id, '_cp_recipe_prep_time', true);
												$cook_time = get_post_meta($entry_id, '_cp_recipe_cook_time', true);
												$total_time = $prep_time + $cook_time;
												$entry_yields = get_post_meta($entry_id, '_cp_recipe_yields', true);
												$private_recipe = get_post_meta($entry_id, '_cp_private_recipe', true);
												if (!$private_recipe && $entry_id): ?>
													
													<div class="basilSlide">
														
														<div class="mobile-image">
															<?php	
															$recipe_image = get_post_thumbnail_id($entry_id);
															$recipe_mobile_image = wp_get_attachment_image_src($recipe_image, 'basil_post_thumbnail_small_rt');
															?>
															<img src="<?php echo $recipe_mobile_image[0]; ?>">
														</div>
														
														<div class="result-box item">
															<div class="box">
																<div class="box-entry">
																	<h2><a href="<?php echo $entry_link; ?>"><?php echo $entry_title; ?></a><?php
																		if (in_array('difficulty_level', $recipe_info)) :
																			$difficulty_level = get_post_meta($entry_id, '_cp_recipe_difficulty_level', true);
																			cp_difficulty_level($difficulty_level);
																		endif;
																	?></h2>
																	<?php if (in_array('author', $recipe_info)) :
									
																		echo '<p class="terms-list">';
																		
																		$author_id = get_the_author_meta('ID');
																		$nickname = get_the_author_meta('nickname');
																		$username = get_the_author_meta('user_login');
																		if (!$nickname) { $nickname = $username; }
																		$username = cp_create_slug($username);
																		
																		$avatar_image = false;
																		if (in_array('author_avatar', $recipe_info)) :
																			$avatar_image = cp_avatar($author_id,50);
																		endif;
																		
																		$profile_page_link = (get_option('cp_profile_page') ? get_permalink(get_option('cp_profile_page')) : false);
																		$profile_page_link = rtrim($profile_page_link, '/');
																		
																		if ($profile_page_link):
																	
																			echo '<span>'.($avatar_image ? $avatar_image : '<i class="fa fa-user"></i>&nbsp;&nbsp;') . __('By','basil') . ' <a href="' . $profile_page_link . '/' . $username . '/">' . $nickname.'</a></span>';
																		
																		endif;
																		
																		echo '</p>';
																		
																	endif; ?>
																	<div class="rating rate-<?php echo $entry_rating; ?>"></div><!-- /.rating -->
																	<?php if ($entry_excerpt):
																		echo wpautop($entry_excerpt);
																	else :
																		echo wpautop($entry_description);
																	endif;
																	?>
																	
																</div><!-- /.box-entry -->
																<?php if ($entry_yields || $total_time): if (in_array('timing', $recipe_info) || in_array('yields', $recipe_info)) : ?>
																<div class="timing">
																	<ul>
																		<?php if (in_array('timing', $recipe_info)) : ?>
																			<?php if ($prep_time): ?><li><strong><?php _e('Prep','basil'); ?>:</strong> <?php echo cp_format_time($prep_time); ?></li><?php endif; ?>
																			<?php if ($cook_time): ?><li><strong><?php _e('Cook','basil'); ?>:</strong> <?php echo cp_format_time($cook_time); ?></li><?php endif; ?>
																		<?php endif; ?>
																		<?php if (in_array('yields', $recipe_info) && $entry_yields) : ?><li><strong><?php _e('Yields','basil'); ?>:</strong> <?php echo $entry_yields; ?></li><?php endif; ?>
																	</ul>
																</div><!-- /.timing -->
																<?php endif; endif; ?>
															</div><!-- /.box -->
														</div>
													</div><?php
													
												endif;
													
												wp_reset_query();
													
											}
										endif;
									
									endforeach; $slider_on_page = true;
								?></div>
								<div class="basilRecipeSliderBG"></div>
							</div>
						</section>
						<div class="transparentHeaderBG"></div>
						<?php
											
					} // End if Cooked is active
					
				endif;
			
			break;
			
			case '_featured_recipes' :
			
				$disabled = $s['disabled'];
				
				if (!$disabled):
				
					// Is Cooked active?
					if(class_exists('cooked_plugin')) {
					
						$recipe_info = cp_recipe_info_settings();
					
						$bg_color = $s['bg_color'];
						$section_title = $s['featured_title'];
						$featuredRecipes = isset($s['featured_recipes']) ? $s['featured_recipes'] : array();
						$button_text = $s['button_text'];
						$button_url = $s['button_url'];
						$button_icon = $s['button_icon'];
						$sectionAnimation = $s['section_animation'];
					
						?><!-- FEATURED RECIPES -->
						<section class="basilHPBlock <?php echo $bg_color; ?>">
							<div class="basilShell">
								<?php if ($sectionAnimation): ?><div class="wow <?php echo $sectionAnimation; ?>" data-wow-offset="50" data-wow-duration="0.75s"><?php endif; ?>
								<h2 class="basilHeading">
									<span><?php echo $section_title; ?></span><?php
									if ($button_text && $button_url): ?>
									
										<span class="basilH2ButtonWrapper">
											<a href="<?php echo $button_url; ?>" class="basilButton bgColor-1"><?php
												if ($button_icon): ?><i class="fa <?php echo $button_icon; ?>"></i>&nbsp;&nbsp;<?php endif;
											echo $button_text; ?></a>
										</span>
										
									<?php endif;
								?></h2>
								<div class="basilFeatured">
									<div class="result-section masonry-layout">
										<div class="loading-content">
										
											<div class="grid-sizer"></div>
										
											<?php 
												
											if (empty($featuredRecipes)):
											
												$recipe_query = new WP_Query(
													array(
														'orderby' => 'date',
														'order' => 'desc',
														'post_type' => 'cp_recipe',
														'posts_per_page' => 3,
														'meta_query' => array(
															array(
																'key'     => '_cp_private_recipe',
																'compare' => 'NOT EXISTS'
															)
														)
													)
												);
												if ($recipe_query->have_posts()): while ($recipe_query->have_posts()): $recipe_query->the_post();
													$featuredRecipes[] = array('recipe' => $post->ID);
												endwhile; endif;
												
												wp_reset_query();
												
											endif;
											
											foreach($featuredRecipes as $recipe):
											
												if ($recipe['recipe']):
											
													$recipe_query = new WP_Query( array('p' => $recipe['recipe'],'post_type' => 'cp_recipe') );
												
													if ( $recipe_query->have_posts() ) {
														
														$recipe_query->the_post();
														$entry_id = get_the_ID();
														$entry_link = get_permalink($entry_id);
														$entry_image = get_post_thumbnail_id($entry_id);
														$entry_title = get_the_title($entry_id);
														$entry_rating = cp_recipe_rating($entry_id);
														$entry_description = get_post_meta($entry_id, '_cp_recipe_short_description', true);
														$entry_excerpt = get_post_meta($entry_id, '_cp_recipe_excerpt', true);
														$prep_time = get_post_meta($entry_id, '_cp_recipe_prep_time', true);
														$cook_time = get_post_meta($entry_id, '_cp_recipe_cook_time', true);
														$total_time = $prep_time + $cook_time;
														$entry_yields = get_post_meta($entry_id, '_cp_recipe_yields', true);
														$private_recipe = get_post_meta($entry_id, '_cp_private_recipe', true);
														
														if (!$private_recipe):
														
															?><div class="result-box item">
																<div class="box">
																	<div class="box-img">
																		<?php if(!empty($entry_image)) {
																			echo '<a href="'.$entry_link.'">'.wp_get_attachment_image($entry_image, 'cp_298_192').'</a>';
																		} ?>
																	</div><!-- /.box-img -->
																	<div class="box-entry">
																		<h2><a href="<?php echo $entry_link; ?>"><?php echo $entry_title; ?></a><?php
																			if (in_array('difficulty_level', $recipe_info)) :
																				$difficulty_level = get_post_meta($entry_id, '_cp_recipe_difficulty_level', true);
																				cp_difficulty_level($difficulty_level);
																			endif;
																		?></h2>
																		<?php if (in_array('rating', $recipe_info)) : ?><div class="rating rate-<?php echo $entry_rating; ?>"></div><!-- /.rating --><?php endif; ?>
																		<?php if (in_array('description', $recipe_info)) :
																			if ($entry_excerpt):
																				echo wpautop($entry_excerpt);
																			else :
																				echo wpautop($entry_description);
																			endif;
																		endif; ?>
																		<?php if (in_array('author', $recipe_info)) :
										
																			echo '<p class="terms-list">';
																			
																			$author_id = get_the_author_meta('ID');
																			$nickname = get_the_author_meta('nickname');
																			$username = get_the_author_meta('user_login');
																			if (!$nickname) { $nickname = $username; }
																			$username = cp_create_slug($username);
																			
																			$avatar_image = false;
																			if (in_array('author_avatar', $recipe_info)) :
																				$avatar_image = cp_avatar($author_id,50);
																			endif;
																			
																			$profile_page_link = (get_option('cp_profile_page') ? get_permalink(get_option('cp_profile_page')) : false);
																			$profile_page_link = rtrim($profile_page_link, '/');
																			
																			if ($profile_page_link):
																		
																				echo '<span>'.($avatar_image ? $avatar_image : '<i class="fa fa-user"></i>&nbsp;&nbsp;') . __('By','basil') . ' <a href="' . $profile_page_link . '/' . $username . '/">' . $nickname.'</a></span>';
																			
																			endif;
																			
																			echo '</p>';
																			
																		endif; ?>
																	</div><!-- /.box-entry -->
																	<?php if ($entry_yields || $total_time): if (in_array('timing', $recipe_info) || in_array('yields', $recipe_info)) : ?>
																	<div class="box-footer">
																		<div class="timing">
																			<ul>
																				<?php if (in_array('timing', $recipe_info)) : ?>
																					<?php if ($prep_time): ?><li><strong><?php _e('Prep','basil'); ?>:</strong> <?php echo cp_format_time($prep_time); ?></li><?php endif; ?>
																					<?php if ($cook_time): ?><li><strong><?php _e('Cook','basil'); ?>:</strong> <?php echo cp_format_time($cook_time); ?></li><?php endif; ?>
																				<?php endif; ?>
																				<?php if (in_array('yields', $recipe_info) && $entry_yields) : ?><li><strong><?php _e('Yields','basil'); ?>:</strong> <?php echo $entry_yields; ?></li><?php endif; ?>
																			</ul>
																		</div><!-- /.timing -->
																	</div><!-- /.box-footer -->
																	<?php endif; endif; ?>
																</div><!-- /.box -->
															</div><!-- /.result-box --><?php
														
															wp_reset_query();
															
														endif;
													
													}
													
												endif;
											
											endforeach; ?>
										
										</div><!-- /.loading-content -->
									</div><!-- /.result-section -->
								</div><!-- /.basilFeatured -->
								
								<?php if ($sectionAnimation): ?></div><?php endif; ?>
							</div>
						</section><?php
					
					} // End if Cooked is active
						
				endif;
			
			break;
			
			case '_featured_products' :
			
				$disabled = $s['disabled'];
				
				if (!$disabled):
				
					// Is Cooked active?
					if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
					
						$bg_color = $s['bg_color'];
						$section_title = $s['featured_title'];
						$featuredProducts = $s['featured_products'];
						$button_text = $s['button_text'];
						$button_url = $s['button_url'];
						$button_icon = $s['button_icon'];
						$sectionAnimation = $s['section_animation'];
					
						?><!-- FEATURED PRODUCTS -->
						<section class="basilHPBlock <?php echo $bg_color; ?>">
							<div class="basilShell">
								<?php if ($sectionAnimation): ?><div class="wow <?php echo $sectionAnimation; ?>" data-wow-offset="50" data-wow-duration="0.75s"><?php endif; ?>
								<h2 class="basilHeading">
									<span><?php echo $section_title; ?></span><?php
									if ($button_text && $button_url): ?>
									
										<span class="basilH2ButtonWrapper">
											<a href="<?php echo $button_url; ?>" class="basilButton bgColor-1"><?php
												if ($button_icon): ?><i class="fa <?php echo $button_icon; ?>"></i>&nbsp;&nbsp;<?php endif;
											echo $button_text; ?></a>
										</span>
										
									<?php endif;
								?></h2>
								<div class="basilFeaturedProducts">
										
									<?php $product_ids = array();
									
									foreach($featuredProducts as $product):
									
										$product_ids[] = $product['product'];
									
									endforeach;
									
									if (!empty($product_ids)): echo do_shortcode('[products columns="3" ids="'.implode(',',$product_ids).'"]'); endif; ?>
										
								</div><!-- /.basilFeatured -->
								
								<?php if ($sectionAnimation): ?></div><?php endif; ?>
							</div>
						</section><?php
					
					} // End if Cooked is active
						
				endif;
			
			break;
			
			case '_page_content' :
				
				$disabled = $s['disabled'];
				
				if (!$disabled):
				
					global $sidebar;
				
					$bg_color = $s['bg_color'];
					$content_position = $s['page_content_position'];
					$hide_title = $s['page_hide_title'];
					$sidebar = $s['page_sidebar'];
					$sectionAnimation = $s['section_animation'];
					
					?>
					<!-- PAGE CONTENT -->
					<section class="basilHPBlock <?php echo $bg_color; ?> basil<?php echo ucwords($content_position); ?>Content">
						<div class="basilShell">
						
							<?php if ($sectionAnimation): ?><div class="wow <?php echo $sectionAnimation; ?>" data-wow-offset="50" data-wow-duration="0.75s"><?php endif; ?>
						
							<article class="basilPageContent">
								<?php
								if (!$hide_title) { basil_post_title(false); }
								get_template_part('loop'); # Loop
								?>
							</article>
							
							<?php
							
							// Sidebar
							if ($content_position != 'full') {
							
								?><aside class="basilSidebar"><?php
								
								if ( !$sidebar) {
									$sidebar = 'default-sidebar';
								}
									
								echo '<div class="sidebar ' . basil_get_sidebar_position() . '">';
									echo '<ul class="widgets">';
										dynamic_sidebar($sidebar);
									echo '</ul>';
								echo '</div>';
								
								?></aside><?php
							
							} ?>
							
							<?php if ($sectionAnimation): ?></div><?php endif; ?>
								
						</div>
					</section>
					<?php
				endif;
			
			break;
			
			case '_widget_columns' :
			
				$disabled = $s['disabled'];
				
				if (!$disabled):
					$bg_color = $s['bg_color'];
					$widget_columns = $s['widget_block_columns'];
					$widget_columns_count = count($widget_columns);
					$temp_count = 1;
					$column_text = '';
					
					switch($widget_columns_count){
						
						case 1 : $column_text = ''; break;
						case 2 : $column_text = 'basilColumn-onehalf'; break;
						case 3 : $column_text = 'basilColumn-onethird'; break; 
						case 4 : $column_text = 'basilColumn-onefourth'; break;
						
					}
				
					?><!-- WIDGETS -->
					<section class="basilHPBlock <?php echo $bg_color; ?>">
						<div class="basilShell">
							<div class="basilPageWidgets cf">
							
								<?php foreach($widget_columns as $widget_column):
								
									$section_animation = $widget_column['section_animation'];
									$column_sidebar = $widget_column['sidebar'];
								
									?><div class="<?php echo $column_text; if ($temp_count == $widget_columns_count) { echo ' last'; } ?><?php if ($section_animation): echo ' wow '.$section_animation.''; endif; ?>" data-wow-offset="50" data-wow-duration="0.75s">
										<?php dynamic_sidebar($column_sidebar); ?>
									</div><?php
									
									$temp_count++;
								
								endforeach; ?>
							
							</div>
						</div>
					</section><?php
				endif;
			
			break;
			
			case '_recent_tweets' :
				
				$tweets_slider_count++;
				$disabled = $s['disabled'];
				
				if (!$disabled):
				
					$sectionAnimation = $s['section_animation'];
					$title = $s['title'];
					$load = $s['load'];
					$twitter_user = $s['twitter_user'];
										
					$twitter_helper = new TwitterHelper($twitter_user);
					$tweets = $twitter_helper->get_tweets($twitter_user, $load);
					if (!empty($tweets)) {
					
						?><!-- TWEETS SLIDER -->
						<section class="basilRecentTweets">
							<div class="basilShell">
								<?php if ($sectionAnimation): ?><div class="wow <?php echo $sectionAnimation; ?>" data-wow-offset="50" data-wow-duration="0.75s"><?php endif; ?>
								<h2><?php echo $title; ?></h2>
								<div id="<?php echo 'tweetsSlider-'.$tweets_slider_count; ?>" class="basilTweetsCarousel">
									
									<?php foreach ($tweets as $tweet) { ?>
									
									<div class="basilTweet">
										<div class="basilTweetWrapped">
											<?php echo wpautop(preg_replace('~'.preg_quote($twitter_user, '~').': ~iu', '', $tweet->tweet_text)); ?>
											<small><i class="fa fa-twitter"></i>&nbsp;<?php echo boxy_relativeTime($tweet->created_at); ?> <?php _e('via','basil'); ?> <a href="http://twitter.com/<?php echo $twitter_user; ?>" target="_blank">@<?php echo $twitter_user; ?></a></small>
										</div>
									</div>
									
									<?php } ?>
										
								</div>
								<a href="#" class="basilTweetsPrev"><i class="fa fa-angle-left"></i></a>
								<a href="#" class="basilTweetsNext"><i class="fa fa-angle-right"></i></a>
								<?php if ($sectionAnimation): ?></div><?php endif; ?>
							</div>
						</section><?php
					
					}
			
				endif;
			
			break;
			
			case '_recent_posts' :
				
				$disabled = $s['disabled'];
				
				if (!$disabled):
				
					$title = $s['title'];
					$bg_color = $s['bg_color'];
					$sectionAnimation = $s['section_animation'];
					
					$post_category = $s['post_category'];
					$post_count = $s['post_count'];
					
					$all_posts = array(
						'post_type' => 'post',
					    'posts_per_page' => $post_count
					);
					
					if (!$post_category) {
						$category_list = array();
						$post_cats = get_categories(array('type' => 'post','taxonomy' => 'category','hide_empty' => 0));
						if ($post_cats):
							foreach($post_cats as $post_cat){
								$post_category_array[] = $post_cat->term_id;
							}
							$all_posts['category__in'] = $post_category_array;
						endif;	
					} else {
						$term = get_term($post_category,'category');
						$all_posts['category_name'] = $term->slug;
					}
					
					query_posts($all_posts);
					$blog_column_count = 0; $total_count = 0;
					
					$button_text = $s['button_text'];
					$button_url = $s['button_url'];
					$button_icon = $s['button_icon'];
					
					if ( have_posts() ) : ?>
					
						<!-- BLOG -->
						<section class="basilHPBlock <?php echo $bg_color; ?>">
							<div class="basilShell">
								<?php if ($sectionAnimation): ?><div class="wow <?php echo $sectionAnimation; ?>" data-wow-offset="50" data-wow-duration="0.75s"><?php endif; ?>
								<h2 class="basilHeading">
								<span><?php echo $title; ?></span><?php
									if ($button_text && $button_url): ?>
									
										<span class="basilH2ButtonWrapper">
											<a href="<?php echo $button_url; ?>" class="basilButton bgColor-1"><?php
												if ($button_icon): ?><i class="fa <?php echo $button_icon; ?>"></i>&nbsp;&nbsp;<?php endif;
											echo $button_text; ?></a>
										</span>
										
									<?php endif;
								?></h2>
								<section class="basilPostPanels cf">
									<div class="blog-grid-sizer"></div>
									<?php while ( have_posts() ) : the_post();
										global $post, $blog_column_count; $blog_column_count++; $total_count++;
										get_template_part('singlerow','post');
									endwhile; ?>
								</section>
								<?php if ($sectionAnimation): ?></div><?php endif; ?>
							</div>
						</section><?php
						
					endif;
					
					wp_reset_query();
					
				endif;
			
			break;
			
			case '_parallax_block' :
				
				$disabled = $s['disabled'];
				
				if (!$disabled):
				
					$parallax_text = $s['parallax_text'];
					$parallax_font_size = $s['parallax_font_size'];
					$parallax_color = $s['parallax_color'];
					$parallax_text_color = $s['parallax_text_color'];
					$parallax_color_opacity = $s['parallax_color_opacity'];
					$parallax_image = $s['parallax_image'];
					
					$image_dir = site_url().'/wp-content/uploads';
					if ( strpos($parallax_image, 'http') === false ) {
						$image_url = $image_dir.'/'.$parallax_image;
					} else {
						$image_url = $parallax_image;
					}
					
					$parallax_color_opacity_lg = ($parallax_color_opacity * 100);
					
					?><section id="basilParallax_page_section" class="basilParallax-zone" style="background:url('<?php echo $image_url; ?>') no-repeat fixed center center;">
						<div class="basilParallax-wrap" style="position:relative;">
							<?php if ($parallax_color): ?><div class="basilParallax-screen" style="top:0; left:0; zoom:1; -ms-filter:'progid:DXImageTransform.Microsoft.Alpha(Opacity=<?php echo $parallax_color_opacity_lg; ?>)'; filter: alpha(opacity=<?php echo $parallax_color_opacity_lg; ?>); -moz-opacity:<?php echo $parallax_color_opacity; ?>; -khtml-opacity: <?php echo $parallax_color_opacity; ?>; opacity: <?php echo $parallax_color_opacity; ?>; background:<?php echo $parallax_color; ?>;"></div><?php endif; ?>
							<div style="font-weight:300; text-align:center; padding:100px 10%; font-size:<?php echo $parallax_font_size; ?>px; line-height:<?php echo $parallax_font_size + 15; ?>px;<?php echo ($parallax_text_color ? 'color:'.$parallax_text_color.';' : 'color:#fff;'); ?>"><?php echo $parallax_text; ?></div>
						</div>
					</section><?php
					
				endif;
			
			break;
			
		} // END SECTION TYPES
		
	} // END FOREACH SECTION
	
} // ENDIF NO SECTIONS

get_footer();