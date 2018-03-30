<?php
/**
 * Created by PhpStorm.
 * User: kos
 * Date: 7/19/2016
 * Time: 7:11 PM
 */

function get_images_from_media_library()
{
	$args = array( 'post_type' => 'attachment',
                    'post_mime_type' =>get_allowed_mime_types(),
                    'post_status' => 'any',
                    'posts_per_page' => -1,
	);
	$query_images = new WP_Query( $args );
	$output = array(
		'image' => array(),
		// video/mpeg, video/mp4, ...
		'video' => array(),
		// .svg, .zip, etc...
		'other' => array(),
	);
	foreach ( $query_images->posts as $image)
	{
		if(false !== ($pos = stripos($image->post_mime_type, 'image/'))){
			$output['image'][$image->ID] = $image->guid;
		}
		elseif(false !== ($pos = stripos($image->post_mime_type, 'video/'))){
			$output['video'][$image->ID] = $image->guid;
		}
		else {
			$output['other'][$image->ID] = $image->guid;
		}
	}
	return $output;
}

?>
<div class="wrap znexp-wrapper">
	<h2>Demo data image manipulation</h2>

	<div class="wp-filter">
		<div class="actions">
			<p>This functionality should only be used on the website where a previously exported theme demo was imported onto. </p>
			<p>Here you can completely replace the images used in a demo installation with placeholders.</p>
		</div>
	</div>

	<form method="post">
		<div id="zn-export-ajax-info" class="zn-export-section"></div>

		<div class="zn-export-section">
			<?php
				$files = get_images_from_media_library();
				if(empty($files)){
					echo '<p><strong>No attachments found in Media gallery</strong></p>';
				}
				else
				{
					// Parse each section

					//#!++ IMAGES
					echo '<h3>Images</h3>';
					echo '<div class="wp-filter">';
					echo '<div class="actions" style="padding: 15px 5px;">';
					echo '<div style="overflow: hidden;">';
					if(isset($files['image']) && !empty($files['image']))
					{
						foreach($files['image'] as $fileID => $fileUrl){
							?>
							<p style="float:left; margin: 2px 2px; height: 150px;">
								<img class="target-file"
								     data-type="image"
								     id="target_file_<?php echo $fileID;?>"
								     src="<?php echo $fileUrl;?>"
								     width="100" height="100" style="display:block;"/>
								<a href="<?php echo $fileUrl;?>" title="Opens in a new tab" target="_blank"
								   class="change-image-link"
								   style="display: block; width:100%; text-align:center;">
									change
								</a>
								<input type="hidden" class="im-input-hidden" id="file_<?php echo $fileID;?>"
								       value="<?php echo $fileUrl;
								?>"/>
							</p>
							<?php
						}
					}
					else { echo '<p><strong>No images found.</strong></p>'; }
					echo '</div>';
					echo '</div>';
					echo '</div>';
					//#!-- End parsing images

					//#!++ VIDEOS
					echo '<h3>Videos</h3>';
					echo '<div class="wp-filter">';
					echo '<div class="actions" style="padding: 15px 5px;">';
					echo '<div style="overflow: hidden;">';
					if(isset($files['image']) && !empty($files['image']))
					{
						foreach($files['video'] as $fileID => $fileUrl){
							?>
							<p style="float:left; margin: 2px 2px; height: 150px;">
								<video id="target_file_<?php echo $fileID;?>"
								       src="<?php echo $fileUrl;?>"
								       width="100" height="100">
								</video>
								<a href="<?php echo $fileUrl;?>" title="Opens in a new tab" target="_blank"
								   style="display: block; width:100%; text-align:center;">
									view
								</a>
								<input type="hidden" id="file_<?php echo $fileID;?>" value="<?php echo $fileUrl;?>"/>
							</p>
							<?php
						}
					}
					else { echo '<p><strong>No videos found.</strong></p>'; }
					echo '</div>';
					echo '</div>';
					echo '</div>';
					//#!-- End parsing videos


					//#!++ OTHER
					echo '<h3>Other</h3>';
					echo '<div class="wp-filter">';
					echo '<div class="actions" style="padding: 15px 5px;">';
					echo '<div style="overflow: hidden;">';
					if(isset($files['other']) && !empty($files['image']))
					{
						foreach($files['other'] as $fileID => $fileUrl){
							?>
							<p style="float:left; margin: 2px 2px; height: 150px; ">
								<img id="target_file_<?php echo $fileID;?>"
								     src="<?php echo FW_URL;?>/admin/assets/images/file-icon.png"
								     width="100"
								     height="100" style="display:block;"/>
								<a href="<?php echo $fileUrl;?>" title="Opens in a new tab" target="_blank"
								   style="display: block; width:100%; text-align:center;">
									view
								</a>
								<input type="hidden" id="file_<?php echo $fileID;?>" value="<?php echo $fileUrl;?>"/>
							</p>
							<?php
						}
					}
					else { echo '<p><strong>No files found.</strong></p>'; }
					echo '</div>';
					echo '</div>';
					echo '</div>';
					//#!-- End parsing other mime type files
				}
			?>
		</div>

		<div class="zn-export-section">
			<input type="button" id="zn-im-export-button" value="Export and Download" class="button-primary"/>
		</div>
	</form>

</div><!--//END: .znexp-wrapper -->
