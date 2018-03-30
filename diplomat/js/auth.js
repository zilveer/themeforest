(function($) {

	$(function() {

		var loginButton = document.querySelector( '[data-login]' ),
			accountButton = document.querySelector( '[data-account]');

		if (loginButton && accountButton) {

			/* ---------------------------------------------------- */
			/*	Dialog Window Init									*/
			/* ---------------------------------------------------- */

			var loginDialog = document.getElementById( loginButton.getAttribute( 'data-login' ) ),
				accountDialog = document.getElementById( accountButton.getAttribute( 'data-account' ) ),
				resetDialog = document.getElementById('resetDialog'),
				loginDlg = new DialogFx(loginDialog, {
					onOpenDialog : function(){
						$(loginDialog).find('input').eq(0).trigger('focus');
					}
				}),
				accountDlg = new DialogFx(accountDialog, {
					onOpenDialog : function(){
						$(accountDialog).find('input').eq(0).trigger('focus');
					}
				}),
				resetDlg = new DialogFx(resetDialog, {
					onOpenDialog : function(){
						$(resetDialog).find('input').eq(0).trigger('focus');
					},
					onCloseDialog : function(){
						$(resetDialog).find('#user_mail').val('');
						$(resetDialog).find('.dialog-error').empty().hide();
					}
				});

			loginButton.addEventListener( 'click', function(e){
				e.preventDefault();
				loginDlg.toggle(loginDlg);
			});
			accountButton.addEventListener( 'click', function(e){
				e.preventDefault();
				accountDlg.toggle(accountDlg);
			});

			/* ---------------------------------------------------- */
			/*	Dialog Window Buttons Handlers     					*/
			/* ---------------------------------------------------- */

			var login_modal = $(loginDialog),
				login_form = login_modal.find('form'),
				account_modal = $(accountDialog),
				account_form = account_modal.find('form'),
				reset_modal = $(resetDialog),
				reset_form = reset_modal.find('form');

			login_modal.find('.reset-pass').on('click', function (e) {
				e.preventDefault();
				login_modal.find('.action-close').trigger('click');
				resetDlg.toggle(resetDlg);
				return false;
			});

			account_modal.find('.dialog-login-button').on('click', function (e) {
				e.preventDefault();
				account_modal.find('.action-close').trigger('click');
				$(loginButton).trigger('click');
				return false;
			});

			reset_modal.find('.dialog-login-button').on('click', function (e) {
				e.preventDefault();
				reset_modal.find('.action-close').trigger('click');
				$(loginButton).trigger('click');
				return false;
			});

			login_form.on('submit', function (e) {
				e.preventDefault();

				var user_login = login_form.find('#user_login').val(),
					user_pass = login_form.find('#user_pass').val(),
					rememberme = login_form.find('#rememberme').val();

				if (user_login == "" || user_pass == "") {
					return false;
				}

				var data = {
					action: "tmm_user_login",
					log: user_login,
					pwd: user_pass,
					rememberme: rememberme
				};

				$.post(ajaxurl, data, function (response) {
					if (parseInt(response, 10) == 1) {
						window.location.reload();
					} else {
						login_modal.find('.dialog-error').empty().html(response).fadeIn();
					}
				});

				return false;
			});

			account_form.on('submit', function (e) {
				e.preventDefault();

				var user_name = account_form.find('#user_name').val(),
					user_email = account_form.find('#user_email').val();

				if (user_name == "" || user_email == "") {
					return false;
				}

				var data = {
					action: "tmm_user_register",
					user_name: user_name,
					user_email: user_email
				};

				$.post(ajaxurl, data, function (response) {

					if (response.error && response.error != '') {
						account_modal.find('.dialog-error').empty().text(response.error).fadeIn();
					} else if (response.message) {
						account_modal.find('.dialog-error').empty().text(response.message).fadeIn();
						setTimeout(function(){
							account_modal.find('.action-close').trigger('click');
							$('.account .lock').trigger('click');
							account_form.find('#user_name').val('');
							account_form.find('#user_email').val('');
							account_modal.find('.dialog-error').empty();
						}, 2000);
					}
				}, 'json');

				return false;
			});

			reset_form.on('submit', function (e) {
				e.preventDefault();

				var user_email = reset_form.find('#user_mail').val();

				if (user_email == "") {
					return false;
				}

				var data = {
					action: "tmm_user_reset_pwd",
					user_login: user_email
				};

				$.post(ajaxurl, data, function (response) {

					if (response.error && response.error != '') {
						reset_modal.find('.dialog-error').empty().html(response.error).fadeIn();
					} else if (response.message) {
						reset_modal.find('.dialog-error').empty().html(response.message).fadeIn();
						setTimeout(function(){
							reset_modal.find('.action-close').trigger('click');
							reset_form.find('#user_mail').val('');
							reset_modal.find('.dialog-error').empty();
						}, 2000);
					}
				}, 'json');

				return false;
			});

		}

	});

}(jQuery));
