<?php
/**
 * The template for displaying posts in the Gallery Post Format
 *
 * @package WordPress
 * @subpackage Heat
 * @since Heat 1.0
 */
?>
	
	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
	
	<?php
	global $post;

	if ( metadata_exists( 'post', $post->ID, '_post_image_gallery' ) ) {
			$page_image_gallery = get_post_meta( $post->ID, '_post_image_gallery', true );
	} else {
		// Backwards compat
		$attachment_ids = array_filter( array_diff( get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' ), array( get_post_thumbnail_id() ) ) );
		$page_image_gallery = implode( ',', $attachment_ids );
	}
								
	$attachments = array_filter( explode( ',', $page_image_gallery ) );
	$thumbs = array();
	if ( $attachments ) { ?>
		<div class="post-gallery clearfix">
			<section class="flexslider">
				<ul id="gallery-slider" class="slides">
					<?php foreach ( $attachments as $attachment_id ) { ?>
						<?php $gallery_image_src = wp_get_attachment_image_src( $attachment_id, 'full' ); ?>
						<?php $gallery_image_thumb = wp_get_attachment_image_src( $attachment_id, 'thumbnail' ); ?>
						<?php $attachment = get_post( $attachment_id ); ?>
						<?php $attachment_title = apply_filters( 'the_title', $attachment->post_title ); ?>
						<li><img src="<?php echo $gallery_image_src[0]; ?>" width="<?php echo $gallery_image_src[1]; ?>" height="<?php echo $gallery_image_src[2]; ?>" alt="<?php echo $attachment_title; ?>" /></li>
					<?php } ?>
				</ul>
			</section>
		</div><!-- #post-gallery-slider -->
									
	<?php } else { ?>
		<p class="no-found"><?php _e( 'No images found, please add some images.', 'mega' ); ?></p>
	<?php } // end if ( $attachments ) ?>
		
		<div class="entry-content-meta-wrapper">
		<header class="entry-header">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permanent Link to %s', 'mega' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php if ( is_sticky() ) : ?>
					<i class="icon-pushpin"></i>
				<?php else : ?>
					<i class="icon-picture"></i>
				<?php endif; ?>
				<span class="sep"> / </span>
				<i class="icon-calendar"></i>
				<?php mega_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>

		</header><!-- .entry-header -->
		
			<div class="entry-content clearfix">
				<?php the_content( __( 'Read more <span class="meta-nav">&rarr;</span>', 'mega' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'mega' ) . '</span>', 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
				
			<footer class="entry-meta">
		
				<?php $show_sep = false; ?>
				<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
				<?php
					/* translators: used between list items, there is a space after the comma */
					$categories_list = get_the_category_list( __( ', ', 'mega' ) );
					if ( $categories_list ):
				?>
				<span class="cat-links">
					<?php printf( __( '<span class="%1$s"><i class="icon-folder-open"></i></span> %2$s', 'mega' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
					$show_sep = true; ?>
				</span>
				<?php endif; // End if categories ?>
				<?php
					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', __( ', ', 'mega' ) );
					if ( $tags_list ):
					if ( $show_sep ) : ?>
				<span class="sep"> / </span>
					<?php endif; // End if $show_sep ?>
				<span class="tag-links">
					<?php printf( __( '<span class="%1$s"><i class="icon-tags"></i></span> %2$s', 'mega' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
					$show_sep = true; ?>
				</span>
				<?php endif; // End if $tags_list ?>
				<?php endif; // End if 'post' == get_post_type() ?>

				<?php if ( comments_open() ) : ?>
				<?php if ( $show_sep ) : ?>
				<span class="sep"> / </span>
				<?php endif; // End if $show_sep ?>
				<span class="comments-link"><?php comments_popup_link( '<i class="icon-comment"></i> '. __( 'Comment', 'mega' ) .'', __( '<b>1</b> Comment', 'mega' ), __( '<b>%</b> Comments', 'mega' ) ); ?></span>
				<?php endif; // End if comments_open() ?>

				<?php if ( $show_sep ) : ?>
				<?php $sep = '<span class="sep"> / </span>' ?>
				<?php endif; // End if $show_sep ?>
				<?php edit_post_link( __( '<i class="icon-edit"></i> Edit', 'mega' ), '' . $sep . '<span class="edit-link">', '</span>' ); ?>
			</footer><!-- #entry-meta -->
			</div><!-- .entry-content-meta-wrapper -->
		
			<?php if ( is_single() ) : // Checks if any single post is being displayed ?>
				<nav id="nav-single">
					<h3 class="assistive-text"><?php _e( 'Post navigation', 'mega' ); ?></h3>
					<span class="nav-previous"><?php previous_post_link( '%link', __( 'Older <i class="icon-chevron-right"></i>', 'mega' ) ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', __( '<i class="icon-chevron-left"></i> Newer', 'mega' ) ); ?></span>
				</nav><!-- #nav-single -->
			
			<?php comments_template( '', true ); ?>
			<?php endif; // End if ( is_single() ) ?>
		
	</article><!-- #post-<?php the_ID(); ?> -->