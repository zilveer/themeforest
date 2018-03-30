{if $options->theme->header->userPanel == enable}

{var $descLogin = $options->theme->header->descLogin}
{var $descRegister = $options->theme->header->descRegister}
{var $conditions = $options->theme->header->conditions}
{var $captchaEnable = $options->theme->header->headerPanelUseCaptcha}


<div class="user-panel">

	{if is_user_logged_in()}

		{var $currentUser = wp_get_current_user()}

		<div class="user-info">
			<div class="user-avatar">{!get_avatar($currentUser->ID, 45)}</div>
			<!--<div class="user-name">{*$currentUser->user_nicename*}</div>-->
		</div>

		<div class="user-actions">
			<a href="{admin_url('profile.php')}" title="{__ 'Account'}" class="button-account">{__ 'Account'}<span><i class="fa fa-cog"></i></span></a>
			<a href="{!wp_logout_url(get_permalink())}" title="{__ 'Logout'}" class="button-logout">{__ 'Logout'}<span><i class="fa fa-sign-out"></i></span></a>

			{var $adminItemsUrl = 'edit.php?post_type=ait-item&author=' . $currentUser->ID}
			{var $itemsCount = intval(count_user_posts($currentUser->ID, "ait-item"))}
			<a href="{admin_url($adminItemsUrl)}" title="{__ 'Items'}" class="user-items">{__ 'My Items'}<span>{$itemsCount}</span></a>

			{if defined('AIT_EVENTS_PRO_ENABLED')}
			{var $adminEventsUrl = 'edit.php?post_type=ait-event-pro&author=' . $currentUser->ID}
			{var $eventsCount = intval(count_user_posts($currentUser->ID, "ait-event-pro"))}
			<a href="{admin_url($adminEventsUrl)}" title="{__ 'Events'}" class="user-events">{__ 'My Events'}<span>{$eventsCount}</span></a>
			{/if}
		</div>

		{? wp_enqueue_script( 'modernizr', aitPaths()->url->admin.'/modernizr/modernizr.touch.js') ?}

		<script type="text/javascript">
			jQuery(document).ready(function(){

				var userPanel = jQuery(".user-panel");

				if(!(Modernizr.touchevents || Modernizr.pointerevents)) {
					userPanel.mouseenter(function(){
						userPanel.addClass('opened');
					})
					userPanel.mouseleave(function(){
						userPanel.removeClass('opened');
					});
				} else {
					userPanel.click(function(e) {
						e.preventDefault();
						userPanel.toggleClass("opened");
					});
				}

			});

		</script>

	{else}

		{var $rand = rand()}

		<a href="#" class="toggle-button">{__ 'Login'}</a>

		<div class="login-register widget_login">
			<div class="userlogin-container user-not-logged-in">
				<div class="userlogin-tabs">
					<div class="userlogin-tabs-menu">
						<a class="userlogin-option-active" href="#">{__ 'Login'}</a>
						{if (get_option( 'users_can_register' ))}
						<a href="#">{__ 'Register'}</a>
						{/if}
					</div>
					<div class="userlogin-tabs-contents">
						<div class="userlogin-tabs-content userlogin-option-active">
							{if $descLogin != ''}
							<p>{!$descLogin}</p>
							{/if}
							{? wp_login_form( array( 'redirect' => get_permalink(), 'form_id' => 'ait-login-form-panel', 'echo' => true, 'remember' => false, 'id_username' => 'user_login_panel', 'id_password' => 'user_pass_panel', 'id_submit' => 'wp-submit-panel') ) }
						</div>
						{if (get_option( 'users_can_register' ))}

						<div class="userlogin-tabs-content">
							{if $descRegister !=''}
							<p>{!$descRegister}</p>
							{/if}
							<form method="post" action="{home_url('/?ait-action=register')}" class="wp-user-form user-register-form">
								<p class="input-container input-username">
									<label for="user_login_reg">{__ 'Username'}</label>
									<input type="text" name="user_login" id="user_login_reg" value="" size="20" tabindex="101" />
								</p>
								<p class="input-container input-email">
									<label for="user_email_reg">{__ 'Email'}</label>
									<input type="text" name="user_email" id="user_email_reg" value="" size="20" tabindex="102" />
								</p>

								{*var $rand = rand()*}
								{var $themeOptions = $options->theme}
								{var $themePackages = new ThemePackages()}
								{var $orderedPackages = $themePackages->getOrderedPackages()}

								<p class="input-container input-role">
									<select id="user_role_panel" name="user_role" tabindex="103">
										{foreach $orderedPackages as $key => $value}
											{var $package = $themePackages->getPackageBySlug($value)}
											{var $packageOptions = $package->getOptions()}
											{var $isFree = $packageOptions['price'] == 0 ? "true" : "false"}
											<option value="{$package->getSlug()}" data-isfree="{$isFree}">{$package->getName()} {$packageOptions['price']} {$themeOptions->payments->currency}</option>
										{/foreach}
									</select>
								</p>

								{var $themeConfig = aitConfig()->getFullConfig('theme')}
								{var $paymentGates = $themeOptions->payments}
								{? unset($paymentGates->currency)}
								{var $paymentGatesConfig = $themeConfig['payments']['@options'][1]}
								{var $paymentGatesInstalled = array()}
								{var $paymentGatesEnabled = array()}

								{foreach $paymentGates as $name => $value}
									{if $paymentGatesConfig[$name]['controller'] == "none" or class_exists($paymentGatesConfig[$name]['controller'])}
										{var $paymentGatesInstalled[$name] = $value}
									{/if}
								{/foreach}

								{foreach $paymentGatesInstalled as $name => $value}
									{if ((bool)$value == true)}
										{var $paymentGatesEnabled[$name] = $value}
									{/if}
								{/foreach}

								{var $paymentGatesTexts = array(
									'bankTransfer'    => __('Bank Transfer', 'ait'),
									'paypal'          => __('Paypal', 'ait'),
									'paypalRecurring' => __('Paypal Recurring', 'ait'),
									'stripe'          => __('Stripe', 'ait'),
								)}

								{if count($paymentGatesEnabled) > 0}
								{var $firstPackage = $themePackages->getPackageBySlug($orderedPackages[0])}
								{var $firstPackageOptions = $firstPackage->getOptions()}
								{if ($firstPackageOptions['price'] == 0)}
									<p class="input-container input-payment" style="display: none;">
								{else}
									<p class="input-container input-payment">
								{/if}
									<select id="user_payment_panel" name="user_payment" tabindex="104">
									{foreach $paymentGatesEnabled as $name => $value}
										<option value="{$name}">{$paymentGatesTexts[$name]}</option>
									{/foreach}
									</select>
								</p>
								{/if}

								{if $conditions != ""}
								<p class="input-container input-required-conditions">
									<input type="checkbox" name="required_conditions" id="required_conditions" />
									<label for="required_conditions">{$conditions}</label>
								</p>
								{/if}


								{* CAPTCHA *}
								{if $captchaEnable}

								{* CAPTCHA VALIDATION *}
								{if class_exists("AitReallySimpleCaptcha")}
									{var $captcha = new AitReallySimpleCaptcha()}
									{var $captcha->tmp_dir = aitPaths()->dir->cache . '/captcha'}

									{var $cacheUrl = aitPaths()->url->cache . '/captcha'}
									{var $img = $captcha->generate_image('ait-login-widget-captcha-'.$rand, $captcha->generate_random_word())}
									{var $imgUrl = $cacheUrl."/".$img}

									<p class="input-container input-captcha">
										<img src="{$imgUrl}" alt="captcha-input"/>
										<input type="text" name="user_captcha" id="user_captcha" value="" size="20" tabindex="201" />
									</p>
								{/if}
								{* CAPTCHA VALIDATION *}

								{/if}
								{* CAPTCHA *}


								<div class="login-fields">
									{? do_action('register_form') ?}
									<input type="submit" name="user-submit" value="{__ 'Sign up!'}" class="user-submit" tabindex="103" />
									<input type="hidden" name="redirect_to" value="{home_url()}" />
									<input type="hidden" name="user-cookie" value="1" />

									{* CAPTCHA *}
									{if $captchaEnable}
									<input type="hidden" name="rand" value="{$rand}" />
									{/if}
									{* CAPTCHA *}
								</div>

								<div class="login-messages">
									<div class="login-message-error" style="display: none">{__ 'Please fill out all registration fields'}</div>

									{* CAPTCHA *}
									{if $captchaEnable}
									<div class="captcha-error" style="display: none">{__ 'Captcha failed to verify'}</div>
									<div class="ajax-error" style="display: none">{__ 'There was a server error during ajax request'}</div>
									{/if}
									{* CAPTCHA *}
								</div>
							</form>
						</div>
						{/if}

					</div>
				</div>
			</div>
		</div>

		<script type="text/javascript">
			jQuery(document).ready(function(){

				// Toggle Button
				jQuery(".user-panel .toggle-button").click(function(e) {
					e.preventDefault();
					jQuery(".user-panel").toggleClass("opened");
				});

				// Widget
				jQuery(".user-panel .userlogin-tabs-contents input[type=text], .user-panel .userlogin-tabs-contents input[type=password]").each(function(){
					var $label = jQuery(this).parent().find("label");
					var placeholder = $label.html();
					jQuery(this).attr("placeholder", placeholder);
					$label.hide();
				});

				var $tabs = jQuery(".user-panel .userlogin-container .userlogin-tabs-menu a");
				var $contents = jQuery(".user-panel .userlogin-container .userlogin-tabs-contents");
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

				jQuery(".user-panel form.user-register-form select[name=user_role]").change(function(){
					var $payments = jQuery(".user-panel form.user-register-form select[name=user_payment]");
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

				jQuery(".user-panel form.user-register-form").on("submit", function(e){
					{* CAPTCHA *}
					{if $captchaEnable}
					e.preventDefault();
					{/if}
					{* CAPTCHA *}

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
						jQuery(this).find(".login-message-error").fadeIn("slow"); jQuery(this).find(".login-message-error").on("hover", function(){ jQuery(this).fadeOut("fast"); });
						return false;

					{* CAPTCHA *}
					{if $captchaEnable}
					} else {
						var data = { "captcha-check": jQuery(this).find("#user_captcha").val(), "captcha-hash": {$rand} };
						ait.ajax.post("login-widget-check-captcha:check", data).done(function(rdata){
							if(rdata.data == true){
								jQuery(".user-panel form.user-register-form").off("submit");
								jQuery(".user-panel form.user-register-form").submit();
							} else {
								jQuery(".user-panel form.user-register-form").find(".captcha-error").fadeIn("slow"); jQuery(".user-panel form.user-register-form").find(".captcha-error").on("hover", function(){ jQuery(this).fadeOut("fast"); });
							}
						}).fail(function(rdata){
							jQuery(".user-panel form.user-register-form").find(".ajax-error").fadeIn("slow");
							jQuery(".user-panel form.user-register-form").find(".ajax-error").on("hover", function(){
								jQuery(this).fadeOut("fast");
							});
						});
					{/if}
					{* CAPTCHA *}

					}
				});

			});
		</script>

	{/if}

</div>
{/if}
