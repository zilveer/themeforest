<?php
function ct_hex_2_rgb($hex, $asString = true) {
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
	if($asString){
		return implode(",", $rgb);
	}
   return $rgb; // returns an array with the rgb values
}

function ct_get_theme_background($key, $selector){
	 // $background is the saved custom image, or the default image.
	$background = get_theme_mod($key.'_image');
	$background = str_replace('#','',$background);
	// $color is the saved custom color.
	// A default has to be specified in style.css. It will not be printed here.
	$color = get_theme_mod( $key.'_color' );
	$color = str_replace('#','',$color);

	if ( ! $background && (! $color ||$color == '#'))
		return;

	$style = $color ? "background-color: #$color;" : '';
	if ( $background ) {
		$image = " background-image: url('$background');";

		$repeat = get_theme_mod( $key.'_background_repeat', 'repeat' );
		if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
			$repeat = 'repeat';
		$repeat = " background-repeat: $repeat;";

		$position = get_theme_mod($key.'_background_position_x', 'left' );
		if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
			$position = 'left';
		$position = " background-position: top $position;";

		$attachment = get_theme_mod( $key.'_background_attachment', 'scroll' );
		if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
			$attachment = 'scroll';
		$attachment = " background-attachment: $attachment;";

		$style .= $image . $repeat . $position . $attachment;
	}

	return $selector.'{'.$style.'}';
}
$motive = get_theme_mod('lead_color');
$second_motive = get_theme_mod('sub_color');

$backgroundColor = get_theme_mod('background_color');
$headerTextColor = get_theme_mod('header_textcolor');

?>

