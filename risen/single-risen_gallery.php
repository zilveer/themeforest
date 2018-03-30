<?php
/**
 * Single Gallery Item Template
 */

// Header
get_template_part( 'header', 'gallery-archive');

?>

<div id="content">

	<div id="content-inner"<?php if ( risen_sidebar_enabled( 'gallery' ) ) : ?> class="has-sidebar"<?php endif; ?>>

		<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header>

				<h1 id="gallery-single-page-title" class="page-title">
					<?php the_title(); ?>
					<?php if ( $numpages > 1 ) : ?>
					<span><?php printf( __( '(Page %s)', 'risen' ), $page, $numpages ); ?></span>
					<?php endif; ?>
				</h1>

			</header>
			
			<?php if ( ! post_password_required() ) : ?>			
			<div id="gallery-single-header-meta" class="box gallery-header-meta">

				<div class="gallery-time-author">
			
					<time datetime="<?php the_time( 'c' ); ?>"><?php echo risen_date_ago( get_the_time( 'U' ), 5 ); // show up to "5 days ago" but actual date if older ?></time>

					<span class="gallery-header-meta-author">
						<?php
						/*
						printf(
							_x( 'by <a href="%1$s">%2$s</a>', 'author', 'risen'),
							esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), // author URL
							get_the_author() // author name
						);
						*/
						?>
					</span>
				
				</div>

				<ul class="gallery-header-meta-icons risen-icon-list dark">
					<?php if ( ( comments_open() || get_comments_number() > 0 ) && ! post_password_required() ) : // show X comments if some were posted, even if no new comments are off; always hide if post is protected ?>
					<li><?php comments_popup_link( __( '0 Comments', 'risen' ), __( '1 Comment', 'risen' ), __( '% Comments', 'risen' ), 'single-icon comment-icon scroll-to-comments', '' ); ?><?php comments_popup_link( __( '0 Comments', 'risen' ), __( '1 Comment', 'risen' ), __( '% Comments', 'risen' ), 'risen-icon-label scroll-to-comments', '' ); ?></li>
					<?php endif; ?>
				</ul>
				
				<div class="clear"></div>
				
			</div>
			<?php endif; ?>

			<?php
			
			$full_image_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'risen-gallery' ); // full-size image for lightbox
			$full_image_url = $full_image_src[0];
			
			$video_url = get_post_meta( $post->ID, '_risen_gallery_video_url', true );
			$video = risen_video( $video_url );
			
			if ( ( has_post_thumbnail() || ! empty( $video['embed_code'] ) ) && ! post_password_required() ) : // we have video or image and post is not password protected
			?>			
			<div id="gallery-media">
			
				<?php if ( ! empty( $video['embed_code'] ) ) : // video ?>
				
				<?php echo $video['embed_code']; // has container with classes .video-container and .youtube-video (or .vimeo-video) ?>
				
				<?php else : // image ?>
							
				<div class="gallery-image-container image-frame">			
					<?php the_post_thumbnail( 'risen-gallery', array( 'title' => get_the_title(), 'alt' => get_the_title() ) ); ?>
				</div>
				
				<?php endif;?>
				
				<div class="clear"></div>
				
			</div>
			<?php endif; ?>		
		
			<div class="post-content"> <!-- confines heading font to this content -->
				<?php the_content() ?>
			</div>
			
			<?php
			// multipage post nav: 1, 2, 3, etc. for when <!--nextpage--> is used in content
			if ( ! post_password_required() ) {
				wp_link_pages( array(
					'before'	=> '<div class="box multipage-nav"><span>' . __( 'Pages:', 'risen' ) . '</span>',
					'after'		=> '</div>'
				) );
			}
			?>

			<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_term_list( $post->ID, 'risen_gallery_category', '', __( ', ', 'risen' ) );
			if ( $categories_list || get_edit_post_link( $post->ID ) ) :
			?>
			<footer id="gallery-single-footer-meta" class="box post-footer<?php echo ( get_edit_post_link() ? ' can-edit-post' : '' ); // add class if there will be an edit button ?>">

				<?php
				if ( ! empty( $categories_list ) ) :
				?>
				<div id="gallery-single-categories"><?php printf( __( 'Posted in %s', 'risen' ), $categories_list ); ?></div>
				<?php endif; ?>
				
				<?php edit_post_link( __( 'Edit Post', 'risen' ), '<span class="post-edit-link-container">', '</span>' ); // edit link for admin if logged in ?>

			</footer>
			<?php endif; ?>
			
		</article>

		<?php comments_template( '', true ); ?>

		<?php endwhile; // end of the loop. ?>

		<nav class="nav-left-right" id="gallery-single-nav">
			<div class="nav-left"><?php next_post_link( '%link', _x( '<span>&larr;</span> Newer Item', 'gallery', 'risen' ) ); ?></div>
			<div class="nav-right"><?php previous_post_link( '%link', _x( 'Older Item <span>&rarr;</span>', 'gallery', 'risen' ) ); ?></div>
			<div class="clear"></div>
		</nav>
				
	</div>

</div>

<?php risen_show_sidebar( 'gallery' ); ?>

<?php get_footer(); ?>