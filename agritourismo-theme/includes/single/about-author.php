<?php
		
	// about authors
	$aboutAuthor = get_option(THEME_NAME."_about_author");
	$aboutAuthorSingle = get_post_meta( $post->ID, THEME_NAME."_about_author", true ); 

	// author id
	$user_ID = get_the_author_meta('ID');

	//social
	$flickr = get_user_meta($user_ID, 'flickr', true);
	$vimeo = get_user_meta($user_ID, 'vimeo', true);
	$twitter = get_user_meta($user_ID, 'twitter', true);
	$facebook = get_user_meta($user_ID, 'facebook', true);
	$google = get_user_meta($user_ID, 'googlepluss', true);
	$pinterest = get_user_meta($user_ID, 'pinterest', true);
	$linkedin = get_user_meta($user_ID, 'linkedin', true);
?>

<?php if($aboutAuthor == "show" || ($aboutAuthor=="custom" && $aboutAuthorSingle=="show")) {  ?>

	<div class="main-title">
		<h2><?php _e("About Author", THEME_NAME);?></h2>
		<span><?php _e("Who wrote this article", THEME_NAME);?></span>
	</div>

	<div class="about-author-block">
		<div class="about-author-photo">
			<a href="<?php $user_info = get_userdata($user_ID); echo get_author_posts_url($user_ID, $user_info->user_login ); ?>" class="photo-border-1">
				<img src="<?php echo get_gravatar(get_the_author_meta('user_email'), '100', THEME_IMAGE_URL.'_avatar-100x100.jpg', 'G', false, $atts = array() );?>" alt="<?php echo get_the_author_meta('display_name'); ?>" />
			</a>
		</div>
		<div class="about-author-content">
			<div class="soc-links right">
				<?php if($flickr) { ?><a href="<?php echo $flickr;?>" target="_blank" class="icon-text">&#62212;</a><?php } ?>
				<?php if($vimeo) { ?><a href="<?php echo $vimeo;?>" target="_blank" class="icon-text">&#62215;</a><?php } ?>
				<?php if($twitter) { ?><a href="<?php echo $twitter;?>" target="_blank" class="icon-text">&#62218;</a><?php } ?>
				<?php if($facebook) { ?><a href="<?php echo $facebook;?>" target="_blank" class="icon-text">&#62221;</a><?php } ?>
				<?php if($google) { ?><a href="<?php echo $google;?>" target="_blank" class="icon-text">&#62224;</a><?php } ?>
				<?php if($pinterest) { ?><a href="<?php echo $pinterest;?>" target="_blank" class="icon-text">&#62227;</a><?php } ?>
				<?php if($linkedin) { ?><a href="<?php echo $linkedin;?>" target="_blank" class="icon-text">&#62233;</a><?php } ?>
			</div>
			<h3><?php echo get_the_author_meta('display_name'); ?></h3>
			<p><?php echo get_the_author_meta('description'); ?></p>
			<a href="<?php $user_info = get_userdata($user_ID); echo get_author_posts_url($user_ID, $user_info->user_login ); ?>" class="button-link"><?php _e("View More Articles", THEME_NAME);?><span class="icon-text">&#9656;</span></a>
		</div>
		<div class="clear-float"></div>
	</div>
<?php } ?>