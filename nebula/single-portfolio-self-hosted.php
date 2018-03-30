<?php
/**
 * The main template file for display fullscreen self-hosted video
 *
 * @package WordPress
 */

wp_enqueue_script("jwplayer", get_template_directory_uri()."/js/jwplayer.js", false, THEMEVERSION, true);
wp_enqueue_script("self-hosted-video", get_template_directory_uri()."/templates/script-self-hosted-video.php?portfolio_id=".$post->ID, false, THEMEVERSION, true);

//important to apply dynamic header & footer style
global $pp_homepage_style;
$pp_homepage_style = 'fullscreen_video';

get_header();

//Check if display galery info
$pp_gallery_auto_info = get_option('pp_gallery_auto_info');
?>

<div id="imageFlow_gallery_info" class="fadeIn" <?php if(empty($pp_gallery_auto_info)) { ?>style="left:-370px"<?php } ?>>
	<div class="imageFlow_gallery_info_wrapper">
		<h1><?php the_title(); ?></h1><br/><hr/>
		<?php
			$portoflio_post_content = get_post_field('post_content', $post->ID);
    		
    		if(!empty($portoflio_post_content))
    		{
    	?>
			<br/><div class="page_caption_desc"><?php echo $portoflio_post_content; ?></div>
		<?php
			}
		?>
		<br/>
		<div class="imageFlow_gallery_info_author">
			<?php _e( 'Posted On', THEMEDOMAIN ); ?> <?php echo get_the_time(THEMEDATEFORMAT); ?>
		</div>
		<a id="flow_view_button" class="button" href="#"><?php _e( 'View Video', THEMEDOMAIN ); ?></a>
		
		<?php
			//Get Social Share
			get_template_part("/templates/template-share");
		?>
	</div>
</div>
<a id="flow_info_button" <?php if(empty($pp_gallery_auto_info)) { ?>style="display:block;"<?php } ?> href="#"><i class="fa fa-info-circle"></i></a>

<div id="youtube_bg">
	<div id="fullscreen_self_hosted_vid"></div>
</div>

<?php
	get_footer();
?>