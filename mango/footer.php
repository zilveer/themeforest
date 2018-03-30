<?php
		global $mango_settings;
		if(mango_load_footer()) {
			$current_footer = mango_current_footer();
			get_template_part ( 'footer/footer',$current_footer);
		}
?>
<?php 
	if(mango_load_wrapper()){ ?>
</div><!-- End #wrapper -->
		<a href="#wrapper" id="scroll-top" title="Top"><i class="fa fa-angle-up"></i></a>
		<!-- END -->
<?php } ?>
<?php 
	if ( isset( $mango_settings[ 'mango_jscode' ] ) && $mango_settings[ 'mango_jscode' ] ) : ?>
    <script type="text/javascript">
        /* <![CDATA[ */
        <?php echo $mango_settings['mango_jscode']; ?>
        /* ]]> */
    </script>
<?php endif ?>
<?php wp_footer(); ?>
</body>
</html> 