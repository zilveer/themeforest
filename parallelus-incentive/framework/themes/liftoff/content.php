<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
		<div class="featured-post">
			<?php _e( 'Featured post', 'liftoff' ); ?>
		</div>
		<?php endif; ?>
		<header class="entry-header">
			<?php 
			if (has_post_thumbnail()) {
				the_post_thumbnail(); 
			} else {
				echo '<div class="no-post-thumbnail"></div>';
			} ?>
			<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php else : ?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'liftoff' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<?php endif; // is_single() ?>
			<div class="entry-meta meta-header">
				<span class="post-date">
					<?php liftoff_entry_date(); ?>
				</span>
				<?php if ( comments_open() ) : ?>
					<span class="comments-link">
						| <?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a reply', 'liftoff' ) . '</span>', __( '1 Reply', 'liftoff' ), __( '% Replies', 'liftoff' ) ); ?>
					</span><!-- .comments-link -->
				<?php endif; // comments_open() ?>
			</div><!-- .meta-header -->
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'liftoff' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'liftoff' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">
			<span class="meta-footer">
				<?php liftoff_entry_meta(); ?>
			</span><!-- .meta-footer -->
			<?php edit_post_link( __( 'Edit', 'liftoff' ), '<span class="edit-link"> | ', '</span>' ); ?>
			<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
				<div class="author-info">
					<div class="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'liftoff_author_bio_avatar_size', 68 ) ); ?>
					</div><!-- .author-avatar -->
					<div class="author-description">
						<h2><?php printf( __( 'About %s', 'liftoff' ), get_the_author() ); ?></h2>
						<p><?php the_author_meta( 'description' ); ?></p>
						<div class="author-link">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'liftoff' ), get_the_author() ); ?>
							</a>
						</div><!-- .author-link	-->
					</div><!-- .author-description -->
				</div><!-- .author-info -->
			<?php endif; ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
