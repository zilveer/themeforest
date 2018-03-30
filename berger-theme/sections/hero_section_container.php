<?php
/**
 * Created by Clapat.
 * Date: 01/02/15
 * Time: 1:54 PM
 */

global $cpbg_hero_scroll_opacity, $cpbg_hero_size, $cpbg_hero_position, $cpbg_hero_type, $cpbg_use_main_slider;

$hero_class = '';
if( $cpbg_hero_scroll_opacity ){

	$hero_class = 'opacity-hero';
}

if( $cpbg_hero_size == 'big' ){
	
	$hero_class .= ' hero-big';
}
else if( $cpbg_hero_size == 'small' ){
	
	$hero_class .= ' hero-small';
}

if( $cpbg_hero_position == 'static' ){
	
	$hero_class .= ' static-hero';
}
else if( $cpbg_hero_position == 'parallax' ){
	
	$hero_class .= ' parallax-hero';
}

// when hero type is image the background class type is part of #hero div
if( ($cpbg_hero_type == 'image') || ( ($cpbg_hero_type == 'slider') && !$cpbg_use_main_slider ) ){
	
	global $cpbg_content_type;
	
	if( $cpbg_content_type == 'light' ){
	
		$hero_class .= ' dark-bg';
	}
}

$hero_class = trim( $hero_class );
if( !empty( $hero_class ) ){

	$hero_class = 'class="' . $hero_class . '"';
} 

if( $cpbg_hero_type != 'none' ){

?>

		<!-- Hero --> 
        <div id="hero" <?php echo $hero_class; ?>>
		
			<?php
			
				if( $cpbg_hero_type == 'slider' ){
					
					if( $cpbg_use_main_slider ){
						
						get_template_part('sections/hero_section_slider');
					}
					else {
						
						global $cpbg_custom_slider;
						
						echo do_shortcode( $cpbg_custom_slider );
					}
				}
				else if( $cpbg_hero_type == 'video' ){
					
					get_template_part('sections/hero_section_video');
				}
				else{
				
					global $cpbg_hero_image;
					if( $cpbg_hero_image && $cpbg_hero_image['url'] ){

						get_template_part('sections/hero_section_image');
					}
				}
			?>
		
		</div>
        <!--/Hero --> 
		
<?php
}
?>		