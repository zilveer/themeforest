<?php
/*
*	Template Search Masonry
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/
?>

<?php
	$title_tag = blade_grve_option( 'search_page_heading_tag', 'h4' );
	$title_class = blade_grve_option( 'search_page_heading', 'h4' );
	$excerpt_length = blade_grve_option( 'search_page_excerpt_length_small' );
	$excerpt_more = blade_grve_option( 'search_page_excerpt_more' );
	$search_page_show_image = blade_grve_option( 'search_page_show_image', 'yes' );


?>

<article id="grve-search-<?php the_ID(); ?><?php echo uniqid('-'); ?>" <?php post_class( 'grve-blog-item grve-isotope-item' ); ?>>
	<div class="grve-isotope-item-inner">
	<?php if ( 'yes' == $search_page_show_image && has_post_thumbnail() ) { ?>
		<div class="grve-media clearfix">
			<a href="<?php echo esc_url( get_permalink() ); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
		</div>
	<?php } ?>
		<div class="grve-post-content">
			<?php the_title( '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><' . tag_escape( $title_tag ) . ' class="grve-post-title grve-text-hover-primary-1 grve-' . esc_attr( $title_class ) . '">', '</' . tag_escape( $title_tag ) . '></a>' ); ?>
			<div>
				<?php echo blade_grve_excerpt( $excerpt_length, $excerpt_more  ); ?>
			</div>
		</div>
	</div>
</article>