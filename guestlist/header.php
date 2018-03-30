<?php

if((is_home() || is_front_page())) 
{

    // if static homepage is off:
    
    if($bSettings->get('static_mainpage_enable') == 'off')
    {
     
    
        // get the last event
        $querystr = "
            SELECT * FROM $wpdb->posts
            LEFT JOIN $wpdb->postmeta ON($wpdb->posts.ID = $wpdb->postmeta.post_id)
            WHERE $wpdb->posts.post_status = 'publish'
            AND $wpdb->posts.post_type = '".$bSettings->getPrefix()."_event'
            AND $wpdb->postmeta.meta_key = '".$bSettings->getPrefix()."_event_date'
            ORDER BY $wpdb->postmeta.meta_value ASC

        ";



        $events_loop = $wpdb->get_results($querystr, OBJECT);


        $i = 0;
        $images = '';
        global $post;
        foreach($events_loop as $post):
            setup_postdata($post);

            include 'templates/event_vars.php';

            if($startdate <= time() && $enddate >= time()):
                // ok, we can use this one


                if($i > 0) break;
                $i++;

                // getting the slider images
                $images = simpleUtils::getAllSliderImages(get_the_ID());

            endif;
        endforeach;
    }else {
        // static page is on.
        switch($bSettings->get('static_mainpage_type'))
        {
            case 'page':
                // get image
                global $post;
                $args = array( 'page_id' => $bSettings->get('static_mainpage_page_id'));
                $loop = new WP_Query( $args );
                if($loop->have_posts())
                {
                    while($loop->have_posts())
                    {
                        $loop->the_post();
                        $images = simpleUtils::getAllSliderImages(get_the_ID());
                    }
                    
                }
                break;
            default:
                $images = " { image : '".$bSettings->get('static_mainpage_background')."' } \n";
                break;
                
        }
        
        
    }

        if($images == '') 
        {
            // get default header
            $images = " { image : '".$bSettings->get('default_background')."' } \n";
        }
        
}
if(is_single())
{
    the_post();
    
    include 'templates/event_vars.php';

    
        // getting the slider images
        $images = simpleUtils::getAllSliderImages(get_the_ID());

    
    
    if($images == '') 
    {
        // get default header
        $images = " { image : '".$bSettings->get('default_background')."' } \n";
    }
    
    
}
// slider settings
$slider_protect_images = $bSettings->get('slider_image_protect') == 'on' ? '1' : '0';    
$slider_interval = $bSettings->get('slider_interval');
$slider_transition_effect = $bSettings->get('slider_transition_effect');
$slider_transition_speed = $bSettings->get('slider_transition_speed');
    

?>

<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">

  <!--[if ie]>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <![endif]-->
  
  <title><?php BebelUtils::getPageTitle() ?></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width,initial-scale=1">

  
  <link href="<?php bloginfo('stylesheet_url') ?>" media="screen" rel="stylesheet" type="text/css" />
  <?php wp_head() ?>

  <!-- jQuery functions we have to load in the header -->
  <script type="text/javascript">
			
	jQuery(function($){
				
		$.supersized({
			image_protect: <?php echo $slider_protect_images ?>,
			autoplay: 1,
            slide_interval: <?php echo $slider_interval ?>,
            
            transition:   '<?php echo $slider_transition_effect ?>',
            transition_speed: <?php echo $slider_transition_speed ?>,
            
			vertical_center: 1,
			hoizontal_center: 1,
			fit_always: 0,
			fit_portrait: 1,
			fit_landscape: 0,
			
            
			slides  :  	[ <?php echo $images; ?> ]
		});
		
		
		$(document).ready(function(){
            
            
			$('#event_scrollbar').tinyscrollbar({
				sizethumb: 52
			});
            
            
            <?php if($bSettings->get('static_mainpage_enable') == 'on'): ?>
            $('#static_main_scrollbar').tinyscrollbar({
				sizethumb: 52
			});
			<?php endif; ?>
			
			$('.menu').bnav();
			
			$(".ajax").colorbox({
                iframe: 'true',
                width: '650px',
                height: '700px'
                
            });
            
            $(".page_item a, .menu-item-object-page a").colorbox({
				iframe: 'true',
				width: '650px',
				height: '700px'
				
			});
            
            $(".maps").colorbox({
				iframe: 'true'
				
			});
            
            $(document).bind('cbox_complete', function(){
                $('#supersized-loader').hide();
            });
			
            
            // add icons to menu
            $('.menu').find('a').each(function() {
                $html_title = $(this).attr("title")
                
                if($(this).attr("title")) {
                    $(this).addClass("hasIcon");
                    $(this).css('backgroundImage', ' url(<?php bloginfo('stylesheet_directory') ?>/images/menu/icons/'+$html_title+'.png)');
                }
                // if contact page, load smaller iframe
                if($(this).attr("title") == "contact") {
                    $(this).click(function() {
                       $(this).colorbox({
                            iframe: 'true',
                            width: '650px',
                            height: '430px'
                       });
                       
                    });
                }
            });
            
            
            
			
		});
		
    });
		    
  </script>
  <?php include_once 'templates/load_custom_css.php'; ?>

  <?php 
  // fix for iphone
  if($browser == 'iphone'){ ?>
  <style>
    html {
        overflow: auto !important;
    }
    
    #logo {
        position: absolute !important;
        top: -120px !important;
        left: 30px !important;
    }
    #main {
        float: none !important;
        margin-top: 430px !important;
        padding-top: 60px !important;
        margin-bottom: 120px !important;
        clear: both !important;
        height: 500px !important;
    }
    #container {
        position: absolute !important;
        width: 584px !important;
        
        left: 490px !important;
        top: 400px !important;
        display: block !important;
        padding-bottom: 100px !important;
    }
    #subscribe {
        margin-left: 110px !important;
    }


  </style>    
  <?php } ?>
</head>

<body>