<?php 
//VAR SETUP
$category = get_option('themolitor_slider_category');
$number = get_theme_mod('themolitor_customizer_slider_number','5');
$showPostsInCategory = new WP_Query(); $showPostsInCategory->query('cat='. $category .'&showposts='. $number .'');
if ($showPostsInCategory->have_posts()) : 
echo '<div id="nivoSlider" class="nivoSlider">';
while ($showPostsInCategory->have_posts()) : $showPostsInCategory->the_post(); 
	$data = get_post_meta( $post->ID, 'key', true ); 
	if(!empty($data[ 'custom_link' ])){$customLink = $data[ 'custom_link' ];}
	if(!empty($customLink)) { $slideLink = $customLink; } else { $slideLink = get_permalink();}?>
	<a class="tooltip" href="<?php echo $slideLink; ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail('nivo'); ?></a>			
<?php 
endwhile;
echo '</div>';
endif; 
wp_reset_query(); 
?>