<?php _custom_background_cb()?>
<style type="text/css" media="all">
	<?php $font = ct_get_option('style_font_style'); $fontSize = ct_get_option_pattern('style_font_size', 'font-size: %dpx;',16); ?>
	<?php if($font||($fontSize && $fontSize!=16)):?>
    body {
	<?php if ($font): ?> <?php $normalized = explode(':', $font); ?>
		<?php if (isset($normalized[1])): ?>
            font-family: '<?php echo $normalized[0]?>', sans-serif;
	        <?php if(is_numeric($normalized[1])): ?>
            font-weight: <?php echo $normalized[1];?>;
	    <?php else:?>
	        font-style: <?php echo $normalized[1];?>;
	    <?php endif;?>
			<?php endif; ?> <?php endif;?>
	<?php echo $fontSize?>

	<?php //default styles ?> <?php echo ct_get_option_pattern('style_color_basic_background', 'background-color: %s;')?> <?php echo ct_get_option_pattern('style_color_basic_background_image', 'background: url(%s) repeat;')?> <?php echo ct_get_option_pattern('style_color_basic_text', 'color: %s;')?> <?php if (ct_get_option('style_color_basic_background') && !ct_get_option('style_color_basic_background_image')): ?> background-image: none;
		<?php endif;?>
    }
    <?php endif;?>

	<?php $sizes = array('1'=>50,'2'=>24,'3'=>17,'4'=>14,'5'=>14,'6'=>14)?>
	<?php foreach($sizes as $tag=>$size):?>
		<?php if(ct_get_option('style_font_size_h'.$tag)!=38.5):?>
			<?php echo ct_get_option_pattern('style_font_size_h'.$tag, 'h'.$tag.'{font-size: %dpx!important;}',$size)?>
		<?php endif;?>
	<?php endforeach;?>

	<?php if($headerTextColor):?>
		h1,h1 a,h2, h2 a, h3, h3 a,h4, h4 a, h5, h5 a,h6, h6 a {color: #<?php echo $headerTextColor?>!important}
	<?php endif;?>

	<?php if($backgroundColor):?>
		body {background-color: #<?php echo $backgroundColor?>}
	<?php endif;?>

	<?php echo ct_get_theme_background('header_background','#MainNav .navbar-inner')?>
	<?php echo ct_get_theme_background('footer_background','footer, footer .container h4')?>
	<?php echo ct_get_theme_background('subfooter_background','footer h4')?>
	<?php echo ct_get_theme_background('headers_background','div.titleBox')?>
	<?php if($c = get_theme_mod('icons_background_color')):?>
	i:before, li:before {color: <?php echo $c?>!important}
	<?php endif;?>
	<?php if($motive && $motive!='#'):?>
	<?php $motive = ct_hex_2_rgb($motive)?>

	.latest-posts a.title,
	a {
	    color: rgb(<?php echo $motive?>)
	}

	blockquote {
		border-left-color: rgb(<?php echo $motive?>)
	}
	.customMapMarker i:before {
		color: rgb(<?php echo $motive?>)
	}
	.faqMenu ul li > a:hover {
		color: rgb(<?php echo $motive?>)
	}
	.widget_calendar table #today {
		background: rgb(<?php echo $motive?>)
	}
	.jp-play-bar,
	.jp-volume-bar-value {
		background-color: rgb(<?php echo $motive?>)
	}

	.bx-wrapper .bx-pager.bx-default-pager a.active{
	  background: rgb(<?php echo $motive?>)
	}

	.tabs.type2 .nav li a{
	  background: rgb(<?php echo $motive?>)
	}

	.selectize-input.full {
	  background: rgb(<?php echo $motive?>)
	}
	.selectize-dropdown .selected {
	  background: rgb(<?php echo $motive?>)
	}
	.work-nav a {
		background-color: rgb(<?php echo $motive?>);
	}
	.btn {
		background-color: rgb(<?php echo $motive?>);
    color: #fff;
	}
	.btn-default,
	.btn-primary {
	    background-color: rgb(<?php echo $motive?>)
	}
	.btn-success {
	    background: #3bc53b;
	}
	.btn-inactive {
	    background: #999999;
	}
	.btn-warning {
	    background: #ff9419;
	}
	.btn-info {
	    background: #2db7ff;
	}
	.btn-danger {
	    background: #ff2d2d;
	}
	.btn-inverse {
	    background: #262626;
	}
	.btn-inverse:hover {
	    background-color: rgb(<?php echo $motive?>)
	}
	.btn-default:hover,
	.btn-primary:hover,
	.btn-success:hover,
	.btn-inactive:hover,
	.btn-warning:hover,
	.btn-info:hover,
	.btn-danger:hover {
	    background: #262626;
	}
	#MainNav .navbar-inner .container .btn-navbar {
	    background-color: rgb(<?php echo $motive?>)
	}
	#MainNav .arrow {
	    background: rgb(<?php echo $motive?>)
	}
	.work .flexslider.preview .slides li a:before,
	.isotope-item a:before {
	    background: rgb(<?php echo $motive?>);
	}
	.work .flexslider.preview .slides li a:hover:before {
		background: rgb(<?php echo $motive?>);
	}
	#BlogBody #Content nav.pager .prev,
	#BlogBody #Content nav.pager .next,
	.work .full-view nav a {
	    background-color: rgb(<?php echo $motive?>)
	}
	form input[type]:focus:invalid:focus,
	form textarea:focus:invalid:focus,
	form select:focus:invalid:focus,
	form input[type]:focus:valid:focus,
	form textarea:focus:valid:focus,
	form select:focus:valid:focus,
	form input[type]:focus:required:invalid:focus,
	form textarea:focus:required:invalid:focus,
	form select:focus:required:invalid:focus,
	form input[type]:focus:required:valid:focus,
	form textarea:focus:required:valid:focus,
	form select:focus:required:valid:focus {
	    border-color: rgb(<?php echo $motive?>)!important;
	}
	form input[type="text"]:focus,
	form textarea:focus {
	    border-color: rgb(<?php echo $motive?>)
	}
	form input[type="submit"],
	form input[type="button"] {
	    background: rgb(<?php echo $motive?>)
	}
	.flexslider .flex-control-paging li a.flex-active {
	    background: rgb(<?php echo $motive?>)
	}
	.flexslider .flex-direction-nav .flex-prev,
	.flexslider .flex-direction-nav .flex-next,
	.lb-data .lb-close {
	    background-color: rgb(<?php echo $motive?>);
	}

	.section-emphasis {
	    background: rgb(<?php echo $motive?>);
	    background: rgba(<?php echo $motive?>, .7);
	}

	.tweets a {
	    color: #dbdbdb;
	}
	.section-emphasis h3,
	.tweets span {
	    color: #dbdbdb;
	}
	#MainNav ul .dropdown .dropdown-menu a:hover {
	    background: rgb(<?php echo $motive?>);
	}
	em.stronger{
	    background: rgb(<?php echo $motive?>);
	}

	<?php endif;?>

	<?php /*custom style - code tab*/ ?>
	<?php echo ct_get_option('code_custom_styles_css')?>
</style>