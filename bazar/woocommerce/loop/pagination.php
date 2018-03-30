<?php
/**
 * Pagination
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

global $wp_query;

if ( $wp_query->max_num_pages <= 1 )
    return;

?>

<?php if( function_exists( 'yit_pagination' ) ) : yit_pagination(); else : ?>
<div class="navigation">
	<div class="nav-next"><?php next_posts_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'yit' ) ); ?></div>
	<div class="nav-previous"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Previous', 'yit' ) ); ?></div>
</div>                 
<?php endif ?>

