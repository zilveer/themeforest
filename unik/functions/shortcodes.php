<?php
	//prevent all shortcode from generating auto paragraph and break
	
	function unik_shortcodes_format($content) {
		global $shortcode_tags;
		$alltags = '';
		foreach($shortcode_tags as $shortcode_tag => $value){
			$alltags .= $shortcode_tag.'|';
		}
	
		// opening shortcode tag
		$new_codes = preg_replace("/(<p>)?\[($alltags)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);

		// closing shortcode tag
		$new_codes = preg_replace("/(<p>)?\[\/($alltags)](<\/p>|<br \/>)/","[/$2]",$new_codes);
		return $new_codes;
	}

	add_filter('the_content', 'unik_shortcodes_format');
	add_filter('widget_text', 'unik_shortcodes_format');
		

	//[sidebar name="main-sidebar" block_bg="no"]
	
	add_shortcode('sidebar', 'unik_shortcode_sidebar');
	
	function unik_shortcode_sidebar($atts){
	
		 extract( shortcode_atts( array(
		  'name' => 'main-sidebar',
	      ), $atts ) );
		  
		ob_start(); ?>
		<div class="no-block-bg">
			<?php dynamic_sidebar($atts['name']); ?>
		</div>

	
	<?php
		$return = ob_get_contents();
		ob_end_clean();
		
		return (do_shortcode($return));
		
	}
	
	//[one_half]...[/one_half]
	
	add_shortcode('one_half', 'unik_shortcode_one_half');
	
	function unik_shortcode_one_half($atts, $content=null){
		 extract( shortcode_atts( array(
		  'last' => 'no',
		  'style' => '',
	      ), $atts ) );	
		  
			
			if($last=='yes'){
				$return = '<div class="two-fourth last" style="'.$style.'" >'.$content.'</div><div class="clear"></div>';
			} 
			else{$return = '<div class="two-fourth" style="'.$style.'" >'.$content.'</div>';}				
			return (do_shortcode($return));
	}
	
	
	//[full_row]...[/full_row]
	
	add_shortcode('full_row', 'unik_shortcode_fullrow');
	
	function unik_shortcode_fullrow($atts, $content=null){
			 extract( shortcode_atts( array(
			  'last' => 'no',
			   'style' => '',
			), $atts ) );	
		  
			
			$return = '<div class="full-row clearfix" style="'.$style.'" >'.$content.'</div>';	
			return (do_shortcode($return));	
		}
		
	
	//[one_third]...[/one_third]
	
	add_shortcode('one_third', 'unik_shortcode_oneThird');
	
	function unik_shortcode_oneThird($atts, $content=null){
			 extract( shortcode_atts( array(
			  'last' => 'no',
		      'style' => '',
	      ), $atts ) );	
		  	
			
			if($last=='yes'){
				$return = '<div class="one-third last" style="'.$style.'" >'.$content.'</div><div class="clear"></div>';
			} 
			else{$return = '<div class="one-third" style="'.$style.'" >'.$content.'</div>';	}
			return (do_shortcode($return));	
		}
		

	//*[two_third]...[/two_third]
	
	add_shortcode('two_third', 'unik_shortcode_twoThird');
	
	function unik_shortcode_twoThird($atts, $content=null){
		 extract( shortcode_atts( array(
		  'last' => 'no',
		 'style' => '',
	      ), $atts ) );	
		  			
		  
		if($last=='yes'){
			$return = '<div class="two-third last" style="'.$style.'" >'.$content.'</div><div class="clear"></div>';
		} 	
		else{$return = '<div class="two-third" style="'.$style.'">'.$content.'</div>';	}
		return (do_shortcode($return));	
	}
	
	
	//[one_fourth]...[/one_fourth]
	
	add_shortcode('one_fourth', 'unik_shortcode_oneFourth');
	
	function unik_shortcode_oneFourth($atts, $content=null){
		 extract( shortcode_atts( array(
		  'last' => 'no',
		  'style' => '',
	      ), $atts ) );	
		  
			
		if($last=='yes'){
			$return = '<div class="one-fourth last" style="'.$style.'" >'.$content.'</div><div class="clear"></div>';
		} 	
		else{$return = '<div class="one-fourth" style="'.$style.'">'.$content.'</div>';	}
		return (do_shortcode($return));	
	}

	
	// [three_fourth]...[/three_fourth]
	
	add_shortcode('three_fourth', 'unik_shortcode_threeFourth');	
	
	function unik_shortcode_threeFourth($atts, $content=null){
		 extract( shortcode_atts( array(
		  'last' => 'no',
		  'style' => '',
	      ), $atts ) );	
			
		if($last=='yes'){
			$return = '<div class="three-fourth last" style="'.$style.'" >'.$content.'</div><div class="clear"></div>';
		}
		else{$return = '<div class="three-fourth" style="'.$style.'">'.$content.'</div>'; }
		return (do_shortcode($return));
	}
	
	// [block_bg title="" css=""]...[/block_bg]
	
	add_shortcode('block_bg', 'unik_shortcode_block_bg');	
	
	function unik_shortcode_block_bg($atts, $content=null){
		 extract( shortcode_atts( array(
		  'title' => '',
		  'css' => '',
		  'animation' => '',
	      ), $atts ) );	
		 
		 $unik_animation ='';
		 $unik_animation_class ='';
		 $block_title = '';
		 
		 if($animation != ''){
			$unik_animation = 'data-animation="'.$animation.'"';
			$unik_animation_class = 'animate-init';
		 }
		 
		if($title!=''){
			$block_title = '<h3 class="block-title">'.$title.'</h3>';
		}
		
			$return = '<div class="bg-block-1 '.$unik_animation_class.'" style="'.$css.'" '.$unik_animation.'>'.$block_title . $content.'</div><div class="clear"></div>';
		
		return (do_shortcode($return));
	}	
	
	//[promotion_box full_width="yes" bg_color="" color="" bg_img="" css=""][/promotion_box]
	
	add_shortcode( 'promotion_box', 'unik_shortcode_promotion_box' );
	
	function unik_shortcode_promotion_box( $atts,$content=null ) {
		extract( shortcode_atts( array(
			'full_width' => 'yes', 
			'bg_color' => '', 
			'bg_img' => '', 
			'css' => '', 
		), $atts ) );
		
		if($full_width=='yes'){$width = 'promobg-full';
		
			$return  = '<div class="promobox promobox-promobg-full" style="'.$css.'">'.$content.'<div class="promo-bg promobg-full" style="width: 100%; height: 100%;background-image:url('.$bg_img.'); background-size: cover; background-color: '.$bg_color.';"></div></div>';
		} 
		else{
			$return  = '<div class="promobox">'.$content.'<div class="promo-bg" style="width: 100%; height: 100%;background-image:url('.$bg_img.'); background-size: cover; background-color: '.$bg_color.';'.$css.'"></div></div>';
		}
	
		return (do_shortcode($return));	
		
	}
	
	
	//[button link="#" class="e.g. button, button-transparent " css="border: 1px solid #fff" hover_css="" size="eg. large, medium, small"]Purchase[/button]
	
	add_shortcode( 'button', 'unik_shortcode_button' );
	
	function unik_shortcode_button( $atts,$content=null ) {
		extract( shortcode_atts( array(
			'link' => '#', 
			'size' => 'medium', 
			'class' => 'button',
			'css' => '',
			'hover_css' => '',
		), $atts ) );
		
		$id = rand ( 100 , 1000 );

		$return   = '<a class="'.$class.' button-'.$size.' button-'.$id.'" href="'.$link.'" >'.$content.'</a>';
		$return  .= '<style>.button-'.$id.'{'.$css.'}.button-'.$id.':hover{'.$hover_css.'}</style>';
		
		return (do_shortcode($return));	
		
	}
	
	
	//[youtube id="Video ID (eg. Wq4Y7ztznKc)" width="600" height="350"]
	
	add_shortcode( 'youtube', 'unik_shortcode_youtube' );
	
	function unik_shortcode_youtube( $atts ) {
		extract( shortcode_atts( array(
			'id' => '',
			'width' => '600',
			'height' => '350',
		), $atts ) );
		return '<div class="video"><iframe width="'.$width.'" height="'.$height.'" src="http://www.youtube.com/embed/'.$id.'" frameborder="0" allowfullscreen></iframe></div>';
	}	
	
	
	//[vimeo id="Video ID  (eg. 10145153)" color="333333" title="" portrait="" byline="" badge="" width="600" height="350"]
	
	add_shortcode('vimeo', 'unik_shortcode_vimeo');
		
	function unik_shortcode_vimeo($atts) {
		extract( shortcode_atts(
			array(
				'id' => '',
				'width' => '600',
				'height' => '360',
				'color' => '333333',
				'title' => '',
				'portrait' => '',
				'byline' => '',
				'badge' => '',
			), $atts));
		
		$return =  '<div class="video"><iframe src="http://player.vimeo.com/video/'.$atts['id'].'?badge='.$badge.'&portrait='.$portrait.'&title='.$title.'&byline='.$byline.'&color='.$color.'" width="'.$width.'" height="'.$height.'"></iframe></div>';
		return (do_shortcode($return));
	}
	
	
	//[soundcloud url="" width="" height="" auto_play="false" buying="false" sharing="false" liking="false" sharing="false" show_artwork="false" show_comments="false" show_playcount="false" show_user="false" start_track="false"]
	
	add_shortcode('soundcloud', 'unik_shortcode_soundcloud');
	
	function unik_shortcode_soundcloud($atts) {
		extract(shortcode_atts(
			array(
				'url' => '',
				'width' => '100%',
				'height' => 50,
				'auto_play' => 'false',
				'buying' => 'false',
				'liking' => 'false',
				'sharing' => 'false',
				'show_artwork' => 'false',
				'show_comments' => 'false',
				'show_playcount' => 'false',
				'show_user' => 'false',
				'start_track' => 'false',
			), $atts));
		
			$return = '<iframe width="'.$width.'" height="'.$height.'" scrolling="no" frameborder="no" src="http://w.soundcloud.com/player?url='.$url.'&auto_play='.$auto_play.'&buying='.$buying.'&liking='.$liking.'&sharing='.$sharing.'&show_artwork='.$show_artwork.'&show_comments='.$show_comments.'&show_playcount='.$show_playcount.'&show_user='.$show_user.'&start_track='.$start_track.'"></iframe>';
			
			return (do_shortcode($return));
	}

	
	
	// Shadow box [shadow_box style="" shadow_style="1"][/shadow_box]
	
	add_shortcode('shadow_box', 'unik_shortcode_shadow_box');
	
	function unik_shortcode_shadow_box($atts,$content=null){
			extract( shortcode_atts( array(
				'css' => '',
				'shadow_style' => '1',
			), $atts ) );
		if(intval($shadow_style>4)){$shadow_style=4;}	
			
		$return = '<div class="shadow-box-'.$shadow_style.'" style="'.$css.'">'.$content.'</div>';
		return (do_shortcode($return));
	}
	
	//[highlight color="#000000" textcolor="#ffffff"]..[/highlight]
	
	add_shortcode('highlight', 'unik_shortcode_highlight');
	
	function unik_shortcode_highlight($atts, $content=null){
		 extract( shortcode_atts( array(
		  'color' => '#000000',
		  'textcolor' => '#ffffff',
	      ), $atts ) );
		$style = ' style="color:' . $textcolor . '; background-color:' . $color . '; padding: 2px 4px;"';
		$return = '<span' . $style . '">'.do_shortcode($content).'</span>';
		return (do_shortcode($return));
		
	}
	
	
	//[googlemap lat="40.734771,-74.065411" width="100%" height="400px" zoom="10" marker_title=""]
	
	add_shortcode('googlemap', 'unik_shortcode_googlemap');
 
	function unik_shortcode_googlemap($atts){
		 extract( shortcode_atts( array(
		  'zoom' => '10',
		  'lat' => '40.734771,-74.065411',
		  'width' => '100%',
		  'height' => '400px',
		  'marker_title' => '',
	      ), $atts ) );
		
		$return = "<script>
		function initialize() {
			var myLatlng = new google.maps.LatLng($lat);
		  var mapOptions = {
			zoom: $zoom,
			center: new google.maps.LatLng($lat)
		  };

		  var map = new google.maps.Map(document.getElementById('map-canvas'),
			  mapOptions);
		  var marker = new google.maps.Marker({
				  position: myLatlng,
				  map: map,
				  title: '$marker_title'
			  });
			}
		function loadScript() {
		  var script = document.createElement('script');
		  script.type = 'text/javascript';
		  script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' +
			  'callback=initialize';
		  document.body.appendChild(script);
		}";
		
		$return .= "loadScript();</script>";
		$return .= "<div id='map-canvas' style='width: $width; height: $height '></div>";
		return (do_shortcode($return));
		
	}
	

	
	// [latest_posts count="4" style="e.g. carousel, image_medium, image_large" title="Latest posts" categories=""]
	
	add_shortcode('latest_posts', 'unik_shortcode_latestpost');
	
	function unik_shortcode_latestpost($atts){
		extract( shortcode_atts( array(
			'title' => 'Latest posts' ,
			'style' => 'carousel' ,
			'categories' => '' ,
			'count' => '5' ,
			'order' => 'DESC' ,
			'orderby' => 'date' ,
		), $atts ) );

		$paged =  1;
		global $post, $wp_query;			  
		
		ob_start();
		$temp = $wp_query; 
		$wp_query = null; 
		$wp_query = new WP_Query(); 
		$args = array(
					'post_type' 		=> 'post',
					'post_status' 		=> 'publish',
					'posts_per_page' 	=> $count,
					'orderby' 			=> $orderby,
					'order' 			=> $order,
					'paged' 			=> $paged,
					'category_name'		=> $categories
				);
				
		$wp_query->query($args);
		
		$blog_image_size = $style;
		
		if($style=='carousel'): // carousel style post
			
			echo '<div class="carousel-box">';
			if($title!=''){echo "<h3 class='block-title'>{$title}</h3>";}
			echo '<div class="carousel-slides">';
			echo '<div class="carousel carousel-post"><ul class="latest-post list-unstyled">';							
			
			while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
				
				<?php $carousel_images = get_post_meta($post->ID, THEMENAME.'_post_carousel');
				$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');				
				
				?>
				
				<?php if(has_post_thumbnail( $post->ID )): ?>
				
				<li>
					<!-- post thumbnail -->
					<div class="entry-thumbnail">
						<div class="thumb-holder sm-border">
							<div class="view effect-2">
								<?php the_post_thumbnail('carousel'); ?>	
								<a href="<?php echo $full_image[0]; ?>" data-rel="prettyPhoto">
									<div class="mask">
										<div class="info">
											<i class="icon-search"></i>
										</div>				
									</div>
								</a>
							</div>
						</div>
					</div>

					<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<p><?php echo get_the_date(); ?> &nbsp;  &nbsp; <span><?php if ($post->comment_status == 'open') : ?><i class="icon-comment"></i> <?php comments_popup_link( __( '0 comment', THEMENAME ) , __( '1 comment', THEMENAME ), __( 'View all % comments', THEMENAME ) ); endif; ?></span></p>
					<p><?php echo substr(get_the_excerpt(),0,150)." ..."; ?><a class="button-small" href="<?php the_permalink(); ?>"><?php _e('more',THEMENAME); ?></a></p>
				</li>
				<?php endif; ?>
				
			<?php endwhile; 		
			echo '</ul></div></div><div class="control"><a class="prev" href="#"><i class="icon-left-open"></i></a>
					<a class="next" href="#"><i class="icon-right-open"></i></a></div></div>';
			
		elseif($style=='image_medium'): // image medium style post
			
			while ($wp_query->have_posts()) : $wp_query->the_post();  
			
			if(get_post_format()=='audio'){
				$template = 'inc/audio-upload';
			}
			elseif(get_post_format()=='gallery'){
				$template = 'inc/gallery-images';
			}
			else{
				$template = 'inc/blog-image';
			}
			
			?>
			<?php 
			$carousel_images = get_post_meta($post->ID, THEMENAME.'_post_carousel'); ?>
			
	
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="row">
					<?php if(has_post_thumbnail()):  ?>
					
					<div class="col-sm-6">
						<?php get_template_part($template); ?>
					</div>
					<div class="col-sm-6">
						<?php get_template_part('inc/blog','header'); ?>
						<?php the_excerpt(); ?>		
					</div>
					
					<?php else: ?>
					
					<div class="col-sm-12">
						<?php get_template_part('inc/blog','header'); ?>
						<?php the_excerpt(); ?>		
					</div>
					
					<?php endif; ?>
				</div>			
			</article>
		
		<?php
			endwhile;
			
			unik_pagination(); 
		 
			
		elseif($style=='image_large'): ?>
			<?php while ($wp_query->have_posts()) : $wp_query->the_post();   
			
			if(get_post_format()=='audio'){
				$template = 'inc/audio-upload';
			}
			elseif(get_post_format()=='gallery'){
				$template = 'inc/gallery-images';
			}
			else{
				$template = 'inc/blog-image';
			}
			
			?>
			
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="clearfix">
				
					<?php get_template_part('inc/blog','header'); ?>					
					
					<?php if(has_post_thumbnail()){ get_template_part($template); } ?>
					
					<?php get_template_part('inc/blog','content'); ?>
				</div>			
			</article>
			
			<?php endwhile; ?>
			
			<?php 
				unik_pagination(); 
			?>
			
		<?php
		endif; // blog styles end
		
		$return = ob_get_contents();
	
		wp_reset_query();
		ob_end_clean();
		return (do_shortcode($return));
	}
	

	
	// [latest_event count="6" col="4"]
	
	add_shortcode('latest_event', 'unik_shortcode_latest_event');
	
	function unik_shortcode_latest_event($atts){
		extract( shortcode_atts( array(
				'count' => '6',
				'col' => '4',
				'masonry' => 'no',
				'categories' => '',
				'type' => '' ,
				'order' => 'DESC' ,
			), $atts ) );
		
		
		
		global $post,$post_id;
		$wp_query; 
		$wp_query = null; 
		$wp_query = new WP_Query(); 
		
		if($type == 'coming' || $type == 'passed'){
			 $perpage = -1; 
		}else{
			$perpage = $count; 
		}
		
		if(!empty($categories)){
			$event_cats = array();
			$event_cats = explode(',',str_replace(' ','',$atts['categories']));
			$args = array(
					'post_type' 		=> 'event',
					'posts_per_page' 	=> $perpage,
					'post_status' 		=> 'publish',
					'orderby' 			=> 'meta_value',
					'meta_key' 			=> 'unik_event_date',
					'order' 			=> $order,
					'tax_query' => array(
						array(
							'taxonomy' => 'event_cat',
							'field' => 'slug',
							'terms' => $event_cats
						)
					),
				);
		}
		else{
		$originalDate = get_post_meta($post->ID, THEMENAME.'_event_date',true);
		$args = array(
					'post_type' 		=> 'event',
					'posts_per_page' 	=> $perpage,
					'post_status' 		=> 'publish',
					'orderby' 			=> 'meta_value',
					'meta_key' 			=> 'unik_event_date',
					'order' 			=> $order,
				);
		}
		  		
		
				
		$wp_query->query($args); 
		
		if($col>4){$col=4;}	// set maximum columns to 4
		
		ob_start(); ?>
		<div class="shows columns clearfix col-<?php echo $col; ?>"><ul class="list-unstyled <?php if($masonry=='yes'){echo "masonry_container";} ?>">
		
		<?php
		$item = 0;
		while ($wp_query->have_posts() && $item < $count) : $wp_query->the_post(); ?>
				<?php
					$date = explode('-',get_post_meta($post->ID, THEMENAME.'_event_date',true));
					
					if($type == 'coming' && current_time( 'Y-m-d', $gmt = 0 ) > get_post_meta($post->ID, THEMENAME.'_event_date',true)){ 
						$ticket = 0; 
					}
					elseif($type == 'passed' && current_time( 'Y-m-d', $gmt = 0 ) < get_post_meta($post->ID, THEMENAME.'_event_date',true)){ 
						$ticket = 0;
					}
					else{ 
						$ticket = 1; 
					}
					
					if( $ticket == 1 ): 
					
					$item ++;
				?>
			<li class="col">
				<?php
					$date = explode('-',get_post_meta($post->ID, THEMENAME.'_event_date',true));
					
					// Linked product button
					$linked_product = get_post_meta($post->ID, THEMENAME.'_linked_product',true); 
					$linked_btn = get_post_meta($post->ID, THEMENAME.'_product_link_text',true); 
				?>
				
								
				
				
				<?php if(has_post_thumbnail() ): ?>	
				<div class="gig_img event-thumbnail view effect-2">
					
					<?php 
						if($masonry == 'yes'){
							the_post_thumbnail('masonry'); 
						}
						else{
							the_post_thumbnail('col-'.$col); 
						}
					$full_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
					?>
					
				
					<a href="<?php echo $full_image[0]; ?>" data-rel="prettyPhoto">
						<div class="mask">
							<div class="info">
								<i class="icon-search"></i>
							</div>
							
						</div>
					</a>
				</div>
				<?php endif; ?>
				
				
					<div class="gig_text text-center clearfix">
						<?php if(isset($date[2])): ?>
						<div class="gig_date">
						
						<?php $originalDate = get_post_meta($post->ID, THEMENAME.'_event_date',true);
								$newDate = date_i18n(get_option( 'date_format' ), strtotime($originalDate)); // change date format according to user date format
								echo $newDate; ?>
						
						<?php if(!empty($linked_product)): ?>
						<br><a href="<?php echo get_the_permalink($linked_product); ?>" class="btn btn-xs"><?php echo $linked_btn == '' ? 'Buy' : $linked_btn; ?></a>
						<?php endif; ?>
					
						</div>
				<?php endif; ?>
						<a class="gig_link" href="<?php the_permalink(); ?>">
						<h4><?php the_title(); ?></h4>
						<?php echo get_post_meta($post->ID, THEMENAME.'_event_place', true); ?>
						</a>
					</div>
				
			</li>
			<?php $ticket = null; endif; ?>
<?php		
			endwhile;
		echo '</ul></div>';
		
		wp_reset_postdata();
		
		$return = ob_get_contents();
		ob_end_clean();
		return (do_shortcode($return));
			
	}
	
	


	//[accordion_group]...[/accordion_group]
	
	add_shortcode('accordion_group', 'unik_shortcode_accordion');	
	
	function unik_shortcode_accordion($atts, $content=null){
		extract( shortcode_atts( array(
			'multi_active' => 'yes',
		), $atts ) );
		
		if($multi_active == 'yes') { 
			$return = '<div class="unik-accordion multi-active">'.$content.'</div>'; 
		}else{
			$return = '<div class="unik-accordion">'.$content.'</div>';
		}
		
		
		return (do_shortcode($return));	
	}		
		
		
	// [accordion]
	
	add_shortcode( 'accordion', 'unik_shortcode_accordionContent' );
	
	function unik_shortcode_accordionContent( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'title' => 'sample title',
			'active' => 'no',
		), $atts ) );
		
		if($active=='yes'){$active_class='active';} else{$active_class='';}	
		
		$return = '<h5 class="accordion '.$active_class.'">'.$title.'</h5>';
		$return .= '<div class="accordion-content '.$active_class.'">'.$content.'</div>';
		return do_shortcode($return);
	}			

	
	
	// [icon class="" size="1x" round_size="" round_bg="" color=""]
	
	add_shortcode( 'icon', 'unik_shortcode_icons' );
	
	function unik_shortcode_icons( $atts ) {
		extract( shortcode_atts( array(
			'class' => '',
			'size' => '1x',
			'round_bg' => '',
			'color' => '',		
		), $atts ) );
		if($round_bg =='' ){$round = 'no-round';} else {$round = 'round_bg';}
		
		$return = '<i class="'.$round.' round-'.$size.' '.$class.'" style="background-color: '.$round_bg.';color:'.$color.'"></i>';
		return do_shortcode($return);
	}
	
		
	// [testimonial_group]
	
	add_shortcode('testimonial_group', 'unik_shortcode_testimonial_group');	
	
	function unik_shortcode_testimonial_group($atts, $content=null){
		
		$return = '<div class="testimonial"><ul class="slides">'.$content.'</ul></div>';
		return (do_shortcode($return));	
	}
	
	
	
	// [testimonial user_name="" user_company="" user_image=""]Content goes here [/testimonial]

	add_shortcode( 'testimonial', 'unik_shortcode_testimonial' );
	
	function unik_shortcode_testimonial( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'user_name' => '',
			'user_company' => '',
			'user_image' => '', 
		), $atts ) );
		
		
		$return = '<li>';
		$return .= '<blockquote>'.$content.'</blockquote>';
		$return .= '<div class="user">';
		if($user_image != ''){ $return .= '<span class="user-photo"><img src="'.$user_image.'" alt="'.$user_name.'"></span>'; }
		else {
			$return .= '<span class="user-photo"><span class="glyphicon glyphicon-user"></span></span>'; 
		}
		$return .= $user_name.', '.$user_company;
		$return .= '</div>';
		$return .= '</li>';

		return do_shortcode($return);
	}

	
	// [grouped_col col="4"]

	add_shortcode( 'grouped_col', 'unik_shortcode_grouped_col' );	
	
	function unik_shortcode_grouped_col( $atts,$content = null ) {
		extract( shortcode_atts( array(
			'col' => '',	
		), $atts ) );
		
		$return = '<div class="columns col-'.$col.' clearfix">'.$content.'</div>';
		return do_shortcode($return);
	}
	
	// [col]
	
	add_shortcode( 'col', 'unik_shortcode_col' );
	
	function unik_shortcode_col( $atts,$content = null ) {
		extract( shortcode_atts( array(
		), $atts ) );
		
		$return = '<div class="col">'.$content.'</div>';
		return do_shortcode($return);
	}

	
	//Customize default gallery shortcode
	
	add_shortcode('gallery', 'unik_gallery_shortcode'); 
		
	function unik_gallery_shortcode($attr) {
			$post = get_post();

		static $instance = 0;
		$instance++;

		if ( ! empty( $attr['ids'] ) ) {
			// 'ids' is explicitly ordered, unless you specify otherwise.
			if ( empty( $attr['orderby'] ) )
				$attr['orderby'] = 'post__in';
			$attr['include'] = $attr['ids'];
		}

		// Allow themes to override the default gallery template.
		$output = apply_filters('post_gallery', '', $attr);
		if ( $output != '' )
			return $output;

		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( !$attr['orderby'] )
				unset( $attr['orderby'] );
		}

		extract(shortcode_atts(array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'dl',
			'icontag'    => 'dt',
			'captiontag' => 'dd',
			'columns'    => 3,
			'size'       => 'medium',
			'include'    => '',
			'exclude'    => '',
			'masonry'    => 'no',
		), $attr));
		
		$size = $masonry=='yes' ? 'masonry-medium' : $size;

		$id = intval($id);
		if ( 'RAND' == $order )
			$orderby = 'none';

		if ( !empty($include) ) {
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( !empty($exclude) ) {
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}

		if ( empty($attachments) )
			return '';

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment )
				$output .= wp_get_attachment_link($att_id, $attr['col-'], true) . "\n";
			return $output;
		}

		$itemtag = tag_escape($itemtag);
		$captiontag = tag_escape($captiontag);
		$icontag = tag_escape($icontag);
		$valid_tags = wp_kses_allowed_html( 'post' );
		if ( ! isset( $valid_tags[ $itemtag ] ) )
			$itemtag = 'dl';
		if ( ! isset( $valid_tags[ $captiontag ] ) )
			$captiontag = 'dd';
		if ( ! isset( $valid_tags[ $icontag ] ) )
			$icontag = 'dt';

		$columns = intval($columns);
		$itemwidth = $columns > 0 ? round(100/$columns,2) : 100;
		$float = is_rtl() ? 'right' : 'left';

		$selector = "gallery-{$instance}";
		
		
		$gallery_style=$gallery_div = '';
		if ( apply_filters( 'use_default_gallery_style', true ) )
			$gallery_style="
			<style type='text/css'>
				#{$selector} {
					margin: auto;
				}
				#{$selector} .gallery-item {
					float: {$float};
					margin-top: 10px;
					text-align: center;
					width: {$itemwidth}%;
				}
				
				#{$selector} .gallery-caption {
					margin-left: 0;
				}
			</style>";
		$masonry_class = $masonry=='yes' ? 'masonry_container' : '';
		
		$size_class = sanitize_html_class( $size );
		$gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class} {$masonry_class}'>";
		$output .= apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

		$i = 0;
		foreach ( $attachments as $id => $attachment ) {
			$caption = '';
			$full_image = wp_get_attachment_image_src($id, 'full');
			$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);
			if ( $captiontag && trim($attachment->post_excerpt) ) {$caption = wptexturize($attachment->post_excerpt);}

			$output .= "<div class='gallery-item gallery-thumbnail view effect-2'>";
			$output .= "
				<div class='gallery-icon'>
					$link
				</div>";
				$output .= "
				<a href=".$full_image[0]." data-rel='prettyPhoto[id-".$post->ID."]'><div class='mask'> <div class='info wp-caption-text gallery-caption'><i class='icon-search'></i><div class='caption-txt'>" . $caption . "</div> </div></div></a>";
			
			$output .= "</div>";
			if ( $columns > 0 && ++$i % $columns == 0 )
				$output .= '<div class="clear"></div>';
		}

		$output .= "<div class='clear'></div></div>";
		return (do_shortcode($output));
	}

	add_shortcode('audio_button', 'unik_shortcode_audio_button');

	function unik_shortcode_audio_button($atts){
		extract( shortcode_atts( array(
			'title' => '',
			'artist' => '',
			'src' => '',
			'cover' => '',
			'id' => ''
		), $atts ) );

		if(!empty($id)){
			$title = get_the_title(intval($id));
			$cover = wp_get_attachment_url(get_post_thumbnail_id(intval($id)));
			$meta_data = wp_get_attachment_metadata(intval($id));
			$artist = $meta_data['artist'];
		

			$output = '<div class="cp-controls inline" data-source="'. unik_encryptIt($src) .'" data-title="'.$title.'" data-artist="'.$artist.'" data-poster="'.$cover.'" >
						<a class="cp-play"  href="#"><i class="icon-play"></i></a>
						<a class="cp-pause" href="#"><i class="icon-pause"></i></a>
					</div>';
												
			
		}else{
			$output = '<div class="cp-controls inline" data-source="'. unik_encryptIt($src) .'" data-title="'.$title.'" data-artist="'.$artist.'" data-poster="'.$cover.'" >
						<a class="cp-play"  href="#"><i class="icon-play"></i></a>
						<a class="cp-pause" href="#"><i class="icon-pause"></i></a>
					</div>';
		}
		return (do_shortcode($output));

	}

	// customizing default audio shortcode [audio mp3="source.mp3" ogg="source.ogg" wav="source.wav" title="" autoplay="yes" download="no" cover=""]
	

	
	add_shortcode('audio', 'unik_shortcode_audio');
	
	function unik_shortcode_audio($atts){
		extract( shortcode_atts( array(
			'mp3' => '',
			'ogg' => '',
			'wav' => '',
			'title' => '',
			'cover' => '',
			'autoplay' => '',
			'active' => 'yes',
			'download' => 'no',
			'artist' => '',
		), $atts ) );

		

		$id = rand ( 100 , 1000 );
		if($atts['mp3']!=''){$song = $atts['mp3'];}
		elseif($atts['ogg']!=''){$song = $atts['ogg'];}
		elseif($atts['wav']!=''){$song = $atts['wav'];}

		$postid = unik_get_attachment_id_from_src( $song );

		if(!empty($postid) || $postid != 0){
			
			$audio_meta = get_post($postid);
			$meta_data = wp_get_attachment_metadata($postid);
			
			//title from media
			if(empty($title) || '' == $title){
				if(!empty($audio_meta->post_title)){$title = $audio_meta->post_title;}
			}

			//cover from media
			if(empty($cover) || '' == $cover){
				$new_cover = wp_get_attachment_url( get_post_thumbnail_id($postid) ); 
				if(!empty($new_cover)){$cover = $new_cover;}
			}

			//artist from media
			if(empty($artist) || ''==$artist){
				if(!empty($meta_data['artist'])){$artist = $meta_data['artist'];}
			}
		}


		if($active == 'no'){ $active = 'inactivesong';}else{ $active = 'active';}
		
		$cover_img = '';
		if($cover!=''){$cover_img = '<span data-rel="popimg" class="cover right"><img src="'.$cover.'" alt="cover"></span>';}
		
		$output = '<div class="list-audio-player '.$active.' audio-autoplay-'.$autoplay.'">
						<div id="jquery_jplayer_'.$id.'"></div>
						<div id="cp_container_'.$id.'">
							<div class="player-list clearfix">
								<div class="player-list-title left"><i class="icon-music left"></i>'.$title.'</div>
								
								<div class="cp-controls right" data-source="'. unik_encryptIt($song) .'" data-title="'.$title.'" data-artist="'.$artist.'" data-poster="'.$cover.'" >
									<a class="cp-play" tabindex="1"><i class="icon-play"></i></a>
									<a class="cp-pause" tabindex="1"><i class="icon-pause"></i></a>
								</div>'.$cover_img;
			if($download == 'yes'){
				$output .= '<div class="downloadlink right"><a download href="'.$song.'"><i class="icon-download"></i></a></div>';
			}									
			
			$output .= 	'</div>';
			
			
			

			$output .= '
				
		</div>
	</div>
	';
			
		
		return (do_shortcode($output));
	}

