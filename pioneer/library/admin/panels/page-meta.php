<?php 


	if ( !class_exists('pageMeta') ) {
	

	class pageMeta {
		
		var $prefix = 'epic_';
		
				
		var $pagemeta =	array(
					
		
		
			
			
		array(
				"name"			=> "website",
				"title"			=> "Website",
				"description"	=> "Enter link project website",
				"type"			=> "text",								
				"scope"			=>	array("portfolio"),
				"capability"	=> "edit_pages"
			),
		
		
		array(
				"name"			=> "lightbox_video",
				"title"			=> "Lightbox video",
				"description"	=> "Enter link to video for lightbox",
				"type"			=> "text",								
				"scope"			=>	array("portfolio"),
				"capability"	=> "edit_pages"
			),
			
		
		array(
				"name"			=> "testimonial_writer",
				"title"			=> "Signature",
				"description"	=> "Enter testimonial signature/name",
				"type"			=> "text",								
				"scope"			=>	array("testimonial"),
				"capability"	=> "edit_pages"
			),
			
			

			
		

			
		array(
				"name"			=> "customurl",
				"title"			=> "Slide link",
				"description"	=> "The url you want the slide to link to",
				"type"			=> "text",
				"scope"			=>	array( "slide" ),
				"capability"	=> "edit_pages"
			),
			
	
			
		array(
				"name"			=> "slideinfo",
				"title"			=> "Hide text",
				"description"	=> "Hide slide title and excerpt",
				"type"			=> "checkbox",
				"scope"			=>	array( "slide" ),
				"capability"	=> "edit_pages"
			),
		
		
			
		
			
		);
		
		
		
		/**
		* PHP 4 Compatible Constructor
		*/
		function pageMeta() { $this->__constructPageMeta(); }
		/**
		* PHP 5 Constructor
		*/
		function __constructPageMeta() {
			add_action( 'admin_menu', array( &$this, 'createPageCustomFields' ) );
			add_action( 'save_post', array( &$this, 'savePageCustomFields' ), 1, 2 );
			// Comment this line out if you want to keep default custom fields meta box
			//add_action( 'do_meta_boxes', array( &$this, 'removeDefaultCustomFields' ), 10, 3 );
		}
		/**
		* Remove the default Custom Fields meta box
		*/
		function removeDefaultCustomFields( $type, $context, $post ) {
			foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
				remove_meta_box( 'postcustom', 'post', $context );
				remove_meta_box( 'postcustom', 'page', $context );
				//Use the line below instead of the line above for WP versions older than 2.9.1
				//remove_meta_box( 'pagecustomdiv', 'page', $context );
			}
		}
		/**
		* Create the new Custom Fields meta box
		*/
		function createPageCustomFields() {
			if ( function_exists( 'add_meta_box' ) ) {
				//add_meta_box( 'page-custom-fields', 'Post meta data', array( &$this, 'displayPageCustomFields' ), 'post', 'normal', 'high' );
				//add_meta_box( 'page-custom-fields', 'Page meta options', array( &$this, 'displayPageCustomFields' ), 'page', 'normal', 'high' );
				//add_meta_box( 'page-custom-fields', 'Employee data', array( &$this, 'displayPageCustomFields' ), 'staff', 'normal', 'low' );
				//add_meta_box( 'page-custom-fields', 'Product data', array( &$this, 'displayPageCustomFields' ), 'products', 'normal', 'high' );
				//add_meta_box( 'page-custom-fields', 'News meta data', array( &$this, 'displayPageCustomFields' ), 'news', 'normal', 'high' );
				add_meta_box( 'page-custom-fields', 'Portfolio meta data', array( &$this, 'displayPageCustomFields' ), 'portfolio', 'normal', 'high' );
				add_meta_box( 'page-custom-fields', 'Testimonial meta data', array( &$this, 'displayPageCustomFields' ), 'testimonial', 'normal', 'high' );	
				add_meta_box( 'page-custom-fields', 'Slide meta data', array( &$this, 'displayPageCustomFields' ), 'slide', 'normal', 'high' );	
			}
		}
		/**

		* Display the new Custom Fields meta box
		*/
		function displayPageCustomFields() {
			global $post;
			
			
			?>

<div class="form-wrap">
			<?php
				wp_nonce_field( 'page-custom-fields', 'page-custom-fields_wpnonce', false, true );
				foreach ( $this->pagemeta as $customField ) {
					// Check scope
					$scope = $customField[ 'scope' ];
					$output = false;
					foreach ( $scope as $scopeItem ) {
						switch ( $scopeItem ) {
							case "post": {
								// Output on any post screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php" || $post->post_type=="post" )
									$output = true;
								break;
							}
							case "news": {
								// Output on any post screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php?post_type=news" || $post->post_type=="news" )
									$output = true;
								break;
							}

							
							case "testimonial": {
								// Output on any post screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php?post_type=testimonial" || $post->post_type=="testimonial" )
									$output = true;
								break;
							}
							
							case "staff": {
								// Output on any post screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php?post_type=staff" || $post->post_type=="staff" )
									$output = true;
								break;
							}
							
							case "slide": {
								// Output on any post screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php?post_type=slide" || $post->post_type=="slide" )
									$output = true;
								break;
							}
							
			
							case "portfolio": {
								// Output on any post screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php?post_type=portfolio" || $post->post_type=="portfolio" )
									$output = true;
								break;
							}
							
							
							case "page": {
								// Output on any page screen
								if ( basename( $_SERVER['SCRIPT_FILENAME'] )=="post-new.php?post_type=page" || $post->post_type=="page" )
									$output = true;
								break;
							}
						}
						if ( $output ) break;
					}
					
					
					
					// Check capability
					if ( !current_user_can( $customField['capability'], $post->ID ) )
						$output = false;
					// Output if allowed
					if ( $output ) { ?>
			<div class="form-field form-required" style="display:inline-block;">
						
									<?php
							switch ( $customField[ 'type' ] ) {
								case "radio": {
									// Radiobutton
									
									echo '<h4 style="font-size:13px; margin:0 0 12px 0; clear:left;">'. $customField['title'].'</h4>';
									
									foreach ($customField ['radiovalue'] as $radiovalue => $radiolabel  ){
									
									echo '<div style="clear:both;  width:auto;margin:0 20px 20px 0; float:left; clear:none; ">';
									echo '<input type="radio"  name="' . $this->prefix . $customField['name'] . '" id="' . $this->prefix . $customField['name'] . '" value="' .$this->prefix.$radiovalue. '"';
									
										if (get_post_meta($post->ID, $this->prefix . $customField['name'], true ) == $this->prefix .$radiovalue ){
										echo ' checked="checked"';	
										}
										elseif(get_post_meta($post->ID, $this->prefix . $customField['name'], true ) == ''&& $customField['default']== $radiovalue){
										echo ' checked="checked"';
										}
										
									echo '"style="width: auto;" />';
									//echo get_post_meta( $post->ID, $this->prefix . $customField['name'],true);
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline; margin-left:4px; padding:0;">' . $radiolabel . '</label>';
									if ( $customField[ 'description' ] ) echo '<p style="clear:left;">' . $customField[ 'description' ] . '</p>';
									echo'</div>';
									
									}
									break;
								}



															
								
								
								
								
							
								
								
								
								case "checkbox": {
									// Checkbox
									echo '<div style="clear:both; margin:4px 0;">';
									echo '<input type="checkbox"  name="' . $this->prefix . $customField['name'] . '" id="' . $this->prefix . $customField['name'] . '" value="yes"';
									if ( get_post_meta( $post->ID, $this->prefix . $customField['name'], true ) == "yes" )
										echo ' checked="checked"';
									echo '" style="width: auto;" />';
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline; margin-left:4px; padding:0;">' . $customField[ 'title' ] . '</label>';
									if ( $customField[ 'description' ] ) echo '<p style="clear:left;">' . $customField[ 'description' ] . '</p>';
									echo'</div>';
									break;
								}
								
								case "html": {
									// Description field
									
									break;
								}
								
								case "textarea": {
									// Text area
									echo '<div style="clear:both; margin:0 0 8px;">';
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<textarea name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" columns="30" rows="3">' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '</textarea>';
									if ( $customField[ 'description' ] ) echo '<p style="clear:left;">' . $customField[ 'description' ] . '</p>';
									echo'</div>';
									break;
								}
								
								case "textnarrow": {
									// Plain text field
									
									echo '<div style="clear:both; width:200px; margin:0 20px 10px 0; float:left; clear:left;">';
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<input type="text" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '" />';
									if ( $customField[ 'description' ] ) echo '<p style="clear:left;">' . $customField[ 'description' ] . '</p>';
									echo'</div>';
									break;
								}
								
								case "texttiny": {
									// Plain text field
									
									echo '<div style="width:120px; margin:0 10px 0 0;">';
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<input type="text" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '"/>';
									if ( $customField[ 'description' ] ) echo '<p style="clear:left;">' . $customField[ 'description' ] . '</p>';
									echo'</div>';
									break;
								}
								default: {
									// Plain text field
									echo '<div style="clear:both; width:240px; margin:4px 0;">';
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<input type="text" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '" />';
									if ( $customField[ 'description' ] ) echo '<p style="clear:left;">' . $customField[ 'description' ] . '</p>';
									echo'</div>';
									
									break;
								}
							}
							?>
									
						
			</div>
			<?php
					}
				} ?>
</div>
<?php	}
		/*
		Save the new Custom Fields values
		*/
		function savePageCustomFields( $post_id, $post ) {
			if ( !wp_verify_nonce(isset($_POST[ 'page-custom-fields_wpnonce' ]), 'page-custom-fields' ) )
				return;
			if ( !current_user_can( 'edit_post', $post_id ) )
				return;
			
			foreach ( $this->pagemeta as $customField ) {
				if (current_user_can( $customField['capability'], $post_id ) ) {
					if ( isset( $_POST[ $this->prefix . $customField['name'] ] ) && trim( $_POST[ $this->prefix . $customField['name'] ] ) ) {
					update_post_meta( $post_id, $this->prefix . $customField[ 'name' ], $_POST[ $this->prefix . $customField['name'] ] );
					
					} else {
						delete_post_meta( $post_id, $this->prefix . $customField[ 'name' ] );
					}
				}
			}
		}

	} // End Class

} // End if class exists statement

// Instantiate the class
if ( class_exists('pageMeta') ) {
	$pageMeta_var = new pageMeta();
}