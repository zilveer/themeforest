var THEMEMAKERS_APP_AUTHENTICATION = function () {
	var self = {
		init: function () {

			var form = jQuery('.account-wrapper'),
				logPanelBtn = form.children('.log'),
				hiddenPanel = jQuery('.register-hidden-panel'),
				is_hidden_panel_active = false;

			logPanelBtn.on('click', function (e) {
				var $target = jQuery(e.target);
				if (!$target.hasClass('active')) {
					form.animate({
						right: 0
					}, 250);
					$target.addClass('active');
				} else {
					form.animate({
						right: '-230px'
					}, 250);
					$target.removeClass('active');
				}
				e.preventDefault();
			});
			//*****

			jQuery("#user_logout_button").life('click', function () {
				var data = {
					action: "app_authentication_user_logout"
				};
				//send data to server
				jQuery.post(ajaxurl, data, function (response) {
					window.location.reload();
				});

				return false;
			});

			jQuery("#user_login_button").life('click', function () {
				self.login();
				return false;
			});

			if (jQuery('#tmm_user_pass').length && jQuery('#tmm_user_login').length) {
				jQuery('#tmm_user_pass').add('#tmm_user_login').on('focus', function () {
					jQuery(window).on('keyup', function (e) {
						e.preventDefault();
						if (e.keyCode === 13) {
							self.login();
						}
					});
				});
			}

			jQuery("#user_register_button").life('click', function () {

				if (is_hidden_panel_active === true) {
					hiddenPanel.delay(350).animate({
						marginTop: '0'
					}, 450);
					is_hidden_panel_active = false;
					return false;
				}

				var user_name = jQuery("#user_name").val();
				var user_email = jQuery("#user_email").val();

				if (user_name == "" || user_email == "") {
					alert("Fill up all fields please!");
					return false;
				}

				var data = {
					action: "app_authentication_user_register",
					user_name: user_name,
					user_email: user_email
				};

				//send data to server
				jQuery.post(ajaxurl, data, function (response) {

					var userEntry = jQuery('.register-user-entry');
					userEntry.height(userEntry.height());

					jQuery('#register-info').html(response);

					hiddenPanel.delay(350).animate({
						marginTop: '-70%'
					}, 450);

					is_hidden_panel_active = true;

				});

				return false;
			});

			(function () {

				var formRegHidden = jQuery('.form-reg-hidden'),
					registerPanel = jQuery('#register_user_panel'),
					loginPanel = jQuery('#login_user_panel'),
					registerPanelHeight = registerPanel.height(),
					loginPanelHeight = loginPanel.height(),
					maxHeight = Math.max(registerPanelHeight, loginPanelHeight);
				if (maxHeight !== 0) {
					formRegHidden.height(maxHeight);
				}
				loginPanel.height(loginPanelHeight);
				registerPanel.height(registerPanelHeight);

				jQuery("#show_register_user_panel").life('click', function () {
					loginPanel.animate({
						marginTop: -registerPanelHeight - 63
					}, 450);
					formRegHidden.animate({
						height: registerPanelHeight
					}, 450);
					return false;
				});

				jQuery('#show_login_user_panel').life('click', function () {
					if (is_hidden_panel_active === true) {
						hiddenPanel.delay(350).animate({
							marginTop: '0'
						}, 450);
						is_hidden_panel_active = false;
					}
					loginPanel.animate({
						marginTop: '0'
					}, 450);
					formRegHidden.animate({
						height: loginPanelHeight
					}, 450);
					return false;
				});

			}());

			jQuery("#user_register_button2").life('click', function () {
				var user_name = jQuery("#user_name2").val();
				var user_email = jQuery("#user_email2").val();

				if (user_name == "" || user_email == "") {
					alert("Fill up all fileds please!");
					return false;
				}

				var data = {
					action: "app_authentication_user_register",
					user_name: user_name,
					user_email: user_email
				};
				//send data to server
				jQuery.post(ajaxurl, data, function (response) {
					jQuery("#register-info2").html(response);
					jQuery("#register-info2").show(333);
				});

				return false;
			});

			var lostpasswordform = jQuery('#lostpasswordform');

			if (lostpasswordform.length && jQuery('#user_login').length) {

				lostpasswordform.on('submit', function () {
					var user_login = jQuery("#user_login").val(),
						info_block = jQuery('<div class="lostpass-info"></div>').hide();

					if (!jQuery(this).find('.lostpass-info').length) {
						jQuery(this).append(info_block);
					}

					info_block = jQuery(this).find('.lostpass-info');
					info_block.hide().removeClass().addClass('lostpass-info');

					if (!user_login) {
						info_block.text(tmm_l10n.auth_enter_username).addClass('error').show();
						return false;
					}

					var data = {
						action: "tmm_auth_lostpass",
						user_login: user_login
					};

					jQuery.post(ajaxurl, data, function (response) {

						lostpasswordform.find('#user_login').val('');

						if (response.error && response.error != '') {
							info_block.text(response.error).addClass('error').show();
							return false;
						} else if (response.message && response.message === 'check_email') {
							info_block.text(tmm_l10n.auth_lostpass_email_sent).addClass('success').show();
						}

					}, 'json');

					return false;
				});

			}


		},
		login: function () {

			var user_login = jQuery("#tmm_user_login").val();
			var user_pass = jQuery("#tmm_user_pass").val();


			if (user_login == "" || user_pass == "") {
				jQuery(".error-login").animate({opacity: 1}, 400);
				return false;
			}


			var data = {
				action: "app_authentication_user_login",
				user_login: user_login,
				user_pass: user_pass
			};
			//send data to server
			jQuery.post(ajaxurl, data, function (response) {
				if (parseInt(response, 10) == 1) {
					window.location.reload();
				} else {
					jQuery(".error-login").animate({opacity: 1}, 400);
				}
			});

			return false;
		}
	};

	return self;
}
//*****

var thememakers_app_authentication = null;
jQuery(document).ready(function () {
	thememakers_app_authentication = new THEMEMAKERS_APP_AUTHENTICATION();
	thememakers_app_authentication.init();
});
