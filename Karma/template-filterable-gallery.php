<?php
/*
Template Name: Filterable Gallery
*/
?>
<?php 
get_header(); 
get_template_part( 'theme-template-part-slider', 'childtheme' );
	
remove_filter('pre_get_posts','wploop_exclude');
$gallery_layout = get_post_meta($post->ID, "meta_truethemes_gallery_layout", $single = true);

//get gallery layout to determine div content css class
if($gallery_layout == 'tt-1-col-portrait'):
	 echo'<main role="main" id="content" class="portfolio_full_width">';
else:
     echo'<main role="main" id="content" class="content_full_width portfolio_layout">';
endif;
?>

<?php 
//display page content
if(have_posts()) : while(have_posts()) : the_post(); the_content(); truethemes_link_pages(); endwhile; endif;

//settings for filterable Gallery
$gallery_layout         =   get_post_meta($post->ID, "meta_truethemes_gallery_layout", $single = true);
$content_title          =   get_post_meta($post->ID, "meta_truethemes_gallery_title_check", $single = true);
$content_description    =   get_post_meta($post->ID, "meta_truethemes_gallery_description_check", $single = true);
$gallery_framestyle     =   get_post_meta($post->ID, "meta_truethemes_gallery_framestyle", $single = true);
$item_count    		    =   get_post_meta($post->ID, "meta_truethemes_gallery_itemcount", $single = true);
//@since 4.0.1 commented out original code.
//$taxonomy_id_array      =   get_post_meta($post->ID, 'meta_truethemes_gallery_category', true);

//@since 4.0.1 mod by denzel to use category id from gallery category id text input added in custom-metaboxes.php
//at line 387, as a fail safe in case gallery category dropdown does not save the correct category id.

//@since 4.8 - WPML fix. Added (int)
$tt_karma_gallery_cat_id = get_post_meta($post->ID, 'gallery_cat_id',true);

if($tt_karma_gallery_cat_id!=''){
$tt_karma_gallery_cat_id = (int) $tt_karma_gallery_cat_id;
}else{
//if user does not enter a slider category id, we use back the category dropdown
$tt_karma_gallery_cat_id = get_post_meta($post->ID, 'meta_truethemes_gallery_category', true);
$tt_karma_gallery_cat_id = (int) $tt_karma_gallery_cat_id[0];
}
    
    //Uncomment to see what is being saved? They should be string now not array.
    //var_dump($tt_karma_gallery_cat_id);
    
    //remember line 65 and line 137 uses the same $tt_karma_gallery_cat_id

$all_cat_text    		=   get_post_meta($post->ID, "meta_truethemes_gallery_filter_linktext", $single = true);
$posts_per_page         =   stripslashes($item_count);
if ('' == $posts_per_page) { $posts_per_page = 1000 ; }
$paged                  =   (get_query_var('paged')) ? get_query_var('paged') : 1;
$query_string = array(
				'post_type'      => 'tt-gallery',
				'posts_per_page' => $posts_per_page,
				'paged'          => $paged,
				'order'          => 'ASC',
				'tax_query'      => array(
					array(
					    'taxonomy' => 'truethemes-gallery-category',
					    //'field'  => 'id',
                    	'field'    => 'term_id',
					    'terms'    => $tt_karma_gallery_cat_id,//@since 4.0.1 changed variable name.
					    )
					)
				);
$wp_query = new WP_Query($query_string);
$count    = 0;

//check user selected layout to determine values.
switch($gallery_layout){
case "tt-1-col":
  $tt_column_size  = 'portfolio_one_column_last';  
  $gallery_framestyle_class = $gallery_framestyle.'_gallery_single';
  $image_width  = 703;
  $image_height = 563;
  $zoom         = '1';      
  break;
case "tt-2-col":
  $tt_column_size  = 'one_half';  
  $gallery_framestyle_class = $gallery_framestyle.'_two_col_large';
  $image_width     = 437;
  $image_height    = 234;
  $zoom            = '2';   
  break;
case "tt-3-col":
  $tt_column_size  = 'one_third';
  $gallery_framestyle_class = $gallery_framestyle.'_three_col_large';
  $image_width     = 275;
  $image_height    = 145;
  $zoom            = '3';  
  break;
case "tt-3-col-square":
  $tt_column_size  = 'one_third';
  $gallery_framestyle_class = $gallery_framestyle.'_three_col_square';
  $image_width     = 275;
  $image_height    = 275;
  $zoom            = '3';  
  break; 
case "tt-4-col":
  $tt_column_size  = 'one_fourth';  
  $gallery_framestyle_class = $gallery_framestyle.'_four_col_large'; 
  $image_width     = 190;
  $image_height    = 111;
  $zoom            = '4';   
  break;
case "tt-1-col-portrait":
  $tt_column_size  = 'portfolio_portrait_full_last'; 
  $gallery_framestyle_class = $gallery_framestyle.'_portrait_full'; 
  $image_width     = 612;
  $image_height    = 792;
  $zoom            = 'portrait-full';      
  break; 
case "tt-3-col-portrait":
  $tt_column_size  = 'one_third'; 
  $gallery_framestyle_class = $gallery_framestyle.'_portrait_thumb';
  $image_width  = 275;
  $image_height = 355; 
  $zoom         = 'portrait-small';        
  break;               
default:
  $no_of_columns = 0;
}

