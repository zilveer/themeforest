<?php global $smof_data; ?>
		</div>
		<footer>
		<?php cshero_footer(); ?>
		<?php echo $smof_data["space_body"]; ?>
		<?php if($smof_data['footer_to_top'] == '1'): ?>
		<a id="back_to_top" class="back_to_top">
			<span class="go_up">
				<i style="" class="fa fa-arrow-up"></i>
			</span></a>
		<?php endif; ?>
		<div id="cs-debug-wrap" class="clearfix">
            <?php dynamic_sidebar('cshero-debug-widget');?>
        </div>
		<?php wp_footer(); ?>
		</footer>
	</body>
</html>