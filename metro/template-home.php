<?php
/*
Template Name: Home Page
*/

get_header(); ?>

		<!-- Content -->
		<div class="homepage-blocks">
			
					<?php
					
					$arg=array (
						'post_type' => 'homepage',
						'orderby' => 'menu_order',
						'order' => 'ASC',
						'posts_per_page' => -1
					);
					
					$custom_blocks=intval(get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'homepage_blocks', true));
					if($custom_blocks)
						$arg['post_parent']=$custom_blocks;
					
					$query = new WP_Query($arg);
					
					$size_counter=0;
					$same_height_opened=false;
					while ( $query->have_posts() ) : $query->the_post(); ?>
						<?php
							$size=get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'homepage_size', true);
							$size=intval($size);
							if(!$size)
								$size=9;

							if($size == 9 && $same_height_opened) {
								echo '</div></div></div><div class="clear anti-mar">&nbsp;</div>';
								$same_height_opened=false;
							}
							if($size < 9 && !$same_height_opened) {
								echo '<div class="blocks-same-height-uber-wrapper"><div class="blocks-same-height-wrapper"><div class="blocks-same-height">';
								$same_height_opened=true;
								$size_counter=0;
							}

							$size_counter+=$size;
							if($size_counter > 9 && $same_height_opened) {
								echo '</div></div></div><div class="clear anti-mar">&nbsp;</div><div class="blocks-same-height-uber-wrapper"><div class="blocks-same-height-wrapper"><div class="blocks-same-height">';
								$size_counter=$size;
							}
							
						
						?>
						<div class="block-<?php echo ($size==9?'full':$size) ?> bg-color-main" id="homepage-block-<?php the_ID() ?>">
							<?php $paddings=get_post_meta($post->ID, OM_THEME_SHORT_PREFIX.'homepage_paddings', true); ?>
							<?php if($paddings == 'no') {?>
								<?php the_content(); ?>
							<?php } else { ?>
								<div class="block-inner">
									<?php the_content(); ?>
								</div>
							<?php } ?>
						</div>
						<?php if($size==9) echo '<div class="clear anti-mar">&nbsp;</div>'; ?>
						
					<?php endwhile; ?>
					
					<?php wp_reset_postdata(); ?>
					
					<?php if($same_height_opened) echo '</div></div></div><div class="clear anti-mar">&nbsp;</div>'; ?>
		
		</div>
		<!-- /Content -->
		
<?php get_footer(); ?>