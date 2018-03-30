
<div class="page-wrapper vcenter-wrapper">
	
		<div class="vcenter">
			<div class="tj-password">
				<i class="fa fa-lock"></i>
			
				<form method="post" action="<?php echo esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) ?>">
					<p><?php _e('This page is password protected. To view it please enter your password below:','toranj');?></p>
					<p><label for="pwbox-531">Password:<br/>
					<input type="password" class="form-control" size="20" id="pwbox-531" name="post_password"/></label><br/>
					<input type="submit" class="btn btn-block btn-toranj" value="<?php _e('Submit','toranj'); ?>" name="Submit"/></p>
				</form>

			</div>
		</div>
	
</div>
	