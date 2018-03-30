<?php
/*
* Template name: Contact
*/
get_header();
?>
<div class="contact">
	<article class="main single contact">
		<?php if (have_posts()) : while (have_posts()) : 
			the_post(); 
			$hide_title = get_post_meta(get_the_id(), 'hide_title', true);
		?>

			<?php if(!$hide_title) : ?>
				<h1><?php the_title(); ?></h1>
			<?php endif; ?>
			<?php 
			$iframe_video = get_post_meta(get_the_id(), 'single_meta_video_iframe', true);
			if($iframe_video):
				echo '<p>'.$iframe_video.'</p>'; 
			else :
				if(has_post_thumbnail()) {
					$sidebar_position = get_post_meta($thisPageId, 'sidebar_position', true);
					if ($sidebar_position == 2) {
						the_post_thumbnail('thumbnail-high-extra-large');
					} else {
						the_post_thumbnail('thumbnail-high-large');
					}
				}
			endif; ?>
			<?php the_content(); ?>
			<?php wp_link_pages(array('before' => '<p class="pages"><strong>'.esc_attr__('Pages', 'multipurpose').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

			<form action="<?php the_permalink() ?>" method="post" class="contact-form">
				<?php 
				if($_POST) {
					$response = send_mail($_POST['sender_name'], $_POST['subject'], $_POST['email'], $_POST['message']); 
					if($response['msgStatus'] == "ok") {
						$_POST['sender_name'] = '';
						$_POST['subject'] = '';
						$_POST['email'] = '';
						$_POST['message'] = '';
					}
				} else {
					$_POST['sender_name'] = '';
					$_POST['subject'] = '';
					$_POST['email'] = '';
					$_POST['message'] = '';
					$response['errorFields'] = array();
				}
				?>
				<p class="half">
					<label for="sender_name"><?php esc_attr_e('Name','multipurpose');?></label><input name="sender_name" id="sender_name" value="<?php echo esc_attr($_POST['sender_name']); ?>" <?php if(in_array('sender_name', $response['errorFields'])) echo 'class="error"' ?>>
				</p>
				<p class="half">
					<label for="email"><?php esc_attr_e('E-mail','multipurpose');?></label><input name="email" id="email" value="<?php echo esc_attr($_POST['email']); ?>" <?php if(in_array('email', $response['errorFields'])) echo 'class="error"' ?>>
				</p>
				<p>
					<label for="topic"><?php esc_attr_e('Topic','multipurpose');?></label><select name="subject" id="subject" <?php if(in_array('subject', $response['errorFields'])) echo 'class="error"' ?>>
						<option value="0"><?php esc_attr_e('Choose','multipurpose');?></option>
						<?php
						$subjects = get_option('contact_subjects');
						$subjects = explode("\n", $subjects);
						foreach($subjects as $s) : ?>
						<option value="<?php echo esc_attr($s) ?>"<?php if(trim($_POST['subject']) == trim($s)) echo ' selected="selected"'; ?>><?php echo $s ?></option>
						<?php endforeach; ?>
					</select>
				</p>
				<p>
					<label for="message"><?php esc_attr_e('Message','multipurpose');?></label><textarea name="message" id="message" rows="5" cols="20" <?php if(in_array('message', $response['errorFields'])) echo 'class="error"' ?>><?php echo esc_attr($_POST['message']); ?></textarea>
				</p>
				<p><button name="send" type="submit" value="1"><?php esc_attr_e('Send message','multipurpose');?></button></p>
			</form>

		<?php endwhile; endif; ?>
	</article>
	<aside class="sidebar">
		<?php if (function_exists('dynamic_sidebar')) { dynamic_sidebar('contact-sidebar'); } ?>
	</aside>
</div>
<?php get_footer(); ?>