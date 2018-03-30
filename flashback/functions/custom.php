<?php


	
/*------------------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ SHORTI BLOG SCRIPT _-_-_-_-_-_-_-_-_-_-*/
/*------------------------------------------------------------*/

	function shorti_blog_script() { ?>
	
		<script>
			            
		var $posts = jQuery('#posts');
		
		jQuery(window).load(function(){
		
			$posts.isotope({
				itemSelector: '.post'
			});
			
			$posts.infinitescroll({
				
					navSelector  : '#post_nav',
					nextSelector : '#post_nav a',
					itemSelector : '.post',
					loading: {
						finishedMsg: 'No more posts.',
						msgText: "Loading more posts ...",
						img: '<?php echo get_stylesheet_directory_uri(); ?>/images/loader.gif'
					}
					
				},
	
				function( newElements ) {
				
					var $newElems = jQuery( newElements ).css({ opacity: 0 });
					
					$newElems.imagesLoaded(function(){
					
						$newElems.animate({ opacity: 1 });
						$posts.isotope( 'appended', $newElems, true ); 
						
					});
				
				}
		      
		    );
			
			jQuery(window).smartresize(function(){
			   $posts.isotope({
			     resizable: false, // disable normal resizing
			     masonry: { columnWidth: $posts.width() / 2 }
			   });
			   // trigger resize to trigger isotope
			}).smartresize();
			
			// trigger isotope again after images have loaded
			$posts.imagesLoaded( function(){
			  jQuery(window).smartresize();
			});
		
		});
		
		</script>
		
	<?php }



/*-----------------------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ SHORTI SIMILAR PROJECTS _-_-_-_-_-_-_-_-_-_-*/
/*-----------------------------------------------------------------*/

	function shorti_similar_projects() { ?>
	
		<ul id="similar_projects">
		
			<h4><?php _e("Similar Projects", "shorti"); ?></h4>
		
			<?php 
			
			global $post;

			$terms = get_the_terms( $post->ID , 'projects', 'string');
			
			if (!empty($terms) && count($terms) > 0) :
			
			$term_ids = array_values( wp_list_pluck($terms,'term_id') );  
			
		    query_posts(array(
		    
		    	'tax_query' => array(
                    array(
                        'taxonomy' => 'projects',
                        'field' => 'id',
                        'terms' => $term_ids,
                        'operator'=> 'IN'
                     )),
				'post__not_in' => array($post->ID),
				'showposts' => 3,
				'ignore_sticky_posts' => 1,
				'post_type' => 'project'
		    
		    ));

		    if (have_posts()) : while (have_posts()) : the_post();
		    
		    // Taxonomy
		    $cats = get_the_terms($post->ID, 'projects');
		    $count = count($cats);
		        
		    // Featured Image
		    $imgThumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'project_thumb');
		    
			?>
			
			<li id="post-<?php the_ID(); ?>" class="project<?php if ( $count > 0 ) { foreach($cats as $category) { echo ' ' . $category->slug; } }?>"> 
			
				<div class="recent_thumb">
				
					<?php if ($imgThumb) : ?>
						
			            <a href="<?php the_permalink(); ?>"><img src="<?php echo $imgThumb[0]; ?>" alt="<?php the_title(); ?>" /></a>
			            
			        <?php else : ?>
			        
			            <p class="center"><?php _e("- No Image Defined -", "shorti"); ?></p>
			            
			        <?php endif; ?>
		        
		        </div>
		        
		        <div class="recent_body">
		        
			        <h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
			        <?php the_excerpt(); ?>
		        
		        </div>
		        
		    </li>    
		    
		    <?php endwhile; endif; endif; wp_reset_query(); ?>
		    
		</ul>
	
	<?php }
	
	
	
/*-----------------------------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ SHORTI TAXONOMIES TERMS LINKS _-_-_-_-_-_-_-_-_-_-*/
/*-----------------------------------------------------------------------*/

function shorti_taxonomies_terms_links() {

	global $post, $post_id;

	$post = &get_post($post->ID);

	$post_type = $post->post_type;

	$taxonomies = get_object_taxonomies($post_type);
	
	foreach ($taxonomies as $taxonomy) {

		$terms = get_the_terms( $post->ID, $taxonomy );
		
		if ( !empty( $terms ) ) {
			$out = array();
			foreach ( $terms as $term )
				$out[] = '<a href="' .get_term_link($term->slug, $taxonomy) .'">'.$term->name.'</a>';
			$return = join( ', ', $out );
		}
		
	}
	
	return $return;
	
}



