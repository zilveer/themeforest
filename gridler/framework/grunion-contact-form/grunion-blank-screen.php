<style>
	.fb-default-container { width: 416px; float: left; padding-right: 32px; margin-right: 32px; border-right: 1px solid #EEE; font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif; }
	.fb-default-container p { color: #555; font-size: 12px; line-height: 20px; }
	.fb-default-right { float: left; width: 216px; font-family:"Lucida Grande",Verdana,Arial,"Bitstream Vera Sans",sans-serif; }
	.fb-default-right p { font-size: 11px; margin-bottom: 19px; }
	.fb-header-text { color: #333; font-size:16px; }
</style>


<div class="fb-default-container">
	<div class="fb-header-text">How can I add a contact form?</div>
	<p>
	1) Navigate to the <a href="<?php echo admin_url( 'edit.php' ); ?>"><strong>post</strong></a> or <a href="<?php echo admin_url( 'edit.php?post_type=page' ); ?>"><strong>page</strong></a> where you'd like to add a contact form<br>
	2) Click the "add contact form" icon as seen to the right.<br>
	3) Customize your contact form fields<br>
	4) Add your contact form to your post/page<br>
	5) Publish or update your post/page.<br>
	</p>
	<div class="fb-header-text">What happens to feedback after it's submitted?</div>
	<p>Once a reader submits feedback through your contact form it is first checked by Akismet for spam. If it's legitimate, you'll receive an email containing the feedback.  If Akismet flags it as spam, it will go straight to your spam folder (and no email will be sent to you).  You can then view all of your feedback by clicking the feedbacks link.</p>
</div>
<div class="fb-default-right">
	<img src="blank-screen-button.png" width="216" height="88" alt="Add contact form button">
	<p>Add a contact form to any <a href="<?php echo admin_url( 'edit.php' ); ?>">post</a> or <a href="<?php echo admin_url( 'edit.php?post_type=page' ); ?>">page</a> by <strong>clicking this icon</strong>.</p>
	<img src="blank-screen-akismet.png" width="216" height="88" alt="Auto-scanned for spam">
	<p>Spam is automatically detected and moved to your spam folder.</p>
</div>
<div style="clear: both;"></div>
