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
 * @package 	proStore/library/loop/content-regular.php
 * @file	 	1.0
 */
?>
<?php global $format, $data, $prefix; ?>
<?php
	$icon = "";
	$class1 = "";
	$class2 = "";
	$class3 = "";
	switch($format) {
		case "standart" :
			?><a href="<?php the_permalink() ?>" class="media" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'full' ); ?></a><?php
			break;
		case "image" :
			?><a href="<?php the_permalink() ?>" class="media" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'full' ); ?></a><?php
			$icon = "camera";
			break;
		case "status" :
			$icon = "user";
			break;
		case "quote" :
			$icon = "quote-right";
			break;
		case "audio" :
			echo get_aud_sc(get_post_meta($post->ID,'format_audio_type',true),get_post_meta($post->ID,'format_audio_link',true));
			$icon = "volume-down";
			break;
		case "aside" :
			break;
		case "gallery" :
			if (has_post_thumbnail() ) :
				echo efs_get_slider(get_the_ID(),'true','false','false','false',array('smoothHeight'=>'false'),'','');
			endif;
			$icon = "popup";
			break;
		case "link" :
			$icon = "link";
			break;
		case "video" :
			echo get_vid_sc(get_post_meta($post->ID,'format_video_provider',true),get_post_meta($post->ID,'format_video_id',true));
			$icon = "video";
			break;
	}
	$date = "0"; $format_icon = "0";
	$date = $data[$prefix."meta_date"];
	$format_icon = $data[$prefix."meta_format"];/*


	if($date !="1") {
		$class1="twelve"; $class2="";
	} elseif ($date !="1") {
		$class1="twelve";
	} elseif ($date =="1") {
		$class1="ten mobile-three push-two"; $class2="two mobile-one pull-ten";
	} else {
		$class1="ten mobile-four push-two"; $class2="two mobile-two pull-ten";
	}
*/
	if($format !="standart") {
		if($date !="1" && $format_icon !="1") {
			$class1="twelve"; $class2=""; $class3="";
		} elseif ($date !="1" && $format_icon=="1") {
			$class1="ten mobile-three"; $class2=""; $class3="two mobile-one";
		} elseif ($date =="1" && $format_icon!="1") {
			$class1="ten mobile-three push-two"; $class2="two mobile-one pull-ten"; $class3="";
		} else {
			$class1="eight mobile-four push-two"; $class2="two mobile-two pull-eight"; $class3="two mobile-two";
		}
	} else {
		if($date !="1") {
			$class1="twelve"; $class2="";
		} else {
			$class1="ten mobile-three push-two"; $class2="two mobile-one pull-ten"; $class3="";
		}
	}
?>

<?php if( !has_embed() ) { ?>

	<?php if($format != "aside" && $format != "status" && $format != "quote" && $format != "link") { ?>
		<header class="clearfix">
			<div class="<?php echo $class1; ?> columns clearfix">
				<?php if($format == "status" || $format == "quote" || $format == "link") { ?>
					<?php the_content(); ?>
				<?php } else { ?>
					<h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<?php } ?>
			</div>
			<?php if($class2!="") { ?>
				<div class="<?php echo $class2; ?> columns text-center">
					<time datetime="<?php echo the_time('Y-m-j'); ?>" pubdate>
						<span class="day"><?php the_time('j'); ?></span>
						<span class="month"><?php the_time('M'); ?></span>
					</time>
				</div>
			<?php } ?>
			<?php if($class3!="") { ?>
				<div class="<?php echo $class3; ?> columns text-center tp">
					<?php
						if($icon) echo '<em class="icon-'.$icon.'"></em>';
					?>
				</div>
			<?php } ?>
			<?php
				//if($icon) echo '<div class="icon-wrap"></div><em class="icon icon-'.$icon.'"></em>';
			?>
			<div class="clear"></div>
		</header>
	<?php } elseif($format == "status" || $format == "quote" || $format == "link") {?>
		<header class="clearfix">
			<div class="twelve columns clearfix">
				<?php the_content(); ?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</header>
	<?php } ?>

	<?php if(!empty( $post->post_content) && ($format != "status" && $format != "quote" && $format != "link") ) { ?>
		<section class="post_content clearfix">
			<div class="twelve columns clearfix">
				<?php if($data[$prefix."default_content_excerpt"]=="full") { the_content(); } else { the_excerpt(); } ?>
				<div class="clear"></div>
			</div>
			<div class="clear"></div>
		</section>
	<?php } ?>

	<?php if($format != "aside" && $format != "status" && $format != "quote" && $format != "link") { ?>
		<div class="post_meta clearfix <?php if($data[$prefix."responsive_meta"]!="1") {echo "hide-for-small";} ?>">
			<?php get_template_part('library/loop/post','footer'); ?>						</div>
	<?php } ?>

<?php } else { ?>

	<?php the_content(); ?>

<?php } ?>