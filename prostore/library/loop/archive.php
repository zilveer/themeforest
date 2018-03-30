<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/loop/archive.php
 * @file	 	1.0
 */
?>
<?php 
	global $masonry, $format, $post_type;
	$format = get_post_format() !="" ? get_post_format() : "standart";			
	$post_type = get_post_type() !="" ? get_post_type() : "standart";
?>

<div class="blog-<?php echo $masonry; ?>-item">

	<div class="blog-post row container clearfix format-<?php echo $format; ?> type-<?php echo $post_type; ?> <?php echo $masonry; ?>">

		<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
						
			<?php 
				if($masonry == "mini") {
					get_template_part('library/loop/content','mini'); 
				} else {
					get_template_part('library/loop/content','regular');
				}
			?>
								
		</article> <!-- end article -->						
	</div>
		
</div>

									