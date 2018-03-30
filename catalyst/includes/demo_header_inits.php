<?php
	if ( isset( $_GET['demo_theme_style'] ) ) $_SESSION['demo_theme_style']=$_GET['demo_theme_style'];
	if ( isset($_SESSION['demo_theme_style'] )) $demo_theme_style = $_SESSION['demo_theme_style'];
	
	if ( isset( $_GET['demo_header'] ) ) $_SESSION['demo_header']=$_GET['demo_header'];
	if ( isset($_SESSION['demo_header'] )) $demo_header = $_SESSION['demo_header'];
	
	if ( isset( $_GET['demo_header_color'] ) ) $_SESSION['demo_header_color']=$_GET['demo_header_color'];
	if ( isset($_SESSION['demo_header_color'] )) $demo_header_color = $_SESSION['demo_header_color'];
	
	if ( isset( $_GET['demo_font'] ) ) $_SESSION['demo_font']=$_GET['demo_font'];
	if ( isset($_SESSION['demo_font'] )) $heading_font = $_SESSION['demo_font'];
	
	if ( isset( $_GET['demo_title_color'] ) ) $_SESSION['demo_title_color']=$_GET['demo_title_color'];
	if ( isset($_SESSION['demo_title_color'] )) $demo_title_color = $_SESSION['demo_title_color'];

?>
<style type="text/css">
/* <![CDATA[ */

<?php if ( isset($_SESSION['demo_header'])<>"" ) { ?>
#header { background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/patterns/<?php echo $_SESSION['demo_header']; ?>.png); }
<?php } ?>

<?php if (isset($_SESSION['demo_header_color'])<>"") { ?>
body { background-color: <?php echo $demo_header_color; ?>; }
<?php } ?>

/* ]]> */
</style>