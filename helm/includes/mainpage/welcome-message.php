<section>
	<div class="bigsaywrap clearfix">
		<div class="bigsaytext">
			<?php echo stripslashes_deep ( of_get_option('welcome_msg') ); ?>
		</div>
		<div class="bigbutton">
			<a href="<?php echo stripslashes_deep ( of_get_option('welcome_button_link') ); ?>">
			<?php echo stripslashes_deep ( of_get_option('welcome_button_text') ); ?>
			</a>
		</div>
	</div>
</section>