<?php
/**
 * The loop that displays a single post.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<div id="post-<?php the_ID(); ?>" <?php post_class('single'); ?>>
    

    <div class="entry-content">
    	<?php 
		$portfolio_slideshow_images = rwmb_meta( 'gg_portfolio_slideshow_upload', 'type=plupload_image&size=full'); 
		if ($portfolio_slideshow_images) {
		?>
        <div class="shadow-holder">
        <div class="rslides_container">
            <ul class="inner-portfolio-carousel rslides centered-btns centered-btns1">
            <?php   foreach ( $portfolio_slideshow_images as $portfolio_slideshow_image )
                {
                    echo "<li id='{$portfolio_slideshow_image['name']}'><a href='{$portfolio_slideshow_image['full_url']}' title='{$portfolio_slideshow_image['title']}' data-rel='prettyPhoto[mixed]'><img src='{$portfolio_slideshow_image['url']}' width='{$portfolio_slideshow_image['width']}' height='{$portfolio_slideshow_image['height']}' alt='{$portfolio_slideshow_image['alt']}' /></a>";
                    if ($portfolio_slideshow_image['caption']) {echo "<p class='caption'>{$portfolio_slideshow_image['caption']}</p>";}
                    echo "</li>";
                }
                ?>
            </ul>
        </div>
        </div>
        <?php } ?>
        
        
        
        <div class="twelve columns alpha add15pxmargin">
        <h1 class="entry-title"><?php _e( 'Description', 'cherry' ); ?></h1>
        <?php the_content(); ?>
        <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'cherry' ), 'after' => '</div>' ) ); ?>
       
        </div>
        
        <div class="four columns omega add15pxmargin">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php 
			$portfolio_project_date = rwmb_meta( 'gg_portfolio_project_date' );
			$portfolio_project_url = rwmb_meta( 'gg_portfolio_project_url' ); 
			$portfolio_project_details = rwmb_meta( 'gg_portfolio_project_details' ); 
		?>
        <ul class="portfolio-meta">
        	<?php if ($portfolio_project_date) { ?><li class="project-date"><?php echo $portfolio_project_date; ?></li><?php } ?>
            <li class="project-category">
			<?php 
				echo get_the_term_list( $post->ID, 'portfolio_category', '', ' , ');
			?>
            </li>
            <?php if ($portfolio_project_url) { ?><li class="project-url"><?php echo $portfolio_project_url; ?></li><?php } ?>
            <?php if ($portfolio_project_details) { ?><li class="project-details"><?php echo $portfolio_project_details; ?></li><?php } ?>
        </ul>
        </div>
        
        <div class="clear"></div>
        <h1 class="homepage-section-title"><span><?php _e( 'Navigate', 'cherry' ); ?></span></h1>
        <div id="nav-below" class="navigation">
            <div class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">Previous in category ' . _x( '&#171;', 'Previous post link', 'cherry' ) . '</span> %title' ); ?></div>
            <div class="nav-next"><?php next_post_link( '%link', '%title  <span class="meta-nav">' . _x( '&#187;', 'Next post link', 'cherry' ) . ' Next in category</span>' ); ?></div>
        </div><!-- #nav-below -->
		
        
    </div><!-- .entry-content -->
</div><!-- #post-## -->

<?php endwhile; // end of the loop. ?>

<div class="clear"></div>

<?php
$porthover = of_get_option('home_portfolio_hover','first');
if ( 'portfolio' == get_post_type() ) {
$taxs = wp_get_post_terms( $post->ID, 'portfolio_tag' );
if ( $taxs ) {
$tax_ids = array();
foreach( $taxs as $individual_tax ) $tax_ids[] = $individual_tax->term_id;

$args = array(
	'tax_query' => array(
	array(
	'taxonomy'  => 'portfolio_tag',
	'terms'     => $tax_ids,
	'operator'  => 'IN'
	)
	),
	'post__not_in'          => array( $post->ID ),
	'posts_per_page'        => 0,
	'ignore_sticky_posts'   => 1
);

$my_query = new wp_query( $args );

if( $my_query->have_posts() ) {

echo '<h1 class="homepage-section-title"><span>Related posts</span></h1><div class="portfolio-wrapper master"><ul>';
while ( $my_query->have_posts() ) :
$my_query->the_post(); ?>
                 
<li class="four columns add15pxmargin">
<div class="view view-<?php echo $porthover; ?>">
    <?php the_post_thumbnail('portfolio-thumbnail-4-col');	?>
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
 
            <?php endwhile;
 
            echo '</ul></div>';
 
        }
         
        wp_reset_query();
         
    }
}?>