<?php

	/**
	* Single Page
	*
	* @package WordPress
	* @subpackage Agera
	*/	
	
	get_header();

	$post_type = $post->post_type;
		
?>


<div id="content" role="main">
<!-- Display posts -->
<div class="posts-container">


<?php 
$postNumber = 0; 
if(have_posts()) {
	while(have_posts()) {
		the_post();
		$post_meta = '';
		
		$post_meta = get_post_custom($post->ID);
		if(isset($post_meta['full_width_asset'][0]))
			$page_data['asset'] = $post_meta['full_width_asset'][0];
		
		if(isset($post_meta['client'][0]))	
			$page_data['client'] = $post_meta['client'][0]; 
		else
			$page_data['client'] = '';
			
		if(isset($post_meta['tools'][0]))	
			$page_data['tools'] = $post_meta['tools'][0]; 
		else
			$page_data['tools'] = '';
			
		if(isset($post_meta['copyright'][0]))	
			$page_data['copyright'] = $post_meta['copyright'][0]; 
		else
			$page_data['copyright'] = '';
			
		if(isset($post_meta['share'][0]))	
			$page_data['share'] = $post_meta['share'][0]; 
		else
			$page_data['share'] = '0';
			
		$class_like = "mpc-like";
		
		if(!$page_data['share']) 
			$class_like .= "-big";
		

			?>	
		<article class="mpc-post">
			
			<?php 
			$type = '';
			
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
				
				//echo "TYPE = ".$type;
				if($type == 'image') { ?>			
					<img src="<?php echo $asset ?>" class="post-asset"/>
				<?php } elseif ($type == 'vimeo-video') { ?>
					<iframe src="<?php echo $asset ?>?color=F9625B" width="100%" height="100%"></iframe>
				<?php } elseif ($type == 'youtube-video') { ?>
					<iframe width="100%" height="100%" src="<?php echo $asset ?>?rel=0" frameborder="0" allowfullscreen></iframe>
				<?php } elseif ($type == "shortcode") {
					echo do_shortcode($asset);
				} ?>
			<?php } elseif (has_post_thumbnail()) {  ?>
				<div class="post-image">
					<?php the_post_thumbnail(); ?>		
				</div>
			<?php } ?>
			<div class="post-content">
				<h2 class="mpc-post-title"><?php the_title(); ?></h2>
				<?php the_content(); ?>
			</div>
			<aside class="post-meta">
				<div class="meta-content">
					<ul>
						<li><em>Date:</em> <?php echo get_the_date('M j, Y'); ?></li>
						<li><em>Author:</em> <?php echo the_author_posts_link(); ?></li>
						
						<?php if($post_type != 'portfolio') { ?>
							<li><em>Categories:</em> <?php echo get_the_category_list( ', '); ?></li>
						<?php } ?>
						
						<?php if(get_the_tag_list() != "") { ?>
							<li><em>Tags:</em> <?php echo get_the_tag_list('', ', '); ?></li>
						<?php } ?>
						
						<?php if($page_data['client'] != '') { ?>
							<li><em>Client:</em> <?php echo $page_data['client']; ?></li>
						<?php }
						if($page_data['tools'] != '') { ?>
							<li><em>Tools:</em> <?php echo $page_data['tools']; ?></li>
						<?php } ?>
						
						<?php if($page_data['copyright'] != '') { ?>
							<li><em>Artwork By:</em> <?php echo $page_data['copyright']; ?></li>
						<?php } ?>
						
						<li class="<?php echo $class_like; ?>"><em>Like:</em> <?php  if( function_exists('zilla_likes') ) zilla_likes(); ?></li>
						
						<?php if($page_data['share']) { ?>
							<li><em>Share:</em> <?php if( function_exists('zilla_share') ) zilla_share(); ?></li>
						<?php } ?>
					</ul>
					<span class="previous-container">
						<?php previous_post_link('<span class="previous-post"></span> %link', 'Previous', false) ;?>
					</span>
					<span class="next-container">
						<?php next_post_link('%link <span class="next-post"></span>', 'Next', false) ;?>
					</span>
				</div>
			</aside>
			<div class="post-comments">
				<?php comments_template('', true); ?>
	    	</div><!-- post_comments -->  
	    </article><!-- end mpc-post -->
    <?php } ?>
    <div id="post_navigation">
    	<?php wp_link_pages(); ?> 
    </div>
    <!-- end post_navigation -->
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
    </div>
	
  </div> <!-- end content -->

  <?php get_footer(); ?>
</body>
</html>
