<?php
function demo_scripts_styles() {
?>
<link href="<?php echo get_template_directory_uri(); ?>/framework/demopanel/demo.panel.css" rel="stylesheet" type="text/css" />
<?php
}
function demo_scripts_scripts() {
?>
<script type="text/javascript">
/* <![CDATA[ */
/*
Demo Panel Script
*/
jQuery(document).ready(function(){
	var panelOpen = jQuery('#demopanel .demo_toggle');
	var panelWrap = jQuery('.paneloptions');
	
	panelOpen.hover(
	function () {
	  panelWrap.stop().animate({ top: '15'}, {duration: 'fast'});
	},
	function () {
	  panelWrap.stop().animate({ top: '-70'}, {duration: 1500});
	});	
	panelWrap.hover(
	function () {
	  panelWrap.stop().animate({ top: '15'}, {duration: 'fast'});
	},
	function () {
	  panelWrap.stop().animate({ top: '-70'}, {duration: 1500});
	});
});
/* ]]> */
</script>
<?php
	}
	add_action('wp_head','demo_scripts_styles',12);
	add_action('wp_footer','demo_scripts_scripts',20);
?>