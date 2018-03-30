<?php 
if ( !class_exists('myCustomFields') ) {

	class myCustomFields {
		/**
		* @var  string  $prefix  The prefix for storing custom fields in the postmeta table
		*/
		var $prefix = 'qode_';
		/**
		* @var  array  $postTypes  An array of public custom post types, plus the standard "post" and "page" - add the custom types you want to include here
		*/
		var $postTypes = array( "page", "post", "portfolio_page" );
		/**
		* @var  array  $customFields  Defines the custom fields available
		*/
		var $customFields =	array(
			array(
				"name"			=> "content-animation",
				"title"			=> "Content entering animation",
				"description"	=> "",
				"type"			=> "selectbox-content-animation",
				"scope"			=>	array("page","post","portfolio_page"),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "show-page-title",
				"title"			=> "Don't show page title area",
				"description"	=> "",
				"type"			=> "checkbox",
				"scope"			=>	array("page","post","portfolio_page"),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "show-page-title-text",
				"title"			=> "Don't show title",
				"description"	=> "",
				"type"			=> "checkbox",
				"scope"			=>	array("page","post","portfolio_page"),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "page-title-text",
				"title"			=> "Show post/portfolio title in 'title area'",
				"description"	=> "",
				"type"			=> "checkbox",
				"scope"			=>	array("post","portfolio_page"),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "show-sidebar",
				"title"			=> "Choose sidebar",
				"description"	=> "",
				"type"			=> "selectbox",
				"scope"			=>	array("page","post"),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "choose-sidebar",
				"title"			=> "Choose sidebar to display",
				"description"	=> "",
				"type"			=> "selectbox-sidebar",
				"scope"			=>	array("page","post"),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "hide-featured-image",
				"title"			=> "Hide featured image",
				"description"	=> "",
				"type"			=> "selectbox-featured-image",
				"scope"			=>	array("post"),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "show-animation",
				"title"			=> "Choose animation",
				"description"	=> "",
				"type"			=> "selectbox-animation",
				"scope"			=>	array("page","post","portfolio_page"),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "choose-blog-category",
				"title"			=> "Choose blog category",
				"description"	=> "",
				"type"			=> "selectbox-category",
				"scope"			=>	array("page"),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "show-posts-per-page",
				"title"			=> "Posts per page",
				"description"	=> "",
				"type"			=> "text",
				"scope"			=>	array("page"),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "choose-portfolio-single-view",
				"title"			=> "Choose portfolio single view",
				"description"	=> "",
				"type"			=> "selectbox-portfolio-single",
				"scope"			=>	array("portfolio_page"),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "choose-number-of-portfolio-columns",
				"title"			=> "Choose number of columns (Only for portfolio single view 6)",
				"description"	=> "",
				"type"			=> "selectbox-portfolio-columns-number",
				"scope"			=>	array("portfolio_page"),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "choose-portfolio-list-page",
				"title"			=> "Choose portfolio back link",
				"description"	=> "",
				"type"			=> "selectbox-portfolio-list-page",
				"scope"			=>	array("portfolio_page"),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "revolution-slider",
				"title"			=> "Enter revolution slider shortcode",
				"description"	=> "",
				"type"			=> "text",
				"scope"			=>	array("page","post","portfolio_page"),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "responsive-title-image",
				"title"			=> "Responsive title image",
				"description"	=> "",
				"type"			=> "selectbox-responsive-title-image",
				"scope"			=>	array("page","post","portfolio_page"),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "fixed-title-image",
				"title"			=> "Fixed title image / Only if title image is not responsive",
				"description"	=> "",
				"type"			=> "selectbox-fixed-title-image",
				"scope"			=>	array("page","post","portfolio_page"),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "title-image",
				"title"			=> "Title image",
				"description"	=> "",
				"type"			=> "image-title-image",
				"scope"			=>	array("page","post","portfolio_page"),
				"capability"	=> "manage_options"
			),
			array(
				"name"			=> "title-height",
				"title"			=> "Title height (px) / Only if title image is not responsive",
				"description"	=> "",
				"type"			=> "text",
				"scope"			=>	array("page","post","portfolio_page"),
				"capability"	=> "manage_options"
			),
		);
		/**
		* PHP 4 Compatible Constructor
		*/
		//function myCustomFields() { $this->__construct(); }
		/**
		* PHP 5 Constructor
		*/
		function __construct() {
			add_action( 'admin_menu', array( &$this, 'createCustomFields' ) );
			add_action( 'save_post', array( &$this, 'saveCustomFields' ), 1, 2 );
			// Comment this line out if you want to keep default custom fields meta box
			add_action( 'do_meta_boxes', array( &$this, 'removeDefaultCustomFields' ), 10, 3 );
		}
		/**
		* Remove the default Custom Fields meta box
		*/
		function removeDefaultCustomFields( $type, $context, $post ) {
			foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
				foreach ( $this->postTypes as $postType ) {
					remove_meta_box( 'postcustom', $postType, $context );
				}
			}
		}
		/**
		* Create the new Custom Fields meta box
		*/
		function createCustomFields() {
			if ( function_exists( 'add_meta_box' ) ) {
				foreach ( $this->postTypes as $postType ) {
					add_meta_box( 'my-custom-fields', 'Qode Custom Fields', array( &$this, 'displayCustomFields' ), $postType, 'normal', 'high' );
					add_meta_box( 'my-custom-portfolio', 'Qode Portfolio', array( &$this, 'displayCustomPortfolio' ), 'portfolio_page', 'normal', 'high' );
					add_meta_box( 'my-custom-parallax', 'Qode Parallax', array( &$this, 'displayCustomParallax' ), $postType, 'normal', 'high' );
					add_meta_box( 'my-custom-seo', 'Qode SEO Fields', array( &$this, 'displayCustomSeo' ), $postType, 'normal', 'high' );

				}
			}
		}
		/**
		* Display the new Custom Fields meta box
		*/
		function displayCustomFields() {
			global $post;
			global $qode_options_passage;
			?>
			<div class="form-wrap">
				<?php
				wp_nonce_field( 'my-custom-fields', 'my-custom-fields_wpnonce', false, true );
				foreach ( $this->customFields as $customField ) {
					// Check scope
					$scope = $customField[ 'scope' ];
					$output = false;
					foreach ( $scope as $scopeItem ) {
						switch ( $scopeItem ) {
							default: {
								if ( $post->post_type == $scopeItem )
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
						<div class="form-field form-required">
							<?php
							switch ( $customField[ 'type' ] ) {
								case "checkbox": {
									// Checkbox
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
									echo '<input type="checkbox" name="' . $this->prefix . $customField['name'] . '" id="' . $this->prefix . $customField['name'] . '" value="yes"';
									if ( get_post_meta( $post->ID, $this->prefix . $customField['name'], true ) == "yes" )
										echo ' checked="checked"';
									echo '" style="width: auto;" />';
									break;
								}
								case "selectbox": {
									// Selectbox
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
									 echo '<select name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '"> ';
									?>
										<option value="" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "" ) { ?> selected="selected" <?php } ?>></option>
										<option value="default" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "default" ) { ?> selected="selected" <?php } ?>>No Sidebar</option>
										<option value="1" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "1" ) { ?> selected="selected" <?php } ?>>Sidebar 1/3 right</option>
										<option value="2" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "2" ) { ?> selected="selected" <?php } ?>>Sidebar 1/4 right</option>
										<option value="3" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "3" ) { ?> selected="selected" <?php } ?>>Sidebar 1/3 left</option>
										<option value="4" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "4" ) { ?> selected="selected" <?php } ?>>Sidebar 1/4 left</option>
                                    
                                    <?php 
                                    echo '</select>';
									break;
								}
								case "selectbox-featured-image": {
									// Selectbox
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
									 echo '<select name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '"> ';
									?>
										<option value="no" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "no" ) { ?> selected="selected" <?php } ?>>No</option>
										<option value="yes" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "yes" ) { ?> selected="selected" <?php } ?>>Yes</option>
									
                                    <?php 
                                    echo '</select>';
									break;
								}
								case "selectbox-slider": {
									// Selectbox
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
									 echo '<select name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '"> ';
									?>
										<option value="no" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "no" ) { ?> selected="selected" <?php } ?>>No</option>
										<option value="yes" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "yes" ) { ?> selected="selected" <?php } ?>>Yes</option>
									
                                    <?php 
                                    echo '</select>';
									break;
								}
								
								case "selectbox-category": {
										$categories = get_categories(); 
										
										echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
										echo '<select name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '"> ';
											echo '<option value=""></option>';
											foreach($categories as $category) :
												echo '<option value="'. $category->term_id .'"';
												if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == $category->term_id ) { echo 'selected="selected"';}
												echo '>';
												echo $category->name . '</option>';
											
											endforeach;
										echo '</select>';
									
									break;
								}
								case "selectbox-portfolio-single": {
										// Selectbox
										echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
										echo '<select name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '"> ';
										?>
											<option value="" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "" ) { ?> selected="selected" <?php } ?>></option>
											<option value="1" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "1" ) { ?> selected="selected" <?php } ?>>Portfolio style 1</option>
											<option value="2" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "2" ) { ?> selected="selected" <?php } ?>>Portfolio style 2</option>
											<option value="3" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "3" ) { ?> selected="selected" <?php } ?>>Portfolio style 3</option>
											<option value="4" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "4" ) { ?> selected="selected" <?php } ?>>Portfolio style 4</option>
											<option value="5" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "5" ) { ?> selected="selected" <?php } ?>>Portfolio style 5</option>
											<option value="6" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "6" ) { ?> selected="selected" <?php } ?>>Portfolio style 6</option>
										<?php 
										echo '</select>';
									
									break;
								}
								case "selectbox-portfolio-columns-number": {
										// Selectbox
										echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
										echo '<select name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '"> ';
										?>
											<option value="" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "" ) { ?> selected="selected" <?php } ?>></option>
											<option value="2" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "2" ) { ?> selected="selected" <?php } ?>>2 Columns</option>
											<option value="3" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "3" ) { ?> selected="selected" <?php } ?>>3 Columns</option>
											<option value="4" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "4" ) { ?> selected="selected" <?php } ?>>4 Columns</option>
										<?php 
										echo '</select>';
									
									break;
								}
								case "selectbox-portfolio-list-page": {
										// Selectbox
										echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
										
										$args = array(
											'show_option_none' => ' ',
											'option_none_value' => '',
											'selected' => get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ),
											'name' => $this->prefix . $customField[ 'name' ]
										);
										wp_dropdown_pages($args);
									
									break;
								}
								
								case "selectbox-animation": {
									$page_transitions = "3";
									if (isset($qode_options_passage['page_transitions'])) $page_transitions = $qode_options_passage['page_transitions'];
									if($page_transitions == "1" || $page_transitions == "2" || $page_transitions == "3" || $page_transitions == "4"){
										// Selectbox
										echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
										 echo '<select name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '"> ';
										?>
											<option value="" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "default" ) { ?> selected="selected" <?php } ?>></option>
											<option value="no_animation" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "no_animation" ) { ?> selected="selected" <?php } ?>>No animation</option>
											<option value="updown" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "updown" ) { ?> selected="selected" <?php } ?>>Up / Down</option>
											<option value="fade" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "fade" ) { ?> selected="selected" <?php } ?>>Fade</option>
											<option value="leftright" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "leftright" ) { ?> selected="selected" <?php } ?>>Left / Right</option>
																			
											<?php 
											echo '</select>';
									}
									break;
								}
								case "selectbox-responsive-title-image": {
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
									echo '<select name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '"> ';
									?>
										<option value="" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "" ) { ?> selected="selected" <?php } ?>></option>
										<option value="no" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "no" ) { ?> selected="selected" <?php } ?>>No</option>
										<option value="yes" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "yes" ) { ?> selected="selected" <?php } ?>>Yes</option>
									<?php 
									echo '</select>';
									
									break;
								}
								case "selectbox-fixed-title-image": {
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
									echo '<select name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '"> ';
									?>
										<option value="" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "" ) { ?> selected="selected" <?php } ?>></option>
										<option value="no" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "no" ) { ?> selected="selected" <?php } ?>>No</option>
										<option value="yes" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "yes" ) { ?> selected="selected" <?php } ?>>Yes</option>
									<?php 
									echo '</select>';
									
									break;
								}
								case "image-title-image": {
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
									echo '<div class="image_holder"><input type="text" id="title_image" name="' . $this->prefix . $customField[ 'name' ] . '" class="title_image" value="'.htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ).'" /><input class="upload_button" type="button" value="Upload file"></div>';
									break;
								}
								case "selectbox-sidebar": {
										// Selectbox
										echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
										
										echo '<select name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '">';
										echo '<option value=""></option>';
										foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
											if(isUserMadeSidebar(ucwords($sidebar['name']))){
										?>
												
												 <option value="<?php echo ucwords( $sidebar['id'] ); ?>" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == ucwords( $sidebar['id'] ) ) { ?> selected="selected" <?php } ?>>
														<?php echo ucwords( $sidebar['name'] ); ?>
												 </option>
												 
										<?php	}
											}
										echo '</select>';
									
									break;
								}
								case "datepicker": {
									// Datepicker
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<input type="text" class="datepicker" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '" />';
									
									break;
								}
								case "textarea":
								case "wysiwyg": {
									// Text area
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<textarea name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" columns="30" rows="3">' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '</textarea>';
									// WYSIWYG
									if ( $customField[ 'type' ] == "wysiwyg" ) { ?>
										<script type="text/javascript">
											jQuery( document ).ready( function() {
												jQuery( "<?php echo $this->prefix . $customField[ 'name' ]; ?>" ).addClass( "mceEditor" );
												if ( typeof( tinyMCE ) == "object" && typeof( tinyMCE.execCommand ) == "function" ) {
													tinyMCE.execCommand( "mceAddControl", false, "<?php echo $this->prefix . $customField[ 'name' ]; ?>" );
												}
											});
										</script>
									<?php }
									break;
								}
								case "selectbox-content-animation": {
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'" style="display:inline;"><b>' . $customField[ 'title' ] . '</b></label>&nbsp;&nbsp;';
									echo '<select name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '"> ';
									?>
										<option value="" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "" ) { ?> selected="selected" <?php } ?>></option>
										<option value="no" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "no" ) { ?> selected="selected" <?php } ?>>No</option>
										<option value="yes" <?php if (get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) == "yes" ) { ?> selected="selected" <?php } ?>>Yes</option>
									<?php 
									echo '</select>';
									
									break;
								}
								default: {
									// Plain text field
									echo '<label for="' . $this->prefix . $customField[ 'name' ] .'"><b>' . $customField[ 'title' ] . '</b></label>';
									echo '<input type="text" name="' . $this->prefix . $customField[ 'name' ] . '" id="' . $this->prefix . $customField[ 'name' ] . '" value="' . htmlspecialchars( get_post_meta( $post->ID, $this->prefix . $customField[ 'name' ], true ) ) . '" />';
									break;
								}
							}
							?>
							<?php if ( $customField[ 'description' ] ) echo '<p>' . $customField[ 'description' ] . '</p>'; ?>
						</div>
					<?php
					}
				} ?>
			</div>
			<?php
		}	/**
		* Display the new Custom Fields meta box
		*/
		function displayCustomSeo() {
			global $post;
			?>
			<div class="form-wrap">
			<div class="input form-field">
					<?php
					$seo_title = get_post_meta( $post->ID, $this->prefix . 'seo_title', true );
					?>
				<label for="seo_title"><b>SEO Title</b></label>
				<input id="seo_title" class="seo_title" type="text" value="<?php echo $seo_title; ?>" name="seo_title">
			</div>
			<div class="input form-field">
					<?php
					$seo_keywords = get_post_meta( $post->ID, $this->prefix . 'seo_keywords', true );
					?>
				<label for="seo_keywords"><b>SEO Keywords</b></label>
				<input id="seo_keywords" class="seo_keywords" type="text" value="<?php echo $seo_keywords; ?>" name="seo_keywords">
			</div>		
			<div class="input form-field">
					<?php
					$seo_description = get_post_meta( $post->ID, $this->prefix . 'seo_description', true );
					?>
				<label for="seo_description"><b>SEO Description</b></label>
				<textarea id="seo_description" class="seo_description" name="seo_description"><?php echo $seo_description; ?></textarea>
			</div>		
					

					

			
		</div>
			<?php
		}
		
		

		function displayCustomParallax() {
			global $post;
			?>
			<div class="form-wrap">
					<div class="hidden_parallax">
						<div class="input form-field">
							<label for=""><b>Unique ID</b></label>
							<input type="text" id="imageid_x" name="imageid_x" class="imageid" size="10" />
						</div>
						<div class="input form-field">
							<label for=""><b>Image</b></label>
							<input type="text" id="parimg_x" name="parimg_x" class="parallax_image" />
							<input class="upload_button" type="button" value="Upload file">
						</div>
						<div class="input form-field">
							<label for=""><b>Background color</b></label>
							<div class="colorSelector"><div style=""></div></div>
							<input type="text" id="parcolor_x" name="parcolor_x" class="parallax_color" value="" />
						</div>
						
					</div>
					<div class="add_parallax">
<?php
$no = 1;
$parallaxes = get_post_meta( $post->ID, $this->prefix . 'parallaxes', true );
while (isset($parallaxes[$no-1])) {
	$parallax = $parallaxes[$no-1];
?>
				
<div class="parallax" rel="<?php echo $no; ?>" style="display: block;">
<h3>Parallax section</h3>
<div class="parallax_inner">
<div class="input form-field">
<label for="imageid_<?php echo $no; ?>"><b>Unique ID</b></label>
<input id="imageid_<?php echo $no; ?>" type="text" name="imageid[]" class="imageid" value="<?php echo stripslashes($parallax['imageid']); ?>" size="10" />
</div>
<div class="input form-field">
<label for="parimg_<?php echo $no; ?>"><b>Image</b></label>
<input id="parimg_<?php echo $no; ?>" type="text" name="parimg[]" class="parallax_image" value="<?php echo stripslashes($parallax['parimg']); ?>">
<input class="upload_button" type="button" value="Upload file">
</div>
<div class="input form-field">
	<label for=""><b>Background color</b></label>
	<div class="colorSelector"><div style="background-color:<?php echo stripslashes($parallax['parcolor']); ?>;"></div></div>
	<input type="text" id="parcolor_<?php echo $no; ?>" name="parcolor[]" value="<?php echo stripslashes($parallax['parcolor']); ?>" class="parallax_color" />
</div>

<a class="remove_parallax" href="/" onclick="javascript: return false;">Remove parallax section</a>
</div>
</div>
					
			
<?php
	$no++;
}
?>
				<a class="add_parallax" onclick="javascript: return false;" href="/" >Add parallax section</a>
			</div>
		</div>
			<?php
		}
		
		function displayCustomPortfolio() {
			global $post;
			?>
			<div class="form-wrap">
					<div class="hidden_portfolio_images">
						<div class="input form-field">
							<label><b>Order number</b></label>
							<input class="ordernumber" type="text" id="portfolioimgordernumber_x" name="portfolioimgordernumber_x" size="10" />
						</div>
						<div class="input form-field">
							<label for=""><b>Image/Video title (only for gallery layout - Portfolio Style 6)</b></label>
							<input type="text" name="portfoliotitle_x" id="portfoliotitle_x" class="portfoliotitle" />
						</div>
						<div class="input form-field">
							<label for=""><b>Image</b></label>
							<input type="text" id="portfolioimg_x" name="portfolioimg_x" class="portfolioimg" />
							<input class="upload_button" type="button" value="Upload file">
						</div>
						<div class="input form-field">
							<label for=""><b>Video type</b></label>
							<select name="portfoliovideotype_x" id="portfoliovideotype_x">
								<option value=""></option>
								<option value="youtube">Youtube</option>
								<option value="vimeo">Vimeo</option>
							</select>
						</div>
						<div class="input form-field">
							<label for=""><b>Video ID</b></label>
							<input type="text" name="portfoliovideoid_x" id="portfoliovideoid_x" class="portfoliovideoid" />
						</div>
					</div>
					
					<div class="hidden_portfolio">
						<div class="input form-field">
							<label><b>Order number</b></label>
							<input class="ordernumber" type="text" id="optionlabelordernumber_x" name="optionlabelordernumber_x" size="10" />
						</div>
						<div class="input form-field">
							<label for=""><b>Option Label</b></label>
							<input type="text" id="optionLabel_x" name="optionLabel_x" />
						</div>
						<div class="input form-field">
							<label for=""><b>Option Value</b></label>
							<textarea rows="8" cols="40" id="optionValue_x" name="optionValue_x"></textarea>
						</div>						
						<div class="input form-field">
							<label for=""><b>Option Url</b></label>
							<input type="text" id="optionUrl_x" name="optionUrl_x" />
						</div>	
						
					</div>
					
<div class="add_portfolio_images">
<h3>Portfolio images/videos</h3>
<div class="add_portfolio_images_inner">
<?php
$no = 1;
$portfolio_images = get_post_meta( $post->ID, $this->prefix . 'portfolio_images', true );
if (count($portfolio_images)>1) {
	usort($portfolio_images, "comparePortfolioImages");
}
while (isset($portfolio_images[$no-1])) {
	$portfolio_image = $portfolio_images[$no-1];
?>
				
<div class="portfolio_image" rel="<?php echo $no; ?>" style="display: block;">
<div class="input form-field">
<label for="portfolioimgordernumber_<?php echo $no; ?>"><b>Order number</b></label>
<input id="portfolioimgordernumber_<?php echo $no; ?>" type="text" name="portfolioimgordernumber[]" value="<?php echo isset($portfolio_image['portfolioimgordernumber'])?stripslashes($portfolio_image['portfolioimgordernumber']):""; ?>" class="ordernumber" />
</div>
<div class="input form-field">
<label for="portfoliotitle_<?php echo $no; ?>"><b>Image/Video title (only for gallery layout - Portfolio Style 6)</b></label>
<input id="portfoliotitle_<?php echo $no; ?>" type="text" name="portfoliotitle[]" value="<?php echo isset($portfolio_image['portfoliotitle'])?stripslashes($portfolio_image['portfoliotitle']):""; ?>" class="portfoliotitle" />
</div>
<div class="input form-field">
<label for="portfolioimg_<?php echo $no; ?>"><b>Image</b></label>
<input id="portfolioimg_<?php echo $no; ?>" type="text" name="portfolioimg[]" value="<?php echo stripslashes($portfolio_image['portfolioimg']); ?>" class="portfolioimg" />
<input class="upload_button" type="button" value="Upload file">
</div>
<div class="input form-field">
	<label for="portfoliovideotype_<?php echo $no; ?>"><b>Video type</b></label>
	<select name="portfoliovideotype[]" id="portfoliovideotype_<?php echo $no; ?>">
		<option value=""></option>
		<option <?php if(isset($portfolio_image['portfoliovideotype'])){ if($portfolio_image['portfoliovideotype'] == "youtube") echo "selected='selected'"; } ?> value="youtube">Youtube</option>
		<option <?php if(isset($portfolio_image['portfoliovideotype'])){ if($portfolio_image['portfoliovideotype'] == "vimeo") echo "selected='selected'"; } ?> value="vimeo">Vimeo</option>
	</select>
</div>
<div class="input form-field">
<label for="portfoliovideoid_<?php echo $no; ?>"><b>Video ID</b></label>
<input id="portfoliovideoid_<?php echo $no; ?>" type="text" name="portfoliovideoid[]" value="<?php echo isset($portfolio_image['portfoliovideoid'])?stripslashes($portfolio_image['portfoliovideoid']):""; ?>" class="portfoliovideoid" />
</div>
<a class="remove_image" href="/" onclick="javascript: return false;">Remove portfolio image/video</a>
</div>

					
			
<?php
	$no++;
}
?>
				<a class="add_image" onclick="javascript: return false;" href="/" >Add portfolio image/video</a>
</div>
</div>
					
<div class="add_portfolios">
<h3>Option Items</h3>
<div class="add_portfolios_inner">
<?php
$no = 1;
$portfolios = get_post_meta( $post->ID, $this->prefix . 'portfolios', true );
if (count($portfolios)>1) {
	usort($portfolios, "comparePortfolioOptions");
}
while (isset($portfolios[$no-1])) {
	$portfolio = $portfolios[$no-1];
?>
				
<div class="portfolio" rel="<?php echo $no; ?>" style="display: block;">
<div class="input form-field">
<label for="optionlabelordernumber_<?php echo $no; ?>"><b>Order number</b></label>
<input id="optionlabelordernumber_<?php echo $no; ?>" type="text" name="optionlabelordernumber[]" value="<?php echo isset($portfolio['optionlabelordernumber'])?stripslashes($portfolio['optionlabelordernumber']):""; ?>" class="ordernumber" />
</div>
<div class="input form-field">
<label for="optionLabel_<?php echo $no; ?>"><b>Option Label</b></label>
<input id="optionLabel_<?php echo $no; ?>" type="text" name="optionLabel[]" value="<?php echo stripslashes($portfolio['optionLabel']); ?>">
</div>
<div class="input form-field">
<label for="optionValue_<?php echo $no; ?>"><b>Option Value</b></label>
<textarea id="optionValue_<?php echo $no; ?>" name="optionValue[]" cols="40" rows="8"><?php echo stripslashes($portfolio['optionValue']); ?></textarea>
</div>
<div class="input form-field">
<label for="optionUrl_<?php echo $no; ?>"><b>Option Value</b></label>
<input id="optionUrl_<?php echo $no; ?>" type="text" name="optionUrl[]" value="<?php echo stripslashes($portfolio['optionUrl']); ?>">
</div>

<a class="remove_option" href="/" onclick="javascript: return false;">Remove portfolio option</a>
</div>


					
			
<?php
	$no++;
}
?>
				<a class="add_option" onclick="javascript: return false;" href="/" >Add portfolio option</a>
</div>
</div>
			<div class="input form-field">
<?php
$portfolio_date = get_post_meta( $post->ID, $this->prefix . 'portfolio_date', true );
?>
				<label for="portfolio_date<?php echo $no; ?>"><b>Portfolio Date</b></label>
				<input id="portfolio_date" class="datepicker" type="text" value="<?php echo $portfolio_date; ?>" name="portfolio_date">
			</div>
		</div>
			<?php
		}
		
		/**
		* Save the new Custom Fields values
		*/
		function saveCustomFields( $post_id, $post ) {
			if ( !isset( $_POST[ 'my-custom-fields_wpnonce' ] ) || !wp_verify_nonce( $_POST[ 'my-custom-fields_wpnonce' ], 'my-custom-fields' ) )
				return;
			if ( !current_user_can( 'edit_post', $post_id ) )
				return;
			if ( ! in_array( $post->post_type, $this->postTypes ) )
				return;
			foreach ( $this->customFields as $customField ) {
				if ( current_user_can( $customField['capability'], $post_id ) ) {
					if ( isset( $_POST[ $this->prefix . $customField['name'] ] ) && trim( $_POST[ $this->prefix . $customField['name'] ] ) ) {
						$value = $_POST[ $this->prefix . $customField['name'] ];
						// Auto-paragraphs for any WYSIWYG
						if ( $customField['type'] == "wysiwyg" ) $value = wpautop( $value );
						update_post_meta( $post_id, $this->prefix . $customField[ 'name' ], $value );
					} else {
						delete_post_meta( $post_id, $this->prefix . $customField[ 'name' ] );
					}
				}
			}
			
			
			$sliders = false;
			if (isset($_POST['title'])) {
			if (is_array($_POST['title'])) {
			foreach ($_POST['title'] as $key => $value) {
				$sliders_val[$key] = array('unique'=>$_POST['unique'][$key]);
				foreach ($_POST['title'][$key] as $key1 => $value1) {
					$sliders_val[$key][$key1] = array('ordernumber'=>$_POST['ordernumber'][$key][$key1],'toplabel'=>$_POST['toplabel'][$key][$key1],'title'=>$value1,'img'=>$_POST['img'][$key][$key1],'link'=>$_POST['link'][$key][$key1],'linklabel'=>$_POST['linklabel'][$key][$key1],'description'=>$_POST['description'][$key][$key1],'descposition'=>$_POST['descposition'][$key][$key1],'color'=>$_POST['color'][$key][$key1],'titlecolor'=>$_POST['titlecolor'][$key][$key1],'linkcolor'=>$_POST['linkcolor'][$key][$key1]);
					$sliders = true;
				}
			}
			}
			}
			
			 if ( current_user_can( $customField['capability'], $post_id ) ) {
						if ($sliders) {
								update_post_meta( $post_id, $this->prefix . 'sliders', $sliders_val );
						} else {
								delete_post_meta( $post_id, $this->prefix . 'sliders' );
						}
				}
				
			$parallaxes = false;
			if (isset($_POST['imageid'])) {
			foreach ($_POST['imageid'] as $key => $value) {
					$parallaxes_val[$key] = array('imageid'=>$value,'parimg'=>$_POST['parimg'][$key],'parcolor'=>$_POST['parcolor'][$key]);
					$parallaxes = true;
				
			}
			}
			
			 if ( current_user_can( $customField['capability'], $post_id ) ) {
						if ($parallaxes) {
								update_post_meta( $post_id, $this->prefix . 'parallaxes', $parallaxes_val );
						} else {
								delete_post_meta( $post_id, $this->prefix . 'parallaxes' );
						}
				}
				
			$portfolios = false;
			if (isset($_POST['optionLabel'])) {
			foreach ($_POST['optionLabel'] as $key => $value) {
					$portfolios_val[$key] = array('optionLabel'=>$value,'optionValue'=>$_POST['optionValue'][$key],'optionUrl'=>$_POST['optionUrl'][$key],'optionlabelordernumber'=>$_POST['optionlabelordernumber'][$key]); 
					$portfolios = true;
				
			}
			}
			
			
			 if ( current_user_can( $customField['capability'], $post_id ) ) {
						if ($portfolios) {
								update_post_meta( $post_id, $this->prefix . 'portfolios', $portfolios_val );
						} else {
								delete_post_meta( $post_id, $this->prefix . 'portfolios' );
						}
				}
				
			$portfolio_images = false;
			if (isset($_POST['portfolioimg'])) {
			foreach ($_POST['portfolioimg'] as $key => $value) {
					$portfolio_images_val[$key] = array('portfolioimg'=>$_POST['portfolioimg'][$key],'portfoliotitle'=>$_POST['portfoliotitle'][$key],'portfolioimgordernumber'=>$_POST['portfolioimgordernumber'][$key], 'portfoliovideotype'=>$_POST['portfoliovideotype'][$key], 'portfoliovideoid'=>$_POST['portfoliovideoid'][$key] );
					$portfolio_images = true;
				
			}
			}
			
			
			 if ( current_user_can( $customField['capability'], $post_id ) ) {
						if ($portfolio_images) {
								update_post_meta( $post_id, $this->prefix . 'portfolio_images', $portfolio_images_val );
						} else {
								delete_post_meta( $post_id, $this->prefix . 'portfolio_images' );
						}
				}
				

			$portfolio_date = "";
			if (isset($_POST['portfolio_date']))
				$portfolio_date = $_POST['portfolio_date'];
			 if ( current_user_can( $customField['capability'], $post_id ) ) {
						if ($portfolio_date) {
								update_post_meta( $post_id, $this->prefix . 'portfolio_date', $portfolio_date );
						} else {
								delete_post_meta( $post_id, $this->prefix . 'portfolio_date' );
						}
				}
				
			$seo_title = $_POST['seo_title'];
			$seo_description = $_POST['seo_description'];
			$seo_keywords = $_POST['seo_keywords'];
			if ( current_user_can( $customField['capability'], $post_id ) ) {
				if ($seo_title) {
						update_post_meta( $post_id, $this->prefix . 'seo_title', $seo_title );
				} else {
						delete_post_meta( $post_id, $this->prefix . 'seo_title' );
				}
				if ($seo_description) {
					update_post_meta( $post_id, $this->prefix . 'seo_description', $seo_description );
				} else {
					 delete_post_meta( $post_id, $this->prefix . 'seo_description' );
				}
				if ($seo_keywords) {
					update_post_meta( $post_id, $this->prefix . 'seo_keywords', $seo_keywords );
				} else {
					delete_post_meta( $post_id, $this->prefix . 'seo_keywords' );
				}
			 }
		}
		
		

		

	} // End Class

} // End if class exists statement

// Instantiate the class
if ( class_exists('myCustomFields') ) {
	$myCustomFields_var = new myCustomFields();
}
?>