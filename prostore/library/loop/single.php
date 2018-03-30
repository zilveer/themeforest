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
 * @package 	proStore/library/loop/single.php
 * @file	 	1.2
 */
?>
<?php
	global $format, $data, $prefix;
	// = get_post_format() !="" ? get_post_format() : "standart";
?>

<?php if($format != "aside") { ?>
	<header>
		<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
	</header>
<?php } ?>

<?php
	$date = "0"; $share = "0"; $likes = "0"; $format_icon = "0"; $category=""; $tags="";
	$class1=""; $class2=""; $class3=""; $class4=""; $class5=""; $class6="";

	$date = $data[$prefix."meta_date_s"];

	$likes = $data[$prefix."meta_likes_s"];
	if(!function_exists('zilla_likes')) $likes = "0";

	$format_icon = $data[$prefix."meta_format_s"];
	if($format == "standart") $format_icon = "0";

	$share = $data[$prefix."meta_share_s"];
	if(!function_exists('zilla_share')) $share = "0";

	$category = $data[$prefix."meta_category_s"];
	if(!has_category()) $category = "0";

	$tags = $data[$prefix."meta_tags_s"];
	if(!has_tag()) $tags = "0";

	if($date=="1" && $likes=="1" && $format_icon=="1" && $share=="1") {
		$class1="two mobile-one";
		$class2="one push-eight mobile-two text-center";
		$class3="one push-eight mobile-one text-center";
		$class4="eight pull-two mobile-four text-center";
	}
	if($date!="1" && $likes=="1" && $format_icon=="1" && $share=="1") {
		$class1="";
		$class2="one push-ten mobile-two text-center";
		$class3="one push-ten mobile-two text-center";
		$class4="ten pull-two mobile-four text-center";
	}
	if($date=="1" && $likes!="1" && $format_icon=="1" && $share=="1") {
		$class1="two mobile-two";
		$class2="";
		$class3="one mobile-two push-nine";
		$class4="nine pull-one mobile-four text-center";
	}
	if($date=="1" && $likes=="1" && $format_icon!="1" && $share=="1") {
		$class1="two mobile-two";
		$class2="one mobile-two push-nine";
		$class3="";
		$class4="nine pull-one mobile-four text-center";
	}
	if($date=="1" && $likes=="1" && $format_icon=="1" && $share!="1") {
		$class1="four mobile-one";
		$class2="four mobile-two text-center";
		$class3="four mobile-one text-right";
		$class4="";
	}
	if($date=="1" && $likes!="1" && $format_icon!="1" && $share!="1") {
		$class1="twelve text-center";
		$class2="";
		$class3="";
		$class4="";
	}
	if($date!="1" && $likes=="1" && $format_icon!="1" && $share!="1") {
		$class1="";
		$class2="twelve text-center";
		$class3="";
		$class4="";
	}
	if($date!="1" && $likes!="1" && $format_icon=="1" && $share!="1") {
		$class1="";
		$class2="";
		$class3="twelve text-center";
		$class4="";
	}
	if($date!="1" && $likes!="1" && $format_icon!="1" && $share=="1") {
		$class1="";
		$class2="";
		$class3="";
		$class4="twelve text-center";
	}
	if($date!="1" && $likes!="1" && $format_icon=="1" && $share=="1") {
		$class1="";
		$class2="";
		$class3="one push-eleven mobile-one text-right";
		$class4="eleven pull-one mobile-three";
	}
	if($date!="1" && $likes=="1" && $format_icon!="1" && $share=="1") {
		$class1="";
		$class2="one push-eleven mobile-one";
		$class3="";
		$class4="eleven pull-one mobile-three";
	}
	if($date=="1" && $likes!="1" && $format_icon!="1" && $share=="1") {
		$class1="two mobile-one";
		$class2="";
		$class3="";
		$class4="ten mobile-three text-right";
	}
	if($date=="1" && $likes=="1" && $format_icon!="1" && $share!="1") {
		$class1="six mobile-two";
		$class2="six mobile-two text-right";
		$class3="";
		$class4="";
	}
	if($date=="1" && $likes!="1" && $format_icon=="1" && $share!="1") {
		$class1="six mobile-two";
		$class2="";
		$class3="six mobile-two text-right";
		$class4="";
	}
	if($date!="1" && $likes=="1" && $format_icon=="1" && $share!="1") {
		$class1="";
		$class2="six mobile-two";
		$class3="six mobile-two text-right";
		$class4="";
	}

	if($category=="1" && $tags=="1") {
		$class5="six";
		$class6="six";
	} elseif($category!="1" && $tags=="1") {
		$class5="";
		$class6="twelve";
	}  elseif($category=="1" && $tags!="1") {
		$class5="twelve";
		$class6="";
	}

?>

