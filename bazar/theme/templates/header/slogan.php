<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
global $post;
    
$post_id = yit_post_id();

$slogan          = yit_get_post_meta( $post_id, '_slogan' );
$sub_slogan      = yit_get_post_meta( $post_id, '_sub-slogan' );

if( $slogan ) : 
    $tag_slogan     = apply_filters( 'yit_page_slogan_tag', 'h2' );  
    $tag_sub_slogan = apply_filters( 'yit_page_sub_slogan_tag', 'h3' );
?>
    <!-- SLOGAN -->
    <div class="slogan">
    <?php
        do_action( 'yit_before_slogan' );
		yit_string( '<' . $tag_slogan . '>', yit_decode_title($slogan), '</' . $tag_slogan . '>' );
        
        if( $sub_slogan ) {
            do_action( 'yit_before_sub_slogan' );
            yit_string( '<' . $tag_sub_slogan . '>', yit_decode_title($sub_slogan), '</' . $tag_sub_slogan . '>' );   
        }    
    ?>
    	<div class="border margin-top"></div>
    	<div class="border"></div>
    	<div class="border"></div> 
    </div>
<?php endif; ?>  