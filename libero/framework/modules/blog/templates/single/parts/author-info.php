<?php
	$author_info_box = esc_attr(libero_mikado_options()->getOptionValue('blog_author_info'));
	$author_info_email = esc_attr(libero_mikado_options()->getOptionValue('blog_author_info_email'));

?>
<?php if($author_info_box === 'yes') { ?>
	<div class="mkd-author-description">
		<div class="mkd-author-description-inner">
			<div class="mkd-author-description-image">
				<?php echo libero_mikado_kses_img(get_avatar(get_the_author_meta( 'ID' ), 102)); ?>
			</div>
			<div class="mkd-author-description-text-holder">
				<h5 class="mkd-author-name">
					<?php
						if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
							echo esc_attr(get_the_author_meta('first_name')) . " " . esc_attr(get_the_author_meta('last_name'));
						} else {
							echo esc_attr(get_the_author_meta('display_name'));
						}
					?>
				</h5>
				<?php if($author_info_email === 'yes' && is_email(get_the_author_meta('email'))){ ?>
					<p class="mkd-author-email"><?php echo sanitize_email(get_the_author_meta('email')); ?></p>
				<?php } ?>
				<?php if(get_the_author_meta('description') != "") { ?>
					<div class="mkd-author-text">
						<p><?php echo esc_attr(get_the_author_meta('description')); ?></p>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>