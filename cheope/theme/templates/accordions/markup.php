<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */

?>
<?php if( ! yit_is_accordion_empty() ): ?>
	<div class="accordion-container">
	<?php while( yit_have_accordion_item() ): ?>
		<div class="accordion-wrapper row">
			<div class="accordion-title span9">
				<div class="plus">+</div>
				<h4><?php yit_accordion_item_the('title'); ?></h4>
			</div>
			<div class="accordion-item span9">
				<div class="row">
					<div class="span3">
						<div class="accordion-item-thumb">
							<?php list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = wp_get_attachment_image_src( yit_accordion_item_get('item_id'), 'accordion_thumb' ); ?>
							<img src="<?php echo $thumbnail_url ?>" alt="<?php yit_accordion_item_the('title'); ?>" />
						</div>
					</div><!-- end span3 -->
					<div class="span6">
						<div class="accordion-item-content">
							<?php echo yit_content(yit_accordion_item_get('content'), 1000); ?>
							<?php if (yit_accordion_item_get('subtitle') != '' || yit_accordion_item_get('website') != '' || yit_accordion_item_get('social') != '' ) : ?>
								<div class="meta">
									<?php if (yit_accordion_item_get('subtitle') != '') : ?><p><img class="icon" src="<?php echo YIT_THEME_ASSETS_URL ."/images/icons/role.png" ?>" alt="role_icon" /><?php _e('Role', 'yit') ?>: <?php yit_accordion_item_the('subtitle'); ?></p><?php endif ?>
									<?php if (yit_accordion_item_get('website') != '') : ?><p><img class="icon" src="<?php echo YIT_THEME_ASSETS_URL ."/images/icons/website.png" ?>" alt="website_icon" /><?php _e('Website', 'yit') ?>: <a href="<?php yit_accordion_item_the('website'); ?>"><?php yit_accordion_item_the('website'); ?></a></p><?php endif ?>
									<?php if (yit_accordion_item_get('social') != '') : ?>
										<div>
											<div class="social_title">
												<p><img class="icon" src="<?php echo YIT_THEME_ASSETS_URL ."/images/icons/social-meta.png" ?>" alt="social_icon" /><?php _e('Get in touch', 'yit') ?>:</p>
											</div>
											<?php echo yit_content(yit_accordion_item_get('social')); ?>
										</div>
									<?php endif ?>
								</div>
							<?php endif ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile ?>
	</div>

	<script>
	jQuery(document).ready(function($){
		$('.accordion-title').click(function(){
			if( !$(this).hasClass('active') ) {
				$('.accordion-title').removeClass('active').find(':first-child').addClass('plus').text("+").removeClass('minus');
				$('.accordion-item').slideUp();

				$(this).toggleClass('active')
					   .find(':first-child').removeClass('plus').addClass('minus').text("-").parent().next().slideToggle();
			}
		}).filter(':first').click();
	});
	</script>
<?php endif ?>