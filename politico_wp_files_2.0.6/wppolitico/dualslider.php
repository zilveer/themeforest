<?php 
//VAR SETUP
$category = get_option('themolitor_slider_category');
$number = get_theme_mod('themolitor_customizer_slider_number','5');
//CUSTOM LOOP
$showPostsInCategory = new WP_Query(); $showPostsInCategory->query('cat='. $category .'&showposts='. $number .'');
if ($showPostsInCategory->have_posts()) :

echo '<div id="molitorCarousel">';

	while ($showPostsInCategory->have_posts()) : $showPostsInCategory->the_post();
	$data = get_post_meta( $post->ID, 'key', true ); 
	if(!empty($data['custom_link'])){$postLink = $data['custom_link'];} else {$postLink = get_permalink();}
	?>
	<div class="slide" id="slide<?php echo $post->ID;?>">
		<div class="slideMedia">
			<?php if(!empty($data['custom_video'])) { 
				echo $data['custom_video']; 
			} else { ?>
				<a href="<?php echo $postLink; ?>"><?php the_post_thumbnail('dual'); ?></a>
			<?php } ?>	
		</div><!-- end slideMedia -->
		
		<div class="slideDetailsWrapper">
			<div class="slideDetails">
				<h2><?php the_title(); ?></h2>
				<?php the_excerpt(); ?>
				<p><a class="sliderMore" href="<?php echo $postLink; ?>"><?php _e('Continue','themolitor');?> &raquo;</a></p>
			</div><!-- end slideDetails -->
		</div><!-- end slideDetailsWrapper -->
	</div><!--end slide-->
	<?php endwhile; ?>

	<div class="paging">
		<div id="numbers"></div>
		<a href="#" class="sliderNav nextPrev prev"><i class="fa fa-chevron-left"></i></a>
		<a href="#" class="sliderNav nextPrev next"><i class="fa fa-chevron-right"></i></a>
	</div><!-- end paging -->
				
	<a href="#" class="sliderNav playPause play tooltip" title="<?php _e('Turn on autoplay','themolitor');?>"><i class="fa fa-play"></i></a>
	<a href="#" class="sliderNav playPause pause tooltip" title="<?php _e('Turn off autoplay','themolitor');?>"><i class="fa fa-pause"></i></a>
		
<?php 
echo '</div><!-- end molitorCarousel -->';
endif; 
?>