<?php if($class1!="" || $class2!="" || $class3!="" || $class4!="") { ?>
	<section class="post_utility clearfix <?php if($data[$prefix."responsive_meta_single"]!="1") {echo "hide-for-small";} ?>">
		<?php if($class1!="") { ?>
			<div class="<?php echo $class1; ?> columns">
				<time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate>
					<span class="day"><?php the_time('j'); ?></span>
					<span class="month"><?php the_time('M'); ?></span>
				</time>
			</div>
		<?php } ?>
		<?php if($class2!="") { ?>
			<div class="<?php echo $class2; ?> columns">
				<?php if( function_exists('zilla_likes') ) zilla_likes(); ?>
			</div>
		<?php } ?>
		<?php if($class3!="") { ?>
			<div class="<?php echo $class3; ?> columns">
				<?php
					switch($format) {
						case "aside";
							$icon = "feather";
							break;
						case "audio";
							$icon = "volume-down";
							break;
						case "gallery";
							$icon = "popup";
							break;
						case "image";
							$icon = "picture";
							break;
						case "link";
							$icon = "link";
							break;
						case "quote";
							$icon = "quote-right";
							break;
						case "status";
							$icon = "user";
							break;
						case "video";
							$icon = "video";
							break;
					}
				?>
				<?php
					if($icon) echo '<em class="icon-'.$icon.'"></em>';
				?>
			</div>
		<?php } ?>
		<?php if($class4!="") { ?>
			<div class="<?php echo $class4; ?> columns">
				<?php if( function_exists('zilla_share') ) zilla_share(); ?>
			</div>
		<?php } ?>
		<div class="clear"></div>
	</section>
<?php } ?>

<section class="post_media clearfix" itemprop="media">
	<?php
		switch($format) {
			case "audio";
				echo get_aud_sc(get_post_meta($post->ID,'format_audio_type',true),get_post_meta($post->ID,'format_audio_link',true));
				break;
			case "video";
				echo get_vid_sc(get_post_meta($post->ID,'format_video_provider',true),get_post_meta($post->ID,'format_video_id',true));
				break;
			default :
				if(get_post_meta($post->ID,'featured_media',true)=="on") {
					switch(get_post_meta($post->ID,'featured_media_type',true)) {
						case "video";
							echo get_vid_sc(get_post_meta($post->ID,'featured_media_video_provider',true),get_post_meta($post->ID,'featured_media_video_id',true));
							break;
						case "image" :
							if (has_post_thumbnail() ) :
								the_post_thumbnail('full');
							endif;
							break;
						case "flexslider" :
							$wp_version = get_bloginfo('version');
							if( version_compare($wp_version, '3.4.2', '>') && get_post_meta($post->ID,'featured_media_slider_custom',true)=="on") {
								$gallery_ids = get_post_meta($post->ID,'featured_slider_image_ids',true);
									echo efs_get_slider(get_the_ID(),'true','true','false','false',array('smoothHeight'=>'false'),'true',$gallery_ids);
							} else {
								if (has_post_thumbnail() ) :
									echo efs_get_slider(get_the_ID(),'true','true','false','false',array('smoothHeight'=>'false'),'','');
								endif;
							}
							break;
						case "revslider" :
							$rev_slider = get_post_meta($post->ID,'featured_media_revslider_id',true);
							if($rev_slider != "") {
								if(function_exists('putRevSlider')) {
									putRevSlider($rev_slider);
								}
							}
							break;
					}
				}
				break;
		}
	?>
</section>

<?php if(!empty( $post->post_content) ) { ?>
	<section class="post_content format-<?php echo $format; ?> clearfix" itemprop="articleBody">
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	</section>
<?php } ?>

<?php if($class5!="" || $class6!="") { ?>
	<footer class="post_meta clearfix <?php if($data[$prefix."responsive_meta_single"]!="1") {echo "hide-for-small";} ?>">
		<?php if($class5!="") { ?>
			<div class="<?php echo $class5; ?> columns">
				<p>
					<em class="icon-archive"></em>
					<?php _e("Category : ", "prostore-theme"); ?> <?php the_category(', '); ?>
				</p>
			</div>
		<?php } ?>
		<?php if($class6!="") { ?>
			<div class="<?php echo $class6; ?> columns clearfix">
				<?php the_tags('<p class="tags"><em class="icon-tag"></em> <span class="tags-title">Tags :</span> ', ' ', '</p>'); ?>
			</div>
		<?php } ?>
	</footer>
<?php } ?>

<?php if(comments_open() || have_comments()) { ?>
	<section class="post_comments clearfix <?php if($data[$prefix."responsive_comments_single"]!="1") {echo "hide-for-small";} ?>">
		<?php comments_template(); ?>
		<div class="clear"></div>
	</section>
<?php } ?>