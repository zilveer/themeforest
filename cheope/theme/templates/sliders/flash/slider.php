<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */       

global $is_primary;

$slider_class = '';
if ( ! $is_primary ) $slider_class = 'container';    
$slider_class .= yit_slide_get('align') != '' ? ' align' . yit_slide_get('align') : '';
?>
 
                <div id="<?php echo $slider_id ?>"<?php yit_slider_class( $slider_class ) ?>>
                	<div class="slider-wrapper" style="width:<?php yit_slide_the('width'); ?>px;height:<?php echo yit_slide_get('height') + 75; ?>px;"><div id="piecemaker"></div></div>
                </div> 

                <?php ob_start(); ?>              
    
                <script type="text/javascript">
                    var flashvars = {};
                    flashvars.cssSource = "<?php echo yit_get_slider_url() ?>/piecemaker/piecemaker.css";
                    flashvars.xmlSource = "<?php echo yit_get_slider_url() ?>/piecemaker/piecemaker.php?slider_name=<?php echo $current_slider ?>";

                    var flash_params = {};
                    flash_params.play = "true";
                    flash_params.menu = "false";
                    flash_params.scale = "scale";
                    flash_params.wmode = "transparent";
                    flash_params.allowfullscreen = "true";
                    flash_params.allowscriptaccess = "always";
                    flash_params.allownetworking = "all";

                    swfobject.embedSWF('<?php echo yit_get_slider_url() ?>/piecemaker/piecemaker.swf', 'piecemaker', '100%', '100%', '10', null, flashvars, flash_params, null);

                    <?php if ( ! $is_primary ) : ?>
                    jQuery(document).ready(function($){
                        var ResizeFlash = function(){
                            var main_width = $('#<?php echo $slider_id ?>').width();
                            var initial_height = <?php echo yit_slide_get('height') + 75; ?>;
                            
                            $(".slider-wrapper").css( "width",  main_width );
                            $(".slider-wrapper").css( "height", ( initial_height * main_width ) / <?php yit_slide_the('width'); ?> );
                        }
                        ResizeFlash();
                        $(window).resize(ResizeFlash);
                    });
                    <?php endif; ?>
                </script>

                <?php add_action( 'wp_footer', create_function( '', 'echo stripslashes( "' . addslashes( ob_get_clean() ) . '" );' ), 20 );