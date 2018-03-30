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

$messages = array();

// Get selected template id
$selected_template_id = isset($_REQUEST['template']) ? (int) $_REQUEST['template'] : 0;

// Actions
$action = isset($_REQUEST['cb5_action']) ? $_REQUEST['cb5_action'] : 'edit';
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

if ($cb5_builder_id =='')$cb5_builder_id = 0;

if(is_numeric($cb5_builder_id)){
	$selected_template_id = $cb5_builder_id;
}
else{
	$selected_template_id = 0;
	/*if( ! isset( $_REQUEST['template'] ) && $recently_edited_template && $this->is_template( $recently_edited_template )) {
	 $selected_template_id = $recently_edited_template;
	 } elseif ( ! isset( $_REQUEST['template'] ) && $selected_template_id == 0 && !empty($templates)) {
	 $selected_template_id = $templates[0]->ID;
	 }*/
}

//define selected template object


$selected_template_object = get_post($selected_template_id);

//get custom post types
global $custom_posttypes;


// saving action
switch($action) {



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
	
	<?php echo '<img src="'.get_template_directory_uri().'/inc/assets/images/loader.gif" class="builder_loader"
 		style="margin: 0 auto;display: table;margin-top: 40px;position: absolute;margin-left: 45%;"/>'?>
	
	<div id="page-builder-frame" style="margin-left: 0px;visibility:hidden;">

		<div id="page-builder-fixed" style="float: none">
			<div id="page-builder">
				<div class="aqpb-tabs-nav">

					<div class="aqpb-tabs-arrow aqpb-tabs-arrow-left">
						<a>&laquo;</a>
					</div>
					<script type="text/javascript">
						jQuery(document).ready(function($) {
					jQuery('#cb5_template_select').change(function() {
						jQuery('#template_change').val(jQuery('#cb5_template_select').val());
						jQuery('#cb5_action').val('change');
						jQuery('#post').submit();

					});
					jQuery('#cb5_template_update').click(function() {
						jQuery('#cb5_action').val('update');jQuery('#post').submit();

					});
					jQuery('#cb5_template_create').click(function() {
						
						var exists = false;
						var template_name=jQuery('#template-name').val();
						jQuery('#cb5_template_select option').each(function(){
					
							if (this.text == template_name) {
								
								exists = true;
								return false;
							}
						});
						if(exists){
						jQuery('#template-name').addClass("form-invalid");
						return false;
						}else{
						jQuery('#cb5_action').val('create');jQuery('#post').submit();
						}

					});
	
});
					</script>
					


				</div>
				<div class="aqpb-wrap aqpbdiv"
					onclick="jQuery('#cb5_action').val('to_post')">
					<?php /*	<form id="update-page-template" action="<?php echo $this->args['page_url'] ?>" method="post" enctype="multipart/form-data">  */?>
					<div id="aqpb-header">

						



						<div class="inside">
                            <div class="add-block-button top_bttn">
                                <button type="button" class="button button-primary" onclick="jQuery('.blocks-to-add').slideToggle();
                                    jQuery('.add-block-button button').toggleClass('active');">
                                    <i class="fa fa-plus-circle"></i>  Add block
                                </button>

                            </div>
                            <div class="template-button top_bttn">
                                <button type="button" class="button button-primary" onclick="jQuery('.builder_templates').slideToggle();
                                    jQuery('.template-button button').toggleClass('active');">
                                    <i class="fa fa-gear"></i>  Templates
                                </button>

                            </div>
                            
                            
                            
                            
                            <!-- template button -->
                            
                    <div class="builder_templates">
					<div class="aqpb-tabs-arrow aqpb-tabs-arrow-right">
						<a>&raquo;</a>
					</div>
                            
                      <div class="aqpb-tabs-wrapper">
						<div class="aqpb-tabs">
							<select id="cb5_template_select" name="cb5_template">
								<option value="0">
								<?php echo  __('-- select template --', 'framework') ;?>
								</option>
								<?php
									
								foreach ( (array) $templates as $template ) {
									if($selected_template_id == $template->ID) {
										echo '<option value="'.$template->ID.'" data-template_id="'.$template->ID.'" selected>'. htmlspecialchars($template->post_title) .'</option>';
									} else {
										echo '<option value="'.$template->ID.'" data-template_id="'.$template->ID.'">'. htmlspecialchars($template->post_title) .'</option>';
									}
								}
								?>
							</select>
							<!--add new template button-->
							<?php if($selected_template_id == 0) { ?>
							<span class="aqpb-tab aqpb-tab-add aqpb-tab-active"><abbr
								title="Add Template"><?php echo  __('My template', 'framework') ;?>
							</abbr> </span>
							<?php } else { ?>
							<a class="aqpb-tab aqpb-tab-add"
								onclick="jQuery('#template_change').val(0);jQuery('#cb5_action').val('change');jQuery('#post').submit();"
								style="cursor: pointer;"> <abbr title="Add Template"><?php echo  __('My template', 'framework') ;?>
							</abbr> </a>
							<?php }

							?>

						</div>
					</div>
                            
                            
                            
                            
                            <div id="submitpost" class="submitbox">
							<div class="major-publishing-actions cf">

								<label class="open-label" for="template-name"> <span><?php _e('Name', 'framework') ?>
								</span> <input name="template-name" id="template-name"
									type="text" class="template-name regular-text"
									title="Enter template name here"
									placeholder="Enter template name here"
									value="<?php echo is_object($selected_template_object) ? $selected_template_object->post_title : ''; ?>">
								</label>

								<div id="template-shortcode">
								<?php if(!empty($selected_template_id)) {
									?>
									<input type="submit" name="save_template"
										id="cb5_template_update" class="button-primary "
										value="<?php echo  __('Update template', 'framework') ;?>" onclick="jQuery('#cb5_action').val('update');return false;">
										<?php
								}else{
									?>
									<input type="submit" name="save_template"
										id="cb5_template_create" class="button-primary "
										value="<?php echo  __('Save as template', 'framework') ;?>" onclick="jQuery('#cb5_action').val('create');return false;">
										<?php
								} ?>
								</div>

								<div class="publishing-action">
								<?php //submit_button( empty( $selected_template_id ) ? __( 'Create Template', 'framework' ) : __( 'Save Template', 'framework' ), 'button-primary ', 'save_template', false, array( 'id' => 'save_template_header' ) ); ?>
								</div>
								<!-- END .publishing-action -->

								<?php

                                if(!empty($selected_template_id) && !in_array($selected_template_id,array_map('cb_getTemplateId', $custom_posttypes))) { ?>
								<div class="">
								<?php

								echo '<a class="" onclick="jQuery(\'#cb5_action\').val(\'delete\');jQuery(\'#post\').submit();" style="cursor:pointer;">'. __('Delete Template', 'framework') .'</a>';
								?>
								</div>
								<!-- END .delete-action -->
								<?php } ?>

							</div>
							<!-- END .major-publishing-actions -->
						</div>
						<!-- END #submitpost .submitbox -->

						<?php
						if($selected_template_id === 0) {
							wp_nonce_field( 'create-template', 'create-template-nonce' );
						} else {
							wp_nonce_field( 'update-template', 'update-template-nonce' );
						}
						?>

						<input type="hidden" name="cb5_action" id="cb5_action"
							value="<?php echo ( $selected_template_id == 0 ) ? 'to_post' : 'update' ?>" />
						<input type="hidden" name="template" id="template"
							value="<?php echo $selected_template_id ?>" /> <input
							type="hidden" id="aqpb-nonce" name="aqpb-nonce"
							value="<?php echo wp_create_nonce('aqpb-settings-page-nonce') ?>" />
						<input type="hidden" name="template_change" id="template_change"
							value="" />
                            
                        </div><!-- template button end -->
                            
                            
                            
                            
                            
                            
                            <div class="blocks-to-add"  style="display: none;">
							<ul id="blocks-archive" class="cf">

							<?php $this->blocks_archive() ?>
							</ul>
                            </div>
						</div>
					</div>

					<div id="aqpb-body">







						<ul class="blocks cf" id="blocks-to-edit">
						<?php

                        $screen = get_current_screen();

						if($selected_template_id == 0) {
							if (is_array($cb5_post_blocks)){
                                if(isset($cb5_post_blocks[0])) $blocks = $cb5_post_blocks[0]; else $blocks=array();

                                if(empty($blocks) && in_array($screen->post_type,array_map('cb_getType', $custom_posttypes))){

                                    $this->display_blocks(cb_getTemplateIdFromType($screen->post_type,$custom_posttypes));
                                }
                                else
								$this->display_blocks($selected_template_id,$cb5_post_blocks);
							}
							else{

								echo '<p class="empty-template">';
								echo __('To create a custom page template, give it a name above and click Create Template. Then choose blocks like text, widgets or tabs &amp; toggles from the left column to add to this template.
									<br/><br/>
									You can drag and drop the blocks to put them in the order you want. Click on the small arrow at the corner of each block to reveal additional configuration options. You can also resize each block by clicking on either side of the block (Note that some blocks are not resizable)
									<br/><br/>
									When you have finished building your custom page template, make sure you click the Save Template button.', 'framework');
								echo '</p>';

							}

						} else {

							$this->display_blocks($selected_template_id);
						}


							
						?>
						</ul>

					</div>

					<div id="aqpb-footer">
						<div class="major-publishing-actions cf">
							<div class="publishing-action">

							<?php if($selected_template_id == 0) { ?>
								<input type="submit" name="own_template" id="own_template"
									class="button button-primary "
									value="<?php echo  __('Update Template', 'framework') ;?>"
									onclick="jQuery('#cb5_action').val('to_post');jQuery('#post').submit();">
									<?php }else{ ?>
								<input type="submit" name="own_template" id="own_template"
									class="button button-primary "
									value="<?php echo  __('Save as New', 'framework') ;?>"
									onclick="jQuery('#cb5_action').val('to_post');jQuery('#post').submit();">
									<?php } ?>
							</div>
							<!-- END .publishing-action -->
						</div>
						<!-- END .major-publishing-actions -->
					</div>

				</div>
				<?php /*</form>*/?>
			</div>
			<div style="color: #999;padding:0px 10px;">
				<p style="float: left">
					<small>Aqua Page Builder &copy; 2012 by <a
						href="http://aquagraphite.com">Syamil MJ</a> </small>
				</p>
				<p style="float: right">
					<small>Version <?php echo AQPB_VERSION ?> </small>
				</p>
			</div>
			<div style="clear: both;"></div>
		</div>
	</div>
</div>
