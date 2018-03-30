<?php
$feature = of_get_option('active_feature', '1') == '1';
$social = of_get_option('social_footer', '1') == '1';
$the_year = date("Y");

echo '
	</div><!-- end #wrap -->';	
if ($feature) {
    require_once('feature.php');
}
echo '
</div><!-- end #contback -->

<!-- Footer -->
<div id="footer">
	<div class="footer-wrap">
	<div class="footer-row fixed">

' . wize_set_section('zone-footer') . ' ';

if ( is_active_sidebar( 'footer-left' ) ) {
	echo '
		<div class="footer-col">	
	' . wize_set_zone(370) . ' ';
	dynamic_sidebar('footer-left');
	echo '
		</div><!-- end .footer-col -->';
}

if ( is_active_sidebar( 'footer-center' ) ) {	
	echo '
		<div class="footer-col">
	' . wize_set_zone(370) . ' ';
	dynamic_sidebar('footer-center');
	echo '
		</div><!-- end .footer-col -->';
}

if ( is_active_sidebar( 'footer-right' ) ) {
	echo '
		<div class="footer-col">
	' . wize_set_zone(370) . ' ';
	dynamic_sidebar('footer-right');
	echo '
		</div><!-- end .footer-col -->';
}
	
echo '
	</div><!-- end .footer-row fixed -->	
	</div><!-- end .footer-wrap -->		
</div><!-- end #footer -->';

if ($social) {
    require_once('social-footer.php');
}

echo '
<div id="footer-bottom"> 
	<div class="footer-copyright">';
if (of_get_option("text_copyright") != '') {
    echo '' . of_get_option('text_copyright') . '';
} else {
    echo '
			&copy; ' . $the_year . ' ';
    bloginfo('name');
    echo '' . esc_html__( ". All Rights Reserved.", "wizedesign" ) . '';
}

echo '
	</div><!-- end .footer-copyright -->
</div><!-- end #footer-bottom -->';

require_once('js/JSscript.php');

wp_footer();
?>

</body>
</html>