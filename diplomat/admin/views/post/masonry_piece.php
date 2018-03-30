<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'No direct access allowed' );
} ?>
<?php
	$query = new WP_Query( array(
		'post_type' => 'post',
		'showposts' => '-1',
		'ignore_sticky_posts' => true,
		'post_status' => array('publish')
	) );


$posts_array = $query->posts;

$image_size = '640*480';

$post_types = array(
	'audio',
	'video',
	'quote',
	'gallery',
);

if ( isset( $posts_array[ $post_key ] ) ) {
	$post             = $posts_array[ $post_key ];
	$post_link        = get_permalink( $post->ID );
	$post_pod_type    = get_post_format( $post->ID );
	$post_type_values = get_post_meta( $post->ID, 'post_type_values', true );
    $class = 'post';

	if ( ! in_array( $post_pod_type, $post_types ) ) {
		$post_pod_type = 'default';
	}

	$columns_class = '';
	switch ( $columns ) {
		case '2':
			$columns_class = 'medium-6 large-6 columns';
			break;
		case '3':
			$columns_class = 'medium-4 large-4 columns';
			break;
		case '4':
			$columns_class = 'medium-3 large-3 columns';
			break;
	}

	$post_title          = $post->post_title;
	$title_symbols_count = $title_symbols;
	if ( $title_symbols ) {
		$post_title = ( strlen( $post_title ) > $title_symbols_count ) ? substr( $post_title, 0, $title_symbols_count ) . " ..." : $post_title;
	}

	$excerpt_symbols_count = ( $excerpt_symbols ) ? $excerpt_symbols : '0';

	$_REQUEST['image_background'] = (isset($image_background)) ? $image_background : '';
	$_REQUEST['image_opacity'] = (isset($image_opacity)) ? $image_opacity : '';

	?>

	<div class="<?php echo esc_attr($columns_class) ?> slideUp post-item masonry_piece_<?php echo esc_attr($post_key); ?>" data-key="<?php echo esc_attr($post_key); ?>">

		<article id="post-<?php echo esc_attr($post->ID); ?>" <?php post_class($class, $post->ID); ?>>

			<?php include( locate_template( 'article-' . $post_pod_type . '.php' ) ); ?>

			<?php if ( $post_pod_type !== 'quote' ) { ?>

				<header class="entry-header">

					<h3 class="entry-title"><a href="<?php echo esc_url($post_link); ?>"><?php echo esc_html($post_title); ?></a></h3>

				</header>

				<?php if ($show_excerpt){ ?>

					<div class="entry-content">

						<p>
							<?php
							if ( strpos( $post->post_content, '<!--more-->' ) ) {
								the_content();
							} else {
								if ( empty( $post->post_excerpt ) ) {
									$txt = do_shortcode( $post->post_content );
									$txt = strip_tags( $txt );
									echo ( strlen( $txt ) > $excerpt_symbols_count ) ? do_shortcode( substr( $txt, 0, $excerpt_symbols_count ) . " ..." ) : do_shortcode( $txt );
								} else {
									echo ( strlen( $post->post_excerpt ) > $excerpt_symbols_count ) ? do_shortcode( substr( $post->post_excerpt, 0, $excerpt_symbols_count ) . " ..." ) : do_shortcode( $post->post_excerpt );
								}

							}
							?>
						</p>

					</div>

				<?php } ?>

			<?php } ?>

			<footer class="entry-footer">

				<div class="left">

					<span class="cat-links"><?php echo get_the_category_list(', ', '', $post->ID); ?></span>

				</div>

				<div class="right">

					<span class="posted-on"><a href="<?php echo esc_url(TMM_Helper::get_post_date_link( get_the_date( 'd.m.Y', $post->ID ) )); ?>"><?php echo get_the_date( TMM::get_option('date_format'), $post->ID ) ?></a></span>

					<span class="comments-link"><a href="<?php echo esc_url(get_permalink($post->ID)) ?>#comments"><?php echo esc_html($post->comment_count); ?></a></span>

					<?php echo TMM_Helper::get_post_like( $post->ID ); ?>

				</div>

			</footer>

		</article>

	</div>

<?php
}