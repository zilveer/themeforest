<?php 
/**
 * @package WordPress
 * @subpackage Sommerce
 * @since 1.0
 */
 
if ( yiw_is_empty() )
    return;
?>
 
                <div id="slider" class="inner flash">
                	<div id="piecemaker"></div>
                </div>               
    
                <script type="text/javascript">
                    var flashvars = {};
                    flashvars.cssSource = "<?php echo get_template_directory_uri() ?>/piecemaker/piecemaker.css";
                    flashvars.xmlSource = "<?php echo get_template_directory_uri() ?>/piecemaker/piecemaker.php";

                    var flash_params = {};
                    flash_params.play = "true";
                    flash_params.menu = "false";
                    flash_params.scale = "showall";
                    flash_params.wmode = "transparent";
                    flash_params.allowfullscreen = "true";
                    flash_params.allowscriptaccess = "always";
                    flash_params.allownetworking = "all";

                    swfobject.embedSWF('<?php echo get_template_directory_uri() ?>/piecemaker/piecemaker.swf', 'piecemaker', '960', '390', '10', null, flashvars, flash_params, null);

                </script>