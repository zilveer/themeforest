<div class="center footer">
	
	<?php
		if( is_active_sidebar('footer1') )
			get_template_part('inc/content','footer');
	?>
	
	<!--TO TOP BUTTON-->
	<div class="wow bounce" data-wow-offset="80" data-wow-duration="2s">
		<a href="#home" class="scroll ebor-scroll">
			<span class="fa-stack fa-lg">
				<i class="fa fa-circle fa-stack-2x "></i>
				<i class="fa fa-angle-double-up fa-stack-1x fa-inverse"></i>
			</span>
		</a>
	</div>
	
	<!--COPYRIGHT NOTICE-->
	<div id="copyright" class="wow bounceIn" data-wow-offset="80" data-wow-duration="2s">
		<?php echo wpautop(htmlspecialchars_decode(get_option('copyright', 'Configure this message in "appearance" => "customize"'))); ?>
	</div>

</div>

<?php wp_footer(); ?>
</body>
</html>