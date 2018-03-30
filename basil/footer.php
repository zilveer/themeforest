	<!-- FOOTER -->
	<footer>
		<div class="basilShell cf">
		
			<?php
			
			$bottom_left_content = ot_get_option('to_footer_bottom_left','text');
			switch($bottom_left_content){
					
				case 'socials' :
					basil_render_socials();
				break;
				
				case 'text' :
					?><div class="basilLeft">
						<?php echo do_shortcode(ot_get_option('to_footer_bottom_left_text')); ?>
					</div><?php
				break;
				
			}
			
			$bottom_right_content = ot_get_option('to_footer_bottom_right','text');
			switch($bottom_right_content){
					
				case 'socials' :
					?><div class="basilSocials basilRight">
						<ul>
							<?php basil_render_socials(); ?>
						</ul>
					</div><?php
				break;
				
				case 'text' :
					?><div class="basilRight">
						<?php echo do_shortcode(ot_get_option('to_footer_bottom_right_text')); ?>
					</div><?php
				break;
				
			}
			
			?>
			
		</div>
	</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>