<div class="clear"></div>
<div id="footer">
    <div id="footer_button">
        <div id="toggle_button" class="uparrow"></div>
    </div>
    <div id="footer_content">
    <div class="footbox"><?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Left') ) ?></div>
        <div class="footbox"><?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Left Center') ) ?> </div>
        <div class="footbox"><?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Right Center') ) ?></div>
        <div class="footbox"><?php	/* Widget Area */	if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Footer Right') ) ?></div>
        <div class="clear"></div>
  
	</div>
</div>
<!--END Credits Section-->
<script type="text/javascript" src="<?php echo home_url(); ?>/index.php?ag_customjs_var=js"></script>
<!-- Theme Hook -->
<?php wp_footer(); ?>
</body>
</html>