<?php
/**
 * The template for displaying post content
 *
 * @package    Reactor
 * @subpackage Post-Formats
 * @since      1.0.0
 */

global $crum_set__blog_image_size;
global $crum_set__blog_style;

$classes[] = 'blog-post';
if ( 'full' === $crum_set__blog_style ) {
	$classes[] = 'style-2';
} elseif ( 'image-side' === $crum_set__blog_style ) {
	$classes[] = 'style-3';
}

$posts_animation = get_query_var('posts_animation');
$hide_date = get_query_var('show_date');
$hide_meta = get_query_var('show_meta');
$hide_excerpt = get_query_var('show_excerpt');
$blog_excerpt_type = get_query_var('blog_excerpt_type');
$excerpt_length = get_query_var('excerpt_length');

$post_text = omni_post_text(get_the_ID(),$excerpt_length);

$classes[] = $posts_animation;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>

	<div class="thumbnail-entry">

	<?php echo crumina_post_gallery( $crum_set__blog_image_size, $crum_set__blog_style ); // WPCS: XSS OK. ?>

	</div>
	<!-- .entry-thumbnail -->

	<div class="entry-header data">
		<?php if(!(true === $hide_date) ){?>
			<time class="date entry-date updated"
			      datetime="<?php the_time( 'c' ) ?>"><?php crumina_formatted_post_date(); ?></time>
		<?php }?>
		<div class="text">
			<?php if ( 'full' === $crum_set__blog_style && !(true === $hide_meta) ) {
				$args = array(
					'post_id'         => get_the_ID(),
					'show_author'     => true,
					'show_categories' => true,
					'show_date'       => false,
					'show_comments'   => false,
					'avatar_size'     => 60,
				);
				omni_posted_on( $args );
			}?>
			<?php the_title( sprintf( '<h2 class="entry-title title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		</div>
	</div>
	<!-- .entry-header -->


	<?php if ( !(true === $hide_excerpt) ) {?>

		<div class="entry-summary description text">
			<?php
			if ( 'excerpt' === $blog_excerpt_type ) {
				echo $post_text;
				if ( 'full' === $crum_set__blog_style || 'standard' === $crum_set__blog_style ) {
					echo '<p><a href="' . get_the_permalink( get_the_ID() ) . '" class="button size-2"><span>' . esc_html__( 'read more', 'omni' ) . '</span></a></p>';
				}
			} else {
				the_content();
			}
			?>
			<?php if ( 'image-side' === $crum_set__blog_style && !(true === $hide_meta) ) {
				$args = array(
					'post_id'         => get_the_ID(),
					'show_author'     => true,
					'show_categories' => true,
					'show_date'       => false,
					'show_comments'   => false,
					'avatar_size'     => 60,
				);
				omni_posted_on( $args );
			}?>
		</div>
		<!-- .entry-summary -->


	<?php
	wp_link_pages( array(
		'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'omni' ),
		'after'  => '</div>',
	) );
	?>
	<?php }?>
	<div class="clear"></div>

</article><!-- #post -->
