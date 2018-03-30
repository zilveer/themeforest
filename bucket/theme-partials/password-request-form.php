<?php global $wpgrade_private_post; ?>
<div id="main" class="content djax-updatable">
	<div class="page-content">
		<div class="page-main">
			<header class="entry__header">
				<h1 class="entry__title"><?php _e('Password ', 'bucket');  the_title(); ?></h1>
				<div class="bleed--left"><hr class="separator separator--dotted grow"></div>
			</header>
			<div class="entry__body">
				<form method="post" action="<?php the_permalink() ?>" class="comment-respond">
					<?php wp_nonce_field('password_protection','submit_password_nonce'); ?>
					<input type="hidden" name="submit_password" value="1" />
				
					<?php 
						if($wpgrade_private_post['error']) {
							echo $wpgrade_private_post['error'];
							echo '<p>'.__('Please enter your password again:', 'bucket').'</p>';
						} else {
							echo '<p>'.__('To view it please enter your password below:', 'bucket').'</p>';
						}
					?>
					
					<div class="row">
						<div class="col-6 hand-span-6">
							<input type="password" required="required" size="20" id="pwbox-531" name="post_password" placeholder="<?php _e('Password..', 'bucket') ?>"/></label><br/>
						</div>
						<div class="col-6 hand-span-6">
							<input type="submit" name="Submit" value="Access" placeholder="Access" class="btn btn--huge post-password-submit"/>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>