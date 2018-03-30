<?php
/* ------------------------------------------------------------------------------------------------------------

	Template Name: Contact Us

------------------------------------------------------------------------------------------------------------ */
?>
<?php get_header(); ?>
<?php
	the_post();
	$content = get_the_content();
?>
<?php
	if (_sg('Contact')->showMap() == 'top') {
		_sg('Contact')->eMap();
		if (!empty($content) OR _sg('Contact')->showForm()) echo '<hr class="bottom-2_4em">';
	}
?>
<?php if (_sg('Contact')->showForm()) { ?>
	<?php if (_sg('Contact')->getFormPosition() == 'right') { ?>
		<div class="one_half">
			<?php
				if (!empty($content)) {
					wp_reset_query(); the_content();
				} else {
					echo '&nbsp;';
				}
			?>
		</div>
	<?php } ?>
	<div class="one_half<?php if (_sg('Contact')->getFormPosition() == 'right') echo ' omega'; ?>">
		<h4><?php _sg('Contact')->eFormTitle(); ?></h4>
		<form id="ef-contact" class="ef-form" method="post" action="<?php echo get_template_directory_uri(); ?>/includes/contact-send.php">
			<input type="hidden" name="sg_post_id" value="<?php the_ID(); ?>" />
			<div>
				<label><?php _e('Name', SG_TDN); ?>*</label>
				<div><input id="name" type="text" aria-required="true" name="sg_ct_name" value="" /></div>
			</div>
			<div>
				<label><?php _e('E-mail', SG_TDN); ?>*</label>
				<div><input id="email" type="text" aria-required="true" name="sg_ct_email" value="" /></div>
			</div>
			<div>
				<label><?php _e('Website', SG_TDN); ?></label>
				<div><input id="website" type="text" name="sg_ct_website" value="" /></div>
			</div>
			<div class="ef-textarea">
				<label><?php _e('Message', SG_TDN); ?></label>
				<div><textarea id="message" name="sg_ct_message" cols="" rows=""></textarea></div>
			</div>
			<div class="send-wrap">
				<div class="alignleft">
					<input class="send" name="submit" type="submit" value="<?php _e('Send', SG_TDN); ?>" />
				</div>
				<span class="alignright"><?php _e('* required', SG_TDN); ?></span>
			</div>
		</form>
		<div class="ef-list"></div>
	</div>
	<?php if (_sg('Contact')->getFormPosition() == 'left') { ?>
		<div class="one_half omega">
			<?php
				if (!empty($content)) {
					wp_reset_query(); the_content();
				} else {
					echo '&nbsp;';
				}
			?>
		</div>
	<?php } ?>
<?php } else { ?>
	<?php
		if (!empty($content)) {
			wp_reset_query(); the_content();
		}
	?>
<?php } ?>
<?php
	if (_sg('Contact')->showMap() == 'bottom') {
		if (!empty($content) OR _sg('Contact')->showForm()) echo '<hr class="bottom-2_4em">';
		_sg('Contact')->eMap();
	}
?>
<?php get_footer(); ?>