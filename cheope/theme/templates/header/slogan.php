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
    
$post_id = isset( $post->ID ) ? $post->ID : 0;

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
		$slogan = str_replace('[', '<span>', $slogan);
		$slogan = str_replace(']', '</span>', $slogan);
		
		$sub_slogan = str_replace('[', '<span>', $sub_slogan);
		$sub_slogan = str_replace(']', '</span>', $sub_slogan);
        yit_string( '<' . $tag_slogan . '>', $slogan, '</' . $tag_slogan . '>' );
        
        if( $sub_slogan ) {
            do_action( 'yit_before_sub_slogan' );
            yit_string( '<' . $tag_sub_slogan . '>', $sub_slogan, '</' . $tag_sub_slogan . '>' );   
        }    
    ?>      
    </div>
<?php endif; ?>  