?>
<div id="horizontal_nav" class="tt-gallery-nav-wrap">
    <ul id="tt-gallery-nav">
        <li class="active"><a href="#" data-filter="*"><?php _e( $all_cat_text , 'truethemes_localize' ); ?></a></li>
        <?php
            wp_list_categories(
                array(
                    'title_li'          => '',
                    'show_option_none'  => '',
                    'taxonomy'          => 'truethemes-gallery-category',
                    'child_of' 			=> $tt_karma_gallery_cat_id,//@since 4.0.1 changed variable name.
                    'walker'            => new truethemes_gallery_walker() //custom walker in functions.php
                )
            );
        ?>
    </ul>
</div><!-- END horizontal_nav -->

<div id="tt-gallery-iso-wrap" class="clearfix">    
    
<?php
$count = 1; // For unique id of gallery item
 
if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post();
$terms = get_the_terms( get_the_ID(), 'truethemes-gallery-category' );

$count++;

//retrieve all post meta of posts in the loop.
$linkpost            = get_post_meta($post->ID, "truethemes_gallery_link_to_page", $single = true);
$target              = get_post_meta($post->ID, "truethemes_gallery_link_target", $single = true);
$gallery_title       = get_post_meta($post->ID, "truethemes_gallery_title", $single = true);
$gallery_description = get_post_meta($post->ID, "truethemes_gallery_description", $single = true);
$external_image_url  = get_post_meta($post->ID,'truethemes_gallery_thumbnail',true);
$lightbox1           = get_post_meta($post->ID,'truethemes_gallery_lightbox',true);
$lightboxtitle1      = get_post_meta($post->ID,'truethemes_gallery_lightbox_title_1',true);
$lightbox2           = get_post_meta($post->ID,'truethemes_gallery_lightbox_2',true);
$lightboxtitle2      = get_post_meta($post->ID,'truethemes_gallery_lightbox_title_2',true);
$lightbox3           = get_post_meta($post->ID,'truethemes_gallery_lightbox_3',true);
$lightboxtitle3      = get_post_meta($post->ID,'truethemes_gallery_lightbox_title_3',true);
$lightbox4           = get_post_meta($post->ID,'truethemes_gallery_lightbox_4',true);
$lightboxtitle4      = get_post_meta($post->ID,'truethemes_gallery_lightbox_title_4',true);
$lightbox5           = get_post_meta($post->ID,'truethemes_gallery_lightbox_5',true);
$lightboxtitle5      = get_post_meta($post->ID,'truethemes_gallery_lightbox_title_5',true);

//truethemes image cropping script from framework/theme-functions.php
$image_src = truethemes_crop_image($thumb='',$external_image_url,$image_width,$image_height);
		
		$portfolio_img = '';
		
		if(empty($linkpost)){
		//regular portfolio item.
			
		//we use post id as prettyphoto group.
		global $post;
		$prettyphoto_group = "prettyPhoto[{$post->ID}]";
		if(empty($lightbox2)){
		//if there is only one lightbox image, we do not use group.
		$prettyphoto_group = "prettyPhoto";
		}
		$portfolio_img .= "<a href='$lightbox1' class='attachment-fadeIn' data-gal='$prettyphoto_group' title='$lightboxtitle1'>";
		
		}else{
		//portfolio that links to url.
		
		$portfolio_img .= "<a href='$linkpost' class='attachment-fadeIn' target='$target' title='$lightboxtitle1'>";
		
		}
		
		if(empty($linkpost)){
		//regular gallery item - load zoom icon
		$portfolio_img .='<div class="lightbox-zoom zoom-'.$zoom.'" style="position:absolute; display: none;">&nbsp;</div>';
		
		
		}else{
		//post link url - load arrow icon
		$portfolio_img .='<div class="lightbox-zoom zoom-'.$zoom.' zoom-link" style="position:absolute; display: none;">&nbsp;</div>';
		
		}
		
		//this is the actual image.
		$portfolio_img .= "<img class='tt-fadein' src='$image_src' width='$image_width' height='$image_height' alt='$gallery_title' />";
		
		
		//there is a link tag, we have to end it.
		$portfolio_img .='</a>';	
		
		$lightbox_image = '';			
		//here we print the lightbox 2 to 5 images.
		for($i=2;$i<6;$i++){
		    // use variable variables to dynamically assign values.
		    //http://php.net/manual/en/language.variables.variable.php
		    $lurl           = "lightbox".$i;
		    $lightbox_url   = ${$lurl};
		    $ltitle         = "lightboxtitle".$i;
		    $lightbox_title = ${$ltitle};	
		    if(!empty($lightbox_url)):	    
			$lightbox_image.="<a href='$lightbox_url' data-gal='prettyPhoto[$prettyphoto_group]' title='$lightbox_title'><img src='$lightbox_url' style='display:none'></a>";
			endif;
		}
					
