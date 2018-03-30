<?php
/**
 * Single Blog Post Template
 */
 
// Header
get_template_part( 'header', 'blog-archive');

?>

<div id="content">

	<div id="content-inner"<?php if ( risen_sidebar_enabled( 'blog' ) ) : ?> class="has-sidebar"<?php endif; ?>>

		<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header>

				<h1 id="blog-single-page-title" class="page-title">
					<?php the_title(); ?>
					<?php if ( $numpages > 1 ) : ?>
					<span><?php printf( __( '(Page %s)', 'risen' ), $page, $numpages ); ?></span>
					<?php endif; ?>
				</h1>
			
				<div id="blog-single-header-meta" class="box blog-header-meta">

					<div class="blog-time-author">
				
						<time datetime="<?php the_time( 'c' ); ?>"><?php echo risen_date_ago( get_the_time( 'U' ), 5 ); // show up to "5 days ago" but actual date if older ?></time>

						<span class="blog-header-meta-author">
							<?php
							printf(
								_x( 'by <a href="%1$s">%2$s</a>', 'author', 'risen'),
								esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), // author URL
								get_the_author() // author name
							);
							?>
						</span>
					
					</div>

					<ul class="blog-header-meta-icons risen-icon-list dark">
						<?php if ( ( comments_open() || get_comments_number() > 0 ) && ! post_password_required() ) : // show X comments if some were posted, even if no new comments are off; always hide if post is protected ?>
						<li><?php comments_popup_link( __( '0 Comments', 'risen' ), __( '1 Comment', 'risen' ), __( '% Comments', 'risen' ), 'single-icon comment-icon scroll-to-comments', '' ); ?><?php comments_popup_link( __( '0 Comments', 'risen' ), __( '1 Comment', 'risen' ), __( '% Comments', 'risen' ), 'risen-icon-label scroll-to-comments', '' ); ?></li>
						<?php endif; ?>
					</ul>
					
					<div class="clear"></div>
					
				</div>

			</header>
		
			<div class="post-content"> <!-- confines heading font to this content -->
				<?php the_content(); ?>
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
			$categories_list = get_the_category_list( __( ', ', 'risen' ) );
			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'risen' ) );
			if ( $categories_list || $tag_list || get_edit_post_link( $post->ID ) ) :
			?>
			<footer id="blog-single-footer-meta" class="box post-footer<?php echo ( get_edit_post_link() ? ' can-edit-post' : '' ); // add class if there will be an edit button ?>">

				<?php
				if ( ! empty( $categories_list ) ) :
				?>
				<div id="blog-post-categories"><?php printf( __( 'Posted in %s', 'risen' ), $categories_list ); ?></div>
				<?php endif; ?>
				
				<?php
				if ( ! empty( $tag_list ) ) :
				?>
				<div id="blog-post-tags"><?php printf( __( 'Tagged with %s', 'risen' ), $tag_list ); ?></div>
				<?php endif; ?>
				
				<?php edit_post_link( __( 'Edit Post', 'risen' ), '<span class="post-edit-link-container">', '</span>' ); // edit link for admin if logged in ?>

			</footer>
			<?php endif; ?>

			<?php risen_author_box(); ?>
			
		</article>

		<?php comments_template( '', true ); ?>

		<?php endwhile; // end of the loop ?>

		<nav class="nav-left-right" id="blog-single-nav">
			<div class="nav-left"><?php next_post_link( '%link', __( '<span>&larr;</span> Newer Post', 'risen' ) ); ?></div>
			<div class="nav-right"><?php previous_post_link( '%link', __( 'Older Post <span>&rarr;</span>', 'risen' ) ); ?></div>
			<div class="clear"></div>
		</nav>
				
	</div>

</div>

<?php risen_show_sidebar( 'blog' ); ?>

<?php get_footer(); ?>