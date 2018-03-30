					<!-- CONTACT SLIDE -->
                    <div class="slide clearfix">
					
                    	<div class="contact-us clearfix">
							
							<!-- CONTACT SLIDE HEADING -->
                        	<h1 class="page-title"><?php echo get_option('launch_contact_title'); ?></h1>
							
							<!-- CONTACT DETAILS -->
                            <div class="contact-details">
                            	<h2><?php echo get_option('launch_company_name'); ?></h2>
                                <p><?php echo get_option('launch_address'); ?></p>
                                <ul class="contacts">
                                    <?php
                                    $launch_contact_email = get_option('launch_contact_email');
                                    if( !empty($launch_contact_email) && is_email ($launch_contact_email) ){
                                    ?>
                                	<li class="emailto"><a href="mailto:<?php  echo $launch_contact_email; ?>"><?php echo get_option('launch_contact_email'); ?></a></li>
                                    <?php
                                    }
                                    $launch_phone = get_option('launch_phone');
                                    if( !empty($launch_phone) ){
                                    ?>
                                    <li class="contact-no"><?php echo get_option('launch_phone'); ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
							
							<!-- CONTACT FORM -->
                            <div class="contact-form">
	                            <form id="contact-form-fields" action="<?php echo site_url(); ?>/wp-admin/admin-ajax.php" method="post">
	                                <p>
	                                	<span class="input-container">
	                                		<input type="text" name="name" id="name" value="<?php _e('Name','framework'); ?>" class="required" tabindex="2" />
	                                    </span>
	                                    <span class="input-container">
	                                		<input type="text" name="email" id="user-email" value="<?php _e('E-mail Address','framework'); ?>" class="required email"  tabindex="3" />
	                                    </span>
	                                </p>									
	                                <p class="input-message">
										<textarea  name="message" id="message" tabindex="4" rows="4" cols="25" class="required"><?php _e('Message','framework'); ?></textarea>
									</p>	                                
									<p>
										<input type="hidden" name="action" value="send_message" />
										<input type="hidden" name="target" value="<?php echo get_option('launch_contact_email'); ?>" />
										<input name="message-submit" id="message-submit" type="submit" value="<?php _e('Send','framework'); ?>" tabindex="5" />
									</p> 	                                
	                                <p>
										<img src="<?php echo get_template_directory_uri(); ?>/images/loading.gif" id="contact-loader" alt="Loader" />
									</p>
	                           		<p id="message-sent">&nbsp;</p>
	                            </form>                            
                            </div>
							
                        </div><!-- end of .contact-us -->
                    </div>
					<!-- END OF CONTACT SLIDE -->