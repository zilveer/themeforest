<?php
# 
# rt-theme single product content
#
global $rt_sidebar_location; 
?>

	<?php
	if (have_posts()) : while (have_posts()) : the_post(); 

		//get queried object
		$this_product          = get_queried_object();

		// featured images
		$rt_gallery_images     = get_post_meta( $post->ID, RT_COMMON_THEMESLUG . "rt_gallery_images", true ); 
		$rt_gallery_images     = ! empty( $rt_gallery_images ) ? ! is_array( $rt_gallery_images ) ? explode(",", $rt_gallery_images) : $rt_gallery_images : array(); //turn into an array
		$rt_gallery_images	   = rt_merge_featured_images( $rt_gallery_images ); //add the wp featured image to the array

		//values 
		$regular_price         = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'price_regular', true); 		
		$sale_price            = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'sale_price', true); 
		$sku                   = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'sku', true); 
		$rt_attached_documents = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'attached_documents', true); 
		$content               = apply_filters('the_content',(get_the_content()));  
		$permalink             = get_permalink();	
		$related_products      = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'related_products[]', true);
		$short_desc            = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'short_description', true);
		$password_protected    = ( post_password_required($post) ) ? true : false ;// Password Protected


		//free tabs count
		$tab_count=4;
		$tabbed_page = "";
		for($i=0; $i<$tab_count+1; $i++){
			if (trim(get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'free_tab_'.$i.'_title', true))) {
				$tabbed_page="yes";
			}
		}
	?>
 


<div class="row clearfix" itemscope itemtype="http://schema.org/Product">

		<?php if ( !empty($rt_gallery_images) && is_array($rt_gallery_images) && !$password_protected ): ?>
			<div class="box three first"> 
				<!-- product images --> 
				<section class="product_images">
					<div class="product_images_holder">

						<?php 
							#
							# call the product slider 
							# @hooked in /rt-framework/functions/theme_functions.php
							#

							do_action( "rt_product_image_slider", $rt_gallery_images, $this_product->post_name );
						?> 

					</div>
				</section><!-- / end section .product_images -->  
			</div>
		<?php endif; ?>


		<?php echo ! empty( $rt_gallery_images ) ? '<div class="box two-three last">' : '<div class="box one last">'; ?>
		
		<div class="head_text nomargin">
 

			<?php 

				#
				# get info bar (breadcrumb and page title )	  
				# @hooked in /rt-framework/functions/theme_functions.php
				#
 
				echo  do_action( "get_info_bar", apply_filters( 'get_info_bar_single_products', array( "called_for" => "inside_content" ) ) );


				#
				# call product price 
				# @hooked in /rt-framework/functions/theme_functions.php
				#
				if ( get_option( RT_THEMESLUG."_show_price_in_pages") ){
					// call product price - hooked in /rt-framework/functions/theme_functions.php
					do_action( "rt_product_price", array( "regular_price" => $regular_price, "sale_price" => $sale_price) );
				}
	 
			?> 

			<meta itemprop="name" content="<?php echo get_the_title();?>">
			<meta itemprop="url" content="<?php echo get_the_permalink();?>">

		</div>             
 		

		
		<?php //short description
			echo ! empty( $short_desc ) ? sprintf( '<p itemprop="description">%s</p>', $short_desc ) : "" ;
		?>

		<div class="product_meta">
			<?php 

				//SKU
				echo ! empty( $sku ) ? sprintf( '<span class="sku_wrapper" itemprop="productID"><span class="sku"><b>%s:</b> %s  </span></span> ', __('SKU','rt_theme'), $sku ) : "" ;

				//categories 
				echo '<span class="posted_in">' . get_the_term_list( $post->ID, 'product_categories', '<b>'._n('Category','Categories', count( get_the_terms( $post->ID , 'product_categories') ),'rt_theme') .':</b> ', ', ', '' ) . '</span>' ; 

			?>			
		</div>


	</div>


</div>


<div class="space margin-t20 margin-b20"></div><!-- space -->

<?php 
//get project navigation - for full width page
if( $rt_sidebar_location[0] == "full" ){
	do_action( "get_post_navigation");
}
?>

