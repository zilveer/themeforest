<?php 
	$contacts_title = get_theme_option('contacts_title');
						$user_address = get_theme_option('user_address');
						$user_phone = get_theme_option('user_phone');
						$user_email = get_theme_option('user_email');
						$user_website = get_theme_option('user_website');
	?>
			<section id="contact" class="section contact_section even">
				<div class="section_header contact_section_header">
					<h2 class="section_title contact_section_title"><a href="#"><span class="icon icon-envelope-alt"></span><span class="section_name"><?php echo $contacts_title; ?></span></a><span class="section_icon"></span></h2>
				</div>
				<div class="section_body contact_section_body">
					<?php if (get_theme_option('google_map')==1 && trim($user_address)!='') { ?>
                    <div id="googlemap_data">
                    	<?php echo do_shortcode('[googlemap address="' . $user_address . '" height="294"]'); ?>
                    	<div class="add_info">
	                        <div class="profile_row header first">
	                            <?php _e('Contact info', 'wpspace'); ?>
	                        </div>
	                        <?php if(!empty($user_address)) : ?>
	                        <div class="profile_row address">
	                            <span class="th"><?php _e('Address', 'wpspace'); ?></span><span class="td"><?php echo $user_address; ?></span>
	                        </div>
	                        <?php endif; ?>
	                        <?php if(!empty($user_phone)) : ?>
	                        <div class="profile_row phone">
	                            <span class="th"><?php _e('Phone', 'wpspace'); ?></span><span class="td"><?php echo $user_phone; ?></span>
	                        </div>
	                        <?php endif; ?>
	                        <?php if(!empty($user_email)) : ?>
	                        <div class="profile_row email">
	                            <span class="th"><?php _e('Email', 'wpspace'); ?></span><span class="td"><?php echo $user_email; ?></span>
	                        </div>
	                        <?php endif; ?>
	                        <?php if(!empty($user_website)) : ?>
	                        <div class="profile_row website">
	                            <span class="th"><?php _e('Website', 'wpspace'); ?></span><span class="td"><?php echo $user_website; ?></span>
	                        </div>
	                        <?php endif; ?>
                        </div>
                    </div>
					<?php } ?>
					<?php if (get_theme_option('contact_form')==1) { ?>
                	<div class="sidebar contact_sidebar">
						<?php do_action( 'before_sidebar' ); ?>
                        <?php if ( ! dynamic_sidebar( 'sidebar-contact' ) ) { ?>
                        <?php } ?>
                    </div>
					<div class="contact_form">
                    	<div class="contact_form_data">
							<?php echo do_shortcode('[contact_form title="'.__('Let\'s keep in touch', 'wpspace').'"]'); ?>
                        </div>
                    </div>
					<?php } ?>
				</div> <!-- .section_body -->
			</section> <!-- #contact -->