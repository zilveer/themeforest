<?php
/**
 * The template for displaying image attachments.
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category PrimaShop
 * @package  Templates
 * @author   PrimaThemes
 * @link     http://www.primathemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'get_header', 'prima_custom_layout' );
function prima_custom_layout() {
	global $prima_layout;
	$prima_layout = 'full-width-content';
}

get_header(); ?>

<?php do_action( 'prima_main_before' ); ?>

<section id="main" role="main" class="group">

  <?php do_action( 'prima_main_inner_before' ); ?>

  <div class="margin group">
    
    <?php do_action( 'prima_content_block_before' ); ?>

    <div class="content-wrap group">
  
	<div id="content" class="group">
    
	<?php do_action( 'prima_content_before' ); ?>

	<?php if (have_posts()) : ?>
	
	  <?php if ( !prima_get_setting( 'breadcrumb_hide_post' ) ) : ?>
	    <?php prima_breadcrumb(); ?>
	  <?php endif; ?>
	  
	<?php while (have_posts()) : the_post(); ?>
	  
	  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
		<div class="entry">

		  <h1 class="post-title"><?php the_title(); ?></h1>
	  
		  <p class="post-meta"><small>
			<?php
				$metadata = wp_get_attachment_metadata();
				printf( __( '<span class="meta-prep meta-prep-entry-date">Published </span> <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s" title="Link to full-size image">%4$s &times; %5$s</a> in <a href="%6$s" title="Return to %7$s" rel="gallery">%8$s</a>.', 'primathemes' ),
					esc_attr( get_the_date( 'c' ) ),
					esc_html( get_the_date() ),
					esc_url( wp_get_attachment_url() ),
					$metadata['width'],
					$metadata['height'],
					esc_url( get_permalink( $post->post_parent ) ),
					esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ),
					get_the_title( $post->post_parent )
				);
			?>
			<?php edit_post_link( __( 'Edit', 'primathemes' ), '<span class="edit-link">', '</span>' ); ?>
		  </small></p>
		  
		  <div class="post-content group">
			<?php
			/**
			 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
			 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
			 */
			$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
			foreach ( $attachments as $k => $attachment ) :
				if ( $attachment->ID == $post->ID )
					break;
			endforeach;

			$k++;
			// If there is more than 1 attachment in a gallery
			if ( count( $attachments ) > 1 ) :
				if ( isset( $attachments[ $k ] ) ) :
					// get the URL of the next image attachment
					$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
				else :
					// or get the URL of the first image attachment
					$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
				endif;
			else :
				// or, if there's only 1 image, get the URL of the image
				$next_attachment_url = wp_get_attachment_url();
			endif;
			?>

			<p>
			<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
			<?php echo wp_get_attachment_image( $post->ID, array( 960, 960 ) ); ?>
			</a>
			</p>

			<?php if ( ! empty( $post->post_excerpt ) ) : ?>
			<div class="entry-caption">
				<?php the_excerpt(); ?>
			</div>
			<?php endif; ?>
			
			<div class="entry-description">
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'primathemes' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-description -->
			
		  </div>

		</div>
	  </article>

	  <nav id="nav-single" class="navigation">
		<h3 class="assistive-text"><?php _e( 'Post navigation', 'primathemes' ); ?></h3>
		<span class="nav-previous previous-image"><?php previous_image_link( false, __( '&larr; Previous', 'primathemes' ) ); ?></span>
		<span class="nav-next next-image"><?php next_image_link( false, __( 'Next &rarr;', 'primathemes' ) ); ?></span>
	  </nav>
	  
	  <?php // comments_template( '', true ); ?>
	
	<?php endwhile; ?>

	<?php else: ?>
	
	  <?php get_template_part( 'content', '404' ); ?>
	  
	<?php endif; ?>
	
	<?php do_action( 'prima_content_after' ); ?>
	
	</div>
	
	<?php prima_sidebar( 'sidebar' ); ?>
	
	</div>
	
	<?php prima_sidebar( 'sidebarmini' ); ?>
	
    <?php do_action( 'prima_content_block_after' ); ?>

  </div>
  
  <?php do_action( 'prima_main_inner_after' ); ?>
  
</section>

<?php do_action( 'prima_main_after' ); ?>

<?php get_footer(); ?>