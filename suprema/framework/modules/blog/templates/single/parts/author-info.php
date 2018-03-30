<?php
	$author_info_box = esc_attr(suprema_qodef_options()->getOptionValue('blog_author_info'));
	$author_info_email = esc_attr(suprema_qodef_options()->getOptionValue('blog_author_info_email'));

?>
<?php if($author_info_box === 'yes') { ?>
	<div class="qodef-author-description">
		<div class="qodef-author-description-inner">
			<div class="qodef-author-description-image">
				<?php echo suprema_qodef_kses_img(get_avatar(get_the_author_meta( 'ID' ), 102)); ?>
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
			</div>
		</div>
	</div>
<?php } ?>