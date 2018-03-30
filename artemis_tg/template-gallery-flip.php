<?php
/**
 * The main template file for display portfolio page.
 *
 * Template Name: Gallery Flip
 * @package WordPress
 */

/**
*	Get all photos
**/ 

$menu_sets_query = '';

$portfolio_items = -1;

/**
*	Get Current page object
**/
$page = get_page($post->ID);
$current_page_id = '';

if(isset($page->ID))
{
    $current_page_id = $page->ID;
}

//Check if password protected
$portfolio_password = get_post_meta($current_page_id, 'portfolio_password', true);
if(!empty($portfolio_password))
{
	session_start();
	
	if(!isset($_SESSION['gallery_page_'.$current_page_id]) OR empty($_SESSION['gallery_page_'.$current_page_id]))
	{
		include (get_template_directory() . "/templates/template-password.php");
		exit;
	}
}

//Get content gallery
$gallery_id = get_post_meta($current_page_id, 'page_gallery_id', true);

$args = array( 
	'post_type' => 'attachment', 
	'numberposts' => $portfolio_items, 
	'post_status' => null, 
	'post_parent' => $gallery_id,
	'order' => 'ASC',
	'orderby' => 'menu_order',
); 

//Get gallery images
$all_photo_arr = get_posts( $args );

get_header(); ?>

<?php
	//Get gallery info
	$galleries = get_posts(array('parent' => -1, 'post_type' => 'gallery', 'numberposts' => -1));
	$wp_galleries = array();
	foreach ($galleries as $gallery_list ) {
	       $wp_galleries[$gallery_list->ID]['title'] = $gallery_list->post_title;
	       $wp_galleries[$gallery_list->ID]['desc'] = $gallery_list->post_content;
	}
?>

<?php
if(isset($wp_galleries[$gallery_id]['title']))
{
?>
<div id="kenburns_title"><?php echo $wp_galleries[$gallery_id]['title']; ?></div>
<?php
}

if(isset($wp_galleries[$gallery_id]['desc']))
{
?>
<div id="kenburns_desc"><?php echo $wp_galleries[$gallery_id]['desc']; ?></div>
<?php
}
?>

<div id="tf_loading" class="tf_loading"></div>
<div id="tf_bg" class="tf_bg">
	<?php
	    foreach($all_photo_arr as $key => $photo)
	    {
	        $small_image_url = get_stylesheet_directory_uri().'/images/000_70.png';
	        $hyperlink_url = get_permalink($photo->ID);
	        
	        if(!empty($photo->guid))
	        {
	        	$image_url[0] = $photo->guid;
	        
	        	$small_image_url = wp_get_attachment_image_src( $photo->ID, 'thumbnail');
	        }
	?>
    	<img src="<?php echo $image_url[0]; ?>" alt="" longdesc="<?php echo $small_image_url[0]; ?>" />
    <?php
        }
       ?>
</div>
<div id="tf_thumbs" class="tf_thumbs">
    <span id="tf_zoom" class="tf_zoom"></span>
    <?php
    if(isset($all_photo_arr[0]))
    {
    	$small_image_url = wp_get_attachment_image_src( $all_photo_arr[0]->ID, 'thumbnail');
    	
    	if(isset($small_image_url[0]))
    	{
    ?>
    <img src="<?php echo $small_image_url[0]; ?>" alt=""/>
    <?php
    	}
    }
    ?>
</div>

<div id="tf_next" class="tf_next"></div>
<div id="tf_prev" class="tf_prev"></div>


