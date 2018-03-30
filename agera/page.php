<?php

	/**
	* Page
	*
	* @package WordPress
	* @subpackage Agera
	*/	
 
get_header();	
$mp_option = agera_get_global_options();
$page_id = get_the_ID();
	
$post_values = get_post_custom($page_id);
if( isset($post_values['page_background'][0]) )
	$page_data['background'] = $post_values['page_background'][0];
else
	$page_data['background'] = '';

?>

<style>
	#content {
		background: url(<?php echo $page_data['background']; ?>);
	}
</style>

<div id="content" role="main">
	<div class="page-container">
		<div class="page-content">
	<?php if(have_posts()){
		while(have_posts()){
			the_post(); ?>
				<?php if(!is_front_page()) { ?>
     			<h2 class="mpc-page-title">
						<?php the_title(); ?>
     			</h2>
     			<?php } ?>
      			<?php the_content('', TRUE, ''); ?>
      			<?php if ($pos=strpos($post->post_content, '<!--more-->')) { ?>
      				<div class="moreArrow"></div>
      					<a href="<?php the_permalink();?>" class="more-link">read more</a>
      			<?php } ?>
    		</div><!-- end page-content -->
    	<?php } ?>
    	<div id="post_navigation">
     	 <?php previous_posts_link(); ?>
     	 <?php next_posts_link(); ?>
    	</div> <!-- end post_navigation -->
    <?php } else { ?>
    	<article id="post-0" class="post no-results not-found">
			<header class="entry-header search-result">
				<h3 class="entry-title"><?php _e( 'Nothing Found', 'agera' ); ?></h3>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'agera' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-0 -->
    <?php } ?>
    <?php wp_link_pages(); ?> 
	</div> <!-- end page-content -->
</div><!-- end content -->
<?php get_footer(); ?>
</body>
</html>
