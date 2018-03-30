<?php 
require_once('form-inputs.php');
wp_nonce_field( 'theme-post-meta-form', THEME_NAME_SEO . '_post_nonce' );
?>

<div id="px-container" class="post-meta">
  <div class="portfolio_form">
    <div id="px-main">

	<div id="intro_section" class="section">
		<div class="section-head">
		  <div class="section-tooltip">
			<div class="portfolio_post_standard">
				<?php _e('You can enter a VIDEO ( youtube , vimeo ) , IMAGE or WEBSITE url.', TEXTDOMAIN); ?>
			</div>
			<div class="portfolio_post_audio">
				<?php _e('Enter a .mp3  URL here.', TEXTDOMAIN); ?>
			</div>
		  </div>
		  <div class="label">

			<div class="portfolio_post_standard">
				<?php _e('Content URL', TEXTDOMAIN); ?>
			</div>
			<div class="portfolio_post_audio">
				<?php _e('Audio URL', TEXTDOMAIN); ?>
			</div>

		  </div>
		</div>
			<?php TextInput('content_url', __('http://', TEXTDOMAIN)); ?>
			
	</div>

	<!-- Config section -->
	<div id="type_section" class="section">
		<div class="portfolio_post_image">
			<div class="slideshow-input">
				<div class="section-head">
					<div class="section-tooltip"><?php _e('Upload images to be shown in portfolio post detail popup, you can clear the fields to delete images', TEXTDOMAIN); ?></div>
					<div class="label"><?php _e('Post Images', TEXTDOMAIN); ?></div>
				</div>
				
				<?php ImageInput('portfolio_image_1', 'Image 1', 'field-spacer'); ?>
				
				<?php ImageInput('portfolio_image_2', 'Image 2', 'field-spacer'); ?>
				
				<?php ImageInput('portfolio_image_3', 'Image 3', 'field-spacer'); ?>
				
				<?php ImageInput('portfolio_image_4', 'Image 4', 'field-spacer'); ?>
				
				<?php ImageInput('portfolio_image_5', 'Image 5', 'field-spacer'); ?>
				
				<?php ImageInput('portfolio_image_6', 'Image 6', 'field-spacer'); ?>
				
				<?php ImageInput('portfolio_image_7', 'Image 7', 'field-spacer'); ?>
				
				<?php ImageInput('portfolio_image_8', 'Image 8', 'field-spacer'); ?>
				
				<?php ImageInput('portfolio_image_9', 'Image 9', 'field-spacer'); ?>
				
				<?php ImageInput('portfolio_image_10', 'Image 10'); ?>
				
			</div>
		</div>
		
		<div class="portfolio_post_video">
			<div class="slideshow-input">
				<div class="section-head">
					<div class="section-tooltip"><?php _e('Enter youtube and vimeo ID here.', TEXTDOMAIN); ?></div>
					<div class="label"><?php _e('Video ID', TEXTDOMAIN); ?></div>
				</div>

				<div class="video-input">
					<?php SelectTag('video_server', 
						  array( '1' => 'YouTube', '2' => 'Vimeo' ), 'field-spacer' ); ?>
					
					<?php TextInput('video_id', 'Video ID', 'field-spacer'); ?>
				</div>
			
			</div>
		</div>
	
	</div>
		
    </div>
  </div>
</div>
