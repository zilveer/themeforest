<?php
/**
 * The template for displaying image attachments.
 *
 * @package progression
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	
<div id="page-title">		
	<div class="width-container">
		<?php if(function_exists('bcn_display')) {echo '<div id="bread-crumb">'; bcn_display(); echo '</div>'; }?>
		<h1><?php the_title(); ?></h1>
		<div class="clearfix"></div>
	</div>
</div><!-- close #page-title -->


<div id="main">
	
<div class="width-container">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-header">
			<div class="entry-meta">
				<?php
					$metadata = wp_get_attachment_metadata();
					printf( __( 'Published <span class="entry-date"><time class="entry-date" datetime="%1$s">%2$s</time></span> at <a href="%3$s">%4$s &times; %5$s</a> in <a href="%6$s" rel="gallery">%7$s</a>', 'progression' ),
						esc_attr( get_the_date( 'c' ) ),
						esc_html( get_the_date() ),
						esc_url( wp_get_attachment_url() ),
						$metadata['width'],
						$metadata['height'],
						esc_url( get_permalink( $post->post_parent ) ),
						get_the_title( $post->post_parent )
					);

					edit_post_link( __( 'Edit', 'progression' ), '<span class="edit-link">', '</span>' );
				?>
			</div><!-- .entry-meta -->

			<div role="navigation" id="image-navigation" class="image-navigation">
				<div class="nav-previous"><?php previous_image_link( false, __( '<span class="meta-nav">&larr;</span> Previous', 'progression' ) ); ?></div>
				<div class="nav-next"><?php next_image_link( false, __( 'Next <span class="meta-nav">&rarr;</span>', 'progression' ) ); ?></div>
			</div><!-- #image-navigation -->
		</div><!-- .entry-header -->

		<div class="entry-content">
			<div class="entry-attachment">
				<div class="attachment">
					<?php progression_the_attached_image(); ?>
				</div><!-- .attachment -->

				<?php if ( has_excerpt() ) : ?>
				<div class="entry-caption">
					<?php the_excerpt(); ?>
				</div><!-- .entry-caption -->
				<?php endif; ?>
			</div><!-- .entry-attachment -->

			<?php
				the_content();
				wp_link_pages( array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'progression' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

		<br><br>
		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() )
				comments_template();
		?>
		
		<div class="clearfix"></div>
	</article><!-- #post-## -->
<?php endwhile; // end of the loop. ?>




	<div class="clearfix"></div>
</div><!-- close .width-container -->
<?php get_footer(); ?>
