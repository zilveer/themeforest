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
 * @package 	proStore/library/loop/content-mini.php
 * @file	 	1.0
 */
?>
<?php global $format, $post_type, $data, $prefix; ?>
<?php 
	$class1="two mobile-one";
	if($data[$prefix."meta_format"]!="1") { $class1=""; $class2="twelve"; }
	$class2="ten mobile-three";
	
	$icon = "";
	if($data[$prefix."meta_format"]=="1") {
		switch($format) {
			case "image" :
				$icon = "camera";					
				break;
			case "status" : 
				$icon = "user";
				break;
			case "quote" :
				$icon = "quote-right";
				break;
			case "audio" : 
				$icon = "volume-down";
				break;
			case "aside" : 					
				break;
			case "gallery" : 
				$icon = "popup";
				break;
			case "link" : 
				$icon = "link";
				break;
			case "video" :
				$icon = "video";
				break;		
		}
		if($post_type=="product") {
			$icon = "basket";
		}
		if($post_type=="portfolio") {
			$icon = "picture";
		}
	}
?>

<?php if($class1!="") { ?>
	<header class="clearfix two columns text-center post-icon mobile-one">
		<em class="icon-<?php echo $icon; ?>"></em>
	</header>
<?php } ?>
<div class="<?php echo $class2; ?> columns post-content clearfix">
	<h5><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
	<div class="clear"></div>
	<?php if($data[$prefix."meta_date"]=="1" || $data[$prefix."meta_category"]=="1" || $data[$prefix."meta_tags"]=="1" || $data[$prefix."meta_likes"]=="1" || $data[$prefix."meta_comments"]=="1") { ?>
		<div class="clearfix post_meta <?php if($data[$prefix."responsive_meta"]!="1") {echo "hide-for-small";} ?>">
			<?php get_template_part('library/loop/post','footer'); ?>
		</div>	
		<div class="clear"></div>
	<?php } ?>
</div>