<script type="text/javascript">
/*
the images preload plugin
*/
(function($j) {
	$j.fn.preload = function(options) {
		var opts 	= $j.extend({}, $j.fn.preload.defaults, options);
		o			= $j.meta ? $j.extend({}, opts, this.data()) : opts;
		var c		= this.length,
			l		= 0;
		return this.each(function() {
			var $ji	= $j(this);
			$j('<img/>').load(function(i){
				++l;
				if(l == c) o.onComplete();
			}).attr('src',$ji.attr('src'));	
		});
	};
	$j.fn.preload.defaults = {
		onComplete	: function(){return false;}
	};
})(jQuery);
</script>
<script type="text/javascript">
$j(function() {
	var $jtf_bg				= $j('#tf_bg'),
		$jtf_bg_images		= $jtf_bg.find('img'),
		$jtf_bg_img			= $jtf_bg_images.eq(0),
		$jtf_thumbs			= $j('#tf_thumbs'),
		total				= $jtf_bg_images.length,
		current				= 0,
		$jtf_content_wrapper	= $j('#tf_content_wrapper'),
		$jtf_next			= $j('#tf_next'),
		$jtf_prev			= $j('#tf_prev'),
		$jtf_loading			= $j('#tf_loading');
	
	//preload the images				
	$jtf_bg_images.preload({
		onComplete	: function(){
			$jtf_loading.hide();
			init();
		}
	});
	
	//shows the first image and initializes events
	function init(){
		//get dimentions for the image, based on the windows size
		var dim	= getImageDim($jtf_bg_img);
		//set the returned values and show the image
		$jtf_bg_img.css({
			width	: dim.width,
			height	: dim.height,
			left	: dim.left,
			top		: dim.top
		}).fadeIn();
	
		//resizing the window resizes the $jtf_bg_img
	$j(window).bind('resize',function(){
		var dim	= getImageDim($jtf_bg_img);
		$jtf_bg_img.css({
			width	: dim.width,
			height	: dim.height,
			left	: dim.left,
			top		: dim.top
		});
	});
	
		//expand and fit the image to the screen
		$j('#tf_zoom').live('click',
			function(){
			if($jtf_bg_img.is(':animated'))
				return false;
	
				var $jthis	= $j(this);
				if($jthis.hasClass('tf_zoom')){
					resize($jtf_bg_img);
					$jthis.addClass('tf_fullscreen')
						 .removeClass('tf_zoom');
				}
				else{
					var dim	= getImageDim($jtf_bg_img);
					$jtf_bg_img.animate({
						width	: dim.width,
						height	: dim.height,
						top		: dim.top,
						left	: dim.left
					},350);
					$jthis.addClass('tf_zoom')
						 .removeClass('tf_fullscreen');	
				}
			}
		);
		
		//click the arrow down, scrolls down
		$jtf_next.bind('click',function(){
			if($jtf_bg_img.is(':animated'))
				return false;
				scroll('tb');
		});
		
		//click the arrow up, scrolls up
		$jtf_prev.bind('click',function(){
			if($jtf_bg_img.is(':animated'))
			return false;
			scroll('bt');
		});
		
		//mousewheel events - down / up button trigger the scroll down / up
		$j(document).mousewheel(function(e, delta) {
			if($jtf_bg_img.is(':animated'))
				return false;
				
			if(delta > 0)
				scroll('bt');
			else
				scroll('tb');
			return false;
		});
		
		//key events - down / up button trigger the scroll down / up
		$j(document).keydown(function(e){
			if($jtf_bg_img.is(':animated'))
				return false;
			
			switch(e.which){
				case 38:	
					scroll('bt');
					break;	

				case 40:	
					scroll('tb');
					break;
			}
		});
	}
	
	//show next / prev image
	function scroll(dir){
		//if dir is "tb" (top -> bottom) increment current, 
		//else if "bt" decrement it
		current	= (dir == 'tb')?current + 1:current - 1;
		
		//we want a circular slideshow, 
		//so we need to check the limits of current
		if(current == total) current = 0;
		else if(current < 0) current = total - 1;
		
		//flip the thumb
		$jtf_thumbs.flip({
			direction	: dir,
			speed		: 400,
			onBefore	: function(){
				//the new thumb is set here
				var content	= '<span id="tf_zoom" class="tf_zoom"></span>';
				content		+='<img src="' + $jtf_bg_images.eq(current).attr('longdesc') + '" alt="Thumb' + (current+1) + '"/>';
				$jtf_thumbs.html(content);
		}
		});

		//we get the next image
		var $jtf_bg_img_next	= $jtf_bg_images.eq(current),
			//its dimentions
			dim				= getImageDim($jtf_bg_img_next),
			//the top should be one that makes the image out of the viewport
			//the image should be positioned up or down depending on the direction
				top	= (dir == 'tb')?$j(window).height() + 'px':-parseFloat(dim.height,10) + 'px';
				
		//set the returned values and show the next image	
			$jtf_bg_img_next.css({
				width	: dim.width,
				height	: dim.height,
				left	: dim.left,
				top		: top
			}).show();
			
		//now slide it to the viewport
			$jtf_bg_img_next.stop().animate({
				top 	: dim.top
			},1000);
			
		//we want the old image to slide in the same direction, out of the viewport
			var slideTo	= (dir == 'tb')?-$jtf_bg_img.height() + 'px':$j(window).height() + 'px';
			$jtf_bg_img.stop().animate({
				top 	: slideTo
			},1000,function(){
			//hide it
				$j(this).hide();
			//the $jtf_bg_img is now the shown image
				$jtf_bg_img	= $jtf_bg_img_next;
			//show the description for the new image
				$jtf_content_wrapper.children()
								   .eq(current)
							       .show();
	});
		//hide the current description	
			$jtf_content_wrapper.children(':visible')
							   .hide()
	
	}
	
	//animate the image to fit in the viewport
	function resize($jimg){
		var w_w	= $j(window).width(),
			w_h	= $j(window).height(),
			i_w	= $jimg.width(),
			i_h	= $jimg.height(),
			r_i	= i_h / i_w,
			new_w,new_h;
		
		if(i_w > i_h){
			new_w	= w_w;
			new_h	= w_w * r_i;
			
			if(new_h > w_h){
				new_h	= w_h;
				new_w	= w_h / r_i;
			}
		}	
		else{
			new_h	= w_w * r_i;
			new_w	= w_w;
		}
		
		$jimg.animate({
			width	: new_w + 'px',
			height	: new_h + 'px',
			top		: '0px',
			left	: '0px'
		},350);
	}
	
	//get dimentions of the image, 
	//in order to make it full size and centered
	function getImageDim($jimg){
		var w_w	= $j(window).width(),
			w_h	= $j(window).height(),
			r_w	= w_h / w_w,
			i_w	= $jimg.width(),
			i_h	= $jimg.height(),
			r_i	= i_h / i_w,
			new_w,new_h,
			new_left,new_top;
		
		if(r_w > r_i){
			new_h	= w_h;
			new_w	= w_h / r_i;
		}
		else{
			new_h	= w_w * r_i;
			new_w	= w_w;
		}


		return {
			width	: new_w + 'px',
			height	: new_h + 'px',
			left	: (w_w - new_w) / 2 + 'px',
			top		: (w_h - new_h) / 2 + 'px'
		};
		}
});
    
</script>
        
<?php get_footer(); ?>