<?php
	$author_info_box = esc_attr(qode_startit_options()->getOptionValue('blog_author_info'));
	$author_info_email = esc_attr(qode_startit_options()->getOptionValue('blog_author_info_email'));

	$author_email = '';
	if(is_email(get_the_author_meta('email')) && get_the_author_meta('email') != '') {
		$author_email = get_the_author_meta('email');
	}

	$author_facebook_page = $author_twitter_page = $author_instagram_page = $author_dribbble_page  = $author_linkedin_page = '';
	if(get_the_author_meta('facebook') != ''){
		$author_facebook_page = get_the_author_meta('facebook');
	}
	if(get_the_author_meta('twitter') != ''){
		$author_twitter_page = get_the_author_meta('twitter');
	}
	if(get_the_author_meta('instagram') != ''){
		$author_instagram_page = get_the_author_meta('instagram');
	}
	if(get_the_author_meta('dribbble') != ''){
		$author_dribbble_page = get_the_author_meta('dribbble');
	}
	if(get_the_author_meta('linkedin') != ''){
		$author_linkedin_page = get_the_author_meta('linkedin');
	}
?>
<?php if($author_info_box === 'yes') { ?>
	<div class="qodef-author-description">
		<div class="qodef-author-description-inner">
			<div class="qodef-author-description-image">
				<?php echo get_avatar($author_email, 128); ?>
			</div>
			<div class="qodef-author-description-text-holder">
				<h5 class="qodef-author-name">
					<?php
						if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
							echo esc_attr(get_the_author_meta('first_name')) . " " . esc_attr(get_the_author_meta('last_name'));
						} else {
							echo esc_attr(get_the_author_meta('display_name'));
						}
					?>
				</h5>
				<?php if($author_info_email === 'yes' && is_email(get_the_author_meta('email'))){ ?>
					<p class="qodef-author-email"><?php echo sanitize_email(get_the_author_meta('email')); ?></p>
				<?php } ?>
				<?php if(get_the_author_meta('description') != "") { ?>
					<div class="qodef-author-text">
						<p><?php echo esc_attr(get_the_author_meta('description')); ?></p>
					</div>
				<?php } ?>
				<?php if($author_facebook_page != '' || $author_twitter_page !='' || $author_instagram_page !='' || $author_dribbble_page != '' || $author_linkedin_page !=''){ ?>
					<div class ="qodef-author-social-holder clearfix">
						<?php if($author_facebook_page != '') { ?>
							<div class="qodef-author-social-inner">
								<a href="<?php echo esc_attr($author_facebook_page)?>" target="blank">
									<span class="social_facebook"></span>
								</a>
							</div>
						<?php } ?>
						<?php if($author_twitter_page != '') { ?>
							<div class="qodef-author-social-inner">
								<a href="<?php echo esc_attr($author_twitter_page)?>" target="blank">
									<span class="social_twitter"></span>
								</a>
							</div>
						<?php } ?>
						<?php if($author_instagram_page != '') { ?>
							<div class="qodef-author-social-inner">
								<a href="<?php echo esc_attr($author_instagram_page)?>" target="blank">
									<span class="social_instagram"></span>
								</a>
							</div>
						<?php } ?>
						<?php if($author_dribbble_page != '') { ?>
							<div class="qodef-author-social-inner">
								<a href="<?php echo esc_attr($author_dribbble_page)?>" target="blank">
									<span class="social_dribbble"></span>
								</a>
							</div>
						<?php } ?>
						<?php if($author_linkedin_page != '') { ?>
							<div class="qodef-author-social-inner">
								<a href="<?php echo esc_attr($author_linkedin_page)?>" target="blank">
									<span class="social_linkedin"></span>
								</a>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>