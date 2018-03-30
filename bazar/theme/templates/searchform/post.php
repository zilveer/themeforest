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
?>
<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div>
        <input type="text" value="" name="s" id="s" placeholder="<?php _e( 'Search for...', 'yit' ) ?>" />
        <input type="submit" id="searchsubmit" value="<?php _e( 'Search', 'yit' ) ?>" />
        <?php
        $post_types =  apply_filters( 'yit_searchform_post_types', array( 'post' ) );
        
        foreach( $post_types as $post_type ) : ?>
        <input type="hidden" name="post_type[]" value="<?php echo $post_type ?>" />
        <?php endforeach ?>
    </div>
</form>