<li class="qodef-blog-list-item clearfix">
	<div class="qodef-blog-list-item-inner">
		<div class="qodef-item-image">
			<a href="<?php echo esc_url(get_permalink()) ?>">
				<?php
					 echo get_the_post_thumbnail(get_the_ID(), $thumb_image_size);
				?>				
			</a>
		</div>
		<div class="qodef-item-text-holder">
			<<?php echo esc_html( $title_tag)?> class="qodef-item-title">
				<a href="<?php echo esc_url(get_the_permalink()) ?>" >
					<?php echo esc_attr(get_the_title()) ?>
				</a>
			</<?php echo esc_html($title_tag) ?>>
			
			<div class="qodef-item-info-section">
				<?php suprema_qodef_post_info(array(
					'date' => 'yes',
					'category' => 'no',
					'author' => 'no',
					'comments' => 'no',
					'like' => 'no'
				)) ?>
			</div>
			
			<?php if ($text_length != '0') {
				$excerpt = ($text_length > 0) ? substr(get_the_excerpt(), 0, intval($text_length)) : get_the_excerpt(); ?>
				<p class="qodef-excerpt"><?php echo esc_html($excerpt)?>...</p>
			<?php } ?>

			<?php

				echo suprema_qodef_get_button_html(array(
					'link' => get_the_permalink(),
					'text' => esc_html__('Continue reading', 'suprema'),
					'type' => 'outline',
					'icon_pack' => 'linear_icons',
					'linear_icon' => 'lnr-chevron-right'
				));
			?>

		</div>
	</div>	
</li>