<?php

global $no_slider;
if ($no_slider){ $no_slider = ' class="no-slider"'; } else { $no_slider = ''; }

$show_feature_blocks = get_post_meta($post->ID,'_feature_block_layout',true); $show_feature_blocks = ($show_feature_blocks ? $show_feature_blocks[0] : '');
$zone_1_block = (get_post_meta($post->ID, '_feature_block_1',true) ? get_post_meta($post->ID, '_feature_block_1',true) : 1);
$zone_2_block = (get_post_meta($post->ID, '_feature_block_2',true) ? get_post_meta($post->ID, '_feature_block_2',true) : 2);
$zone_3_block = (get_post_meta($post->ID, '_feature_block_3',true) ? get_post_meta($post->ID, '_feature_block_3',true) : 3);

switch ($show_feature_blocks) {

	case 'one-block' :
	
		?><section id="ctas"<?php echo $no_slider; ?>>
			<div class="shell clearfix">
				<article class="full"><?php
				
					$block = get_post($zone_1_block);
					$src = wp_get_attachment_image_src(get_post_thumbnail_id($block->ID), 'feature-block-full'); $src = $src[0];
					$title = $block->post_title;
					$content = wpautop(get_post_meta($block->ID,'_feature_block_text',true));
					$button_text = get_post_meta($block->ID,'_feature_block_button_title',true);
					$button_url = get_post_meta($block->ID,'_feature_block_button_url',true);
					$button_icon = get_post_meta($block->ID,'_feature_block_icon',true);
				
					echo '<h3>'.$title.'</h3>';
					echo '<img src="'.$src.'" alt="'.$title.'" />';
					echo do_shortcode($content);
					echo '<a class="es-button" href="'.$button_url.'">'.($button_icon ? '<i class="fa '.$button_icon.'"></i>&nbsp;&nbsp;&nbsp;' : '').''.$button_text.'</a>';
					
				?></article>
			</div>
		</section><?php
	
	break;
	
	case 'two-blocks' :
	
		?><section id="ctas"<?php echo $no_slider; ?>>
			<div class="shell clearfix">
				<article class="half"><?php
				
					$block = get_post($zone_1_block);
					$src = wp_get_attachment_image_src(get_post_thumbnail_id($block->ID), 'feature-block-half'); $src = $src[0];
					$title = $block->post_title;
					$content = wpautop(get_post_meta($block->ID,'_feature_block_text',true));
					$button_text = get_post_meta($block->ID,'_feature_block_button_title',true);
					$button_url = get_post_meta($block->ID,'_feature_block_button_url',true);
					$button_icon = get_post_meta($block->ID,'_feature_block_icon',true);
				
					echo '<h3>'.$title.'</h3>';
					echo '<img src="'.$src.'" alt="'.$title.'" />';
					echo do_shortcode($content);
					echo '<a class="es-button" href="'.$button_url.'">'.($button_icon ? '<i class="fa '.$button_icon.'"></i>&nbsp;&nbsp;&nbsp;' : '').''.$button_text.'</a>';
						
				?></article>
				<article class="half"><?php
					
					$block = get_post($zone_2_block);
					$src = wp_get_attachment_image_src(get_post_thumbnail_id($block->ID), 'feature-block-half'); $src = $src[0];
					$title = $block->post_title;
					$content = wpautop(get_post_meta($block->ID,'_feature_block_text',true));
					$button_text = get_post_meta($block->ID,'_feature_block_button_title',true);
					$button_url = get_post_meta($block->ID,'_feature_block_button_url',true);
					$button_icon = get_post_meta($block->ID,'_feature_block_icon',true);
				
					echo '<h3>'.$title.'</h3>';
					echo '<img src="'.$src.'" alt="'.$title.'" />';
					echo do_shortcode($content);
					echo '<a class="es-button" href="'.$button_url.'">'.($button_icon ? '<i class="fa '.$button_icon.'"></i>&nbsp;&nbsp;&nbsp;' : '').''.$button_text.'</a>';
						
				?></article>
			</div>
		</section><?php
	
	break;
	
	case 'three-blocks' :
	
		?><section id="ctas"<?php echo $no_slider; ?>>
			<div class="shell clearfix">
				<article><?php
					
					$block = get_post($zone_1_block);
					$src = wp_get_attachment_image_src(get_post_thumbnail_id($block->ID),'recent-post-thumbnail'); $src = $src[0];
					$title = $block->post_title;
					$content = wpautop(get_post_meta($block->ID,'_feature_block_text',true));
					$button_text = get_post_meta($block->ID,'_feature_block_button_title',true);
					$button_url = get_post_meta($block->ID,'_feature_block_button_url',true);
					$button_icon = get_post_meta($block->ID,'_feature_block_icon',true);
				
					echo '<h3>'.$title.'</h3>';
					echo '<img src="'.$src.'" alt="'.$title.'" />';
					echo do_shortcode($content);
					echo '<a class="es-button" href="'.$button_url.'">'.($button_icon ? '<i class="fa '.$button_icon.'"></i>&nbsp;&nbsp;&nbsp;' : '').''.$button_text.'</a>';
					
				?></article>
				<article><?php
					
					$block = get_post($zone_2_block);
					$src = wp_get_attachment_image_src(get_post_thumbnail_id($block->ID),'recent-post-thumbnail'); $src = $src[0];
					$title = $block->post_title;
					$content = wpautop(get_post_meta($block->ID,'_feature_block_text',true));
					$button_text = get_post_meta($block->ID,'_feature_block_button_title',true);
					$button_url = get_post_meta($block->ID,'_feature_block_button_url',true);
					$button_icon = get_post_meta($block->ID,'_feature_block_icon',true);
				
					echo '<h3>'.$title.'</h3>';
					echo '<img src="'.$src.'" alt="'.$title.'" />';
					echo do_shortcode($content);
					echo '<a class="es-button" href="'.$button_url.'">'.($button_icon ? '<i class="fa '.$button_icon.'"></i>&nbsp;&nbsp;&nbsp;' : '').''.$button_text.'</a>';
					
				?></article>
				<article><?php
					
					$block = get_post($zone_3_block);
					$src = wp_get_attachment_image_src(get_post_thumbnail_id($block->ID),'recent-post-thumbnail'); $src = $src[0];
					$title = $block->post_title;
					$content = wpautop(get_post_meta($block->ID,'_feature_block_text',true));
					$button_text = get_post_meta($block->ID,'_feature_block_button_title',true);
					$button_url = get_post_meta($block->ID,'_feature_block_button_url',true);
					$button_icon = get_post_meta($block->ID,'_feature_block_icon',true);
				
					echo '<h3>'.$title.'</h3>';
					echo '<img src="'.$src.'" alt="'.$title.'" />';
					echo do_shortcode($content);
					echo '<a class="es-button" href="'.$button_url.'">'.($button_icon ? '<i class="fa '.$button_icon.'"></i>&nbsp;&nbsp;&nbsp;' : '').''.$button_text.'</a>';
					
				?></article>
			</div>
		</section><?php
	
	break;
	
}

wp_reset_query();