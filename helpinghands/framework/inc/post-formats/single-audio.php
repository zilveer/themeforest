<?php
/**
 * Theme Single Post - Audio Post Format
 *
 * @package	DigitalAgency
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since DigitalAgency 1.0
 */

global $sd_data;

$post_meta = $sd_data['sd_blog_post_meta_enable'];
$audio_url = rwmb_meta( 'sd_audio_url' );
$attr = array(
	'src' => $audio_url,
);
?>
<div class="sd-entry-wrapper"> 
	<div class="sd-entry-audio">
		<?php echo wp_audio_shortcode( $attr ); ?>
	</div>
	<!-- sd-entry-audio -->
	<header>
		<h2 class="sd-entry-title">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'sd-framework' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h2>
		<?php if ( $post_meta == '1' ) : ?>
			<?php get_template_part( 'framework/inc/post-meta' ); ?>
		<?php endif; ?>
	</header>
	<div class="sd-entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( 'before=<strong class="sd-page-navigation clearfix">&after=</strong>' ); ?>
	</div>
	<!-- sd-entry-content --> 
</div>
<!--sd-entry-wrapper --> 