?>

<?php
//if 1 column or 1 column portrait...
if(($gallery_layout == 'tt-1-col-portrait') || ($gallery_layout == 'tt-1-col')):
?>

<div data-id="id-<?php echo absint( $count ); ?>" class="port-1-wrap <?php if ( $terms ) : foreach ( $terms as $term ) : echo sanitize_html_class( 'term-' . absint( $term->term_id ) ) . ' '; endforeach; endif; ?>">

		<div class="portfolio_one_column<?php if ($gallery_layout == 'tt-1-col'): echo ' gallery_single';endif;?>">
			<?php 	if('yes' == $content_title):echo '<h3>'.$gallery_title.'</h3>';endif;
					if('yes' == $content_description):echo wpautop($gallery_description);endif; //@since 4.0.2 - using wpautop() in conjunction with wysiwyg metabox
			 ?>
		</div><!-- END portfolio_one_column -->

		<div class="<?php echo $tt_column_size; ?>">
			<div class="<?php echo $gallery_framestyle ?>_img_frame <?php echo $gallery_framestyle_class ?>">
		<?php if(!empty($image_src)): //there is either post thumbnail of external image ?>
				<div class="img-preload lightbox-img">
					<?php echo $portfolio_img; echo $lightbox_image; ?>
		        </div><!-- END img-preload -->
		<?php endif; ?>
			</div><!-- END image_frame -->
		</div><!-- END column -->
		
		<div class="port_sep">
			<div class="hr_top_link"></div><a href="#" class="link-top"><?php _e('top','truethemes_localize'); ?></a>
		</div><!-- END port_sep -->
        
</div><!-- END port-1-wrap -->


<?php else: //else 2 column, 3 column, 3 column portrait, and 4 column... ?>


		<div data-id="id-<?php echo absint( $count ); ?>" class="<?php echo $tt_column_size; ?> <?php if ( $terms ) : foreach ( $terms as $term ) : echo sanitize_html_class( 'term-' . absint( $term->term_id ) ) . ' '; endforeach; endif; ?>">
			
            <div class="<?php echo $gallery_framestyle ?>_img_frame <?php echo $gallery_framestyle_class ?>">
		<?php if(!empty($image_src)): //there is either post thumbnail of external image ?>
		        <div class="img-preload lightbox-img">
					<?php echo $portfolio_img; echo $lightbox_image; ?>
		        </div><!-- END img-preload -->
		<?php endif; ?>
			</div><!-- END image_frame -->
		    
            <?php if(('yes' == $content_title) || ('yes' == $content_description)):?>
		    <div class="portfolio_content">
				<?php if('yes' == $content_title):echo '<h3>'.$gallery_title.'</h3>';endif;
					  if('yes' == $content_description):echo wpautop($gallery_description);endif; //@since 4.0.2 - using wpautop() in conjunction with wysiwyg metabox ?>
		    </div><!-- END portfolio_content -->
            <?php endif; //end title/description check ?>
		</div><!-- END column -->
		
<?php endif; //endif for if($gallery_layout) check ?>		
		  
		<?php if ( @$mod == 0 ){ if($gallery_layout!=='tt-1-col-portrait'){echo '<br class="clear" />';}}
		
		$count++; endwhile; endif; ?>
		
		
		  </div><!-- end #tt-gallery-iso-wrap -->
		    
		<?php
        wp_pagenavi();
		wp_reset_query(); //reset custom query so that it does not affect WPML  
		get_template_part('theme-template-part-inline-editing','childtheme'); ?>    

</main><!-- END main #content -->
</div><!-- END main-area -->

<?php get_footer(); ?>