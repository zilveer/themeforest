<?php

global $cpbg_hover_effect, $cpbg_lightbox_popup;

$hover_class 	= '';
$hover_padding 	= false;
if( ($cpbg_hover_effect == 'hover-white') || ($cpbg_hover_effect == 'padding-white') ){
	
	$hover_class = 'overlay-white';
}
else if( ($cpbg_hover_effect == 'hover-gradient') || ($cpbg_hover_effect == 'padding-gradient') ){

	$hover_class = 'overlay-gradient';
}
if( ($cpbg_hover_effect == 'padding-black') || ($cpbg_hover_effect == 'padding-white') || ($cpbg_hover_effect == 'padding-gradient') ){

	$hover_padding 	= true;
}


if( has_post_thumbnail() ){
	
    $item_classes 		= '';
    $item_categories 	= '';
	$item_cats = get_the_terms($post->ID, 'portfolio_category');
	if($item_cats){
		
		foreach($item_cats as $item_cat) {
            $item_classes 		.= $item_cat->slug . ' ';
            $item_categories 	.= $item_cat->name . ' / ';
        }
        
		$item_categories = rtrim($item_categories, ' / ');

	}

    $full_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full');
	
    $item_height = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-thumbnail-size' );
	if( $item_height != 'normal' ){
	
		$item_classes .= $item_height;
	}
	
	$class_link = '';
	$ajax_link = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-ajax-load' );
	if( $ajax_link ){
		
		$class_link = 'class="ajax-link"';
	}
	if( $cpbg_lightbox_popup ){
		
		$class_link = 'class="gallery"';
	}
	
	$item_url = get_the_permalink();
	if( $cpbg_lightbox_popup ){
		
		$popup_image = redux_post_meta( THEME_OPTIONS, get_the_ID(), 'cpbg-opt-portfolio-popup-image' );
		if( $popup_image ){
			
			$item_url = esc_url( $popup_image['url'] );
		}
		else{
			
			$item_url = esc_url( $full_image[0] );
		}
	}
?>


					<div class="item <?php echo $item_classes; ?>">
						<?php echo '<a ' . $class_link . ' href="' . $item_url .'">'; ?>
                            <div class="item-content" style="background-image:url(<?php echo esc_url( $full_image[0] ); ?>)"></div>
							<?php  if( $hover_padding ){
							echo '<div class="padding-overlay">';
							}
							?>
                            <div class="item-overlay <?php echo $hover_class; ?>">
                                <span class="item-cat"><?php echo $item_categories; ?></span>                    
                                <span class="item-title"><?php the_title(); ?></span>
                            </div>
							<?php  if( $hover_padding ){
							echo '</div>'; //padding overlay
							}
							?>
                        <?php echo '</a>'; ?>     
                    </div>
					
<?php

}
?>					