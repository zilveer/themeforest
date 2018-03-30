<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	wp_reset_query();

	if (df_is_template_active("template-contact.php")) {
		$contactPages = df_get_page("contact");
		if($contactPages[0]) {
			$contactUrl = get_page_link($contactPages[0]);
		}
	} else {
		$contactUrl = false;
	}
 ?>

	<div class="the-error-msg">
		<strong class="font-replace"><?php esc_html_e("No Articles Found",THEME_NAME);?></strong>
		<p><?php printf(__('Sorry, there are no articles here ! <br/>You can <a href="%1$s">contact us</a> to resolve this problem !', THEME_NAME), $contactUrl);?></p>
		<p><?php printf(__('Or You can still <a href="%1$s">go back to Homepage</a> !', THEME_NAME), home_url());?></p>
	</div>