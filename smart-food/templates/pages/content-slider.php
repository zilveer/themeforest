<?php
/**
 * @package smartfood
 */

$homepage_content = apply_filters('smartfood_homepage_content', tdp_option('homepage_content'));
$homepage_image = tdp_option('animated_title_image');
$slides = tdp_option('homepage_slides');
?>
<div class="row">
	
	<?php if($homepage_content == 'slider') : ?>

	<div id="intro-wrap">
		<div id="intro" class="preload darken" data-autoplay="5000" data-navigation="true" data-pagination="true" data-transition="fadeUp">					
				
			<?php foreach ($slides as $slide) : ?>
				<div class="intro-item" style="background-image: url(<?php echo esc_url($slide['image']); ?>);">
					
					<?php if($slide['title'] || $slide['description'] || $slide['url']) : ?>
					<div class="caption">
						
						<?php if($slide['title']) : ?>
						<h2><?php echo esc_attr( $slide['title'] ); ?></h2>
						<?php endif; ?>
						
						<?php if($slide['description']) : ?>
						<p><?php echo esc_attr( $slide['description'] ); ?></p>
						<?php endif; ?>
						
						<?php if($slide['url']) : 

						//Get link and button label if set
						$button = explode(',', $slide['url']);
						?>
							<?php if(array_key_exists(1,$button)) : ?>
								<a class="button white transparent" href="<?php echo esc_url($button[0]);?>"><?php echo esc_attr($button[1]);?></a>
							<?php else : ?>
								<a class="button white transparent" href="<?php echo esc_url($button[0]);?>"><?php _e('Read More', 'smartfood');?></a>
							<?php endif; ?>
						<?php endif; ?>

					</div>
					<?php endif; ?>

				</div>
			<?php endforeach ?>

		</div><!-- intro -->
	</div><!-- intro-wrap -->

	<?php else : ?>

		<div id="static-image-section" data-img="<?php echo $homepage_image['url'];?>">
			<p class="title-1"><span><?php echo tdp_option('animated_title_1');?></span></p>
			<p class="title-2"><span><?php echo tdp_option('animated_title_2');?></span></p>
			<p class="title-3"><span><?php echo tdp_option('animated_title_3');?></span></p>
			<p class="title-4"><span><?php echo tdp_option('animated_title_4');?></span></p>
		</div>

	<?php endif; ?>

</div>