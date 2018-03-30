<?php

/*
 * AIT WordPress Theme Framework
 *
 * Copyright (c) 2013, Affinity Information Technology, s.r.o. (http://ait-themes.com)
 */


class AitLoginWidget extends WP_Widget
{

	function __construct()
	{
		$widget_ops = array('classname' => 'widget_login', 'description' => __( 'Register or login users form', 'ait-admin') );
		parent::__construct('ait-login', __('Theme &rarr; Login', 'ait-admin'), $widget_ops);
	}



	function widget($args, $instance)
	{
		extract( $args );
		$result = '';

		/* WIDGET CONTENT :: START */
		$result .= $before_widget;
		$title = '';
		if(isset($instance['title'])){
			$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		}
		$result .= $before_title.$title.$after_title;

		if( is_user_logged_in() ){
			global $wp_roles;
			$currentUser = wp_get_current_user();

			// display info
			$result .= '<div class="userlogin-container user-logged-in">';
				$result .= !empty($instance['description_logout']) ? '<p>'.$instance['description_logout'].'</p>' : '';
				$result .= '<div class="profile">';
					$result .= '<div class="profile-avatar">'.get_avatar($currentUser->ID).'</div>';
					$result .= '<div class="profile-name"><span>'.__('Username', 'ait').':</span><span>'.$currentUser->user_nicename.'</span></div>';
					if(isset($currentUser->roles[0])){
						//$result .= '<div class="profile-role"><span>'..'</span><span></span></div>';
					}

					$result .= '<a href="'.admin_url('profile.php').'" title="'.__('Account','ait').'" class="widgetlogin-button-account">'.__('Account','ait').'</a>';
					$result .= '<a href="'.wp_logout_url(get_permalink()).'" title="'.__('Logout','ait').'" class="widgetlogin-button-logout">'.__('Logout','ait').'</a>';
					$result .= '<a href="'.admin_url('edit.php?post_type=ait-item&author='.$currentUser->ID).'" title="'.__('Items','ait').'" class="widgetlogin-button-items">'.__('My Items','ait').'</a>';


				$result .= '</div>';
			$result .= '</div>';
			echo($result);

		} else {
			if ($instance['opened_tab'] == 'opened_tab_login') {
				$openedTabRegister = '';
				$openedTabLogin = 'userlogin-option-active';
			}else{
				$openedTabRegister = 'userlogin-option-active';
				$openedTabLogin = '';
			}
			// register / login
			$result .= '<div class="userlogin-container user-not-logged-in">';
				$result .= '<div class="userlogin-tabs">';
					$result .= '<div class="userlogin-tabs-menu">';
						$result .= '<a class="'.$openedTabRegister.'" href="#">'.__('Register', 'ait').'</a>';
						$result .= '<a class="'.$openedTabLogin.'" href="#">'.__('Login', 'ait').'</a>';
					$result .= '</div>';
					$result .= '<div class="userlogin-tabs-contents">';
						$result .= '<div class="userlogin-tabs-content '.$openedTabRegister.'">';
							$result .= '<!-- REGISTER TAB -->';
							$result .= $instance['description_register'] != '' ? '<p>'.$instance['description_register'].'</p>' : '';
							$result .= '<form method="post" action="'.home_url('/').'?ait-action=register" class="wp-user-form user-register-form">';
								$result .= '<p class="input-container input-username">';
									$result .= '<label for="user_login">'.__('Username', 'ait').'</label>';
									$result .= '<input type="text" name="user_login" id="user_login" value="" size="20" tabindex="101" />';
								$result .= '</p>';
								$result .= '<p class="input-container input-email">';
									$result .= '<label for="user_email">'.__('Email', 'ait').'</label>';
									$result .= '<input type="text" name="user_email" id="user_email" value="" size="20" tabindex="102" />';
								$result .= '</p>';

								$rand = rand();
								$themeOptions = aitOptions()->getOptionsByType('theme');
								$themePackages = new ThemePackages();
								$orderedPackages = $themePackages->getOrderedPackages();
								$result .= '<p class="input-container input-role">';
									$result .= '<select id="user_role" name="user_role" tabindex="103">';
										//$result .= '<option value="-1">'.__('Package', 'ait').'</option>';
										foreach ($orderedPackages as $key => $value) {
											$package = $themePackages->getPackageBySlug($value);
											$packageOptions = $package->getOptions();
											$isFree = $packageOptions['price'] == 0 ? "true" : "false";
											$result .= '<option value="'.$package->getSlug().'" data-isfree="'.$isFree.'">'.$package->getName().' ('.$packageOptions['price'].' '.$themeOptions['payments']['currency'].')</option>';
										}
									$result .= '</select>';
								$result .= '</p>';

								$themeConfig = aitConfig()->getFullConfig('theme');
								$paymentGates = $themeOptions['payments'];
								unset($paymentGates['currency']);
								$paymentGatesConfig = $themeConfig['payments']['@options'][1];
								$paymentGatesInstalled = array();
								$paymentGatesEnabled = array();

								foreach($paymentGates as $name => $value){
									if($paymentGatesConfig[$name]['controller'] == "none" || class_exists($paymentGatesConfig[$name]['controller'])){
										$paymentGatesInstalled[$name] = $value;
									}
								}

								foreach ($paymentGatesInstalled as $name => $value) {
									if((bool)$value == true){
										$paymentGatesEnabled[$name] = $value;
									}
								}

								$paymentGatesTexts = array(
									'bankTransfer' => __('Bank Transfer', 'ait'),
									'paypal' => __('Paypal', 'ait'),
									'paypalRecurring' => __('Paypal Recurring', 'ait'),
									'stripe' => __('Stripe', 'ait'),
								);

								if(count($paymentGatesEnabled) > 0){
									$firstPackage = $themePackages->getPackageBySlug($orderedPackages[0]);
									$firstPackageOptions = $firstPackage->getOptions();
									if ($firstPackageOptions['price'] == 0) {
										$result .= '<p class="input-container input-payment" style="display: none;">';
									}else{
										$result .= '<p class="input-container input-payment">';
									}
										$result .= '<select id="user_payment" name="user_payment" tabindex="104">';
											//$result .= '<option value="-1">'.__('Payment Type', 'ait').'</option>';
											foreach ($paymentGatesEnabled as $name => $value) {
												$result .= '<option value="'.$name.'">'.$paymentGatesTexts[$name]/*$paymentGatesConfig[$name]['label']*/.'</option>';
											}
										$result .= '</select>';
									$result .= '</p>';
								}

								//required terms and conditions
								if(!empty($instance['required_conditions'])){
									$result .= '<p class="input-container input-required-conditions">';
									$result .= '<input type="checkbox" name="required_conditions" id="required_conditions" />';
									$result .= '<label for="required_conditions">'.$instance['required_conditions_label'].'</label>';
									$result .= '</p>';
								}

								/* CAPTCHA */
								if(!empty($instance['captcha'])){

								/* CAPTCHA VALIDATION */
								if(class_exists("AitReallySimpleCaptcha")){
									$captcha = new AitReallySimpleCaptcha();
									$captcha->tmp_dir = aitPaths()->dir->cache . '/captcha';

									$cacheUrl = aitPaths()->url->cache . '/captcha';
									$img = $captcha->generate_image('ait-login-widget-captcha-'.$rand, $captcha->generate_random_word());
									$imgUrl = $cacheUrl."/".$img;

									$result .= '<p class="input-container input-captcha">';
										$result .= '<img src="'.$imgUrl.'" alt="captcha-input"/>';
										$result .= '<input type="text" name="user_captcha" id="user_captcha" value="" size="20" tabindex="201" />';
									$result .= '</p>';
								}
								/* CAPTCHA VALIDATION */

								}
								/* CAPTCHA */

								$result .= '<div class="login-fields">';
									do_action('register_form');
									$result .= '<input type="submit" name="user-submit" value="'.__('Sign up!', 'ait').'" class="user-submit" tabindex="103" />';
									$result .= '<input type="hidden" name="redirect_to" value="'.home_url().'" />';
									$result .= '<input type="hidden" name="user-cookie" value="1" />';

									/* CAPTCHA */
									if(!empty($instance['captcha'])){
									$result .= '<input type="hidden" name="rand" value="'.$rand.'" />';
									}
									/* CAPTCHA */

								$result .= '</div>';

								$result .= '<div class="login-messages">';
									$result .= '<div class="login-message-error" style="display: none">'.__('Please fill out all registration fields','ait').'</div>';

									/* CAPTCHA */
									if(!empty($instance['captcha'])){
									$result .= '<div class="captcha-error" style="display: none">'.__('Captcha failed to verify','ait').'</div>';
									$result .= '<div class="ajax-error" style="display: none">'.__('There was a server error during ajax request','ait').'</div>';
									}
									/* CAPTCHA */
								$result .= '</div>';

							$result .= '</form>';
						$result .= '</div>';
						$result .= '<div class="userlogin-tabs-content '.$openedTabLogin.'">';
							$result .= '<!-- LOGIN TAB -->';
							$result .= $instance['description_login'] != '' ? '<p>'.$instance['description_login'].'</p>' : '';
							$result .= wp_login_form( array( 'redirect' => get_permalink(), 'form_id' => 'ait-login-form-widget', 'id_username' => 'user_login_log', 'echo' => false, 'remember' => false,) );
						$result .= '</div>';
					$result .= '</div>';
				$result .= '</div>';
				echo($result);
				?>

				<script type="text/javascript">
				(function(jQuery, $window, $document, globals){
				"use strict";
				jQuery(document).ready(function(){
					var widget = "#<?php echo $args['widget_id']?>";
					jQuery(widget+" .userlogin-tabs-contents input[type=text], .userlogin-tabs-contents input[type=password]").each(function(){
						var $label = jQuery(this).parent().find("label");
						var placeholder = $label.html();
						jQuery(this).attr("placeholder", placeholder);
						$label.hide();
					});

					var $tabs = jQuery(widget+" .userlogin-container .userlogin-tabs-menu a");
					var $contents = jQuery(widget+" .userlogin-container .userlogin-tabs-contents");
					var activeClass = "userlogin-option-active";
					$tabs.each(function(){
						jQuery(this).click(function(e){
							e.preventDefault();
							$tabs.each(function(){
								jQuery(this).removeClass(activeClass);
							});
							$contents.find(".userlogin-tabs-content").each(function(){
								jQuery(this).removeClass(activeClass);
							});
							jQuery(this).addClass(activeClass);
							$contents.find(".userlogin-tabs-content:eq("+jQuery(this).index()+")").addClass(activeClass);
						});
					});

					jQuery(widget+" form.user-register-form select[name=user_role]").change(function(){
						var $payments = jQuery(widget+" form.user-register-form select[name=user_payment]");
						var $selected = jQuery(this).find("option:selected");
						var isFree = $selected.data("isfree");
						if(isFree){
							// disable payment gates input
							$payments.attr("disabled", "disabled");
							$payments.parent().hide();
						} else {
							// enable payment gates input
							$payments.removeAttr("disabled");
							$payments.parent().show();
						}
					});

					jQuery(widget+" form.user-register-form").on("submit", function(e){
						/* CAPTCHA */
						<?php if(!empty($instance['captcha'])): ?>
						e.preventDefault();
						<?php endif ?>
						/* CAPTCHA */

						var $inputs = jQuery(this).find("input[type=text]");
						var $selects = jQuery(this).find("select:not(:disabled)");
						var $checkboxes = jQuery(this).find("input[type=checkbox]");
						var valid = false;
						var all = parseInt($selects.length + $inputs.length + $checkboxes.length);
						var validation = 0;
						$selects.each(function(){
							if(jQuery(this).val() != "-1"){
								validation = validation + 1;
							}
						});
						$inputs.each(function(){
							if(jQuery(this).val() != ""){
								if(jQuery(this).attr("name") == "user_email"){
									validation = validation + 1;
								} else {
									validation = validation + 1;
								}
							}
						});
						$checkboxes.each(function(){
							if(jQuery(this).prop("checked")){
									validation = validation + 1;
							}
						});
						if(validation == all){
							valid = true;
						}
						if(!valid){
							jQuery(this).find(".login-message-error").fadeIn("slow");
							jQuery(this).find(".login-message-error").on("hover", function(){
								jQuery(this).fadeOut("fast");
							});
							return false;

						/* CAPTCHA */
						<?php if(!empty($instance['captcha'])): ?>
						} else {
							var data = {"captcha-check": jQuery(this).find("#user_captcha").val(), "captcha-hash": "<?php echo($rand)?>"};
							ait.ajax.post("login-widget-check-captcha:check", data).done(function(rdata){
								if(rdata.data == true){
									jQuery(widget+" form.user-register-form").off("submit");
									jQuery(widget+" form.user-register-form").submit();
								} else {
									jQuery(widget+" form.user-register-form").find(".captcha-error").fadeIn("slow");
									jQuery(widget+" form.user-register-form").find(".captcha-error").on("hover", function(){
										jQuery(this).fadeOut("fast");
									});
								}
							}).fail(function(rdata){
								jQuery(widget+" form.user-register-form").find(".ajax-error").fadeIn("slow");
								jQuery(widget+" form.user-register-form").find(".ajax-error").on("hover", function(){
									jQuery(this).fadeOut("fast");
								});
							});
							//$result .= 'return false;';
						<?php endif ?>
						/* CAPTCHA */

						}
					});
				});
				})(jQuery, jQuery(window), jQuery(document), this);

				</script>
			</div>
			<?php
		}

		echo($after_widget);
		/* WIDGET CONTENT :: END */
	}



	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['description_login'] = $new_instance['description_login'];
		$instance['description_logout'] = $new_instance['description_logout'];
		$instance['description_register'] = $new_instance['description_register'];
		$instance['required_conditions'] = $new_instance['required_conditions'];
		$instance['required_conditions_label'] = $new_instance['required_conditions_label'];
		$instance['opened_tab'] = $new_instance['opened_tab'];
		$instance['captcha'] = $new_instance['captcha'];

