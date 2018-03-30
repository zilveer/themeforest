<?php
/** 
 * Builder Page
 *
 * @description Main admin UI settings page
 * @package Aqua Page Builder
 *
 */
 
// Debugging
if(isset($_POST) && $this->args['debug'] == true) {
	echo '<pre>';
	print_r($_POST);
	echo '</pre>';
}

// Permissions Check
if ( ! current_user_can('edit_theme_options') )
	wp_die( __( 'Cheatin&#8217; uh?' , 'bold' ) );
	
$messages = array();

// Get selected template id
$selected_template_id = isset($_REQUEST['template']) ? (int) $_REQUEST['template'] : 0;

// Actions
$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'edit';
$template = isset($_REQUEST['template']) ? $_REQUEST['template'] : 0;

// DEBUG
//echo '<pre>';
//print_r($_POST);
//echo '</pre>';

// Template title & layout
$template_name = isset($_REQUEST['template-name']) && !empty($_REQUEST['template-name']) ? htmlspecialchars($_REQUEST['template-name']) : 'No Title';

// Get all templates
$templates = $this->get_templates();

// Get recently edited template
$recently_edited_template = (int) get_user_option( 'recently_edited_template' );

if( ! isset( $_REQUEST['template'] ) && $recently_edited_template && $this->is_template( $recently_edited_template )) {
	$selected_template_id = $recently_edited_template;
} elseif ( ! isset( $_REQUEST['template'] ) && $selected_template_id == 0 && !empty($templates)) {
	$selected_template_id = $templates[0]->ID;
}

//define selected template object
$selected_template_object = get_post($selected_template_id);

// saving action
switch($action) {

	case 'rd_duplicate_post_as_draft' :
		
		global $wpdb;
	
		/*
		 * get the original post id
		 */
		$post_id = $selected_template_id;
		/*
		 * and all the original post data then
		 */
		$post = get_post($selected_template_id);
	
		/*
		 * if you don't want current user to be the new post author,
		 * then change next couple of lines to this: $new_post_author = $post->post_author;
		 */
		$current_user = wp_get_current_user();
		$new_post_author = $current_user->ID;
	
		/*
		 * if post data exists, create the post duplicate
		 */
		if (isset( $post ) && $post != null) {
	
			/*
			 * new post data array
			 */
			$args = array(
				'comment_status' => $post->comment_status,
				'ping_status'    => $post->ping_status,
				'post_author'    => $new_post_author,
				'post_content'   => $post->post_content,
				'post_excerpt'   => $post->post_excerpt,
				'post_name'      => $post->post_name,
				'post_parent'    => $post->post_parent,
				'post_password'  => $post->post_password,
				'post_status'    => 'publish',
				'post_title'     => $post->post_title . ' New',
				'post_type'      => 'template',
				'to_ping'        => $post->to_ping,
				'menu_order'     => $post->menu_order
			);
	
			/*
			 * insert the post by wp_insert_post() function
			 */
			$new_post_id = wp_insert_post( $args );
	
			/*
			 * get all current post terms ad set them to the new post draft
			 */
			$taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
			foreach ($taxonomies as $taxonomy) {
				$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
				wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
			}
	
			/*
			 * duplicate all post meta
			 */
			$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
			if (count($post_meta_infos)!=0) {
				$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
				foreach ($post_meta_infos as $meta_info) {
					$meta_key = $meta_info->meta_key;
					$meta_value = addslashes($meta_info->meta_value);
					$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
				}
				$sql_query.= implode(" UNION ALL ", $sql_query_sel);
				$wpdb->query($sql_query);
			}
			
			//refresh templates var
			$templates = $this->get_templates();
			$selected_template_object = get_post($selected_template_id);
			
		} else {
			wp_die('Post creation failed, could not find original post: ' . $post_id);
		}
			
		break;

	case 'create' :
		
		$new_id = $this->create_template($template_name);
		
		if(!is_wp_error($new_id)) {
			$selected_template_id = $new_id;
		
			//refresh templates var
			$templates = $this->get_templates();
			$selected_template_object = get_post($selected_template_id);
			
			$messages[] = '<div id="message" class="updated"><p>' . __('The ', 'bold') . '<strong>' . $template_name . '</strong>' . __(' page template has been successfully created', 'bold') . '</p></div>';
		} else {
			$errors = '<ul>';
			foreach( $new_id->get_error_messages() as $error ) {
				$errors .= '<li><strong>'. $error . '</strong></li>';
			}
			$errors .= '</ul>';
			
			$messages[] = '<div id="message" class="error"><p>' . __('Sorry, the operation was unsuccessful for the following reason(s): ', 'framework') . '</p>' . $errors . '</div>';
		}
		
		break;
		
	case 'update' :
	
		$blocks = isset($_REQUEST['aq_blocks']) ? $_REQUEST['aq_blocks'] : '';
		
		$this->update_template($selected_template_id, $blocks, $template_name);
		
		//refresh templates var
		$templates = $this->get_templates();
		$selected_template_object = get_post($selected_template_id);
		
		$messages[] = '<div id="message" class="updated"><p>' . __('The ', 'framework') . '<strong>' . $template_name . '</strong>' . __(' page template has been updated', 'framework') . '</p></div>';
		break;
		
	case 'delete' :
		
		$this->delete_template($selected_template_id);
		
		//refresh templates var
		$templates = $this->get_templates();
		$selected_template_id =	!empty($templates) ? $templates[0]->ID : 0;
		$selected_template_object = get_post($selected_template_id);
		
		$messages[] = '<div id="message" class="updated"><p>' . __('The template has been successfully deleted', 'framework') . '</p></div>';
		break;
}

global $current_user;
update_user_option($current_user->ID, 'recently_edited_template', $selected_template_id);

//display admin notices & messages
if(!empty($messages)) foreach($messages as $message) { echo $message; }

//disable blocks archive if no template
$disabled = $selected_template_id === 0 ? 'metabox-holder-disabled' : '';

?>

