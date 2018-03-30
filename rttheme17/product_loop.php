<?php
/* 
* rt-theme product loop
*/
global $args,$wp_query,$item_width,$content_width,$paged,$box_border,$this_column_width_pixel,$item_width,$cotent_generator,$ajaxScroller;

if(is_tax()) $args = array_merge( $wp_query->query, $args);

//keep posts
$temp = $wp_query; 
$wp_query = null; 
$wp_query = new WP_Query(); 
$wp_query->query( $args ); 


//layout names and values
$layout_names      = array("5"=>"five","4"=>"four","3"=>"three","2"=>"two","1"=>"one"); 

//is crop active	
$crop              = get_option(THEMESLUG.'_product_image_crop') ? "true" : "" ;

//image max height
$h = $crop ? get_option('rttheme_product_image_height') : 10000;

$reset_row_count   = 0;
$counter           = 0; 

#
#	item width 
#
$item_width 		=  ($item_width) ?  $item_width  : get_option(THEMESLUG."_product_layout");
 
#
#	column width - pixel  
#
$this_column_width_pixel =  ($this_column_width_pixel) ? intval ($this_column_width_pixel/$item_width) : intval ( ($content_width) / $item_width); 
echo '<div class="product_boxes">';
if ( $wp_query -> have_posts() ) : while ( $wp_query -> have_posts() ) : $wp_query -> the_post();

	// featured images
	$rt_gallery_images 			= get_post_meta( $post->ID, THEMESLUG . "rt_gallery_images", true );
	$rt_gallery_image_titles 	= get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_titles", true );
	$rt_gallery_image_descs 	= get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_descs", true );

	// Values
	$image			=	(is_array($rt_gallery_images)) ? find_image_org_path($rt_gallery_images[0]) : "";
	$title 			=	get_the_title();
	$desc 			=	get_post_meta($post->ID, THEMESLUG.'product_desc', true);
	$permalink	 	=	get_permalink();
	$short_desc		=	get_post_meta($post->ID, THEMESLUG.'short_description', true); 
	$custom_thumb	= 	get_post_meta($post->ID, THEMESLUG.'product_thumb_image', true);

	//box counter
	if(!isset($box_counter)) $box_counter = 1;
 
	//this column width	- grid 
	$this_column_width_grid = 60 / $item_width; 
	
	// Reset Counter	
	$reset=false;
	$reset_row_count =  $reset_row_count + $this_column_width_grid;

 
	//Thumbnail dimensions
	$w = ($this_column_width_pixel > 600) ? 940 : (($this_column_width_pixel > 400) ? 440 : 420);	

	// Resize Image
	if($image) $image_thumb = @vt_resize( '', $image, $w, $h, ''.$crop.'' ); 

	// fixed row holder			
	if($box_counter ==1) echo '<div class="fixed-row">';	
	 
	 	
	//firt and last
	if($item_width==1){
		$addClass        ="first";
		$addClass        .=" last";
		$box_counter     =0;
		$reset_row_count = 0;		
	}	
	elseif($box_counter==1){
		$addClass ="first";
	}  
	elseif ($reset_row_count+$this_column_width_grid > 60){
		$addClass        ="last";
		$box_counter     =0;
		$reset_row_count = 0;
	}
	else{
		$addClass ="";
	}

?>

	<!-- product -->
	<div class="box <?php echo $layout_names[$item_width];?> <?php echo $addClass;?> product box-shadow"> 
			<?php if($image):?>
			<!-- product image -->
			<a href="<?php echo $permalink;?>" class="imgeffect link"><img src="<?php echo $image_thumb['url'];?>"  alt="<?php echo $title;?>" /></a>

			<div class="image-border-bottom"></div><!-- the underline for the image  -->	
			<?php endif;?>
			
			<div class="product_info">
			<!-- title-->
			<h5><a href="<?php echo $permalink;?>" title="<?php echo $title;?>"><?php echo $title;?></a></h5> 				
			<!-- text-->
			<?php echo (do_shortcode($short_desc));?>				
		</div>
	</div>
	<!-- / product -->
	 

			
<?php
//get page and post counts
$page_count=get_page_count();
$post_count=$page_count['post_count'];
    
    $counter++; 
    $box_counter++;
    
    //close row
    if(stristr($addClass,"last") || $post_count==$counter){
		
		echo "</div><!-- end of fixed rows -->";//end of fixed rows

		if ($post_count!=$counter){
			echo '<div class="clear"></div><div class="space margin-b30"></div>';
		}
    }    

?>

<?php endwhile;endif;?>
</div>


<?php if( isset( $page_count['page_count'] ) && $page_count['page_count'] >1 && $paged):?> 
 
<!-- paging--> 
<div class="clear"></div>
	<div class="paging_wrapper margin-t30">
		<ul class="paging">
			<?php 
			if($ajaxScroller){
				get_pagination(1000,"true"); 
			}else{
				get_pagination(); 
			}?>
		</ul>
	</div>			
	<!-- / paging-->
<?php endif;?>


<?php 
	wp_reset_query(); 
	$wp_query = null; 
	$wp_query = $temp;  // Reset
?>
	 