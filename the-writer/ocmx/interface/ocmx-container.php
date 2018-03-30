<?php 
class OCMX_Container
	{
		public function load_container($section_header, $ocmx_tabs = 0, $submit_text = "Save Changes") {
			global $theme_options, $selected_tab, $changes_done, $ocmx_version;
			 if(isset($_GET["current_tab"])) :
				$selected_tab = $_GET["current_tab"];
			else :
				$selected_tab = 1;
			endif;
			?>
			<link href="<?php echo get_template_directory_uri(); ?>/ocmx/style.css" rel="stylesheet" type="text/css" />
            <form action="<?php echo esc_html( $_SERVER['REQUEST_URI'] ) ?>" name="ocmx-options" <?php if($_GET["page"] != "ocmx-gallery") : ?>id="ocmx-options"<?php endif; ?> method="post" enctype="multipart/form-data">
                <div class="ocmx-container">
                    <div class="wrap">
                    	<div class="ocmx-title-block">
                            <h2>OCMX Options</h2>
                            <h5>
                                <span> &nbsp;| <a href="http://kb.oboxsites.com/theme-documentation/" target="_blank">View Theme Documentation</a></span>
                                <span>OCMX Version <?php echo $ocmx_version; ?></span>
                            </h5>
                        </div>

                        
                        
						<?php if(isset($_GET["changes_done"]) || $changes_done) : ?>
                            <div class="updated below-h2" id="ocmx-note"><p><?php _e("Your changes were successful.","ocmx") ?></p></div>
                        <?php elseif(isset($_GET["options_reset"])) : ?>
                            <div class="updated below-h2" id="ocmx-note"><p><?php _e("These Options Have Been Reset.","ocmx") ?></p></div>
                        <?php endif; ?>
                        
                        <!-- All the form buttons go here -->
                        <div id="header-block" class="clearfix">
    						<?php if($submit_text != "") :?>
	                            <input type="submit" class="obox-save" value="<?php echo $submit_text; ?>" />
								<?php if($_GET["page"] != "ocmx-gallery") : ?>
                                    <input type="button" id="ocmx-reset" class="obox-reset" value="<?php _e("Reset", "ocmx"); ?>" />
                                <?php endif; ?>
                            <?php endif; ?>
                        
                            <!-- OCMX Tabs -->
                           <?php if(count($ocmx_tabs) >= 1) : 
                                $tab_i = 1;
                                foreach($ocmx_tabs as $tab => $taboption) : 
                                    if(isset($taboption["top_button"])) :?>
                                        <div <?php if($selected_tab != $tab_i):?>style="display: none;"<?php endif; ?> id="tab-<?php echo $tab_i; ?>-href">
                                            <a href="<?php echo $taboption["top_button"]["href"]; ?>" id="<?php echo $taboption["top_button"]["id"]; ?>" rel="<?php echo $taboption["top_button"]["rel"]; ?>" class="obox-save"><?php echo $taboption["top_button"]["html"]; ?></a>                                            
                                        </div>
                                <?php endif;
                                    $tab_i++;
                                endforeach;
                            endif; ?>
                            <h3><?php echo $section_header; ?></h3>
                        </div>
                        
                        <!-- OCMX Tabs -->
                        <?php if(count($ocmx_tabs) > 1) : ?>
                            <?php $tab_i = 1; ?>
                            <div id="info-content-block">
                                <ul id="tabs" class="tabs clearfix">
                                    <?php foreach($ocmx_tabs as $tab) : ?>
                                        <li <?php if($selected_tab == $tab_i) : ?>class="selected" <?php endif; ?>>
                                            <a href="#" rel="#tab-<?php echo $tab_i; ?>"><?php echo $tab["option_header"]; ?></a>
                                        </li>
                                        <?php $tab_i++; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        
                        <!-- OCMX Form Content -->
                        <?php $tab_i = 1; ?>
                        <div id="content-block" class="clearfix">
							<?php foreach($ocmx_tabs as $tab => $taboption) : ?>
                                <ul class="<?php echo $taboption["ul_class"]; ?>" <?php if($selected_tab != $tab_i):?>style="display: none;"<?php endif; ?> id="tab-<?php echo $tab_i; ?>">
                                    <?php $use_options = $taboption["function_args"];
                                    if(isset($theme_options[$use_options])) :
                                        foreach($theme_options[$use_options] as $use_theme_options => $which_array) :
                                            do_action($taboption["use_function"], $which_array);
                                        endforeach; 
                                    elseif(isset($which_array)) :
                                        do_action($taboption["use_function"], $which_array);
									else :
                                        do_action($taboption["use_function"]);
                                    endif;?>
                                </ul>  
                                <?php $tab_i++; ?>
                            <?php endforeach; ?>
                            <!-- Second row of form buttons go here -->
                            <div class="base-controls clearfix">
                            	<?php if($submit_text != "") :?>
	                                <input type="submit" class="obox-save" value="<?php echo $submit_text; ?>" />    
									<?php if($_GET["page"] != "ocmx-gallery") : ?>
                                        <input type="button" id="ocmx-reset-1" class="obox-reset" value="<?php _e("Reset", "ocmx"); ?>" />
                                    <?php endif; ?>                                
                                <?php endif; ?>
                            	<?php if(count($ocmx_tabs) >= 1) : 
									$tab_i = 1;
									foreach($ocmx_tabs as $tab => $taboption) : 
										if(isset($taboption["base_button"])) :?>
                                            <div <?php if($selected_tab != $tab_i):?>style="display: none;"<?php endif; ?> id="tab-<?php echo $tab_i; ?>-href-1">
                                                <a href="<?php echo $taboption["base_button"]["href"]; ?>" id="<?php echo $taboption["base_button"]["id"]; ?>" rel="<?php echo $taboption["base_button"]["rel"]; ?>" class="obox-save"><?php echo $taboption["base_button"]["html"]; ?></a>
                                            </div>
                                  	<?php endif;
										$tab_i++;
									endforeach;
                                endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="update_ocmx" value="<?php foreach($ocmx_tabs as $tab) : echo $tab['function_args'].", "; endforeach; ?>1" />
            </form>
<?php 	} 
	} ?>