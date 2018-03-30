<?php
/*
Template Name: Contact Page
*/
?>

<?php get_header(); ?>

    <?php
        global $mr_tailor_theme_options;
        global $map_metabox;
        $map_metabox->the_meta();
    ?>

    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	<script type="text/javascript">

    var marker;
    var map;
    var myLatlng;
    var myOptions;
    
    function initialize() {
        
		<?php
		
		$map_style_id = "default";
		
		if ($map_metabox->get_the_value('style') != "") {
			$map_style_id = $map_metabox->get_the_value('style');
		}
		
		//$map_style_id = "default";
		//$map_style_id = "pale_dawn";
		//$map_style_id = "subtle_grayscale";
		//$map_style_id = "midnight_commander";
		//$map_style_id = "shades_of_grey";
		//$map_style_id = "light_monochrome";
		//$map_style_id = "greyscale";
		//$map_style_id = "paper";
		//$map_style_id = "neutral_blue";
		//$map_style_id = "shift_worker";
		//$map_style_id = "avocado_world";
		//$map_style_id = "lunar_landscape";
		//$map_style_id = "old_timey";
		//$map_style_id = "routexl";
		//$map_style_id = "cobalt";
		//$map_style_id = "flat_map";
		//$map_style_id = "blue_gray";
		//$map_style_id = "souldisco";
		//$map_style_id = "clean_cut";

		include_once get_template_directory() . '/templates/map/' . $map_style_id . '.php';
		
		?>
        
		myLatlng = new google.maps.LatLng(<?php echo $map_metabox->the_value('lat') ?>, <?php echo $map_metabox->the_value('long') ?>);
        myOptions = {
            zoom: <?php echo $map_metabox->the_value('zoom') ?>,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
			//scroll:{x:jQuery(window).scrollLeft(),y:jQuery(window).scrollTop()},
            //disableDefaultUI: true,
            mapTypeId: '<?php echo $map_style_id; ?>',
            draggable: true,
			panControl: false,
			mapTypeControl: false,
            disableDoubleClickZoom: false,      
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.LARGE,
            },
            mapTypeControl: false,
            scaleControl: true,
            scrollwheel: false,
            streetViewControl: true,
            overviewMapControl: true,
            overviewMapControlOptions: {
                opened: false,
            }
        }
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        var styledMapType = new google.maps.StyledMapType(styles['<?php echo $map_style_id; ?>'], {name: '<?php echo $map_style_id; ?>'});
        map.mapTypes.set('<?php echo $map_style_id; ?>', styledMapType);
        map.setMapTypeId('<?php echo $map_style_id; ?>');
        
		var markerImage = {
			url: '<?php echo get_template_directory_uri(); ?>/images/pinpoint.png',
			scaledSize: new google.maps.Size(50, 60)
		},
		
		markerOptions = {
			map: map,
			position: myLatlng,
			animation: google.maps.Animation.DROP,
			icon: markerImage,
			draggable: false,
			optimized: false
		},
		
		marker = new google.maps.Marker(markerOptions);
		
		/*marker = new google.maps.Marker({
            //icon: '<?php echo get_template_directory_uri(); ?>/images/pin.png',
            position: myLatlng, 
            map: map,
            draggable: false,
            animation: google.maps.Animation.DROP,
        });*/
    }
        
    google.maps.event.addDomListener(window, 'load', initialize);
    if (jQuery(window).innerWidth() > 1024) {
		google.maps.event.addDomListener(window, 'resize', initialize);
	}
	
	google.maps.event.addDomListener(window, 'scroll', function(){
		var scrollY=jQuery(window).scrollTop(),
		scrollX=jQuery(window).scrollLeft(),
		scroll=map.get('scroll');
		if(scroll){
        	map.panBy(-((scroll.x-scrollX)/4),-((scroll.y-scrollY)/4));
      	}
      	map.set('scroll',{x:scrollX,y:scrollY})
	});
	
	jQuery(document).ready(function($) {
	"use strict";
	
		if ($(window).innerWidth() < 640) {
			$('#map_canvas').css('height','180px');
		} else {
			$('#map_canvas').css('height','<?php echo $map_metabox->the_value('height') ?>px');
		}
		
		$(window).resize(function(){
	
			if ($(window).innerWidth() < 640) {
				$('#map_canvas').css('height','180px');
			} else {
				$('#map_canvas').css('height','<?php echo $map_metabox->the_value('height') ?>px');
			}
			
		});
		
	});
    
    </script>
    
    <div id="map_container">
        <div id="map_canvas" style="height:<?php echo $map_metabox->the_value('height') ?>px;"></div>
    </div>


	<div id="primary" class="content-area page-contact">
       
        <div id="content" class="site-content" role="main">

            <?php while ( have_posts() ) : the_post(); ?>

                <div class="row">
                    <div class="large-12 large-centered columns">
                        <?php get_template_part( 'content', 'page' ); ?>
   
                        <div class="clearfix"></div>
                        <footer class="entry-meta">    
                            <?php //edit_post_link( __( 'Edit', 'mr_tailor' ), '<div class="edit-link"><i class="fa fa-pencil-square-o"></i> ', '</div>' ); ?>
                        </footer><!-- .entry-meta -->
                        
                    </div>
                </div>

            <?php endwhile; // end of the loop. ?>

        </div><!-- #content -->           
        
    </div><!-- #primary -->
    
<?php get_footer(); ?>
