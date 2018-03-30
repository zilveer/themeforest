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
 * @package 	proStore/library/loop/single-portfolio.php
 * @file	 	1.2
 */
?>
<?php
	global $data, $prefix;
?>

<?php
	$date = "0"; $share = "0"; $likes = "0";
	$class1=""; $class2=""; $class3="";

	$date = $data[$prefix."meta_portf_date_s"];

	$likes = $data[$prefix."meta_portf_likes_s"];
	if(!function_exists('zilla_likes')) $likes = "0";

	$share = $data[$prefix."meta_portf_share_s"];
	if(!function_exists('zilla_share')) $share = "0";

	if($date=="1" && $likes=="1" && $share=="1") {
		$class1="two mobile-two";
		$class2="two mobile-two push-eight text-center";
		$class3="eight mobile-four pull-two";
	}
	if($date=="1" && $likes!="1" && $share!="1") {
		$class1="twelve text-center";
		$class2="";
		$class3="";
	}
	if($date!="1" && $likes=="1" && $share!="1") {
		$class1="";
		$class2="twelve text-center";
		$class3="";
	}
	if($date!="1" && $likes!="1" && $share=="1") {
		$class1="";
		$class2="";
		$class3="twelve text-center";
	}
	if($date=="1" && $likes=="1" && $share!="1") {
		$class1="six mobile-two";
		$class2="six mobile-two text-right";
		$class3="";
	}
	if($date=="1" && $likes!="1" && $share=="1") {
		$class1="two mobile-one";
		$class2="";
		$class3="ten mobile-three text-right";
	}
	if($date!="1" && $likes=="1" && $share=="1") {
		$class1="";
		$class2="two mobile-one text-left";
		$class3="ten mobile-three text-right";
	}
?>


<header>
	<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
	<?php if(has_term('','field') && $data[$prefix."meta_portf_field_s"]=="1") { ?>
	<h4 class="subheader clearfix">
		<?php echo get_the_term_list( get_the_ID(), 'field', '',', ',''); ?>
	</h4>
	<?php } ?>
</header>

<?php if($class1!="" || $class2!="" || $class3!="") { ?>
	<section class="post_utility clearfix">
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
				<?php if( function_exists('zilla_share') ) zilla_share(); ?>
			</div>
		<?php } ?>
	</section>
<?php } ?>

<section class="post_media clearfix" itemprop="media">
	<?php
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
	?>
</section>

<?php if(!empty( $post->post_content) ) { ?>
	<section class="post_content format-<?php echo $format; ?> clearfix" itemprop="articleBody">
		<?php the_content(); ?>
	</section>
<?php } ?>