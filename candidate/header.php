<!DOCTYPE html>





<!--[if lte IE 8]>              <html class="ie8 no-js" <?php language_attributes(); ?>>     <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="not-ie no-js no-fouc" <?php language_attributes(); ?>>  <!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' );?>" />
<meta name="description" content="<?php bloginfo( 'description' );?>"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta property="og:title" content="<?php wp_title( '|', true, 'right' ); ?>" />
<meta property="og:description" content="<?php bloginfo( 'description' );?>" />
<meta property="og:type" content="cause" />

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php wp_title( '|', true, 'right' ); ?>">
<meta name="twitter:description" content="<?php bloginfo( 'description' );?>">


	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	
	<!--[if IE 9]>
		<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/ie9.css">
	<![endif]-->
	
	<!--[if lt IE 9]>
		<link href="<?php echo esc_url(get_template_directory_uri()); ?>/css/jackbox-ie8.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/ie.css">
	<![endif]-->
	
	<!--[if gt IE 8]>
		<link href="<?php echo esc_url(get_template_directory_uri()); ?>/css/jackbox-ie9.css" rel="stylesheet" type="text/css" />
	<![endif]-->
	
	<!--[if IE 7]>
		<link rel="stylesheet" href="<?php echo esc_url(get_template_directory_uri()); ?>/css/fontello-ie7.css">
	<![endif]-->
	
	
<!--[if lt IE 9]>
	<script src="js/selectivizr-and-extra-selectors.min.js"></script>
	<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script>
	<![endif]-->
	
	<style type="text/css">
		.no-fouc {display:none;}
	</style>
	

	

	<?php
		wp_head();
	?>	
	

	
	<?php
	if(get_option('sense_settings_loading') != 'hide') {
	?>		
		
	<script type="text/javascript">
		(function($) {

		
		
		$(document).ready(function(){
		
			$('html').show();
			
			var window_w = $(window).width();
			var window_h = $(window).height();
			var window_s = $(window).scrollTop();
			
			$("body").queryLoader2({
				backgroundColor: '#f2f4f9',
				barColor: color_loader,
				barHeight: 4,
				percentage:false,
				deepSearch:true,
				minimumTime:1000,
				onComplete: function(){
					
					$('.animate-onscroll').filter(function(index){
					
						return this.offsetTop < (window_s + window_h);
						
					}).each(function(index, value){
						
						var el = $(this);
						var el_y = $(this).offset().top;
						
						if((window_s) > el_y){
							$(el).addClass('animated fadeInDown').removeClass('animate-onscroll');
							setTimeout(function(){
								$(el).css('opacity','1').removeClass('animated fadeInDown');
							},2000);
						}
						
					});
					
				}
			});
			
		});
		
		})(jQuery);	
	</script>
	
	
	<?php
	}
	?>	
	


	<?php
	if(get_option('sense_settings_loading') == 'hide') {
	?>
	
	
	
	<script type="text/javascript">
		(function($) {
			
			

		$(document).ready(function(){
		
			$('html').show();
			
			var window_w = $(window).width();
			var window_h = $(window).height();
			var window_s = $(window).scrollTop();
			

					
					$('.animate-onscroll').filter(function(index){
					
						return this.offsetTop < (window_s + window_h);
						
					}).each(function(index, value){
						
						var el = $(this);
						var el_y = $(this).offset().top;
						
						if((window_s) > el_y){
							$(el).addClass('animated fadeInDown').removeClass('animate-onscroll');
							setTimeout(function(){
								$(el).css('opacity','1').removeClass('animated fadeInDown');
							},2000);
						}
						
					});
					
		
			
		});
		
		})(jQuery);	
	</script>
	
	
	
	
	
	
	<?php
	}
	?>


</head>




