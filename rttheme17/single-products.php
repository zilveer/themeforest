<?php
# 
# rt-theme product detail page
#
 
//flush rewrite rules
add_action('init', 'flush_rewrite_rules');

//taxonomy
$taxonomy = 'product_categories';

//page link
$link_page = get_permalink(get_option('rttheme_product_list'));

//category link
$terms = get_the_terms($post->ID, $taxonomy);
$i=0;
if($terms){
	foreach ($terms as $taxindex => $taxitem) {
	if($i==0){
		$link_cat=get_term_link($taxitem->slug,$taxonomy);
		$term_slug = $taxitem->slug;
		$term_id = $taxitem->term_id;
		}
	$i++;
	}
}

get_header();
?>


<?php
#
# page layout - sidebar
#
$sidebar 	= 	(get_post_meta($post->ID, THEMESLUG.'custom_sidebar_position', true)) ? get_post_meta($post->ID, THEMESLUG.'custom_sidebar_position', true) : get_option(THEMESLUG."_sidebar_position_product");

#
# content width
#
$content_width = ($sidebar=="full") ? 960 : 710;

#
#	call sub page header
#
get_template_part( 'sub_page_header', 'sub_page_header_file' ); 

#
#	call the sub content holder 1st part
#
sub_page_layout("subheader",$sidebar);
?>

	<?php
	if (have_posts()) : while (have_posts()) : the_post();

		// featured images
		$rt_gallery_images 			= get_post_meta( $post->ID, THEMESLUG . "rt_gallery_images", true );
		$rt_gallery_image_titles 	= get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_titles", true );
		$rt_gallery_image_descs 	= get_post_meta( $post->ID, THEMESLUG . "rt_gallery_image_descs", true );
	
		//values 
		$rt_attached_documents  	= get_post_meta($post->ID, THEMESLUG.'attached_documents', true); 
		$content					= apply_filters('the_content',(get_the_content())); 
		$title						= get_the_title();
		$permalink	 				= get_permalink();
		$order_button				= get_post_meta($post->ID, THEMESLUG.'order_button', true);
		$order_button_text			= get_post_meta($post->ID, THEMESLUG.'order_button_text', true);
		$order_button_link			= get_post_meta($post->ID, THEMESLUG.'order_button_link', true);
		$related_products			= get_post_meta($post->ID, THEMESLUG.'related_products[]', true);
		$short_desc					= get_post_meta($post->ID, THEMESLUG.'short_description', true);
		$password_protected     	= ( post_password_required($post) ) ? true : false ;// Password Protected
	

		//next and previous links
		if(get_option(THEMESLUG.'_hide_product_navigation')){ 
			$prev = is_array( $terms ) ? mod_get_adjacent_post(true,true,'', $taxonomy,'date') : get_adjacent_post("","",true);
			$next = is_array( $terms ) ? mod_get_adjacent_post(true,false,'', $taxonomy,'date') : get_adjacent_post("","",false);

			$prev_post_link_url 	= ($prev) ? get_permalink( $prev->ID ) : "";
			$next_post_link_url 	= ($next) ? get_permalink( $next->ID ) : "";
			$next_post_link	 		= ($next_post_link_url) ? '<a href="'.$next_post_link_url.'" title="" class="p_next"><span>'.__( 'Next →', 'rt_theme').'</span></a>' : false ;
			$prev_post_link	 		= ($prev_post_link_url) ? '<a href="'.$prev_post_link_url.'" title="" class="p_prev"><span>'.__( '← Previous', 'rt_theme').'</span></a>': false ;				 
			$add_class				= ($prev_post_link==false) ? "single" : ""; // if previous link is empty add class to fix white border
			$before_sidebar			= ($next_post_link || $prev_post_link) ? '<div class="post-navigations  margin-b20 '.$add_class.'">'.$prev_post_link. '' .$next_post_link.'</div>' : "";
		} 

		//free tabs count
		$tab_count=3;
		for($i=0; $i<$tab_count+1; $i++){
		    if (trim(get_post_meta($post->ID, THEMESLUG.'free_tab_'.$i.'_title', true)))  $tabbed_page="yes";
		}
	?>

	<!-- product title  -->   
	<div class="box one box-shadow margin-b30">  
		<div class="head_text nomargin">
			<div class="arrow"></div><!-- arrow -->
			<h2 class="product"><?php the_title(); ?></h2> 
		</div> 
	</div>  
	<!-- / product title  --> 

	<!-- product images --> 
 
		<?php if (is_array($rt_gallery_images)  && !$password_protected ):
				
		//is crop active		
		$crop = (get_option(THEMESLUG.'_single_product_image_crop')) ? true : false ;


		//Thumbnail dimensions
		$w = (get_option(THEMESLUG.'_single_product_image_width')) ? get_option(THEMESLUG.'_single_product_image_width') : 147; // image max width 
		$h = ($crop) ? (get_option(THEMESLUG.'_single_product_image_height')) ? get_option(THEMESLUG.'_single_product_image_height') : 147 : 10000; // image max height 
		?>
		
			<?php if(count($rt_gallery_images)>1):?>
				<!-- product image slider -->
	
					<?php  
					//Product Photos 
					$imagesHTML = "";
					$maxHeight  = 0;
 

						for ($i=0; $i < (count($rt_gallery_images)); $i++) {

							//resize the photo  
							$photo_url 		= find_image_org_path(trim($rt_gallery_images[$i]));
							$image_thumb 		= @vt_resize( '', trim(trim($rt_gallery_images[$i])), $w, $h, $crop );													
							$maxHeight 		= ($image_thumb['height']>$maxHeight) ? $image_thumb['height'] : $maxHeight ;
							 
							$imagesHTML .=  '<li><a class="imgeffect magnifier" href="'.$photo_url.'" data-gal="prettyPhoto[rt_theme_products]" title="'.$rt_gallery_image_descs[$i].'"><img src="'.$image_thumb['url'].'" width="'.$w.'" alt="'.$rt_gallery_image_titles[$i].'" /></a></li>';

						}

					?>
					
				<div class="carousel box-shadow" style="height:<?php echo $maxHeight+42;?>px;overflow:hidden;"><ul id="product_thumbnails" class="jcarousel-skin-rt"><?php echo $imagesHTML;?></ul></div>
				<div class="space margin-t10 margin-b20"></div>
			<?php endif;?>
		<?php endif;?>
	<!-- / product images -->  
	
 
	<!-- PRODUCT TABS --> 

	<!-- TABS WRAP -->				
		
		<?php if(@$tabbed_page):?>
		<div class="taps_wrap box-shadow">
		    <!-- the tabs -->
		    <ul class="tabs">
				<?php if($content):?><li><a href="#"><?php _e('General Details','rt_theme');?></a></li><?php endif;?>
				<?php
				#
				#	Free Tabs
				#	
				for($i=0; $i<$tab_count+1; $i++){ 
					if ( trim( get_post_meta($post->ID, THEMESLUG.'free_tab_'.$i.'_title', true ) )  && !$password_protected ){
						echo '<li><a href="#">'.get_post_meta($post->ID, THEMESLUG.'free_tab_'.$i.'_title', true).'</a></li>';
					}
				}
				
				#
				#	Attached Documents
				# 		
				if( $rt_attached_documents  && !$password_protected ){
					echo '<li><a href="#">'.__('Attached Documents','rt_theme').'</a></li>';
				}
				?>
		
		    </ul>
		<?php endif;?>
		
		<?php if($content):?>								
		<!-- General Details -->
		
		<?php if(@$tabbed_page):?><div class="pane"><?php else:?><div class="box one box-shadow margin-b30"><?php endif;?> 
			<div>
			<?php if(is_array($rt_gallery_images) && count($rt_gallery_images)==1): // only 1 image for this product ?>	
				<?php 
				//resize the photo  
				$photo_url 		= (is_array($rt_gallery_images)) ? find_image_org_path($rt_gallery_images[0]) : "";
				$image_thumb 		= @vt_resize( '', trim($photo_url), 300, 600, false );		
				?>
				<a href="<?php echo $photo_url;?>" title="" data-gal="prettyPhoto[rt_theme_products]" class="imgeffect magnifier alignleft" ><img src="<?php echo $image_thumb['url'];?>" alt="" /></a>
			<?php endif;?>
			
			<?php echo $content;?>
			</div>
			<div class="clear"></div>
		</div>
		<?php endif;?>

		<?php
		#
		#	Free Tabs' Content
		#	
		for($i=0; $i<$tab_count+1; $i++){ 
			if ( trim( get_post_meta($post->ID, THEMESLUG.'free_tab_'.$i.'_title', true) )  && !$password_protected ){ 
				echo '<div class="pane">';
				echo (apply_filters('the_content',get_post_meta($post->ID, THEMESLUG.'free_tab_'.$i.'_content', true)));
				echo '<div class="clear"></div></div>';
			}
		}
		?>

		<?php if($rt_attached_documents && !$password_protected):?> 
				
			<?php if(@!$tabbed_page):?><div class="line"></div><?php endif;?>
			<div class="pane">
				<!-- document icons -->
				<div class="doc_icons">
					
					<?php

					if(trim($rt_attached_documents)):
					    $rt_attached_documents 	= trim(preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $rt_attached_documents));  
					    $rt_attached_documents	= explode("\n", $rt_attached_documents);
					endif;
					
					if(is_array($rt_attached_documents)){
						
						echo "<ul>";

						foreach($rt_attached_documents as $a_file){ 

							if(strpos($a_file,"|")) {
								$a_file = explode("|", $a_file);
								$fileURL = trim( $a_file[1] );
								$fileName = trim( $a_file[0] );
							}else{
								$fileURL = trim( $a_file );
								$fileName  = "";
							}

							echo "<li>";

							if(strpos($fileURL, ".doc")){
								echo '<a href="'.$fileURL.'" title="'.__('Download Word File','rt_theme').'"><img src="'.THEMEURI.'/images/assets/icons/Word.png" alt="'.__('Download Word File','rt_theme').'" class="png" /></a>';
							}

							elseif(strpos($fileURL, ".xls")){
								echo '<a href="'.$fileURL.'" title="'.__('Download Excel File','rt_theme').'"><img src="'.THEMEURI.'/images/assets/icons/File_Excel.png" alt="'.__('Download Excel File','rt_theme').'" class="png" /></a>';
							}

							elseif(strpos($fileURL, ".pdf")){
								echo '<a href="'.$fileURL.'" title="'.__('Download PDF File','rt_theme').'"><img src="'.THEMEURI.'/images/assets/icons/File_Pdf.png" alt="'.__('Download PDF File','rt_theme').'" class="png" /></a>';
							}							

							elseif(strpos($fileURL, ".ppt")){
								echo '<a href="'.$fileURL.'" title="'.__('Download PowerPoint File','rt_theme').'"><img src="'.THEMEURI.'/images/assets/icons/File_PowerPoint.png" alt="'.__('Download PowerPoint File','rt_theme').'" class="png" /></a>';
							}							

							else{
								echo '<a href="'.$fileURL.'" title="'.__('Download File','rt_theme').'"><img src="'.THEMEURI.'/images/assets/icons/File.png" alt="'.__('Download File','rt_theme').'" class="png" /></a>';
							}
							
							//file name
							if( $fileName ) echo "<strong>" .$fileName ."</strong>";

							echo "</li>";
							
						}

						echo "</ul>";
					}
					?>

				</div>
				<!-- document icons -->
			</div>
		<?php endif;?>
				
				
		<?php if(@$tabbed_page):?>        
		</div><div class="clear"></div>
		<?php endif;?> 
 
	<!-- / PRODUCT TABS -->

			<?php
					if($sidebar=="full"){
						echo $before_sidebar;
					}
			?>


	<div class="space v_10"></div>
	<!-- / content --> 		

	
	<?php if(comments_open()):?>

	
	<div class="box one box-shadow">
		<div class='entry commententry'>
		    <?php comments_template(); ?>
		</div>
	</div>
	<div class="space margin-t10 margin-b20"></div>
	<?php endif;?>


	<!-- RELATED PRODUCTS --> 
		<?php
		if(is_array($related_products)){
		?>
						<!-- title -->
				<div class="box one box-shadow margin-b30">
						<!-- page title -->
						<div class="head_text nomargin">
							<div class="arrow"></div><!-- arrow -->
							<h4 class="product"><?php echo __("Related Products",'rt_theme');?></h4> 
						</div>
						<!-- /page title -->
				</div>
				
		<?php
			//taxonomy 
			$args=array(
				'post_type'           => 'products', 
				'post_status'         => 'publish',
				'orderby'             => 'menu_order', 
				'ignore_sticky_posts' => 1,
				'posts_per_page'      => 1000, 
				'post__in'            => $related_products
			);

			//item width - column count
			$item_width = get_option(THEMESLUG."_related_product_layout");
		    get_template_part( 'product_loop', 'product_categories' );
		echo '<div class="space margin-b30"></div>';
		}
		?>

	<!-- / RELATED PRODUCTS --> 

	<?php endwhile;?>
	
	<?php else: ?>
		<p><?php _e( 'Sorry, no page found.', 'rt_theme'); ?></p>
	<?php endif; ?>
	
	
<?php
#
#	call the sub content holder 2nd part
#
sub_page_layout("subfooter",$sidebar); 

get_footer();
?>