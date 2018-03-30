<?php
/**
 * gallery ShortCode
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call

remove_shortcode( 'gallery' );
add_shortcode( 'gallery', 'mental_native_gallery_shortcode' );

/**
 * Native WP gallery shortcode hook
 *
 * @param $attr
 *
 * @return string
 */
function mental_native_gallery_shortcode( $attr )
{
	$post = get_post();

	static $instance = 0;
	$instance ++;

	if ( ! empty( $attr['ids'] ) ) {
		// 'ids' is explicitly ordered, unless you specify otherwise.
		if ( empty( $attr['orderby'] ) ) {
			$attr['orderby'] = 'post__in';
		}
		$attr['include'] = $attr['ids'];
	}

	// Allow plugins/themes to override the default gallery template.
	$output = apply_filters( 'post_gallery', '', $attr );
	if ( $output != '' ) {
		return $output;
	}

	// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
	if ( isset( $attr['orderby'] ) ) {
		$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
		if ( ! $attr['orderby'] ) {
			unset( $attr['orderby'] );
		}
	}

	$shortcode_attributes = shortcode_atts( array(
		'order'      => 'ASC',
		'orderby'    => 'menu_order ID',
		'id'         => $post ? $post->ID : 0,
		'itemtag'    => 'dl',
		'icontag'    => 'dt',
		'captiontag' => 'dd',
		'columns'    => 3,
		'size'       => 'large',
		'include'    => '',
		'exclude'    => '',
		'link'       => ''
	), $attr, 'gallery' );

	extract( $shortcode_attributes );

	$id = intval( $id );
	if ( 'RAND' == $order ) {
		$orderby = 'none';
	}

	if ( ! empty( $include ) ) {
		$_attachments = get_posts( array(
			'include'        => $include,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => $order,
			'orderby'        => $orderby
			) );

		$attachments = array();
		foreach ( $_attachments as $key => $val ) {
			$attachments[ $val->ID ] = $_attachments[ $key ];
		}
	} elseif ( ! empty( $exclude ) ) {
		$attachments = get_children( array(
			'post_parent'    => $id,
			'exclude'        => $exclude,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => $order,
			'orderby'        => $orderby
			) );
	} else {
		$attachments = get_children( array(
			'post_parent'    => $id,
			'post_status'    => 'inherit',
			'post_type'      => 'attachment',
			'post_mime_type' => 'image',
			'order'          => $order,
			'orderby'        => $orderby
			) );
	}

	if ( empty( $attachments ) ) {
		return '';
	}

	$unique_id_suffix = rand( 1, 999 );

	ob_start();
	?>

	<div id="carousel-<?php echo (int) $unique_id_suffix ?>" class="carousel slide" data-ride="carousel">

		<!-- Wrapper for slides -->
		<div class="carousel-inner">

			<?php $i = 0;
			foreach ( $attachments as $id => $attachment ): ?>
				<?php
				$attachment_data = wp_get_attachment_image_src( $id, $size );
				?>
				<div class="item <?php echo ( $i == 0 ) ? 'active' : '' ?>">
					<img src="<?php echo esc_url($attachment_data[0]); ?>" alt="slide">

					<div class="carousel-caption">
						<p><?php echo esc_html($attachment->post_excerpt); ?></p>
					</div>
				</div>
				<?php $i ++; endforeach ?>
		</div>

		<!-- Indicators -->
		<ol class="carousel-indicators">
			<?php $i = 0;
			foreach ( $attachments as $id => $attachment ): ?>
				<li data-target="#carousel-<?php echo (int) $unique_id_suffix; ?>" data-slide-to="<?php echo (int) $i ?>"
				    class="<?php echo ( $i == 0 ) ? 'active' : '' ?>"></li>
				<?php $i ++; endforeach ?>
		</ol>

		<!-- Controls -->
		<a class="left carousel-control" href="#carousel-<?php echo esc_attr($unique_id_suffix); ?>" data-slide="prev">
			<span></span>
		</a>
		<a class="right carousel-control" href="#carousel-<?php echo esc_attr($unique_id_suffix); ?>" data-slide="next">
			<span></span>
		</a>

	</div> <!-- carousel -->

	<?php
	return ob_get_clean();
    
    
    
}

