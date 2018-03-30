<?php
/**
 * Pagination - Show numbered pagination for catalog pages.
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $wp_query;
?>

<?php if ( $wp_query->max_num_pages > 1 ) : ?>
	
	<?php if(is_plugin_active('wp-pagenavi/wp-pagenavi.php')) { ?>
		
		<div class="navigation">
			<?php wp_pagenavi(); ?>
		</div>
	
	<?php } else { ?>
	
		<div class="navigation">
			<div class="nav-next"><?php next_posts_link( __( 'Next <span class="meta-nav">&rarr;</span>', 'qns' ) ); ?></div>
			<div class="nav-previous"><?php previous_posts_link( __( '<span class="meta-nav">&larr;</span> Previous', 'qns' ) ); ?></div>
		</div>
	
	<?php } ?>
	
<?php endif; ?>