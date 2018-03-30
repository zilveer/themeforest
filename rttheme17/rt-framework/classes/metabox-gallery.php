<?php
#-----------------------------------------
#	RT-Theme metaboxes.php
#	version: 1.0
#-----------------------------------------

#
# 	Custom Fields
#
 

	class rt_meta_box_gallery extends RTTheme{
		#
		# @var $prefix
		# @var $customFields
		# @var $settings
		#
		
		var $prefix = THEMESLUG;
		var $customFields; 
		var $settings; 
		 
		/**
		* Constructor
		*/
		function rt_meta_gallery_init() {
			
			$this->settings = array( 
				"name"			=> __("Featured Images","rt_theme_admin"),
				"scope"			=> array("portfolio","products","post"),
				"slug"			=> "image_gallery_options",
				"capability"		=> "edit_post",
				"context"			=> "side",
				"priority"		=> "" 
			);

			add_action( 'admin_menu', array( &$this, 'createCustomFields' ) );
			add_action( 'save_post', array( &$this, 'saveCustomFields' ) );
		}
		 
		/**
		* Create the new Custom Fields meta box
		*/
		function createCustomFields() {
			if ( function_exists( 'add_meta_box' ) ) {
				if(is_array($this->settings['scope'])){
					
					foreach($this->settings['scope'] as $scope){
						add_meta_box( $this->settings['slug'], THEMENAME." ". $this->settings['name'], array( &$this, 'displayCustomFields' ), $scope, $this->settings['context'], $this->settings['priority'] );
					}
					
				}else{
					add_meta_box( $this->settings['slug'], THEMENAME." ". $this->settings['name'], array( &$this, 'displayCustomFields' ), $this->settings['scope'], $this->settings['context'], $this->settings['priority'] );
				}
			}
		}
		/**
		* Display the new Custom Fields meta box
		*/
		function displayCustomFields() {
			global $post; 
						
			?>
			 <div class="box right-col metaboxes side">
				<?php 
			 		wp_nonce_field($this->settings['slug'], $this->settings['slug'].'_wpnonce', false, true );
					// Check capability
					if ( !current_user_can( $this->settings['capability'], $post->ID ) ){
						$output = false;
					}else{
						$output = true;
					}
						 
					// Output if allowed
					if ( $output ) { ?>  
 		
							<?php
								//get stored values
								$rt_gallery_images 			= get_post_meta( $post->ID, $this->prefix . "rt_gallery_images", true );
								$rt_gallery_image_titles 	= get_post_meta( $post->ID, $this->prefix . "rt_gallery_image_titles", true );
								$rt_gallery_image_descs 	= get_post_meta( $post->ID, $this->prefix . "rt_gallery_image_descs", true ); 
							?>

							<?php  	
								
							if(is_array($rt_gallery_images)){ 
							?>

							 <div class="rt_photo_holder rt-edit-images-title">
								<table>
								    <tr>
										<td class="col1"><h4 class="edit_image"><?php echo __("Edit Images","rt_theme_admin"); ?></h4> 
										<hr />
										</td>
								    </tr>
								</table>
							<?php  	
								 
								for ($i=0; $i < (count($rt_gallery_images)); $i++) {  
							?> 

							<div class="rt-gallery-uploaded-photos">
											
												
								<div class="block-<?php echo $i;?>">								 
									<table class="passive">
									<tr>
										<td class="col1">
											<div class="">
												<img class="loadit" src="<?php echo $rt_gallery_images[$i];?>" id="rt-gallery-image-<?php echo $i;?>-show" data-galimage="rt-gallery-image-<?php echo $i;?>">
												<img src="<?php echo THEMEADMINURI; ?>/images/delete.png" class="delete rt-gallery-image-<?php echo $i;?>" id="delete_rt-gallery-image-<?php echo $i;?>-show" data-imageid="rt-gallery-image-<?php echo $i;?>">
											</div>
										</td>
									</tr>
									</table>

									<table class="rt-photo-holder-hidden-part">  
										<tr> 									
											<td class="col1">
												<label><?php echo __("Photo URL","rt_theme_admin"); ?></label>
												<div class="desc"><?php echo __("Upload an image or type the url of an image which has been uploaded by the media uploder.","rt_theme_admin"); ?></div>
											</td>										
										</tr>
										<tr>
											<td class="col1">
												<div class="form_element upload">
													<input type="text" name="<?php echo $this->prefix;?>rt_gallery_images[]" value="<?php echo $rt_gallery_images[$i];?>" id="rt-gallery-image-<?php echo $i;?>" data-imageurl="rt-gallery-image-<?php echo $i;?>" class="upload_field">												
													<input type="button" value="Upload" class="template_button light rttheme_gallery_button rt-gallery-image-<?php echo $i;?> button" data-imageid="rt-gallery-image-<?php echo $i;?>" />  
												</div>
											</td>
										</tr>
																		
										<tr>
											<td class="col1">
												<label><?php echo __("Photo Name","rt_theme_admin"); ?></label> 
											</td>	
										</tr>
										<tr>
											<td class="col1">
												<div class="form_element"><input type="text" name="<?php echo $this->prefix;?>rt_gallery_image_titles[]" value="<?php echo $rt_gallery_image_titles[$i];?>" id="rt-gallery-image-title-<?php echo $i;?>"></div>
											</td>
										</tr>
										<tr>
											<td class="col1">
												<label><?php echo __("Photo Description","rt_theme_admin"); ?></label> 
											</td>	
										</tr>
										<tr>
											<td class="col1">
												<div class="form_element"><input type="text" name="<?php echo $this->prefix;?>rt_gallery_image_descs[]" value="<?php echo $rt_gallery_image_descs[$i];?>" id="rt-gallery-image-text-<?php echo $i;?>"></div>
											</td>
										</tr> 
									</table>

									<table>  
										<tr>
											<td  class="col1">
												<div class="rt_gallery_edit_button"><?php echo __("Edit","rt_theme_admin"); ?></div> 
												<div class="rt_gallery_close_button"><?php echo __("Close","rt_theme_admin"); ?></div> 
												<div class="rt_gallery_delete_button" id="block-<?php echo $i;?>"><?php echo __("Delete","rt_theme_admin"); ?></div> 
												
												<?php if($i+1!=count($rt_gallery_images)) {
													echo "<hr />";
												}
												?>

											</td>
										</tr>
									</table>
								</div>

							</div>

							 	
						 	<?php  
						 	}
						 	?>
						 	</div>
						 	<?php
						 		}
						 	?>

							<div class="rt-gallery-new-photos-holder">
								<div class="rt-gallery-new-photos"></div>
 							</div>
					<?php } ?>

	  
					<div class="rt_gallery_add_button"><?php echo __("Add New Image","rt_theme_admin"); ?></div> 											
		 
					 
						 						
			</div>
			<?php
		}
	  

		#
		# Create New Photo Form
		# 
		function createPhotoForm() {?>

		<?php
			$newRTPhotoFormID  = 'rt_photo_'.rand(1000, 1000000);
		?>
		<div class="rt-gallery-new-photos"  style="opacity:0;">
				<div class="rt_photo_holder block-<?php echo $newRTPhotoFormID;?>">
					<table>
						<tr>
							<td class="col1"><h4 class="add_image"><?php echo __("Add New Image","rt_theme_admin"); ?></h4> 
							<hr />
							</td>
						</tr>
					</table>
													 
					<table>
						<tr  style="display:none;"> 									
							<td class="col1">
								<div class="">
									<img class="loadit" src="<?php echo THEMEADMINURI; ?>/images/blank.png" id="rt-gallery-image-<?php echo $newRTPhotoFormID;?>-show" data-galimage="rt-gallery-image-<?php echo $newRTPhotoFormID;?>"> 
									<img src="<?php echo THEMEADMINURI; ?>/images/delete.png" class="delete rt-gallery-image-<?php echo $newRTPhotoFormID;?>" id="delete_rt-gallery-image-<?php echo $newRTPhotoFormID;?>-show" data-imageid="rt-gallery-image-<?php echo $newRTPhotoFormID;?>">
								</div>
							</td>										
						</tr>
					</table>


					<table>
						<tr> 									
							<td class="col1">
								<label><?php echo __("Photo URL","rt_theme_admin"); ?></label>
								<div class="desc"><?php echo __("Upload an image or type the url of an image which has been uploaded by the media uploder.","rt_theme_admin"); ?></div>
							</td>										
						</tr>
						<tr>
							<td class="col1">
								<div class="form_element upload">
									<input type="text" name="<?php echo $this->prefix;?>rt_gallery_images[]" value="" id="rt-gallery-image-<?php echo $newRTPhotoFormID;?>" data-imageurl="rt-gallery-image-<?php echo $newRTPhotoFormID;?>" class="upload_field">
									<input type="button" value="Upload" class="template_button light rttheme_gallery_button rt-gallery-image-<?php echo $newRTPhotoFormID;?> button" data-imageid="rt-gallery-image-<?php echo $newRTPhotoFormID;?>" />
								</div>														
							</td>
						</tr>
														
						<tr>
							<td class="col1">
								<label><?php echo __("Photo Name","rt_theme_admin"); ?></label> 
							</td>	
						</tr>
						<tr>
							<td class="col1">
								<div class="form_element"><input type="text" name="<?php echo $this->prefix;?>rt_gallery_image_titles[]" value="" id="rt-gallery-image-title-<?php echo $newRTPhotoFormID;?>"></div>
							</td>
						</tr>
						<tr>
							<td class="col1">
								<label><?php echo __("Photo Description","rt_theme_admin"); ?></label> 
							</td>	
						</tr>
						<tr>
							<td class="col1">
								<div class="form_element"><input type="text" name="<?php echo $this->prefix;?>rt_gallery_image_descs[]" value="" id="rt-gallery-image-text-<?php echo $newRTPhotoFormID;?>"></div>
							</td>
						</tr> 
					</table>  


					<table>  
						<tr>
							<td  class="col1"> 
								<div class="rt_gallery_delete_button nomargin new-image-delete" id="block-<?php echo $newRTPhotoFormID;?>"><?php echo __("Delete","rt_theme_admin"); ?></div>  
							</td>
						</tr>
					</table>			
				</div>
		</div>
		<?php
		 
		}

		#
		# Save the new Custom Fields values
		# 
		function saveCustomFields( $post_id ) {


			global $post;

			$theFields = isset ( $_POST[ $this->settings['slug'].'_wpnonce' ] )  ? $_POST[ $this->settings['slug'].'_wpnonce' ] : "" ;

			if (!wp_verify_nonce( $theFields, $this->settings['slug'] ) )
				return $post_id;
			 	

				if ( current_user_can( $this->settings['capability'], $post_id ) ) {
					
					$images 		= isset($_POST[ $this->prefix."rt_gallery_images"]) ? $_POST[ $this->prefix."rt_gallery_images"] : "";		 
					$image_titles 	= isset($_POST[ $this->prefix."rt_gallery_image_titles"]) ? $_POST[ $this->prefix."rt_gallery_image_titles"] : "";		 
					$image_descs 	= isset($_POST[ $this->prefix."rt_gallery_image_descs"]) ? $_POST[ $this->prefix."rt_gallery_image_descs"] : "";		 


					if (  isset( $images )   ) { 
						update_post_meta( $post_id, $this->prefix . "rt_gallery_images", $images );  
					} else {
						update_post_meta( $post_id, $this->prefix . "rt_gallery_images", $images ); 
					}


					if (  isset( $image_titles )   ) { 
						update_post_meta( $post_id, $this->prefix . "rt_gallery_image_titles", $image_titles );  
					} else {
						update_post_meta( $post_id, $this->prefix . "rt_gallery_image_titles", $image_titles ); 
					}					
				

					if (  isset( $image_descs )   ) { 
						update_post_meta( $post_id, $this->prefix . "rt_gallery_image_descs", $image_descs );  
					} else {
						update_post_meta( $post_id, $this->prefix . "rt_gallery_image_descs", $image_descs ); 
					}					
				}
		 
		}
		 
	} // End Class
 
?>