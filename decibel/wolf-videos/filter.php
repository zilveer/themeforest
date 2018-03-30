<?php
/**
 * The Videos category filter
 *
 * @author WolfThemes
 * @package WolfVideos/Templates
 * @since 1.0.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$tax_args = array(
	'taxonomy'     => 'video_type',
	'orderby'      => 'slug',
	'show_count'   => 0,
	'pad_counts'   => 0,
	'hierarchical' => 0,
	'title_li'     => '',
);

$tax = get_categories( $tax_args );
$active_class = ( is_page( wolf_videos_get_page_id() ) ) ? ' class="active"' : '';
if ( $tax != array() ) :
?>
<div id="video-filter-container">
	<ul id="video-filter">
		<li><a data-filter="video"<?php echo sanitize_html_class( $active_class ); ?> href="<?php echo esc_url( wolf_get_videos_url() ); ?>"><?php _e( 'All', 'wolf' ); ?></a></li>
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