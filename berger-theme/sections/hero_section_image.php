<?php
/**
 * Created by Clapat.
 * Date: 01/02/15
 * Time: 1:54 PM
 */

global $cpbg_hero_image, $cpbg_hero_image_overlay_color, $cpbg_hero_image_overlay_color_opacity, $cpbg_hero_image_caption, $cpbg_hero_image_caption_position, $cpbg_content_type;

require_once ( get_template_directory() . '/include/util_functions.php');
$overlay_rgba = hex2rgba( $cpbg_hero_image_overlay_color, $cpbg_hero_image_overlay_color_opacity );

$class_content_type = '';
if( $cpbg_content_type == 'light' ){

    $class_content_type = ' light-content';
}
							
?>

			<div class="hero-image" style="background-image:url(<?php echo esc_url( $cpbg_hero_image['url'] ); ?>)">
            	<div class="overlay" style="background-color:<?php echo $overlay_rgba; ?>">
                    <!-- Slide Caption -->
                    <div class="clapat-caption<?php echo $class_content_type; ?>">
                        <div class="caption-content <?php echo $cpbg_hero_image_caption_position; ?>">
                            <?php echo $cpbg_hero_image_caption; ?>
                        </div>
                    </div>
                    <!--/Slide Caption -->
                </div>
            </div>
