<?php 
	//Extracting the values that user defined in OptionTree Plugin 
	$logoUrl = ot_get_option('logo_url');
	$effect = ot_get_option('effect');
	$pauseTime = ot_get_option('pause_time');
	$pauseHover = ot_get_option('pause_hover');
	$gmapsKey = ot_get_option('gmaps_key');
	$gaId = ot_get_option('ga_id');
	$headerTelephone = ot_get_option('telephone');
	$headerEmail = ot_get_option('email');
	$mapCenter = ot_get_option('map_center');
	$homeMapZoom = ot_get_option('home_map_zoom');
	$homeMapType = ot_get_option('home_map_type');
	$contactMapZoom = ot_get_option('contact_map_zoom');
	$contactMapType = ot_get_option('contact_map_type');
	$sloganText = ot_get_option('slogan_text');
	$clinicName = ot_get_option('clinic_name');
	$clinicAddress = ot_get_option('clinic_address');
	$mapMarker = ot_get_option('map_marker');
	$clinicName = explode(";", $clinicName);
	$clinicAddress = explode(";", $clinicAddress);
	$mapMarker = explode(";", $mapMarker);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="utf-8" />
		<title><?php bloginfo('name'); ?></title>
		<meta name="description" content="<?php bloginfo('description') ?>" />
		<link type="image/x-icon" rel="icon" href="<?php echo get_template_directory_uri() ?>/favicon.ico"  /> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<?php if ( $gmapsKey != ' ' && $gmapsKey != '' ) { ?>
		<!-- Loading Google Maps API -->
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=<?php echo $gmapsKey; ?>&sensor=false"></script>
		<?php } ?>
		<!-- Google web font include -->
		<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700|Source+Sans+Pro:400,700' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css" />
		<!-- Google Analytics intialize -->
		<?php if (isset($gaId) && $gaId != "XXXXX-X" ) { ?>
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-<?php echo $gaId; ?>']);
			_gaq.push(['_trackPageview']);

			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		
		</script>
		<?php } ?>
		<!--[if IE 9]>
		<style type="text/css">
			.main-header .fourteen {
				height: 87px;
				background-image:none;
				background-color: rgba(0, 0, 0, 0.15);
			}
			#menu-header-menu {
				margin-top:15px;
				margin-right:40px;
			}
		</style>
		<![endif]-->
	
		<!--[if IE 8]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<style type="text/css">
			.main-header .fourteen {
				height: 86px;
			}
			.sub-menu {
				background-color:#fff;
			}
			#footer {
				background-image:none;
				background-color:#265e91;
			}
			#menu-header-menu {
				margin-top:15px;
				margin-right:40px;
			}
		</style>
		<![endif]-->
	<?php wp_head(); ?> 
	</head>	
