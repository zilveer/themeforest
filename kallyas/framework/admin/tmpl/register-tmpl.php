<?php if(! defined('ABSPATH')){ return; } ?>
<div class="znfb-row">
	<div class="znfb-col-7">
		<h3 class="zn-lead-title">Register your theme for automatic updates</h3>
		<div class="zn-lead-text">
			<p>We strongly recommmend you to register your theme. By registering it, you will get automatic updates and notifications as well.</p>
			<p><strong>All you have to do is follow these steps :</strong></p>
			<ul>
				<li>Add your ThemeForest username in the form on the right;</li>
				<li>Generate an API key on ThemeForest. Please type the username first, and click onto the link right above the API key field. It'll take you to your ThemeForest account's - API KEY Generator;</li>
				<li>Fill the rest of the form and hit REGISTER.</li>
			</ul>
		</div>
	</div>

	<div class="znfb-col-5">
		<?php
			$option_name = ZN()->theme_data['theme_id'].'_update_config';
			$saved_config = get_option( $option_name );
			$tf_username  = isset( $saved_config['tf_username'] ) ? $saved_config['tf_username'] : '';
			$tf_api       = isset( $saved_config['tf_api'] ) ? $saved_config['tf_api'] : '';
		?>
		<form action="" class="zn-about-register-form">
			<div id="zn-register-theme-alert"></div>
			<div class="zn-about-form-field">
				<label for="tf_username">Themeforest Username</label>
				<input type="text" id="tf_username" class="zn-about-register-form-username" value="<?php echo $tf_username;?>" placeholder="Themeforest username">
			</div>
			<div class="zn-about-form-field">
				<label for="tf_api_key">Themeforest API key</label>
				<div class="zn-about-label-desc js-zn-label-tfusername">After you type your ThemeForest username in the field above, <a href="#" class="js-zn-label-tfusername-link tfusername-link--nope" target="_blank">click here to go to your "Generate API Key" page on ThemeForest</a>. </div>
				<input type="text" id="tf_api_key" class="zn-about-register-form-api" value="<?php echo $tf_api;?>" placeholder="Themeforest API key">
			</div>

			<?php wp_nonce_field( 'zn_theme_registration', 'zn_nonce' ); ?>
			<input type="submit" class="zn-about-register-form-submit zn-about-action zn-action-green zn-action-md" value="REGISTER">
		</form>
	</div>
</div>
