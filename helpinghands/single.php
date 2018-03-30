<?php
/**
 * Theme Single Post
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

get_header(); 

global $sd_data;

$format = get_post_format();

if ( false === $format ) {
	$format = 'standard';
}

$post_class = 'sd-single-' . $format;

$header_bgs     = rwmb_meta( 'sd_header_page_bg', array( 'size' => 'full' ) );
$bg_repeat      = rwmb_meta( 'sd_bg_repeat', 'type=checkbox');
$repeat_x       = rwmb_meta('sd_repeat_x', 'type=checkbox');
$repeat_y       = rwmb_meta('sd_repeat_y', 'type=checkbox');
$repeat_x       = ( $repeat_x == '1' ? ' repeat-x ' : '' );
$repeat_y       = ( $repeat_y == '1' ? ' repeat-y ' : '');
$custom_title   = rwmb_meta('sd_edd_single_title');
$padding_top    = rwmb_meta('sd_edd_padding_top');
$padding_bottom = rwmb_meta('sd_edd_padding_bottom');
$show_title     = rwmb_meta('sd_edd_page_title');

if ( $bg_repeat == '1' && $repeat_x !== '1' && $repeat_y !== '1' ) {
	$bg_repeat = 'repeat';
} else if ( $repeat_x == '1' || $repeat_y == '1' ) {
	$bg_repeat = '';
} else {
	$bg_repeat = 'no-repeat center center / cover';
}


$styling = array();

if ( ! empty( $header_bgs ) ) {
	foreach ( $header_bgs as $header_bg ) {
		$styling[] = 'background: url(' . $header_bg['full_url'] . ') ' . $bg_repeat . $repeat_x . $repeat_y . ';';
	}
}
if ( !empty( $padding_top ) ) {
	$styling[] = 'padding-top: '. $padding_top .';';
}
if ( !empty( $padding_bottom ) ) {
	$styling[] = 'padding-bottom: '. $padding_bottom .';';
}
$styling = implode( '', $styling );

if ( $styling ) {
	$styling = wp_kses( $styling, array() );
	$styling = ' style="' . esc_attr( $styling ) . '"';
}

?>
<?php if ( $show_title == '1' ) : ?>
	<div class="sd-page-top-bg" <?php echo $styling; ?>>
		<div class="container">
			<div>
				<h1><?php if ( ! empty( $custom_title) ) echo $custom_title; else the_title(); ?></h1>
			</div>
			<!-- sd-campaign-single-title -->
		</div>
		<!-- container -->
	</div>
	<!-- sd-campaign-title-bg -->
<?php endif; ?>
<div class="container sd-blog-page">
	<div class="row"> 
		<div class="col-md-<?php if ( $sd_data['sd_blog_layout'] == '2' ) { echo '12'; } else { echo '8'; } ?> <?php if ( $sd_data['sd_sidebar_location'] == '2' ) echo 'pull-right'; ?>">
			<div class="sd-left-col">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'sd-blog-entry sd-single-blog-entry clearfix ' . $post_class ); ?>> 
						<?php get_template_part( 'framework/inc/post-formats/single', get_post_format() ); ?>
						<?php
							if ( $sd_data['sd_blog_single_prev_next'] == '1' ) { 
								get_template_part( 'framework/inc/next-prev-single' );
							}
							
							if ( $sd_data['sd_blog_related'] == '1' ) { 
								get_template_part( 'framework/inc/related-posts' );
							}
						?>
					</article>
					<!-- sd-blog-entry -->
				<?php endwhile; else: ?>
					<p><?php _e( 'Sorry, no posts matched your criteria', 'sd-framework' ) ?>.</p>
				<?php endif; ?>

				<?php
					if ( $sd_data['sd_blog_author_box'] == '1' ) {
						get_template_part( 'framework/inc/author-box' );
					} 
				?>
				<?php if ( $sd_data['sd_blog_comments'] == '1' ) : ?>
					<?php comments_template( '', true ); ?>
				<?php endif; ?>
			</div>
			<!-- sd-left-col -->
		</div>
		<!-- col-md-8 --> 
		<?php if ( $sd_data['sd_blog_layout'] !== '2' ) : ?>
		<div class="col-md-4">
			<?php get_sidebar(); ?>
		</div>
		<?php endif; ?>
	</div>
	<!-- row -->
</div>
<!-- sd-blog-page -->
<?php get_footer(); ?>