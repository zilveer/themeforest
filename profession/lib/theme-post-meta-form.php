<?php 
require_once('form-inputs.php');
wp_nonce_field( 'theme-post-meta-form', THEME_NAME_SEO . '_post_nonce' );
?>

<div id="px-container" class="post-meta">
	<div id="px-main">

		<!-- Config section -->
		<div id="type_section" class="section">
			<div class="section-head">
				<div class="section-tooltip"><?php _e('Post Type, Affects the post heading media and icon: Image, Video and Document, default is Image', TEXTDOMAIN); ?></div>
				<div class="label"><?php _e('Post Type', TEXTDOMAIN); ?></div>
			</div>

			<?php SelectTag('content_type', 
				  array( '1' => 'Slideshow', '2' => 'Video', '3' => 'VideO & Slideshow', '4' => 'document' ), 
				  'field-spacer field-selector',
				  'data-fields=".video-input,.slideshow-input"',
				  array('1' => 'data-show=".slideshow-input"',
						'2' => 'data-show=".video-input"',
						'3' => 'data-show=".slideshow-input , .video-input"')); ?>
			
			<div class="video-input">
			<?php SelectTag('video_server', 
				  array( '1' => 'YouTube', '2' => 'Vimeo' ), 'field-spacer' ); ?>
			
			<?php TextInput('video_id', 'Video ID', 'field-spacer'); ?>
			</div>
			
			<div class="slideshow-input">
				<div class="section-head">
					<div class="section-tooltip"><?php _e('Upload images to be shown in blogpost detail page, you can clear the fields to delete images', TEXTDOMAIN); ?></div>
					<div class="label"><?php _e('Post Images', TEXTDOMAIN); ?></div>
				</div>

				<?php ImageInput('post_image_1', 'Image 1', 'field-spacer'); ?>
				
				<?php ImageInput('post_image_2', 'Image 2', 'field-spacer'); ?>
				
				<?php ImageInput('post_image_3', 'Image 3', 'field-spacer'); ?>
				
				<?php ImageInput('post_image_4', 'Image 4', 'field-spacer'); ?>
				
				<?php ImageInput('post_image_5', 'Image 5', 'field-spacer'); ?>
				
				<?php ImageInput('post_image_6', 'Image 6', 'field-spacer'); ?>
				
				<?php ImageInput('post_image_7', 'Image 7', 'field-spacer'); ?>
				
				<?php ImageInput('post_image_8', 'Image 8', 'field-spacer'); ?>
				
				<?php ImageInput('post_image_9', 'Image 9', 'field-spacer'); ?>
				
				<?php ImageInput('post_image_10', 'Image 10'); ?>
				
			</div>
		</div>
		
	</div>
</div>