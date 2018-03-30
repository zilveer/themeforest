<?php 

// wp 3.3 stuff
if (!function_exists('disableAdminBar')) {

	function disableAdminBar(){

        remove_action( 'wp_footer', 'wp_admin_bar_render', 1000 ); // for the front end
    }

    function remove_admin_bar_style_frontend() { // css override for the frontend
      echo '<style type="text/css" media="screen">
      html { margin-top: 0px !important; }
      * html body { margin-top: 0px !important; }
      </style>';
    }

    add_filter('wp_head','remove_admin_bar_style_frontend', 99);

  

}

// add_filter('admin_head','remove_admin_bar_style_backend'); // Original version
add_action('init','disableAdminBar'); // New version



?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!-- Consider adding an manifest.appcache: h5bp.com/d/Offline -->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <!-- Use the .htaccess and remove these lines to avoid edge case issues.
       More info: h5bp.com/b/378 -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?php BebelUtils::getPageTitle() ?></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->

  
  <link href="<?php bloginfo('stylesheet_url') ?>" media="screen" rel="stylesheet" type="text/css" />
  <?php wp_head() ?>

  <!-- jQuery functions we have to load in the header -->
  <script type="text/javascript">
			
	jQuery(function($){
		
		function bebelScrollbarFix($heightViewport, $heightContent) {
			$('#post_scrollbar').tinyscrollbar({
				sizethumb: 52,
				jquerySizeContent: $heightContent,
				jQuerySizeViewport: $heightViewport
			});
		}
        $('#supersized-loader').hide();
		
		$(document).ready(function(){
			var $heightContent1 = $(".frameForBugfix").actual( 'outerHeight', { includeMargin : true });
			var $heightContent = $heightContent1 + 200; // weird bugfix
			var $heightViewport = $(".viewport").height();
			bebelScrollbarFix($heightViewport, $heightContent);
		});
		
    });
		    
  </script>
  <?php include_once 'templates/load_custom_css.php'; ?>
</head>

<body style="background: transparent;">