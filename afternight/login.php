<?php if(!is_user_logged_in()) { ?>
<iframe id="registration_iframe" name="registration_iframe" class="hidden"></iframe>
			
<div class="centered bottom-separator">
	<h3>
		Login
	</h3>
</div>
<?php				
		$register_link=home_url().'?action=register';
		$recover_link=home_url().'?action=recover';	
		
			if(isset($_GET['action']) && $_GET['action']=='register'){?>
			<div class="login">
				<div class="register">
					
					<form action="" method="post" class="form txt" id="register_form">
						<div class="row">
						<fieldset>
							<div class="login_inside">
								<div class="six columns">
									<input type="text" id="user_login" name="login" onblur="if (this.value == '') {this.value = '<?php echo __( 'Your name' , 'cosmotheme' );?>';}" onfocus="if (this.value == '<?php echo __( 'Your name' , 'cosmotheme' );?>') {this.value = '';}" value="<?php echo __( 'Your name' , 'cosmotheme' );?>">
								</div>
								<div class="six columns">
									<input type="text" id="user_email" name="email" onblur="if (this.value == '') {this.value = '<?php echo __( 'Your email' , 'cosmotheme' );?>';}" onfocus="if (this.value == '<?php echo __( 'Your email' , 'cosmotheme' );?>') {this.value = '';}" value="<?php echo __( 'Your email' , 'cosmotheme' );?>">
								</div>

								<div class="twelve columns">
									<div class="login-error" id="registration_error"></div>
								</div>
								<div class="six columns">
									<span class="login-linedup"><?php echo __( 'Already a member?' , 'cosmotheme' ); ?> | <a href="<?php echo home_url().'?action=login';?>" id="login" class="try"><?php echo __( 'Log in here' , 'cosmotheme' ); ?></a></span>
								</div>
								<div class="six columns">
									<p class="button submit gray">
										<input type="submit" value="Register" class="button" id="register_button">
									</p>
								</div>
								<input type="hidden" name="testcookie" value="1" />
							</div>
						</fieldset>
						</div>
					</form>
				</div>
			</div>
			
		<?php }elseif( isset( $_GET['action'] ) && $_GET['action'] == "recover" ){ ?>
			<div class="login">
				<form name="lostpasswordform" id="lostpasswordform" action="<?php echo get_bloginfo( 'wpurl');?>/wp-login.php?action=lostpassword" method="post" class="form txt" target="registration_iframe">
					<div class="row">
						<fieldset>
							<div class="login_inside">
								<div class="twelve columns">
									<p>
										<input type="text" id="user_login" name="user_login" onblur="if (this.value == '') {this.value = '<?php echo __( 'Your username or email' , 'cosmotheme' );?>';}" onfocus="if (this.value == '<?php echo __( 'Your username or email' , 'cosmotheme' );?>') {this.value = '';}" value="<?php echo __( 'Your username or email' , 'cosmotheme' );?>">
									</p>
								</div>
								<div class="six columns">
									<span class="login-linedup"><?php echo __( 'Already a member?' , 'cosmotheme' ); ?> | <a href="<?php echo home_url().'?action=login'; ?>" id="login" class="try"><?php echo __( 'Log in here' , 'cosmotheme' ); ?></a></span>
								</div>
								<div class="six columns">
									<p class="button submit gray fr">
										<input type="submit" value="Recover" class="button">
									</p>
								</div>
								<div class="twelve columns">
									<p>
										<div class="login-success" style="border:none" id="registration_error"></div>
									</p>
								</div>
							</div>
						</fieldset>
					</div>
				</form>
			</div>
			
		<?php }else{ ?>
			<div class="login">
				<div class="login-image-icon"></div>
				<div class="row">
					<div class="twelve columns">
						<form name="loginform" id="cosmo-loginform" action="<?php echo get_template_directory_uri();?>/wp-login.php" method="post" class="form txt">
							<div class="row">
								<fieldset>
									<div class="login_inside">
											<div class="six columns">
												<input name="login" id="username" type="text" class="" onblur="if (this.value == '') {this.value = '<?php echo __( 'username' , 'cosmotheme' );?>';}" onfocus="if (this.value == '<?php echo __( 'username' , 'cosmotheme' );?>') {this.value = '';}" value="<?php echo __( 'username' , 'cosmotheme' );?>" />
											</div>
											<div class="six columns">
												<input name="password" id="password" type="password" class="" onblur="if (this.value == '') {this.value = '<?php echo __( 'Password:' , 'cosmotheme' );?>';}" onfocus="if (this.value == '<?php echo __( 'Password:' , 'cosmotheme' );?>') {this.value = '';}" value="<?php echo __( 'Password:' , 'cosmotheme' );?>" />
											</div>
											<div class="six columns">
												<div class="login-linedup">
													<p class="rememberme">
														<label class="remember"><input name="remember" type="checkbox" id="rememberme" value="forever" tabindex="90" /><?php echo __( 'Remember Me' , 'cosmotheme' );?></label>
													</p>
												</div>
											</div>
											<div class="six columns">
												<p class="submit button gray fr">
													<input type="submit" id="login_button" value="Login" class="button" />
												</p>
											</div>
											<div class="twelve columns">
												<p class="error-report">
												<span class="login-error" id="registration_error"></span>
												</p>
												<p class="not_logged_msg like_warning " style="display:none"><?php _e('You need to sign in to vote for a post.','cosmotheme') ?> </p>
												<p class="not_logged_msg " style="display:none"><?php _e('You need to sign in to see this post.','cosmotheme') ?> </p>
											</div>
										
											<div class="lost twelve columns centered">
												<div class="login_inside">
						                        <?php
						                        	if( !( options::get_value( 'social' , 'facebook_app_id' ) == '' || options::get_value( 'social' , 'facebook_secret' ) == '' ) ){
						                                ?>
						                                <div class="facebook">
						                                    <?php facebook::login(); ?>
						                                </div>    
						                                <?php
						                            }
						                        ?>
												<p class="pswd">
													<span>
														<a href="<?php echo $recover_link;?>">
															<?php echo __( 'Lost your password?' , 'cosmotheme' );?>
														</a>
													</span>
													<?php if(get_option('users_can_register')) { ?> | 
														<span><a href="<?php echo $register_link;?>"><?php echo __( 'Register' , 'cosmotheme' );?></a></span>
													<?php } ?>
												</p>
												</div>
											</div>
										</div>
								</fieldset>
								<input type="hidden" name="testcookie" value="1" />
							</div>
						</form>
					</div>
				</div>
			</div>

	<?php	
		}?>

<?php }else{ 
	_e('You are already logged in.','cosmotheme');
}?>

