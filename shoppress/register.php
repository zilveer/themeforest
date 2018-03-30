<?php
/*
Template Name: Register
*/
get_header(); global $post, $gp_settings, $user_ID, $user_identity, $user_level; ?>
	
	
<!-- BEGIN CONTENT -->		

<div id="content" <?php post_class(); ?>>


	<!-- BEGIN BREADCRUMBS -->

	<?php if($gp_settings['breadcrumbs'] == "Show") { ?><div id="breadcrumb"><?php echo gp_breadcrumbs(); ?></div><?php } ?>
	
	<!-- END BREADCRUMBS -->
		
		
	<!-- BEGIN TITLE -->

	<?php if($gp_settings['title'] == "Show") { ?><h1 class="page-title"><?php the_title(); ?></h1><?php } ?>
	
	<!-- END TITLE -->
	

	<!-- BEGIN POST META -->
	
	<?php if($gp_settings['meta_date'] == "0" OR $gp_settings['meta_author'] == "0" OR $gp_settings['meta_cats'] == "0" OR $gp_settings['meta_comments'] == "0") { ?>
	
		<div class="post-meta">
			
			<?php if($gp_settings['meta_author'] == "0") { ?><span class="author-icon"><?php the_author_posts_link(); ?></span><?php } ?>
			
			<?php if($gp_settings['meta_date'] == "0") { ?><span class="clock-icon"><?php the_time(get_option('date_format')); ?></span><?php } ?>
			
			<?php if($gp_settings['meta_cats'] == "0" && $post->post_type == "post") { ?><span class="folder-icon"><?php the_category(', '); ?></span><?php } ?>
			
			<?php if($gp_settings['meta_comments'] == "0" && 'open' == $post->comment_status) { ?><span class="speech-icon"><?php comments_popup_link(__('0', 'gp_lang'), __('1', 'gp_lang'), __('%', 'gp_lang'), 'comments-link', ''); ?></span><?php } ?>
			
		</div>
		
	<?php } ?>
	
	<!-- BEGIN POST META -->
				
						
	<!-- BEGIN IMAGE -->
									
	<?php if(has_post_thumbnail() && $gp_settings['show_image'] == "Show") { ?>
		<div class="post-thumbnail<?php if($gp_settings['image_wrap'] == "Enable") { ?> wrap<?php } ?>">
			<?php $image = aq_resize(wp_get_attachment_url(get_post_thumbnail_id(get_the_id())),  $gp_settings['image_width'], $gp_settings['image_height'], $gp_settings['hard_crop'], false, true); ?>
			<?php if(get_option($dirname.'_retina') == "0") { $retina = aq_resize(wp_get_attachment_url(get_post_thumbnail_id(get_the_id())),  $gp_settings['image_width']*2, $gp_settings['image_height']*2, $gp_settings['hard_crop'], true, true); } else { $retina = ""; } ?>
			<img src="<?php echo $image[0]; ?>" data-rel="<?php echo $retina; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php if(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) { echo get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true); } else { the_title_attribute(); } ?>" class="wp-post-image" />
		</div>
		<?php if($gp_settings['image_wrap'] == "Disable") { ?><div class="clear"></div><?php } ?>
	<?php } ?>
	
	<!-- END IMAGE -->
			
			
	<!-- BEGIN POST CONTENT -->
			
	<div id="post-content">
	
		<?php the_content(); ?>
		
	</div>
	
	<!-- END POST CONTENT -->


	<?php if($user_ID) { ?>
	
	
		<h2><?php _e('You are already registered.', 'gp_lang'); ?></h2>
	
	
	<?php } else { ?>
		
		
		<!-- BEGIN REGISTRATION FORM -->
		
		<form action="<?php echo site_url('wp-login.php?action=register', 'login_post'); ?>" method="post">
		
			<p><label for="log"><?php _e('Username', 'gp_lang'); ?> <span class="required">*</span></label>
			<br/><input type="text" name="user_login" id="user_login" class="input" value="<?php echo esc_attr(stripslashes($user_login)); ?>" size="22" /></p>
			
			<p><label for="pwd"><?php _e('Email', 'gp_lang'); ?> <span class="required">*</span></label><br/>
			<input type="text" name="user_email" id="user_email" class="input" value="<?php echo esc_attr(stripslashes($user_email)); ?>" size="22" /></p>
			
			<?php do_action('register_form'); ?>
			<p><?php _e('Your password will be emailed to you.', 'gp_lang'); ?></p>
			<p><input type="submit" name="wp-submit" id="wp-submit" value="<?php _e('Register', 'gp_lang'); ?>" tabindex="100" /></p>
			
		</form>
		
		<!-- END REGISTRATION FORM -->
		
	
	<?php } ?>
	

</div>

<!-- END CONTENT -->


<?php get_sidebar(); ?>


<?php get_footer(); ?>