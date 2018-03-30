<?php get_header();?>

<?php 
global $theme_options;
$location = icore_get_location();   
$meta = icore_get_multimeta(array('Subheader')); ?>

<div id="entry-full">
	<div id="page-top"> 
    	<h1 class="title"><?php the_title(); ?></h1>
    </div> <!-- #page-top  -->
    <div id="left" class="full-width">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<?php
					$content = get_the_content();
					preg_match('/\[gallery(.*?)]/', $content , $matches);
					
					if ( empty( $matches ) ) {
					?>
						<?php if ( has_post_thumbnail() ) : ?>
							<div class="single-portfolio-image"><?php the_post_thumbnail( 'large' ); ?></div>
						<?php endif; ?>
					
					<?php } ?>
					<?php the_content(); ?>
				
				</div>  <!-- .post-content -->
			
			<footer class="meta">
				<?php echo get_the_term_list( $post->ID, 'pcategory', 'Category: ', ', ', '' )."</br>";
					  echo get_the_term_list( $post->ID, 'ptag', 'Tags: ', ', ', '' )."</br>"; ?>
			</footer><!-- #entry-meta -->
			
			<div class="portfolio-nav">
				<?php previous_post_link( '<div class="alignleft pagination-prev">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'Arcturus' ) . '</span> %title' ); ?>
				<?php next_post_link( '<div class="alignright pagination-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'Arcturus' ) . '</span>' ); ?>
			</div>

	<?php endwhile; else: ?>

	<p><?php _e('Sorry, no posts matched your criteria.','Arcturus'); ?></p>

<?php endif; ?>

		</article><!-- #post-<?php the_ID(); ?> -->
    </div> <!-- #left  -->
</div> <!-- #entry-full  -->
<?php get_footer(); ?>