<?php
/*
	Ajax function callback for quicksand js. You can example at 'portfolio with sidebar' page
*/
if ( ! is_user_logged_in() ) {
	add_action('wp_ajax_nopriv_quicksand_filter', 'quicksand_filter');
} else {
	add_action('wp_ajax_quicksand_filter', 'quicksand_filter');
}	
if(!function_exists ('quicksand_filter')){
	function quicksand_filter(){
		wp_reset_query();
		if($_POST['filter'] == 'all')
			$num_post = count(query_posts('post_type='.$_POST['post_type'].'&posts_per_page='.$_POST['num_posts_per_page'].'&paged='.$_POST['page']));
		else
			$num_post = count(query_posts('meta_key='.THEME_SLUG.'type_portfolio&meta_value='.$_POST['filter'].'&post_type='.$_POST['post_type'].'&posts_per_page='.$_POST['num_posts_per_page'].'&paged='.$_POST['page']));
		$column_count = $_POST['column_count'];
		$width_thumb = $_POST['width_thumb'];
		$height_thumb = $_POST['height_thumb'];
		$i = 0;
		
		?>
		<ul class="list-post">
		<?php 
		while(have_posts()){ the_post();global $post;
			$thumbnail = get_thumbnail($width_thumb,$height_thumb,'',get_the_title(),get_the_title());
			$thumb = $thumbnail["fullpath"];
		?>
			<li class="item<?php if($i % $column_count == 0) echo ' start';?><?php if(++$i%$column_count == 0 || $i == $num_post) echo ' end';?>" data-id="<?php echo $post->ID;?>" title="<?php echo $i;?>">
				<?php if($thumb || $video_link = get_post_meta($post->ID,THEME_SLUG.'video_portfolio',true)){?>
				<div class="image image-style">
					<a class="thumbnail" href="<?php the_permalink(); ?>">
						<?php 
							if($thumb) 
									the_post_thumbnail( array($width_thumb,$height_thumb),array('class' => 'thumbnail-effect-1'));
				
							else 
								echo get_thumbnail_video($video_link,$width_thumb,$height_thumb);
						?>
					</a>
					<?php 
					if($_POST['lightbox'] == 'true'){
						if($video_link)
							show_light_box($post,'fancybox-group','',$_POST['id_group'].'-'.$post->ID);
						else	
							show_light_box($post,'fancybox-group','lightbox-'.$_POST['id_group'],$_POST['id_group'].'-'.$post->ID);
					}?>
				</div>
				<?php }?>
				<div class="detail<?php if(!$thumb && !$video_link) echo ' noimage';?>">
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'wpdance' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<div class="entry-content">
						<?php the_excerpt_max_charlength(250) ?>
					</div><!-- .entry-content -->
					<a href="<?php the_permalink(); ?>" class="read-more-btn button"><span><span><?php _e('Read more','wpdance')?></span></span></a>
				</div>
			</li>
		<?php }?>
		</ul>

		<?php 
		wp_reset_query();

	}
}

?>