<body id="to-top">
	<script type="text/javascript">
	(function($) {
	$(document).ready(function() {
		
		<?php if (is_home()) { ?>
		
		// Initialize main slider
		$('#slider').nivoSlider({
			effect: <?php echo "'".$effect."'"; ?>,
			animSpeed: 500,
			pauseTime: <?php echo $pauseTime; ?>,
			<?php if ( $pauseHover == "off" ) { ?>pauseOnHover: false,<?php } ?>
			directionNav: true,
			beforeChange:function(){ 
				$(".header").css('opacity','0');
				$(".text").css('opacity','0');
			}, // Triggers before a slide transition
			afterChange:function(){
				$(".header").animate({opacity:1},1000);
				$(".text").animate({opacity:1},1000);
			}
		});
	
		// Initialize blog post slider (display on homepage)
		if ( $("#header-mobile-menu").css('display') == "none" ) {
			var slider = $('#blog-slider').bxSlider({
				displaySlideQty: 4,
				moveSlideQty:4,
				controls:false
			});
		} 
	
		if ( ( $("#header-mobile-menu").css('display') != "none" ) && ( $("#header-mobile-menu").css('position') == "absolute" ) ) {
			var slider = $('#blog-slider').bxSlider({
				displaySlideQty:2,
				moveSlideQty:2,
				controls:false
			});
		}
	
		if ( ( $("#header-mobile-menu").css('display') != "none" ) && ( $("#header-mobile-menu").css('position') == "static" ) ) {
			var slider = $('#blog-slider').bxSlider({
				displaySlideQty:1,
				moveSlideQty:1,
				controls:false
			});
		}
	
		$('#go-prev').click(function(){
			slider.goToPreviousSlide();
			return false;
		});

		$('#go-next').click(function(){
			slider.goToNextSlide();
			return false;
		});
		
		<?php } ?>
		
		//Delete last delimeter
		$('.twitterBody li:last, #contact-address span:last, #contact-method li:last, #blog-post-sidebar li:last, .testimonials-wrap:last, .news-text-wrap:last').css('borderBottom','none');
		
		<?php if ( is_page_template('gallery.php') || is_page_template('gallery-sidebar.php') || is_page_template('gallery-without-text.php') ) { ?>
		
		//Lightbox plugin for Galleries
		$(".gallery-image a").lightBox({
			imageLoading: '<?php echo get_template_directory_uri(); ?>/images/loading.gif',
			imageBtnClose: '<?php echo get_template_directory_uri(); ?>/images/close.gif',
			imageBtnPrev: '<?php echo get_template_directory_uri(); ?>/images/prev.gif',
			imageBtnNext: '<?php echo get_template_directory_uri(); ?>/images/next.gif'
		});
		
		<?php } ?>
	
		$("#tweet-feed").bind('DOMNodeInserted', function(event){
			$(this).find(".twitterRow:last").css('borderBottom','none');
		});
	
		//Drop down menu creation 
		$('#menu-header-menu li').each(function(){
			if ( $(this).children('.sub-menu') != false){
				$(this).mouseenter(function() { 
					$(this).children('.sub-menu').fadeIn(200);
				}).mouseleave(function(){
					$(this).children('.sub-menu').fadeOut(100);
				});
			}
		});
	
		//Footer subscribtion button animation
		$("#mce-EMAIL").click(function(){
			$(this).attr('value',' ');
		}).blur(function(){
			if ($(this).attr('value') == '') {
				$(this).attr('value','email address');
			}
		});
	
		//Form animation 
		$("#leave-reply-wrap form input, #leave-reply-wrap form textarea").focus(function(){
			$(this).css({boxShadow:"none",opacity:1,outline:"4px solid #f6f6f6"});
		}).blur(function(){
			$(this).css({boxShadow:"none",opacity:1,outline:"4px solid #f6f6f6"});
		});
	
		//Gallery animation
		$(".gallery-image").hover(function(){
			$(this).children().children("img").css({opacity:0.2});
			if ( !(parseInt($.browser.version, 10) < 9) ) {
				$(this).children().children(".magnifier-icon, .magnifier-icon-sidebar").css({opacity:0.7});
			}
			$(this).children().children(".magnifier-icon, .magnifier-icon-sidebar").css({display:"block"});
		},function(){
			$(this).children().children("img").css({opacity:0.8});
			if ( !(parseInt($.browser.version, 10) < 9) ) {
				$(this).children().children(".magnifier-icon, .magnifier-icon-sidebar").css({opacity:0});
			}
			$(this).children().children(".magnifier-icon, .magnifier-icon-sidebar").css({display:"none"});
		});
	
		//Main Blog animation
		$("#blog-slider li").hover(function(){
			$(this).find("img").css({opacity:0.2});
			if ( !(parseInt($.browser.version, 10) < 9) ) {
				$(this).find(".main-blog-magnifier").css({opacity:0.7});
			}
			$(this).find(".main-blog-magnifier").css({display:"block"});
		},function(){
			$(this).find("img").css({opacity:0.8});
			if ( !(parseInt($.browser.version, 10) < 9) ) {
				$(this).find(".main-blog-magnifier").css({opacity:0});
			}
			$(this).find(".main-blog-magnifier").css({display:"none"});
		});
	
		//Contact form animation 
		$("#contact-form form").hover(function(){
			$(this).children("#contact-form-title").css({opacity:0.5});
		},function(){
			$(this).children("#contact-form-title").css({opacity:0.3});
		});
	
		//Accordion widget initializing
		$(".accordion").accordion({
			icons: {
				'header':'accordionplus', 
				'headerSelected':'accordionminus'
			}
		});
	
		//Tabs widget initializing
		$(".tabs").tabs();
	
		//Back to top button initialize
		$(window).scroll(function () { 
			if ($(this).scrollTop() > 400) {
				$("#back-to-top").show(500); 
			} 
			if ($(this).scrollTop() < 400) {
				$("#back-to-top").hide(500); 
			}
		});
	
		//Smooth scrolling
		$("#back-to-top").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top}, 500);
		});
		
		//Online Appointment form
		$("#prefered_method input").click(function(){	
			if (this.value == "Email") {
				$("#form-email-wrap").show(300);
				$("#form-telephone-wrap").hide();				
			}
			if (this.value == "Telephone") {
				$("#form-telephone-wrap").show(300);
				$("#form-email-wrap").hide();
			}
		});
	
		//Mobile menu
		$('#header-mobile-menu').change(function() {
			// set the window's location property to the value of the option the user has selected
			window.location = $(this).val();
		});	
	
		//Make current option in mobile menu selected
		$("#header-mobile-menu option").each(function() {
			var path = window.location.pathname;
			var pageName = path.substring(path.lastIndexOf('/') + 1);
			if ($(this).attr('value') == pageName) {
				$(this).attr('selected','selected');
			}
		});
	
		//Delete margin bottom in footer if IE8
		if ($.browser.msie  && parseInt($.browser.version, 10) === 8) {
			$("#copyright-info").css("margin-bottom","20px");
		}
		
		//Add arrow to submenu 
		$(".sub-menu").prepend("<li class='triangle'><img src='<?php echo get_template_directory_uri() ?>/images/triangle.png' /></li>")

		//Making tables responsive
		var switched = false;
		var updateTables = function() {
			if (($(window).width() < 480) && !switched ) {
				switched = true;
				$(".table").each(function(i, element) {
					splitTable($(element));
				});
				return true;
			}
			else if (switched && ($(window).width() > 480)) {
				switched = false;
				$(".table").each(function(i, element) {
					unsplitTable($(element));
				});
			}
		};
   
		$(window).load(updateTables);
		$(window).bind("resize", updateTables);
   
		function splitTable(original) {
			original.wrap("<div class='table-wrapper' />");
			var copy = original.clone();
			copy.find("td:not(:first-child), th:not(:first-child)").css("display", "none");
			copy.removeClass("responsive");
			original.closest(".table-wrapper").append(copy);
			copy.wrap("<div class='pinned' />");
			original.wrap("<div class='scrollable' />");
		}
	
		function unsplitTable(original) {
			original.closest(".table-wrapper").find(".pinned").remove();
			original.unwrap();
			original.unwrap();
		}
		
		<?php if ( $gmapsKey != ' ' && $gmapsKey != '' ) { ?>
		// Google Maps Initializing
		if (document.getElementById("gmaps")) {
			//---- Code for a maps on main page ----
			var myOptions = { 
				//Coordinates of the map's center
				center: new google.maps.LatLng(<?php echo $mapCenter; ?>), 
				//Zoom level
				zoom: <?php echo $homeMapZoom; ?>,
				//Type of the map (posible values .HYBRID, .SATELLITE, .ROADMAP, .TERRAIN)
				mapTypeId: google.maps.MapTypeId.<?php echo $homeMapType; ?>
			};
			//Define the map and select the element in which it will be displayed
			var map = new google.maps.Map(document.getElementById("gmaps"),myOptions);
			
			<?php for ($i=0;$i<count($clinicName);$i++) { ?>
			var marker<?php echo $i+1; ?> = new google.maps.Marker({
				//Coordinate of the map marker's location
				position: new google.maps.LatLng(<?php echo $mapMarker[$i]; ?>),
				map: map,
				//Text that will be displayed when the mouse hover on the marker
				title:"<?php echo $clinicName[$i]; ?>"
			});
			<?php } ?>
		}
	
		//---- Code for a big maps located in contact section ----
		if (document.getElementById("contact-gmaps")) {
			var myOptions1 = { 
				//Coordinates of the map's center
				center: new google.maps.LatLng(<?php echo $mapCenter; ?>), 
				//Zoom level
				zoom: <?php echo $contactMapZoom; ?>,
				//Type of map (possible values .ROADMAP, .HYBRID, .SATELLITE, .TERRAIN)
				mapTypeId: google.maps.MapTypeId.<?php echo $contactMapType; ?>
			};
			//Define the map and select the element in which it will be displayed
			var map1 = new google.maps.Map(document.getElementById("contact-gmaps"),myOptions1);
			<?php for ($i=0;$i<count($clinicName);$i++) { ?>
			var marker<?php echo $i+1; ?> = new google.maps.Marker({
				//Coordinate of the map marker's location
				position: new google.maps.LatLng(<?php echo $mapMarker[$i]; ?>),
				map: map1,
				//Text that will be displayed when the mouse hover on the marker
				title:"<?php echo $clinicName[$i]; ?>"
			});
			<?php } ?>
		}
		
		<?php } ?>
		
	});
	})( jQuery );
	</script>
	<style type="text/css">
	#logo {
		background:url(<?php echo get_template_directory_uri().'/'.$logoUrl; ?>) no-repeat;	
	}
	</style>
	<!-- BEGIN HEADER -->
	<header>
		<div id="header" <?php if (is_home()) { echo "class='main-header'"; } ?>>
			<div class="container">
				<div class="two columns" id="logo-wrap">
					<a href="<?php echo "http://".$_SERVER['HTTP_HOST']; ?>"><div id="logo"></div></a>
					<select id="header-mobile-menu">
						<?php wp_nav_menu(array(
							'menu' => 'Main menu',
							'container' => false,
							'echo' => true,
							'before' => '',
							'after' => '',
							'link_before' => '',
							'link_after' => '',
							'depth' => 2,
							'walker' => new mobile_walker()
						)) 
						?>
					</select>
				</div>
				<div class="fourteen columns">
					<nav>
						<?php wp_nav_menu(array(
							'items_wrap' => '<ul id="menu-header-menu" class="menu">%3$s</ul>',
							'menu' => 'Main menu',
							'container' => false,
							'echo' => true,
							'before' => '',
							'after' => '',
							'link_before' => '',
							'link_after' => '',
							'depth' => 2,
						)) 
						?>			
					</nav>
				</div>
				<br class="clear" />
				<div class="four columns">
					<div id="telephone-wrap">
						<?php if ($headerTelephone != '') { ?><span id="header-telephone"><?php echo $headerTelephone; ?></span><?php } ?>
						<?php if ($headerEmail != '') { ?><span id="header-email"><?php echo $headerEmail; ?></span><?php } ?>
					</div>
				</div>
				<?php if ($sloganText != '') { ?>
				<div class="ten columns" id="intro-text">
					<div><?php echo $sloganText; ?></div>
				</div>
				<?php } else { ?>
				<style type="text/css">
					#page-title-wrap {
						margin-top:30px;
					}
				</style>
				<?php } ?>
			</div>
		</div>
	</header>
	<!-- END HEADER -->