<script type="text/javascript">
var searchfind = "<?php echo __('Find..', 'satori'); ?>";
</script>

<?php
// Special variable for the menu javascript
if (function_exists( 'get_option_tree' ) && get_option_tree('menu_show') == "Always display the menu") {
?>
<script type="text/javascript">
var always = <?php echo '1'; ?>;        
</script>
<?php } else { ?>
<script type="text/javascript">
var always = <?php echo '0'; ?>;        
</script>
<?php } ?>

<!-- insert custom Google fonts -->
<?php 
	if ( function_exists( 'get_option_tree' ) ) {
		if ( is_string( get_option_tree( 'font_header' ) )) {
			$fontheader = get_option_tree( 'font_header' );
			$fontheaderstr = str_replace(' ', '+', $fontheader);
			$fontheadernew = '<link href="http://fonts.googleapis.com/css?family='.$fontheaderstr.'" rel="stylesheet" type="text/css">';
			echo $fontheadernew;  } 
		else {
			echo "<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>";
		} 
	} 

	if ( function_exists( 'get_option_tree' ) ) {
		if ( is_string( get_option_tree( 'font_body' ) )) {
			$fontbody = get_option_tree( 'font_body' );
			$fontbodystr = str_replace(' ', '+', $fontbody);
			$fontbodynew = '<link href="http://fonts.googleapis.com/css?family='.$fontbodystr.'" rel="stylesheet" type="text/css">';
			echo $fontbodynew;  } 
		else {
			echo "<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>";
		} 
	}
?>


<!-- function to convert colours from hex into rgb -->
<?php
function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);
 
   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}
?>


<!-- Count the number of active widgets -->
<?php
function count_widgets($loc) {
	$sidebar_widgets = wp_get_sidebars_widgets();
	$num_widgets = 0;
	foreach ( (array) $sidebar_widgets as $k => $v ){
		if ($loc != $k)
		continue;
		if ( is_array($v))
		$num_widgets = $num_widgets + count($v);
		}
		return $num_widgets;
	}
	$count = count_widgets('sidebar-2');
	if($count != 0) { $percentage = (100/$count) - 5; }
	
	echo '<style type="text/css">@media only screen and (min-width: 767px) {
#footer .widget-footer { width:'; if(isset($percentage)) { echo $percentage; } echo '%; } }</style>';
?>

<!-- Set correct submenu height -->
<script type="text/javascript">
var $subm = jQuery.noConflict();
$subm(document).ready(function () {
	var menuheight = parseInt($subm('#menu-main-menu > li > a').css('line-height'), 10)+24;
	$subm('#nav-primary ul li ul li').css('line-height',menuheight+'px');
});
</script>

<!--[if IE 7]>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/ie7.css">
<style type="text/css"> #footer-widget-area .widget-footer { width: <?php if(isset($percentage)) { echo $percentage."%;"; } ?> } </style>
<![endif]-->

<!--[if IE 8]>
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/ie8.css">
<style type="text/css"> #footer-widget-area .widget-footer { width: <?php if(isset($percentage)) { echo $percentage."%;"; } ?> } </style>
<![endif]-->

<!-- Google Analytics code -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php if ( function_exists( 'get_option_tree' ) )  { echo get_option_tree( 'google_analytics' ); } ?>']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

<!-- Resize image background -->
<?php if (function_exists( 'get_option_tree' ) &&  get_option_tree('background' ) == "Stretched image") { ?>
<script type="text/javascript">
resizeBG = function() {
    var image = $('#page-background img');
    image.removeAttr("width"); 
    image.removeAttr("height");
    var imageWidth = image.attr('width') || image.width();
    var imageHeight = image.attr('height') || image.height();
    var ratio = imageHeight / imageWidth;
    
    var h = $(window).height();
    var w = $(window).width();
    
    $('#page-background img, #page-background').css('width', w);
    $('#page-background img, #page-background').css('height', w * ratio);
	$('#page-background').css('visibility', 'visible');
}

$(window).load( resizeBG );
$(window).resize( resizeBG );
</script>
<?php } ?>