<div class="row clearfix">
	<div class="box one first">

 		
		<?php if($tabbed_page):?>
		<div class="tabs_wrap tab-style-three">
		    <!-- the tabs -->
		    <ul class="tabs clearfix">
				<?php if($content):?><li class="with_icon"><a href="#"><span class="icon-doc-alt"></span><?php _e('General Details','rt_theme');?></a></li><?php endif;?>
				<?php
				#
				#	Free Tabs
				#	
				for($i=0; $i<$tab_count+1; $i++){ 

					$tab_icon = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'free_tab_'.$i.'_icon', true) ? '<span class="'.get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'free_tab_'.$i.'_icon', true).'"></span>': "";
					$tab_name = get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'free_tab_'.$i.'_title', true);

					if ( ! empty( $tab_name ) && !$password_protected ){
						echo ! empty( $tab_icon ) ? sprintf('<li class="with_icon"><a href="#">%s%s</a></li>', $tab_icon, $tab_name ) : sprintf('<li><a href="#">%s%s</a></li>', $tab_icon, $tab_name );
					}
				}
				
				#
				#	Attached Documents
				# 		
				if( $rt_attached_documents  && !$password_protected ){
					echo '<li class="with_icon"><a href="#"><span class="icon-docs"></span>'.__('Documents','rt_theme').'</a></li>';
				}

				#
				#	Comments
				# 		
				if( comments_open() && !$password_protected ){
					echo '<li class="with_icon"><a href="#"><span class="icon-chat-empty"></span>'.__('Comments','rt_theme').'</a></li>';
				}				
				?>
		
		    </ul>
		<?php endif;?>
		
		<?php if($tabbed_page):?><div class="panes"><?php endif;?> 

		<?php if($content):?>									
		<?php
		#
		#	Main content - General Details Tab
		#	
		if($tabbed_page):?><div class="pane"><?php else:?><div class="box one box-shadow margin-b30"><?php endif;?> 
			<div>
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
			if ( trim( get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'free_tab_'.$i.'_title', true) )  && !$password_protected ){ 
				echo '<div class="pane">';
				echo (apply_filters('the_content',get_post_meta( $post->ID, RT_COMMON_THEMESLUG.'free_tab_'.$i.'_content', true)));
				echo '<div class="clear"></div></div>';
			}
		}
		?>

		<?php
		#
		#	Attached Documents
		#			
		if($rt_attached_documents && !$password_protected):?> 
				
			<?php if(!$tabbed_page):?><div class="line"></div><?php endif;?>
			<div class="pane">
				<!-- document icons -->
				<div class="doc_icons">
					
					<?php

					$rt_attached_documents_output = "";

					if(trim($rt_attached_documents)):
					    $rt_attached_documents 	= trim(preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $rt_attached_documents));  
					    $rt_attached_documents	= explode("\n", $rt_attached_documents);
					endif;
					
					if(is_array($rt_attached_documents)){
						
						$rt_attached_documents_output .= '[icon_list font_size="medium_size" icon_style="colored"]';

						foreach($rt_attached_documents as $a_file){
							if(strrpos($a_file,"|")) {
								$fileTarget="";
								$a_file = explode("|", $a_file);
								$fileTarget = isset( $a_file[2] ) ? trim($a_file[2]) : "_self";
								$fileURL = isset( $a_file[1] ) ? trim($a_file[1]) : "";
								$fileName = isset( $a_file[0] ) ? trim($a_file[0]) : "";
							}else{
								$fileURL = trim( $a_file );
								$fileName  = "";
								$fileTarget = "_self";
							}

							//the download text
							if(strpos($fileURL, ".doc")){
								$file_text = __('Download Word File','rt_theme');
							}

							elseif(strpos($fileURL, ".xls")){
								$file_text = __('Download Excel File','rt_theme');								
							}

							elseif(strpos($fileURL, ".pdf")){
								$file_text = __('Download PDF File','rt_theme');
							}							

							elseif(strpos($fileURL, ".ppt")){
								$file_text = __('Download PowerPoint File','rt_theme');
							}							

							else{
								$file_text = __('Download File','rt_theme');
							}
							
							//the download link
							$download_link = ! empty( $fileName ) ? '<a href="'.$fileURL.'" title="'.$file_text.'" target="'.$fileTarget.'">'.$fileName.'</a>' : '<a href="'.$fileURL.'" title="'.$file_text.'">'.$file_text.'</a>';
						
							//add to output
							$rt_attached_documents_output .= '[icon_list_line icon="icon-download"]'.$download_link.'[/icon_list_line]';
													 							
						}

						$rt_attached_documents_output .= "[/icon_list]";


						echo do_shortcode( $rt_attached_documents_output );
					}
					?>

				</div>
				<!-- document icons -->
			</div>
		<?php endif;?>
				

		<?php
		#
		#	Comments
		#	
		if( $tabbed_page && comments_open() && !$password_protected ):?>
		<div class="pane">
			<div class='entry commententry'>
				<?php comments_template(); ?>
			</div>
		</div>
		<?php endif;?>


				
		<?php if($tabbed_page):?> 
		</div>	     
		</div><div class="space margin-b20"></div>
		<?php endif;?> 

	</div>	 	
</div>	

<?php //related products
	if ( is_array( $related_products ) ){
		
		$related_products_item_width = get_option(RT_THEMESLUG."_related_product_layout");
		$related_products_crop = get_option(RT_THEMESLUG."_related_products_crop");

		echo do_shortcode (  '[product_carousel id="'.sanitize_text_field($this_product->post_name).'-related-products" crop="'.$related_products_crop.'" style="rounded_carousel" heading="'.__("RELATED PRODUCTS",'rt_theme').'" heading_icon="icon-link" item_width="'.$related_products_item_width.'" list_orderby="" list_order="" max_item="" categories="" ids="'.implode(",", $related_products).'"]' );	
	}
 	
?> 
<?php endwhile;?>

<?php // comments for pages without tabs
if( !$tabbed_page && !$password_protected && comments_open() ):?>
	<div class="box one">
		<div class='entry commententry'>
		    <?php comments_template(); ?>
		</div>
	</div>
<div class="space margin-t10 margin-b20"></div>
<?php endif;?>

<?php else: ?>
	<p><?php _e( 'Sorry, no page found.', 'rt_theme'); ?></p>
<?php endif; ?>