<?php
/**
 * The loop that displays posts.
 *
 */

?>



<?php /* If there are no posts to display */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'wp-church' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'wp-church' ); ?></p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</div><!-- #post-0 -->
<?php endif; ?>

<?php
	/* Start the Loop.
	 *
	 *
	 * Without further ado, the loop:
	 */ ?>
<?php while ( have_posts() ) : the_post(); ?>


		<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<div class="c_entry">
		
			<?php the_post_thumbnail('full'); ?>  
			
			<div class="c_entry-meta">
				
				<div class="ctime">
            		<h6 class="day"><?php the_time('j') ?></h6>
            		<h6 class="month"><?php the_time('M') ?><br><?php the_time('Y') ?></h6>
            		<div class="clear"></div>
				</div>	
				<p>Posted by<br/><strong><?php the_author(); ?></strong></p>
				<p>Posted in<br/><?php the_category('<br/>'); ?></p>
				<?php comments_popup_link( __( 'Leave a comment', 'wp-church' ), __( '1 Comment', 'wp-church' ), __( '% Comments', 'wp-church' ) ); ?>

			</div><!-- .entry-meta -->
			<div class="c_entry-content">
				<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wp-church' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php the_excerpt(); ?>
			</div>
			<div class="clear"></div>
			

		</div>

	<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
			<div class="entry-summary">
				 
				
			</div><!-- .entry-summary -->
	<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( '<span>Read More</span>', 'wp-church' ) ); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'wp-church' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
	<?php endif; ?>

			<div class="entry-utility">
				<?php
					$tags_list = get_the_tag_list( '', ' ' );
					if ( $tags_list ):
				?>
					<span class="tag-links">
						<?php printf( __( '<span class="%1$s">Tags:</span> %2$s', 'wp-church' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
					</span>
				<?php endif; ?>
			</div><!-- .entry-utility -->

		</div><!-- #post-## -->

		<?php comments_template( '', true ); ?>

<?php endwhile; ?>