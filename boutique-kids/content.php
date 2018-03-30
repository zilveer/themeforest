<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage boutique
 * @since boutique 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// do we show full blog output instead of summary?
$show_full_blog = get_theme_mod('boutique_full_blog',0);

$slug = $show_full_blog ? 'single' : 'summary';

if(isset($GLOBALS['dtbaker_blog_post_output_override'])){
	switch($GLOBALS['dtbaker_blog_post_output_override']){
		case 'summary':
			$slug = 'summary';
			break;
		case 'full':
			$slug = 'single';
			break;
	}
}

?>

<!-- boutique template: content.php -->
<div id="post-<?php the_ID(); ?>" <?php post_class( 'blog blog-'.$slug . (has_post_thumbnail() ? ' has_post_thumb':'') ); ?>>

	<?php do_action('boutique_blog_summary_before'); ?>
	<div class="blog_content_wrap">

		<?php
		if($slug == 'single'){
			// we have to display the content title, because that isn't in content-blog-single.php
			?>
			<?php do_action( 'boutique_page_header_before' ); ?>
			<h1 class="entry-title <?php echo ( is_sticky() ) ? ' featured-post' : '';?>"><a href="<?php echo esc_url(get_the_permalink());?>"><?php the_title(); ?></a></h1>
			<?php do_action( 'boutique_page_header_after' ); ?>
			<?php
		}
		get_template_part( 'content-blog-'.$slug, get_post_format() ); ?>

	</div>
	<?php do_action('boutique_blog_summary_after'); ?>

</div><!-- #post-<?php the_ID(); ?> -->