<div class="wrap">
	<div id="icon-themes" class="icon32"><br/></div>
	<h2><?php echo $this->args['page_title'] ?></h2>
	
	<div id="page-builder-frame">
	
		<div id="page-builder-column" class="metabox-holder <?php echo $disabled ?>">
			<div id="page-builder-archive" class="postbox">
				<h3 class="hndle"><span><?php _e('Available Blocks', 'framework') ?></span><span id="removing-block"><?php _e('Deleting', 'framework') ?></span></h3>
				<div class="inside">
					<ul id="blocks-archive" class="clearfix">
						<?php $this->blocks_archive() ?>
					</ul>
					<p><?php _e('Need help? Use the Help tab in the upper right of your screen.', 'framework') ?></p>
				</div>
			</div>
		</div>
	
		<div id="page-builder-fixed">
			<div id="page-builder">
				<div class="aqpb-tabs-nav">
				
					<div class="aqpb-tabs-arrow aqpb-tabs-arrow-left">
						<a>&laquo;</a>
					</div>
					
					<div class="aqpb-tabs-wrapper">
						<div class="aqpb-tabs">
							
							<?php
							foreach ( (array) $templates as $template ) {
								if($selected_template_id == $template->ID) {
									echo '<span id="template_'.$template->ID.'" class="aqpb-tab aqpb-tab-active aqpb-tab-sortable">'. htmlspecialchars($template->post_title) .'</span>';
								} else {
									echo '<a id="template_'.$template->ID.'" class="aqpb-tab aqpb-tab-sortable" href="' . esc_url(add_query_arg(
										array(
											'page' => $this->args['page_slug'], 
											'action' => 'edit',
											'template' => $template->ID,
										),
										admin_url( 'themes.php' )
									)) . '">'. htmlspecialchars($template->post_title) .'</a>';
								}
							}
							?>
							
							<!--add new template button-->
							<?php if($selected_template_id == 0) { ?>
							<span class="aqpb-tab aqpb-tab-add aqpb-tab-active"><abbr title="Add Template">+</abbr></span>
							<?php } else { ?>
							<a class="aqpb-tab aqpb-tab-add" href="<?php
								echo esc_url(add_query_arg(
									array(
										'page' => $this->args['page_slug'], 
										'action' => 'edit',
										'template' => 0,
									),
									admin_url( 'themes.php' )
								));
							?>">
								<abbr title="Add Template">+</abbr>
							</a>
							<?php } ?>
							
						</div>
					</div>
					
					<div class="aqpb-tabs-arrow aqpb-tabs-arrow-right">
						<a>&raquo;</a>
					</div>
					
				</div>
				<div class="aqpb-wrap aqpbdiv">
					<form id="update-page-template" action="<?php echo $this->args['page_url'] ?>" method="post" enctype="multipart/form-data">
						<div id="aqpb-header">
							
								<div id="submitpost" class="submitbox">
									<div class="major-publishing-actions clearfix">
									
										<label class="open-label" for="template-name">
											<span><?php _e('Template Name', 'framework') ?></span>
											<input name="template-name" id="template-name" type="text" class="template-name regular-text" title="Enter template name here" placeholder="Enter template name here" value="<?php echo is_object($selected_template_object) ? $selected_template_object->post_title : ''; ?>">
										</label>
									
										
										<div class="publishing-action">
											<?php submit_button( empty( $selected_template_id ) ? __( 'Create Template', 'framework' ) : __( 'Save Template', 'bold' ), 'button-primary ', 'save_template', false, array( 'id' => 'save_template_header' ) ); ?>
										</div><!-- END .publishing-action -->
										
										<?php if(!empty($selected_template_id)) { ?>
										<div class="delete-action">
											<?php 
											echo '<a class="submitdelete deletion template-delete" href="' . esc_url(add_query_arg(
												array(
													'page' => $this->args['page_slug'], 
													'action' => 'delete',
													'template' => $selected_template_id,
													'_wpnonce' => wp_create_nonce('delete-template'),
												),
												admin_url( 'themes.php' )
											)) . '">'. __('Delete Template', 'bold') .'</a>';
											?>
										</div><!-- END .delete-action -->
										<?php } ?>
										
									</div><!-- END .major-publishing-actions -->
								</div><!-- END #submitpost .submitbox -->
								
								<?php 
								if($selected_template_id === 0) {
									wp_nonce_field( 'create-template', 'create-template-nonce' ); 
								} else {
									wp_nonce_field( 'update-template', 'update-template-nonce' );
								}
								?>	
								<input type="hidden" name="action" value="<?php echo empty( $selected_template_id ) ? 'create' : 'update' ?>"/>
								<input type="hidden" name="template" id="template" value="<?php echo $selected_template_id ?>"/>
								<input type="hidden" id="aqpb-nonce" name="aqpb-nonce" value="<?php echo wp_create_nonce('aqpb-settings-page-nonce') ?>"/>
							
						</div>
						
						<div id="aqpb-body">
							
							<ul class="blocks clearfix" id="blocks-to-edit">
								<?php 
								if($selected_template_id === 0) {
									echo '<p class="empty-template">';
									echo __('To create a custom page template, give it a name above and click Create Template. Then choose blocks like text, widgets or tabs &amp; toggles from the left column to add to this template.
									<br/><br/>
									You can drag and drop the blocks to put them in the order you want. Click on the small arrow at the corner of each block to reveal additional configuration options. You can also resize each block by clicking on either side of the block (Note that some blocks are not resizable)
									<br/><br/>
									When you have finished building your custom page template, make sure you click the Save Template button.', 'framework');
									echo '</p>';
									
									
								} else {
									$this->display_blocks($selected_template_id); 
								}
								?>
							</ul>
							
						</div>
						
						<div id="aqpb-footer">
							<div class="major-publishing-actions clearfix">
								<?php if(!empty($selected_template_id)) { ?>
								<div class="delete-action">
								<a id="duplicate" href="<?php echo 'themes.php?page=distinctive-page-builder&action=rd_duplicate_post_as_draft&template=' . $selected_template_id; ?>" title="Duplicate this item" rel="permalink" style="color: green; position: relative; top: 3px; left: 10px;">Duplicate Template</a>
								</div><!-- END .delete-action -->
								<?php } ?>
						
								<div id="template-shortcode">
									<input type="text" readonly="readonly" value='[template id="<?php echo $selected_template_id ?>"]' onclick="select()"/>
								</div>
						
							</div><!-- END .major-publishing-actions -->
						</div>
						
					</div>
				</form>
			</div>
			
		</div>
		
		
	</div>
</div>

<div id="icon-selector">
	<div class="demoicon"><span class="an-icon pe-7s-close"></span><span class="mls"> pe-7s-close</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-close-circle"></span><span class="mls"> pe-7s-close-circle</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-angle-up"></span><span class="mls"> pe-7s-angle-up</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-angle-up-circle"></span><span class="mls"> pe-7s-angle-up-circle</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-angle-right"></span><span class="mls"> pe-7s-angle-right</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-angle-right-circle"></span><span class="mls"> pe-7s-angle-right-circle</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-angle-left"></span><span class="mls"> pe-7s-angle-left</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-angle-left-circle"></span><span class="mls"> pe-7s-angle-left-circle</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-angle-down"></span><span class="mls"> pe-7s-angle-down</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-angle-down-circle"></span><span class="mls"> pe-7s-angle-down-circle</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-wallet"></span><span class="mls"> pe-7s-wallet</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-volume2"></span><span class="mls"> pe-7s-volume2</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-volume1"></span><span class="mls"> pe-7s-volume1</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-voicemail"></span><span class="mls"> pe-7s-voicemail</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-video"></span><span class="mls"> pe-7s-video</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-user"></span><span class="mls"> pe-7s-user</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-upload"></span><span class="mls"> pe-7s-upload</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-unlock"></span><span class="mls"> pe-7s-unlock</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-umbrella"></span><span class="mls"> pe-7s-umbrella</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-trash"></span><span class="mls"> pe-7s-trash</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-tools"></span><span class="mls"> pe-7s-tools</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-timer"></span><span class="mls"> pe-7s-timer</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-ticket"></span><span class="mls"> pe-7s-ticket</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-target"></span><span class="mls"> pe-7s-target</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-sun"></span><span class="mls"> pe-7s-sun</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-study"></span><span class="mls"> pe-7s-study</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-stopwatch"></span><span class="mls"> pe-7s-stopwatch</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-star"></span><span class="mls"> pe-7s-star</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-speaker"></span><span class="mls"> pe-7s-speaker</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-signal"></span><span class="mls"> pe-7s-signal</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-shuffle"></span><span class="mls"> pe-7s-shuffle</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-shopbag"></span><span class="mls"> pe-7s-shopbag</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-share"></span><span class="mls"> pe-7s-share</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-server"></span><span class="mls"> pe-7s-server</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-search"></span><span class="mls"> pe-7s-search</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-science"></span><span class="mls"> pe-7s-science</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-ribbon"></span><span class="mls"> pe-7s-ribbon</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-repeat"></span><span class="mls"> pe-7s-repeat</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-refresh"></span><span class="mls"> pe-7s-refresh</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-refresh-cloud"></span><span class="mls"> pe-7s-refresh-cloud</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-radio"></span><span class="mls"> pe-7s-radio</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-print"></span><span class="mls"> pe-7s-print</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-prev"></span><span class="mls"> pe-7s-prev</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-power"></span><span class="mls"> pe-7s-power</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-portfolio"></span><span class="mls"> pe-7s-portfolio</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-plus"></span><span class="mls"> pe-7s-plus</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-play"></span><span class="mls"> pe-7s-play</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-plane"></span><span class="mls"> pe-7s-plane</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-photo-gallery"></span><span class="mls"> pe-7s-photo-gallery</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-phone"></span><span class="mls"> pe-7s-phone</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-pen"></span><span class="mls"> pe-7s-pen</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-paper-plane"></span><span class="mls"> pe-7s-paper-plane</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-paint"></span><span class="mls"> pe-7s-paint</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-notebook"></span><span class="mls"> pe-7s-notebook</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-note"></span><span class="mls"> pe-7s-note</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-next"></span><span class="mls"> pe-7s-next</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-news-paper"></span><span class="mls"> pe-7s-news-paper</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-musiclist"></span><span class="mls"> pe-7s-musiclist</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-music"></span><span class="mls"> pe-7s-music</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-mouse"></span><span class="mls"> pe-7s-mouse</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-more"></span><span class="mls"> pe-7s-more</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-moon"></span><span class="mls"> pe-7s-moon</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-monitor"></span><span class="mls"> pe-7s-monitor</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-micro"></span><span class="mls"> pe-7s-micro</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-menu"></span><span class="mls"> pe-7s-menu</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-map"></span><span class="mls"> pe-7s-map</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-map-marker"></span><span class="mls"> pe-7s-map-marker</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-mail"></span><span class="mls"> pe-7s-mail</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-mail-open"></span><span class="mls"> pe-7s-mail-open</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-mail-open-file"></span><span class="mls"> pe-7s-mail-open-file</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-magnet"></span><span class="mls"> pe-7s-magnet</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-loop"></span><span class="mls"> pe-7s-loop</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-look"></span><span class="mls"> pe-7s-look</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-lock"></span><span class="mls"> pe-7s-lock</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-lintern"></span><span class="mls"> pe-7s-lintern</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-link"></span><span class="mls"> pe-7s-link</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-like"></span><span class="mls"> pe-7s-like</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-light"></span><span class="mls"> pe-7s-light</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-less"></span><span class="mls"> pe-7s-less</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-keypad"></span><span class="mls"> pe-7s-keypad</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-junk"></span><span class="mls"> pe-7s-junk</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-info"></span><span class="mls"> pe-7s-info</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-home"></span><span class="mls"> pe-7s-home</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-help2"></span><span class="mls"> pe-7s-help2</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-help1"></span><span class="mls"> pe-7s-help1</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-graph3"></span><span class="mls"> pe-7s-graph3</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-graph2"></span><span class="mls"> pe-7s-graph2</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-graph1"></span><span class="mls"> pe-7s-graph1</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-graph"></span><span class="mls"> pe-7s-graph</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-global"></span><span class="mls"> pe-7s-global</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-gleam"></span><span class="mls"> pe-7s-gleam</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-glasses"></span><span class="mls"> pe-7s-glasses</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-gift"></span><span class="mls"> pe-7s-gift</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-folder"></span><span class="mls"> pe-7s-folder</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-flag"></span><span class="mls"> pe-7s-flag</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-filter"></span><span class="mls"> pe-7s-filter</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-file"></span><span class="mls"> pe-7s-file</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-expand1"></span><span class="mls"> pe-7s-expand1</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-exapnd2"></span><span class="mls"> pe-7s-exapnd2</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-edit"></span><span class="mls"> pe-7s-edit</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-drop"></span><span class="mls"> pe-7s-drop</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-drawer"></span><span class="mls"> pe-7s-drawer</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-download"></span><span class="mls"> pe-7s-download</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-display2"></span><span class="mls"> pe-7s-display2</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-display1"></span><span class="mls"> pe-7s-display1</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-diskette"></span><span class="mls"> pe-7s-diskette</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-date"></span><span class="mls"> pe-7s-date</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-cup"></span><span class="mls"> pe-7s-cup</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-culture"></span><span class="mls"> pe-7s-culture</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-crop"></span><span class="mls"> pe-7s-crop</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-credit"></span><span class="mls"> pe-7s-credit</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-copy-file"></span><span class="mls"> pe-7s-copy-file</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-config"></span><span class="mls"> pe-7s-config</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-compass"></span><span class="mls"> pe-7s-compass</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-comment"></span><span class="mls"> pe-7s-comment</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-coffee"></span><span class="mls"> pe-7s-coffee</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-cloud"></span><span class="mls"> pe-7s-cloud</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-clock"></span><span class="mls"> pe-7s-clock</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-check"></span><span class="mls"> pe-7s-check</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-chat"></span><span class="mls"> pe-7s-chat</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-cart"></span><span class="mls"> pe-7s-cart</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-camera"></span><span class="mls"> pe-7s-camera</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-call"></span><span class="mls"> pe-7s-call</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-calculator"></span><span class="mls"> pe-7s-calculator</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-browser"></span><span class="mls"> pe-7s-browser</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-box2"></span><span class="mls"> pe-7s-box2</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-box1"></span><span class="mls"> pe-7s-box1</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-bookmarks"></span><span class="mls"> pe-7s-bookmarks</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-bicycle"></span><span class="mls"> pe-7s-bicycle</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-bell"></span><span class="mls"> pe-7s-bell</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-battery"></span><span class="mls"> pe-7s-battery</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-ball"></span><span class="mls"> pe-7s-ball</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-back"></span><span class="mls"> pe-7s-back</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-attention"></span><span class="mls"> pe-7s-attention</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-anchor"></span><span class="mls"> pe-7s-anchor</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-albums"></span><span class="mls"> pe-7s-albums</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-alarm"></span><span class="mls"> pe-7s-alarm</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-airplay"></span><span class="mls"> pe-7s-airplay</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-cloud-upload"></span><span class="mls"> pe-7s-cloud-upload</span></div>
	<div class="demoicon"><span class="an-icon pe-7s-cloud-download"></span><span class="mls"> pe-7s-cloud-download</span></div>
	<div class="demoicon"><span class="an-icon el-icon-zoom-out"></span><span class="mls"> el-icon-zoom-out</span></div>
	<div class="demoicon"><span class="an-icon el-icon-zoom-in"></span><span class="mls"> el-icon-zoom-in</span></div>
	<div class="demoicon"><span class="an-icon el-icon-youtube"></span><span class="mls"> el-icon-youtube</span></div>
	<div class="demoicon"><span class="an-icon el-icon-wrench-alt"></span><span class="mls"> el-icon-wrench-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-wrench"></span><span class="mls"> el-icon-wrench</span></div>
	<div class="demoicon"><span class="an-icon el-icon-wordpress"></span><span class="mls"> el-icon-wordpress</span></div>
	<div class="demoicon"><span class="an-icon el-icon-wheelchair"></span><span class="mls"> el-icon-wheelchair</span></div>
	<div class="demoicon"><span class="an-icon el-icon-website-alt"></span><span class="mls"> el-icon-website-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-website"></span><span class="mls"> el-icon-website</span></div>
	<div class="demoicon"><span class="an-icon el-icon-warning-sign"></span><span class="mls"> el-icon-warning-sign</span></div>
	<div class="demoicon"><span class="an-icon el-icon-w3c"></span><span class="mls"> el-icon-w3c</span></div>
	<div class="demoicon"><span class="an-icon el-icon-volume-up"></span><span class="mls"> el-icon-volume-up</span></div>
	<div class="demoicon"><span class="an-icon el-icon-volume-off"></span><span class="mls"> el-icon-volume-off</span></div>
	<div class="demoicon"><span class="an-icon el-icon-volume-down"></span><span class="mls"> el-icon-volume-down</span></div>
	<div class="demoicon"><span class="an-icon el-icon-vkontakte"></span><span class="mls"> el-icon-vkontakte</span></div>
	<div class="demoicon"><span class="an-icon el-icon-vimeo"></span><span class="mls"> el-icon-vimeo</span></div>
	<div class="demoicon"><span class="an-icon el-icon-view-mode"></span><span class="mls"> el-icon-view-mode</span></div>
	<div class="demoicon"><span class="an-icon el-icon-video-chat"></span><span class="mls"> el-icon-video-chat</span></div>
	<div class="demoicon"><span class="an-icon el-icon-video-alt"></span><span class="mls"> el-icon-video-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-video"></span><span class="mls"> el-icon-video</span></div>
	<div class="demoicon"><span class="an-icon el-icon-viadeo"></span><span class="mls"> el-icon-viadeo</span></div>
	<div class="demoicon"><span class="an-icon el-icon-user"></span><span class="mls"> el-icon-user</span></div>
	<div class="demoicon"><span class="an-icon el-icon-usd"></span><span class="mls"> el-icon-usd</span></div>
	<div class="demoicon"><span class="an-icon el-icon-upload"></span><span class="mls"> el-icon-upload</span></div>
	<div class="demoicon"><span class="an-icon el-icon-unlock-alt"></span><span class="mls"> el-icon-unlock-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-unlock"></span><span class="mls"> el-icon-unlock</span></div>
	<div class="demoicon"><span class="an-icon el-icon-universal-access"></span><span class="mls"> el-icon-universal-access</span></div>
	<div class="demoicon"><span class="an-icon el-icon-twitter"></span><span class="mls"> el-icon-twitter</span></div>
	<div class="demoicon"><span class="an-icon el-icon-tumblr"></span><span class="mls"> el-icon-tumblr</span></div>
	<div class="demoicon"><span class="an-icon el-icon-trash-alt"></span><span class="mls"> el-icon-trash-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-trash"></span><span class="mls"> el-icon-trash</span></div>
	<div class="demoicon"><span class="an-icon el-icon-torso"></span><span class="mls"> el-icon-torso</span></div>
	<div class="demoicon"><span class="an-icon el-icon-tint"></span><span class="mls"> el-icon-tint</span></div>
	<div class="demoicon"><span class="an-icon el-icon-time-alt"></span><span class="mls"> el-icon-time-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-time"></span><span class="mls"> el-icon-time</span></div>
	<div class="demoicon"><span class="an-icon el-icon-thumbs-up"></span><span class="mls"> el-icon-thumbs-up</span></div>
	<div class="demoicon"><span class="an-icon el-icon-thumbs-down"></span><span class="mls"> el-icon-thumbs-down</span></div>
	<div class="demoicon"><span class="an-icon el-icon-th-list"></span><span class="mls"> el-icon-th-list</span></div>
	<div class="demoicon"><span class="an-icon el-icon-th-large"></span><span class="mls"> el-icon-th-large</span></div>
	<div class="demoicon"><span class="an-icon el-icon-th"></span><span class="mls"> el-icon-th</span></div>
	<div class="demoicon"><span class="an-icon el-icon-text-width"></span><span class="mls"> el-icon-text-width</span></div>
	<div class="demoicon"><span class="an-icon el-icon-text-height"></span><span class="mls"> el-icon-text-height</span></div>
	<div class="demoicon"><span class="an-icon el-icon-tasks"></span><span class="mls"> el-icon-tasks</span></div>
	<div class="demoicon"><span class="an-icon el-icon-tags"></span><span class="mls"> el-icon-tags</span></div>
	<div class="demoicon"><span class="an-icon el-icon-tag"></span><span class="mls"> el-icon-tag</span></div>
	<div class="demoicon"><span class="an-icon el-icon-stumbleupon"></span><span class="mls"> el-icon-stumbleupon</span></div>
	<div class="demoicon"><span class="an-icon el-icon-stop-alt"></span><span class="mls"> el-icon-stop-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-stop"></span><span class="mls"> el-icon-stop</span></div>
	<div class="demoicon"><span class="an-icon el-icon-step-forward"></span><span class="mls"> el-icon-step-forward</span></div>
	<div class="demoicon"><span class="an-icon el-icon-step-backward"></span><span class="mls"> el-icon-step-backward</span></div>
	<div class="demoicon"><span class="an-icon el-icon-star-empty"></span><span class="mls"> el-icon-star-empty</span></div>
	<div class="demoicon"><span class="an-icon el-icon-star-alt"></span><span class="mls"> el-icon-star-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-star"></span><span class="mls"> el-icon-star</span></div>
	<div class="demoicon"><span class="an-icon el-icon-stackoverflow"></span><span class="mls"> el-icon-stackoverflow</span></div>
	<div class="demoicon"><span class="an-icon el-icon-spotify"></span><span class="mls"> el-icon-spotify</span></div>
	<div class="demoicon"><span class="an-icon el-icon-speaker"></span><span class="mls"> el-icon-speaker</span></div>
	<div class="demoicon"><span class="an-icon el-icon-soundcloud"></span><span class="mls"> el-icon-soundcloud</span></div>
	<div class="demoicon"><span class="an-icon el-icon-smiley-alt"></span><span class="mls"> el-icon-smiley-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-smiley"></span><span class="mls"> el-icon-smiley</span></div>
	<div class="demoicon"><span class="an-icon el-icon-slideshare"></span><span class="mls"> el-icon-slideshare</span></div>
	<div class="demoicon"><span class="an-icon el-icon-skype"></span><span class="mls"> el-icon-skype</span></div>
	<div class="demoicon"><span class="an-icon el-icon-signal"></span><span class="mls"> el-icon-signal</span></div>
	<div class="demoicon"><span class="an-icon el-icon-shopping-cart-sign"></span><span class="mls"> el-icon-shopping-cart-sign</span></div>
	<div class="demoicon"><span class="an-icon el-icon-shopping-cart"></span><span class="mls"> el-icon-shopping-cart</span></div>
	<div class="demoicon"><span class="an-icon el-icon-share-alt"></span><span class="mls"> el-icon-share-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-share"></span><span class="mls"> el-icon-share</span></div>
	<div class="demoicon"><span class="an-icon el-icon-search-alt"></span><span class="mls"> el-icon-search-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-search"></span><span class="mls"> el-icon-search</span></div>
	<div class="demoicon"><span class="an-icon el-icon-screenshot"></span><span class="mls"> el-icon-screenshot</span></div>
	<div class="demoicon"><span class="an-icon el-icon-screen-alt"></span><span class="mls"> el-icon-screen-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-screen"></span><span class="mls"> el-icon-screen</span></div>
	<div class="demoicon"><span class="an-icon el-icon-scissors"></span><span class="mls"> el-icon-scissors</span></div>
	<div class="demoicon"><span class="an-icon el-icon-rss"></span><span class="mls"> el-icon-rss</span></div>
	<div class="demoicon"><span class="an-icon el-icon-road"></span><span class="mls"> el-icon-road</span></div>
	<div class="demoicon"><span class="an-icon el-icon-reverse-alt"></span><span class="mls"> el-icon-reverse-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-retweet"></span><span class="mls"> el-icon-retweet</span></div>
	<div class="demoicon"><span class="an-icon el-icon-return-key"></span><span class="mls"> el-icon-return-key</span></div>
	<div class="demoicon"><span class="an-icon el-icon-resize-vertical"></span><span class="mls"> el-icon-resize-vertical</span></div>
	<div class="demoicon"><span class="an-icon el-icon-resize-small"></span><span class="mls"> el-icon-resize-small</span></div>
	<div class="demoicon"><span class="an-icon el-icon-resize-horizontal"></span><span class="mls"> el-icon-resize-horizontal</span></div>
	<div class="demoicon"><span class="an-icon el-icon-resize-full"></span><span class="mls"> el-icon-resize-full</span></div>
	<div class="demoicon"><span class="an-icon el-icon-repeat-alt"></span><span class="mls"> el-icon-repeat-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-repeat"></span><span class="mls"> el-icon-repeat</span></div>
	<div class="demoicon"><span class="an-icon el-icon-remove-sign"></span><span class="mls"> el-icon-remove-sign</span></div>
	<div class="demoicon"><span class="an-icon el-icon-remove-circle"></span><span class="mls"> el-icon-remove-circle</span></div>
	<div class="demoicon"><span class="an-icon el-icon-remove"></span><span class="mls"> el-icon-remove</span></div>
	<div class="demoicon"><span class="an-icon el-icon-refresh"></span><span class="mls"> el-icon-refresh</span></div>
	<div class="demoicon"><span class="an-icon el-icon-reddit"></span><span class="mls"> el-icon-reddit</span></div>
	<div class="demoicon"><span class="an-icon el-icon-record"></span><span class="mls"> el-icon-record</span></div>
	<div class="demoicon"><span class="an-icon el-icon-random"></span><span class="mls"> el-icon-random</span></div>
	<div class="demoicon"><span class="an-icon el-icon-quotes-alt"></span><span class="mls"> el-icon-quotes-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-quotes"></span><span class="mls"> el-icon-quotes</span></div>
	<div class="demoicon"><span class="an-icon el-icon-question-sign"></span><span class="mls"> el-icon-question-sign</span></div>
	<div class="demoicon"><span class="an-icon el-icon-question"></span><span class="mls"> el-icon-question</span></div>
	<div class="demoicon"><span class="an-icon el-icon-qrcode"></span><span class="mls"> el-icon-qrcode</span></div>
	<div class="demoicon"><span class="an-icon el-icon-puzzle"></span><span class="mls"> el-icon-puzzle</span></div>
	<div class="demoicon"><span class="an-icon el-icon-print"></span><span class="mls"> el-icon-print</span></div>
	<div class="demoicon"><span class="an-icon el-icon-podcast"></span><span class="mls"> el-icon-podcast</span></div>
	<div class="demoicon"><span class="an-icon el-icon-plus-sign"></span><span class="mls"> el-icon-plus-sign</span></div>
	<div class="demoicon"><span class="an-icon el-icon-plus"></span><span class="mls"> el-icon-plus</span></div>
	<div class="demoicon"><span class="an-icon el-icon-play-circle"></span><span class="mls"> el-icon-play-circle</span></div>
	<div class="demoicon"><span class="an-icon el-icon-play-alt"></span><span class="mls"> el-icon-play-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-play"></span><span class="mls"> el-icon-play</span></div>
	<div class="demoicon"><span class="an-icon el-icon-plane"></span><span class="mls"> el-icon-plane</span></div>
	<div class="demoicon"><span class="an-icon el-icon-pinterest"></span><span class="mls"> el-icon-pinterest</span></div>
	<div class="demoicon"><span class="an-icon el-icon-picture"></span><span class="mls"> el-icon-picture</span></div>
	<div class="demoicon"><span class="an-icon el-icon-picasa"></span><span class="mls"> el-icon-picasa</span></div>
	<div class="demoicon"><span class="an-icon el-icon-photo-alt"></span><span class="mls"> el-icon-photo-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-photo"></span><span class="mls"> el-icon-photo</span></div>
	<div class="demoicon"><span class="an-icon el-icon-phone-alt"></span><span class="mls"> el-icon-phone-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-phone"></span><span class="mls"> el-icon-phone</span></div>
	<div class="demoicon"><span class="an-icon el-icon-person"></span><span class="mls"> el-icon-person</span></div>
	<div class="demoicon"><span class="an-icon el-icon-pencil-alt"></span><span class="mls"> el-icon-pencil-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-pencil"></span><span class="mls"> el-icon-pencil</span></div>
	<div class="demoicon"><span class="an-icon el-icon-pause-alt"></span><span class="mls"> el-icon-pause-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-pause"></span><span class="mls"> el-icon-pause</span></div>
	<div class="demoicon"><span class="an-icon el-icon-path"></span><span class="mls"> el-icon-path</span></div>
	<div class="demoicon"><span class="an-icon el-icon-paper-clip-alt"></span><span class="mls"> el-icon-paper-clip-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-paper-clip"></span><span class="mls"> el-icon-paper-clip</span></div>
	<div class="demoicon"><span class="an-icon el-icon-opensource"></span><span class="mls"> el-icon-opensource</span></div>
	<div class="demoicon"><span class="an-icon el-icon-ok-sign"></span><span class="mls"> el-icon-ok-sign</span></div>
	<div class="demoicon"><span class="an-icon el-icon-ok-circle"></span><span class="mls"> el-icon-ok-circle</span></div>
	<div class="demoicon"><span class="an-icon el-icon-ok"></span><span class="mls"> el-icon-ok</span></div>
	<div class="demoicon"><span class="an-icon el-icon-off"></span><span class="mls"> el-icon-off</span></div>
	<div class="demoicon"><span class="an-icon el-icon-network"></span><span class="mls"> el-icon-network</span></div>
	<div class="demoicon"><span class="an-icon el-icon-myspace"></span><span class="mls"> el-icon-myspace</span></div>
	<div class="demoicon"><span class="an-icon el-icon-music"></span><span class="mls"> el-icon-music</span></div>
	<div class="demoicon"><span class="an-icon el-icon-move"></span><span class="mls"> el-icon-move</span></div>
	<div class="demoicon"><span class="an-icon el-icon-minus-sign"></span><span class="mls"> el-icon-minus-sign</span></div>
	<div class="demoicon"><span class="an-icon el-icon-minus"></span><span class="mls"> el-icon-minus</span></div>
	<div class="demoicon"><span class="an-icon el-icon-mic-alt"></span><span class="mls"> el-icon-mic-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-mic"></span><span class="mls"> el-icon-mic</span></div>
	<div class="demoicon"><span class="an-icon el-icon-map-marker-alt"></span><span class="mls"> el-icon-map-marker-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-map-marker"></span><span class="mls"> el-icon-map-marker</span></div>
	<div class="demoicon"><span class="an-icon el-icon-male"></span><span class="mls"> el-icon-male</span></div>
	<div class="demoicon"><span class="an-icon el-icon-magnet"></span><span class="mls"> el-icon-magnet</span></div>
	<div class="demoicon"><span class="an-icon el-icon-magic"></span><span class="mls"> el-icon-magic</span></div>
	<div class="demoicon"><span class="an-icon el-icon-lock-alt"></span><span class="mls"> el-icon-lock-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-lock"></span><span class="mls"> el-icon-lock</span></div>
	<div class="demoicon"><span class="an-icon el-icon-livejournal"></span><span class="mls"> el-icon-livejournal</span></div>
	<div class="demoicon"><span class="an-icon el-icon-list-alt"></span><span class="mls"> el-icon-list-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-list"></span><span class="mls"> el-icon-list</span></div>
	<div class="demoicon"><span class="an-icon el-icon-linkedin"></span><span class="mls"> el-icon-linkedin</span></div>
	<div class="demoicon"><span class="an-icon el-icon-link"></span><span class="mls"> el-icon-link</span></div>
	<div class="demoicon"><span class="an-icon el-icon-lines"></span><span class="mls"> el-icon-lines</span></div>
	<div class="demoicon"><span class="an-icon el-icon-leaf"></span><span class="mls"> el-icon-leaf</span></div>
	<div class="demoicon"><span class="an-icon el-icon-lastfm"></span><span class="mls"> el-icon-lastfm</span></div>
	<div class="demoicon"><span class="an-icon el-icon-laptop-alt"></span><span class="mls"> el-icon-laptop-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-laptop"></span><span class="mls"> el-icon-laptop</span></div>
	<div class="demoicon"><span class="an-icon el-icon-key"></span><span class="mls"> el-icon-key</span></div>
	<div class="demoicon"><span class="an-icon el-icon-italic"></span><span class="mls"> el-icon-italic</span></div>
	<div class="demoicon"><span class="an-icon el-icon-iphone-home"></span><span class="mls"> el-icon-iphone-home</span></div>
	<div class="demoicon"><span class="an-icon el-icon-instagram"></span><span class="mls"> el-icon-instagram</span></div>
	<div class="demoicon"><span class="an-icon el-icon-info-sign"></span><span class="mls"> el-icon-info-sign</span></div>
	<div class="demoicon"><span class="an-icon el-icon-indent-right"></span><span class="mls"> el-icon-indent-right</span></div>
	<div class="demoicon"><span class="an-icon el-icon-indent-left"></span><span class="mls"> el-icon-indent-left</span></div>
	<div class="demoicon"><span class="an-icon el-icon-inbox-box"></span><span class="mls"> el-icon-inbox-box</span></div>
	<div class="demoicon"><span class="an-icon el-icon-inbox-alt"></span><span class="mls"> el-icon-inbox-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-inbox"></span><span class="mls"> el-icon-inbox</span></div>
	<div class="demoicon"><span class="an-icon el-icon-idea-alt"></span><span class="mls"> el-icon-idea-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-idea"></span><span class="mls"> el-icon-idea</span></div>
	<div class="demoicon"><span class="an-icon el-icon-hourglass"></span><span class="mls"> el-icon-hourglass</span></div>
	<div class="demoicon"><span class="an-icon el-icon-home-alt"></span><span class="mls"> el-icon-home-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-home"></span><span class="mls"> el-icon-home</span></div>
	<div class="demoicon"><span class="an-icon el-icon-heart-empty"></span><span class="mls"> el-icon-heart-empty</span></div>
	<div class="demoicon"><span class="an-icon el-icon-heart-alt"></span><span class="mls"> el-icon-heart-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-heart"></span><span class="mls"> el-icon-heart</span></div>
	<div class="demoicon"><span class="an-icon el-icon-hearing-impaired"></span><span class="mls"> el-icon-hearing-impaired</span></div>
	<div class="demoicon"><span class="an-icon el-icon-headphones"></span><span class="mls"> el-icon-headphones</span></div>
	<div class="demoicon"><span class="an-icon el-icon-hdd"></span><span class="mls"> el-icon-hdd</span></div>
	<div class="demoicon"><span class="an-icon el-icon-hand-up"></span><span class="mls"> el-icon-hand-up</span></div>
	<div class="demoicon"><span class="an-icon el-icon-hand-right"></span><span class="mls"> el-icon-hand-right</span></div>
	<div class="demoicon"><span class="an-icon el-icon-hand-left"></span><span class="mls"> el-icon-hand-left</span></div>
	<div class="demoicon"><span class="an-icon el-icon-hand-down"></span><span class="mls"> el-icon-hand-down</span></div>
	<div class="demoicon"><span class="an-icon el-icon-guidedog"></span><span class="mls"> el-icon-guidedog</span></div>
	<div class="demoicon"><span class="an-icon el-icon-group-alt"></span><span class="mls"> el-icon-group-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-group"></span><span class="mls"> el-icon-group</span></div>
	<div class="demoicon"><span class="an-icon el-icon-graph-alt"></span><span class="mls"> el-icon-graph-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-graph"></span><span class="mls"> el-icon-graph</span></div>
	<div class="demoicon"><span class="an-icon el-icon-googleplus"></span><span class="mls"> el-icon-googleplus</span></div>
	<div class="demoicon"><span class="an-icon el-icon-globe-alt"></span><span class="mls"> el-icon-globe-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-globe"></span><span class="mls"> el-icon-globe</span></div>
	<div class="demoicon"><span class="an-icon el-icon-glasses"></span><span class="mls"> el-icon-glasses</span></div>
	<div class="demoicon"><span class="an-icon el-icon-glass"></span><span class="mls"> el-icon-glass</span></div>
	<div class="demoicon"><span class="an-icon el-icon-github-text"></span><span class="mls"> el-icon-github-text</span></div>
	<div class="demoicon"><span class="an-icon el-icon-github"></span><span class="mls"> el-icon-github</span></div>
	<div class="demoicon"><span class="an-icon el-icon-gift"></span><span class="mls"> el-icon-gift</span></div>
	<div class="demoicon"><span class="an-icon el-icon-gbp"></span><span class="mls"> el-icon-gbp</span></div>
	<div class="demoicon"><span class="an-icon el-icon-fullscreen"></span><span class="mls"> el-icon-fullscreen</span></div>
	<div class="demoicon"><span class="an-icon el-icon-friendfeed-rect"></span><span class="mls"> el-icon-friendfeed-rect</span></div>
	<div class="demoicon"><span class="an-icon el-icon-friendfeed"></span><span class="mls"> el-icon-friendfeed</span></div>
	<div class="demoicon"><span class="an-icon el-icon-foursquare"></span><span class="mls"> el-icon-foursquare</span></div>
	<div class="demoicon"><span class="an-icon el-icon-forward-alt"></span><span class="mls"> el-icon-forward-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-forward"></span><span class="mls"> el-icon-forward</span></div>
	<div class="demoicon"><span class="an-icon el-icon-fork"></span><span class="mls"> el-icon-fork</span></div>
	<div class="demoicon"><span class="an-icon el-icon-fontsize"></span><span class="mls"> el-icon-fontsize</span></div>
	<div class="demoicon"><span class="an-icon el-icon-font"></span><span class="mls"> el-icon-font</span></div>
	<div class="demoicon"><span class="an-icon el-icon-folder-sign"></span><span class="mls"> el-icon-folder-sign</span></div>
	<div class="demoicon"><span class="an-icon el-icon-folder-open"></span><span class="mls"> el-icon-folder-open</span></div>
	<div class="demoicon"><span class="an-icon el-icon-folder-close"></span><span class="mls"> el-icon-folder-close</span></div>
	<div class="demoicon"><span class="an-icon el-icon-folder"></span><span class="mls"> el-icon-folder</span></div>
	<div class="demoicon"><span class="an-icon el-icon-flickr"></span><span class="mls"> el-icon-flickr</span></div>
	<div class="demoicon"><span class="an-icon el-icon-flag-alt"></span><span class="mls"> el-icon-flag-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-flag"></span><span class="mls"> el-icon-flag</span></div>
	<div class="demoicon"><span class="an-icon el-icon-fire"></span><span class="mls"> el-icon-fire</span></div>
	<div class="demoicon"><span class="an-icon el-icon-filter"></span><span class="mls"> el-icon-filter</span></div>
	<div class="demoicon"><span class="an-icon el-icon-film"></span><span class="mls"> el-icon-film</span></div>
	<div class="demoicon"><span class="an-icon el-icon-file-new-alt"></span><span class="mls"> el-icon-file-new-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-file-new"></span><span class="mls"> el-icon-file-new</span></div>
	<div class="demoicon"><span class="an-icon el-icon-file-edit-alt"></span><span class="mls"> el-icon-file-edit-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-file-edit"></span><span class="mls"> el-icon-file-edit</span></div>
	<div class="demoicon"><span class="an-icon el-icon-file-alt"></span><span class="mls"> el-icon-file-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-file"></span><span class="mls"> el-icon-file</span></div>
	<div class="demoicon"><span class="an-icon el-icon-female"></span><span class="mls"> el-icon-female</span></div>
	<div class="demoicon"><span class="an-icon el-icon-fast-forward"></span><span class="mls"> el-icon-fast-forward</span></div>
	<div class="demoicon"><span class="an-icon el-icon-fast-backward"></span><span class="mls"> el-icon-fast-backward</span></div>
	<div class="demoicon"><span class="an-icon el-icon-facetime-video"></span><span class="mls"> el-icon-facetime-video</span></div>
	<div class="demoicon"><span class="an-icon el-icon-facebook"></span><span class="mls"> el-icon-facebook</span></div>
	<div class="demoicon"><span class="an-icon el-icon-eye-open"></span><span class="mls"> el-icon-eye-open</span></div>
	<div class="demoicon"><span class="an-icon el-icon-eye-close"></span><span class="mls"> el-icon-eye-close</span></div>
	<div class="demoicon"><span class="an-icon el-icon-exclamation-sign"></span><span class="mls"> el-icon-exclamation-sign</span></div>
	<div class="demoicon"><span class="an-icon el-icon-eur"></span><span class="mls"> el-icon-eur</span></div>
	<div class="demoicon"><span class="an-icon el-icon-error-alt"></span><span class="mls"> el-icon-error-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-error"></span><span class="mls"> el-icon-error</span></div>
	<div class="demoicon"><span class="an-icon el-icon-envelope-alt"></span><span class="mls"> el-icon-envelope-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-envelope"></span><span class="mls"> el-icon-envelope</span></div>
	<div class="demoicon"><span class="an-icon el-icon-eject"></span><span class="mls"> el-icon-eject</span></div>
	<div class="demoicon"><span class="an-icon el-icon-edit"></span><span class="mls"> el-icon-edit</span></div>
	<div class="demoicon"><span class="an-icon el-icon-dribbble"></span><span class="mls"> el-icon-dribbble</span></div>
	<div class="demoicon"><span class="an-icon el-icon-download-alt"></span><span class="mls"> el-icon-download-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-download"></span><span class="mls"> el-icon-download</span></div>
	<div class="demoicon"><span class="an-icon el-icon-digg"></span><span class="mls"> el-icon-digg</span></div>
	<div class="demoicon"><span class="an-icon el-icon-deviantart"></span><span class="mls"> el-icon-deviantart</span></div>
	<div class="demoicon"><span class="an-icon el-icon-delicious"></span><span class="mls"> el-icon-delicious</span></div>
	<div class="demoicon"><span class="an-icon el-icon-dashboard"></span><span class="mls"> el-icon-dashboard</span></div>
	<div class="demoicon"><span class="an-icon el-icon-css"></span><span class="mls"> el-icon-css</span></div>
	<div class="demoicon"><span class="an-icon el-icon-credit-card"></span><span class="mls"> el-icon-credit-card</span></div>
	<div class="demoicon"><span class="an-icon el-icon-compass-alt"></span><span class="mls"> el-icon-compass-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-compass"></span><span class="mls"> el-icon-compass</span></div>
	<div class="demoicon"><span class="an-icon el-icon-comment-alt"></span><span class="mls"> el-icon-comment-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-comment"></span><span class="mls"> el-icon-comment</span></div>
	<div class="demoicon"><span class="an-icon el-icon-cogs"></span><span class="mls"> el-icon-cogs</span></div>
	<div class="demoicon"><span class="an-icon el-icon-cog-alt"></span><span class="mls"> el-icon-cog-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-cog"></span><span class="mls"> el-icon-cog</span></div>
	<div class="demoicon"><span class="an-icon el-icon-cloud-alt"></span><span class="mls"> el-icon-cloud-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-cloud"></span><span class="mls"> el-icon-cloud</span></div>
	<div class="demoicon"><span class="an-icon el-icon-circle-arrow-up"></span><span class="mls"> el-icon-circle-arrow-up</span></div>
	<div class="demoicon"><span class="an-icon el-icon-circle-arrow-right"></span><span class="mls"> el-icon-circle-arrow-right</span></div>
	<div class="demoicon"><span class="an-icon el-icon-circle-arrow-left"></span><span class="mls"> el-icon-circle-arrow-left</span></div>
	<div class="demoicon"><span class="an-icon el-icon-circle-arrow-down"></span><span class="mls"> el-icon-circle-arrow-down</span></div>
	<div class="demoicon"><span class="an-icon el-icon-child"></span><span class="mls"> el-icon-child</span></div>
	<div class="demoicon"><span class="an-icon el-icon-chevron-up"></span><span class="mls"> el-icon-chevron-up</span></div>
	<div class="demoicon"><span class="an-icon el-icon-chevron-right"></span><span class="mls"> el-icon-chevron-right</span></div>
	<div class="demoicon"><span class="an-icon el-icon-chevron-left"></span><span class="mls"> el-icon-chevron-left</span></div>
	<div class="demoicon"><span class="an-icon el-icon-chevron-down"></span><span class="mls"> el-icon-chevron-down</span></div>
	<div class="demoicon"><span class="an-icon el-icon-check-empty"></span><span class="mls"> el-icon-check-empty</span></div>
	<div class="demoicon"><span class="an-icon el-icon-check"></span><span class="mls"> el-icon-check</span></div>
	<div class="demoicon"><span class="an-icon el-icon-certificate"></span><span class="mls"> el-icon-certificate</span></div>
	<div class="demoicon"><span class="an-icon el-icon-cc"></span><span class="mls"> el-icon-cc</span></div>
	<div class="demoicon"><span class="an-icon el-icon-caret-up"></span><span class="mls"> el-icon-caret-up</span></div>
	<div class="demoicon"><span class="an-icon el-icon-caret-right"></span><span class="mls"> el-icon-caret-right</span></div>
	<div class="demoicon"><span class="an-icon el-icon-caret-left"></span><span class="mls"> el-icon-caret-left</span></div>
	<div class="demoicon"><span class="an-icon el-icon-caret-down"></span><span class="mls"> el-icon-caret-down</span></div>
	<div class="demoicon"><span class="an-icon el-icon-car"></span><span class="mls"> el-icon-car</span></div>
	<div class="demoicon"><span class="an-icon el-icon-camera"></span><span class="mls"> el-icon-camera</span></div>
	<div class="demoicon"><span class="an-icon el-icon-calendar-sign"></span><span class="mls"> el-icon-calendar-sign</span></div>
	<div class="demoicon"><span class="an-icon el-icon-calendar"></span><span class="mls"> el-icon-calendar</span></div>
	<div class="demoicon"><span class="an-icon el-icon-bullhorn"></span><span class="mls"> el-icon-bullhorn</span></div>
	<div class="demoicon"><span class="an-icon el-icon-bulb"></span><span class="mls"> el-icon-bulb</span></div>
	<div class="demoicon"><span class="an-icon el-icon-brush"></span><span class="mls"> el-icon-brush</span></div>
	<div class="demoicon"><span class="an-icon el-icon-broom"></span><span class="mls"> el-icon-broom</span></div>
	<div class="demoicon"><span class="an-icon el-icon-briefcase"></span><span class="mls"> el-icon-briefcase</span></div>
	<div class="demoicon"><span class="an-icon el-icon-braille"></span><span class="mls"> el-icon-braille</span></div>
	<div class="demoicon"><span class="an-icon el-icon-bookmark-empty"></span><span class="mls"> el-icon-bookmark-empty</span></div>
	<div class="demoicon"><span class="an-icon el-icon-bookmark"></span><span class="mls"> el-icon-bookmark</span></div>
	<div class="demoicon"><span class="an-icon el-icon-book"></span><span class="mls"> el-icon-book</span></div>
	<div class="demoicon"><span class="an-icon el-icon-bold"></span><span class="mls"> el-icon-bold</span></div>
	<div class="demoicon"><span class="an-icon el-icon-blogger"></span><span class="mls"> el-icon-blogger</span></div>
	<div class="demoicon"><span class="an-icon el-icon-blind"></span><span class="mls"> el-icon-blind</span></div>
	<div class="demoicon"><span class="an-icon el-icon-bell"></span><span class="mls"> el-icon-bell</span></div>
	<div class="demoicon"><span class="an-icon el-icon-behance"></span><span class="mls"> el-icon-behance</span></div>
	<div class="demoicon"><span class="an-icon el-icon-barcode"></span><span class="mls"> el-icon-barcode</span></div>
	<div class="demoicon"><span class="an-icon el-icon-ban-circle"></span><span class="mls"> el-icon-ban-circle</span></div>
	<div class="demoicon"><span class="an-icon el-icon-backward"></span><span class="mls"> el-icon-backward</span></div>
	<div class="demoicon"><span class="an-icon el-icon-asl"></span><span class="mls"> el-icon-asl</span></div>
	<div class="demoicon"><span class="an-icon el-icon-arrow-up"></span><span class="mls"> el-icon-arrow-up</span></div>
	<div class="demoicon"><span class="an-icon el-icon-arrow-right"></span><span class="mls"> el-icon-arrow-right</span></div>
	<div class="demoicon"><span class="an-icon el-icon-arrow-left"></span><span class="mls"> el-icon-arrow-left</span></div>
	<div class="demoicon"><span class="an-icon el-icon-arrow-down"></span><span class="mls"> el-icon-arrow-down</span></div>
	<div class="demoicon"><span class="an-icon el-icon-align-right"></span><span class="mls"> el-icon-align-right</span></div>
	<div class="demoicon"><span class="an-icon el-icon-align-left"></span><span class="mls"> el-icon-align-left</span></div>
	<div class="demoicon"><span class="an-icon el-icon-align-justify"></span><span class="mls"> el-icon-align-justify</span></div>
	<div class="demoicon"><span class="an-icon el-icon-align-center"></span><span class="mls"> el-icon-align-center</span></div>
	<div class="demoicon"><span class="an-icon el-icon-adult"></span><span class="mls"> el-icon-adult</span></div>
	<div class="demoicon"><span class="an-icon el-icon-adjust-alt"></span><span class="mls"> el-icon-adjust-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-adjust"></span><span class="mls"> el-icon-adjust</span></div>
	<div class="demoicon"><span class="an-icon el-icon-address-book-alt"></span><span class="mls"> el-icon-address-book-alt</span></div>
	<div class="demoicon"><span class="an-icon el-icon-address-book"></span><span class="mls"> el-icon-address-book</span></div>
	<div class="demoicon"><span class="an-icon el-icon-asterisk"></span><span class="mls"> el-icon-asterisk</span><br></div>
</div>