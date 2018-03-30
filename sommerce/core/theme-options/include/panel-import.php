					<div class="rm_section">
	                    <div class="rm_title">
							<h3>
								<img src="<?php echo yiw_panel_url() ?>/include/images/trans.png" class="noeffect" alt="" />
								<?php _e( 'Import configuration', 'yiw' ) ?>
							</h3>
							
							<div class="clearfix"></div>
						</div>
	                    <div class="rm_options">                    
                        		
                        	<form method="post" action="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>">
                
	                			<div class="rm_option rm_input rm_text" id="sidebars-option">
	                        		<label for="yiw-theme-options-save-configuration"><?php _e( 'Save configuration', 'yiw' ) ?></label>
	                        		
									<input type="text" style="width:240px;" id="yiw-theme-options-save-configuration" name="new_configuration" />
	                                <input type="hidden" name="action" value="yiw-save-configuration" />
	                                <input type="hidden" name="yiw-callback-save" value="yiw_panel_configuration_save" />
									<input type="submit" id="yiw-theme-options-sidebars_save" name="button_save" class="button" value="<?php _e( 'Save', 'yiw' ) ?>" />
													
									<small>
										<?php _e( 'Save the actual configuration of theme options. Put the name and you be able to see this configuration on the list below.', 'yiw' ) ?><br>
										<?php _e( 'In future, you can select it to restore the options just saved.', 'yiw' ) ?>
									</small>
									<div class="clearfix"></div>
	                    		</div>                
                    		
							</form>                               
                        		
                        	<form method="post" action="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>">       
		                        
		                        <?php $configs = maybe_unserialize( get_option( 'yiw_configs' ) ); ?>
                                                                  
	                			<div class="rm_option rm_input rm_select">
			                        <label for="yiw-theme-options-apply-config"><?php _e( 'Apply Configuration', 'yiw' ) ?></label>  
			                        
			                        <select name="name_configuration" id="yiw-theme-options-apply-config" style="width:240px;">    
			                            	<option value="0"></option>
			                            <?php foreach ( $configs as $id => $config ) { ?>
			                                <option value="<?php echo $id ?>"><?php echo $config['name']; ?></option>
			                            <?php } ?>
			                        </select>                          
			                        
									<input type="submit" value="<?php _e( 'Apply', 'yiw' ) ?>" class="button-secondary" />   
	                                <input type="hidden" name="action" value="yiw-apply-configuration" />
	                                <input type="hidden" name="yiw-callback-save" value="yiw_panel_configuration_save" />
									
			                        <small><?php _e( 'Choose one of these settings saved before, to apply them on the theme.', 'yiw' ) ?></small>
			                        <div class="clearfix"></div>
			                    </div>            
                    		
							</form>               
                
                        </div>
                    </div>
                    <br />
                    
                    <div class="rm_section">
	                    <div class="rm_title">
							<h3>
								<img src="<?php echo yiw_panel_url() ?>/include/images/trans.png" class="noeffect" alt="" />
								<?php _e( 'List of all configurations', 'yiw' ) ?>
							</h3>
							
							<div class="clearfix"></div>
						</div>
	                    <div class="rm_options">                    
                        		
                        	<div class="rm_option rm_input rm_sidebar"> 
		                        <label><?php _e( 'All configurations saved', 'yiw' ) ?></label>
		                        
		                        <?php $configs = maybe_unserialize( get_option( 'yiw_configs' ) ); ?>
		                        
								<table class="cc-options">
		    						<tbody>                       
		                                                                                 
		                        	<?php if( is_array( $configs ) AND !empty( $configs ) ) : ?>
		                        		
										<?php foreach( $configs as $id => $config ) : ?>
										<tr>
								            <td>                                          
									            <div class="delete-btn"><a href="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>&action=yiw-delete-config&id=<?php echo $id ?>&yiw-callback-save=yiw_panel_configuration_save" title="<?php _e( 'Delete Configuration', 'yiw' ) ?>"><img src="<?php echo yiw_panel_url() ?>/include/images/close_16.png" alt="<?php _e( 'Delete Configuration', 'yiw' ) ?>" /></a></a></div>
									            <div class="name"><?php echo $config['name'] ?></div>
									            <div class="loading-icon"><img alt="" src="<?php get_bloginfo('url') ?>/wp-admin/images/wpspin_light.gif" style="display: none;" class="waiting"></div>
								            </td>
								        </tr>                                  
								        <?php endforeach ?> 
								
									<?php else : ?>
										
										<tr><td><?php _e( 'No configurations created!', 'yiw' ) ?></td></tr>
								
									<?php endif ?>
							                                              
							        </tbody>
								</table>
								          
		                        <small><?php _e( 'The list of all configurations saved. You can apply one of these theme options saved and restore them.', 'yiw' ) ?></small>
								<div class="clearfix"></div>
		                	</div>    
                
                        </div>
                    </div>
                    <br />
                    
                    <div class="rm_section">
	                    <div class="rm_title">
							<h3>
								<img src="<?php echo yiw_panel_url() ?>/include/images/trans.png" class="noeffect" alt="" />
								<?php _e( 'Export/Import', 'yiw' ) ?>
							</h3>
							
							<div class="clearfix"></div>
						</div>
	                    <div class="rm_options">                    
                        		
                        	<form method="post" action="?page=<?php echo $_GET['page'] ?>&tab=<?php echo $current_tab ?>">   
                                                                  
	                			<div class="rm_option rm_input rm_textarea">
                                    <label for="import-theme-options"><?php _e( 'Import Theme Options', 'yiw' ) ?></label>
                                    <textarea name="import-theme-options" cols="" rows="" class="listdata form-input-tip"></textarea>
			                        
									<input type="submit" value="<?php _e( 'Import', 'yiw' ) ?>" class="button-primary" style="float:right;margin-top:10px" />   
	                                <input type="hidden" name="action" value="yiw-import-configuration" />
	                                <input type="hidden" name="yiw-callback-save" value="yiw_panel_configuration_save" />
	                                
                                    <small><?php _e( 'Put here the string for import all theme options and configure the theme in one step.', 'yiw' ) ?></small><div class="clearfix"></div> 
                                </div>          
                    		
							</form>               
                                                                  
                			<div class="rm_option rm_input rm_textarea">         
		                        
		                        <?php 
                                    $code = base64_encode( serialize( yiw_theme_options_from_db() ) ); 
                                ?>
                                
                                <label for="import-theme-options"><?php _e( 'Export Theme Options', 'yiw' ) ?></label>
                                <textarea name="import-theme-options" cols="" rows="" class="listdata form-input-tip"><?php echo $code ?></textarea>
                                <small><?php _e( 'This is your theme options in one code string, that you can put in the "Import" textarea and restore the entire panel configuration.', 'yiw' ) ?></small><div class="clearfix"></div>
                            </div>     
                
                        </div>
                    </div>
                    <br />