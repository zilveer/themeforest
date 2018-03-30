<?php
/**
 * The template for displaying post navigation using "Older and Newer" style. 
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

$older_link = get_next_posts_link( __( '&larr; Older Posts', 'primathemes' ) );
$older_link = $older_link ? '<div class="alignleft">' . $older_link . '</div>' : '';

$newer_link = get_previous_posts_link( __( 'Newer Posts &rarr;', 'primathemes' ) );
$newer_link = $newer_link ? '<div class="alignright">' . $newer_link . '</div>' : '';
?>

<?php if ( $older_link || $newer_link ) : ?>
  <nav id="nav-oldernewer" class="navigation group">
	<h3 class="assistive-text"><?php _e( 'Post navigation', 'primathemes' ); ?></h3>
	<?php echo $older_link; ?>
	<?php echo $newer_link; ?>
  </nav>
<?php endif; ?>