<body <?php body_class(); ?> >

 <div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
 
	
	
	
	
	<!-- Container -->
	<div class="container">

	<!-- Header -->
	<header id="header" class="animate-onscroll">
		
		<!-- Main Header -->
		<div id="main-header">
			
			<div class="container">
			
			<div class="row">

				<!-- Logo -->
				<div id="logo" class="">
					<?php if(get_option('sense_settings_logo') == 'show_image')
						{
						?>
						<a href="<?php echo esc_url(home_url('/')); ?>" class="logo " style="" >
						   <img class="logo_img" alt="Logo" src="<?php echo esc_url(get_option('sense_logo_image_loft')); ?>"/>
						</a>
					<?php } else { ?>
						<h1>
							<a href="<?php echo esc_url(home_url('/')); ?>" class="logo">
							<?php echo esc_html(get_option('sense_logo_text_loft'));  ?>
							</a>
						</h1>
					<?php } ?>
				</div>
				<!-- /Logo -->
		
				<!-- Main Quote -->
				<div class="main_quote ">
					<?php if(get_option('sense_show_slogan_top') == 'show')
						{
						?>
					<?php echo __(get_option('sense_header_text'), 'candidate');  ?>
					<?php } ?>
				</div>
				<!-- /Main Quote -->
				

				<?php if( get_option('sense_show_topform') == 'show' ) {	?>	
				<!-- Newsletter -->
				<div class="top_newsletter type_<?php echo get_option('sense_type_form_header');  ?>">
					<?php
					if(get_option('sense_type_form_header') == 'mailchimp')
						{
							
						$top1 = get_option('sense_top_text1');	
						$top2 = get_option('sense_top_text2');	
							
						?>
					<form id="newsletter" action="#" method="POST" style="display:block!important;" >
						<span class="ajax-loader"></span>
						
						<?php echo get_option('sense_top_title1'); ?>
						
						
						<div class="newsletter-form">
						
							<div class="newsletter-email">
								<input id="s-email" type="text" name="email" placeholder="<?php echo $top1; ?>">
							</div>
							
							<div class="newsletter-zip">
								<input type="text" name="newsletter-zip" placeholder="<?php echo $top2; ?>">
							</div>
							
							<div class="newsletter-submit">
								<input type="submit" id="signup_submit" name="newsletter-submit" value="">
								<i class="icons icon-right-thin"></i>
							</div>
							
						</div>
						<div id="mailchimp-sign-up1" ><p>.</p></div>
					</form>
					<?php } 
					if(get_option('sense_type_form_header') == 'search') {
						
						$top1 = get_option('sense_top_text1');	
					?>
					
					
					
					
					<form id="search" action="<?php echo esc_url(home_url( '/' )); ?>">
					
						<?php echo get_option('sense_top_title1'); ?>
					
						<div class="newsletter-form">
						
							<div class="newsletter-search">
							<input placeholder="<?php echo $top1; ?>" type="text" name="s" class="search-query" />
							</div>
							
							
							<div class="newsletter-submit">
							
							<input type="submit" id="signup_submit"  value="">
								<i class="icons icon-right-thin"></i>

							</div>
							
						</div>
						
					</form>
					 
					<?php } 
					if(get_option('sense_type_form_header') == 'events') {	
					
					
						if(get_option('sense_header_event_id') && get_option('sense_header_event_id') != '') {	
							$event_id = get_option('sense_header_event_id');
						} else {
							$event_posts = tribe_get_events(
								apply_filters(
									'tribe_events_list_widget_query_args', array(
										'eventDisplay'   => 'list',
										'posts_per_page' => '1'
									)
								)
							);
							foreach( $event_posts as $post ) :  setup_postdata($post);
								setup_postdata( $post );
								$event_id = $post->ID;
							endforeach; 	
							wp_reset_query();
						}
							
							$start_day = tribe_get_start_date( $event_id, false, 'd' );
							$start_month = tribe_get_start_date( $event_id, false, 'm' );
							$start_year = tribe_get_start_date( $event_id, false, 'Y' );
							$link_event = get_permalink($event_id);
					?>
					
					<form id="event" action="<?php echo esc_url(home_url( '/' )); ?>">
					
						<?php echo get_option('sense_top_title1'); ?>
					
						<div class="newsletter-form">
						
							<div id="countdown_header" class="hasCountdown"></div>
							
							<a href="<?php echo $link_event; ?>" class="header_event" target="_blank" >
							
								<i class="icons icon-right-thin"></i>
							
							
							</a>
							
						</div>
						
					</form>
					
							<script type="text/javascript">
								(function($) {

								$(document).ready(function(){
			
									// countdown

									//if($('#countdown_header').length){
										
										var newYear = new Date(); 
										//newYear = new Date(newYear.getFullYear() + 1, -1, 1); 
										newYear = new Date(<?php echo $start_year; ?>, <?php echo $start_month; ?>-1, <?php echo $start_day; ?>);  
										//alert(newYear);
										$('#countdown_header').countdown({
											until: newYear,
											layout:'<dl class="count_item"><dt class="main_title">{d<}{dnn}</dt><dd><span>{dl}</span></dd></dl></div> {d>}'+
											'<dl class="count_item"><dt class="main_title">{hnn}</dt><dd><span>{hl}</span></dd></dl></div>'+
											' <dl class="count_item"><dt class="main_title">{mnn}</dt><dd><span>{ml}</span></dd></dl>'+
											' <dl class="count_item"><dt class="main_title">{snn}</dt><dd><span>{sl}</span></dd></dl>'
										}); 
										 //$('#countdown_header').countdown('toggle'); 
									//}

								});
					
								})(jQuery);
								
							</script>
							
							
							
						
					<?php }  ?>
					
				</div>
				<!-- /Newsletter -->
				<?php } ?>	
	
			</div>
			
			</div>
			
		</div>
		<!-- /Main Header -->
	
	
	<!-- Lower Header -->
	<div id="lower-header">
		
		<div class="container">
		
		<div id="menu-button">
			<div>
			<span></span>
			<span></span>
			<span></span>
			</div>
			<span><?php _e( 'Menu', 'candidate' ); ?></span>
		</div>
	

		<?php  if (has_nav_menu('main_navigation')) :
				wp_nav_menu( array(
				'theme_location' => 'main_navigation',
				'container' => false,
				 'menu_class' => '',
				 'menu_id' => 'navigation',
				 'echo' => true,
				 'depth' => 4,
				 'fallback_cb'=> '',
				 'walker' => new candidate_Nav_Walker()
				));
				endif; 		
		?>
	
		</div>
					
	</div>
	<!-- /Lower Header -->
	</header>
	<!-- /Header -->