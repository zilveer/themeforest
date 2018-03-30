<?php

//add_action('admin_menu', 'us_add_product_validation_page', 50);
//
//if ( ! function_exists('us_add_product_validation_page'))
//{
//	function us_add_product_validation_page()
//	{
//		add_submenu_page( 'us-home', 'Grata: Product Validation', 'Product Validation', 'manage_options', 'us-product-validation', 'us_page_product_validation' );
//	}
//}

if ( !function_exists('us_page_product_validation'))
{
	function us_page_product_validation()
	{
		?>

			<div class="wrap us-body">
				<div class="us-validation">
			
					<h1>Theme Validation</h1>

					<form class="us-form for_validation" method="post">
						<div class="us-form-row">
							<div class="us-form-row-description">Enter your <a href="http://help.us-themes.com/assets/img/find-item-purchase-code.png" target="_blank" title="Click to see how to find your Item Purchase Code">Item Purchase Code</a>. This code will be attached to domain name: <span class="domain">example.com</span> (you can change this domain name later).</div>
						</div>
						<div class="us-form-row">
							<input id="validation" class="large-text" type="text" value="" name="validation">
							<div class="us-form-row-state"></div>
						</div>
						<div class="us-form-row for_submit">
							<input class="button button-primary" type="submit" value="Validate" name="validate">
						</div>
					</form>
					
					<h1>Theme Validation</h1>

					<form class="us-form for_validation" method="post">
						<div class="us-form-row">
							<div class="us-form-row-description">Enter your <a href="http://help.us-themes.com/assets/img/find-item-purchase-code.png" target="_blank" title="Click to see how to find your Item Purchase Code">Item Purchase Code</a>. This code will be attached to domain name: <span class="domain">example.com</span> (you can change this domain name later).</div>
						</div>
						<div class="us-form-row check_wrong">
							<input id="validation" class="large-text" type="text" value="12a73cc3-bf18-40af-8617-3c88753bcf1b" name="validation">
							<div class="us-form-row-state">The provided purchase code is not valid</div>
						</div>
						<div class="us-form-row for_submit">
							<input class="button button-primary" type="submit" value="Validate" name="validate">
						</div>
					</form>
					
					<h1>Theme Validation</h1>

					<form class="us-form for_validation" method="post">
						<div class="us-form-row">
							<div class="us-form-row-description">The code below will be attached to domain name: <span class="domain">example.com</span> (you can change this domain name later).</div>
						</div>
						<div class="us-form-row">
							<input id="validation" class="large-text" type="text" value="12a73cc3-bf18-40af-8617-3c88753bcf1b" name="validation" disabled="disabled">
							<div class="us-form-row-state"></div>
						</div>
						<div class="us-form-row">
							<div class="us-form-row-description">Your Envato user is not yet registered at our <a href="http://help.us-themes.com/" target="_blank">Support Portal</a>.<br>To complete validation please create Support Portal account by providing your email (your password will be sent to this email):</div>
						</div>
						<div class="us-form-row">
							<input id="validation" class="large-text" type="text" value="" name="validation" placeholder="Your Email">
							<div class="us-form-row-state"></div>
						</div>
						<div class="us-form-row for_submit">
							<input class="button button-primary" type="submit" value="Validate and Create Account" name="validate">
						</div>
					</form>
					
					<h1>Theme Validation</h1>

					<form class="us-form for_validation" method="post">
						<div class="us-form-row">
							<div class="us-form-row-description">The code below will be attached to domain name: <span class="domain">example.com</span> (you can change this domain name later).</div>
						</div>
						<div class="us-form-row">
							<input id="validation" class="large-text" type="text" value="12a73cc3-bf18-40af-8617-3c88753bcf1b" name="validation" disabled="disabled">
							<div class="us-form-row-state"></div>
						</div>
						<div class="us-form-row">
							<div class="us-form-row-description">Your Envato user is not yet registered at our <a href="http://help.us-themes.com/" target="_blank">Support Portal</a>.<br>To complete validation please create Support Portal account by providing your email (your password will be sent to this email):</div>
						</div>
						<div class="us-form-row check_wrong">
							<input id="validation" class="large-text" type="text" value="blablabla" name="validation" placeholder="Your Email">
							<div class="us-form-row-state">The provided email is incorrect</div>
						</div>
						<div class="us-form-row for_submit">
							<input class="button button-primary" type="submit" value="Validate and Create Account" name="validate">
						</div>
					</form>
					
					<h1>Theme Validation</h1>

					<form class="us-form for_validation" method="post">
						<div class="us-form-row">
							<div class="us-form-row-description">Enter your <a href="http://help.us-themes.com/assets/img/find-item-purchase-code.png" target="_blank" title="Click to see how to find your Item Purchase Code">Item Purchase Code</a>. This code will be attached to domain name: <span class="domain">example.com</span> (you can change this domain name later).</div>
						</div>
						<div class="us-form-row check_wrong">
							<input id="validation" class="large-text" type="text" value="12a73cc3-bf18-40af-8617-3c88753bcf1b" name="validation">
							<div class="us-form-row-state">The provided purchase code is already attached to other domain name</div>
						</div>
						<div class="us-form-row">
							<div class="us-form-row-description">Your purchase allows you to use this theme on one domain only. You can change attached domain name at your <a href="https://help.us-themes.com/user/myph/licenses/" target="_blank">licenses page</a> or you can <a href="#" target="_blank">buy another license</a>.</div>
						</div>
						<div class="us-form-row for_submit">
							<input class="button button-primary" type="submit" value="Validate" name="validate">
						</div>
					</form>
					
					<h1>Theme Validation</h1>

					<div class="us-form for_validation">
						<div class="us-form-row">
							<div class="us-form-row-success">Your theme is validated successfully. All premium options are available to you.</div>
						</div>
					</div>
				
				</div>
			</div>

		<?php
	}
}
