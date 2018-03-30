<?php
/**
 * The main template file.
 *
 */
get_header();?>

<?php 
$slideshow_select = of_get_option('slideshow_select');

if ($slideshow_select !== "none") {
 
if ($slideshow_select == "classic") {
	get_template_part( 'loop', 'slideshow' );
} elseif ($slideshow_select == "sequence") {
	get_template_part( 'loop', 'slideshow-sequence' );
} elseif ($slideshow_select == "camera") {	
	get_template_part( 'loop', 'slideshow-camera' );
}

}
?>

<?php st_before_content($columns='sixteen');?>

<?php if (of_get_option('homepage_first_section')) { ?>
<div class="about-wrapper">
	<div class="clear"></div>
	<h1 class="homepage-section-title"><span><?php echo of_get_option('homepage_first_section_title'); ?></span></h1>
    <div class="four columns alpha add15pxmargin">
    	<h3 class="widget-title"><?php echo of_get_option('homepage_left_module_title'); ?></h3>
        <?php echo do_shortcode( of_get_option('homepage_left_module_editor') ); ?>
        
    </div>
    <div class="twelve columns omega add15pxmargin">
    	<h3 class="widget-title"><?php echo of_get_option('homepage_right_module_title'); ?></h3>
        <?php echo do_shortcode( of_get_option('homepage_right_module_editor') ); ?>
    </div>
</div>
<?php } ?>

<?php if (of_get_option('homepage_second_section')) { ?>
<div class="portfolio-wrapper">
<div class="clear"></div>
<h1 class="homepage-section-title"><span><?php echo of_get_option('homepage_second_section_title'); ?></span></h1>

<div class="four columns alpha add15pxmargin">
    <h3 class="widget-title"><?php echo of_get_option('homepage_portfolio_title'); ?></h3>
    <?php echo do_shortcode( of_get_option('homepage_portfolio_editor') ); ?>
    <ul class="carousel-nav-arrows">
        <li><a class="prev" id="home-carousel-nav-left" href="#"><span>prev</span></a></li>
        <li><a class="next" id="home-carousel-nav-right" href="#"><span>next</span></a></li>
    </ul>

</div>

<div class="twelve columns omega add15pxmargin">
<div class="home-portfolio-carousel-wrapper">
<ul class="home-carousel">
<?php
$porthover = of_get_option('home_portfolio_hover','first');
//Verify if category is set (All posts)	
if((of_get_option('portfolio_select_categories',''))){
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	query_posts( array( 
						 'post_type' => 'portfolio', 
						 'paged' => $paged, 
						 'posts_per_page' => of_get_option('portfolio_nr_posts'),
						 'ignore_sticky_posts' => 1,
						 'portfolio_category' => of_get_option('portfolio_select_categories')
						 )
				  );
} else {
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	query_posts( array( 
						 'post_type' => 'portfolio', 
						 'paged' => $paged, 
						 'posts_per_page' => of_get_option('portfolio_nr_posts'),
						 'ignore_sticky_posts' => 1
						 )
				  );
}

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

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

<?php endwhile; ?>
<?php endif; ?>
</ul>
</div>
</div>
</div>
<?php } ?>
<div class="clear"></div>

<?php if (of_get_option('homepage_third_section')) { ?>
<div class="sponsors-wrapper">
<h1 class="homepage-section-title"><span><?php echo of_get_option('homepage_third_section_title'); ?></span></h1>

<ul class="carousel-nav-arrows">
        <li><a class="prev" id="home-carousel-sponsors-nav-left" href="#"><span>prev</span></a></li>
        <li><a class="next" id="home-carousel-sponsors-nav-right" href="#"><span>next</span></a></li>
</ul>

<div class="sponsors-carousel-wrapper">
<ul class="home-carousel-sponsors">
<?php
query_posts( array( 'post_type' => 'sponsors', 'paged' => $paged, 'posts_per_page' => of_get_option('sponsors_nr_posts')));
if ( have_posts() ) : while ( have_posts() ) : the_post();?>

<li>
	<?php
	$sponsors_external_link = rwmb_meta( 'gg_sponsors_external_link' );
	if ($sponsors_external_link) { 
	echo "<a href='$sponsors_external_link'>";}
	the_post_thumbnail( 'sponsors' );
	if ($sponsors_external_link) { echo "</a>";}
	?>
</li>

<?php endwhile; endif; ?>
</ul>
</div>
</div>
<?php } ?>

<?php
st_after_content();
get_footer();
?>