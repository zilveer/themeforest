<?php
/**
 * The template for displaying post navigation using "Prev and Next" style. 
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category PrimaShop
 * @package  Templates
 * @author   PrimaThemes
 * @link     http://www.primathemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( is_singular() ) return;

global $wp_query;

if( $wp_query->max_num_pages <= 1 ) return;

$prev_link = get_previous_posts_link( __( '&larr; Previous Page', 'primathemes' ) );
$prev_link = $prev_link ? '<div class="alignleft">' . $prev_link . '</div>' : '';

$next_link = get_next_posts_link( __( 'Next Page &rarr;', 'primathemes' ) );
$next_link = $next_link ? '<div class="alignright">' . $next_link . '</div>' : '';
?>

<?php if ( $prev_link || $next_link ) : ?>
  <nav id="nav-prevnext" class="navigation group">
	<h3 class="assistive-text"><?php _e( 'Post navigation', 'primathemes' ); ?></h3>
	<?php echo $prev_link; ?>
	<?php echo $next_link; ?>
  </nav>
<?php endif; ?>