<div class="clear"></div>

<?php if( get_option('footer_left') || get_option('footer_right') ) : ?>
	<footer id="main-footer">
			
			
			<?php 
				/**
				 * Get footer widgets depending on active columns
				 */
				get_template_part('loop/content','footerwidgets'); 
			?>
			<div class="clear"></div>
			
			
			<div class="one_half">
				<?php echo wpautop(htmlspecialchars_decode(esc_textarea(get_option('footer_left', 'Configure this message in "appearance" => "customize"'))));  ?>
			</div>
			
			<div class="one_half last subtext">
				<?php echo wpautop(htmlspecialchars_decode(esc_textarea(get_option('footer_right', 'Configure this message in "appearance" => "customize"'))));  ?>
			</div>
			<div class="clear"></div>
		
	</footer>
<?php endif; ?>

<div class="clear"></div>
</div><!--/.wrapper-->

<?php wp_footer(); ?>
</body>
</html>