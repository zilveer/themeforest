<?php
/**
 * The template for displaying Archive pages.
 */

 get_header();
	/* Queue the first post, that way we know
	 * what date we're dealing with (if that is the case).
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	if ( have_posts() )
		the_post();
		st_before_content($columns='sixteen');
?>
<div class="portfolio-wrapper master">
<ul>
<?php
	/* Since we called the_post() above, we need to
	 * rewind the loop back to the beginning that way
	 * we can run the loop properly, in full.
	 */
	rewind_posts();

	/* Run the loop for the archives page to output the posts.
	 * If you want to overload this in a child theme then include a file
	 * called loop-archives.php and that will be used instead.
	 */

//Verify if category is set (All posts)	
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	query_posts( array( 
						 'post_type' => 'portfolio', 
						 'paged' => $paged, 
						 'posts_per_page' => 12,
						 'ignore_sticky_posts' => 1
						 )
				  );

if ( have_posts() ) : while ( have_posts() ) : the_post();
?>


<li class="columns four add15pxmargin">

<div class="view view-second">
    <?php the_post_thumbnail( 'portfolio-thumbnail-3-col' );	?>
    <div class="mask">
        <div class="entry-summary">
			<?php the_excerpt(); ?>
        </div><!-- .entry-summary -->
        <h2 class="entry-title portfolio"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'cherry' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
        <?php 
		$portfolio_lightbox_images = rwmb_meta( 'gg_portfolio_lightbox_image', 'type=thickbox_image' );
		$portfolio_video_link = rwmb_meta( 'gg_portfolio_post_video_link' );
		
		$videos = array( '.mp4', '.MP4', '.flv', '.FLV', '.swf', '.SWF', '.mov', '.MOV', 'youtube.com', 'vimeo.com' );
		$videos_found = false;
		
		foreach ($videos as $video_ext) {
		  if (strrpos($portfolio_video_link, $video_ext)) {
			$videos_found = true;
			break;
		  }
		}
		
		if (!empty($portfolio_lightbox_images)) { //check if array is empty
			  $i = 1; //display only the first image		
			  foreach ( $portfolio_lightbox_images as $portfolio_lightbox_image )
			  {
				  echo "<a class='info' href='{$portfolio_lightbox_image['full_url']}' data-rel='prettyPhoto[mixed]'></a>";
				  if($i == 1) break; //display only the first image
			  }
		} elseif ( $portfolio_video_link) {
			
			  if ($videos_found) {
				  echo "<a class='info video' href='{$portfolio_video_link}' data-rel='prettyPhoto[mixed]'> View video</a>";
			  } else {
				  echo "<a class='info link' href='{$portfolio_video_link}'>External link</a>";
			  }
		 } ?>
    </div>
</div> 

</li>
<?php endwhile; endif; ?>
</ul>

<?php if (function_exists("pagination")) {pagination($wp_query->max_num_pages);} ?>

</div>

<?php
	st_after_content();
	get_footer();
?>