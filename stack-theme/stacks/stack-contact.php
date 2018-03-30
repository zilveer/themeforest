<div class="stack stack-contact" id="<?php echo $stack['id']; ?>">

			<div class="contact-pane">
				<?php if(isset( $stack['contact_info_text'] )) echo apply_filters('the_content', $stack['contact_info_text']); ?>
				
				<?php if( is_array($stack['contact_info_list']) ): ?>
					<ul class="features-list">
						<?php foreach ($stack['contact_info_list'] as $info ): ?>
								<li><strong><?php echo $info['stack_title']; ?>:</strong> <?php echo $info['info_detail']; ?></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
				
				<?php if($stack['contact_form_type'] == 'contact-form-7'): 
					echo do_shortcode('[contact-form-7 id="'.$stack['contact_form_7_id'].'" title=""]');
				?>
				<?php else: ?>
				<form class="theme-form ajax-form validate-form" method="post" action="<?php echo site_url(); ?>/wp-admin/admin-ajax.php">
					<input type="hidden" name="action" value="do_contact" />
					<input type="hidden" name="to" value="<?php echo $stack['contact_form_mail_to']; ?>" />
					<div class="input-wrap">
						<i class="icon icon-asterisk"></i>
						<textarea placeholder="<?php _e('Message …', 'theme_front')?>" name="message" data-rule-required="true" data-msg-required="Please fill the message."></textarea>
					</div>
					<div class="select-wrap input-wrap">
						<i class="icon icon-angle-down"></i>
						<select name="purpose">
							
							<?php if( is_array($stack['contact_purpose_list']) ): ?>
								<?php foreach ($stack['contact_purpose_list'] as $purpose ): ?>
									<option value="<?php echo $purpose['stack_title']; ?>"><?php echo $purpose['stack_title']; ?></option>
								<?php endforeach; ?>
							<?php else: ?>
								<option value="Enquiry"><?php _e('Enquiry', 'theme_front')?></option>
								<option value="Feedback"><?php _e('Feedback', 'theme_front')?></option>
								<option value="Other …"><?php _e('Other …', 'theme_front')?></option>
							<?php endif; ?>

						</select>
					</div>
					<div class="input-wrap" style="display:none;">
						<input name="email" type="email" placeholder="<?php _e('Email …', 'theme_front')?>" />
					</div>
					<div class="input-wrap">
						<input name="phone" type="text" placeholder="<?php _e('Phone …', 'theme_front')?>" />
					</div>
					<div class="input-wrap">
						<i class="icon icon-asterisk"></i>
						<input name="from" type="email" placeholder="<?php _e('Email …', 'theme_front')?>" data-rule-required="true" data-msg-required="Please fill your email." data-rule-email="true" data-msg-email="Please enter valid email." />
					</div>
					<div class="input-wrap"><div class="form-response"></div></div>
					<div class="input-wrap"><input type="submit" class="button button-primary" name="submit" value="<?php _e('Submit', 'theme_front')?>" /></div>
				</form>
				<?php endif; ?>

			</div><!-- .contact-pane -->

			<div class="map-wrap" data-marker="true" data-lat="<?php echo $stack['lat']; ?>" data-lng="<?php echo $stack['lng']; ?>" data-zoom="<?php echo $stack['map_zoom']; ?>" style="height: <?php echo $stack['map_height']; ?>px;">
				<?php if( isset($stack['marker_info_list']) ) if( is_array($stack['marker_info_list']) ): ?>
					<?php foreach ($stack['marker_info_list'] as $marker ): ?>
						<div data-lat="<?php echo $marker['lat']; ?>" data-lng="<?php echo $marker['lng']; ?>" data-icon="<?php echo get_template_directory_uri() ?>/images/marker.png"></div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		
</div><!-- .stack-contact -->