<?php 
global $mk_settings;
$mk_footer_class = '';

$template = '';
if(global_get_post_id()) {
	$template = get_post_meta( global_get_post_id(), '_template', true );

}

if($mk_settings['footer-type'] == 'fixed') {
  $mk_footer_class .= ' mk-footer-fixed ';
}

if($template != 'no-footer' && $template != 'no-header-footer' && $template != 'no-header-title-footer' && $template !='no-sub-footer-title' && $template !='no-title-footer-sub-footer') :

if($mk_settings['footer'] == true && $template != 'no-footer-only' && $template != 'no-footer-title' && $template != 'no-header-title-only-footer' && $template != 'no-title-footer') : ?>
<div id="mk-footer-fixed-spacer"></div>
<section id="mk-footer" class="<?php echo $mk_footer_class; ?>" <?php echo get_schema_markup('footer'); ?>>
<div class="footer-wrapper mk-grid">
<div class="mk-padding-wrapper">
<?php
$footer_column = $mk_settings['footer-layout'];
if(is_numeric($footer_column)):
	switch ( $footer_column ):
		case 1:
		$class = '';
			break;
		case 2:
			$class = 'mk-col-1-2';
			break;
		case 3:
			$class = 'mk-col-1-3';
			break;
		case 4:
			$class = 'mk-col-1-4';
			break;
		case 5:
			$class = 'mk-col-1-5';
			break;
		case 6:
			$class = 'mk-col-1-6';
			break;		
	endswitch;
	for( $i=1; $i<=$footer_column; $i++ ):
?>
<?php if($i == $footer_column): ?>
<div class="<?php echo $class; ?>"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
<?php else:?>
			<div class="<?php echo $class; ?>"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
<?php endif;		
endfor; 

else : 

switch($footer_column):
		case 'third_sub_third':
?>
		<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
		<div class="mk-col-2-3">
			<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
			<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
			<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
		</div>
<?php
			break;
		case 'sub_third_third':
?>
		<div class="mk-col-2-3">
			<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
			<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
			<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
		</div>
		<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
<?php
			break;
		case 'third_sub_fourth':
?>
		<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
		<div class="mk-col-2-3 last">
			<div class="mk-col-1-4"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
			<div class="mk-col-1-4"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
			<div class="mk-col-1-4"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
			<div class="mk-col-1-4"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
		</div>
<?php
			break;
		case 'sub_fourth_third':
?>
		<div class="mk-col-2-3">
			<div class="mk-col-1-4"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
			<div class="mk-col-1-4"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
			<div class="mk-col-1-4"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
			<div class="mk-col-1-4"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
		</div>
		<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
<?php
			break;
		case 'half_sub_half':
?>
		<div class="mk-col-1-2"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
		<div class="mk-col-1-2">
			<div class="mk-col-1-2"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
			<div class="mk-col-1-2"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
		</div>
<?php
			break;
		case 'half_sub_third':
?>
		<div class="mk-col-1-2"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
		<div class="mk-col-1-2">
			<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
			<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
			<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
		</div>
<?php
			break;
		case 'sub_half_half':
?>
		<div class="mk-col-1-2">
			<div class="mk-col-1-2"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
			<div class="mk-col-1-2"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
		</div>
		<div class="mk-col-1-2"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
<?php
			break;
		case 'sub_third_half':
?>
		<div class="mk-col-1-2">
			<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
			<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
			<div class="mk-col-1-3"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
		</div>
		<div class="mk-col-1-2"><?php mk_sidebar_generator( 'get_footer_sidebar'); ?></div>
<?php
			break;
	endswitch;
endif;?> 
<div class="clearboth"></div>      
</div>
</div>
<div class="clearboth"></div>
<?php endif;?>

<?php if ( $mk_settings['sub-footer'] == true && $template != 'no-sub-footer' && $template != 'no-title-sub-footer') { ?>
<div id="sub-footer">
	<div class="mk-grid">
		<div class="item-holder">
		
    	<span class="mk-footer-copyright"><?php echo stripslashes($mk_settings['footer-copyright']); ?></span>

    	<?php do_action('subfooter_social'); ?>
    	<?php do_action('subfooter_logos'); ?>

		</div>
	</div>
	<div class="clearboth"></div>

</div>
<?php } ?>

</section>




<?php endif; ?>

</div><!-- End boxed layout -->
<a href="#" class="mk-go-top"><i class="mk-icon-angle-up"></i></a>
</div><!-- End Theme main Wrapper -->


<?php 
	do_action( 'side_dashboard'); 
	do_action( 'quick_contact'); 
?>



<?php wp_footer(); ?>
<?php if($mk_settings['custom-js']) : ?>
	<script type="text/javascript">
	<?php echo stripslashes($mk_settings['custom-js']); ?>
	</script>

<?php endif;

	if($mk_settings['google-analytics']){
		?>
		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', '<?php echo stripslashes($mk_settings['google-analytics']); ?>']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
<?php } ?>

<?php 
if($mk_settings['header-location'] == 'bottom') {
$header_padding_type = $mk_settings['sticky-header'] ? 'sticky-header' : 'none-sticky-header'; ?>
<div class="bottom-header-padding <?php echo $header_padding_type ?>"></div>
<?php 
}
?>

<script>
    // Run this very early after DOM is ready 
    (function ($) {
        // Prevent browser native behaviour of jumping to anchor
        // while preserving support for current links (shared across net or internally on page)
        var loc = window.location,
            hash = loc.hash;

        // Detect hashlink and change it's name with !loading appendix
        if(hash.length && hash.substring(1).length) {
            var $topLevelSections = $('.vc_row, .mk-page-section, #comments');
            var $section = $topLevelSections.filter( '#' + hash.substring(1) );
            // We smooth scroll only to page section and rows where we define our anchors.
            // This should prevent conflict with third party plugins relying on hash
            if( ! $section.length )  return;
            // Mutate hash for some good reason - crazy jumps of browser. We want really smooth scroll on load
            // Discard loading state if it already exists in url (multiple refresh)
            hash = hash.replace( '!loading', '' );
            var newUrl = hash + '!loading';
            loc.hash = newUrl;
        }
    }(jQuery));
</script>

</body>
</html>
