<?php
/**
 * Your Inspiration Themes
 * 
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
?>

<?php if (yit_get_option( 'show-login' )) : ?>
<div id="topbar_login"<?php if ( !is_user_logged_in() ): ?> class="not_logged_in"<?php endif ?>>
	
	
	<?php if ( !is_user_logged_in() ): ?>
	<a class="topbar_login" href="<?php echo wp_login_url( yit_curPageURL() ); ?>"><?php _e('LOGIN', 'yit') ?> <span class="sf-sub-indicator"></span></a>  
	<div id="fast-login" class="access-info-box">
		<form action="<?php echo wp_login_url( yit_curPageURL() ); ?>" method="post" name="loginform">
							
			<div class="form">
				<p>
					<label>
						<?php _e( 'Username', 'yit' ) ?><br/>
						<input type="text" tabindex="10" size="20" value="" name="log" class="input-text" />
					</label>
				</p>
								
				<p>
					<label>
						<?php _e( 'Password', 'yit' ) ?><br/>
						<input type="password" tabindex="20" size="20" value="" name="pwd" class="input-text" />
					</label>
				</p>
						

			
				<a class="align-left lostpassword" href="<?php echo wp_login_url(); ?>?action=lostpassword" title="<?php _e('Password Lost and Found', 'yit') ?>">
					<?php _e( 'lost password?', 'yit' ) ?>
				</a>
								
				<p class="align-right">
					<input type="submit" tabindex="100" value="<?php _e( 'Login', 'yit' ) ?>" name="wp-submit" class="input-submit" />
					<input type="hidden" value="<?php echo yit_curPageURL(); ?>" name="redirect_to" />
					<input type="hidden" value="1" name="testcookie" />
				</p>    
			</div>	
							
		</form>
	</div> 
	<?php else: ?>
	<a class="topbar_login" href="<?php echo wp_logout_url( yit_curPageURL() ); ?>"><?php _e('LOGOUT', 'yit') ?> <span class="sf-sub-indicator"></span></a>  
	<?php endif ?>
</div>
<?php endif ?>