<?php
/**
 * The template for displaying posts in the Image Post Format
 *
 * @package WordPress
 * @subpackage Skylab
 * @since Skylab 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		<div class="entry-content-meta-wrapper">
		<header class="entry-header">
			<?php $remove_sidebar_and_center_posts = ot_get_option( 'remove_sidebar_and_center_posts' ); ?>
			<?php if ( ! is_single() ) { // Checks if any single post is being displayed ?>
				<?php if ( 'post' == get_post_type() ) { ?>
					<?php if ( ! empty( $remove_sidebar_and_center_posts ) ) { ?>
						<?php mega_posted_on(); ?>
					<?php } ?>
				<?php } ?>
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permanent Link to %s', 'mega' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php } else { ?>
				<?php if ( ! empty( $remove_sidebar_and_center_posts ) ) { ?>
					<?php mega_posted_on(); ?>
				<?php } ?>
				<h2 class="entry-title"><?php the_title(); ?></h2>
			<?php } // End if ( ! is_single() ) ?>
			<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<?php $show_sep = false; ?>
					<?php
						/* translators: used between list items, there is a space after the comma */
						$categories_list = get_the_category_list( __( ', ', 'mega' ) );
						if ( $categories_list ):
					?>
					<span class="cat-links">
						<?php printf( __( '<span class="%1$s">Posted in</span> %2$s', 'mega' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
						$show_sep = true; ?>
					</span>
					<?php if ( empty( $remove_sidebar_and_center_posts ) ) { ?>
						<span class="sep">|</span>
					<?php } ?>
					<?php endif; // End if categories ?>

					<?php if ( empty( $remove_sidebar_and_center_posts ) ) { ?>
						<?php mega_posted_on(); ?>
					
						<?php if ( comments_open() ) : ?>
						<?php if ( $show_sep ) : ?>
						<span class="sep"> | </span>
						<?php endif; // End if $show_sep ?>
						<span class="comments-link"><?php comments_popup_link( ''. __( '<i class="fontello-comment"></i> Comment', 'mega' ) .'', __( '<i class="fontello-comment"></i> 1 Comment', 'mega' ), __( '<i class="fontello-comment"></i> % Comments', 'mega' ) ); ?></span>
						<?php endif; // End if comments_open() ?>

						<?php $sep = '<span class="sep"> | </span>' ?>
						<?php edit_post_link( __( 'Edit', 'mega' ), '' . $sep . '<span class="edit-link">', '</span>' ); ?>
					<?php } ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->
		
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail clearfix">
				<?php $image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ); ?>
				<?php if ( is_single() ) : // Checks if any single post is being displayed ?>
					<?php the_post_thumbnail( 'full' ); ?>
				<?php else : ?>
					<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permanent Link to %s', 'mega' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
						<?php the_post_thumbnail( 'full' ); ?>
					</a>
				<?php endif; // End if ( is_single() ) ?>
			</div>
		<?php endif; // End if ( has_post_thumbnail() ) ?>
		
			<div class="entry-content clearfix">
				<?php the_content( __( 'Read More <i>&rarr;</i>', 'mega' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'mega' ) . '</span>', 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
				
			<?php if ( ! empty( $remove_sidebar_and_center_posts ) ) { ?>
			<div class="below-content-entry-meta clearfix">
				<?php if ( comments_open() ) : ?>
					<span class="comments-link"><?php comments_popup_link( ''. __( 'Comment', 'mega' ) .'', __( '1 Comment', 'mega' ), __( '% Comments', 'mega' ) ); ?></span>
					<?php endif; // End if comments_open() ?>

				<?php $sep = '<span class="sep"> | </span>' ?>
				<?php edit_post_link( __( 'Edit', 'mega' ), '' . $sep . '<span class="edit-link">', '</span>' ); ?>
			</div>
			<?php } ?>
			
			<footer class="entry-meta clearfix">
		
				<?php $show_sep = false; ?>
				<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
				
				<?php
					/* translators: used between list items, there is a space after the comma */
					$tags_list = get_the_tag_list( '', __( '', 'mega' ) );
					if ( $tags_list ):
					if ( $show_sep ) : ?>
				<span class="sep"> | </span>
					<?php endif; // End if $show_sep ?>
				<span class="tag-links">
					<?php echo $tags_list; ?>
					<?php //printf( __( '<span class="%1$s">Tagged </span> %2$s', 'mega' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
					$show_sep = true; ?>
				</span>
				<?php endif; // End if $tags_list ?>
				<?php endif; // End if 'post' == get_post_type() ?>
			</footer><!-- .entry-meta -->
			</div><!-- .entry-content-meta-wrapper -->
		
			<?php if ( is_single() ) : // Checks if any single post is being displayed ?>
				<?php comments_template( '', true ); ?>
			<?php endif; // End if ( is_single() ) ?>
	</article><!-- #post-<?php the_ID(); ?> -->