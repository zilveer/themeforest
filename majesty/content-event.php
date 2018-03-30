<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Majesty
 * @since Majesty 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="blog_row">
		<?php if ( has_post_thumbnail() ) { ?>
			<figure class="blog-img">
				<?php sama_single_post_thumbnail(); ?>
			</figure>
		<?php } ?>
				
			<header class="entery-header">
				<h1><?php the_title(); ?></h1>
			</header>
			
			<div class="entery-content">
				<?php 
					the_content();
					
					wp_link_pages( array(
						'before'      => '<div class="page-links"><strong class="page-links-title">' . esc_html__( 'Pages:', 'theme-majesty' ) . '</strong>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
					));
				?>
			</div>
					
			<footer class="entry-footer">
				<?php edit_post_link( esc_html__( 'Edit', 'theme-majesty' ), '<span class="edit-link">', '</span>' ); ?>
			</footer>
			<div class="post-tags-social">
			<?php
				global $majesty_options;
				if ( $majesty_options['single_display_share_icon'] ) {
					get_template_part('tpl/post-share-icon');
				}
			?>
			</div>
			<div class="clearfix"></div>
	</div>		
</article>