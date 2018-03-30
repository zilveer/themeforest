<?php
/**
 * The loop that displays posts.
 *
 */

?>



<?php /* If there are no posts to display */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', 'localize' ); ?></h1>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'localize' ); ?></p>
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
		
			<?php if ( !is_search() ) { ?>
			<h3 class="entry-title excpts vfont" style="margin: 0px;"><?php the_title(); ?></h3>
			<div class="vmeta smallfont">
				<?php ntl_posted_on(); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php echo get_the_author(); ?></a>
			</div>
			<?php 
			$pphoto = '';
			$pphoto = get_the_post_thumbnail($post->ID, 'imlink'); 
			if ($pphoto) {
			?>
			
			<div class="excpt">
				<?php the_excerpt(); ?>
				
			</div>
			<div class="menu-content" style="width: 286px; position: relative;">
			<div class="mencontent">
				<div class="imgblock" ><div class="imlk imgoverlink6 menimg">
				<?php the_post_thumbnail('imlink'); ?> 
				<a href="<?php the_permalink(); ?>"><span class="imgblockover imgoverlink6">&nbsp;</span></a>
				</div></div>
				<div class="ctime clear smallfont">
            		<?php the_time('j') ?> 
            		<?php the_time('M') ?>
				</div>	
			</div> 
			</div>
			<?php } else { ?>
			<?php the_excerpt(); ?>
			<?php } ?>
			
			<?php } else { ?>
			<div class="foodmenu searchresult">
			<h2 class="entry-title vfont excpts"><?php the_title(); ?></h2>
			<?php the_excerpt(); ?>	
			<a href="<?php the_permalink(); ?>">Read More</a>
			<span class="clear"></span>
			</div>
			<?php } ?> 

		</div>

		<?php comments_template( '', true ); ?>

<?php endwhile; ?>