/*--------------------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ SHORTI SELECT FILTER _-_-_-_-_-_-_-_-_-_-*/
/*--------------------------------------------------------------*/

function shorti_select_filter() {

	$locations = get_nav_menu_locations();
				
	$menu = wp_get_nav_menu_object( $locations[ "main-menu" ] );
	
	$menu_items = wp_get_nav_menu_items( $menu->term_id );
	
	$menu_list = "<select id='filter_drop'>";
	
	$menu_list .= "<option value='*'>All</option>";
	
	$cats = get_terms('projects');
	
	foreach ($cats as $cat) {
	
	$menu_list .= "<option value='.".$cat->slug."'>".$cat->name."</option>";
	
	} 
	
	$menu_list .= "</select>";
	
	echo $menu_list;

}



/*-------------------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ SHORTI AJAX CONTACT _-_-_-_-_-_-_-_-_-_-*/
/*-------------------------------------------------------------*/

function shorti_ajax_contact() { ?>

	<script type="text/javascript">

	function validate_form() {

        var error = 0;
        jQuery("#name_error").detach();
        jQuery("#email_error").detach();
        jQuery("#message_error").detach();
        
        

		// Name
        if (document.getElementById("name").value =="" || document.getElementById("name").value == null){
            jQuery("#name").animate({backgroundColor: "#ff4343"});
            jQuery("#name").parent().find("label").animate({color: "#fff"});
            error = 1;
        }
	        
	        
	    
		// Email
        var _regexp = new RegExp(/^([0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/);
        var _email = document.getElementById("email").value;
        if(_regexp.test(_email) == false) {
            jQuery("#email").animate({backgroundColor: "#ff4343"});
            jQuery("#email").parent().find("label").animate({color: "#fff"});
            error = 1;
        }
	        
	        
	    
		// Message
        if (document.getElementById("message").value =="" || document.getElementById("message").value == null){
            jQuery("#message").animate({backgroundColor: "#ff4343"});
            jQuery("#message").parent().find("label").animate({color: "#fff"});
            error = 1;
        }       
	 
        

        if (error == 1){
            return false;
        }else{
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var message = document.getElementById("message").value;
            jQuery("#loader").css("display","block");
            jQuery.ajax({
                type:       "POST",
                url:        "<?php echo get_stylesheet_directory_uri(); ?>/includes/contact.php",
                cache:      false,
                data:        "name=" + name +"&email="+email+"&message="+message,
                success:    function(html) {
                    jQuery("#contact_form").slideUp("slow")
                    jQuery("#submit_button").attr("disabled", "disabled");
                    jQuery("#contact_form").after("<h3 class='center' id='send_message'>Message Sent!</h3>");
                    jQuery("#send_message").fadeIn("slow");
                }
            });
        }
	
	return false;
	
	}

	</script>

<?php }



/*-----------------------------------------------------------*/												
/*-_-_-_-_-_-_-_-_-_-_ SHORTI MAP SCRIPT _-_-_-_-_-_-_-_-_-_-*/
/*-----------------------------------------------------------*/

	function shorti_map_script() { ?>
	
	<script>

	jQuery.noConflict();
	
	jQuery(document).ready(function(){
	
		var body = jQuery("body");
	
		var cords = jQuery("#map-canvas").data('cord');
		var zoomi = jQuery("#map-canvas").data('zoom');
		var lines = cords.split(";");
		
		console.log(lines[0]);
		
		var map_options = {
			lat: lines[0],
			lon: lines[1],
			container_id: 'map-canvas',
			set_marker: true,
			zoom: zoomi,
			panControl: false,
            scrollwheel: false
		};
		
		initializeMap(map_options);
		
		function initializeMap(options) {
		
			var mapDiv = document.getElementById(options.container_id);
			var position = new google.maps.LatLng(options.lat, options.lon);
			
			var map = new google.maps.Map(mapDiv, {
				center: position,
				zoom: options.zoom,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				disableDefaultUI: true,
				panControl: true,
				zoomControl: true,
				mapTypeControl: true,
				zoomControlOptions: {
					style: google.maps.ZoomControlStyle.LARGE
				},
				mapTypeControlOptions: {
					style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
				}
			});
			
			// Set marker if allowed
			if(options.set_marker)
			{
				new google.maps.Marker({map: map, position: position});
			}
			
			// For Purpose of Responsivity
			jQuery(window).bind('afterresize', function()
			{
				map.panTo(position);
			});
			
		}
	
	});
	
	</script>
	
<?php }