		return $instance;
	}



	function form($instance)
	{
		$instance = wp_parse_args( (array) $instance, array(
            'title' => '',
            'description_login' => '',
            'description_logout' => '',
            'description_register' => '',
            'required_conditions' => false,
            'required_conditions_label' => '',
            'opened_tab' => 'opened_tab_register',
            'captcha' => true,
        ) );
    ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title', 'ait-admin' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>"class="widefat" style="width:100%;" />
        </p>
        <p>
			<label for="<?php echo $this->get_field_id( 'opened_tab' ); ?>"><?php echo __( 'Opened Tab', 'ait-admin' ); ?>:</label>
			<select id="<?php echo $this->get_field_id( 'opened_tab' ); ?>" name="<?php echo $this->get_field_name( 'opened_tab' ); ?>">
				<option <?php if ( 'opened_tab_register' == $instance['opened_tab'] ) echo 'selected="selected"'; ?> value="opened_tab_register">Register</option>
				<option <?php if ( 'opened_tab_login' == $instance['opened_tab'] ) echo 'selected="selected"'; ?> value="opened_tab_login">Login</option>
			</select>
		</p>
		<p>
        	<label for="<?php echo $this->get_field_id( 'description_login' ); ?>"><?php echo __( 'Login Description', 'ait-admin' ); ?>:</label>
			<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'description_login' ); ?>" name="<?php echo $this->get_field_name( 'description_login' ); ?>"><?php echo htmlspecialchars($instance['description_login']); ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'description_logout' ); ?>"><?php echo __( 'Logout Description', 'ait-admin' ); ?>:</label>
			<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'description_logout' ); ?>" name="<?php echo $this->get_field_name( 'description_logout' ); ?>"><?php echo htmlspecialchars($instance['description_logout']); ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'description_register' ); ?>"><?php echo __( 'Register Description', 'ait-admin' ); ?>:</label>
			<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'description_register' ); ?>" name="<?php echo $this->get_field_name( 'description_register' ); ?>"><?php echo htmlspecialchars($instance['description_register']); ?></textarea>
		</p>
		<p>
			<?php $checked = ''; if ( $instance['required_conditions'] ) $checked = 'checked="checked"'; ?>
			<input type="checkbox" <?php echo $checked; ?> id="<?php echo $this->get_field_id( 'required_conditions' ); ?>" name="<?php echo $this->get_field_name( 'required_conditions' ); ?>" class="checkbox" />
			<label for="<?php echo $this->get_field_id( 'required_conditions' ); ?>"><?php echo __( 'Terms and Conditions acceptation required ', 'ait-admin' ); ?></label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'required_conditions_label' ); ?>"><?php echo __( 'Terms and Conditions label', 'ait-admin' ); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id( 'required_conditions_label' ); ?>" name="<?php echo $this->get_field_name( 'required_conditions_label' ); ?>" value="<?php echo htmlspecialchars($instance['required_conditions_label']); ?>"class="widefat" style="width:100%;" />
		</p>
		<p>
			<?php $checked = ''; if ( $instance['captcha'] ) $checked = 'checked="checked"'; ?>
			<input type="checkbox" <?php echo $checked; ?> id="<?php echo $this->get_field_id( 'captcha' ); ?>" name="<?php echo $this->get_field_name( 'captcha' ); ?>" class="checkbox" />
			<label for="<?php echo $this->get_field_id( 'captcha' ); ?>"><?php echo __( 'Use captcha ', 'ait-admin' ); ?></label>
		</p>

<?php
	}

}
