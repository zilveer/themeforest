<?php
/**
 * The Albums category filter
 *
 * @author WolfThemes
 * @package WolfAlbums/Templates
 * @since 1.0.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$tax_args = array(
	'taxonomy'     => 'gallery_type',
	'orderby'      => 'slug',
	'show_count'   => 0,
	'pad_counts'   => 0,
	'hierarchical' => 0,
	'title_li'     => '',
);

$tax = get_categories( $tax_args );
$active_class = ( is_page( wolf_albums_get_page_id() ) ) ? ' class="active"' : '';
if ( $tax != array() ) :
?>
<div id="gallery-filter-container">
	<ul id="gallery-filter">
		<li><a data-filter="gallery"<?php echo esc_attr( $active_class ); ?> href="<?php echo esc_url( wolf_get_albums_url() ); ?>"><?php _e( 'All', 'wolf' ); ?></a></li>
	<?php foreach ( $tax as $t ) : ?>
		<?php if ( 0 != $t->count ) : ?>
			<li>
				<a data-filter="<?php echo sanitize_title( $t->slug ); ?>" href="<?php echo esc_url( get_term_link( $t ) ); ?>"><?php echo sanitize_text_field( $t->name ); ?></a>
			</li>
		<?php endif; ?>
	<?php endforeach; ?>
	</ul>
</div>
<?php endif; ?>