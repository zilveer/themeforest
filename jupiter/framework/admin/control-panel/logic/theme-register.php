<?php
$mk_artbees_products = new mk_artbees_products();
$theme_name = ucfirst(THEME_NAME);
$apikey = get_option( 'artbees_api_key', '' );
$is_apikey = false;
$message = $error = "";

if($apikey!="")
	$is_apikey = true;

if(isset($_POST['apikey'])){
	if($_POST['apikey']=="" && $apikey!=""){
		delete_option( 'artbees_api_key' );
		$apikey = "";
		$is_apikey = false;
		$message = __( 'your api key is revoked.', 'mk_framework' );
	} else {
		$result = $mk_artbees_products->verify_artbees_apikey($_POST['apikey']);
		if($result['is_verified']){
			update_option( 'artbees_api_key', $_POST['apikey'], 'yes' );
			$apikey = $_POST['apikey'];
			$is_apikey = true;
			$message = __( 'Your API key  is verified.', 'mk_framework' );
		} else {
			delete_option( 'artbees_api_key' );
			$apikey = "";
			$is_apikey = false;
			$error = __( 'Your API key could not be verified. ', 'mk_framework' ) . ( isset($result['message']) ? $result['message'] : __( 'An error occured', 'mk_framework' ) ).'.';
		}
	}
} else if( !$mk_artbees_products->is_verified_artbees_customer() ){
	delete_option( 'artbees_api_key' );
	$apikey = "";
	$is_apikey = false;
}

?>
<div class="control-panel-holder">

<?php echo mk_get_control_panel_view('header', true, array('page_slug' => THEME_NAME)); ?>

<div class="wp-register-product cp-pane">
	<div class="product-register">
		<?php if(!$is_apikey) { ?> <h3><?php printf( esc_html__( 'Register %s', 'mk_framework' ), $theme_name ); ?></h3> <?php } ?>
		<?php if(!$is_apikey) { ?>
		<ol>
			<li><strong><?php printf( __( '<a href="%s" target="_blank">Sign up</a> to Help desk.', 'mk_framework' ), 'https://artbees.net/themes/login/' ); ?></strong></li>
			<li><?php printf( __( 'Generate an API Key.</strong> Get your <a href="%s" target="_blank">purchase code</a> from themeforest and enter it in your dashboard in artbees website.', 'mk_framework' ), 'https://artbees.net/themes/docs/where-can-i-find-my-purchase-code/' ); ?></li>
			<li><?php printf( __( 'Register your <a target="_blank" href="%s">API Key</a>.</strong> Enter your API key in the field below. All set!', 'mk_framework' ), 'http://artbees.net/themes/dashboard/register-product/' ); ?></li>
		</ol>
		<?php } else { ?>
		<h3><?php _e('Thanks for registering Jupiter!', 'mk_framework'); ?></h3>
		<?php } ?>
		<form action="<?php echo admin_url('admin.php?page='.THEME_NAME); ?>" method="POST">
			<div class="register-form <?php if($is_apikey) { echo "is-keyAdded"; } if($error!="") { echo "is-error"; } ?>">
				
				
				<label for="apikey"><?php _e('Artbees API Key', 'mk_framework'); ?></label>
				<div class="form-input">
					<div class="input-holder">
						<input type="text" name="apikey" size="30" value="<?php echo $apikey; ?>" id="apikey" spellcheck="true" autocomplete="on" placeholder="<?php _e('Enter your API key in here', 'mk_framework'); ?>">
					</div>
					
					<div class="button-holder">
						<?php if($is_apikey) { ?>
							<input type="submit" value="<?php _e('Revoke this API Key', 'mk_framework'); ?>" href="#" class="cp-button large blue button-revoke" id="revoke_button"/>
						<?php } else { ?>
							<input type="submit" value="<?php _e('Register', 'mk_framework'); ?>" href="#" class="cp-button large blue button-register"/>
						<?php } ?>
					</div>
				</div>
				<div class="register-product__message success-msg"><?php echo $message; ?></div>
				<div class="register-product__message error-msg"><?php echo $error; ?></div>
				</div>
		</form>
	</div>
	<hr/>
	<div class="how-to">
		<p><?php printf( __( 'Any problem? <a href="%s" target="_blank"><strong>View the tutorial here</strong></a>', 'mk_framework' ), 'https://artbees.net/themes/docs/how-to-register-theme/' ); ?></p>
		<div class="how-to-video-list">
			<div class="video-item">
				<a target="_blank" href="https://www.youtube.com/watch?v=I9FERyjuq4A">
					<img src="<?php echo THEME_CONTROL_PANEL_ASSETS; ?>/images/register-product-tuts-video.jpg" alt="">
					<i class="ic-play"></i>
				</a>
			</div>
		</div>
		<br><br><br>
		<strong><?php _e('Common issues', 'mk_framework'); ?></strong>
		<ul class="disc">
				<li><a target="_blank" href="http://artbees.net/themes/faq/why-i-need-to-register-my-theme/">Why I need to register my theme?</a></li>
				<li><a target="_blank" href="http://artbees.net/themes/faq/how-can-i-verify-my-api-key/">How can I verify my API Key?</a></li>
				<li><a target="_blank" href="http://artbees.net/themes/faq/why-my-api-key-inactive/">Why my API key is inactive?</a></li>
				<li><a target="_blank" href="http://artbees.net/themes/faq/what-are-the-benefits-of-registration/">What are the benefits of registration?</a></li>
				<li><a target="_blank" href="http://artbees.net/themes/faq/how-can-i-obtain-my-purchase-code/">How can I obtain my Purchase code?</a></li>
				<li><a target="_blank" href="http://artbees.net/themes/faq/i-get-this-error-when-registering-my-theme-duplicated-purchase-key-detected/">I get this error when registering my theme: Duplicated Purchase Key detected?</a></li>
		</ul>
	</div>
</div>
</div>