/* Post URLs to IDs function, supports custom post types - borrowed and modified from url_to_postid() in wp-includes/rewrite.php */
function unik_get_attachment_id_from_src ($image_src) {

		global $wpdb;
		$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
		$id = $wpdb->get_var($query);
		return $id;

	}


/* DROPDOWN MEDIA BUTTON FOR INSERTING SHORTCODES INTO PAGES/POSTS
---------------------------------------------------------------------------------------------*/
	add_action('media_buttons','unik_add_unik_select',11);
	
	function unik_add_unik_select(){ ?>

		'&nbsp;<select id="unik_select">
			<option value="">Shortcodes</option>
			<option value='[full_row last="no" style="margin-bottom:50px"]...[/full_row]'>[full_row]</option>
			<option value='[one_half last="no" style="margin-bottom:50px"]...[/one_half]'>[one_half]</option>
			<option value='[one_third last="no" style="margin-bottom:50px"]...[/one_third]'>[one_third]</option>
			<option value='[two_third last="no" style="margin-bottom:50px"]...[/two_third]'>[two_third]</option>
			<option value='[one_fourth last="no" style="margin-bottom:50px"]...[/one_fourth]'>[one_fourth]</option>
			<option value='[three_fourth last="no" style="margin-bottom:50px"]...[/three_fourth]'>[three_fourth]</option>
<option value='[grouped_col col="3"]
[col]Content here[/col]
[col]Content here[/col]
[col]Content here[/col]
[/grouped_col]'>[grouped_col]</option>
			<option data-rel="icon" value='[icon class="" size="1x" color="" round_bg=""]'>[icon]</option>
			<option data-rel="block_bg" value='[block_bg title="" css=""]...[/block_bg]'>[block_bg]</option>
			<option value='[promotion_box full_width="yes" bg_color="" bg_img="" css=""]Cotent goes here[/promotion_box]'>[promotion_box]</option>
			<option value='[shadow_box css="" shadow_style="1"][/shadow_box]'>[shadow_box]</option>
			<option value='[button link="#" class="e.g. button, button-transparent " css="border: 1px solid #fff" hover_css="" size="eg. large, medium, small"]Purchase[/button]'>[button]</option>
			<option value='[audio mp3="source.mp3" title="" download="no" cover="" artist="" ]'>[audio]</option>
			<option value='[sidebar name=""]'>[sidebar]</option>
			<option value='[youtube id="Video ID (eg. Wq4Y7ztznKc)" width="600" height="350"]'>[youtube]</option>
			<option value='[vimeo id="Video ID  (eg. 10145153)" color="333333" title="0" portrait="0" byline="0" badge="0" width="600" height="350"]'>[vimeo]</option>
			<option value='[soundcloud url="" width="100%" height="100" auto_play="false" buying="false" sharing="false" liking="false" show_artwork="false" show_comments="false" show_playcount="false" show_user="false" start_track="false"]'>[soundcloud]</option>
			<option value='[highlight color="#000000" textcolor="#ffffff"][/highlight]'>[highlight]</option>
			<option value='[latest_posts style="choose from carousel, image_medium, image_large" order="DESC" orderby="date" categories="" title="Latest posts"]' >[latest_posts]</option>
			<option value='[latest_event count="6" col="4" type="eg. coming, passed" categories="" masonry="no" order="DESC" orderby="date"]'>[latest_event]</option>
			<option value='[sidebar name="main-sidebar"]'>[sidebar]</option>
			<option value='[googlemap lat="40.734771,-74.065411" width="100%" height="400px" zoom="10"]'>[googlemap]</option>
<option value='[accordion_group multi_active="yes"]
[accordion active="yes" title="Title"]Description here[/accordion]
[accordion  active="no" title="Title"]Description here[/accordion]
[/accordion_group]'>[accordion]</option>
<option value='[testimonial_group]
[testimonial user_name="" user_company="" user_image=""]Content goes here [/testimonial]
[testimonial user_name="" user_company="" user_image=""]Content goes here [/testimonial]
[testimonial user_name="" user_company="" user_image=""]Content goes here [/testimonial]
[/testimonial_group]
'>[testimonial]</option>					   
		</select>';
<?php		
	}

	add_action('admin_head', 'unik_button_js');

	function unik_button_js() { ?>
	
		<script type="text/javascript">
		jQuery(document).ready(function($){;
			
		   jQuery("#unik_select").change(function() {
				if(jQuery("#unik_select :selected").attr("data-rel")=="icon"){
					tb_show('Icon manager', '<?php echo get_template_directory_uri(); ?>/icons/icons.php?&width=600');
				}
				else if(jQuery("#unik_select :selected").attr("data-rel")=="block_bg"){
						tb_show('Block manager', '<?php echo get_template_directory_uri(); ?>/inc/block-manager.php?&width=600');
				}
				else{
				  send_to_editor(jQuery("#unik_select :selected").val());
				  setTimeout(function(){
					$("#unik_select").prop('selectedIndex',0);  
					}, 1000);
				  return false;							
				}
			});
		});
		</script>

<?php	}
?>