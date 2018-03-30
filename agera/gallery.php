<?php

	/**
	* Page
	*
	* @package WordPress
	* @subpackage Agera
	* Template Name: Gallery
	*/	
 
get_header();	
$mp_option = agera_get_global_options();
$page_id = get_the_ID();

?>

<div id="content" role="main">
	<div class="page-container full-width mpc-gallery">
		<div class="page-content">
	<?php if(have_posts()){
		while(have_posts()){
			the_post(); 
				
			$type = '';
			$page_data['asset'] = get_the_content('', TRUE, ''); 
			if( isset($page_data['asset']) && $page_data['asset'] != '') { 
				$asset = $page_data['asset'];
				$search = preg_match('/.(jpg|JPG|gif|GIF|png)/', $asset);
				if($search == 1) {
					$type = 'image';
					$search = 0;
				}
				$search = preg_match('/.(vimeo)./', $asset);
				
				if($search == 1) {
					$type = 'vimeo-video';
					$search = 0;
				}
				
				$search = preg_match('/.(youtu)/', $asset);
				
				if($search == 1) {
					$type = 'youtube-video';
					$search = 0;
				}
				
				$search = substr($asset, 0, 1);

				if($search == '[') {
					$type = 'shortcode';
					$search = 0;
				}
				
				if($type == 'image') { ?>			
					<img src="<?php echo $asset ?>" class="post-asset" style="width: 100%;"/>
				<?php } elseif ($type == 'vimeo-video') { ?>
					<iframe src="<?php echo $asset ?>?color=F9625B" width="100%" height="100%"></iframe>
				<?php } elseif ($type == 'youtube-video') { ?>
					<iframe width="100%" height="100%" src="<?php echo $asset ?>?rel=0" frameborder="0" allowfullscreen></iframe>
				<?php } elseif ($type == "shortcode") {
					echo do_shortcode($asset);
				} ?>
			<?php }?>
		

	      		

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
