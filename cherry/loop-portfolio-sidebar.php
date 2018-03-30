<?php
/**
 * The loop that displays the portfolio posts.
 */
?>

<?php
	//Get page columns
	$page_columns = rwmb_meta('gg_portfolio_page_columns');
	if ($page_columns) {
		if ($page_columns == 'one-col') {
			$portfolio_col_class="twelve";
			$portfolio_img_dim = "portfolio-thumbnail-1-col";
			$portfolio_col_no = "1";
		} elseif ($page_columns == 'two-col') {
			$portfolio_col_class="six add15pxmargin";
			$portfolio_img_dim = "portfolio-thumbnail-2-col";
			$portfolio_col_no = "2";
		} elseif ($page_columns == 'three-col') {
			$portfolio_col_class="four add15pxmargin";
			$portfolio_img_dim = "portfolio-thumbnail-3-col";
			$portfolio_col_no = "3";
		} elseif ($page_columns == 'four-col') {
			$portfolio_col_class="three add15pxmargin";
			$portfolio_img_dim = "portfolio-thumbnail-4-col";
			$portfolio_col_no = "4";		
		}
	} else {
		$portfolio_col_class="five add15pxmargin";
		$portfolio_img_dim = "portfolio-thumbnail-3-col";
		$portfolio_col_no = "3";
	}
	//Get hover effect
	$hover_effect = rwmb_meta('gg_portfolio_hover_effect');
	if (empty($hover_effect)) { $hover_effect = "first";}
	//Get portfolio no. of posts
	$portfolio_page_nr_posts = get_post_meta( get_the_ID(), 'gg_portfolio_page_nr_posts', true );
	//Get portfolio category
	$terms = rwmb_meta( 'gg_portfolio_page_categories', 'type=taxonomy&taxonomy=portfolio_category' );
	foreach ( $terms as $term ){$portfolio_category = $term->name;}
?>
<div class="portfolio-wrapper master-sidebar">
<ul>
<?php
//Verify if category is set (All posts)	
if(isset($portfolio_category)){
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
query_posts( array( 
						 'post_type' => 'portfolio', 
						 'paged' => $paged, 
						 'posts_per_page' => $portfolio_page_nr_posts,
						 'ignore_sticky_posts' => 1,
						 'portfolio_category' => $portfolio_category
						 )
				  );
} else {
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	query_posts( array( 
						 'post_type' => 'portfolio', 
						 'paged' => $paged, 
						 'posts_per_page' => $portfolio_page_nr_posts,
						 'ignore_sticky_posts' => 1
						 )
				  );
}
if ( have_posts() ) : while ( have_posts() ) : the_post();?>

<li class="columns <?php echo $portfolio_col_class; ?>">
<div class="view view-<?php echo $hover_effect; ?>">
    <?php the_post_thumbnail( $portfolio_img_dim );	?>
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

<?php wp_reset_query(); ?>