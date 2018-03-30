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
		
		var $prefix = RT_COMMON_THEMESLUG;
		var $customFields; 
		var $settings; 
		 
		/**
		* Constructor
		*/
		function rt_meta_gallery_init() {
			
			$this->settings = array( 
				"name"			=> __("Image Gallery","rt_theme_admin"),
				"scope"			=> array("portfolio","products","post"),
				"slug"			=> "image_gallery_options",
				"capability"	=> "edit_post",
				"context"		=> "side",
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
						add_meta_box( $this->settings['slug'], $this->settings['name'], array( &$this, 'displayCustomFields' ), $scope, $this->settings['context'], $this->settings['priority'] );
					}
					
				}else{
					add_meta_box( $this->settings['slug'], $this->settings['name'], array( &$this, 'displayCustomFields' ), $this->settings['scope'], $this->settings['context'], $this->settings['priority'] );
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
							$rt_gallery_images  = get_post_meta( $post->ID, $this->prefix . "rt_gallery_images", true ); 
 
							//to compatible with earlier rt-framework implode the images into an array first
							if( is_array($rt_gallery_images) && ! empty( $rt_gallery_images ) ) { 
								$rt_gallery_images = implode(",", $rt_gallery_images);
							}	
							?>

							<ul class="rt-gallery-uploaded-photos">
							 

									<?php  	
									if( ! empty($rt_gallery_images) ){ 	
										//make an array from the image list
										$rt_gallery_images_array = explode(",", $rt_gallery_images);		

										for ($i=0; $i < (count($rt_gallery_images_array)); $i++) {  
										 
											//the image url
											$image_url = rt_find_image_org_path( trim( $rt_gallery_images_array[$i] ) );

											//find the id of image 
											$image_id = rt_get_attachment_id_from_src( rt_clean_thumbnail_ext ( $image_url ) );

											//the thumbmail url
											$thumbnail = wp_get_attachment_image_src( $image_id, "thumbnail", true, "" );

											if( strpos( $thumbnail[0], "default.png") ){
												$thumbnail[0] = $image_url;											
											}
	 
											echo ' <li><img src="'.$thumbnail[0].'" data-rel="'.$image_url.'"></li> ';

										}
									}
									?>

							</ul> 

							<input type="hidden" name="<?php echo $this->prefix;?>rt_gallery_images" value="<?php echo $rt_gallery_images;?>" id="rt-gallery-images" class="upload_field">

							<div class="rt-gallery-new-photos-holder">
								<div class="rt-gallery-new-photos"></div>
							</div>
					<?php } ?> 
					
					<div class="rt_gallery_add_button icon-plus-squared-1 button"><?php echo __("Add New Images","rt_theme_admin"); ?></div> 	 
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
					$images  = isset($_POST[ $this->prefix."rt_gallery_images"]) ? $_POST[ $this->prefix."rt_gallery_images"] : "";		

					if (  isset( $images )   ) { 
						update_post_meta( $post_id, $this->prefix . "rt_gallery_images", $images );  
					} else {
						update_post_meta( $post_id, $this->prefix . "rt_gallery_images", $images ); 
					}					 
				}
		 
		}
		 
	} // End Class
 
?>